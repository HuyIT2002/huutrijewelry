<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'products';

    // Khóa chính của bảng
    protected $primaryKey = 'products_id';


    // Các trường được phép gán giá trị (Mass Assignment)
    protected $fillable = [
        'product_name',
        'images',
        'code_id',
        'so_luong',
        'slug',
        'price',
        'trong_luong',
        'ham_chat_lieu',
        'created_at',
        'updated_at',
        'loai_da_chinh',
        'kich_thuoc_da',
        'mau_da_chinh',
        'hinh_dang_da',
        'sl_da_chinh',
        'sl_da_phu',
        'status',
        'description',
        'category_id',

    ];

    // Các trường tự động quản lý ngày tháng
    public $timestamps = false;

    // Định nghĩa mối quan hệ với bảng parent_categories

    public function sizes()
    {
        return $this->hasMany(Size::class, 'gold_product_id', 'gold_products_id');
    }
    // Model Product (App\Models\Product)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
