<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'Comments';
    protected $fillable = ['user_id', 'submovie_id', 'comment', 'date_commented'];
    public $timestamps = false;
}
