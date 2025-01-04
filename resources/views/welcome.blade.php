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
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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
    <script>

    </script>
    <!-- <script>
        $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
        $('.pro-qty').append('<span class="inc qtybtn">+</span>');
        $('.qtybtn').on('click', function() {
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $button.parent().find('input').val(newVal);
        });
    </script> -->
    <!-- <script>
        $(document).ready(function() {
            // Khi thay đổi số lượng
            $('.qtybtn').on('click', function() {
                var $input = $(this).siblings('.quantity-input'); // Lấy input chứa số lượng
                var currentValue = parseInt($input.val());
                var newValue = (this.className.includes('inc')) ? currentValue + 1 : currentValue - 1; // Tăng hoặc giảm

                // Nếu giá trị mới hợp lệ (lớn hơn 0)
                if (newValue >= 1) {
                    $input.val(newValue); // Cập nhật số lượng mới trong input

                    var price = $input.data('price'); // Giá sản phẩm
                    var productId = $input.data('product-id'); // ID sản phẩm

                    // Tính toán subtotal mới
                    var newSubtotal = newValue * price;

                    // Cập nhật lại tổng tiền trong bảng
                    $('td.subtotal-amount[data-product-id="' + productId + '"]').text(newSubtotal.toLocaleString() + ' ₫');

                    // Tự động gửi form để cập nhật giỏ hàng
                    $('#updateCartForm').submit();
                }
            });

            // Cập nhật giá trị subtotal khi người dùng thay đổi trực tiếp số lượng trong input
            $('.quantity-input').on('input', function() {
                var quantity = $(this).val(); // Số lượng mới
                var price = $(this).data('price'); // Giá của sản phẩm
                var productId = $(this).data('product-id'); // ID của sản phẩm

                // Tính toán subtotal mới
                var newSubtotal = quantity * price;

                // Cập nhật lại tổng tiền trong bảng
                $('td.subtotal-amount[data-product-id="' + productId + '"]').text(newSubtotal.toLocaleString() + ' ₫');

                // Tự động gửi form để cập nhật giỏ hàng
                $('#updateCartForm').submit();
            });
        });
    </script> -->
    <script>
        $(document).ready(function() {
            // Khi người dùng bấm nút tăng hoặc giảm
            $('.qtybtn2').on('click', function() {
                var $input = $(this).siblings('.quantity-input'); // Lấy input chứa số lượng
                var currentValue = parseInt($input.val()); // Lấy giá trị hiện tại
                var newValue = (this.className.includes('inc')) ? currentValue + 1 : currentValue - 1; // Tăng hoặc giảm

                // Nếu giá trị mới hợp lệ (lớn hơn hoặc bằng 1)
                if (newValue >= 1) {
                    $input.val(newValue); // Cập nhật lại số lượng trong input

                    var price = $input.data('price'); // Lấy giá của sản phẩm
                    var productId = $input.data('product-id'); // Lấy ID sản phẩm

                    // Tính toán subtotal mới
                    var newSubtotal = newValue * price;

                    // Cập nhật lại subtotal trong bảng
                    $('td.subtotal-amount[data-product-id="' + productId + '"]').text(newSubtotal.toLocaleString() + ' ₫');

                    // Tự động gửi form để cập nhật giỏ hàng
                    $('#updateCartForm').submit();
                }
            });

            // Cập nhật subtotal khi người dùng thay đổi trực tiếp số lượng trong input
            $('.quantity-input').on('input', function() {
                var quantity = $(this).val(); // Lấy số lượng mới
                var price = $(this).data('price'); // Lấy giá sản phẩm
                var productId = $(this).data('product-id'); // Lấy ID sản phẩm

                // Tính toán subtotal mới
                var newSubtotal = quantity * price;

                // Cập nhật lại subtotal trong bảng
                $('td.subtotal-amount[data-product-id="' + productId + '"]').text(newSubtotal.toLocaleString() + ' ₫');

                // Tự động gửi form để cập nhật giỏ hàng
                $('#updateCartForm').submit();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Cộng và trừ số lượng
            $('.qty-btn').on('click', function() {
                var $button = $(this);
                var $input = $button.siblings('.quantity-input'); // Lấy input chứa số lượng
                var oldValue = parseInt($input.val());

                // Cộng hoặc trừ số lượng
                if ($button.hasClass('inc')) {
                    var newVal = oldValue + 1;
                } else if ($button.hasClass('dec') && oldValue > 1) {
                    var newVal = oldValue - 1;
                } else {
                    var newVal = oldValue; // Không cho giảm dưới 1
                }

                // Cập nhật giá trị input
                $input.val(newVal);
            });
        });
    </script>
</body>

</html>