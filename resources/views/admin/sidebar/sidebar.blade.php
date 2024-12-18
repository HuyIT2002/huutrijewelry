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
                    <i class="fa fa-pencil"></i> <!-- Icon cho danh mục sản phẩm -->
                    <span>Danh mục bài viết</span>
                </a>
                <ul class="sub">
                    <!-- Thêm đường dẫn Category Post -->
                    <li><a href="{{ route('admin.category-posts.index') }}">
                            <i class="fa"></i>
                            Danh mục bài viết
                        </a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-newspaper-o"></i> <!-- Icon cho bài viết -->
                    <span>Bài viết</span>
                </a>
                <ul class="sub">
                    <!-- Đường dẫn cho Bài viết -->
                    <li><a href="{{ route('admin.posts.index') }}">
                            <i class="fa"></i> <!-- Icon cho Bài viết -->
                            Danh sách bài viết
                        </a></li>
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