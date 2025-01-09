<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GoldPriceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ParentCategoryController;
use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\GoldPriceControllerUsers;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [HomeUserController::class, 'index'])->name('home');


//about
Route::get('/ve-chung-toi', [AboutController::class, 'index']);

//admin home
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
});

// Nhóm route cho GoldPriceController
Route::prefix('gold-prices')
    ->name('admin.gold-prices.')
    ->middleware(['check.role:1,2']) // Chỉ cho phép role_id 1 và 2
    ->group(function () {
        Route::get('/', [GoldPriceController::class, 'index'])->name('index'); // Trang danh sách
        Route::get('/create', [GoldPriceController::class, 'create'])->name('create'); // Trang thêm mới
        Route::post('/', [GoldPriceController::class, 'store'])->name('store'); // Lưu dữ liệu
        Route::get('/edit/{gold_prices_id}', [GoldPriceController::class, 'edit'])->name('edit'); // Trang sửa
        Route::post('/update/{gold_prices_id}', [GoldPriceController::class, 'update'])->name('update'); // Cập nhật dữ liệu
        Route::delete('/delete/{gold_prices_id}', [GoldPriceController::class, 'destroy'])->name('destroy'); // Xóa
        Route::get('/update-status/{gold_prices_id}', [GoldPriceController::class, 'updateStatus'])->name('update-status'); // Cập nhật trạng thái
    });
// Nhóm route cho ProductController
Route::prefix('products')
    ->name('admin.products.')
    ->middleware(['check.role:1,2']) // Chỉ cho phép role_id 1 và 2
    ->group(function () {
        Route::get('/trang-quan-ly-san-pham', [ProductController::class, 'index'])->name('index'); // Trang danh sách
        Route::get('/create', [ProductController::class, 'create'])->name('create'); // Trang thêm mới
        Route::post('/', [ProductController::class, 'store'])->name('store'); // Lưu dữ liệu
        Route::get('/edit/{product_id}', [ProductController::class, 'edit'])->name('edit'); // Trang sửa
        Route::post('/update/{product_id}', [ProductController::class, 'update'])->name('update'); // Cập nhật dữ liệu
        Route::delete('/delete/{product_id}', [ProductController::class, 'destroy'])->name('destroy'); // Xóa
        Route::get('/update-status/{product_id}', [ProductController::class, 'updateStatus'])->name('update-status'); // Cập nhật trạng thái
    });


// Nhóm route cho CategoryController
Route::prefix('categories')
    ->name('admin.categories.')
    ->middleware(['check.role:1,2']) // Middleware kiểm tra quyền nếu cần
    ->group(function () {
        Route::get('/danh-muc-san-pham', [CategoryController::class, 'index'])->name('index'); // Trang danh sách
        Route::get('/create', [CategoryController::class, 'create'])->name('create'); // Trang thêm mới
        Route::post('/', [CategoryController::class, 'store'])->name('store'); // Xử lý thêm mới
        Route::get('/edit/{category_id}', [CategoryController::class, 'edit'])->name('edit'); // Trang sửa
        Route::post('/update/{category_id}', [CategoryController::class, 'update'])->name('update'); // Xử lý sửa
        Route::delete('/delete/{category_id}', [CategoryController::class, 'destroy'])->name('destroy'); // Xóa
        Route::get('/update-status/{category_id}', [CategoryController::class, 'updateStatus'])->name('update-status');
    });
// Nhóm route cho ParentCategoryController
Route::prefix('parent-categories')
    ->name('admin.parent-categories.')
    ->middleware(['check.role:1,2']) // Middleware kiểm tra quyền
    ->group(function () {
        Route::get('/danh-muc-cha', [ParentCategoryController::class, 'index'])->name('index'); // Trang danh sách
        Route::get('/create', [ParentCategoryController::class, 'create'])->name('create'); // Trang thêm mới
        Route::post('/', [ParentCategoryController::class, 'store'])->name('store'); // Xử lý thêm mới
        Route::get('/edit/{parent_categorie_id}', [ParentCategoryController::class, 'edit'])->name('edit'); // Trang sửa
        Route::post('/update/{parent_categorie_id}', [ParentCategoryController::class, 'update'])->name('update'); // Xử lý sửa
        Route::delete('/delete/{parent_categorie_id}', [ParentCategoryController::class, 'destroy'])->name('destroy'); // Xóa
        Route::get('/update-status/{parent_categorie_id}', [ParentCategoryController::class, 'updateStatus'])->name('update-status');
    });



