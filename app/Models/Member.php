<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $primaryKey = 'member_id';

    // Các thuộc tính có thể được gán đại trà (mass assignment)
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status',
        'images',
        'address',
        'role_id',
        'created_at',
        'updated_at'
    ];

    // Cài đặt timestamps nếu không dùng tự động của Laravel
    public $timestamps = false; // Đặt false nếu không sử dụng timestamps mặc định

    // Quan hệ với bảng `roles`
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id'); // Liên kết với bảng `roles`
    }
}
