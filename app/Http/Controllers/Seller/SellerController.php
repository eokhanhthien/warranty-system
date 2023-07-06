<?php

namespace App\Http\Controllers\Seller;
use App\Http\Controllers\Controller;
use App\Business;
use App\BusinessCategory;
use Illuminate\Http\Request;


class SellerController extends Controller
{
public function index(Request $request, $domain, $category){
    // echo"<pre>";
    // print_r($request->business);die;
    $business = $request->business;
    $display_information = json_decode($request->business->display_information);
 
    return view('view-seller.' .$category. '/' .$request->display_slug.  '.index', compact('business','display_information') );
}

public function about(Request $request, $domain, $category){
    $business = $request->business;

    return view('view-seller.' .$category. '/' .$request->display_slug.  '.about', compact('business'));
}


}