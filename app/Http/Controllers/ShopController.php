<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentCategory;
use App\Services\CategoryService;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;

class ShopController extends Controller
{
    protected $categoryService;

    // Inject CategoryService vào controller
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        $parentCategories = ParentCategory::with('categories')->get(); // Lấy danh sách ParentCategory và các Category con
        $data = $this->categoryService->getAllCategoriesData();
        $categories = Category::withCount('products')->get();
        $products = Product::take(9)->get();
        return view('user.shops.danh-sach-san-pham', compact('parentCategories', 'categories', 'products'), $data);
    }

    // Hiển thị chi tiết sản phẩm
    public function show($slug)
    {
        $parentCategories = ParentCategory::with('categories')->get();
        $data = $this->categoryService->getAllCategoriesData();
        $categories = Category::withCount('products')->get();

        // Lấy sản phẩm dựa trên slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Lấy danh sách sizes của sản phẩm
        $sizes = $product->sizes; // Sử dụng quan hệ đã định nghĩa trong model Product

        // // Debug danh sách sizes
        // dd($sizes); // Kiểm tra xem có lấy được sizes không

        return view('user.shops.chi-tiet-san-pham', $data, compact('product', 'parentCategories', 'categories', 'sizes'));
    }
}
