<header class="header fixed-top clearfix">
    <!--logo start-->
    <div class="brand">
        <a href="index.html" class="logo">
            Hữu Trí Jewelry
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <div class="top-nav clearfix">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <li>
                <input type="text" class="form-control search" placeholder=" Search">
            </li>
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img src="{{ asset('/public/admin/images/admin/' . session('admin_image', 'default.png')) }}" class="avatar">
                    <span class="user-id" style="display:none;">{{ session('admin_id') }}</span>
                    <span class="user-id" style="display:none;">{{ session('role_id') }}</span>
                    <span class="username">{{ session('admin_name', 'Guest') }}</span> <!-- Hiển thị tên người dùng từ session -->
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                    <!-- <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li> -->
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-key"></i> Đăng xuất
                        </a>
                    </li>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </ul>
            </li>
            <!-- user login dropdown end -->


        </ul>
        <!--search & user info end-->
    </div>
</header>