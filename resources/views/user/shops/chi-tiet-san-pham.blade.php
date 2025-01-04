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
<style>
    /* Đặt kiểu cho container */
    .quantity-container {
        display: flex;
        align-items: center;
        margin-top: 10px;
        justify-content: flex-start;
    }

    /* Kiểu cho nhãn "Số lượng" */
    .quantity-label {
        font-size: 16px;
        font-weight: bold;
        margin-right: 10px;
    }

    /* Container chứa các nút và input */
    .quantity-box {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px;
    }

    /* Kiểu cho nút cộng và trừ */
    .qty-btn {
        background-color: #f1f1f1;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 8px 12px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Khi hover vào nút cộng hoặc trừ */
    .qty-btn:hover {
        background-color: #ddd;
    }

    /* Kiểu cho input số lượng */
    .quantity-input {
        width: 40px;
        text-align: center;
        border: none;
        font-size: 16px;
        margin: 0 5px;
    }

    /* Đảm bảo không có viền xung quanh khi focus */
    .quantity-input:focus {
        outline: none;
    }

    /* Nếu input có giá trị <= 0, disable nút trừ */
    .qty-btn.dec:disabled {
        background-color: #f9f9f9;
        cursor: not-allowed;
    }

    /* Cách tạo khoảng cách giữa nút và input */
    .quantity-box button:focus {
        outline: none;
    }

    .submit-btn {
        display: none;
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
                                <p class="pro-desc">Nội dung : {{ $product->description }}</p>
                                <form action="{{ route('user.orders.add-to-cart') }}" method="POST">
                                    @csrf
                                    <div class="quantity-container">
                                        <label for="quantity" class="quantity-label">Số lượng:</label>
                                        <div class="quantity-box">
                                            <button type="button" class="qty-btn dec">-</button>
                                            <input type="number" name="quantity" value="1" class="quantity-input" min="1" />
                                            <button type="button" class="qty-btn inc">+</button>
                                        </div>
                                    </div>
                                    <br>

                                    @if(isset($sizes) && $sizes->count() > 0)
                                    <div class="pro-size">
                                        <h6 class="option-title">Size:</h6>
                                        <select name="size" required>
                                            @foreach($sizes as $size)
                                            <option value="{{ $size->size_id }}">{{ $size->size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @else
                                    <input type="hidden" name="size" value=""> <!-- Đặt giá trị size bằng 0 nếu không có size -->
                                    @endif

                                    <input type="hidden" name="products_id" value="{{ $product->products_id }}">
                                    <div class="action_link">
                                        @if($product->so_luong > 0)
                                        <button type="submit" class="btn btn-cart2">Thêm sản phẩm vào giỏ hàng</button>
                                        @else
                                        <span class="btn btn-cart2">Hết hàng</span>
                                        @endif
                                    </div>
                                </form>


                                <div class="pro-size">
                                    <h6 class="option-title">Hướng dẫn đo size:</h6>
                                    <select class="nice-select">
                                        <option value="" disabled selected>Chọn hướng dẫn đo size</option>
                                        <option value="{{ route('user.services.do-size-nhan') }}">Hướng dẫn đo size Nhẫn</option>
                                        <option value="{{ route('user.services.do-size-day-chuyen') }}">Hướng dẫn đo size Dây Chuyền, Dây cổ, Kiềng</option>
                                        <option value="{{ route('user.services.do-size-lac-vong') }}">Hướng dẫn đo size Lắc tay và Vòng tay</option>
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
                                    <li>
                                        <a data-bs-toggle="tab" href="#tab_two">Chính sách thu đổi</a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tab" href="#tab_three">Chính sách bảo hành</a>
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
                                    <div class="tab-pane fade" id="tab_two">
                                        <div class="container py-5">
                                            <h1 class="text-center fw-bold" style="color: #DAA520; font-size: 36px;">Chính Sách Thu Đổi</h1>

                                            <!-- Chính sách 1 -->
                                            <div class="policy-section bg-light p-4 rounded-3 shadow-sm mb-4 border border-gold">
                                                <h2 class="h4 fw-bold" style="color: #DAA520;">1. Đổi ngang không bù vàng</h2>
                                                <ul class="list-unstyled mt-3">
                                                    <li><i class="bi bi-check-circle-fill" style="color: #DAA520;"></i> Nhẫn tròn trơn 99.99</li>
                                                    <li><i class="bi bi-check-circle-fill" style="color: #DAA520;"></i> Nữ trang 610/416. Chế tác bằng công nghệ đúc, đan máy. Trọng lượng dưới 3 chỉ, còn nguyên vẹn, không mốp méo hay biến dạng.</li>
                                                </ul>
                                            </div>

                                            <!-- Chính sách 2 -->
                                            <div class="policy-section bg-light p-4 rounded-3 shadow-sm mb-4 border border-gold">
                                                <h2 class="h4 fw-bold" style="color: #DAA520;">2. Chính sách vàng đổi vàng</h2>
                                                <p style="color: #DAA520;">Quý khách bù thêm phí đổi mới với các sản phẩm sau:</p>
                                                <ul class="list-unstyled">
                                                    <li><i class="bi bi-check-circle-fill" style="color: #DAA520;"></i> Vàng trang sức 980, vàng 99.9…</li>
                                                    <li><i class="bi bi-check-circle-fill" style="color: #DAA520;"></i> Các loại vàng 416/610 chế tác bằng thủ công như xi men, vòng, dây bộng, các sản phẩm đồ bộng và sản phẩm cắt máy.</li>
                                                    <li><i class="bi bi-check-circle-fill" style="color: #DAA520;"></i> Các sản phẩm đặt theo thiết kế riêng hoặc cắt sửa theo yêu cầu trước đó.</li>
                                                </ul>
                                            </div>

                                            <!-- Chính sách 3 -->
                                            <div class="policy-section bg-light p-4 rounded-3 shadow-sm mb-4 border border-gold">
                                                <h2 class="h4 fw-bold" style="color: #DAA520;">3. Chính sách thu đổi vàng Ý CN ITALY 750</h2>
                                                <p style="color: #DAA520;">Mua tại HỮU TRÍ JEWELRY. So với hóa đơn, tính theo (gam%).</p>
                                                <ul class="list-unstyled">
                                                    <li><i class="bi bi-check-circle-fill" style="color: #DAA520;"></i> Sản phẩm còn nguyên vẹn, không hư gãy, biến dạng. Đổi lớn 85%, bán lại thu 80%.</li>
                                                    <li><i class="bi bi-check-circle-fill" style="color: #DAA520;"></i> Sản phẩm hư gãy tính 70% theo giá trị hóa đơn hoặc trừ đá mua theo chỉ giá tại thời điểm.</li>
                                                    <li><i class="bi bi-check-circle-fill" style="color: #DAA520;"></i> Thiết kế theo yêu cầu: đổi lớn 80%, bán thu lại 75%.</li>
                                                    <li><i class="bi bi-check-circle-fill" style="color: #DAA520;"></i> Thiết kế riêng đổi lớn 75%, bán thu 70%.</li>
                                                </ul>
                                            </div>

                                            <!-- Chính sách 4 -->
                                            <div class="policy-section bg-light p-4 rounded-3 shadow-sm mb-4 border border-gold">
                                                <h2 class="h4 fw-bold" style="color: #DAA520;">4. Các sản phẩm không mua tại HỮU TRÍ JEWELRY</h2>
                                                <p style="color: #DAA520;">So giá tại thời điểm.</p>
                                                <ul class="list-unstyled">
                                                    <li><i class="bi bi-check-circle-fill" style="color: #DAA520;"></i> Sản phẩm còn nguyên vẹn, không hư gãy, biến dạng. Đổi lớn 80%, bán lại thu 70%.</li>
                                                    <li><i class="bi bi-check-circle-fill" style="color: #DAA520;"></i> Khách hàng lưu ý: Các sản phẩm không mua tại HỮU TRÍ JEWELRY trao đổi theo gam tính %. Chỉ áp dụng giá Ý loại III trở xuống.</li>
                                                </ul>
                                                <p style="color: #DAA520;">- Sản phẩm có đính đá nặng dưới 8 gam và dây chuyền dưới 15 gam.</p>
                                                <p style="color: #DAA520;">- Sản phẩm có trọng lượng ngoài 2 trường hợp trên sẽ tính theo giá chỉ 750 tại thời điểm dù còn nguyên vẹn. Nếu khách hàng chỉ bán mà không trao đổi.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab_three">
                                        <div class="service-policy mt-4">
                                            <h1 class="text-center fw-bold" style="color: #DAA520; font-size: 36px;">Dịch Vụ Bảo Hành</h1>

                                            <h3 class="fw-bold" style="color: #DAA520;">1. Sản phẩm 610/416 mua tại Hữu Trí Jewelry được đổi sang sản phẩm khác trong 7 ngày</h3>
                                            <p class="text-dark">Kể từ ngày mua trên hóa đơn, quý khách được đổi miễn phí.</p>

                                            <h4 class="fw-bold" style="color: #DAA520;">+ Điều kiện đổi mới miễn phí:</h4>
                                            <ul class="text-dark">
                                                <li>Sản phẩm mua tại Hữu Trí Jewelry chưa qua sử dụng, còn đầy đủ giấy tờ hóa đơn, kiểm định.</li>
                                                <li>Sản phẩm phải còn nguyên vẹn, không bị hư hỏng, trầy xước, đúng trọng lượng ghi trên hóa đơn bán hàng kèm theo.</li>
                                                <li>Sản phẩm bị lỗi và được Hữu Trí Jewelry xác nhận là lỗi do công ty không phải do khách sử dụng gây ra.</li>
                                                <li>Chỉ được đổi sang sản phẩm cùng loại (610 đổi 610).</li>
                                                <li>Chỉ được đổi không được trả hàng lấy lại tiền.</li>
                                                <li>Giá vàng tính theo giá hiện tại tại thời điểm đổi món khác.</li>
                                                <li>Sản phẩm đổi phải bằng hoặc lớn hơn sản phẩm cũ.</li>
                                                <li>Chỉ được đổi mới 1 lần duy nhất. Sản phẩm đã được đổi trước đó không được đổi mới trừ trường hợp có lỗi do nhà sản xuất mà khi bán không phát hiện.</li>
                                                <li>Miễn phí tân trang làm mới, gắn đá rớt CZ sửa chữa nhẹ, khắc tên.</li>
                                                <li>Miễn phí mạ trắng (cho lần đầu tiên) khi khách hàng mua sản phẩm, Italy 750, 416, bạch kim.</li>
                                            </ul>

                                            <h4 class="fw-bold" style="color: #DAA520;">+ Các trường hợp không được đổi mới miễn phí:</h4>
                                            <ul class="text-dark">
                                                <li>Trang sức đồng hồ, vòng đá, trầm, trang sức phong thủy.</li>
                                                <li>Dạng ống bộng như Ximen, vòng ống, kiềng cổ vàng 610, 416, 980 loại không khóa, vòng kiềng.</li>
                                                <li>Sản phẩm đã cắt, sửa, thu ni, làm lớn theo yêu cầu của khách.</li>
                                                <li>Sản phẩm đã thay đổi màu sắc, đá màu, hình dạng theo yêu cầu của khách.</li>
                                                <li>Sản phẩm đặt làm riêng hoặc đã khắc tên riêng cho khách.</li>
                                            </ul>

                                            <h3 class="fw-bold" style="color: #DAA520;">2. Quy định dịch vụ sửa chữa và tân trang</h3>
                                            <ul class="text-dark">
                                                <li>Sản phẩm mang đến sửa chữa phải được kiểm tra và lập biên nhận rõ ràng, bao gồm thông tin khách hàng và tình trạng sản phẩm.</li>
                                                <li>Cam kết hoàn thành sửa chữa trong vòng 1-5 ngày hoặc theo thỏa thuận với khách hàng.</li>
                                                <li>Khách hàng được thông báo ngay khi sản phẩm hoàn thành.</li>
                                                <li>Cửa hàng chịu trách nhiệm bảo quản sản phẩm trong quá trình sửa chữa và giao lại đúng hiện trạng.</li>
                                                <li>Trong trường hợp mất mát hoặc hư hỏng, cửa hàng sẽ bồi thường phù hợp với giá trị sản phẩm.</li>
                                            </ul>

                                            <h3 class="fw-bold" style="color: #DAA520;">3. Quy định dành cho khách hàng</h3>
                                            <ul class="text-dark">
                                                <li>Khách hàng cần cung cấp đầy đủ thông tin cá nhân khi mua hàng hoặc yêu cầu dịch vụ lớn.</li>
                                                <li>Thanh toán đúng hạn và kiểm tra kỹ sản phẩm trước khi rời cửa hàng.</li>
                                            </ul>

                                            <p class="text-dark mt-4">Lưu ý: Nội quy này được áp dụng nhằm bảo vệ quyền lợi của cả khách hàng và cửa hàng. Mọi khiếu nại hoặc thắc mắc vui lòng liên hệ: 0914 38 37 79</p>
                                            <h4 class="fw-bold mt-4" style="color: #DAA520;">Ban hành bởi: CTY TNHH TM DV VÀNG BẠC ĐÁ QUÝ HỮU TRÍ JEWELRY.</h4>
                                        </div>
                                    </div>
                                    ``

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