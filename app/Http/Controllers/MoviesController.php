<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function index(){
        // $movies = Movies::with('Genres')->get();
            $movies = DB::table('Movies')
        ->join('Movies_Genres', 'Movies.movie_id', '=', 'Movies_Genres.movie_id')
        ->join('Genres', 'Movies_Genres.genre_id', '=', 'Genres.genre_id')
        ->select('Movies.*', 'Genres.name as genre_name')
        ->get();
        
        // dd($movies);
        return view('movie', compact('movies'));
    }

}
