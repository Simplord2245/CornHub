<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function index(){
        $movies = Movies::with('Genres')->paginate(12);
        return view('movie', compact('movies'));
    }
    public function create($id = null){
        $genre = Genres::all();
        $movie = $id == null ? new Movies : Movies::find($id);
        return view('movie_create_update', compact('genre', 'movie'));
    }
    public function store(Request $request, $id = null){
        $request->validate([
            'title' => 'required|string|max:255',
            'nation' => 'required|string|max:50',
        ],[
            'title.required' => 'Hãy nhập tên phim',
            'title.max' => 'Tên phim quá dài',
            'nation.required' => 'Hãy nhập quốc gia',
            'ntion.max' => 'Quốc gia không hợp lệ',
        ]);
            if($id == null){
                $post = new Movies();
            } else {
                $post = Movies::find($id);
            }
            $post->title = $request->title;
            $post->nation = $request->nation;


            if($id == null){
                $post->save();
            } else {
                $post->update();
            }
            
            if($id == null){
                return redirect()->route('movie.index');
            } else {
                return redirect()->route('movie.create',$id)->with('success','Cập nhật thành công');
            }
    }
    public function delete($id){
        $post = Movies::findOrFail($id);
        $post->delete();
        return redirect()->route('movie.index');
    }
}
