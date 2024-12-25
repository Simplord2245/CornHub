<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function index(Request $request){
    $query = $request->input('search');
    if ($query) {
        $movies = Movies::with('Genres')
            ->where('title', 'like', '%' . $query . '%')
            ->paginate(12);
    } else {
        $movies = Movies::with('Genres')->paginate(12);
    }
    return view('movie', compact('movies', 'query'));
}
    public function create($id = null){
        $genre = Genres::all();
        $movie = $id == null ? new Movies : Movies::with('Genres')->find($id);
        return view('movie_create_update', compact('genre', 'movie'));
    }
    public function store(Request $request, $id = null)
{
        $request->validate([
            'title' => 'required|string|max:255',
            'nation' => 'required|string|max:50',
            'genre_id' => 'required|array|min:1', // Yêu cầu phải là một mảng và có ít nhất 1 thể loại
            'genre_id.*' => 'exists:genres,genre_id', // Mỗi giá trị phải tồn tại trong bảng genres
        ], [
            'title.required' => 'Hãy nhập tên phim',
            'title.max' => 'Tên phim quá dài',
            'nation.required' => 'Hãy nhập quốc gia',
            'nation.max' => 'Quốc gia không hợp lệ',
            'genre_id.required' => 'Hãy chọn ít nhất một thể loại',
            'genre_id.min' => 'Hãy chọn ít nhất một thể loại',
            'genre_id.*.exists' => 'Thể loại không hợp lệ',
        ]);

    $post = Movies::find($id) ?? new Movies();
    
    if ($id && !$post) {
        return redirect()->route('movie.index')->with('error', 'Phim không tồn tại');
    }

    $post->title = $request->title;
    $post->nation = $request->nation;
    $post->save();

    // Nếu cần xử lý thể loại phim
    if ($request->has('genre_id')) {
        $post->genres()->sync($request->genre_id);
    }

    $route = $id ? route('movie.create', $id) : route('movie.index');
    $message = $id ? 'Cập nhật thành công' : 'Thêm mới thành công';
    return redirect($route)->with('success', $message);
}

    public function delete($id){
        $post = Movies::findOrFail($id);
        $post->delete();
        return redirect()->route('movie.index');
    }
}
