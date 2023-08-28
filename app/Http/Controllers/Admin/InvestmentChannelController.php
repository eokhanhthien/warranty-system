<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class InvestmentChannelController extends Controller
{
    public function price_gold(){
        return view('admin.investment_channel.price_gold');
    }

    public function gasoline(){
        return view('admin.investment_channel.gasoline');
    }
    
    public function interest_rate(){
        return view('admin.investment_channel.interest_rate');
    }
    public function deposit_rate(){
        return view('admin.investment_channel.deposit_rate');
    }
    public function conversion_tool(){
        return view('admin.investment_channel.conversion_tool');
    }
}