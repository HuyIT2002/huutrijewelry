<div id="sidebar" class="nav-collapse">
    <!-- sidebar menu start-->
    <div class="leftside-navigation">
        <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a class="active" href="index.html">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa-solid fa-coins"></i>
                    <span>Giá Vàng</span>
                </a>
                <ul class="sub">
                    <li>
                        <a href="{{ route('admin.gold-prices.index') }}">Bảng điều khiển giá vàng</a>
                    </li>
                </ul>

            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-gem"></i>
                    <span>Sản phẩm vàng</span>
                </a>
                <ul class="sub">
                    <li><a href="{{ route('admin.products.index') }}">Bảng điều khiển sản phẩm</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-list-alt"></i> <!-- Icon cho danh mục -->
                    <span>Danh mục sản phẩm</span>
                </a>
                <ul class="sub">
                    <li><a href="{{ route('admin.categories.index') }}">Danh sách danh mục con</a></li> <!-- Router danh sách -->
                    <li><a href="{{ route('admin.parent-categories.index') }}">Danh sách danh mục cha</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    <span>Mail </span>
                </a>
                <ul class="sub">
                    <li><a href="mail.html">Inbox</a></li>
                    <li><a href="mail_compose.html">Compose Mail</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class=" fa fa-bar-chart-o"></i>
                    <span>Charts</span>
                </a>
                <ul class="sub">
                    <li><a href="chartjs.html">Chart js</a></li>
                    <li><a href="flot_chart.html">Flot Charts</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class=" fa fa-bar-chart-o"></i>
                    <span>Maps</span>
                </a>
                <ul class="sub">
                    <li><a href="google_map.html">Google Map</a></li>
                    <li><a href="vector_map.html">Vector Map</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-glass"></i>
                    <span>Extra</span>
                </a>
                <ul class="sub">
                    <li><a href="gallery.html">Gallery</a></li>
                    <li><a href="404.html">404 Error</a></li>
                    <li><a href="registration.html">Registration</a></li>
                </ul>
            </li>
            <li>
                <a href="login.html">
                    <i class="fa fa-user"></i>
                    <span>Login Page</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- sidebar menu end-->
</div>