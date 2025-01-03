<header class="header-area header-wide">
    <!-- main header start -->
    <div class="main-header d-none d-lg-block">

        <!-- header middle area start -->
        <div class="header-main-area sticky">
            <div class="container">
                <div class="row align-items-center position-relative">

                    <!-- start logo area -->
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('/public/assets/img/logo/logo_a.png')}}" alt="Brand Logo">
                            </a>
                        </div>
                    </div>
                    <!-- start logo area -->

                    <!-- main menu area start -->
                    <div class="col-lg-6 position-static">
                        <div class="main-menu-area">
                            <div class="main-menu">
                                <!-- main menu navbar start -->
                                <nav class="desktop-menu">
                                    <ul>
                                        <li class="active"><a href="{{ url('/') }}">Giới thiệu <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="{{ route('user.services.list') }}">Chính sách thu đổi</a></li>
                                                <li><a href="{{ route('user.services.warranty') }}">Chính sách bảo hành</a></li>
                                                <li><a href="{{ url('/ve-chung-toi') }}">Về chúng tôi</a></li>
                                                <li><a href="#">Hệ thống của hàng </a></li>
                                                <li><a href="#">Khách hàng thân thiêt </a></li>
                                                <li><a href="#">Tuyển dụng </a></li>
                                            </ul>
                                        </li>
                                        <li class="position-static"><a href="{{ route('user.shops.list') }}">Sản phẩm <i class="fa fa-angle-down"></i></a>
                                            <ul class="megamenu dropdown">
                                                @foreach ($parentCategories as $parent)
                                                <li class="mega-title">
                                                    <span>{{ $parent->name }}</span>
                                                    <ul>
                                                        @foreach ($parent->categories as $category)
                                                        <li><a href="{{ url('category/' . $category->slug) }}">{{ $category->category_name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                @endforeach
                                                <li class="megamenu-banners d-none d-lg-block">
                                                    <a href="product-details.html">
                                                        <img src="assets/img/banner/img1-static-menu.jpg" alt="">
                                                    </a>
                                                </li>
                                                <li class="megamenu-banners d-none d-lg-block">
                                                    <a href="product-details.html">
                                                        <img src="assets/img/banner/img2-static-menu.jpg" alt="">
                                                    </a>
                                                </li>
                                            </ul>

                                        </li>
                                        <li><a href="shop.html">Trang sức cưới <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown">
                                                @foreach ($categories as $category)
                                                <li><a href="#">{{ $category->category_name }}</a></li>
                                                @endforeach
                                            </ul>

                                        </li>
                                        <li><a href="shop.html">Kim cương <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown">
                                                @foreach ($categories_kimcuong as $category)
                                                <li><a href="#">{{ $category->category_name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="contact-us.html">Trang sức PNJ</a></li>
                                        <li><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="{{ url('/gold-prices/gia-vang-hom-nay') }}">Giá Vàng Hôm Nay</a></li>
                                                <li><a href="{{ route('user.blog.list') }}">Blog</a></li>
                                                <li><a href="#">Liên hệ</a></li>
                                                <li><a href="{{ route('user.services.do-size-nhan') }}">Hướng dẫn đo size Nhẫn</a></li>
                                                <li><a href="{{ route('user.services.do-size-day-chuyen') }}">Hướng dẫn đo size Dây Chuyền, Dây cổ , Kiềng</a></li>
                                                <li><a href="{{ route('user.services.do-size-lac-vong') }}">Hướng dẫn đo size lắc tay và vòng tay</a></li> <!-- Thêm link này --> <!-- Thêm link này -->
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                                <!-- main menu navbar end -->
                            </div>
                        </div>
                    </div>
                    <!-- main menu area end -->

                    <!-- mini cart area start -->
                    <div class="col-lg-4">
                        <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                            <div class="header-search-container">
                                <button class="search-trigger d-xl-none d-lg-block"><i class="pe-7s-search"></i></button>
                                <form class="header-search-box d-lg-none d-xl-block">
                                    <input type="text" placeholder="Search entire store hire" class="header-search-field">
                                    <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                </form>
                            </div>
                            <div class="header-configure-area">
                                <ul class="nav justify-content-end">
                                    <li class="user-hover">
                                        <a href="#">
                                            <i class="pe-7s-user"></i>
                                        </a>
                                        <ul class="dropdown-list">
                                            @if(session('member_id'))
                                            <!-- Nếu đã đăng nhập -->
                                            <li><a href="{{ route('user.member.logout') }}">Đăng xuất</a></li>
                                            <li><a href="{{ route('user.member.account.info') }}">Thông tin tài khoản</a></li>
                                            @else
                                            <!-- Nếu chưa đăng nhập -->
                                            <li><a href="{{ route('user.member.login.form') }}">Đăng nhập</a></li>
                                            <li><a href="{{ route('user.member.register.form') }}">Tạo tài khoản</a></li>
                                            @endif
                                        </ul>

                                    </li>
                                    <li>
                                        <a href="{{ route('user.orders.list') }}" class="minicart-btn">
                                            <i class="pe-7s-shopbag"></i>
                                            <div class="notification">
                                                {{ session('cart') ? count(session('cart')) : 0 }} <!-- Đếm số sản phẩm trong giỏ -->
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- mini cart area end -->

                </div>
            </div>
        </div>
        <!-- header middle area end -->
    </div>
    <!-- main header start -->

    <!-- mobile header start -->
    <!-- mobile header start -->
    <div class="mobile-header d-lg-none d-md-block sticky">
        <!--mobile header top start -->
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="mobile-main-header">
                        <div class="mobile-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('/public/assets/img/logo/logo_a.png')}}" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="mobile-menu-toggler">
                            <div class="mini-cart-wrap">
                                <a href="cart.html">
                                    <i class="pe-7s-shopbag"></i>
                                    <div class="notification">0</div>
                                </a>
                            </div>
                            <button class="mobile-menu-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile header top start -->
    </div>
    <!-- mobile header end -->
    <!-- mobile header end -->

    <!-- offcanvas mobile menu start -->
    <!-- off-canvas menu start -->
    <aside class="off-canvas-wrapper">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-inner-content">
            <div class="btn-close-off-canvas">
                <i class="pe-7s-close"></i>
            </div>

            <div class="off-canvas-inner">
                <!-- search box start -->
                <div class="search-box-offcanvas">
                    <form>
                        <input type="text" placeholder="Search Here...">
                        <button class="search-btn"><i class="pe-7s-search"></i></button>
                    </form>
                </div>
                <!-- search box end -->

                <!-- mobile menu start -->
                <div class="mobile-navigation">

                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><a href="{{ url('/') }}">Giới thiệu</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('user.services.list') }}">Chính sách thu đổi</a></li>
                                    <li><a href="{{ route('user.services.warranty') }}">Chính sách bảo hành</a></li>
                                    <li><a href="{{ url('/ve-chung-toi') }}">Về chúng tôi</a></li>
                                    <li><a href="#">Hệ thống của hàng </a></li>
                                    <li><a href="#">Khách hàng thân thiêt </a></li>
                                    <li><a href="#">Tuyển dụng </a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children "><a href="#">Tin tức</a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/gold-prices/gia-vang-hom-nay') }}">Giá Vàng Hôm Nay</a></li>
                                    <li><a href="{{ route('user.blog.list') }}">Blog</a></li>
                                    <li><a href="#">Liên hệ</a></li>
                                    <li><a href="#">Hướng dẫn đo size</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children"><a href="#">Sản phẩm</a>
                                <ul class="megamenu dropdown">
                                    @foreach($parentCategories as $parentCategory)
                                    <li class="mega-title menu-item-has-children">
                                        <a href="#">{{ $parentCategory->name }}</a>
                                        <ul class="dropdown">
                                            @foreach($parentCategory->categories as $category)
                                            <li><a href="{{ url('shop/'.$category->slug) }}">{{ $category->category_name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>

                            </li>
                            <li class="menu-item-has-children "><a href="shop.html">Trang sức cưới</a>
                                <ul class="dropdown">
                                    @foreach ($categories as $category)
                                    <li><a href="#">{{ $category->category_name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="menu-item-has-children "><a href="shop.html">Kim cương</a>
                                <ul class="dropdown">
                                    @foreach ($categories_kimcuong as $category)
                                    <li><a href="#">{{ $category->category_name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="contact-us.html">Trang sức PNJ</a></li>

                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
                <!-- mobile menu end -->

                <div class="mobile-settings">
                    <ul class="nav">

                        <li>
                            <div class="dropdown mobile-top-dropdown">
                                <a href="#" class="dropdown-toggle" id="myaccount" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    My Account
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="myaccount">
                                    @if(session('member_id'))
                                    <!-- Nếu đã đăng nhập -->
                                    <a class="dropdown-item" href="{{ route('user.member.account.info') }}">Thông tin tài khoản</a>
                                    <a class="dropdown-item" href="{{ route('user.member.logout') }}">Đăng xuất</a>
                                    @else
                                    <!-- Nếu chưa đăng nhập -->
                                    <a class="dropdown-item" href="{{ route('user.member.login.form') }}">Đăng nhập</a>
                                    <a class="dropdown-item" href="{{ route('user.member.register.form') }}">Tạo tài khoản</a>
                                    @endif
                                </div>

                            </div>
                        </li>
                    </ul>
                </div>

                <!-- offcanvas widget area start -->
                <div class="offcanvas-widget-area">
                    <div class="off-canvas-contact-widget">
                        <ul>
                            <li><i class="fa fa-mobile"></i>
                                <a href="#">0123456789</a>
                            </li>
                            <li><i class="fa fa-envelope-o"></i>
                                <a href="#">info@yourdomain.com</a>
                            </li>
                        </ul>
                    </div>
                    <div class="off-canvas-social-widget">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>
                <!-- offcanvas widget area end -->
            </div>
        </div>
    </aside>
    <!-- off-canvas menu end -->
    <!-- offcanvas mobile menu end -->
</header>