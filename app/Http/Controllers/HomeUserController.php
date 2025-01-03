<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentCategory;
use App\Models\Category;
use App\Services\CategoryService;

class HomeUserController extends Controller
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
        // Lấy tất cả các dữ liệu danh mục từ service
        $data = $this->categoryService->getAllCategoriesData();

        // Truyền dữ liệu tới view
        return view('user.home.home', $data);
    }
}
