<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
// use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\SelectOptionsController;
use Illuminate\Support\Facades\Validator;

class BusinessesController extends Controller
{
    public function index()
    {
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];
        return view('superadmin.businesses.index', compact('provinces', 'wards', 'districts'));
    }

    public function create()
    {
        // Trả về view để hiển thị form tạo doanh nghiệp
        // return view('superadmin.businesses.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
          // Kiểm tra và xử lý dữ liệu nhập vào từ form
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'business_category_id' => 'required',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Có lỗi xảy ra. Vui lòng kiểm tra lại thông tin.');
        }
        
        // Dữ liệu đã được validate thành công
        $validatedData = $validator->validated();

        // Tạo mới một doanh nghiệp với dữ liệu đã được validate
        // $business = Business::create($validatedData);

        // Chuyển hướng người dùng đến trang danh sách doanh nghiệp
        // return redirect()->route('superadmin.businesses.index')->with('success', 'Đã tạo mới doanh nghiệp thành công');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $item->update($validatedData);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }

}
