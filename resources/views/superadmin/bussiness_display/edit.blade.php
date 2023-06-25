@extends('layouts.superadmin')
@section('content')
@section('title', 'Danh mục doanh nghiệp')
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
        <form action="{{ route('superadmin.businesses.display.update', ['id' => $id]) }}" method="POST" id="form-display-categories" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="projectName">Tên giao diện (Tiếng Việt)</label>
                        <input type="text" class="form-control" id="" placeholder="Nhập tên giao diện" name="vi_name" value="{{$business_display->vi_name}}">
                        <span class="error-message" id="vi_name-error"></span>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="projectName">Tên giao diện (Tiếng Anh)</label>
                        <input type="text" class="form-control" id="projectName" placeholder="Nhập tên giao diện" name="en_name" oninput="generateSlug(0)" value="{{$business_display->en_name}}">
                        <span class="error-message" id="en_name-error"></span>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="slug">Slug   <span  data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="" data-bs-original-title="<i class='bx bx-trending-up bx-xs' ></i> <span>Slug này sẽ là tên thư mục của doanh nghiệp</span>">
                        <i class='bx bx-question-mark'></i>
                        </span></label>
                        <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" readonly value="{{$business_display->slug}}">
                    </div>
                    <div class="form-group col-lg-6">
                    <label for="business_category_id">Danh mục doanh nghiệp</label>
                        <select name="business_category_id" id="business_category_id" style="padding-right: 1.9rem !important;" class="form-control">
                                <option value="">Chọn danh mục</option> 
                                @if(!empty($business_category))
                                    @foreach($business_category as $category)
                                        <option value="{{$category->id}}" {{ $business_display->business_category_id == $category->id ? 'selected' : '' }}>{{$category->vi_name}}</option>    
                                    @endforeach
                                @endif   
                        </select>
                        <span class="error-message" id="business_category_id-error"></span>
                    </div>
                    <div class="form-group col-lg-4">
                            <label for="image">Ảnh đại diện</label>
                            <input type="file" class="form-control" id="image" name="image" onchange="displayThumbnail(event)">
                            <span class="error-message" id="image-error"></span>
                    </div>
                    @include('select-options.show_thumnail', ['image' => $business_display->image])
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
        var formId = '#form-display-categories';
        var validateUrl = '/validate-business-display';

        setupFormValidation(formId, validateUrl);

    });
</script>

@endsection