<?php

namespace App\Http\Controllers\Seller;
use App\Http\Controllers\Controller;
use App\Business;
use App\BusinessCategory;
use App\BusinessService;
use Illuminate\Http\Request;
use App\Product;
use App\ProductDetail;


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
    return view('view-seller.' .$category. '/' .$request->display_slug.  '.all_product', compact('business','products'));
}

public function detail(Request $request, $domain, $category , $id){
    $business = $request->business;
    $product =  Product::find($id);
    $product_detail =  ProductDetail::where('product_id', $id)->first();
    // dd($product_detail);
    return view('view-seller.' .$category. '/' .$request->display_slug.  '.detail', compact('business','product','product_detail'));
}

}