<?php

namespace App\Http\Controllers\Seller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Business;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

    public function index(Request $request)
    {
        return view('view-seller/auth/login');
    }

    public function register(Request $request)
    {
        return view('view-seller/auth/register');
    }

    public function getRegister(Request $request){
        $domain = request()->segment(2);
        $business= Business::where('domain',$domain)->first();
        $user = new Customer();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->business_id = $business->id;
        $user->save();
        return redirect()->back()->with('success', 'Đăng ký thành công');
    }

    public function authLoginCustomer(Request $request){
        $credentials = $request->only('email', 'password');
        $business_domain = request()->segment(2);
        $business= Business::where('domain',$business_domain)->first();
        try {
            $remember_token = true;
    
            if (Auth::guard('customer')->attempt($credentials) && Auth::guard('customer')->user()->business_id == $business->id) {
                // Đăng nhập thành công, thực hiện các thao tác cần thiết
                // Cập nhật trường last_login sau khi đăng nhập thành công
                
            $domain = request()->segment(2);
            $category_slug = request()->segment(3);
            $url = route('seller.business', ['domain' => $domain, 'category_slug' => $category_slug]);

            return redirect($url); 
            } else {
                return redirect()->back()->with('error', 'Sai thông tin đăng nhập');
            }
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Sai thông tin đăng nhập');
        }
    
        return redirect()->back()->withErrors(['message' => 'Email hoặc mật khẩu không chính xác'])->withInput();
    }

    public function authLogoutCustomer() {
        Auth::guard('customer')->logout(); // Đăng xuất người dùng khách hàng
        return redirect()->back();
    }
}