<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{
    use HasFactory;
    protected $table = 'Episodes';
    protected $fillable = ['submovie_id, episode_number, duration, url'];
    protected $primaryKey = 'episode_id';

    public function SubMovie(){
        return $this->belongsTo(SubMovies::class, 'submovie_id');
    }
}
