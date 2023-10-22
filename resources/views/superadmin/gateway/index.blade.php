@extends('layouts.superadmin')
@section('content') 
@section('title', 'Gói')
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
<form action="{{ route('gateway.store') }}" method="POST" id="form-gateway" enctype="multipart/form-data">
   @csrf
    <div class="row">
        <div class="form-group col-lg-6">
            <label for="bank_id">Ngân hàng</label>
            <select name="bank_id" class="form-control" id="bank_id">
                @foreach(config('bank_info.banks') as $bank)
                    <option value="{{ $bank['bin'] }}" @if (optional($transfergateway)->bank_id == $bank['bin']) selected @endif>{{ $bank['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-lg-6">
            <label for="account_no">Số tài khoản</label>
            <input type="text" class="form-control" id="account_no" placeholder="Nhập số tài khoản" name="account_no" value="{{optional($transfergateway)->account_no}}">
            <span class="error-message" id="account_no-error"></span>
        </div>

        <div class="form-group col-lg-6">
            <label for="account_name">Tên chủ tài khoản</label>
            <input type="text" class="form-control" id="account_name" placeholder="Nhập tên chủ tài khoản" name="account_name" value="{{optional($transfergateway)->account_name}}">
            <span class="error-message" id="account_name-error"></span>
        </div>


        <div class="form-group col-lg-6">
            <label for="name">Mẫu</label>
            <select name="template" class="form-control" id="template">         
                    <option value="compact" @if (optional($transfergateway)->template == "compact") selected @endif>compact</option>
                    <option value="compact2" @if (optional($transfergateway)->template == "compact2") selected @endif>compact2</option>
                    <option value="qr_only" @if (optional($transfergateway)->template == "qr_only") selected @endif>qr_only</option>
                    <option value="print" @if (optional($transfergateway)->template == "print") selected @endif>print</option>
            </select>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
    </div>

</form>
</div>
<!-- Gọi hàm validate để xử lý form -->
<!-- <script src="{{ asset('assets/js/validateForm.js') }}"></script> -->

<!-- Gọi hàm thêm search table -->
<!-- <script src="{{ asset('assets/js/data-table-js.js') }}"></script> -->
<!-- <script>
    $(document).ready(function() {
        var formId = '#form-business-package';
        var validateUrl = '/validate-business-package';

        setupFormValidation(formId, validateUrl);

        var id_table = '#table_package';
        searchDataTable(id_table,true, true, 20);
    });
</script> -->
@endsection