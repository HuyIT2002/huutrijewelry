<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $pageTitle = 'Trang Chủ'; // Tiêu đề động của trang
        return view('admin.content.main', compact('pageTitle'));
    }
}
