<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class PostController extends Controller
{
    //
    public function index()
    {

        $posts = Post::all();
        return view('admin.posts.danh-sach-bai-viet', compact('posts')); // Truyền cả categories và posts vào view
    }

    public function create()
    {
        // Lấy tất cả danh mục cha từ bảng parent_categories
        $categoryPost = CategoryPost::all();

        // Trả về view với dữ liệu đã lấy
        return view('admin.posts.create', compact('categoryPost'));
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
        ]);

        // Tạo một bản ghi mới cho bài viết
        Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'status' => $request->status,
            'description' => $request->description,
            'category_posts_id' => $request->category_posts_id,
            'content' => $request->content,
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
        $post = Post::findOrFail($posts_id);
        $categoryPost = CategoryPost::all(); // Lấy tất cả danh mục bài viết

        return view('admin.posts.edit', compact('post', 'categoryPost'));
    }

    public function update(Request $request, $posts_id)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug,' . $posts_id . ',posts_id', // Sửa lỗi
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'category_posts_id' => 'required|exists:category_posts,category_posts_id',
            'content' => 'required',
        ]);


        // Tìm và cập nhật bài viết
        $post = Post::findOrFail($posts_id);
        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'status' => $request->status,
            'description' => $request->description,
            'category_posts_id' => $request->category_posts_id,
            'content' => $request->content,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        // Quay lại trang danh sách bài viết với thông báo thành công
        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }
}