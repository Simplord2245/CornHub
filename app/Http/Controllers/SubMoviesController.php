<?php

namespace App\Http\Controllers;

use App\Models\SubMovies;
use Illuminate\Http\Request;

class SubMoviesController extends Controller
{
    public function index(){
        $submovies = SubMovies::with('Episodes')->withCount('Episodes')->get();
        return view('submovies', compact('submovies'));
    }
}
