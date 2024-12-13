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

Route::get('/', function () {
    return view('welcome');
});
//home
Route::get('/', function () {
    return view('user.home.home');
});
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
        Route::get('/edit/{post_id}', [PostController::class, 'edit'])->name('edit');
        Route::post('/update/{post_id}', [PostController::class, 'update'])->name('update');
        Route::delete('/delete/{post_id}', [PostController::class, 'destroy'])->name('destroy');
        Route::get('/update-status/{post_id}', [PostController::class, 'updateStatus'])->name('update-status');
    });
