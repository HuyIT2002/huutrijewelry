@extends('welcome')
@section('content')
<!-- breadcrumb area start -->
<style>
    /* Cập nhật giao diện cho danh sách lưu ý quan trọng */
    .important-notes {
        list-style-type: none;
        padding-left: 0;
    }

    .important-notes li {
        font-size: 14px;
        line-height: 1.8;
        margin-bottom: 15px;
        padding-left: 20px;
        position: relative;
    }

    .important-notes li::before {
        content: '⚠️';
        /* Thêm biểu tượng cảnh báo */
        font-size: 20px;
        /* position: absolute; */
        left: 0;
        top: 0;
    }

    /* Responsive: Điều chỉnh cho mobile */
    @media (max-width: 767px) {
        .important-notes li {
            font-size: 12px;
            /* Giảm kích thước chữ trên màn hình nhỏ */
        }

        .important-notes li::before {
            font-size: 18px;
            /* Giảm kích thước biểu tượng trên màn hình nhỏ */
        }
    }

    /* cộng trừ sản phẩm */
    .pro-qty {
        display: flex;
        align-items: center;
    }

    .pro-qty input {
        width: 50px;
        text-align: center;
        margin: 0 10px;
    }

    .qtybtn {
        font-size: 18px;
        cursor: pointer;
    }
</style>

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.shops.list') }}">Cửa hàng trang sức</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- cart main wrapper start -->
<div class="cart-main-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Cart Table Area -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">STT</th>
                                    <th class="pro-thumbnail">Hình ảnh</th>
                                    <th class="pro-title">Tên sản phẩm</th>
                                    <th class="pro-title">Mã sản phẩm</th>
                                    <th class="pro-title">Trọng lượng của sản phẩm</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Tổng tiền</th>
                                    <th class="pro-remove">Xóa sản phẩm</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(session('cart') && count(session('cart')) > 0)
                                @foreach(session('cart') as $productId => $item)
                                <tr>
                                    <td class="pro-order">{{ $loop->iteration }}</td>
                                    <td class="pro-thumbnail">
                                        <a href="#">
                                            <img class="img-fluid" src="{{ asset('/public/admin/images/products/' . (isset($item['image']) ? $item['image'] : 'default.jpg')) }}" alt="Product" />
                                        </a>
                                    </td>

                                    <td class="pro-price">
                                        <span>{{ $item['code_id'] ?? 'Không có mã sản phẩm' }}</span>
                                    </td>

                                    <td class="pro-price">
                                        <span>{{ $item['trong_luong'] ?? 'Không có trọng lượng' }}</span>
                                    </td>

                                    <td class="pro-title">
                                        <a href="#">{{ $item['product_name'] ?? 'Tên sản phẩm không có' }}</a>
                                    </td>

                                    <td class="pro-subtotal">
                                        <span>{{ isset($item['price']) ? number_format($item['price'], 0, ',', '.') : '0' }} ₫</span>
                                    </td>

                                    <td class="pro-quantity">
                                        <div class="pro-qty">
                                            <span class="dec qtybtn">-</span>
                                            <input type="text" value="{{ $item['quantity'] }}" />
                                            <span class="inc qtybtn">+</span>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal-2">
                                        <span>
                                            {{ isset($item['price']) && isset($item['quantity']) ? number_format($item['price'] * $item['quantity'], 0, ',', '.') : '0' }} ₫
                                        </span>
                                    </td>

                                    <td class="pro-remove">
                                        <a href="{{ route('user.orders.remove', $productId) }}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6" class="text-center">Giỏ hàng của bạn trống!</td>
                                </tr>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 ml-auto">
                    <!-- Cart Calculation Area -->
                    <div class="cart-calculator-wrapper">
                        <div class="cart-calculate-items">
                            <h6>Tổng giá trị đơn hàng phải thanh toán</h6>
                            <div class="table-responsive">
                                @isset($total)
                                <table class="table">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>{{ number_format($total, 0, ',', '.') }} ₫</td>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <td class="total-amount">{{ number_format($total, 0, ',', '.') }} ₫</td>
                                    </tr>
                                </table>
                                @else
                                <p>Giỏ hàng của bạn trống!</p>
                                @endisset

                            </div>

                        </div>


                        <a href="{{ route('user.orders.create') }}" class="btn btn-sqr d-block">Thanh toán</a>
                    </div>
                </div>
                <div class="col-lg-5 ml-auto">
                    <!-- Cart Calculation Area -->
                    <div class="cart-calculator-wrapper">
                        <div class="cart-calculate-items">
                            <h6>Những Lưu ý quan trọng</h6>
                            <ul class="important-notes">
                                <li><strong>Thứ nhất:</strong> Khi khách hàng chọn thanh toán khi nhận hàng, yêu cầu phải đặt cọc 10% giá trị đơn hàng cho cửa hàng.</li>
                                <li><strong>Thứ hai:</strong> Khi tất cả sản phẩm chỉ có giá trị tại 1 thời điểm, nhưng khi khách hàng thay đổi kích thước, giá trị sản phẩm sẽ tăng lên. (Đơn hàng của quý khách
                                    khi chọn size giá của đơn hàng chưa được cập nhập sau khi đặt đơn hàng thành công nhân viên sẽ thực hiện liên hệ với khách hàng
                                    để giải thích về size và việc tăng giảm giá thành của sản phẩm khi thay đổi size )</li>
                                <li><strong>Thứ ba:</strong> Sau khi khách hàng thực hiện đặt mua đơn hàng thành công, nếu chưa thấy nhân viên trả lời tới số điện thoại của khách hàng để xác nhận đơn hàng, vui lòng khách hàng liên hệ tới Zalo: <strong>0364452434</strong> để cung cấp đơn hàng, mã sản phẩm để nhân viên thực hiện kiểm tra đơn hàng, kiểm tra size, kiểm tra thông tin vị trí nhận hàng của khách hàng (việc này sẽ dẫn đến tăng hoặc giảm giá sản phẩm tùy vào từng size) đối với sản phẩm thanh toán online và trả sau.</li>
                                <li><strong>Thứ tư:</strong> Số điện thoại của khách hàng phải liên kết với Zalo để nhân viên xác minh, và email phải là email hoạt động.</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- cart main wrapper end -->

    @endsection