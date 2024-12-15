<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CategoryPost;

class BlogController extends Controller
{
    public function index()
    {
        // Lấy danh sách bài viết có trạng thái 'hoạt động' (status = 1)
        $posts = Post::where('status', 1)->with('categoryPost')->get();

        // Nhóm bài viết theo tháng và năm
        $archives = Post::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as post_count')
            ->where('status', 1)
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();


        // Lấy danh sách các danh mục và số lượng bài viết
        $categories = CategoryPost::withCount('posts')->get();

        // Truyền dữ liệu sang view
        return view('user.blog.blog-list', compact('posts', 'archives', 'categories'));
    }
    public function show($slug)
    {
        // Tìm bài viết theo slug
        $post = Post::where('slug', $slug)->firstOrFail();
        $posts = Post::where('status', 1)->with('categoryPost')->get();

        // Nhóm bài viết theo tháng và năm
        $archives = Post::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as post_count')
            ->where('status', 1)
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Lấy danh sách các danh mục và số lượng bài viết
        $categories = CategoryPost::withCount('posts')->get();

        // Trả về view với dữ liệu bài viết
        return view('user.blog.blog-details', compact('post', 'posts', 'archives', 'categories'));
    }
}
