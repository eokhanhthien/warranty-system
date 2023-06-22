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
        <form action="{{ route('superadmin.businesses.categories.update', ['id' => $id]) }}" method="POST" id="form-business-categories">
                    @csrf
                    <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="projectName">Tên danh mục (Tiếng Việt)</label>
                        <input type="text" class="form-control" id="" placeholder="Nhập tên danh mục" name="vi_name" value="{{$business_category->vi_name}}">
                        <span class="error-message" id="vi_name-error"></span>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="projectName">Tên danh mục (Tiếng Anh)</label>
                        <input type="text" class="form-control" id="projectName" placeholder="Nhập tên danh mục" name="en_name" oninput="generateSlug(0)" value="{{$business_category->en_name}}">
                        <span class="error-message" id="en_name-error"></span>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="slug">Slug   <span  data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="" data-bs-original-title="<i class='bx bx-trending-up bx-xs' ></i> <span>Slug này sẽ là tên thư mục của doanh nghiệp</span>">
                        <i class='bx bx-question-mark'></i>
                        </span></label>
                        <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" readonly value="{{$business_category->slug}}">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="description	">Mô tả</label>
                        <textarea  class="form-control" id="description" name="description" > {{$business_category->description}}</textarea>
                        <span class="error-message" id="description-error"></span>
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
        var formId = '#form-business-categories';
        var validateUrl = '/validate-business-categories';

        setupFormValidation(formId, validateUrl);

        var id_table = '#table_businesses';
        searchDataTable(id_table,true, false);
    });
</script>

@endsection