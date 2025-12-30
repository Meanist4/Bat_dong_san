<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Hiển thị trang đăng nhập
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Thêm điều kiện status = 1 để chỉ cho phép user đang hoạt động đăng nhập
        $credentials['status'] = 1;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Phân hướng sau khi đăng nhập dựa trên role
            if (Auth::user()->role === 'admin' || Auth::user()->is_admin) {
                return redirect()->route('admin.rent-posts.index');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'login' => 'Tài khoản không chính xác hoặc đã bị khóa.'
        ])->withInput($request->only('email'));
    }

    /**
     * Hiển thị trang đăng ký
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Xử lý đăng ký thành viên mới
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ], [
            'full_name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Email không được để trống.',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password.min' => 'Mật khẩu phải từ 6 ký tự trở lên.',
        ]);

        User::create([
            'name' => $data['full_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',     // Mặc định là user thường
            'is_admin' => false,  // Mặc định không phải admin
            'status' => 1         // Mặc định là Active
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    /**
     * Đăng xuất
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}