<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (session('admin_id')) {
            // Nếu đã đăng nhập, chuyển hướng tới trang home
            return view('admin.home');  // Hoặc có thể là route nào đó mà bạn muốn chuyển đến
        }

        // Nếu chưa đăng nhập, hiển thị trang đăng nhập và thêm thông báo vào session
        return view('admin.login.login')->with('error', 'Bạn chưa đăng nhập.');
    }


    public function login(Request $request)
    {
        // Kiểm tra nếu đã đăng nhập
        if (session('admin_id')) {
            return redirect()->route('admin.home');
        }

        $request->validate([
            'Email' => 'required|email',
            'Password' => 'required|min:6',
        ]);

        // Lấy thông tin admin theo email
        $admin = Admin::where('email', $request->Email)->first();

        if ($admin && Hash::check($request->Password, $admin->password)) {
            // Kiểm tra role_id và status
            if (in_array($admin->role_id, [1, 2, 3]) && $admin->status == 1) {
                // Đăng nhập thành công
                Auth::login($admin);  // Đăng nhập người dùng vào hệ thống

                // Lưu thông tin vào session nếu cần thiết
                session([
                    'admin_id' => $admin->admin_id,
                    'admin_name' => $admin->username,
                    'admin_image' => $admin->admin_image, // Hình ảnh admin
                    'role_id' => $admin->role_id // Lưu role_id
                ]);

                return redirect()->route('admin.home')->with('success', 'Đăng nhập thành công!');
            } else {
                if ($admin->status != 1) {
                    return back()->withErrors(['Tài khoản của bạn đã bị khóa.']);
                }
                return back()->withErrors(['Bạn không có quyền truy cập hệ thống.']);
            }
        } else {
            return back()->withErrors(['Email hoặc mật khẩu không đúng.']);
        }
    }




    public function logout()
    {
        Auth::logout(); // Đăng xuất người dùng

        // Xóa các thông tin khỏi session
        session()->forget('admin_name'); // Xóa tên người dùng
        session()->forget('admin_id');   // Xóa ID người dùng
        session()->forget('admin_image');   // Xóa hình ảnh người dùng

        // Thêm thông báo thành công vào session
        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công!'); // Chuyển hướng về trang đăng nhập
    }
}
