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
        $parentCategories = ParentCategory::with('categories')->get();
        $categories = Category::withCount(['products' => function ($query) {
            $query->where('status', 1); // Đếm sản phẩm có status = 1
        }])->get();
        $products = Product::paginate(9);
        $data = $this->categoryService->getAllCategoriesData();
        $data = array_merge($data, compact('parentCategories', 'categories', 'products'));

        return view('user.shops.danh-sach-san-pham', $data);
    }


    // Hiển thị chi tiết sản phẩm
    public function show($slug, $products_id = null)
    {
        $parentCategories = ParentCategory::with('categories')->get(); // Danh mục cha
        $data = $this->categoryService->getAllCategoriesData(); // Thông tin bổ sung
        $categories = Category::withCount('products')->get(); // Đếm số lượng sản phẩm trong từng danh mục

        // Lấy sản phẩm dựa trên slug và products_id
        $product = Product::where('slug', $slug)
            ->when($products_id, function ($query, $products_id) {
                return $query->where('products_id', $products_id); // Thêm điều kiện products_id nếu có
            })
            ->firstOrFail(); // Trả về 404 nếu không tìm thấy

        // Lấy danh sách sizes của sản phẩm nếu có quan hệ sizes đã khai báo
        $sizes = $product->sizes ?? collect(); // Nếu không có quan hệ sizes, trả về collection rỗng để tránh lỗi

        // Truyền toàn bộ dữ liệu đến view
        $data = array_merge($data, [
            'product' => $product,
            'parentCategories' => $parentCategories,
            'categories' => $categories,
            'sizes' => $sizes,
        ]);

        return view('user.shops.chi-tiet-san-pham', $data);
    }


    // public function showCategoryProducts($slug)
    // {
    //     // Lấy danh mục theo slug
    //     $category = Category::where('slug', $slug)->firstOrFail();

    //     // Lấy danh sách sản phẩm thuộc danh mục đó
    //     $products = Product::where('category_id', $category->id)
    //         ->where('status', 1) // Chỉ lấy sản phẩm đã kích hoạt
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(9); // Phân trang mỗi trang 12 sản phẩm
    //     $parentCategories = ParentCategory::with('categories')->get(); // Lấy danh sách ParentCategory và các Category con
    //     $data = $this->categoryService->getAllCategoriesData();
    //     $categories = Category::withCount('products')->get();
    //     return view('user.shops.search-products', $data, compact('category', 'parentCategories', 'categories', 'products'));
    // }
    public function showCategoryProducts($slug)
    {
        // Lấy danh mục theo slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Lấy danh sách sản phẩm thuộc danh mục
        $products = Product::where('category_id', $category->category_id) // Sử dụng category_id thay vì id
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        $parentCategories = ParentCategory::with('categories')->get();
        $categories = Category::withCount(['products' => function ($query) {
            $query->where('status', 1); // Chỉ đếm sản phẩm đã kích hoạt
        }])->get();
        $data = $this->categoryService->getAllCategoriesData();

        $data = array_merge($data, [
            'category' => $category,
            'products' => $products,
            'parentCategories' => $parentCategories,
            'categories' => $categories,
        ]);

        return view('user.shops.search-products', $data);
    }
}
