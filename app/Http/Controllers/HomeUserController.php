<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentCategory;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
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
        // Lấy dữ liệu danh mục và sản phẩm
        $data = $this->categoryService->getAllCategoriesData();
        $parentCategories = ParentCategory::with('categories')->get();
        $categories = Category::withCount(['products' => function ($query) {
            $query->where('status', 1); // Chỉ đếm sản phẩm đã kích hoạt
        }])->get();
        $products = Product::all();

        // Gộp dữ liệu vào mảng $data
        $data['parentCategories'] = $parentCategories;
        $data['categories'] = $categories;
        $data['products'] = $products;

        // Lấy danh sách bài viết có phân trang
        $data['posts'] = Post::orderBy('created_at', 'desc')->paginate(6);

        // Lấy danh sách sản phẩm mới nhất
        $data['latestProducts'] = Product::orderBy('created_at', 'desc')->take(10)->get();  // 10 sản phẩm mới nhất

        // Truyền tất cả dữ liệu tới view
        return view('user.home.home', $data);
    }
}
