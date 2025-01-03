<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;

class ServiceController extends Controller
{
    //
    protected $categoryService;

    // Inject CategoryService vào controller
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        // Truyền dữ liệu cho view danh sách dịch vụ (nếu có)
        $data = $this->categoryService->getAllCategoriesData();
        return view('user.dichvu.dichvu', $data);
    }

    // Phương thức hiển thị chính sách bảo hành
    public function warrantyPolicy()
    {
        // Truyền dữ liệu cho view chính sách bảo hành (nếu có)
        $data = $this->categoryService->getAllCategoriesData();
        return view('user.dichvu.chinh-sach-bao-hanh', $data);
    }

    public function doSizeNhan()
    {
        // Trả về view do-size
        $data = $this->categoryService->getAllCategoriesData();
        return view('user.dichvu.do-size', $data);
    }
    public function doSizeDayChuyen()
    {
        $data = $this->categoryService->getAllCategoriesData();
        return view('user.dichvu.do-size-day-chuyen', $data); // Đảm bảo rằng view này đã được tạo
    }
    public function showDoSizeLacVong()
    {
        $data = $this->categoryService->getAllCategoriesData();
        return view('user.dichvu.do-size-lac-vong', $data);
    }
}
