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
</style>
<style>
    .product-thumb {
        position: relative;
    }

    .sold-out-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Nền phủ mờ */
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 18px;
        font-weight: bold;
        z-index: 10;
        pointer-events: none;
        /* Không ngăn cản người dùng click */
        text-transform: uppercase;
    }

    .sold-out-overlay span {
        background-color: rgba(255, 0, 0, 0.8);
        padding: 10px 20px;
        border-radius: 5px;
    }
</style>
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
                                @foreach ($categories as $cat)
                                <li>
                                    <a href="{{ route('user.shops.search-products', $cat->slug) }}">
                                        {{ $cat->category_name }} <span>({{ $cat->products_count }})</span>
                                    </a>
                                </li>
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
                    <h2 class="text-center">Sản phẩm thuộc danh mục: {{ $category->category_name }}</h2>
                    </br>
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
                        @if ($products->count() > 0)
                        @foreach($products as $product)
                        @if($product->status == 1)
                        <div class="col-md-4 col-sm-6">
                            <!-- Product Grid Start -->
                            <div class="product-item">
                                <figure class="product-thumb position-relative">
                                    <a href="{{ route('user.shops.details', ['slug' => $product->slug, 'products_id' => $product->products_id]) }}">
                                        <img class="pri-img" src="{{ asset('/public/admin/images/products/' . $product->images) }}" alt="{{ $product->product_name }}">
                                        <img class="sec-img" src="{{ asset('/public/admin/images/products/' . $product->images) }}" alt="{{ $product->product_name }}">
                                    </a>
                                    <div class="cart-hover">
                                        <a href="{{ route('user.shops.details', ['slug' => $product->slug, 'products_id' => $product->products_id]) }}" class="btn btn-cart">
                                            Thông tin sản phẩm
                                        </a>
                                    </div>

                                    <!-- Overlay "Hết hàng" -->
                                    @if($product->so_luong == 0)
                                    <div class="sold-out-overlay">
                                        <span>Hết hàng</span>
                                    </div>
                                    @endif
                                </figure>

                                <!-- Product Caption -->
                                <div class="product-caption text-center">
                                    <h6 class="product-name">
                                        <a href="{{ route('user.shops.details', ['slug' => $product->slug, 'products_id' => $product->products_id]) }}">
                                            {{ $product->product_name }}
                                        </a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">{{ number_format($product->price, 0, ',', '.') }} VND</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Grid End -->

                            <!-- Product List Item Start -->
                            <div class="product-list-item">
                                <figure class="product-thumb position-relative">
                                    <a href="{{ route('user.shops.details', ['slug' => $product->slug, 'products_id' => $product->products_id]) }}">
                                        <img class="sec-img" src="{{ asset('/public/admin/images/products/' . $product->images) }}" alt="{{ $product->product_name }}">
                                        <img class="pri-img" src="{{ asset('/public/admin/images/products/' . $product->images) }}" alt="{{ $product->product_name }}">
                                    </a>
                                    <div class="cart-hover">
                                        <a href="{{ route('user.shops.details', ['slug' => $product->slug, 'products_id' => $product->products_id]) }}" class="btn btn-cart">
                                            Thông tin sản phẩm
                                        </a>
                                    </div>

                                    <!-- Kiểm tra nếu hết hàng -->
                                    @if($product->so_luong == 0)
                                    <div class="sold-out-overlay">
                                        <span>Hết hàng</span>
                                    </div>
                                    @endif
                                </figure>


                                <!-- Product List Content -->
                                <div class="product-content-list">
                                    <h5 class="product-name">
                                        <a href="{{ route('user.shops.details', ['slug' => $product->slug, 'products_id' => $product->products_id]) }}">
                                            {{ $product->product_name }}
                                        </a>
                                    </h5>
                                    <div class="price-box">
                                        <span class="price-regular">{{ number_format($product->price, 0, ',', '.') }} VND</span>
                                    </div>
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                            <!-- Product List Item End -->
                        </div>
                        @endif
                        @endforeach
                        @else
                        <p class="text-center">Không có sản phẩm nào trong danh mục này.</p>
                        @endif
                    </div>
                    <div class="paginatoin-area text-center">
                        <ul class="pagination-box">
                            <!-- Nút Previous -->
                            @if ($products->onFirstPage())
                            <li class="disabled"><a class="previous" href="#"><i class="pe-7s-angle-left"></i></a></li>
                            @else
                            <li><a class="previous" href="{{ $products->previousPageUrl() }}"><i class="pe-7s-angle-left"></i></a></li>
                            @endif

                            <!-- Liệt kê các trang -->
                            @foreach ($products->links()->elements as $element)
                            @if (is_string($element))
                            <li class="disabled"><a href="#">{{ $element }}</a></li>
                            @endif

                            @if (is_array($element))
                            @foreach ($element as $page => $url)
                            @if ($page == $products->currentPage())
                            <li class="active"><a href="#">{{ $page }}</a></li>
                            @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                            @endforeach
                            @endif
                            @endforeach

                            <!-- Nút Next -->
                            @if ($products->hasMorePages())
                            <li><a class="next" href="{{ $products->nextPageUrl() }}"><i class="pe-7s-angle-right"></i></a></li>
                            @else
                            <li class="disabled"><a class="next" href="#"><i class="pe-7s-angle-right"></i></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection