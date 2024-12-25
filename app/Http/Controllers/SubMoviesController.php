<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use App\Models\SubMovies;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubMoviesController extends Controller
{
    public function index(Request $request, $id, $name)
{
    $movie_name = $name;
    $query = $request->input('search'); // Lấy từ khóa tìm kiếm

    // Lấy tập phim đầu tiên
    $submoi = SubMovies::with('Movie')->where('movie_id', $id)->first();
    if (!$submoi) {
        return redirect()->route('movies.index')->with('error', 'Không tìm thấy thông tin phim.');
    }

    // Nếu có từ khóa tìm kiếm, thực hiện tìm kiếm
    if ($query) {
        $submovies = SubMovies::with(['Episodes'])
            ->withCount('Episodes')
            ->where('movie_id', $id)
            ->where('submovie_title', 'like', '%' . $query . '%') // Tìm kiếm theo cột "name"
            ->paginate(5);
    } else {
        // Hiển thị danh sách mặc định nếu không tìm kiếm
        $submovies = SubMovies::with(['Episodes'])
            ->withCount('Episodes')
            ->where('movie_id', $id)
            ->paginate(5);
    }

    return view('submovies', compact('submovies', 'movie_name', 'submoi', 'query'));
}
    public function create($movie_id, $id = null){
        $movie = Movies::find($movie_id);
        $submovie = $id == null ? new SubMovies : SubMovies::find($id);
        return view('submovie_create_update', compact('movie', 'submovie'));
    }
    public function store(Request $request, $movie_id, $id = null)
{
    $movie = Movies::find($movie_id);
    // Xác thực dữ liệu
    $validatedData = $request->validate([
        'submovie_title' => 'required|string|max:255',
        'release_year' => 'required|integer|min:1900|max:' . date('Y'),
        'trailer_url' => 'nullable|url',
        'type' => 'required|in:TV Series,Movie',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'submovie_description' => 'nullable|string',
    ], [
        'submovie_title.required' => 'Tiêu đề không được để trống.',
        'release_year.required' => 'Năm phát hành không được để trống.',
        'release_year.integer' => 'Năm phát hành phải là số nguyên.',
        'release_year.min' => 'Năm phát hành không hợp lệ.',
        'release_year.max' => 'Năm phát hành không hợp lệ.',
        'trailer_url.url' => 'Đường dẫn trailer không hợp lệ.',
        'type.required' => 'Dạng phim không được để trống.',
        'type.in' => 'Dạng phim phải là TV Series hoặc Movie.',
        'image.image' => 'Tệp ảnh không hợp lệ.',
        'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif hoặc svg.',
        'image.max' => 'Dung lượng ảnh không được vượt quá 2MB.',
    ]);

    // Truy xuất hoặc tạo mới phần phim
    $submovie = SubMovies::find($id) ?? new SubMovies();

    // Gán giá trị cho các thuộc tính
    $submovie->movie_id = $movie_id;
    $submovie->submovie_title = $validatedData['submovie_title'];
    $submovie->release_year = $validatedData['release_year'];
    $submovie->trailer_url = $validatedData['trailer_url'];
    $submovie->type = $validatedData['type'];
    $submovie->submovie_description = $validatedData['submovie_description'];

    // Xử lý upload ảnh
    $filename = $request->submovie_title;
        $file = $request->file('image');
        $filetype = $file->getClientOriginalExtension();
        
        $new_filename = Str::replace(' ', '_', Str::lower($filename), false);
        $new_filename .= '.' . $filetype;

        $path =  $file->storeAs('img', $new_filename, 'public');

        $submovie->image = $new_filename;
    // Lưu vào cơ sở dữ liệu
    $submovie->save();

    $route = $id ? route('submovie.create', $id) : route('submovie.index', ['id' => $movie->movie_id, 'name' => $movie->title ]);
    $message = $id ? 'Cập nhật thành công' : 'Thêm mới thành công';
    return redirect($route)->with('success', $message);
}
    public function detail($id){
        $submovie_detail = SubMovies::with('Episodes', 'Movie')->withCount('Episodes')->where('submovie_id', $id)->first();
        return view('submovie_detail', compact('submovie_detail'));
    }
    public function watch($id){
        $watch = SubMovies::with('Episodes')->where('submovie_id', $id)->first();
        return view('submovie_watch', compact('watch'));
    }
    public function delete($id){
        $post = SubMovies::with('Movie')->where('submovie_id', $id)->first();
        if ($post->image && file_exists(public_path('storage/img/' . $post->image))) {
            unlink(public_path('storage/img/' . $post->image));
        }
        $post->delete();
        return redirect()->route('submovie.index', [
            'id' => $post->Movie->movie_id,
            'name' => $post->Movie->title,
        ]);
        
    }
}
