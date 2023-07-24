@extends('layouts.superadmin')
@section('content')
<?php
// echo "<pre>";
// print_r(session()->get('businesses'));die;
?>
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
    <div class="col-xl-12">
    @if(View::exists('admin.services_business.services_custom_edit.' . session()->get('businesses.slug') . '.' . session()->get('businesses.display')))
      @include('admin.services_business.services_custom_edit.' . session()->get('businesses.slug') . '.' . session()->get('businesses.display'))
      @else
      <p>Chưa  cấu hình, hãy liên hệ tổng đài 0946144333 được hướng dẫn</p>
    @endif
    </div>

    </div>
</div>

@endsection
