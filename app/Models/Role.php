<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Tên bảng nếu khác tên mặc định (plural của tên model)
    protected $table = 'roles';
    protected $primaryKey = 'roles_id'; // Cột khóa chính
    // Các trường có thể gán (mass assignable)
    protected $fillable = ['name', 'type', 'description', 'status', 'created_at', 'updated_at'];

    // Nếu không sử dụng timestamps, bạn có thể tắt nó bằng cách:
    // public $timestamps = false;
}
