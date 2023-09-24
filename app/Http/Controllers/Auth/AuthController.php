<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Socialite;

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

                // Cập nhật trường last_login sau khi đăng nhập thành công
                if (Auth::check()) {
                    Auth::user()->update(['last_login' => Carbon::now()]);
                }
                if (Auth::check() && Auth::user()->role == 1) {
                    return redirect()->route('superadmin.dashboard');
                }elseif(Auth::check() && Auth::user()->role == 2){
                    return redirect()->route('admin.dashboard');
                }   
            }else{
                return redirect()->back()->with('error', 'Sai thông tin đăng nhập');
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

        // Đăng nhập google
        public function redirectToGoogle()
        {
            return Socialite::driver('google')->stateless()->redirect();
        }
        
        public function handleGoogleCallback()
        {
            $getInfo = Socialite::driver('google')->stateless()->user();
          
            $user = User::where('email', $getInfo->email)->first();     
            if (!$user) {
            $new_user = new User();
            $new_user->name = $getInfo->name;
            $new_user->email = $getInfo->email;
            $new_user->status = 2;
            $new_user->verify_email_at = Carbon::now();
            $new_user->role = 2;
            $new_user->password = bcrypt('Abc@123456');
            $new_user->save();
            
            auth()->login($new_user);
            return redirect()->route('admin.dashboard');
            }else {
                if($user->role == 1){
                    auth()->login($user);
                    return redirect()->route('superadmin.dashboard');
                }else{
                    auth()->login($user);
                    return redirect()->route('admin.dashboard');
                }
            }

        }
}
