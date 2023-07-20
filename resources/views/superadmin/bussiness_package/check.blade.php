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
                <h5 class="card-header">Tất cả đăng ký</h5>
                <div class="table-responsive text-nowrap">
                <table class="table" id="table_package">
                  <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên doanh nghiệp</th>
                      <th>tên gói</th>
                      <th>Mã đơn</th>
                      <th>Giá</th>
                      <th>Trạng thái</th>
                      <th>Ngày bắt đầu</th>
                      <th>Ngày kết thúc</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach($subscriptions as $subscription)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $subscription->business->name }}</td>
                      <td>{{ $subscription->package->name }}</td>
                      <td>{{ $subscription->order_code }}</td>
                      <td>{{ number_format($subscription->package->price)  }} đ</td>
                      <td>{{ $subscription->status }}</td>
                      <td>{{ $subscription->start_date }}</td>
                      <td>{{ $subscription->end_date }}</td>


                      <td>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $loop->index + 1 }}">              
                            <i class="bx bx-edit-alt me-1"></i> Xử lý
                        </button>
           

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmationModal{{ $subscription->id }}">
                              <i class="bx bx-trash me-1"></i> Sửa
                          </button>

                          <!-- Confirmation Modal -->
                          <div class="modal fade" id="confirmationModal{{ $subscription->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                  <form id="" action="{{ route('edit.date.package')}}" method="POST">
                                         @csrf
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="confirmationModalLabel">Chỉnh sửa ngày</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                            <!-- Thêm hai thẻ <input> kiểu date để chọn ngày bắt đầu và kết thúc -->
                                            <label for="start_date">Ngày bắt đầu:</label>
                                            <input type="date" name="start_date" class="form-control" value="{{ $subscription->start_date }}">

                                            <label for="end_date">Ngày kết thúc:</label>
                                            <input type="date" name="end_date" class="form-control" value="{{ $subscription->end_date }}">
                                            <input type="hidden" name="business_id" value="{{ $subscription->business->id }}">
                                            <input type="hidden" name="subscription_id" value="{{ $subscription->id  }}">
                                        </div>
                                      <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button> 
                                            <button type="submit" class="btn btn-danger">Sửa</button>                                          
                                      </div>
                                    </form>
                                  </div>
                              </div>
                          </div>
                      </td>
                    </tr>
                       <!-- Modal -->
                       <div class="modal fade" id="modal{{ $loop->index + 1 }}" tabindex="-1" aria-labelledby="modalLabel{{ $loop->index + 1 }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg"> <!-- Thêm lớp "modal-lg" để tăng kích thước modal -->
                        <form id="" action="{{ route('check.package')}}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <!-- Modal header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $loop->index + 1 }}">Xử lý gói</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <!-- Modal content -->
                                <div class="modal-body">
                                    <select name="status" class="form-control">
                                        <option value="">Chọn trạng thái</option>
                                        <option value="pending" {{ $subscription->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                        <option value="accept" {{ $subscription->status == 'accept' ? 'selected' : '' }}>Duyệt</option>
                                    </select>
                                </div>
                                <input type="hidden" name="business_id" value="{{ $subscription->business->id }}">
                                <!-- <input type="hidden" name="package_id" value="{{ $subscription->package->id  }}"> -->
                                <input type="hidden" name="subscription_id" value="{{ $subscription->id  }}">
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>


                    @endforeach
                  </tbody>
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
        var formId = '#form-business-package';
        var validateUrl = '/validate-business-package';

        setupFormValidation(formId, validateUrl);

        var id_table = '#table_package';
        searchDataTable(id_table,true, true, 10);
    });
</script>
@endsection