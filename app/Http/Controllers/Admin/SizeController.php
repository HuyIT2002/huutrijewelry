<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    // Hiển thị danh sách size
    public function index()
    {
        $sizes = Size::with('goldProduct')->paginate(10);
        $pageTitle = 'Danh sách size';
        return view('admin.size.danh-sach-size', compact('sizes', 'pageTitle'));
    }

    // Hiển thị form thêm mới size
    public function create()
    {
        $products = Product::all();
        $pageTitle = 'Thêm mới size cho sản phẩm';
        return view('admin.size.create', compact('products', 'pageTitle'));
    }

    // Xử lý thêm mới size
    public function store(Request $request)
    {
        $request->validate([
            'products_id' => 'required|exists:products,products_id',
            'size' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        // Thêm created_at là thời gian hiện tại
        Size::create(array_merge($request->all(), [
            'created_at' => now(),
        ]));

        return redirect()->route('admin.size.create')->with('success', 'Thêm size thành công!');
    }


    // Hiển thị form chỉnh sửa size
    public function edit($size_id)
    {
        $size = Size::findOrFail($size_id);
        $products = Product::all();
        $pageTitle = 'Sửas size cho sản phẩm';
        return view('admin.size.edit', compact('size', 'pageTitle', 'products'));
    }

    // Xử lý chỉnh sửa size
    public function update(Request $request, $size_id)
    {
        $request->validate([
            'products_id' => 'required|exists:products,products_id',
            'size' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $size = Size::findOrFail($size_id);
        $size->update($request->all());
        return redirect()->route('admin.size.index')->with('success', 'Cập nhật size thành công!');
    }
    public function updateStatus($size_id)
    {
        // Tìm bài viết theo ID
        $size = Size::findOrFail($size_id);

        // Chuyển đổi trạng thái bài viết (nếu đang là 1 thì chuyển thành 0, ngược lại)
        $size->status = ($size->status == 1) ? 0 : 1;

        // Lưu thay đổi
        $size->save();

        // Quay lại trang danh sách bài viết với thông báo thành công
        return redirect()->route('admin.size.index')->with('success', 'Trạng thái bài viết đã được cập nhật.');
    }
    public function destroy($size_id)
    {
        // Xóa category post
        $size = Size::findOrFail($size_id);
        $size->delete();
        return redirect()->route('admin.size.index')->with('success', 'Xóa size thành công!');
    }
}
