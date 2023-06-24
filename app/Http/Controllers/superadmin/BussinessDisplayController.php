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

        $business_display = BusinessDisplay::get();
        return view('superadmin.bussiness_display.index', compact('business_display'));
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
        return redirect()->back()->with('success', 'Business display added successfully');
    }

    public function edit($id)
    {
        $business_category = BusinessCategory::findOrFail($id);

        return view('superadmin.bussiness_display.edit',compact('business_category','id'));
    }

    public function update(Request $request, $id)
    {
        $business_category = BusinessCategory::findOrFail($id);
        $business_category->vi_name = $request->vi_name;
        $business_category->en_name = $request->en_name;
        $business_category->slug = $request->slug;
        $business_category->description = $request->description;
        $business_category->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Business category updated successfully');
    }

    public function destroy($id)
    {
        $business_category = BusinessCategory::findOrFail($id);
        $business_category->delete();
        // Redirect or return a response
        return redirect()->back()->with('success', 'Business category deleted successfully');
    }

}
