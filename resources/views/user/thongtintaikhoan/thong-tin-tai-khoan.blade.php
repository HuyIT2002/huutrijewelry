@extends('welcome')
@section('content')
<style>
    /* Modal Background Overlay */
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    /* Modal Content Styling */
    .modal-content {
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        border: none;
        animation: fadeIn 0.4s ease-out;
    }

    /* Animation for Modal */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Header Styling */
    .modal-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: #fff;
        padding: 20px;
        border-bottom: none;
        text-align: center;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .modal-header .btn-close {
        background: rgba(255, 255, 255, 0.8);
        color: #0056b3;
        border-radius: 50%;
        border: none;
        padding: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .modal-header .btn-close:hover {
        background: #fff;
        color: #007bff;
    }

    /* Body Styling */
    .modal-body {
        padding: 25px 20px;
        background-color: #f8f9fa;
    }

    .modal-body label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }

    .modal-body input {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 14px;
        width: 100%;
        background: #fff;
        transition: all 0.3s ease;
    }

    .modal-body input:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    /* Footer Styling */
    .modal-footer {
        padding: 15px 20px;
        background-color: #f1f1f1;
        border-top: none;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .modal-footer .btn {
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .modal-footer .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
    }

    .modal-footer .btn-secondary:hover {
        background-color: #5a6268;
    }

    .modal-footer .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
    }

    .modal-footer .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Responsive Styling */
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 20px;
        }

        .modal-content {
            padding: 10px;
        }

        .modal-header,
        .modal-footer {
            text-align: center;
        }
    }


    /*thông tin tài khoản */
    /* General Input Styling */
    input[readonly] {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        color: #6c757d;
        cursor: not-allowed;
        padding: 10px 15px;
        border-radius: 8px;
    }

    .single-input-item {
        margin-bottom: 20px;
    }

    .single-input-item label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
        color: #333;
    }

    .single-input-item input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        color: #495057;
        background-color: #fff;
        transition: border-color 0.3s ease;
    }

    .single-input-item input:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Button Styling */
    .btn-sqr {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-sqr:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
    }

    .btn-sqr:active {
        background-color: #004085;
        transform: translateY(0);
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        border: 1px solid #ddd;
    }

    .modal-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: #fff;
        padding: 20px 25px;
        border-bottom: 1px solid #ddd;
        font-size: 16px;
    }

    .modal-header .btn-close {
        background: rgba(255, 255, 255, 0.8);
        border: none;
        color: #333;
    }

    .modal-body {
        padding: 20px;
        font-size: 15px;
        color: #333;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        padding: 20px;
        background-color: #f8f9fa;
    }

    .modal-footer .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 600;
    }

    .modal-footer .btn-secondary:hover {
        background-color: #5a6268;
    }

    .modal-footer .btn-secondary:active {
        background-color: #495057;
    }
