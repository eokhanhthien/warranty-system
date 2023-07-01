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
        <form action="{{route('admin.business.info.update')}}" method="POST" id="form-business" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="row">
              <div class="form-group col-lg-6">
                  <label for="projectName">Tên doanh nghiệp</label>
                  <input type="text" class="form-control" id="projectName" placeholder="Nhập tên dự án" value="{{$businesses->name}}" readonly>
              </div>
              <div class="form-group col-lg-6">
                  <label for="projectName">Danh mục doanh nghiệp</label>
                  <input type="text" class="form-control" id="projectName" value="{{$category->vi_name}}" readonly>
              </div>
              <div class="form-group col-lg-6">
                  <label for="created_at">Ngày tạo</label>
                  <input type="text" class="form-control" id="created_at"  name="created_at" value="{{$businesses->created_at->format('d/m/Y')}}" readonly>
                  <span class="error-message" id="created_at-error"></span>
              </div>
              <div class="form-group col-lg-6">
                  <label for="email">Email doanh nghiệp</label>
                  <input type="text" class="form-control" id="email" placeholder="Nhập email" name="email" value="{{$businesses->email}}">
                  <span class="error-message" id="email-error"></span>
              </div>
              <div class="form-group col-lg-6">
                  <label for="phone_number">Số điện thoại liên hệ</label>
                  <input type="text" class="form-control" id="phone_number" placeholder="Nhập Số điện thoại liên hệ" name="phone_number" value="{{$businesses->phone_number}}">
                  <span class="error-message" id="phone_number-error"></span>
              </div>
                  
              <div class="form-group col-lg-12">
                  <label for="fb_link">Facebook Link</label>
                  <input type="text" class="form-control" id="fb_link" placeholder="Nhập URL Facebook" name="fb_link" value="{{$businesses->fb_link}}">
                  <span class="error-message" id="fb_link-error"></span>
              </div>

              <div class="form-group col-lg-12">
                  <label for="twitter_link">Twitter Link</label>
                  <input type="text" class="form-control" id="twitter_link" placeholder="Nhập URL Twitter" name="twitter_link" value="{{$businesses->twitter_link}}">
                  <span class="error-message" id="twitter_link-error"></span>
              </div>

              </div>
              <div class="col-lg-6 p-0">
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

          </div>

          <div class="form-group text-right">                
              <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
          </div>
        </form>
    </div>
</div>

@endsection