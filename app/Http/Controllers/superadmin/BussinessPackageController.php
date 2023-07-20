<?php

namespace App\Http\Controllers\superadmin;
use App\Http\Controllers\Controller;
use App\BusinessCategory;
use App\Package;
use App\Subscription;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class BussinessPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        $business_category = BusinessCategory::all();

        return view('superadmin.bussiness_package.index', compact('packages','business_category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $package = new Package();
        $package->name = $request->name;
        $package->business_category_id = $request->business_category_id;
        $package->price = $request->price;
        $package->time = $request->time;
        $package->type = $request->type;
        $package->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Thêm gói thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        dd($package);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        $business_category = BusinessCategory::all();
        return view('superadmin.bussiness_package.edit',compact('package','id','business_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $package = Package::find($id);
        $package->name = $request->name;
        $package->business_category_id = $request->business_category_id;
        $package->price = $request->price;
        $package->time = $request->time;
        $package->type = $request->type;
        $package->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Sửa gói thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::find($id);
        $package->delete();

        return redirect()->back()->with('success', 'Xóa dịch vụ thành công..');
    }

    public function checkpackage(){
        $subscriptions = Subscription::all();
        return view('superadmin.bussiness_package.check', compact('subscriptions'));
    }

    public function postCheckpackage(Request $request){ 
        try{
            $subscription = Subscription::find($request->subscription_id);

            if($request->status == 'accept' &&  empty($subscription->start_date) && empty($subscription->end_date)){   
                $dates = $subscription->calculateDates($request->business_id,  $subscription->package->time, $subscription->package->type);
                $subscription->start_date = $dates['start_date'];
                $subscription->end_date = $dates['end_date'];
                $subscription->paid_via = "tranfer";
                $subscription->status = "accept";
                $randomString = Str::random(5);
                $subscription->order_code = $randomString . $request->business_id;
            }else{
                $subscription->status = $request->status;
            }

            $subscription->save();

            return redirect()->back()->with('success', 'Cập nhật gói thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Có lỗi xáy ra');
        }
    }

    public function editDatepackage(Request $request){
        try{
        $subscription = Subscription::find($request->subscription_id);
        if(!empty($subscription->start_date) && !empty($subscription->end_date)){   
            $subscription->start_date = $request->start_date;
            $subscription->end_date = $request->end_date;
            $subscription->save();
            return redirect()->back()->with('success', 'Cập nhật ngày thành công');
        }else{
            return redirect()->back()->with('error', 'Gói chưa được kích hoạt');
        }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Có lỗi xáy ra');
        }
    }
}
