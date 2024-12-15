<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts'; // Tên bảng
    protected $primaryKey = 'posts_id';
    protected $fillable = [
        'title',
        'content',
        'slug',
        'status',
        'category_posts_id',
        'images',
        'created_at',
        'updated_at',
    ];
    public $timestamps = false;
    // Mối quan hệ với CategoryPost
    public function categoryPost()
    {
        return $this->belongsTo(CategoryPost::class, 'category_posts_id', 'category_posts_id');
    }
}
