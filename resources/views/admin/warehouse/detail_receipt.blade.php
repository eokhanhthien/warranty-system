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

  <h3>Chi tiết biên nhận</h3>
  <div class="card mb-4">

        <div class="table-responsive text-nowrap">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Ngày nhập</th>
                    <th>Trạng thái</th>
                    <th>ghi chú</th>
                </tr>
                <tr>
                    <td>{{ $receipt->supplier_id }}</td>
                    <td>{{ $receipt->purchase_date }}</td>
                    <td>{{ $receipt->status }}</td>
                    <td>{{ $receipt->note }}</td>
                </tr>
            </table>
        </div>
    </div>

  <div class="card">

<h5 class="card-header">Tất cả sản phẩm</h5>
<div class="table-responsive text-nowrap">
  <table class="table" id="table_team">
    <thead>
      <tr>
        <th>STT</th>
        <th>Ảnh</th>
        <th>Sản phẩm</th>
        <th>Số lượng</th>
      </tr>
    </thead>
    @if(!empty($receipt_items))
    <tbody class="table-border-bottom-0">
      @foreach($receipt_items as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td><img  class="" src="https://drive.google.com/uc?export=view&id={{\App\Product::where('id', $product->product_id)->value('image')}}" alt="" style ="width: 100px"></td>
        <td>{{ \App\Product::where('id', $product->product_id)->value('name') }}</td>
        <td>{{ $product->quantity}}</td>    

      </tr>
      @endforeach
    </tbody>
    @endif
  </table>
</div>


</div>
   
</div>



@endsection