<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\BusinessCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\SelectOptionsController;
use Illuminate\Support\Facades\Validator;

class BussinessCategoriesController extends Controller
{
    public function index()
    {

        $bussinessCategories = BusinessCategory::all();
        return view('superadmin.bussiness_categories.index', compact('bussinessCategories'));
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
        $business_category = new BusinessCategory();
        $business_category->vi_name = $request->vi_name;
        $business_category->en_name = $request->en_name;
        $business_category->slug = $request->slug;
        $business_category->description = $request->description;
        $business_category->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Business category added successfully');
    }

    public function edit($id)
    {
        $business_category = BusinessCategory::findOrFail($id);

        return view('superadmin.bussiness_categories.edit',compact('business_category','id'));
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
