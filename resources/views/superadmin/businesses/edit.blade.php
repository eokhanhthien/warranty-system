@extends('layouts.superadmin')
@section('content')
@section('title', 'Doanh nghiệp')
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
                                            <input type="text" class="form-control" id="projectName" placeholder="Nhập tên dự án" name="name" value="{{$businesses->name}}" oninput="generateSlug(1)">
                                            <span class="error-message" id="name-error"></span>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="slug">Domain</label>
                                            <input type="text" class="form-control" id="slug" placeholder="Slug" name="domain" value="{{$businesses->domain}}"  readonly>
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
                                                    @if(!empty($business_category))
                                                        @foreach($business_category as $category)
                                                            <option value="{{$category->id}}" {{ $businesses->business_category_id == $category->id ? 'selected' : '' }}>{{$category->vi_name}}</option>    
                                                        @endforeach
                                                    @endif  
                                            </select>
                                            <span class="error-message" id="business_category_id-error"></span>
                                        </div>
                                        
                                        <div class="form-group col-lg-6">
                                            <label for="owner_id">Chủ sỡ hữu</label>
                                            <select name="owner_id" id="owner_id" style="padding-right: 1.9rem !important;" class="form-control">
                                                    <option value="">Chọn chủ sỡ hữu</option> 
                                                    <!-- @if(!empty($owner))
                                                        @foreach($owner as $user)
                                                            <option value="{{$user->id}}" {{ $businesses->owner_id == $user->id ? 'selected' : '' }}>{{$user->name}}</option>    
                                                        @endforeach
                                                    @endif    -->

                                                    @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                    @foreach($owners as $owner)
                                                        <option value="{{ $owner->id }}" {{ $businesses->owner_id == $owner->id ? 'selected' : '' }} style="color: darkgrey;" disabled>{{ $owner->name }}</option>
                                                    @endforeach 
                                            </select>
                                            <span class="error-message" id="owner_id-error"></span>
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
                                        'selectedProvince' => !empty($decodedAddress->province) ? $decodedAddress->province: null,
                                        'selectedDistrict' => !empty($decodedAddress->district) ? $decodedAddress->district: null,
                                        'selectedWard' => !empty($decodedAddress->ward) ? $decodedAddress->ward : null
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
<!-- Gọi hàm tạo slug -->
<script src="{{ asset('assets/js/slug.js') }}"></script>
<script>
    $(document).ready(function() {
        var formId = '#form-business';
        var validateUrl = '/validate-business';

        setupFormValidation(formId, validateUrl);
    });
</script>

@endsection