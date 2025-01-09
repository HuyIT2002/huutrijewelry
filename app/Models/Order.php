<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'member_id',
        'receiver_name',
        'receiver_phone',
        'receiver_email',
        'shipping_address',
        'total_price',
        'status',
        'paymentmethod',
        'created_at',
        'updated_at'
    ];
    public $timestamps = false;
    // Quan hệ với bảng `members`
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    // Quan hệ với bảng `order_items`
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id'); // Khớp đúng cột `order_id` trong `order_items`
    }
}
