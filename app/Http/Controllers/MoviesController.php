<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function index(){
        $movies = Movies::with('Genres')->get();
        return view('movie', compact('movies'));
    }

}
