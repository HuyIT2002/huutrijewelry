<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements Authenticatable
{
    use HasFactory;

    // Đảm bảo bạn đã khai báo các thuộc tính cần thiết trong model này
    protected $primaryKey = 'admin_id'; // Nếu bạn sử dụng khóa chính khác ngoài 'id'

    protected $fillable = ['username', 'email', 'password', 'role_id', 'admin_image', 'status', 'created_at', 'updated_at'];

    /**
     * Get the unique identifier for the user.
     */
    public function getAuthIdentifierName()
    {
        return 'admin_id'; // Tên trường khóa chính
    }

    /**
     * Get the unique identifier for the user.
     */
    public function getAuthIdentifier()
    {
        return $this->admin_id; // Giá trị khóa chính
    }

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->password; // Trả về mật khẩu đã mã hóa
    }

    /**
     * Get the "remember me" token value.
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the "remember me" token value.
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column that should be used for the "remember me" token.
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }
    // Trong App\Models\Admin.php
    // Admin Model
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');  // Chắc chắn quan hệ với trường roles_id
    }
}
