@extends('welcome')
@section('content')
<style>
    .pro-size-2 {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
    }

    .option-title-2 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 0;
    }

    .size-guide-select {
        width: auto;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fff;
        text-align: center;
        /* Căn giữa văn bản trong select */
        appearance: none;
        /* Ẩn style mặc định của select */
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    .size-guide-select option {
        text-align: center;
        /* Canh giữa văn bản trong các option */
    }

    /* Đối với phần tử option disabled */
    .size-guide-select option:disabled {
        color: gray;
        background-color: #f2f2f2;
    }

    /* Hiệu ứng hover cho các option */
    .size-guide-select option:hover {
        background-color: #ff6600;
        color: white;
    }

    /* Căn giữa "Chọn hướng dẫn đo size" trong option */
    .size-guide-select option[value=""] {
        text-align: center;
    }

    /* Điều chỉnh kích thước cho mobile */
    @media (max-width: 768px) {
        .option-title-2 {
            font-size: 16px;
        }

        .size-guide-select {
            font-size: 14px;
            padding: 8px;
        }
    }
</style>
<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.shops.list') }}">Trang sản phẩm</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- page main wrapper start -->
<div class="shop-main-wrapper section-padding pb-0">
    <div class="container">
        <div class="row">
            <!-- product details wrapper start -->
            <div class="col-lg-12 order-1 order-lg-2">
                <!-- product details inner end -->
                <div class="product-details-inner">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="product-large-slider">
                                <div class="pro-large-img img-zoom">
                                    <img src="{{ asset('public/admin/images/products/' . $product->images) }}" alt="{{ $product->product_name }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="product-details-des">
                                <div class="manufacturer-name">
                                    <a href="product-details.html">{{ $product->category->category_name ?? 'Không xác định' }}</a>
                                </div>
                                <h3 class="product-name">{{ $product->product_name }}</h3>
                                <p class="pro-desc">Mã sản phẩm : {{ $product->code_id }}</p>
                                <p class="pro-desc">Số lượng sản phẩm: {{ $product->so_luong }}</p>
                                <div class="price-box">
                                    <span class="price-regular">Giá sản phẩm :{{ number_format($product->price, 0, ',', '.') }} VND</span>
                                </div>
                                <p class="pro-desc">{{ $product->description }}</p>
                                <div class="quantity-cart-box d-flex align-items-center">
                                    <h6 class="option-title">Số lượng mua:</h6>
                                    <div class="quantity">
                                        <div class="pro-qty"><input type="text" value="1"></div>
                                    </div>
                                    <div class="action_link">
                                        @if($product->so_luong > 0) <!-- Kiểm tra nếu so_luong > 0 thì hiển thị "Add to cart" -->
                                        <form action="{{ route('user.orders.add-to-cart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="products_id" value="{{ $product->products_id }}">
                                            <button type="submit" class="btn btn-cart2">Thêm sản phẩm vào giỏ hàng</button>
                                        </form>
                                        @else
                                        <!-- Nếu so_luong = 0, bạn có thể thay thế bằng thông báo khác -->
                                        <span class="btn btn-cart2">Hết hàng</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="pro-size">
                                    <h6 class="option-title">Hướng dẫn đo size:</h6>
                                    <select class="nice-select">
                                        <option value="" disabled selected>Chọn hướng dẫn đo size</option>
                                        <option value="{{ route('user.services.do-size-nhan') }}">Hướng dẫn đo size Nhẫn</option>
                                        <option value="{{ route('user.services.do-size-day-chuyen') }}">Hướng dẫn đo size Dây Chuyền, Dây cổ, Kiềng</option>
                                        <option value="{{ route('user.services.do-size-lac-vong') }}">Hướng dẫn đo size Lắc tay và Vòng tay</option>
                                    </select>
                                </div>
                                <div class="pro-size">
                                    <h6 class="option-title">Size :</h6>
                                    <select class="nice-select">
                                        @foreach($sizes as $size)
                                        <option>{{ $size->size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="like-icon">
                                    <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                    <a class="twitter" href="#"><i class="fa fa-twitter"></i>zalo</a>
                                    <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>tiktok</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details inner end -->

                <!-- product details reviews start -->
                <div class="product-details-reviews section-padding pb-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-review-info">
                                <ul class="nav review-tab">
                                    <li>
                                        <a class="active" data-bs-toggle="tab" href="#tab_one">Chi tiết của sản phẩm </a>
                                    </li>
                                </ul>
                                <div class="tab-content reviews-tab">
                                    <div class="tab-pane fade show active" id="tab_one">
                                        <div class="tab-one">
                                            <p><strong>Loại đá chính:</strong> {{ $product->loai_da_chinh ?? 'Không xác định' }}</p>
                                            <p><strong>Kích thước đá:</strong> {{ $product->kich_thuoc_da ?? 'Không xác định' }}</p>
                                            <p><strong>Màu đá chính:</strong> {{ $product->mau_da_chinh ?? 'Không xác định' }}</p>
                                            <p><strong>Hình dạng đá:</strong> {{ $product->hinh_dang_da ?? 'Không xác định' }}</p>
                                            <p><strong>Số lượng đá chính:</strong> {{ $product->sl_da_chinh ?? 'Không xác định' }}</p>
                                            <p><strong>Số lượng đá phụ:</strong> {{ $product->sl_da_phu ?? 'Không xác định' }}</p>
                                            <p><strong>Trọng lượng:</strong> {{ $product->trong_luong ?? 'Không xác định' }}</p>
                                            <p><strong>Hàm chất liệu:</strong> {{ $product->ham_chat_lieu ?? 'Không xác định' }}</p>
                                            <p><strong>Số lượng:</strong> {{ $product->so_luong ?? 'Không xác định' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details reviews end -->
            </div>
            <!-- product details wrapper end -->
        </div>
    </div>
</div>
<!-- page main wrapper end -->

<!-- related products area start -->
<section class="related-products section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- section title start -->
                <div class="section-title text-center">
                    <h2 class="title">Related Products</h2>
                    <p class="sub-title">Add related products to weekly lineup</p>
                </div>
                <!-- section title start -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                    <!-- product item start -->
                    <div class="product-item">
                        <figure class="product-thumb">
                            <a href="product-details.html">
                                <img class="pri-img" src="assets/img/product/product-11.jpg" alt="product">
                                <img class="sec-img" src="assets/img/product/product-8.jpg" alt="product">
                            </a>
                            <div class="product-badge">
                                <div class="product-label new">
                                    <span>new</span>
                                </div>
                                <div class="product-label discount">
                                    <span>10%</span>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                            </div>
                            <div class="cart-hover">
                                <button class="btn btn-cart">add to cart</button>
                            </div>
                        </figure>
                        <div class="product-caption text-center">
                            <div class="product-identity">
                                <p class="manufacturer-name"><a href="product-details.html">Gold</a></p>
                            </div>
                            <ul class="color-categories">
                                <li>
                                    <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                </li>
                                <li>
                                    <a class="c-darktan" href="#" title="Darktan"></a>
                                </li>
                                <li>
                                    <a class="c-grey" href="#" title="Grey"></a>
                                </li>
                                <li>
                                    <a class="c-brown" href="#" title="Brown"></a>
                                </li>
                            </ul>
                            <h6 class="product-name">
                                <a href="product-details.html">Perfect Diamond Jewelry</a>
                            </h6>
                            <div class="price-box">
                                <span class="price-regular">$60.00</span>
                                <span class="price-old"><del>$70.00</del></span>
                            </div>
                        </div>
                    </div>
                    <!-- product item end -->

                    <!-- product item start -->
                    <div class="product-item">
                        <figure class="product-thumb">
                            <a href="product-details.html">
                                <img class="pri-img" src="assets/img/product/product-12.jpg" alt="product">
                                <img class="sec-img" src="assets/img/product/product-7.jpg" alt="product">
                            </a>
                            <div class="product-badge">
                                <div class="product-label new">
                                    <span>sale</span>
                                </div>
                                <div class="product-label discount">
                                    <span>new</span>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                            </div>
                            <div class="cart-hover">
                                <button class="btn btn-cart">add to cart</button>
                            </div>
                        </figure>
                        <div class="product-caption text-center">
                            <div class="product-identity">
                                <p class="manufacturer-name"><a href="product-details.html">mony</a></p>
                            </div>
                            <ul class="color-categories">
                                <li>
                                    <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                </li>
                                <li>
                                    <a class="c-darktan" href="#" title="Darktan"></a>
                                </li>
                                <li>
                                    <a class="c-grey" href="#" title="Grey"></a>
                                </li>
                                <li>
                                    <a class="c-brown" href="#" title="Brown"></a>
                                </li>
                            </ul>
                            <h6 class="product-name">
                                <a href="product-details.html">Handmade Golden Necklace</a>
                            </h6>
                            <div class="price-box">
                                <span class="price-regular">$50.00</span>
                                <span class="price-old"><del>$80.00</del></span>
                            </div>
                        </div>
                    </div>
                    <!-- product item end -->

                    <!-- product item start -->
                    <div class="product-item">
                        <figure class="product-thumb">
                            <a href="product-details.html">
                                <img class="pri-img" src="assets/img/product/product-13.jpg" alt="product">
                                <img class="sec-img" src="assets/img/product/product-6.jpg" alt="product">
                            </a>
                            <div class="product-badge">
                                <div class="product-label new">
                                    <span>new</span>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                            </div>
                            <div class="cart-hover">
                                <button class="btn btn-cart">add to cart</button>
                            </div>
                        </figure>
                        <div class="product-caption text-center">
                            <div class="product-identity">
                                <p class="manufacturer-name"><a href="product-details.html">Diamond</a></p>
                            </div>
                            <ul class="color-categories">
                                <li>
                                    <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                </li>
                                <li>
                                    <a class="c-darktan" href="#" title="Darktan"></a>
                                </li>
                                <li>
                                    <a class="c-grey" href="#" title="Grey"></a>
                                </li>
                                <li>
                                    <a class="c-brown" href="#" title="Brown"></a>
                                </li>
                            </ul>
                            <h6 class="product-name">
                                <a href="product-details.html">Perfect Diamond Jewelry</a>
                            </h6>
                            <div class="price-box">
                                <span class="price-regular">$99.00</span>
                                <span class="price-old"><del></del></span>
                            </div>
                        </div>
                    </div>
                    <!-- product item end -->

                    <!-- product item start -->
                    <div class="product-item">
                        <figure class="product-thumb">
                            <a href="product-details.html">
                                <img class="pri-img" src="assets/img/product/product-14.jpg" alt="product">
                                <img class="sec-img" src="assets/img/product/product-5.jpg" alt="product">
                            </a>
                            <div class="product-badge">
                                <div class="product-label new">
                                    <span>sale</span>
                                </div>
                                <div class="product-label discount">
                                    <span>15%</span>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                            </div>
                            <div class="cart-hover">
                                <button class="btn btn-cart">add to cart</button>
                            </div>
                        </figure>
                        <div class="product-caption text-center">
                            <div class="product-identity">
                                <p class="manufacturer-name"><a href="product-details.html">silver</a></p>
                            </div>
                            <ul class="color-categories">
                                <li>
                                    <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                </li>
                                <li>
                                    <a class="c-darktan" href="#" title="Darktan"></a>
                                </li>
                                <li>
                                    <a class="c-grey" href="#" title="Grey"></a>
                                </li>
                                <li>
                                    <a class="c-brown" href="#" title="Brown"></a>
                                </li>
                            </ul>
                            <h6 class="product-name">
                                <a href="product-details.html">Diamond Exclusive Ornament</a>
                            </h6>
                            <div class="price-box">
                                <span class="price-regular">$55.00</span>
                                <span class="price-old"><del>$75.00</del></span>
                            </div>
                        </div>
                    </div>
                    <!-- product item end -->

                    <!-- product item start -->
                    <div class="product-item">
                        <figure class="product-thumb">
                            <a href="product-details.html">
                                <img class="pri-img" src="assets/img/product/product-15.jpg" alt="product">
                                <img class="sec-img" src="assets/img/product/product-4.jpg" alt="product">
                            </a>
                            <div class="product-badge">
                                <div class="product-label new">
                                    <span>new</span>
                                </div>
                                <div class="product-label discount">
                                    <span>20%</span>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                            </div>
                            <div class="cart-hover">
                                <button class="btn btn-cart">add to cart</button>
                            </div>
                        </figure>
                        <div class="product-caption text-center">
                            <div class="product-identity">
                                <p class="manufacturer-name"><a href="product-details.html">mony</a></p>
                            </div>
                            <ul class="color-categories">
                                <li>
                                    <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                </li>
                                <li>
                                    <a class="c-darktan" href="#" title="Darktan"></a>
                                </li>
                                <li>
                                    <a class="c-grey" href="#" title="Grey"></a>
                                </li>
                                <li>
                                    <a class="c-brown" href="#" title="Brown"></a>
                                </li>
                            </ul>
                            <h6 class="product-name">
                                <a href="product-details.html">Citygold Exclusive Ring</a>
                            </h6>
                            <div class="price-box">
                                <span class="price-regular">$60.00</span>
                                <span class="price-old"><del>$70.00</del></span>
                            </div>
                        </div>
                    </div>
                    <!-- product item end -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- related products area end -->

@endsection