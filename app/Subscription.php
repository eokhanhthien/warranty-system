<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Subscription extends Model
{

    
    protected $fillable = [
        'package_id',
        'business_id',
    ];



    public function isFreeSubscription($businessId, $packageId)
    {
        return $this->join('packages', 'subscriptions.package_id', '=', 'packages.id')
            ->where('subscriptions.business_id', $businessId)
            ->where('packages.price', 0)
            ->where('packages.id', $packageId)
            ->first();
    }


    public function calculateDates($businessId, $time, $type)
    {
        $today = Carbon::now();
        $startDate = $today;
        // Kiểm tra xem đã có gói trước đó hay chưa
        $previousSubscription = $this->where('end_date', '>=', $today)
        ->where('status', 'accept')
        ->where('business_id', $businessId)
        ->latest('end_date')->first();

        if (!empty($previousSubscription)) {
            $startDate = Carbon::parse($previousSubscription->end_date)->addDay();
        } else {
            $startDate = $today;
        }

        if ($type === 'day') {
            $endDate = $startDate->copy()->addDays($time);
        } elseif ($type === 'month') {
            $endDate = $startDate->copy()->addMonths($time);
        } elseif ($type === 'year') {
            $endDate = $startDate->copy()->addYears($time);
        } else {
            $endDate = null;
        }

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }


    public function getPackageCurrent()
    {
        $now = Carbon::now();

        return $this->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now)
                    ->where('status', 'accept')
                    ->where('business_id', Auth::user()->business_id)
                    ->first();
    }

    public function getPackageUpcoming()
    {
        $currentPackage = $this->getPackageCurrent();
        $endDateOfCurrentPackage = $currentPackage ? $currentPackage->end_date : "null" ;
      
        return $this->where('start_date', '>', $endDateOfCurrentPackage)
                    ->where('status', 'accept')
                    ->where('business_id', Auth::user()->business_id)
                    ->get();

    }

    public function getPackageNotAccepted()
    {
        return $this->where('status', '<>', 'accept')
        ->where('business_id', Auth::user()->business_id)
        ->where('paid_via', '<>','tranfer')
        ->get();
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

}