// Nhóm route cho AdminController
Route::prefix('admin')->name('admin.')->group(function () {
    // Route để hiển thị form đăng nhập
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('login');

    // Route để xử lý đăng nhập (POST)
    Route::post('login', [AdminController::class, 'login']);

    // Các route khác của admin sẽ ở đây
    Route::middleware('admin.auth')->group(function () {
        Route::get('home', [HomeController::class, 'index'])->name('home');
    });

    // Route để xử lý đăng xuất (POST)
    Route::post('logout', [AdminController::class, 'logout'])->name('logout');
});

// Nhóm route cho CategoryPostController
Route::prefix('category-posts')
    ->name('admin.category-posts.')
    ->middleware(['check.role:1,2']) // Middleware kiểm tra quyền
    ->group(function () {
        Route::get('/', [CategoryPostController::class, 'index'])->name('index'); // Trang danh sách CategoryPost
        Route::get('/create', [CategoryPostController::class, 'create'])->name('create'); // Trang thêm mới CategoryPost
        Route::post('/', [CategoryPostController::class, 'store'])->name('store'); // Xử lý thêm mới CategoryPost
        Route::get('/edit/{category_post_id}', [CategoryPostController::class, 'edit'])->name('edit'); // Trang sửa CategoryPost
        Route::post('/update/{category_post_id}', [CategoryPostController::class, 'update'])->name('update'); // Xử lý sửa CategoryPost
        Route::delete('/delete/{category_post_id}', [CategoryPostController::class, 'destroy'])->name('destroy'); // Xóa CategoryPost
        Route::get('/update-status/{category_post_id}', [CategoryPostController::class, 'updateStatus'])->name('update-status'); // Cập nhật trạng thái CategoryPost
    });


Route::prefix('posts')
    ->name('admin.posts.')
    ->middleware(['check.role:1,2']) // Middleware kiểm tra quyền
    ->group(function () {
        // Trang danh sách bài viết
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/edit/{posts_id}', [PostController::class, 'edit'])->name('edit');
        Route::post('/update/{posts_id}', [PostController::class, 'update'])->name('update');
        Route::delete('/delete/{posts_id}', [CategoryPostController::class, 'destroy'])->name('destroy'); // Xóa CategoryPost
        Route::get('/update-status/{post_id}', [PostController::class, 'updateStatus'])->name('update-status');
        Route::get('/posts/{posts_id}', [PostController::class, 'show'])->name('admin.posts.show');
    });

Route::prefix('products')
    ->name('admin.products.')
    ->middleware(['check.role:1,2']) // Middleware kiểm tra quyền
    ->group(function () {
        // Trang danh sách sản phẩm
        Route::get('/danh-sach-san-pham', [ProductController::class, 'index'])->name('index');
        // Trang tạo mới sản phẩm
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        // Trang chỉnh sửa sản phẩm
        Route::get('/edit/{products_id}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/update/{products_id}', [ProductController::class, 'update'])->name('update');
        // Xóa sản phẩm
        Route::delete('/delete/{products_id}', [ProductController::class, 'destroy'])->name('destroy');
        // Trang chi tiết sản phẩm
        Route::get('/{products_id}', [ProductController::class, 'show'])->name('show');
        Route::get('/update-status/{products_id}', [ProductController::class, 'updateStatus'])->name('update-status');
    });
Route::prefix('sizes')
    ->name('admin.size.')
    ->middleware(['check.role:1,2']) // Middleware kiểm tra quyền
    ->group(function () {
        // Trang danh sách size
        Route::get('/danh-sach-size', [SizeController::class, 'index'])->name('index');
        // Trang tạo mới size
        Route::get('/create', [SizeController::class, 'create'])->name('create');
        Route::post('/store', [SizeController::class, 'store'])->name('store');
        // Trang chỉnh sửa size
        Route::get('/edit/{size_id}', [SizeController::class, 'edit'])->name('edit');
        Route::post('/update/{size_id}', [SizeController::class, 'update'])->name('update');
        // Xóa size
        Route::delete('/delete/{size_id}', [SizeController::class, 'destroy'])->name('destroy');
        Route::get('/update-status/{size_id}', [SizeController::class, 'updateStatus'])->name('update-status');
    });
