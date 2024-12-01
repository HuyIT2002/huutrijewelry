<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoldPrice extends Model
{
    protected $table = 'gold_prices'; // Tên bảng
    protected $primaryKey = 'gold_prices_id'; // Cột khóa chính
    public $incrementing = true; // Nếu khóa chính tự tăng
    protected $keyType = 'int'; // Kiểu dữ liệu của khóa chính

    protected $fillable = ['mua_vao', 'ban_ra', 'don_vi', 'type', 'status', 'created_at', 'updated_at'];
    public $timestamps = false; // Nếu sử dụng các cột `created_at` và `updated_at`
}
