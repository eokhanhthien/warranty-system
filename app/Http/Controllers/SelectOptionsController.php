<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\Ward;
use App\District;

class SelectOptionsController extends Controller
{
    public function getAddressOptions()
    {
        $provinces = Province::all();
        $wards = Ward::all();
        $districts = District::all();

        return view('select-options.address', compact('provinces', 'wards', 'districts'));
    }

    public function getDistricts($provinceId)
    {
        $districts = District::where('city_id', $provinceId)->get();
        return response()->json($districts);
    }

    public function getWards($districtId)
    {
        $wards = Ward::where('districts_id', $districtId)->get();
        return response()->json($wards);
    }

}
