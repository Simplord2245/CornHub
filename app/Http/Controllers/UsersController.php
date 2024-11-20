<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function login()
    {
        return view('login');
    }

    // Xử lý đăng nhập
    public function logon(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('movie.index');
        } else {
            return redirect()->route('login')->with('err', 'Sai tài khoản hoặc mật khẩu');
        }
    }

    public function logout()
    {
        Auth::logout(); // Hủy phiên đăng nhập
        return redirect()->route('login');
    }

    public function create()
    {

        return view('register');
    }

    public function register(Request $request)
    {
        $msg = "";
        try {
            $user = Users::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $msg = 'Đăng ký thành công';
        } catch (\Throwable $th) {
            $msg = 'Đăng ký THẤT BẠI';
        }

        return redirect()->route('login')->with('msg', $msg);
    }
}
