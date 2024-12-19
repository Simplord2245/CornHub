<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function login()
    {
        return view('login');
    }

    // Xử lý đăng nhập
    public function logon(Request $request)
{
    // Validate dữ liệu đầu vào
    $request->validate([
        'username' => 'required|string|max:255',
        'password' => 'required|string|min:6',
    ]);

    // Lấy thông tin đăng nhập
    $credentials = $request->only('username', 'password');
    $remember = $request->has('remember');

    // Thử đăng nhập
    if (Auth::attempt($credentials, $remember)) {
        $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
        // Lưu thông tin vào Session
        Session::put('user_id', $user->id);               // Lưu ID người dùng
        Session::put('user_name', $user->fullname);       // Lưu tên đầy đủ
        Session::put('user_image', $user->profile_picture); // Lưu ảnh đại diện
        Session::put('user_role', $user->role);           // Lưu vai trò người dùng
        // Kiểm tra vai trò
        if ($user->role == '0') {
            return redirect()->route('movie.index'); // Chuyển hướng đến trang quản trị
        } else {
            return redirect()->route('login')->with('err', 'Bạn không có quyền truy cập!');
        }
    } else {
        // Sai thông tin đăng nhập
        return redirect()->route('login')->with('err', 'Tài khoản hoặc mật khẩu không hợp lệ');
    }
}

    public function logout()
    {
        Auth::logout(); // Hủy phiên đăng nhập
        Session::flush();
        return redirect()->route('login');
    }

    public function create()
    {
        
        return view('register');
    }
    public function register(Request $request)
{
        // Validate dữ liệu đầu vào với thông báo tuỳ chỉnh
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'full_name.required' => 'Họ và tên là bắt buộc.',
            'full_name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã được sử dụng.',
            'username.required' => 'Tên đăng nhập là bắt buộc.',
            'username.unique' => 'Tên đăng nhập đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        // Tạo tài khoản mới
        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 1, // Đặt vai trò mặc định
        ]);

        // Tự động đăng nhập
        Auth::login($user);

        // Chuyển hướng sau khi đăng ký thành công
        return redirect()->route('movie.index')->with('success', 'Đăng ký thành công!');
}
    public function index(){
        $users = User::where('role', 1)->paginate(13);
        return view('users', compact('users'));
    }
}
