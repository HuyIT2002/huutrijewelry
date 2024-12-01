<!DOCTYPE html>

<head>
    <title>Admin | Login </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <link rel="icon" type="image/png" href="{{ asset('/public/assets/img/logo/logo_a.ico')}}">
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="stylesheet" href="{{ asset('/public/admin/css/bootstrap.min.css')}}">
    <link href="{{ asset('/public/admin/css/style-admin.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('/public/admin/css/style-responsive-admin.css')}}" rel="stylesheet" />
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('/public/admin/css/font-admin.css')}}" type="text/css" />
    <link href="{{ asset('/public/admin/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/public/admin/css/morris-admin.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/public/admin/css/monthly-admin.css')}}">

    <script src="{{ asset('/public/admin/js/jquery2.0.3.min.js')}}"></script>
</head>

<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Đăng Nhập</h2>

            <!-- Hiển thị lỗi nếu có -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Hiển thị thông báo thành công -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST">
                @csrf <!-- CSRF protection -->
                <input type="email" class="ggg" name="Email" placeholder="E-MAIL" required="">
                <input type="password" class="ggg" name="Password" placeholder="PASSWORD" required="">
                <div class="clearfix"></div>
                <input type="submit" value="Sign In" name="login">
            </form>
        </div>
    </div>

    <script src="{{ asset('/public/admin/js/bootstrap.js')}}"></script>
    <script src="{{ asset('/public/admin/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{ asset('/public/admin/js/scripts.js')}}"></script>
    <script src="{{ asset('/public/admin/js/jquery.slimscroll.js')}}"></script>
    <script src="{{ asset('/public/admin/js/jquery.nicescroll.js')}}"></script>
    <script src="{{ asset('/public/admin/js/jquery.scrollTo.js')}}"></script>
</body>

</html>