</style>
<style>
    .modal {
        display: none;
    }

    .modal-dialog {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        /* Đảm bảo modal nằm giữa màn hình */
    }

    .modal-body {
        max-height: 70vh;
        overflow-y: auto;
        /* Kích hoạt thanh cuộn */
    }

    @media (max-width: 768px) {
        .modal-lg {
            width: 90%;
            margin: auto;
        }

        .modal-content {
            margin: 10px;
            /* Tạo khoảng cách giữa modal và viền màn hình */
        }
    }

    .modal.fade.show {
        display: flex !important;
        align-items: center;
        justify-content: center;
        /* Đảm bảo modal hiển thị giữa màn hình */
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
                            <li class="breadcrumb-item active" aria-current="page">Thông tin tài khoản</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- my account wrapper start -->
<div class="my-account-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="#dashboad" class="active" data-bs-toggle="tab"><i class="fa fa-dashboard"></i>
                                        Dashboard</a>
                                    <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                                        Sản phẩm đã mua</a>
                                    <a href="#address-edit" data-bs-toggle="tab"><i class="fa fa-map-marker"></i>
                                        Địa chỉ của bạn</a>
                                    <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account
                                        Details</a>
                                    <a href="#download" data-bs-toggle="tab"><i class="fa fa-cloud-download"></i>
                                        Đổi mật khẩu</a>
                                    <a href="{{ route('user.member.logout') }}">
                                        <i class="fa fa-sign-out"></i> Đăng xuất
                                    </a>

                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Dashboard</h5>
                                            <div class="welcome">
                                                @if(session()->has('member_id'))
                                                <p>Chào bạn, <strong>{{ session('name') }}</strong>
                                                    (Nếu không phải là <strong>{{ session('name') }} !</strong>
                                                <form action="{{ route('user.member.logout') }}" method="GET" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" class="logout" style="background: none; border: none; color: #007bff; text-decoration: underline; cursor: pointer;">Đăng xuất</button>
                                                </form>
                                                </p>
                                                @else
                                                <p>Chào bạn, Khách! <a href="{{ route('user.member.login.form') }}" class="logout">Đăng nhập</a></p>
                                                @endif
                                            </div>


                                            <p class="mb-0">Từ bảng điều khiển tài khoản của bạn, bạn có thể dễ dàng kiểm tra &
                                                xem các đơn hàng gần đây, quản lý địa chỉ giao hàng và thanh toán
                                                và chỉnh sửa mật khẩu và thông tin tài khoản của bạn.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Sản phẩm đã đặt</h5>
                                            <div class="myaccount-table table-responsive text-center">
                                                <h4 class="mb-3">Danh sách đơn hàng của bạn</h4>
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Mã đơn hàng</th>
                                                            <th>Ngày đặt</th>
                                                            <th>Trạng thái</th>
                                                            <th>Phương thức thanh toán</th>
                                                            <th>Tổng tiền</th>
                                                            <th>Chi tiết</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if($orders->count() > 0)
                                                        @foreach($orders as $order)
                                                        <tr>
                                                            <td id="order-{{ $order->order_id }}">{{ $loop->iteration }}</td>

                                                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i') }}</td>
                                                            <td>
                                                                @switch($order->status)
                                                                @case(0)
                                                                <span class="badge bg-warning text-dark">Chưa duyệt</span>
                                                                @break
                                                                @case(1)
                                                                <span class="badge bg-success">Đã duyệt</span>
                                                                @break
                                                                @case(2)
                                                                <span class="badge bg-danger">Đã hủy</span>
                                                                @break
                                                                @case(3)
                                                                <span class="badge bg-info">Đang giao</span>
                                                                @break
                                                                @case(4)
                                                                <span class="badge bg-primary">Giao thành công</span>
                                                                @break
                                                                @endswitch
                                                            </td>
                                                            <td>{{ $order->paymentmethod == 0 ? 'Nhận hàng thanh toán' : 'Thanh toán qua thẻ' }}</td>
                                                            <td>{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                                                            <td>
                                                                <!-- Nút mở modal -->
                                                                <button type="button" class="btn btn-sqr btn-primary" data-bs-toggle="modal" data-bs-target="#orderDetailsModal-{{ $order->order_id }}">
                                                                    Xem chi tiết
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="6">Bạn chưa có đơn hàng nào.</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>

                                                <!-- Vòng lặp để đặt modal -->
                                                @foreach($orders as $order)
                                                <div class="modal fade" id="orderDetailsModal-{{ $order->order_id }}" tabindex="-1" aria-labelledby="orderDetailsModalLabel-{{ $order->order_id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <!-- Modal header -->
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" data-order-id="{{ $order->order_id }}">Chi Tiết Đơn Hàng #{{ $loop->iteration }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                @if($order->orderItems?->count() > 0)
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Sản phẩm</th>
                                                                            <th>Mã sản phẩm</th>
                                                                            <th>Size</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Giá</th>
                                                                            <th>Ngày đặt</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($order->orderItems as $item)
                                                                        <tr>
                                                                            <td>{{ $item->product->product_name ?? 'Không xác định' }}</td>
                                                                            <td>{{ $item->code_id ?? 'Không có' }}</td>
                                                                            <td>{{ $item->size->size ?? 'Không có' }}</td>
                                                                            <td>{{ $item->quantity }}</td>
                                                                            <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                                                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                @else
                                                                <p class="text-center">Không có sản phẩm trong đơn hàng này.</p>
                                                                @endif
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach


                                            </div>

                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Địa chỉ của bạn</h5>
                                            @if($member && $member->address)
                                            <address>
                                                <p><strong>{{ $member->name }}</strong></p>
                                                <p>{{ $member->address }}</p>
                                                <p>Mobile: {{ $member->phone }}</p>
                                            </address>
                                            @else
                                            <p>Bạn chưa có địa chỉ, vui lòng chỉnh sửa để thêm địa chỉ mới.</p>
                                            @endif
                                            <button type="button" class="btn btn-sqr" data-bs-toggle="modal" data-bs-target="#editAddressModal">
                                                <i class="fa fa-edit"></i> Chỉnh sửa địa chỉ
                                            </button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg"> <!-- Responsive kích thước modal -->
                                                <div class="modal-content">
                                                    <!-- Header Modal -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editAddressModalLabel">Chỉnh sửa địa chỉ</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <!-- Form chỉnh sửa -->
                                                    <form action="{{ route('user.member.update.address') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <!-- Form nhập địa chỉ -->
                                                            <div class="form-group">
                                                                <label for="address">
                                                                    <i class="fa fa-map-marker-alt" style="color: #007bff;"></i> Địa chỉ
                                                                </label>
                                                                <input type="text" id="address" name="address" class="form-control"
                                                                    value="{{ $member->address ?? '' }}" placeholder="Nhập địa chỉ mới" required>
                                                            </div>
                                                        </div>
                                                        <!-- Footer Modal -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Thông tin tài khoản </h5>
                                            <div class="account-details-form">
                                                <form>
                                                    <div class="single-input-item">
                                                        <label for="name" class="required">Họ và tên</label>
                                                        <input type="text" id="name" value="{{ $member->name ?? 'Chưa cập nhật' }}" readonly />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="email" class="required">Email</label>
                                                        <input type="email" id="email" value="{{ $member->email ?? 'Chưa cập nhật' }}" readonly />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="phone" class="required">Số điện thoại</label>
                                                        <input type="text" id="phone" value="{{ $member->phone ?? 'Chưa cập nhật' }}" readonly />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <button type="button" class="btn btn-sqr" data-bs-toggle="modal" data-bs-target="#editAccountModal">
                                                            Chỉnh sửa thông tin
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editAccountModalLabel">Chỉnh sửa thông tin tài khoản</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('user.member.update.account') }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="single-input-item">
                                                                    <label for="edit-name" class="required">Họ và tên</label>
                                                                    <input type="text" id="edit-name" name="name" class="form-control"
                                                                        value="{{ $member->name ?? '' }}" required />
                                                                </div>
                                                                <div class="single-input-item">
                                                                    <label for="edit-phone" class="required">Số điện thoại</label>
                                                                    <input type="text" id="edit-phone" name="phone" class="form-control"
                                                                        value="{{ $member->phone ?? '' }}" required />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                                <button type="submit" class="btn btn-primary">Lưu</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> <!-- Single Tab Content End -->
                                    <div class="tab-pane fade" id="download" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Đổi mật khẩu</h5>
                                            <div class="account-details-form">
                                                <form action="{{ route('user.member.update.password') }}" method="POST">
                                                    @csrf
                                                    <fieldset>
                                                        <!-- Mật khẩu cũ -->
                                                        <div class="single-input-item">
                                                            <label for="current-pwd" class="required">Mật khẩu cũ</label>
                                                            <input type="password" id="current-pwd" name="current_password" placeholder="Mật khẩu cũ" required />
                                                            @if ($errors->has('current_password'))
                                                            <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                                            @endif
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <!-- Mật khẩu mới -->
                                                                <div class="single-input-item">
                                                                    <label for="new-pwd" class="required">Mật khẩu mới</label>
                                                                    <input type="password" id="new-pwd" name="new_password" placeholder="Mật khẩu mới" required />
                                                                    @if ($errors->has('new_password'))
                                                                    <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <!-- Nhập lại mật khẩu mới -->
                                                                <div class="single-input-item">
                                                                    <label for="confirm-pwd" class="required">Nhập lại mật khẩu mới</label>
                                                                    <input type="password" id="confirm-pwd" name="new_password_confirmation" placeholder="Nhập lại mật khẩu mới" required />
                                                                    @if ($errors->has('new_password_confirmation'))
                                                                    <span class="text-danger">{{ $errors->first('new_password_confirmation') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item">
                                                        <button type="submit" class="btn btn-sqr">Chỉnh sửa mật khẩu</button>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection