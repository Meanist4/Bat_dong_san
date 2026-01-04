<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        //Login logic
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            //Required
            'login.required' => 'Vui Lòng Nhập Username Hoặc Email',
            'password.required' => 'Vui Lòng Nhập Mật Khẩu',
            //String
            'login.string' => 'Username Hoặc Email Phải Là Chuỗi Ký Tự',
            'password.string' => 'Mật Khẩu Phải Là Chuỗi Ký Tự',
        ]);
        //Xác định xem người dùng đã nhập email hay username
        $loginInput = $request->login;
        $field = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        //Xử lý đăng nhập sau khi xác thực
        $confirmData = [
            $field => $loginInput,
            'password' => $request->password,
        ];
        if (Auth::attempt($confirmData)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors([
            'login' => 'Thông tin đăng nhập không hợp lệ.',
            'password' => 'Thông tin đăng nhập không hợp lệ.',
        ])->only('login');
    }

    //
}
