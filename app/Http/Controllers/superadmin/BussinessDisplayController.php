<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\BusinessCategory;
use App\BusinessDisplay;
use Illuminate\Http\Request;
use App\Http\Controllers\SelectOptionsController;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UploadDriverColtroller;

class BussinessDisplayController extends Controller
{
    public function index()
    {

        $business_display = BusinessDisplay::all();
        $business_category = BusinessCategory::all();

        return view('superadmin.bussiness_display.index', compact('business_display','business_category'));
    }

    public function create()
    {
        // Trả về view để hiển thị form tạo doanh nghiệp
        // return view('superadmin.businesses.create');
    }
    public function show($id)
    {
 
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // upload image
        $uploadController = new UploadDriverColtroller();
        $path_image = $uploadController->upload_image($request);

        $business_display = new BusinessDisplay();
        $business_display->vi_name = $request->vi_name;
        $business_display->en_name = $request->en_name;
        $business_display->slug = $request->slug;
        $business_display->business_category_id = $request->business_category_id;
        $business_display->image = $path_image;

        $business_display->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Thêm giao diện thành công');
    }

    public function edit($id)
    {
        $business_display = BusinessDisplay::findOrFail($id);
        $business_category = BusinessCategory::all();

        return view('superadmin.bussiness_display.edit',compact('business_display','id','business_category'));
    }

    public function update(Request $request, $id)
    {
        $business_display = BusinessDisplay::findOrFail($id);
        // Upload the image if it exists
        if ($request->hasFile('image')) {
            $uploadimage = new UploadDriverColtroller();
            $path_image = $uploadimage->upload_image($request);
            

            // Delete old image
            $deleteimage = new UploadDriverColtroller();
            $deleteimage->delete_image($user->image);
            
            $business_display->image = $path_image;
        }else{
            $business_display->image = $business_display->image;
        }
        $business_display->vi_name = $request->vi_name;
        $business_display->en_name = $request->en_name;
        $business_display->slug = $request->slug;
        $business_display->business_category_id = $request->business_category_id;
        $business_display->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Cập nhật giao diện thành công');
    }

    public function destroy($id)
    {
        $business_display = BusinessDisplay::findOrFail($id);
        // Delete the user's image
        $deleteimage = new UploadDriverColtroller();
        $deleteimage->delete_image($business_display->image);

        $business_display->delete();
        // Redirect or return a response
        return redirect()->back()->with('success', 'Xóa giao diện thành công');
    }

}
