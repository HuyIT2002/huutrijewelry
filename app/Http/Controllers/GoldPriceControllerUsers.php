<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoldPrice;

class GoldPriceControllerUsers extends Controller
{
    public function index()
    {
        // Lấy danh sách giá vàng từ database
        $goldPrices = GoldPrice::where('status', 1)->get(); // Chỉ hiển thị giá vàng hoạt động

        // Truyền dữ liệu sang view
        return view('user.gold-prices.gia-vang-hom-nay', compact('goldPrices'));
    }
}
