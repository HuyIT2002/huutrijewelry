<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentCategory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ParentCategoryController extends Controller
{
    //
    public function index()
    {
        $parentCategories = ParentCategory::all();
        return view('admin.parent-categories.danh-muc-cha', compact('parentCategories'));
    }
    public function create()
    {
        return view('admin.parent-categories.create');
    }
    public function store(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:parent_categories,name',
            'status' => 'required|in:Hiển thị,Không hiển thị', // Kiểm tra giá trị status phải là boolean (0 hoặc 1)
        ]);

        // Tạo slug tự động từ tên (tên có dấu sẽ bị loại bỏ và thay thế bằng dấu gạch ngang)
        $slug = Str::slug($validatedData['name']);

        // Chuyển đổi 'Hiển thị' thành 1, 'Không hiển thị' thành 0
        // Nếu giá trị status là true (Hiển thị), sẽ là 1, ngược lại sẽ là 0 (Không hiển thị)
        $status = $validatedData['status'] == 'Hiển thị' ? 1 : 0;

        // Tạo mới danh mục cha
        $parentCategory = new ParentCategory();
        $parentCategory->name = $validatedData['name'];
        $parentCategory->slug = $slug;  // Đặt slug đã tạo vào trường slug
        $parentCategory->status = $status; // Đặt giá trị status là 1 hoặc 0
        $parentCategory->created_at = now();
        $parentCategory->save(); // Lưu vào cơ sở dữ liệu

        // Redirect về trang danh sách với thông báo thành công
        return redirect()->route('admin.parent-categories.create')
            ->with('success', 'Danh mục cha đã được tạo thành công!');
    }

    public function updateStatus($id)
    {
        $category = ParentCategory::find($id);

        if ($category) {
            // Toggle the status
            $category->status = $category->status == 1 ? 0 : 1;
            $category->save();

            return redirect()->route('admin.parent-categories.index')->with('success', 'Trạng thái danh mục đã được cập nhật!');
        }

        return redirect()->route('admin.parent-categories.index')->with('error', 'Danh mục không tồn tại!');
    }
    public function destroy($parent_categorie_id)
    {
        $category = ParentCategory::find($parent_categorie_id);

        if ($category) {
            $category->delete(); // Delete the category

            return redirect()->route('admin.parent-categories.index')->with('success', 'Danh mục đã được xóa thành công!');
        }

        return redirect()->route('admin.parent-categories.index')->with('error', 'Danh mục không tồn tại!');
    }
    public function edit($parent_categorie_id)
    {
        // Lấy thông tin danh mục theo ID
        $category = ParentCategory::findOrFail($parent_categorie_id);

        // Trả về view 'edit' với dữ liệu của danh mục
        return view('admin.parent-categories.edit', compact('category'));
    }

    public function update(Request $request, $parent_categorie_id)
    {
        // Xác thực dữ liệu yêu cầu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'status' => 'required|in:Hiển thị,Không hiển thị',
        ]);

        // Chuyển đổi trạng thái thành số
        $status = $validated['status'] === 'Hiển thị' ? 1 : 0; // 1 = Hiển thị, 0 = Không hiển thị

        // Tìm kiếm danh mục cha cần cập nhật
        $parentCategory = ParentCategory::find($parent_categorie_id);

        // Kiểm tra nếu không tìm thấy danh mục
        if (!$parentCategory) {
            return redirect()->route('admin.parent-categories.index')->with('error', 'Danh mục không tồn tại.');
        }

        // Cập nhật dữ liệu vào cơ sở dữ liệu
        $parentCategory->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'status' => $status, // Lưu giá trị số
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'), // Cập nhật thời gian sửa
        ]);

        // Trả về thông báo thành công và quay lại danh sách
        return redirect()->route('admin.parent-categories.index')->with('success', 'Cập nhật danh mục cha thành công.');
    }
}
