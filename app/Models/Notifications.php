<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $table = 'Notification';
    protected $fillable = ['user_id', 'message', 'date_sent', 'is_read'];
    protected $primaryKey = 'notification_id';
    public $timestamps = false;
}
