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
    return view('view-seller.' .$category. '.index');
}

public function admin(Request $request, $domain, $category){


    return view('view-seller.' .$category. '.admin');
}


}