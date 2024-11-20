<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index(){
        $movies = Movies::with('Genres')->get();
        return view('movie', compact('movies'));
    }

}
