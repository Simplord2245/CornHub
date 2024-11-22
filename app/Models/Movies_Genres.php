<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies_Genres extends Model
{
    use HasFactory;
    protected $table = 'movies_genres';
    protected $fillable = ['movie_id', 'genre_id'];
}
