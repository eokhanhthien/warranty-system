@extends('layouts.superadmin')
@section('content')
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
        <form action="{{ route('superadmin.businesses.update', ['id' => $id]) }}" method="POST" id="form-business" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="projectName">Tên doanh nghiệp</label>
                                            <input type="text" class="form-control" id="projectName" placeholder="Nhập tên dự án" name="name" value="{{$businesses->name}}">
                                            <span class="error-message" id="name-error"></span>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="email">Email doanh nghiệp</label>
                                            <input type="text" class="form-control" id="email" placeholder="Nhập người dùng" name="email" value="{{$businesses->email}}">
                                            <span class="error-message" id="email-error"></span>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="phone_number">Số điện thoại liên hệ</label>
                                            <input type="text" class="form-control" id="phone_number" placeholder="Nhập Số điện thoại liên hệ" name="phone_number" value="{{$businesses->phone_number}}">
                                            <span class="error-message" id="phone_number-error"></span>
                                        </div>

                                        <div class="form-group col-lg-6">
                                        <label for="business_category_id">Danh mục doanh nghiệp</label>
                                            <select name="business_category_id" id="business_category_id" style="padding-right: 1.9rem !important;" class="form-control">
                                                    <option value="">Chọn danh mục</option> 
                                                    <option value="1" {{ $businesses->business_category_id == 1 ? 'selected' : '' }}>Trung tâm bảo hành</option>    
                                                    <option value="2" {{ $businesses->business_category_id == 2 ? 'selected' : '' }}>Trung tâm đào tạo</option>    
                                            </select>
                                            <span class="error-message" id="business_category_id-error"></span>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                   
                                    @if(!empty($businesses->address))
                                    @php
                                        $decodedAddress = json_decode($businesses->address);
                                        @endphp
                                    @endif
                  
                                    @include('select-options.address', [
                                        'provinces' => $provinces,
                                        'wards' => $wards,
                                        'districts' => $districts,
                                        'selectedProvince' => $decodedAddress->province,
                                        'selectedDistrict' => $decodedAddress->district,
                                        'selectedWard' => $decodedAddress->ward
                                    ])
                                </div>

                                <div class="form-group text-right">                
                                    <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
                                </div>
        </form>
    </div>
</div>
<!-- Gọi hàm validate để xử lý form -->
<script src="{{ asset('assets/js/validateForm.js') }}"></script>
<script>
    $(document).ready(function() {
        var formId = '#form-business';
        var validateUrl = '/validate-business';

        setupFormValidation(formId, validateUrl);
    });
</script>

@endsection