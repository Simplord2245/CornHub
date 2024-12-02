<?php

namespace App\Http\Controllers;

use App\Models\SubMovies;
use Illuminate\Http\Request;

class SubMoviesController extends Controller
{
    public function index($id, $name){
        $movie_name = $name;
        $submovies = SubMovies::with('Episodes')->withCount('Episodes')->where('movie_id', $id)->paginate(13);
        return view('submovies', compact('submovies', 'movie_name'));
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
        $post->delete();
        return redirect()->route('submovie.index', [
            'id' => $post->Movie->movie_id,
            'name' => $post->Movie->title,
        ]);
        
    }
}
