<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;
    protected $table = "movies";
    protected $fillable = ['title, nation'];
    protected $primaryKey = 'movie_id';
    public $timestamps = false;

    public function Genres()
    {
        return $this->belongsToMany(Genres::class, 'Movies_Genres', 'movie_id', 'genre_id');
    }
    public function SubMovies(){
        return $this->hasMany(SubMovies::class, 'movie_id');
    }
}
