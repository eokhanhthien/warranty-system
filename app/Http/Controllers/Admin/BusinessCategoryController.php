<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Business;
use App\ProductCategory;
use App\ProductSubcategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadDriverColtroller;

class BusinessCategoryController extends Controller
{
    public function index(Request $request){
  
        $categories =  ProductCategory::where('business_id',Auth::user()->business_id)->get();
        $subcategories =  ProductSubcategory::where('business_id',Auth::user()->business_id)->get();
    
        // dd($subcategories);
        return view('admin.categories_business.index',compact('categories','subcategories'));
    }

    public function create()
    {
        return view('admin.business.service.create');
    }

    public function store(Request $request)
    {
        if($request->type == "category"){
            $category = new ProductCategory();
            $category->name = $request->name;
            $category->business_id = Auth::user()->business_id;
            $category->save();
        }else{
            $subcategory = new ProductSubcategory();
            $subcategory->name = $request->name;
            $subcategory->category_id = $request->category_id;
            $subcategory->business_id = Auth::user()->business_id;
            $subcategory->save();
        }
        return redirect()->back()->with('success', 'thêm danh mục thành công');
    }

    public function show(BusinessService $businessService)
    {
        dd(123);
        // return view('admin.business.service.show', compact('businessService'));
    }

    public function edit(BusinessService $businessService)
    {
        
    }

    public function update(Request $request, $id)
    {
        if($request->type == "category"){
            $category =  ProductCategory::find($id);
            $category->name = $request->name;
            $category->save();
        }else{
            $subcategory = ProductSubcategory::find($id);
            $subcategory->name = $request->name;
            $subcategory->category_id = $request->category_id;
            $subcategory->save();
        }
        return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
    }
    

    public function destroy(Request $request, $id)
    {
        if($request->type == "category"){
            $category =  ProductCategory::find($id);
            $category->delete();;
        }else{
            $subcategory = ProductSubcategory::find($id);
            $subcategory->delete();;
        }
        return redirect()->back()->with('success', 'Xóa danh mục thành công');
    }


    public function getSubcategories($category_id)
    {
        $subcategories = ProductSubcategory::where(['category_id'=> $category_id, 'business_id' => Auth::user()->business_id])->get();
        return response()->json($subcategories);
    }
}