<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

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
            // Ghi nhớ tôi $minutes = 120; 
            if (Auth::attempt($credentials)) {
                // $lifetimeMinutes = 120; // Thời gian sống là 120 phút (2 giờ)
                // config(['session.lifetime' => $lifetimeMinutes]);
                // Đăng nhập thành công, thực hiện các thao tác cần thiết
                // attempt sẽ tạo token, lưu thông tin vào session, v.v.
                if (Auth::check() && Auth::user()->role == 1) {
                    return redirect()->route('superadmin.dashboard');
                }elseif(Auth::check() && Auth::user()->role == 2){
                    return redirect()->route('admin.dashboard');
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

        public function getRegister(Request $request){
            // print_r($request->all());die;
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->status = 1;
            $user->role = 2;
            $user->save();
            return redirect()->back()->with('success', 'Đăng ký thành công');
        }
}
