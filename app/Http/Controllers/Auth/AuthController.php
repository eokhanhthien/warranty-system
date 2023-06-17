<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
 
    public function __construct()
    {
        
    }

    public function index(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function authLogin(Request $request){
        $credentials = $request->only('email', 'password');

        try {
            $remember_token = true;
            if (Auth::attempt($credentials, $remember_token)) {
                // Đăng nhập thành công, thực hiện các thao tác cần thiết
                // Ví dụ: Tạo token, lưu thông tin vào session, v.v.
                if (Auth::check()) {
                    return redirect()->route('dashboard');
                }    
            }
        } catch (ValidationException $e) {
            // Xử lý ngoại lệ nếu có lỗi xác thực
            // Ví dụ: Hiển thị thông báo lỗi, chuyển hướng đến trang đăng nhập, v.v.
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // Xử lý trường hợp đăng nhập không thành công
        // Ví dụ: Hiển thị thông báo lỗi, chuyển hướng đến trang đăng nhập, v.v.
        return redirect()->back()->withErrors(['message' => 'Email hoặc mật khẩu không chính xác'])->withInput();
        }

        public function logout()
        {
            Auth::logout();
            // Chuyển hướng người dùng về trang đăng nhập hoặc trang khác
            return redirect()->route('login');
        }
}
