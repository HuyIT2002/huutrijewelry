<header class="header-area">
    <div class="main-header d-none d-lg-block">
        <div class="header-main-area">
            <div class="container">
                <div class="row align-items-center ptb-30">
                    <div class="col-lg-4">
                        <div class="header-social-link">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="logo text-center">
                            <a href="index-4.html">
                                <img src="{{ asset('/public/assets/img/logo/logo_a.png')}}" alt="Brand Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="header-right d-flex align-items-center justify-content-end">
                            <div class="header-configure-area">
                                <ul class="nav justify-content-end">
                                    <li class="header-search-container mr-0">
                                        <button class="search-trigger d-block"><i class="pe-7s-search"></i></button>
                                        <form class="header-search-box d-none">
                                            <input type="text" placeholder="Search entire store hire" class="header-search-field">
                                            <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                        </form>
                                    </li>
                                    <li class="user-hover">
                                        <a href="#">
                                            <i class="pe-7s-user"></i>
                                        </a>
                                        <ul class="dropdown-list">
                                            <li><a href="login-register.html">Đăng nhập</a></li>
                                            <li><a href="login-register.html">Tạo tài khoản</a></li>
                                            <li><a href="my-account.html">Trang cá nhân</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="wishlist.html">
                                            <i class="pe-7s-like"></i>
                                            <div class="notification">0</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="minicart-btn">
                                            <i class="pe-7s-shopbag"></i>
                                            <div class="notification">2</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-12">
                        <div class="main-menu-area sticky">
                            <div class="main-menu">
                                <nav class="desktop-menu">
                                    <ul class="justify-content-center header-style-4">
                                        <li class="active"><a href="{{ url('/') }}">Trang chủ</a>
                                        </li>
                                        <li><a href="shop.html">Sản Phẩm <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="#">shop grid layout <i class="fa fa-angle-right"></i></a>
                                                    <ul class="dropdown">
                                                        <li><a href="shop.html">shop grid left sidebar</a></li>
                                                        <li><a href="shop-grid-right-sidebar.html">shop grid right sidebar</a></li>
                                                        <li><a href="shop-grid-full-3-col.html">shop grid full 3 col</a></li>
                                                        <li><a href="shop-grid-full-4-col.html">shop grid full 4 col</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">shop list layout <i class="fa fa-angle-right"></i></a>
                                                    <ul class="dropdown">
                                                        <li><a href="shop-list-left-sidebar.html">shop list left sidebar</a></li>
                                                        <li><a href="shop-list-right-sidebar.html">shop list right sidebar</a></li>
                                                        <li><a href="shop-list-full-width.html">shop list full width</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">products details <i class="fa fa-angle-right"></i></a>
                                                    <ul class="dropdown">
                                                        <li><a href="product-details.html">product details</a></li>
                                                        <li><a href="product-details-affiliate.html">product details affiliate</a></li>
                                                        <li><a href="product-details-variable.html">product details variable</a></li>
                                                        <li><a href="product-details-group.html">product details group</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('user.blog.list') }}">Tin tức</a></li>
                                        <li><a href="blog-left-sidebar.html">Dịch Vụ <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="blog-left-sidebar.html">blog left sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ url('/gold-prices/gia-vang-hom-nay') }}">Giá Vàng Hôm Nay</a></li>
                                        <li><a href="{{ url('/ve-chung-toi') }}">Về chúng tôi</a></li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- mobile header start -->
    <div class="mobile-header d-lg-none d-md-block sticky">
        <!--mobile header top start -->
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="mobile-main-header">
                        <div class="mobile-logo">
                            <a href="index.html">
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

    <!-- offcanvas mobile menu start -->
    <aside class="off-canvas-wrapper">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-inner-content">
            <div class="btn-close-off-canvas">
                <i class="pe-7s-close"></i>
            </div>

            <div class="off-canvas-inner">
                <div class="search-box-offcanvas">
                    <form>
                        <input type="text" placeholder="Search Here...">
                        <button class="search-btn"><i class="pe-7s-search"></i></button>
                    </form>
                </div>

                <!-- mobile menu start -->
                <div class="mobile-navigation">

                    <!-- mobile menu navigation start -->
                    <nav class="mobile-menu">
                        <ul>
                            <li class="menu-item-has-children"><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li class="menu-item-has-children">
                                <a href="#">Sản Phẩm <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown">
                                    <li class="menu-item-has-children"><a href="#">Shop Grid Layout <i class="fa fa-angle-right"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="shop.html">Shop Grid Left Sidebar</a></li>
                                            <li><a href="shop-grid-right-sidebar.html">Shop Grid Right Sidebar</a></li>
                                            <li><a href="shop-grid-full-3-col.html">Shop Grid Full 3 Col</a></li>
                                            <li><a href="shop-grid-full-4-col.html">Shop Grid Full 4 Col</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Shop List Layout <i class="fa fa-angle-right"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="shop-list-left-sidebar.html">Shop List Left Sidebar</a></li>
                                            <li><a href="shop-list-right-sidebar.html">Shop List Right Sidebar</a></li>
                                            <li><a href="shop-list-full-width.html">Shop List Full Width</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children"><a href="#">Products Details <i class="fa fa-angle-right"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="product-details.html">Product Details</a></li>
                                            <li><a href="product-details-affiliate.html">Product Details Affiliate</a></li>
                                            <li><a href="product-details-variable.html">Product Details Variable</a></li>
                                            <li><a href="product-details-group.html">Product Details Group</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="{{ route('user.blog.list') }}">Tin Tức</a></li>
                            <li class="menu-item-has-children">
                                <a href="#">Dịch Vụ <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown">
                                    <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/gold-prices/gia-vang-hom-nay') }}">Giá Vàng Hôm Nay</a></li>
                            <li><a href="{{ url('/ve-chung-toi') }}">Về Chúng Tôi</a></li>
                        </ul>
                    </nav>

                    <!-- mobile menu navigation end -->
                </div>
                <!-- mobile menu end -->

                <div class="mobile-settings">
                    <ul class="nav">
                        <li>
                            <div class="dropdown mobile-top-dropdown">
                                <a href="#" class="dropdown-toggle" id="currency" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Currency
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="currency">
                                    <a class="dropdown-item" href="#">$ USD</a>
                                    <a class="dropdown-item" href="#">$ EURO</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown mobile-top-dropdown">
                                <a href="#" class="dropdown-toggle" id="myaccount" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    My Account
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="myaccount">
                                    <a class="dropdown-item" href="my-account.html">my account</a>
                                    <a class="dropdown-item" href="login-register.html"> login</a>
                                    <a class="dropdown-item" href="login-register.html">register</a>
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