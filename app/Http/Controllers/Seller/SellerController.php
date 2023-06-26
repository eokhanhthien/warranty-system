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
    // print_r($request->display_slug);die;
    return view('view-seller.' .$category. '/' .$request->display_slug.  '.index');
}

public function admin(Request $request, $domain, $category){


    return view('view-seller.' .$category. '.admin');
}


}