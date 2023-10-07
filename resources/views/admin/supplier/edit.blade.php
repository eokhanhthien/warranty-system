@extends('layouts.superadmin')
@section('content')
@section('title', 'Đội')
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
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <form action="{{ route('supplier.update', ['id' => $supplier->id]) }}" method="POST" id="" enctype="multipart/form-data">
            @method("PUT")
            @csrf
                    <div class="modal-body">                
                    <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="Name">Tên doanh nghiệp</label>
                                <input type="text" class="form-control" id="Name" placeholder="Nhập tên doanh nghiệp" name="name" value="{{ $supplier->name }}">
                                <span class="error-message" id="name-error"></span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Nhập email" name="email" value="{{ $supplier->email }}">
                                <span class="error-message" id="email-error"></span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="phone_number">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone_number" placeholder="Nhập số điện thoại" name="phone_number" value="{{ $supplier->phone_number }}">
                                <span class="error-message" id="phone_number-error"></span>
                            </div>

                            <div class="form-group col-lg-6">
                                    
                                    @if(!empty($supplier->address))
                                    @php
                                        $decodedAddress = json_decode($supplier->address);
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
          
                            <div class="form-group text-right">                
                                <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
                            </div>
                        </div>               
                  </div>
        </form>
    </div>
</div>


@endsection