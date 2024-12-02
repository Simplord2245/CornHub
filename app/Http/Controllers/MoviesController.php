<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function index(){
        $movies = Movies::with('Genres')->paginate(13);
        return view('movie', compact('movies'));
    }
    public function delete($id){
        $post = Movies::findOrFail($id);
        $post->delete();
        return redirect()->route('movie.index');
    }
}
