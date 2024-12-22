<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite_Movies extends Model
{
    use HasFactory;
    protected $table = 'Favorite_Movies';
    protected $fillable = ['user_id', 'submovie_id', 'date_added'];
    protected $primaryKey = 'favorite_id';
    public $timestamps = false;
}
