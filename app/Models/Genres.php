<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
    use HasFactory;
    protected $table = 'genres';
    protected $fillable = ['genre_id', 'name'];
    protected $primaryKey = 'genre_id';

    public function Movies()
    {
        return $this->belongsToMany(Movies::class, 'Movies_Genres', 'genre_id', 'movie_id');
    }
}
