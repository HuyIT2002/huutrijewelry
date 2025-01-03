@extends('welcome')
@section('content')

<!-- breadcrumb area start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Trang chủ</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- login register wrapper start -->
<div class="login-register-wrapper section-padding">
    <div class="container">
        <div class="member-area-from-wrap">
            <div class="row">
                <!-- Register Content Start -->
                <div class="col-lg-6">
                    <div class="login-reg-form-wrap sign-up-form">
                        <h5>Tạo tài khoản</h5>
                        <form action="{{ route('user.member.register.submit') }}" method="POST">
                            @csrf
                            <div class="single-input-item">
                                <input type="text" name="name" placeholder="Full Name" required />
                            </div>
                            <div class="single-input-item">
                                <input type="email" name="email" placeholder="Enter your Email" required />
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-input-item">
                                        <input type="password" name="password" placeholder="Enter your Password" required />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-input-item">
                                        <input type="text" name="phone" placeholder="Nhập số điện thoại trùng với số zalo" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="single-input-item">
                                    <input type="password" name="password_confirmation" placeholder="Confirm your Password" required />
                                </div>
                            </div>
                            <div class="single-input-item">
                                <button type="submit" class="btn btn-sqr">Tạo tài khoản</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Register Content End -->
            </div>
        </div>
    </div>
</div>
<!-- login register wrapper end -->

@endsection