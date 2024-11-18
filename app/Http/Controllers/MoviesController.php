<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index(){
        $movie = Movies::all();
        return view('movie', compact('movie'));
    }
}
