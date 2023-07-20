@extends('layouts.superadmin')
@section('content')
<?php
// echo "<pre>";
// print_r(session()->get('businesses'));die;
?>
@if(session('success'))
    <script>
        toastr.success('{!! html_entity_decode(session('success')) !!}');
    </script>
@endif

@if(session('error'))
    <script>
        toastr.error('{!! html_entity_decode(session('error')) !!}');
    </script>
@endif

<style>
    .running-tab {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #00cc66;
        border-radius: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 4px;
        margin: 12px;
}

.running-text {
    color: #ffffff; /* Màu chữ trắng */
    font-weight: bold;
    font-size: 12px;
}

</style>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
   <h5 class="text-primary mb-3">Gói hiện tại</h5>
   <div class="row mb-5">
    @if(!empty($currentPackage))
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card text-center" style="position: relative;">
           
                <div class="running-tab">
                    <span class="running-text">Running</span>
                </div>
            
            <div class="card-header" style="font-size: 20px; font-weight: 500; color: blue;">
                {{$currentPackage->package->name}}
            </div>
            <div class="card-body mt-4">
                <p>Ngày bắt đầu : <span class="text-primary">{{ \Carbon\Carbon::parse($currentPackage->start_date)->format('d/m/Y') }}</span> </p>
                <p>Ngày kết thúc : <span class="text-primary">{{ \Carbon\Carbon::parse($currentPackage->end_date)->format('d/m/Y') }}</span> </p>
            </div>
        </div>
    </div>
    @else
    <h5 class="text-danger">Chưa có gói nào được kích hoạt !</h5>
    <p><a href="{{route('subscription-package.index')}}">Đăng ký ngay</a></p>
    @endif
</div>

@if(!$upcomingPackages->isEmpty())
<div class="row mb-5"> 
    <h5 class="text-primary mb-3">Gói tiếp theo</h5>
    @foreach($upcomingPackages as $upcoming)
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card text-center" style="position: relative;">
            <div class="card-header" style="font-size: 20px; font-weight: 500; color: blue;">
                {{$upcoming->package->name}}
            </div>
            <div class="card-body mt-4">
                <p>Ngày bắt đầu : <span class="text-primary">{{ \Carbon\Carbon::parse($upcoming->start_date)->format('d/m/Y') }}</span> </p>
                <p>Ngày kết thúc : <span class="text-primary">{{ \Carbon\Carbon::parse($upcoming->end_date)->format('d/m/Y') }}</span> </p>
            </div>
        </div>
    </div>
    @endforeach 
</div>
@endif

 @if(!$PackageNotAccepted->isEmpty())
<div class="row mb-5"> 
    <h5 class="text-primary mb-3">Gói đang chờ duyệt</h5>
    @foreach($PackageNotAccepted as $subcripnot)
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card text-center" style="position: relative;">
            <div class="card-header" style="font-size: 20px; font-weight: 500; color: blue;">
                {{$subcripnot->package->name}}
            </div>
            <div class="card-body mt-4">
                <p>Cổng thanh toán đang xác thực thanh toán</p>
            </div>
        </div>
    </div>
    @endforeach 
</div>
@endif
    </div>
</div>

@endsection
