@extends('welcome')
@section('content')

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Những bài viết </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="blog-main-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 order-2">
                <aside class="blog-sidebar-wrapper">
                    <!-- <div class="blog-sidebar">
                        <h5 class="title">Tìm kiếm một bài viết</h5>
                        <div class="sidebar-serch-form">
                            <form action="#">
                                <input type="text" class="search-field" placeholder="search here">
                                <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div> -->
                    <div class="blog-sidebar">
                        <h5 class="title">Danh mục bài viết</h5>
                        <ul class="blog-archive blog-category">
                            @foreach ($categories as $category)
                            <li><a href="#">{{ $category->name }} ({{ $category->posts_count }})</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="blog-sidebar">
                        <h5 class="title">Bài viết mỗi tháng</h5>
                        <ul class="blog-archive">
                            @foreach ($archives as $archive)
                            <li>
                                @php
                                // Kiểm tra nếu tháng hợp lệ
                                $monthName = '';
                                if ($archive->month >= 1 && $archive->month <= 12) {
                                    // Chuyển tháng từ số thành tên tháng (Tháng 1, Tháng 2, ...)
                                    $monthName='Tháng ' . DateTime::createFromFormat('!m', $archive->month)->format('m');
                                    }
                                    @endphp
                                    <a href="#">
                                        {{ $monthName }} ({{ $archive->post_count }})
                                    </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
            <div class="col-lg-9 order-1">
                <div class="blog-item-wrapper blog-list-inner">
                    <div class="row mbn-30">
                        @foreach ($posts as $post)
                        <div class="col-12">
                            <div class="blog-post-item mb-30">
                                <figure class="blog-thumb">
                                    <!-- Đường dẫn đến trang chi tiết bài viết -->
                                    <a href="{{ route('user.blog.details', $post->slug) }}">
                                        <img src="{{ asset('public/admin/images/post/' . $post->images) }}" alt="blog image">
                                    </a>
                                </figure>
                                <div class="blog-content">
                                    <h4 class="blog-title">
                                        <!-- Đường dẫn đến trang chi tiết bài viết -->
                                        <a href="{{ route('user.blog.details', $post->slug) }}">{{ $post->title }}</a>
                                    </h4>
                                    <div class="blog-meta">
                                        <p>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }} | <a href="#">{{ $post->categoryPost->name }}</a></p>
                                    </div>
                                    <p>{!! Str::limit(strip_tags($post->content), 150) !!}</p>
                                    <!-- Đường dẫn đến trang chi tiết bài viết -->
                                    <a class="blog-read-more" href="{{ route('user.blog.details', $post->slug) }}">Đọc thêm...</a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <div class="paginatoin-area text-center">
                        <ul class="pagination-box">
                            <li><a class="previous" href="#"><i class="pe-7s-angle-left"></i></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a class="next" href="#"><i class="pe-7s-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection