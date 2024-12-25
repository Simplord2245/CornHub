<?php

namespace App\Http\Controllers;

use App\Models\Episodes;
use App\Models\SubMovies;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index(Request $request, $id, $name)
{
    $submovie_name = $name; // Lấy tên phụ đề phim
    $query = $request->input('search'); // Lấy từ khóa tìm kiếm từ request

    // Lấy tập đầu tiên (nếu cần hiển thị thông tin riêng cho tập đầu)
    $episo = Episodes::with('Submovie')->where('submovie_id', $id)->first();

    // Kiểm tra nếu có từ khóa tìm kiếm
    if ($query) {
        $episodes = Episodes::where('submovie_id', $id)
            ->where('episode_number', 'like', '%' . $query . '%') // Tìm kiếm theo tên tập phim
            ->paginate(12);
    } else {
        // Hiển thị danh sách mặc định nếu không có tìm kiếm
        $episodes = Episodes::where('submovie_id', $id)->paginate(12);
    }

    return view('episodes', compact('episo', 'episodes', 'submovie_name', 'query'));
}
    public function create($submovie_id, $id = null){
        $submovie = SubMovies::find($submovie_id)->first();
        $episode = $id == null ? new Episodes : Episodes::with('SubMovie')->find($id);
        return view('episode_create_update', compact('submovie', 'episode'));
    }
    public function store(Request $request, $submovie_id, $id = null)
{
    $submovie = SubMovies::find($submovie_id);
    // Validate dữ liệu đầu vào
    $request->validate([
        'episode_number' => 'required|numeric',
        'duration' => 'required|string|max:255',
        'url' => 'required|url',
    ], [
        'episode_number.required' => 'Hãy nhập số tập phim.',
        'episode_number.numeric' => 'Số tập phim phải là một số.',
        'duration.required' => 'Hãy nhập thời lượng.',
        'duration.string' => 'Thời lượng phải là chuỗi.',
        'url.required' => 'Hãy nhập URL.',
        'url.url' => 'URL không hợp lệ.',
    ]);

    // Tìm tập phim nếu đang chỉnh sửa, nếu không thì tạo mới
    $episode = Episodes::find($id) ?? new Episodes();

    // Nếu ID tồn tại nhưng không tìm thấy tập phim
    if ($id && !$episode) {
        return redirect()->route('episodes.index', ['id' => $submovie->submovie_id, 'name' =>$submovie->submovie_title ])->with('error', 'Tập phim không tồn tại.');
    }

    // Cập nhật hoặc tạo mới
    $episode->submovie_id = $submovie_id;
    $episode->episode_number = $request->episode_number;
    $episode->duration = $request->duration;
    $episode->url = $request->url;

    // Lưu vào cơ sở dữ liệu
    $episode->save();

    // Xác định route và thông báo sau khi xử lý
    $route = $id ? route('episodes.create', $id) : route('episodes.index', ['id' => $submovie->submovie_id, 'name' =>$submovie->submovie_title ]);
    $message = $id ? 'Cập nhật tập phim thành công.' : 'Thêm mới tập phim thành công.';

    return redirect($route)->with('success', $message);
}
    public function delete($id){
        $post = Episodes::with('Submovie')->where('episode_id', $id)->first();
        $post->delete();
        return redirect()->route('episodes.index', ['id' => $post->Submovie->submovie_id, 'name' => $post->Submovie->submovie_title]);
    }
}
