@extends('welcome')
@section('content')
<style>
    .highlight {
        color: #ff5722;
        font-weight: bold;
        background-color: #fff9c4;
        padding: 2px 4px;
        border-radius: 4px;
        font-size: 24px;
    }

    .important-notes li {
        font-size: 18px;
        /* Tăng kích thước chữ */
    }

    .important-notes strong {
        font-size: 20px;
        /* Làm cho chữ in đậm to hơn */
    }
</style>
<style>
    .summary-footer-area .alert-warning {
        background-color: #fff3cd;
        color: #856404;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid #ffeeba;
        border-radius: 5px;
    }

    .summary-footer-area ul {
        padding-left: 0;
        list-style: none;
        margin-top: 10px;
    }

    .summary-footer-area ul li {
        display: inline-block;
        margin-right: 15px;
    }

    .summary-footer-area ul li a {
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 25px;
        background-color: #007bff;
        color: white;
        font-weight: bold;
        transition: background-color 0.3s, transform 0.3s;
    }

    .summary-footer-area ul li a:hover {
        background-color: #0056b3;
        transform: scale(1.1);
    }

    .summary-footer-area ul li a:focus {
        outline: none;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
    }

    .summary-footer-area .btn-sqr {
        background-color: #28a745;
        color: white;
        padding: 12px 20px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .summary-footer-area .btn-sqr:hover {
        background-color: #218838;
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
                            <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.shops.list') }}">Cửa hàng trang sức</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thanh toán đơn hàng</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- checkout main wrapper start -->
<div class="checkout-page-wrapper section-padding">
    <div class="container">
        <form action="{{ route('user.checkout.process') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Checkout Billing Details -->
                <div class="col-lg-6">
                    <div class="checkout-billing-details-wrap">
                        <h5 class="checkout-title">Thông tin cá nhân và nơi nhận hàng </h5>
                        <div class="billing-form-wrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="single-input-item">
                                        <label for="f_name" class="required">Họ và tên</label>
                                        <input type="text" id="f_name" name="full_name"
                                            value="{{ old('full_name', $user->name ?? '') }}" placeholder="Họ và tên" required />
                                    </div>
                                </div>
                            </div>

                            <div class="single-input-item">
                                <label for="email" class="required">Email Address</label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $user->email ?? '') }}" placeholder="Email Address" required />
                            </div>
                            <div class="single-input-item">
                                <label for="phone">Số điện thoại</label>
                                <input type="text" id="phone" name="phone"
                                    value="{{ old('phone', $user->phone ?? '') }}" placeholder="Phone" />
                            </div>
                            <div class="single-input-item">
                                <label for="com-name">Địa chỉ nhận hàng</label>
                                <input type="text" id="com-name" name="address"
                                    value="{{ old('address', $user->address ?? '') }}" placeholder="Địa chỉ nhận hàng" />
                            </div>
                            <div class="single-input-item">
                                <label for="ordernote">Ghi chú đơn hàng</label>
                                <textarea name="ordernote" id="ordernote" cols="30" rows="3" placeholder="Ghi chú về đơn hàng của bạn (VD: ghi chú cho việc giao hàng)">{{ old('ordernote') }}</textarea>
                            </div>
                        </div>

                        <!-- Add cart items as hidden fields -->
                        @foreach($cart as $item)
                        <input type="hidden" name="cart[{{ $loop->index }}][product_name]" value="{{ $item['product_name'] }}">
                        <input type="hidden" name="cart[{{ $loop->index }}][code_id]" value="{{ $item['code_id'] }}">
                        <input type="hidden" name="cart[{{ $loop->index }}][size_id]" value="{{ $item['size_id'] }}">
                        <input type="hidden" name="cart[{{ $loop->index }}][quantity]" value="{{ $item['quantity'] }}">
                        <input type="hidden" name="cart[{{ $loop->index }}][price]" value="{{ $item['price'] }}">
                        <input type="hidden" name="cart[{{ $loop->index }}][products_id]" value="{{ $item['products_id'] }}">
                        @endforeach

                        <div class="summary-footer-area">
                            @if (!session()->has('member_id')) <!-- Kiểm tra nếu không có member_id trong session -->
                            <div class="alert alert-warning">
                                Yêu cầu bạn đăng nhập lại hoặc tạo tài khoản trước khi thanh toán.

                            </div>
                            <ul>
                                <li><a href="{{ route('user.member.login.form') }}">Đăng nhập</a></li>
                                <li><a href="{{ route('user.member.register.form') }}">Tạo tài khoản</a></li>
                            </ul>
                            @else
                            <button type="submit" class="btn btn-sqr">Thanh toán</button>
                            @endif
                        </div>



                    </div>
                </div>

                <!-- Order Summary Details -->
                <div class="col-lg-6">
                    <div class="order-summary-details">
                        <h5 class="checkout-title">Đơn hàng cần thanh toán</h5>
                        <div class="order-summary-content">
                            <!-- Order Summary Table -->
                            <div class="order-summary-table table-responsive text-center">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Size</th>
                                            <th>Số lượng</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart as $item)
                                        <tr>
                                            <td><a href="product-details.html">{{ $item['product_name'] }} <strong> × {{ $item['quantity'] }}</strong></a></td>
                                            <td>{{ $item['code_id'] }}</td>
                                            <td>{{ $item['size'] }}</td>
                                            <td>{{ $item['quantity'] }}</td>
                                            <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}₫</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Tổng tiền cần thanh toán</td>
                                            <td><strong>{{ number_format($total, 0, ',', '.') }}₫</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="order-payment-method">
                                <div class="single-payment-method show">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="cashon" name="paymentmethod" value="0" class="custom-control-input" checked />
                                            <label class="custom-control-label" for="cashon">Thanh toán khi nhận hàng</label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="0">
                                        <p>Thanh toán bằng tiền mặt khi nhận hàng. Chỉ dành cho những đơn hàng có cửa hàng của Hữu Trí Jewelry
                                            ở gần thành phố đó và phải đặt cọc trước 10% đơn hàng và đơn
                                            hàng sẽ được giao sau 4 tiếng kể từ khi xác minh đơn hàng và đặt cọc thành công bên Zalo</p>
                                    </div>
                                </div>
                                <div class="single-payment-method">
                                    <div class="payment-method-name">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="directbank" name="paymentmethod" value="1" class="custom-control-input" />
                                            <label class="custom-control-label" for="directbank">Chuyển khoản ngân hàng trực tiếp</label>
                                        </div>
                                    </div>
                                    <div class="payment-method-details" data-method="1">
                                        <p>Thực hiện thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi.
                                            Vui lòng sử dụng Mã đơn hàng của bạn làm nội dung chuyển khoản thanh toán.
                                            Đơn hàng của bạn sẽ không được giao cho đến khi tiền đã được chuyển vào tài khoản của chúng tôi..
                                            Số tài khoản ngân hàng của chúng tôi là:
                                            <span class="highlight">12345678</span>
                                            Chủ sở hữu là:
                                            <span class="highlight">Trương Công Hữu</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        <div class="checkout-box-wrap">
            <div class="single-input-item">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="create_pwd">
                    <label class="custom-control-label" for="create_pwd">Những Lưu ý trước khi mua hàng và thanh toán</label>
                </div>
            </div>
            <div class="account-create single-form-row">
                <ul class="important-notes">
                    <li><strong>Thứ nhất:</strong> Khi khách hàng chọn thanh toán khi nhận hàng, yêu cầu phải đặt cọc 10% giá trị đơn hàng cho cửa hàng.</li>
                    <li><strong>Thứ hai:</strong> Khi tất cả sản phẩm chỉ có giá trị tại 1 thời điểm, nhưng khi khách hàng thay đổi kích thước, giá trị sản phẩm sẽ tăng lên. (Đơn hàng của quý khách khi chọn size giá của đơn hàng chưa được cập nhật sau khi đặt đơn hàng thành công nhân viên sẽ thực hiện liên hệ với khách hàng để giải thích về size và việc tăng giảm giá thành của sản phẩm khi thay đổi size.)</li>
                    <li><strong>Thứ ba:</strong> Sau khi khách hàng thực hiện đặt mua đơn hàng thành công, nếu chưa thấy nhân viên trả lời tới số điện thoại của khách hàng để xác nhận đơn hàng, vui lòng khách hàng liên hệ tới Zalo: <strong>0364452434</strong> để cung cấp đơn hàng, mã sản phẩm để nhân viên thực hiện kiểm tra đơn hàng, kiểm tra size, kiểm tra thông tin vị trí nhận hàng của khách hàng (việc này sẽ dẫn đến tăng hoặc giảm giá sản phẩm tùy vào từng size) đối với sản phẩm thanh toán online và trả sau.</li>
                    <li><strong>Thứ tư:</strong> Số điện thoại của khách hàng phải liên kết với Zalo để nhân viên xác minh, và email phải là email hoạt động.</li>
                </ul>

            </div>
        </div>
    </div>
</div>
</div>
@endsection