Route::prefix('accounts')
    ->name('admin.accounts.')
    ->middleware(['role:1']) // Chỉ role_id = 1 được phép
    ->group(function () {
        Route::get('/danh-sach-tai-khoan', [AdminController::class, 'index'])->name('index');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::post('/store', [AdminController::class, 'store'])->name('store');
        Route::get('/edit/{admin_id}', [AdminController::class, 'edit'])->name('edit');
        Route::post('/update/{admin_id}', [AdminController::class, 'update'])->name('update');
        Route::delete('/delete/{admin_id}', [AdminController::class, 'destroy'])->name('destroy');
        Route::get('/update-status/{admin_id}', [AdminController::class, 'updateStatus'])->name('update-status');
    });



// user

Route::prefix('gold-prices')
    ->name('user.gold-prices.')
    ->group(function () {
        Route::get('/gia-vang-hom-nay', [GoldPriceControllerUsers::class, 'index'])->name('index');
    });
Route::prefix('blog')
    ->name('user.blog.')
    ->group(function () {
        Route::get('/blog-list', [BlogController::class, 'index'])->name('list');
        Route::get('/blog-details/{slug}', [BlogController::class, 'show'])->name('details');
    });
Route::prefix('shops')
    ->name('user.shops.')
    ->group(function () {
        // Route cho trang danh sách sản phẩm
        Route::get('/danh-sach-san-pham', [ShopController::class, 'index'])->name('list');

        // Route cho trang chi tiết sản phẩm
        Route::get('/chi-tiet-san-pham/{slug}/{products_id?}', [ShopController::class, 'show'])->name('details');

        Route::get('/category/{slug}', [ShopController::class, 'showCategoryProducts'])->name('search-products');
    });



Route::prefix('dich-vu')
    ->name('user.services.')
    ->group(function () {
        // Route cho trang danh sách dịch vụ
        Route::get('/', [ServiceController::class, 'index'])->name('list');
        Route::get('/chinh-sach-bao-hanh', [ServiceController::class, 'warrantyPolicy'])->name('warranty');
        Route::get('/do-size-nhan', [ServiceController::class, 'doSizeNhan'])->name('do-size-nhan');
        Route::get('/do-size-day-chuyen', [ServiceController::class, 'doSizeDayChuyen'])->name('do-size-day-chuyen');
        Route::get('/do-size-lac-vong', [ServiceController::class, 'showDoSizeLacVong'])->name('do-size-lac-vong');
    });
// Nhóm route cho member
Route::prefix('member')
    ->name('user.member.')
    ->group(function () {
        // Route cho trang đăng ký
        Route::get('/register', [MemberController::class, 'showRegisterForm'])->name('register.form');
        Route::post('/register', [MemberController::class, 'register'])->name('register.submit');

        // Route cho trang đăng nhập
        Route::get('/login', [MemberController::class, 'showLoginForm'])->name('login.form');
        Route::post('/login', [MemberController::class, 'login'])->name('login.submit');

        // Route cho trang logout
        Route::get('/logout', [MemberController::class, 'logout'])->name('logout');
        // Route cho trang thông tin tài khoản
        Route::get('/account-info', [MemberController::class, 'showAccountInfo'])->name('account.info');
        Route::post('/edit-account', [MemberController::class, 'updateAccount'])->name('update.account');
        Route::get('/edit-address', [MemberController::class, 'editAddressForm'])->name('edit.address');
        Route::post('/edit-address', [MemberController::class, 'updateAddress'])->name('update.address');
        Route::post('/update-password', [MemberController::class, 'updatePassword'])->name('update.password');
    });
Route::prefix('orders')
    ->name('user.orders.')
    ->group(function () {
        // Route cho trang danh sách đơn hàng
        Route::get('/', [OrderController::class, 'index'])->name('list');

        // Route cho trang chi tiết đơn hàng
        Route::get('/orders/details/{order_id}', [OrderController::class, 'show'])->name('details');
        Route::post('add-to-cart', [OrderController::class, 'addToCart'])->name('add-to-cart');
        Route::post('/update-cart', [OrderController::class, 'updateCart'])->name('updateCart');
        Route::get('remove/{productId}', [OrderController::class, 'removeFromCart'])->name('remove');
    });
Route::prefix('checkout')
    ->name('user.checkout.')
    ->group(function () {
        // Route để hiển thị trang thanh toán
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('view');

        // Route để xử lý thanh toán
        Route::post('process', [CheckoutController::class, 'processCheckout'])->name('process');
    });
