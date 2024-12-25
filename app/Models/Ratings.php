<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;
    protected $table = 'Ratings';
    protected $fillable = ['user_id', 'submovie_id', 'rating', 'date_rated'];
    public $timestamps = false;
}
