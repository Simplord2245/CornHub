<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMovies extends Model
{
    use HasFactory;
    protected $table = 'SubMovies';
    protected $fillable = ['movie_id, submovie_title, submovie_description, release_year, image, trailer_url'];
}
