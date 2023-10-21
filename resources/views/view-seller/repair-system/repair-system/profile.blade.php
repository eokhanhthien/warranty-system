@extends('view-seller.repair-system.repair-system.layout.layout')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
   
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Thông tin cá nhân</div>
                <div class="card-body">
                    <form action="{{ route('seller.post.profile', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)]) }}" method="POST">
                    @csrf
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <input class="form-control" id="inputUsername" name="full_name" type="text" placeholder="Nhập tên của bạn" value="{{Auth::guard('customer')->user()->full_name}}">
                        </div>
                
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                            <input class="form-control" id="inputEmailAddress" name="email" type="email" placeholder="Nhập email của bạn" value="{{Auth::guard('customer')->user()->email}}" disabled>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Số điện thoại</label>
                                <input class="form-control" id="inputPhone" type="tel" name="phone_number" placeholder="Nhập số điện thoại của bạn" value="{{Auth::guard('customer')->user()->phone_number}}">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Sinh nhật</label>
                                <input class="form-control" id="inputBirthday" type="date" name="birth_date" placeholder="Ngày sinh" value="{{Auth::guard('customer')->user()->birth_date}}">
                            </div>
                        </div>

                        <label for="date">Địa chỉ</label>
                            <div class="form-group col-lg-6">
                        
                                 @if(!empty(Auth::guard('customer')->user()->address))
                                    @php
                                        $decodedAddress = json_decode(Auth::guard('customer')->user()->address);
                                    @endphp
                                @endif
                                
                                @include('select-options.address', [
                                    'provinces' => $provinces,
                                    'wards' => $wards,
                                    'districts' => $districts,
                                    'selectedProvince' => !empty($decodedAddress->province) ? $decodedAddress->province : null,
                                    'selectedDistrict' => !empty($decodedAddress->district) ? $decodedAddress->district : null,
                                    'selectedWard' => !empty($decodedAddress->ward) ? $decodedAddress->ward : null
                                ])
                            </div>

                        <!-- Save changes button-->
                        <button class="btn btn-primary mt-3" type="submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</div>

<style>
   .img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}
.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
.form-control, .dataTable-input {
    display: block;
    width: 100%;
    padding: 0.875rem 1.125rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1;
    color: #69707a;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #c5ccd6;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.35rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.nav-borders .nav-link.active {
    color: #0061f2;
    border-bottom-color: #0061f2;
}
.nav-borders .nav-link {
    color: #69707a;
    border-bottom-width: 0.125rem;
    border-bottom-style: solid;
    border-bottom-color: transparent;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 0;
    padding-right: 0;
    margin-left: 1rem;
    margin-right: 1rem;
}
</style>
@endsection