<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CategoryPost;
use App\Models\ParentCategory;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // Lấy tất cả sản phẩm từ bảng gold_products
        $products = Product::with('category')->get();
        $category = Category::all();
        // Truyền dữ liệu vào view
        $pageTitle = 'Danh sách sản phẩm';
        return view('admin.products.trang-quan-ly-san-pham', compact('pageTitle', 'products', 'category'));
    }
    public function create()
    {
        // Lấy tất cả danh mục cha và các danh mục con của chúng
        $parentCategories = ParentCategory::with('categories')->get();

        $pageTitle = 'Tạo mới sản phẩm mới';

        // Trả về view với dữ liệu đã lấy
        return view('admin.products.create', compact('pageTitle', 'parentCategories'));
    }
    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'product_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'code_id' => 'required|string|max:255|unique:products',
            'price' => 'required|numeric',
            'so_luong' => 'required|integer',
            'trong_luong' => 'required|string|max:255',
            'ham_chat_lieu' => 'required|string|max:255',
            'loai_da_chinh' => 'required|string|max:255',
            'kich_thuoc_da' => 'required|string|max:255',
            'mau_da_chinh' => 'required|string|max:255',
            'hinh_dang_da' => 'required|string|max:255',
            'sl_da_chinh' => 'required|integer',
            'sl_da_phu' => 'required|integer',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,category_id',
            'description' => 'nullable|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images/products'), $imageName);
        } else {
            $imageName = null;  // If no image is uploaded, set it to null
        }

        // Create a new product record
        $product = new Product([
            'product_name' => $request->input('product_name'),
            'slug' => $request->input('slug'),
            'code_id' => $request->input('code_id'),
            'price' => $request->input('price'),
            'trong_luong' => $request->input('trong_luong'),
            'ham_chat_lieu' => $request->input('ham_chat_lieu'),
            'loai_da_chinh' => $request->input('loai_da_chinh'),
            'kich_thuoc_da' => $request->input('kich_thuoc_da'),
            'mau_da_chinh' => $request->input('mau_da_chinh'),
            'hinh_dang_da' => $request->input('hinh_dang_da'),
            'sl_da_chinh' => $request->input('sl_da_chinh'),
            'so_luong' => $request->input('so_luong'),
            'sl_da_phu' => $request->input('sl_da_phu'),
            'status' => $request->input('status', 1),  // Đảm bảo có giá trị mặc định nếu không có trong request
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'images' => $imageName, // Lưu tên ảnh vào cơ sở dữ liệu
            'created_at' => now(),
        ]);

        $product->save();;

        // Return success message
        return redirect()->route('admin.products.create')->with('success', 'Sản phẩm đã được tạo thành công');
    }
    public function destroy($products_id)
    {
        // Tìm sản phẩm cần xóa
        $product = Product::find($products_id);

        // Kiểm tra sản phẩm có tồn tại
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại.');
        }

        // Xóa ảnh trong thư mục nếu có
        if ($product->images && file_exists(public_path('admin/images/products/' . $product->images))) {
            unlink(public_path('admin/images/products/' . $product->images));
        }

        // Xóa sản phẩm khỏi cơ sở dữ liệu
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
    public function edit($products_id)
    {
        // Lấy tất cả danh mục cha và các danh mục con của chúng
        $parentCategories = ParentCategory::with('categories')->get();

        $pageTitle = 'Sửa sản phẩm mới';
        $products = Product::findOrFail($products_id);
        return view('admin.products.edit', compact('products', 'pageTitle', 'parentCategories'));
    }
    public function update(Request $request, $products_id)
    {
        // Lấy sản phẩm cần cập nhật
        $product = Product::findOrFail($products_id);

        // Validate các trường đầu vào
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'code_id' => 'required|string|max:255',
            'so_luong' => 'required|integer',
            'price' => 'required|numeric',
            'trong_luong' => 'required|string',
            'ham_chat_lieu' => 'required|string',
            'loai_da_chinh' => 'required|string',
            'kich_thuoc_da' => 'required|string',
            'mau_da_chinh' => 'required|string',
            'hinh_dang_da' => 'required|string',
            'sl_da_chinh' => 'required|numeric',
            'sl_da_phu' => 'required|numeric',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,category_id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Cập nhật thông tin sản phẩm
        $product->product_name = $request->input('product_name');
        $product->slug = $request->input('slug');
        $product->code_id = $request->input('code_id');
        $product->price = $request->input('price');
        $product->trong_luong = $request->input('trong_luong');
        $product->ham_chat_lieu = $request->input('ham_chat_lieu');
        $product->loai_da_chinh = $request->input('loai_da_chinh');
        $product->kich_thuoc_da = $request->input('kich_thuoc_da');
        $product->mau_da_chinh = $request->input('mau_da_chinh');
        $product->hinh_dang_da = $request->input('hinh_dang_da');
        $product->sl_da_chinh = $request->input('sl_da_chinh');
        $product->sl_da_phu = $request->input('sl_da_phu');
        $product->so_luong = $request->input('so_luong');
        $product->status = $request->input('status');
        $product->category_id = $request->input('category_id');
        $product->description = $request->input('description');

        // Xử lý ảnh nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->images && file_exists(public_path('admin/images/products/' . $product->images))) {
                unlink(public_path('admin/images/products/' . $product->images)); // Xóa ảnh cũ
            }

            // Lưu ảnh mới
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images/products'), $imageName); // Di chuyển ảnh vào thư mục public

            // Cập nhật tên ảnh vào cơ sở dữ liệu
            $product->images = $imageName;
            $product->save(); // Lưu thông tin vào cơ sở dữ liệu
        }


        // Cập nhật trường updated_at
        $product->updated_at = now();

        // Lưu sản phẩm
        $product->save();

        // Trả về thông báo thành công
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }
    public function updateStatus($products_id)
    {
        // Tìm bài viết theo ID
        $post = Product::findOrFail($products_id);

        // Chuyển đổi trạng thái bài viết (nếu đang là 1 thì chuyển thành 0, ngược lại)
        $post->status = ($post->status == 1) ? 0 : 1;

        // Lưu thay đổi
        $post->save();

        // Quay lại trang danh sách bài viết với thông báo thành công
        return redirect()->route('admin.products.index')->with('success', 'Trạng thái bài viết đã được cập nhật.');
    }
}
