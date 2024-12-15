<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMovies extends Model
{
    use HasFactory;
    protected $table = 'SubMovies';
    protected $fillable = ['movie_id, submovie_title, submovie_description, release_year, image, trailer_url'];
    protected $primaryKey = 'submovie_id';
    public $timestamps = false;

    public function Movie(){
        return $this->belongsTo(Movies::class, 'movie_id');
    }
    public function Episodes(){
        return $this->hasMany(Episodes::class, 'submovie_id');
    }
}
