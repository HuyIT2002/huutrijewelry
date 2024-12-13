<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryPost;
use Carbon\Carbon;

class CategoryPostController extends Controller
{
    //

    public function index()
    {
        $categories = CategoryPost::all(); // Lấy danh mục kèm theo danh mục cha nếu có
        return view('admin.category-posts.danh-muc-bai-viet', compact('categories'));
    }
    // Hiển thị form tạo mới
    public function create()
    {
        return view('admin.category-posts.create'); // Chỉ ra view tạo mới
    }

    // Lưu danh mục mới
    public function store(Request $request)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'name' => 'required|string|max:255|unique:category_posts,name',
            'slug' => 'required|string|max:255|unique:category_posts,slug',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        // Tạo mới danh mục
        $categoryPost = new CategoryPost();
        $categoryPost->name = $request->name;
        $categoryPost->slug = $request->slug;
        $categoryPost->description = $request->description;
        $categoryPost->status = $request->status;
        $categoryPost->created_at = now();
        $categoryPost->save();

        // Trả về thông báo thành công và chuyển hướng
        return redirect()->route('admin.category-posts.create')->with('success', 'Danh mục bài viết đã được tạo thành công!');
    }
    public function destroy($category_post_id)
    {
        // Xóa category post
        $category = CategoryPost::findOrFail($category_post_id);
        $category->delete();
        return redirect()->route('admin.category-posts.index');
    }

    public function updateStatus($category_post_id)
    {
        // Cập nhật trạng thái category post
        $category = CategoryPost::findOrFail($category_post_id);
        $category->status = !$category->status;
        $category->save();
        return redirect()->route('admin.category-posts.index');
    }
    public function edit($category_post_id)
    {
        // Lấy dữ liệu để sửa category post
        $category = CategoryPost::findOrFail($category_post_id);
        return view('admin.category-posts.edit', compact('category'));
    }
    public function update(Request $request, $category_post_id)
    {
        // Validate dữ liệu đầu vào
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'status' => 'required|in:0,1', // Chỉ nhận giá trị 0 hoặc 1
            'description' => 'nullable|string',
        ]);

        // Chuyển đổi trạng thái thành số (1 cho Hiển thị, 0 cho Không hiển thị)
        $status = $validated['status'];

        // Tìm danh mục bài viết theo ID
        $categoryPost = CategoryPost::findOrFail($category_post_id);

        // Cập nhật dữ liệu
        $categoryPost->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'],
            'status' => $status, // Trạng thái đã được gửi đúng kiểu
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'), // Cập nhật thời gian sửa
        ]);

        // Chuyển hướng về trang danh sách bài viết với thông báo thành công
        return redirect()->route('admin.category-posts.index')->with('success', 'Danh mục bài viết đã được cập nhật!');
    }
}
