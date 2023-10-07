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
    <div class="text-right">
          <button class="btn btn-primary m-3" data-toggle="modal" data-target="#myModal"><i class='bx bx-plus'></i> Thêm mới</button>
    </div>
    <div class="card">

                <h5 class="card-header">Tất cả nhà cung cấp</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="table_team">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Tên doanh nghiệp</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Actions</th>
                        
                      </tr>
                    </thead>
                    @if(!empty($suppliers))
                    <tbody class="table-border-bottom-0">
                      @foreach($suppliers as $product)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->email }}</td>
                        <td>{{ $product->phone_number }}</td>
                        <td>
                          <button class="btn btn-primary btn-pd">
                            <a style="color: white" class="d-inline-block" href="{{route('supplier.edit',[$product->id])}}">
                              <i class="bx bx-edit-alt me-1"></i> Sửa
                            </a>
                          </button> 
            
                       
                          <button type="button" class="btn btn-danger btn-pd" data-toggle="modal" data-target="#confirmationModal{{ $product->id }}">
                              <i class="bx bx-trash me-1"></i> Xóa
                          </button>
                          <div class="modal fade" id="confirmationModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="confirmationModalLabel">Xác nhận xóa</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">Bạn có chắc muốn xóa ? </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>                                          
                                          <form action="{{ route('supplier.destroy', ['id' => $product->id]) }}" method="POST" style="display: inline-block;">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger">Xóa</button>                                          
                                            </form>
                                      </div>
                                  </div>
                              </div>
                          </div>


                  
                        </td>
                       
                      </tr>
                      @endforeach
                    </tbody>
                    @endif
                  </table>
                </div>

            <!-- Modal -->
            <form action="{{ route('supplier.store') }}" method="POST" id="" enctype="multipart/form-data">
              @csrf
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Thêm nhà cung cấp</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body"> 
                    <div class="nav-align-top mb-4"> 
                        <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="Name">Tên doanh nghiệp</label>
                                <input type="text" class="form-control" id="Name" placeholder="Nhập tên doanh nghiệp" name="name">
                                <span class="error-message" id="name-error"></span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Nhập email" name="email">
                                <span class="error-message" id="email-error"></span>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="phone_number">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone_number" placeholder="Nhập số điện thoại" name="phone_number">
                                <span class="error-message" id="phone_number-error"></span>
                            </div>

                            @include('select-options.address', ['provinces' => $provinces, 'wards' => $wards, 'districts' => $districts,
                            'selectedProvince' => null,
                            'selectedDistrict' => null,
                            'selectedWard' => null
                            ])

                        </div>

                        </div> 
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                      <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
                    </div>
                    </div>
                  </div>
                </div> 
              </div>
            </form>
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