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

    <div class="card">

                <h5 class="card-header">Tất cả sản phẩm</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="table_team">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nhà cung cấp</th>
                        <th>Ngày mua</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    @if(!empty($receipts))
                    <tbody class="table-border-bottom-0">
                      @foreach($receipts as $product)
                      <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ \App\Supplier::where('id', $product->supplier_id)->value('name') }}</td>
                        <td>{{ $product->purchase_date}}</td>
                        <td>{{ $product->status}}</td>
                        <td>{{ $product->note}}</td>    
                        <td> 
                          <a href="{{route('receipt.detail',['id' => $product->id])}}">
                            <button class="btn btn-primary">Xem chi tiết</button>
                          </a>         
                        </td>
                       
            
                      </tr>
                      @endforeach
                    </tbody>
                    @endif
                  </table>
                </div>

          
    </div>
  </div>
</div>



<!-- Gọi hàm validate để xử lý form -->
<script src="{{ asset('assets/js/validateForm.js') }}"></script>
<!-- Gọi hàm thêm search table -->
<script src="{{ asset('assets/js/data-table-js.js') }}"></script>
<script>
    $(document).ready(function() {
        var formId = '#form-admin-product';
        var validateUrl = '/validate-admin-product';

        setupFormValidation(formId, validateUrl);

        var id_table = '#table_team';
        searchDataTable(id_table,true, true, 10);

    });
</script>

@endsection