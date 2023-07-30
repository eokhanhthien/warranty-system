<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Package;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\TransferGateway;

class BusinessSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businessId = Auth::user()->business_id;
        $packages = Package::join('businesses', 'packages.business_category_id', '=', 'businesses.business_category_id')
        ->where('businesses.id', $businessId)
        ->orderBy('packages.price', 'asc')
        ->select('packages.*')
        ->get();
        
        $gateway = TransferGateway::where('business_id', null)->first();

        return view('admin.subscription_package.index', compact('packages','gateway'));
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
        try {
            $subscription = new Subscription();
            $package = Package::find($request->package_id);

            $isSubscriptionFree = $subscription->isFreeSubscription(Auth::user()->business_id, $package->id);
            if(!empty($isSubscriptionFree)){
                return redirect()->back()->with('error', 'Bạn đã vượt quá số lần đăng ký gói này');
            }

            $subscription->package_id = $package->id;
            $subscription->business_id = Auth::user()->business_id;
            
            $time = $package->time; // Số lượng
            $type = $package->type; // Đơn vị thời gian

            if($package->price == 0){
                // Đơn Free
                // Tạo ngày bắt đầu và kết thúc
                $dates = $subscription->calculateDates(Auth::user()->business_id, $time, $type);
                $subscription->order_date = $dates['start_date'];
                $subscription->start_date = $dates['start_date'];
                $subscription->end_date = $dates['end_date'];

                $subscription->paid_via = "free";
                $subscription->status = "accept";
                $randomString = Str::random(5);
                $subscription->order_code = $randomString . Auth::user()->id;
                $subscription->save();
                return redirect()->back()->with('success', 'Đăng ký gói thành công.');

            }else{
                $today = Carbon::now();
                $isSubscriptionTranfer = Subscription::where('business_id', Auth::user()->business_id)->where('status',"pending")->where('paid_via',"tranfer")->where('package_id',$request->package_id)->first();

                if(!empty($isSubscriptionTranfer) && $isSubscriptionTranfer != null){
                    $isSubscriptionTranfer->order_date = $today;
                    $isSubscriptionTranfer->save();
                    return response()->json(['orderCode' => $isSubscriptionTranfer->order_code, 'price' => $subscription->package->price]);
                }else{
                    $subscription->order_date = $today;
                    $subscription->paid_via = "tranfer";
                    $subscription->status = "pending";
                    $randomString = Str::random(5);
                    $subscription->order_code = $randomString . Auth::user()->id;
                    $subscription->save();
                    return response()->json(['orderCode' => $subscription->order_code, 'price' => $subscription->package->price]);
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Đăng ký gói thất bại.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showPackages(){
      // Gọi model Subscription và lấy danh sách các gói
      $subscriptionModel = new Subscription();
      $currentPackage = $subscriptionModel->getPackageCurrent();
      $upcomingPackages = $subscriptionModel->getPackageUpcoming();
      $PackageNotAccepted = $subscriptionModel->getPackageNotAccepted();
 
      $subscriptions = Subscription::where('business_id',Auth::user()->business_id)->where('status','accept')->get();
      return view('admin.subscription_package.show_packages', compact('currentPackage', 'PackageNotAccepted','upcomingPackages','subscriptions'));
    }
}
