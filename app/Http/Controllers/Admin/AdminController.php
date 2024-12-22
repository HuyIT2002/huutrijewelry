<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
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
        session()->forget('role_id');   // Xóa hình ảnh người dùng
        // Thêm thông báo thành công vào session
        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công!'); // Chuyển hướng về trang đăng nhập
    }

    public function index()
    {
        $admins = Admin::with('role')->paginate(10);
        $pageTitle = 'Danh sách tài khoản';
        return view('admin.accounts.danh-sach-tai-khoan', compact('admins', 'pageTitle'));
    }
    public function updateStatus($admin_id)
    {
        // Tìm admin theo admin_id
        $admin = Admin::find($admin_id);

        // Nếu không tìm thấy admin, trả về 404
        if (!$admin) {
            return redirect()->route('admin.accounts.index')->with('error', 'Tài khoản không tồn tại');
        }

        // Kiểm tra nếu role_id = 1, không cho phép thay đổi trạng thái
        if ($admin->role_id == 1) {
            return redirect()->route('admin.accounts.index')->with('error', 'Tài khoản có quyền cao nhất không thể chỉnh sửa trạng thái.');
        }

        // Chuyển đổi trạng thái của tài khoản
        $admin->status = $admin->status == 1 ? 0 : 1;
        $admin->save();

        // Trả về trang danh sách tài khoản với thông báo thành công
        return redirect()->route('admin.accounts.index')->with('success', 'Trạng thái tài khoản đã được cập nhật');
    }


    public function create()
    {
        // Lấy danh sách roles chỉ với type 2, 3, 4
        $roles = Role::whereIn('type', [2, 3, 4])->get();

        $pageTitle = 'Tạo mới thành viên mới';

        // Trả về view với dữ liệu đã lấy
        return view('admin.accounts.create', compact('pageTitle', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,role_id',
            'status' => 'required|boolean',
            'admin_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000', // Kiểm tra file upload
        ]);

        // Xử lý upload ảnh
        // Xử lý ảnh nếu có
        if ($request->hasFile('admin_image')) {
            $image = $request->file('admin_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Đặt tên ảnh
            // Di chuyển ảnh vào thư mục public/admin/images/post
            $image->move(public_path('admin/images/admin'), $imageName);
        } else {
            $imageName = null;
        }
        Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'status' => $request->status,
            'admin_image' => $imageName, // Lưu đường dẫn ảnh
            'created_at' => now(),
        ]);

        return redirect()->route('admin.accounts.create')->with('success', 'Tạo mới tài khoản thành công!');
    }
    public function destroy($admin_id)
    {
        // Tìm admin theo admin_id
        $admin = Admin::find($admin_id);

        // Kiểm tra nếu không tìm thấy admin
        if (!$admin) {
            return redirect()->route('admin.accounts.index')->with('error', 'Tài khoản không tồn tại');
        }

        // Kiểm tra xem tài khoản có quyền cao nhất (role_id = 1) hay không
        if ($admin->role_id == 1) {
            return redirect()->route('admin.accounts.index')->with('error', 'Không thể xóa tài khoản có quyền cao nhất');
        }

        // Xóa tài khoản nếu không phải là quyền cao nhất
        $admin->delete();

        // Trả về trang danh sách tài khoản với thông báo thành công
        return redirect()->route('admin.accounts.index')->with('success', 'Tài khoản đã được xóa');
    }
    public function edit($admin_id)
    {
        // Tìm bài viết theo ID
        $pageTitle = 'Chỉnh sửa thành viên';
        $accounts = Admin::findOrFail($admin_id);
        $roles = Role::whereIn('type', [2, 3, 4])->get();

        return view('admin.accounts.edit', compact('accounts', 'roles', 'pageTitle'));
    }
    public function update(Request $request, $admin_id)
    {
        // Tìm admin theo admin_id
        $admin = Admin::findOrFail($admin_id);  // Kiểm tra sự tồn tại của admin với khóa chính đúng

        // Validate dữ liệu
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin_id . ',admin_id',  // Đảm bảo sử dụng admin_id ở đây
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|exists:roles,role_id',
            'status' => 'required|boolean',
            'admin_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000', // Validate ảnh
        ]);

        // Cập nhật các thông tin khác
        $admin->username = $request->username;
        $admin->email = $request->email;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->role_id = $request->role_id;
        $admin->status = $request->status;

        // Xử lý ảnh nếu có ảnh mới
        if ($request->hasFile('admin_image')) {
            // Xóa ảnh cũ nếu có
            if ($admin->admin_image) {
                $oldImagePath = public_path($admin->admin_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Xóa ảnh cũ
                }
            }

            // Lưu ảnh mới
            $file = $request->file('admin_image');
            $fileName = time() . '.' . $file->getClientOriginalExtension(); // Đặt tên file là thời gian hiện tại
            $file->move(public_path('admin/images/admin'), $fileName); // Di chuyển ảnh vào thư mục
            $admin->admin_image = $fileName; // Chỉ lưu tên file trong cơ sở dữ liệu
        }

        $admin->save(); // Lưu lại dữ liệu

        return redirect()->route('admin.accounts.index')->with('success', 'Cập nhật tài khoản thành công');
    }
}
