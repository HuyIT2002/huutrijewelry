<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;
    // Xác định bảng sử dụng trong model
    protected $table = 'category_posts';

    // Xác định khóa chính (nếu không phải là id mặc định)
    protected $primaryKey = 'category_posts_id';

    // Cho phép mass assignment với các trường
    protected $fillable = [
        'name',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];

    // Tắt auto timestamps vì đã định nghĩa riêng created_at và updated_at
    public $timestamps = false;
}
