<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watch_History extends Model
{
    use HasFactory;
    protected $table = 'Watch_History';
    protected $fillable = ['user_id', 'movie_id'];
    protected $primaryKey = 'watch_id';
    public $timestamps = false;
}
