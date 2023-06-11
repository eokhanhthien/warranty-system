<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
// use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\SelectOptionsController;
class teamsController extends Controller
{
    public function index()
    {
        $selectOptionsController = new SelectOptionsController();
        $selectOptions = $selectOptionsController->getAddressOptions();
        $provinces = $selectOptions->getData()['provinces'];
        $wards = $selectOptions->getData()['wards'];
        $districts = $selectOptions->getData()['districts'];
        return view('superadmin.team.index', compact('provinces', 'wards', 'districts'));
    }

    public function create()
    {
        // Trả về view để hiển thị form tạo doanh nghiệp
        return view('superadmin.taff.create');
    }

    public function store(Request $request)
    {
        // Validate dữ liệu nhập vào từ form
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            // Các trường khác của doanh nghiệp
        ]);

        // Tạo mới một doanh nghiệp với dữ liệu đã được validate
        $business = Business::create($validatedData);

        // Chuyển hướng người dùng đến trang danh sách doanh nghiệp
        return redirect()->route('superadmin.taff.index')->with('success', 'Đã tạo mới doanh nghiệp thành công');
    }

    // Các phương thức khác của controller

}
