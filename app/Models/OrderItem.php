<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $primaryKey = 'order_item_id';
    protected $fillable = [
        'order_id',
        'product_id',
        'size_id',
        'quantity',
        'price',
    ];

    // Quan hệ với bảng `orders`
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Quan hệ với bảng `products`
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Quan hệ với bảng `sizes`
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
