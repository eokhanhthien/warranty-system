@extends('layouts.superadmin')
@section('content')
@section('title', 'Giao diện')
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
        <form action="{{ route('businesses-package.update', ['id' => $id]) }}" method="POST" id="form-business-package" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                <div class="form-group col-lg-6">
                        <label for="name">Tên gói</label>
                        <input type="text" class="form-control" id="name" placeholder="Nhập tên gói" name="name" value="{{$package->name}}">
                        <span class="error-message" id="name-error"></span>
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="business_category_id">Danh mục doanh nghiệp</label>
                        <select name="business_category_id" id="business_category_id" style="padding-right: 1.9rem !important;" class="form-control">
                                <option value="">Chọn danh mục</option> 
                                @if(!empty($business_category))
                                    @foreach($business_category as $category)
                                        <option value="{{$category->id}}" {{ $package->business_category_id == $category->id ? 'selected' : '' }}>{{$category->vi_name}}</option>    
                                    @endforeach
                                @endif   
                        </select>
                        <span class="error-message" id="business_category_id-error"></span>
                    </div>
                    <label for="price">Giá</label>
                    <div class="input-group col-lg-12 ">
                        <span class="input-group-text">VNĐ</span>
                        <input type="text" class="form-control" placeholder="Giá gói đăng ký" aria-label="Amount (to the nearest dollar)" name ="price" id="price" value="{{$package->price}}">
                    </div>
                    <span class="error-message" id="price-error"></span>

                    <div class="form-group col-lg-6">                 
                        <label for="time">Thời gian:</label>
                        <input type="number" id="time" name="time" min="0" class="form-control" placeholder="Nhập thời gian" value="{{$package->time}}">
                        <span class="error-message" id="time-error"></span>
                    </div>

                    <div class="form-group col-lg-6">                 
                    <label for="type">Kiểu:</label>
                        <select id="type" name="type" class="form-control">
                        <option value="day" {{ $package->type == 'day' ? 'selected' : '' }}>Ngày</option>
                        <option value="month" {{ $package->type == 'month' ? 'selected' : '' }}>Tháng</option>
                        <option value="year" {{ $package->type == 'year' ? 'selected' : '' }}>Năm</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
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
        var formId = '#form-business-package';
        var validateUrl = '/validate-business-package';

        setupFormValidation(formId, validateUrl);

    });
</script>

@endsection