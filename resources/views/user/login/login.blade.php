@extends('welcome')
@section('content')

<style>
    /* Tùy chỉnh kiểu thông báo thành công */
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    /* Tùy chỉnh kiểu thông báo lỗi */
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
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
                    <div class="login-reg-form-wrap">
                        <h5>Sign In</h5>

                        <!-- Display success message -->
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Display error message -->
                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        <form action="{{ route('user.member.login.submit') }}" method="POST">
                            @csrf
                            <div class="single-input-item">
                                <input type="email" name="email" placeholder="Email or Username" required />
                            </div>
                            <div class="single-input-item">
                                <input type="password" name="password" placeholder="Enter your Password" required />
                            </div>
                            <div class="single-input-item">
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="remember-meta">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                        </div>
                                    </div>
                                    <a href="#" class="forget-pwd">Forget Password?</a>
                                </div>
                            </div>
                            <div class="single-input-item">
                                <button type="submit" class="btn btn-sqr">Login</button>
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
