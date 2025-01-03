<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table = 'sizes';

    // Đặt tên khóa chính
    protected $primaryKey = 'size_id';

    // Chỉ định các thuộc tính có thể được gán đại trà
    protected $fillable = [
        'products_id', // ID của sản phẩm vàng (liên kết với bảng gold_products)
        'size', // Kích thước của sản phẩm
        'status',
        'created_at',
        'updated_at',
    ];

    // Quan hệ với bảng gold_products (một size thuộc về một sản phẩm vàng)
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
}
