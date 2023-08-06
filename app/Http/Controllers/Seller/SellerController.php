<?php

namespace App\Http\Controllers\Seller;
use App\Http\Controllers\Controller;
use App\Business;
use App\BusinessCategory;
use App\BusinessService;
use Illuminate\Http\Request;
use App\Product;
use App\ProductDetail;
use App\ProductCategory;
use App\ProductSubcategory;


class SellerController extends Controller
{
public function index(Request $request, $domain, $category){
    // echo"<pre>";
    // print_r($request->business);die;
    $business = $request->business;
    $display_information = json_decode($request->business->display_information);
    $service_business = BusinessService::where('business_id', $business->id)->get();
    
    return view('view-seller.' .$category. '/' .$request->display_slug.  '.index', compact('business','display_information','service_business') );
}

public function all_product(Request $request, $domain, $category){
    $business = $request->business;
    $products =  Product::where('business_id', $business->id)->get();
    $product_categories =  ProductCategory::where('business_id', $business->id)->get();
    $product_subcategories =  ProductSubcategory::where('business_id', $business->id)->get();
    return view('view-seller.' .$category. '/' .$request->display_slug.  '.all_product', compact('business','products','product_categories','product_subcategories'));
}

public function detail(Request $request, $domain, $category , $id){
    $business = $request->business;
    $product =  Product::find($id);
    $product_detail =  ProductDetail::where('product_id', $id)->first();
    // dd($product_detail);
    return view('view-seller.' .$category. '/' .$request->display_slug.  '.detail', compact('business','product','product_detail'));
}

public function filterProduct(Request $request){
    $business = $request->business;
    $subcategories = array_filter($request->subcategories, function ($item) {
        return $item !== null;
    });
    if (!empty($subcategories)) {
        $products = Product::where('business_id', $business->id)
        ->whereIn('subcategory_id', $subcategories)
        ->get();
    }else{
        $products = Product::where('business_id', $business->id)->get();
    }

    return response()->json($products);

}
}