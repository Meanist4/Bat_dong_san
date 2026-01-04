<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'name' => 'required|string|max:255',
            'phone_number' => 'sometimes|nullable|string|max:20|unique:users,phone_number',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            //required
            'username.required' => 'Vui Lòng Nhập username',
            'name.required' => 'Vui Lòng Nhập Tên',
            'email.required' => 'Email Không Được Để Trống',
            'password.required' => 'Mật Khẩu Không Được Để Trống',
            //unique
            'username.unique' => 'Username Này Đã Được Sử Dụng , Vui Lòng Nhập Username Khác',
            'phone_number.unique' => 'Số Điện Thoại Này Đã Được Sử Dụng',
            'email.unique' => 'Email Này Đã Được Sửa Dụng',
            //confirmed
            'password.confirmed' => 'Mật Khẩu Xác Nhận Không Khớp',
            //min
            'password.min' => 'Mật Khẩu Phải Có Ít Nhất 8 Ký Tự',
            //max
            'username.max' => 'Username Quá Dài , Vui Lòng Nhập Dưới 50 Ký Tự',
            'name.max' => 'Tên Quá Dài , Vui Lòng Nhập Dưới 255 Ký Tự',
            'phone_number.max' => 'Số Điện Thoại Quá Dài , Vui Lòng Nhập Dưới 20 Ký Tự',
            'email.max' => 'Email Quá Dài , Vui Lòng Nhập Dưới 255 Ký Tự',
            //string
            'username.string' => 'Username Phải Là Chuỗi Ký Tự',
            'name.string' => 'Tên Phải Là Chuỗi Ký Tự',
            'phone_number.string' => 'Số Điện Thoại Phải Là Chuỗi Ký Tự',
            'email.string' => 'Email Phải Là Chuỗi Ký Tự',
            //email
            'email.email' => 'Email Không Đúng Định Dạng',
        ]);

        $data = $request->only('username', 'name', 'phone_number', 'email', 'password');
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return redirect()->route('login')->with('success', 'Đăng Ký Tài Khoản Thành Công ! Vui Lòng Đăng Nhập');
        // Registration logic goes here
    }
    //
}
