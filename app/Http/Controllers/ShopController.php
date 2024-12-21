<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        return view('user.shops.danh-sach-san-pham'); // shops/shop.blade.php
    }

    // Hiển thị chi tiết sản phẩm
    public function show($slug)
    {
        return view('user.shops.chi-tiet-san-pham', ['slug' => $slug]); // shops/detail.blade.php
    }
}
