<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $primaryKey = 'category_id'; // Khóa chính
    protected $fillable = [
        'parent_categorie_id',
        'category_name',
        'slug',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];

    // Liên kết với danh mục cha
    // Model Category
    // Trong model Category
    public $timestamps = false;
    public function parentCategory()
    {
        return $this->belongsTo(ParentCategory::class, 'parent_categorie_id');
    }
}
