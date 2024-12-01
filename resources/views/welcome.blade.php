<!doctype html>
<html class="no-js" lang="en">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Huu Tri Jewelry | Trang chủ</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/public/assets/img/logo/logo_a.ico')}}">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/vendor/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/vendor/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/plugins/slick.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/plugins/animate.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/plugins/nice-select.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/plugins/jqueryui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/style.css')}}">

</head>

<body>

    @include('user.header')
    <main>
        @yield('content')
    </main>

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->

    @include('user.footer')
    <script src="{{ asset('/public/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{ asset('/public/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('/public/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('/public/assets/js/plugins/slick.min.js')}}"></script>
    <script src="{{ asset('/public/assets/js/plugins/countdown.min.js')}}"></script>
    <script src="{{ asset('/public/assets/js/plugins/nice-select.min.js')}}"></script>
    <script src="{{ asset('/public/assets/js/plugins/jqueryui.min.js')}}"></script>
    <script src="{{ asset('/public/assets/js/plugins/image-zoom.min.js')}}"></script>
    <script src="{{ asset('/public/assets/js/plugins/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ asset('/public/assets/js/plugins/ajaxchimp.js')}}"></script>
    <script src="{{ asset('/public/assets/js/plugins/ajax-mail.js')}}"></script>
    <script src="{{ asset('/public/assets/js/main.js')}}"></script>
</body>
</html>
