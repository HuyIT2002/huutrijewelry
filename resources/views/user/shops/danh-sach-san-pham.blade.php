@extends('welcome')
@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Sản phẩm </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="shop-main-wrapper section-padding">
    <div class="container">
        <div class="row">
            <!-- sidebar area start -->
            <div class="col-lg-3 order-2 order-lg-1">
                <aside class="sidebar-wrapper">
                    <!-- single sidebar start -->
                    <div class="sidebar-single">
                        <h5 class="sidebar-title">Danh mục sản phẩm</h5>
                        <div class="sidebar-body">
                            <ul class="shop-categories">
                                @foreach($categories as $category)
                                <li><a href="#">{{ $category->category_name }} <span>({{ $category->products_count }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- single sidebar end -->

                    <!-- single sidebar start -->
                    <div class="sidebar-single">
                        <h5 class="sidebar-title">price</h5>
                        <div class="sidebar-body">
                            <div class="price-range-wrap">
                                <div class="price-range" data-min="1" data-max="1000"></div>
                                <div class="range-slider">
                                    <form action="#" class="d-flex align-items-center justify-content-between">
                                        <div class="price-input">
                                            <label for="amount">Price: </label>
                                            <input type="text" id="amount">
                                        </div>
                                        <button class="filter-btn">filter</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single sidebar end -->
                </aside>
            </div>
            <!-- sidebar area end -->

            <!-- shop main wrapper start -->
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="shop-product-wrapper">
                    <!-- shop product top wrap start -->
                    <div class="shop-top-bar">
                        <div class="row align-items-center">
                            <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                <div class="top-bar-left">
                                    <div class="product-view-mode">
                                        <a href="#" data-target="grid-view" data-bs-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                                        <a class="active" href="#" data-target="list-view" data-bs-toggle="tooltip" title="List View"><i class="fa fa-list"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                <div class="top-bar-right">
                                    <div class="product-short">
                                        <p>Sort By : </p>
                                        <select class="nice-select" name="sortby">
                                            <option value="trending">Relevance</option>
                                            <option value="sales">Name (A - Z)</option>
                                            <option value="sales">Name (Z - A)</option>
                                            <option value="rating">Price (Low &gt; High)</option>
                                            <option value="date">Rating (Lowest)</option>
                                            <option value="price-asc">Model (A - Z)</option>
                                            <option value="price-asc">Model (Z - A)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shop product top wrap start -->

                    <!-- product item list wrapper start -->
                    <div class="shop-product-wrap list-view row mbn-30">
                        @foreach($products as $product)
                        @if($product->status == 1)
                        <div class="col-md-4 col-sm-6">
                            <!-- product grid start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="{{ route('user.shops.details', $product->slug) }}">
                                        <img class="pri-img" src="{{ asset('/public/admin/images/products/' . $product->images) }}" alt="product">
                                        <img class="sec-img" src="{{ asset('/public/admin/images/products/' . $product->images) }}" alt="product">
                                    </a>
                                    <div class="cart-hover">
                                        @if($product->so_luong > 0) <!-- Kiểm tra nếu so_luong > 0 thì hiển thị nút -->
                                        <button class="btn btn-cart">Thêm sản phẩm vào giỏ hàng</button>
                                        @endif
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
                            <!-- product grid end -->

                            <!-- product list item end -->
                            <div class="product-list-item">
                                <figure class="product-thumb">
                                    <a href="{{ route('user.shops.details', $product->slug) }}">
                                        <img class="sec-img" src="{{ asset('/public/admin/images/products/' . $product->images) }}" alt="product">
                                        <img class="pri-img" src="{{ asset('public/admin/images/products/' . $product->images) }}" alt="product">
                                    </a>
                                    <div class="cart-hover">
                                        @if($product->so_luong > 0) <!-- Kiểm tra nếu so_luong > 0 thì hiển thị nút -->
                                        <button class="btn btn-cart">Thêm sản phẩm vào giỏ hàng</button>
                                        @endif
                                    </div>
                                </figure>
                                <div class="product-content-list">
                                    <h5 class="product-name"><a href="{{ route('user.shops.details', $product->slug) }}">{{ $product->product_name }}</a></h5>
                                    <div class="price-box">
                                        <span class="price-regular">{{ number_format($product->price, 0, ',', '.') }} VND</span>

                                    </div>
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                            <!-- product list item end -->
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <!-- product item list wrapper end -->

                    <!-- start pagination area -->
                    <div class="paginatoin-area text-center">
                        <ul class="pagination-box">
                            <li><a class="previous" href="#"><i class="pe-7s-angle-left"></i></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a class="next" href="#"><i class="pe-7s-angle-right"></i></a></li>
                        </ul>
                    </div>
                    <!-- end pagination area -->
                </div>
            </div>
            <!-- shop main wrapper end -->
        </div>
    </div>
</div>

@endsection