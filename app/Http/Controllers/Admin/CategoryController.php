<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ParentCategory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function index()
    {
        // Lấy 10 danh mục mỗi trang
        $categories = Category::paginate(9);
        $pageTitle = 'Danh mục con';
        // Truyền biến $categories vào view
        return view('admin.categories.danh-muc-san-pham', compact('categories', 'pageTitle'));
    }

    // Hiển thị form tạo mới danh mục
    public function create()
    {
        // Lấy tất cả danh mục cha từ bảng parent_categories
        $categoryPost = ParentCategory::all();
        $parentCategories = ParentCategory::all();
        $pageTitle = 'Tạo mới danh mục con';
        // Trả về view với dữ liệu đã lấy
        return view('admin.categories.create', compact('pageTitle', 'parentCategories'));
    }

    // Lưu danh mục mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'category_name' => 'required',
            'slug' => 'required',
            'description' => 'nullable|string',
            'parent_categorie_id' => 'nullable|exists:parent_categories,parent_categorie_id', // Kiểm tra bảng parent_categories
            'status' => 'required|in:Hiển thị,Không hiển thị',
        ]);

        // Kiểm tra giá trị của parent_categorie_id
        $parentCategory = $request->parent_categorie_id ? $request->parent_categorie_id : null;

        // Tạo danh mục mới
        $category = Category::create([
            'category_name' => $request->category_name,
            'slug' => $request->slug,
            'description' => $request->description,
            'parent_categorie_id' => $request->parent_categorie_id,
            'status' => $request->status === 'Hiển thị' ? 1 : 0,
        ]);

        // Đặt lại giá trị của updated_at nếu cần
        $category->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $category->save();


        // Chuyển hướng sau khi thành công
        return redirect()->route('admin.categories.create')
            ->with('success', 'Danh mục mới đã được thêm thành công.');
    }

    public function updateStatus($category_id)
    {
        $category = Category::find($category_id); // Kiểm tra chính xác Model bạn đang dùng

        if ($category) {
            // Toggle the status
            $category->status = $category->status == 1 ? 0 : 1;
            $category->save();

            return redirect()->route('admin.categories.index')->with('success', 'Trạng thái danh mục đã được cập nhật!');
        }

        return redirect()->route('admin.categories.index')->with('error', 'Danh mục không tồn tại!');
    }

    public function destroy($category_id)
    {
        $category = Category::find($category_id);

        if (!$category) {
            return redirect()->route('admin.categories.index')->with('error', 'Danh mục không tồn tại!');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được xóa thành công!');
    }

    public function edit($category_id)
    {
        // Tìm danh mục theo ID
        $category = Category::findOrFail($category_id);
        $pageTitle = 'Chỉnh sửa danh mục con';
        // Lấy tất cả các danh mục cha
        $parentCategories = ParentCategory::all();

        // Trả về trang sửa danh mục cùng với thông tin danh mục và danh mục cha
        return view('admin.categories.edit', compact('category', 'parentCategories', 'pageTitle'));
    }
    public function update(Request $request, $category_id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'category_name' => 'required',
            'slug' => 'required',
            'status' => 'required|in:Hiển thị,Không hiển thị',
            'parent_categorie_id' => 'nullable|exists:parent_categories,parent_categorie_id',
            'description' => 'nullable|string',
        ]);

        // Tìm danh mục theo ID
        $category = Category::findOrFail($category_id);

        // Cập nhật dữ liệu
        $category->update([
            'category_name' => $request->category_name,
            'slug' => $request->slug,
            'description' => $request->description,
            'parent_categorie_id' => $request->parent_categorie_id,
            'status' => $request->status === 'Hiển thị' ? 1 : 0,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        // Chuyển hướng về trang danh sách danh mục với thông báo thành công
        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được cập nhật!');
    }
}
