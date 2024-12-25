<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('search'); // Lấy từ khóa tìm kiếm từ request

    // Kiểm tra nếu có từ khóa tìm kiếm
    if ($query) {
        $genres = Genres::with('Movies')
            ->withCount('Movies')
            ->where('name', 'like', '%' . $query . '%') // Tìm kiếm theo tên thể loại
            ->orderBy('movies_count', 'desc')
            ->paginate(12);
    } else {
        // Hiển thị danh sách mặc định nếu không có tìm kiếm
        $genres = Genres::with('Movies')
            ->withCount('Movies')
            ->orderBy('movies_count', 'desc')
            ->paginate(12);
    }

    return view('genres', compact('genres', 'query'));
}

    public function create($id = null){
        $genre = $id == null ? new Genres : Genres::find($id);
        return view('genre_create_update', compact('genre'));
    }
    public function store(Request $request, $id = null)
{
    // Validate dữ liệu
    $request->validate([
        'name' => 'required|string|max:255|unique:genres,name,' . $id . ',genre_id',
    ], [
        'name.required' => 'Vui lòng nhập tên thể loại.',
        'name.string' => 'Tên thể loại phải là chuỗi ký tự.',
        'name.max' => 'Tên thể loại không được vượt quá 255 ký tự.',
        'name.unique' => 'Tên thể loại đã tồn tại.',
    ]);

    // Tìm thể loại nếu đang chỉnh sửa, hoặc tạo mới
    $genre = $id ? Genres::find($id) : new Genres();

    if ($id && !$genre) {
        return redirect()->route('genre.index')->with('error', 'Thể loại không tồn tại.');
    }

    // Cập nhật hoặc thêm mới thể loại
    $genre->name = $request->name;
    $genre->save();

    // Xác định route và thông báo
    $route = $id ? route('genre.create', $id) : route('genre.index');
    $message = $id ? 'Cập nhật thể loại thành công.' : 'Thêm mới thể loại thành công.';

    return redirect($route)->with('success', $message);
}
    public function delete($id){
        $post = Genres::findOrFail($id);
        $post->delete();
        return redirect()->route('genre.index');
    }
}
