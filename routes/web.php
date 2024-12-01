<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GoldPriceController;
use App\Http\Controllers\Admin\AdminController;
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
