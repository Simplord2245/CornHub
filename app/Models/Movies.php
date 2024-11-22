<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;
    protected $table = "movies";

    public function Genres()
    {
        return $this->belongsToMany(Genres::class, 'Movies_Genres', 'movie_id', 'genre_id');
    }
}
