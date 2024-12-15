<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //
    public function index()
    {
        $pageTitle = 'Bài viết';
        $posts = Post::all();
        return view('admin.posts.danh-sach-bai-viet', compact('posts', 'pageTitle')); // Truyền cả categories và posts vào view
    }

    public function create()
    {
        // Lấy tất cả danh mục cha từ bảng parent_categories
        $categoryPost = CategoryPost::all();
        $pageTitle = 'Tạo mới bài viết';
        // Trả về view với dữ liệu đã lấy
        return view('admin.posts.create', compact('categoryPost', 'pageTitle'));
    }
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'category_posts_id' => 'required|exists:category_posts,category_posts_id',
            'content' => 'required',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000', // Validation cho ảnh
        ]);

        // Xử lý ảnh nếu có
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Đặt tên ảnh
            // Di chuyển ảnh vào thư mục public/admin/images/post
            $image->move(public_path('admin/images/post'), $imageName);
        } else {
            $imageName = null;
        }

        // Tạo một bản ghi mới cho bài viết
        Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'status' => $request->status,
            'description' => $request->description,
            'category_posts_id' => $request->category_posts_id,
            'content' => $request->content,
            'images' => $imageName, // Lưu đường dẫn ảnh vào cơ sở dữ liệu
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        // Redirect về danh sách bài viết với thông báo thành công
        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được tạo thành công.');
    }


    public function updateStatus($posts_id)
    {
        // Tìm bài viết theo ID
        $post = Post::findOrFail($posts_id);

        // Chuyển đổi trạng thái bài viết (nếu đang là 1 thì chuyển thành 0, ngược lại)
        $post->status = ($post->status == 1) ? 0 : 1;

        // Lưu thay đổi
        $post->save();

        // Quay lại trang danh sách bài viết với thông báo thành công
        return redirect()->route('admin.posts.index')->with('success', 'Trạng thái bài viết đã được cập nhật.');
    }
    public function destroy($posts_id)
    {
        // Tìm bài viết theo ID
        $post = Post::findOrFail($posts_id);

        // Xóa bài viết
        $post->delete();

        // Quay lại trang danh sách bài viết với thông báo thành công
        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được xóa thành công.');
    }

    public function edit($posts_id)
    {
        // Tìm bài viết theo ID
        $pageTitle = 'Chỉnh sửa bài viết';
        $post = Post::findOrFail($posts_id);
        $categoryPost = CategoryPost::all(); // Lấy tất cả danh mục bài viết

        return view('admin.posts.edit', compact('post', 'categoryPost', 'pageTitle'));
    }

    public function update(Request $request, $posts_id)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug,' . $posts_id . ',posts_id',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'category_posts_id' => 'required|exists:category_posts,category_posts_id',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate ảnh
        ]);

        // Tìm và cập nhật bài viết
        $post = Post::findOrFail($posts_id);

        // Xử lý ảnh (nếu có ảnh mới)
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($post->images) {
                $oldImagePath = public_path('admin/images/post/' . $post->images);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Lưu ảnh mới
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/images/post'), $imageName);
        } else {
            // Nếu không tải ảnh mới, giữ ảnh cũ
            $imageName = $post->images;
        }

        // Cập nhật thông tin bài viết
        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'status' => $request->status,
            'description' => $request->description,
            'category_posts_id' => $request->category_posts_id,
            'content' => $request->content,
            'images' => $imageName, // Cập nhật ảnh
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        // Quay lại trang danh sách bài viết với thông báo thành công
        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    public function show($posts_id)
    {
        $post = Post::findOrFail($posts_id); // Lấy bài viết theo ID
        return view('admin.posts.show', compact('post')); // Trả về view chi tiết bài viết
    }
}
