<?php
namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model implements Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'full_name', 'email', 'username', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Nếu sử dụng timestamps
    public $timestamps = false;

    // Các phương thức cần thiết cho Authenticatable
    public function getAuthIdentifierName()
    {
        return 'user_id'; // Trả về tên cột khóa chính (ID)
    }

    public function getAuthIdentifier()
    {
        return $this->getKey(); // Trả về khóa chính
    }

    public function getAuthPassword()
    {
        return $this->password; // Trả về mật khẩu
    }

    // Cài đặt các phương thức cho remember_token
    public function getRememberToken()
    {
        return $this->remember_token; // Trả về giá trị remember_token
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value; // Cập nhật giá trị remember_token
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // Tên cột cho remember_token
    }
}
?>