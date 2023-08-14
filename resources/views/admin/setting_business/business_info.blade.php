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


          <h6 class="card-title text-primary">Logo doanh nghiệp</h6>
            @if(!empty($businesses->logo_image))         
                    <div class="img-size col-3">
                        <img src="https://drive.google.com/uc?export=view&id={{$businesses->logo_image}}" style="width: 100px; "alt="">
                    </div>                   
            @endif
            <p style = "color: red">Lưu ý: nếu thêm ảnh mới thì các ảnh cũ sẽ bị xóa đi</p>
            <div class="thumbnails row">
            <div class="thumbnail col-lg-2 col-sm-4 col-md-3 col-6 mb-3">
                    <label for="imageInput">
                        <img src="https://via.placeholder.com/150" alt="Ảnh mới" id="imageThumbnail">
                    </label>
                    <input type="file" id="imageInput" name="image" accept="image/*" style="display:none;">
            </div>
            </div>

            <input type="hidden" id="" name="image_width" value="500" >
            <input type="hidden" id="" name="image_height" value="500" >

          <div class="form-group text-right">                
              <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
          </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
 
      // Xử lý sự kiện chọn ảnh mới với name="image"
      const imageInput = document.getElementById('imageInput');
      imageInput.addEventListener('change', function (event) {
          const files = event.target.files;

          if (files && files.length > 0) {
              const file = files[0];
              const reader = new FileReader();
              reader.onload = function () {
                  const imageDataUrl = reader.result;
                  const imageThumbnail = document.getElementById('imageThumbnail');
                  if (imageThumbnail) {
                      imageThumbnail.src = imageDataUrl;
                  }
              };
              reader.readAsDataURL(file);
          }
      });

    });
</script>
@endsection