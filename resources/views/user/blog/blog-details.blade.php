@extends('welcome')
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{ url('/') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('user.blog.list') }}">Blog</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $post->slug }} <!-- Hiển thị slug của bài viết -->
                            </li>
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
                <div class="blog-item-wrapper">
                    <!-- blog post item start -->
                    <div class="blog-post-item blog-details-post">
                        <figure class="blog-thumb">
                            <div class="blog-carousel-2 slick-row-15 slick-arrow-style slick-dot-style">
                                @if(is_array($post->images) || is_object($post->images))
                                @foreach ($post->images as $image)
                                <div class="blog-single-slide">
                                    <img src="{{ asset('public/admin/images/post/' . $image) }}" alt="blog image">
                                </div>
                                @endforeach
                                @else
                                <div class="blog-single-slide">
                                    <img src="{{ asset('public/admin/images/post/' . $post->images) }}" alt="blog image">
                                </div>
                                @endif
                            </div>
                        </figure>

                        <div class="blog-content">
                            <h3 class="blog-title">
                                {{ $post->title }}
                            </h3>
                            <div class="blog-meta">
                                <p>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }} | <a href="#">{{ $post->categoryPost->name }}</a></p>
                            </div>
                            <div class="entry-summary">
                                <blockquote>
                                    <p>{!! $post->content !!}</p>
                                </blockquote>

                                <div class="blog-share-link">
                                    <h6>Share :</h6>
                                    <div class="blog-social-icon">
                                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection