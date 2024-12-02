<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public function index(){
        $genres = Genres::with('Movies')->withCount('Movies')->orderBy('movies_count', 'desc')->paginate(13);
        return view('genres', compact('genres'));
    }
    public function delete($id){
        $post = Genres::findOrFail($id);
        $post->delete();
        return redirect()->route('genre.index');
    }
}
