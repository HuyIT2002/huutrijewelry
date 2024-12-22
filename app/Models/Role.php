<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles'; // Tên bảng nếu khác tên mặc định (plural của tên model)
    protected $primaryKey = 'role_id'; // Khóa chính của bảng `roles`

    protected $fillable = ['name', 'type', 'description', 'status', 'created_at', 'updated_at'];

    // Quan hệ với Admin
    public function admins()
    {
        return $this->hasMany(Admin::class, 'role_id', 'role_id');  // Đảm bảo quan hệ với trường `roles_id`
    }
}
