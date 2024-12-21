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
        'gold_product_id', // ID của sản phẩm vàng (liên kết với bảng gold_products)
        'size', // Kích thước của sản phẩm
        'created_at',
        'updated_at',
    ];

    // Quan hệ với bảng gold_products (một size thuộc về một sản phẩm vàng)
    public function goldProduct()
    {
        return $this->belongsTo(GoldProduct::class, 'gold_product_id', 'gold_products_id');
    }
}
