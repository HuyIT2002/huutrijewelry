@extends('welcome')
@section('content')
<style>
    .sec-img,
    .pri-img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        /* Đảm bảo ảnh được cắt đúng tỉ lệ */
    }

    .pri-img2 {
        width: 70px;
        height: 70px;
        object-fit: cover;
        /* Đảm bảo ảnh được cắt đúng tỉ lệ */
    }
</style>

<section class="slider-area">
    <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
        <!-- single slider item start -->
        <div class="hero-single-slide hero-overlay">
            <div class="hero-slider-item bg-img" data-bg="{{ asset('public/assets/img/slider/16-01.jpg')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="hero-slider-content slide-1">
                                <h2 class="slide-title">Bộ trang sức cưới <span>Bộ sưu tập Hữu Trí Jewelry</span></h2>
                                <h4 class="slide-desc">Trang sức thiết kế với độc lạ, mới mẻ, bắt dòng sự kiện</h4>
                                <a href="{{ route('user.shops.list') }}" class="btn btn-hero">Đọc thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single slider item end -->

        <!-- single slider item start -->
        <div class="hero-single-slide hero-overlay">
            <div class="hero-slider-item bg-img" data-bg="{{ asset('public/assets/img/slider/1.png')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="hero-slider-content slide-2">
                                <h2 class="slide-title">Trang sức kim cương<span>Bộ sưu tập Hữu Trí Jewelry</span></h2>
                                <h4 class="slide-desc">Trang sức kim cương đẹp và sang trọng phù hợp xu hướng</h4>
                                <a href="{{ route('user.shops.list') }}" class="btn btn-hero">Đọc thêm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single slider item start -->
    </div>
</section>
<section class="feature-product section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- section title start -->
                <div class="section-title text-center">
                    <h2 class="title">Sản phẩm nổi bật</h2>
                    <p class="sub-title">Sản phẩm nối bật được thêm hàng tuần</p>
                </div>
                <!-- section title start -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                    @foreach($products as $product)
                    @if($product->status == 1)
                    <!-- product item start -->
                    <div class="product-item">
                        <figure class="product-thumb">
                            <a href="{{ route('user.shops.details', $product->slug) }}">
                                <img class="pri-img" src="{{ asset('/public/admin/images/products/' . $product->images) }}" alt="product">
                                <img class="sec-img" src="{{ asset('/public/admin/images/products/' . $product->images) }}" alt="product">
                            </a>
                            <div class="button-group">
                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                            </div>
                            <div class="cart-hover">
                                <a href="{{ route('user.shops.details', $product->slug) }}" class="btn btn-cart">
                                    Thông tin sản phẩm
                                </a>
                            </div>
                        </figure>
                        <div class="product-caption text-center">
                            <h6 class="product-name">
                                <a href="{{ route('user.shops.details', $product->slug) }}">{{ $product->product_name }}</a>
                            </h6>
                            <div class="price-box">
                                <span class="price-regular">{{ number_format($product->price, 0, ',', '.') }} VND</span>
                            </div>
                        </div>
                    </div>
                    <!-- product item end -->
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<section class="latest-blog-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- section title start -->
                <div class="section-title text-center">
                    <h2 class="title">Bài viết mới nhất</h2>
                    <p class="sub-title">Có những bài đăng blog mới nhất</p>
                </div>
                <!-- section title start -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="blog-carousel-active slick-row-10 slick-arrow-style">
                    <!-- blog post item start -->
                    @if ($posts->count() > 0)
                    @foreach ($posts as $post)
                    <div class="blog-post-item">
                        <figure class="blog-thumb">
                            <a href="{{ route('user.blog.details', $post->slug) }}">
                                <img src="{{ asset('public/admin/images/post/' . $post->images) }}" alt="{{ $post->title }}">
                            </a>
                        </figure>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <p> {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }} |
                                    <a href="#">{{ $post->categoryPost->name ?? 'No Category' }}</a>
                                </p>
                            </div>
                            <h5 class="blog-title">
                                <a href="{{ route('user.blog.details', $post->slug) }}">{{ $post->title }}</a>
                            </h5>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>Không có bài viết nào.</p>
                    @endif
                    <!-- blog post item end -->

                </div>
            </div>
        </div>
    </div>
</section>
<section class="group-product-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- section title start -->
                <div class="section-title text-center">
                    <h2 class="title">Hàng mới về</h2>
                    <p class="sub-title">Thêm sản phẩm mới vào danh mục hàng tuần</p>
                </div>
                <!-- section title start -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="group-list-carousel--3 slick-row-10 slick-arrow-style">
                    @if ($latestProducts->count() > 0)
                    @foreach ($latestProducts as $product)
                    <!-- group list item start -->
                    <div class="group-slide-item">
                        <div class="group-item">
                            <div class="group-item-thumb">
                                <a href="{{ route('user.shops.details', $product->slug) }}">
                                    <img class="pri-img2" src="{{ asset('/public/admin/images/products/' . $product->	images) }}" alt="{{ $product->product_name }}">
                                </a>
                            </div>
                            <div class="group-item-desc">
                                <h5 class="group-product-name">
                                    <a href="{{ route('user.shops.details', $product->slug) }}">{{ $product->product_name }}</a>
                                </h5>
                                <div class="price-box">
                                    <span class="price-regular">{{ number_format($product->price, 2) }} VNĐ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- group list item end -->
                    @endforeach
                    @else
                    <p>Không có sản phẩm mới nào.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</section>
@endsection