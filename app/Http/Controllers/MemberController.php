<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    //
    protected $categoryService;

    // Inject CategoryService vào controller
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function showRegisterForm()
    {
        $data = $this->categoryService->getAllCategoriesData();
        return view('user.register.register', $data); // Trỏ đến view form đăng ký
    }

    public function register(Request $request)
    {
        // Validating form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:15',
        ]);

        try {
            // Create member
            $member = Member::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => 1,
                'role_id' => 5,
                'created_at' => now(),
            ]);

            // Redirect to login page after successful registration
            return redirect()->route('user.member.login.form')->with('success', 'Tạo tài khoản thành công! Vui lòng đăng nhập.');
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo tài khoản.');
        }
    }


    public function showLoginForm()
    {
        $data = $this->categoryService->getAllCategoriesData();
        return view('user.login.login', $data); // Tạo view cho login
    }
    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to find the user by email
        $member = Member::where('email', $request->email)->first();

        if ($member && Hash::check($request->password, $member->password)) {
            // Check if the account is active (status == 1)
            if ($member->status == 0) {
                // Account is disabled
                return redirect()->back()->with('error', 'Tài khoản của bạn đã bị khóa.');
            }

            // Store user information in session if active
            session([
                'member_id' => $member->member_id,
                'name' => $member->name,
                'email' => $member->email,
                'phone' => $member->phone, // Add phone
                'address' => $member->address, // Add address
                'status' => $member->status
            ]);

            // Redirect to home page or dashboard
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        } else {
            // If authentication fails
            return redirect()->back()->with('error', 'Email hoặc mật khẩu không chính xác.');
        }
    }
    public function logout(Request $request)
    {
        // Xóa thông tin người dùng khỏi session
        $request->session()->forget(['member_id', 'name', 'email', 'status']);
        session()->flush();
        // Redirect về trang chủ hoặc trang khác
        return redirect()->route('home')->with('success', 'Đăng xuất thành công!');
    }
    public function showAccountInfo()
    {
        // Nếu chưa đăng nhập, chuyển hướng tới trang đăng nhập
        if (!session()->has('member_id')) {
            return redirect()->route('user.member.login.form');
        }

        // Lấy thông tin tài khoản người dùng từ session
        $member = Member::find(session('member_id'));
        $data = $this->categoryService->getAllCategoriesData();
        // Trả về view "thong-tin-tai-khoan" với thông tin tài khoản
        return view('user.thongtintaikhoan.thong-tin-tai-khoan', $data, compact('member'));
    }
    public function updateAddress(Request $request)
    {
        // Validate địa chỉ
        $request->validate([
            'address' => 'required|string|max:255',
        ]);

        // Cập nhật địa chỉ cho user hiện tại
        $member = Member::find(session('member_id'));
        if ($member) {
            $member->address = $request->address;
            $member->save();

            return redirect()->back()->with('success', 'Địa chỉ đã được cập nhật thành công.');
        }

        return redirect()->back()->with('error', 'Không thể cập nhật địa chỉ.');
    }
    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        // Lấy thông tin thành viên từ session
        $member = Member::find(session('member_id'));

        if ($member) {
            // Cập nhật thông tin
            $member->name = $request->input('name');
            $member->phone = $request->input('phone');
            $member->save();

            return redirect()->route('user.member.account.info')->with('success', 'Thông tin tài khoản đã được cập nhật.');
        }

        return redirect()->route('user.member.account.info')->with('error', 'Không tìm thấy người dùng.');
    }
    public function updatePassword(Request $request)
    {
        // Validate input
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed', // "confirmed" sẽ tự động kiểm tra 'new_password_confirmation'
        ]);

        // Lấy thông tin người dùng từ session
        $member = Member::find(session('member_id'));

        if (!$member) {
            return redirect()->back()->withErrors(['error' => 'Không tìm thấy người dùng.']);
        }

        // Kiểm tra mật khẩu cũ
        if (!Hash::check($request->current_password, $member->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu cũ không chính xác.']);
        }

        // Kiểm tra mật khẩu mới và xác nhận mật khẩu
        if ($request->new_password !== $request->new_password_confirmation) {
            return redirect()->back()->withErrors(['new_password' => 'Mật khẩu mới và xác nhận mật khẩu không khớp.']);
        }

        // Cập nhật mật khẩu mới
        $member->password = Hash::make($request->new_password);
        $member->save();

        // Đăng xuất người dùng sau khi thay đổi mật khẩu
        Auth::logout();

        // Chuyển hướng đến trang đăng nhập và thông báo thành công
        return redirect()->route('user.member.login.form')->with('success', 'Mật khẩu đã được thay đổi thành công. Vui lòng đăng nhập lại.');
    }
}
