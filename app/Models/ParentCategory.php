<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentCategory extends Model
{
    use HasFactory;
    protected $table = 'parent_categories'; // Tên bảng
    protected $primaryKey = 'parent_categorie_id'; // Khóa chính
    public $timestamps = false; // Không dùng cột `timestamps`

    // Các cột được phép gán giá trị
    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at',
    ];
    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_categorie_id', 'parent_categorie_id');
    }
    public function goldProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
