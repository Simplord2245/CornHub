<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watch_History extends Model
{
    use HasFactory;
    protected $table = 'Watch_History';
    protected $fillable = ['user_id', 'movie_id', 'last_watched_episode_id', 'watch_date'];
    public $timestamps = false;
}
