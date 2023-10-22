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
<div class="card">
<h5 class="card-header">Tất cả khách hàng</h5>

<table class="table " id="table_team">
      <thead>
        <tr>
          <th>STT</th>
          <th>Tên khách hàng</th>
          <th>Email</th>
          <th>Số điện thoại</th>
          <th>Ngày tạo</th>

        </tr>
      </thead>
      <tbody>
        <!-- Hiển thị danh sách danh mục từ CSDL (nếu có) -->
        @foreach($customers as $customer)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $customer->full_name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone_number }}</td>
                <td>{{ $customer->created_at }}</td>
            </tr>
            @endforeach
      </tbody>
    </table>
</div>
</div>
<!-- Gọi hàm validate để xử lý form -->
<script src="{{ asset('assets/js/validateForm.js') }}"></script>
<!-- Gọi hàm thêm search table -->
<script src="{{ asset('assets/js/data-table-js.js') }}"></script>
<script>
    $(document).ready(function() {


        var id_table = '#table_team';
        searchDataTable(id_table,true, true, 20);

    });
</script>

@endsection