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
}