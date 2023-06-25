<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class validateData extends Controller
{

public function validateDatabusiness(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required|numeric|digits_between:10,11',
        'business_category_id' => 'required',
        'province' => 'required',
        'district' => 'required',
        'ward' => 'required',
    ], [
        'name.required' => 'Vui lòng nhập tên doanh nghiệp.',
        'email.required' => 'Vui lòng nhập địa chỉ email.',
        'email.email' => 'Vui lòng nhập đúng định dạng email.',
        'phone_number.required' => 'Vui lòng nhập số điện thoại liên hệ.',
        'phone_number.numeric' => 'Vui lòng nhập số.',
        'phone_number.digits_between' => 'Số điện thoại phải dài hơn 9 và nhỏ hơn 12.',
        'phone_number.between' => 'Vui lòng nhập số hợp lệ.',
        'business_category_id.required' => 'Vui lòng chọn danh mục doanh nghiệp.',
        'province.required' => 'Vui lòng chọn tỉnh/thành phố.',
        'district.required' => 'Vui lòng chọn quận/huyện.',
        'ward.required' => 'Vui lòng chọn phường/xã.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ]);
    }

    return response()->json([
        'success' => true,
    ]);
}

public function validateDatateam(Request $request)
{
    // Tạo một mảng chứa các quy tắc cho Validator
    $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required|numeric|digits_between:10,11',
        'status' => 'required',
        'gender' => 'required',
        'birthday' => 'required',
        'role' => 'required',
        'business_id' => 'required',
        'province' => 'required',
        'district' => 'required',
        'ward' => 'required',
    ];

    // Kiểm tra xem có tồn tại $request->noPass hay không
    if ($request->has('noPass')) {
        // Nếu tồn tại $request->noPass và không có cả password
        if (!empty($request->has('password'))) {
            unset($rules['password']);
            unset($rules['repassword']);
        } else {
            // Nếu tồn tại $request->noPass và có cả password, kiểm tra trùng khớp giữa password và repassword
            $rules['repassword'] = 'required|same:password';
        }
    } else {
        // Nếu không tồn tại $request->noPass, thêm các quy tắc cho password và repassword
        $rules['password'] = 'required';
        $rules['repassword'] = 'required|same:password';
    }
    if($request->role == '1'){
        unset($rules['business_id']);
    }

    // Tạo Validator và áp dụng các quy tắc
    $validator = Validator::make($request->all(), $rules, [
        'name.required' => 'Vui lòng nhập tên doanh nghiệp.',
        'email.required' => 'Vui lòng nhập địa chỉ email.',
        'email.email' => 'Vui lòng nhập đúng định dạng email.',
        'phone_number.required' => 'Vui lòng nhập số điện thoại liên hệ.',
        'phone_number.numeric' => 'Vui lòng nhập số.',
        'phone_number.digits_between' => 'Số điện thoại phải dài hơn 9 và nhỏ hơn 12.',
        'phone_number.between' => 'Vui lòng nhập số hợp lệ.',
        'password.required' => 'Vui lòng nhập mật khẩu.',
        'repassword.required' => 'Vui lòng nhập mật khẩu.',
        'repassword.same' => 'Mật khẩu chưa khớp.',
        'status.required' => 'Vui lòng chọn trạng thái.',
        'gender.required' => 'Vui lòng chọn giới tính.',
        'birthday.required' => 'Vui lòng chọn ngày sinh.',
        'role.required' => 'Vui lòng chọn vai trò.',
        'business_id.required' => 'Vui lòng chọn danh mục doanh nghiệp.',
        'province.required' => 'Vui lòng chọn tỉnh/thành phố.',
        'district.required' => 'Vui lòng chọn quận/huyện.',
        'ward.required' => 'Vui lòng chọn phường/xã.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ]);
    }

    return response()->json([
        'success' => true,
    ]);
}

public function validateDatabusinessCategory(Request $request)
{
    $validator = Validator::make($request->all(), [
        'vi_name' => 'required',
        'en_name' => 'required',
        'description' => 'required',
    ], [
        'vi_name.required' => 'Vui lòng nhập tên danh mục.',
        'en_name.required' => 'Vui lòng nnhập tên danh mục.',
        'description.required' => 'Vui lòng nhập mô tả.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ]);
    }

    return response()->json([
        'success' => true,
    ]);
}


public function validateDatabusinessDisplay(Request $request)
{
    $validator = Validator::make($request->all(), [
        'vi_name' => 'required',
        'en_name' => 'required',
        'business_category_id' => 'required',
    ], [
        'vi_name.required' => 'Vui lòng nhập tên giao diện.',
        'en_name.required' => 'Vui lòng nnhập tên giao diện.',
        'business_category_id.required' => 'Vui lòng chọn danh mục.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ]);
    }

    return response()->json([
        'success' => true,
    ]);
}

public function validateDatabusinessSetting(Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'phone_number' => 'required|numeric|digits_between:10,11',
        'business_category_id' => 'required',
        'business_display_id' => 'required',
    ], [
        'name.required' => 'Vui lòng nhập tên doanh nghiệp.',
        'email.required' => 'Vui lòng nhập địa chỉ email.',
        'email.email' => 'Vui lòng nhập đúng định dạng email.',
        'phone_number.required' => 'Vui lòng nhập số điện thoại liên hệ.',
        'phone_number.numeric' => 'Vui lòng nhập số.',
        'phone_number.digits_between' => 'Số điện thoại phải dài hơn 9 và nhỏ hơn 12.',
        'phone_number.between' => 'Vui lòng nhập số hợp lệ.',
        'business_category_id.required' => 'Vui lòng chọn danh mục doanh nghiệp.',
        'business_display_id.required' => 'Vui lòng chọn giao diện doanh nghiệp.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ]);
    }

    return response()->json([
        'success' => true,
    ]);
}
}