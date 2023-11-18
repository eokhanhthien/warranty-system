@extends('staff.layout.index')
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
                <h5 class="card-header">Đơn hàng chờ hoàn trả</h5>
                <div class="table-responsive text-nowrap p-4">
                  <table class="table" id="table_team">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Mã đơn</th>
                        <th>phương thức thanh toán</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    @if(!empty($orders))
                    <tbody class="table-border-bottom-0">
                      @foreach($orders as $order)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ $order->pay_method  == 'POD' ? 'Thanh toán chuyển khoản' : 'Thanh toán khi nhận hàng'}}</td>
                        <td class="text-success">{{ number_format($order->total_price) }} đ</td>
                        <td>{{ $order->is_completed  == '0' ? 'Chưa thanh toán' : 'Đã thanh toán'}}</td>
                        <td>
                        @if( $order->status == 'pending')
                          Chưa xác nhận                     
                        @elseif( $order->status == 'preparing')
                          Đang chuẩn bị hàng
                        @elseif( $order->status == 'delivering')
                          Đang giao
                        @elseif( $order->status == 'delivered')
                          Đã giao <i class="fas fa-check-circle text-success"></i>
                        @elseif( $order->status == 'denied')
                          Từ chối <i class="fas fa-times-circle text-danger"></i>
                        @elseif( $order->status == 'cancel')  
                          Đã hủy 
                        @endif
                        </td>
                                       
                        <td>
                        <button class="btn btn-primary btn-pd">
                            <a style="color: white" class="d-inline-block" href="{{route('admin.detail.order',[$order->id])}}">
                               Chi tiết
                            </a>
                        </button>
                        @if( $order->is_completed == 0)
                        <button class="btn btn-primary btn-pd">
                            <a style="color: white" class="d-inline-block" href="{{route('done.pay.order',[$order->id])}}">
                              <i class="fas fa-check"></i> Đã thanh toán
                            </a>
                        </button>
                        @endif
                        @if( $order->status == 'pending')
                        <button class="btn btn-primary btn-pd">
                              <a style="color: white" class="d-inline-block" href="{{route('confirm.order',[$order->id])}}">
                                <i class="fas fa-check"></i> Xác nhận
                              </a>
                          </button>    
              
                          <button type="button" class="btn btn-danger btn-pd" data-toggle="modal" data-target="#confirmationModal{{ $order->id }}">
                            <i class="fas fa-times"></i> Từ chối
                          </button>           
                        @elseif( $order->status == 'preparing')
                          <button class="btn btn-primary btn-pd">
                              <a style="color: white" class="d-inline-block" href="{{route('done.preparing.order',[$order->id])}}">
                                <i class="fas fa-check"></i> Xong
                              </a>
                          </button> 
                        @elseif( $order->status == 'delivering')
                        <button class="btn btn-primary btn-pd">
                              <a style="color: white" class="d-inline-block" href="{{route('done.delivered.order',[$order->id])}}">
                                <i class="fas fa-check"></i> Đã giao
                              </a>
                          </button> 
                        @elseif( $order->status == 'delivered')
                          <!-- Đã giao <i class="fas fa-check-circle text-success"></i> -->
                        @elseif( $order->status == 'denied')
                          <!-- Từ chối <i class="fas fa-times-circle text-danger"></i> -->
                        @endif

                          <div class="modal fade" id="confirmationModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="confirmationModalLabel">Xác nhận từ chối</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">Bạn có chắc muốn từ chối ? </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>                                         
                                      <a href="{{route('denied.order',[$order->id])}}', ['id' => $order->id]) }}" style="display: inline-block;">
                                          <button type="" class="btn btn-danger">Từ chối</button>                                          
                                      </a>
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
            <form action="{{ route('business-service.store') }}" method="POST" id="form-admin-service" enctype="multipart/form-data">
              @csrf
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Thêm đơn hàng</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      @if(View::exists('admin.services_business.services_custom.' . session()->get('businesses.slug') . '.' . session()->get('businesses.display')))
                        @include('admin.services_business.services_custom.' . session()->get('businesses.slug') . '.' . session()->get('businesses.display')) 
                      @else
                        <p>Chưa  cấu hình, hãy liên hệ tổng đài 0946144333 được hướng dẫn</p>
                      @endif
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



<script>
  let inputCount = document.querySelectorAll('.input-group').length + 1;

  function addInput() {
    const inputContainer = document.getElementById("input-container");

    const newInput = document.createElement("div");
    newInput.classList.add("input-group");

    const input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("name", "service[" + inputCount + "]");
    input.classList.add("form-control");

    const btnRemove = document.createElement("div");
    btnRemove.classList.add("btn", "btn-danger");
    btnRemove.textContent = "Xóa";
    btnRemove.addEventListener("click", function() {
      removeInput(this);
    });

    newInput.appendChild(input);
    newInput.appendChild(btnRemove);
    inputContainer.appendChild(newInput);

    inputCount++;
  }

  function removeInput(btn) {
    const inputGroup = btn.parentNode;
    const inputContainer = inputGroup.parentNode;
    inputContainer.removeChild(inputGroup);

    // Cập nhật lại thứ tự của các input
    const inputs = inputContainer.querySelectorAll('.input-group input');
    inputs.forEach(function(input, index) {
      input.setAttribute("name", "service[" + (index + 1) + "]");
    });

    inputCount--; // Giảm số lượng input
  }
</script>

<!-- Gọi hàm validate để xử lý form -->
<script src="{{ asset('assets/js/validateForm.js') }}"></script>
<!-- Gọi hàm thêm search table -->
<script src="{{ asset('assets/js/data-table-js.js') }}"></script>
<script>
    $(document).ready(function() {
        var formId = '#form-admin-service';
        var validateUrl = '/validate-admin-service';

        setupFormValidation(formId, validateUrl);

        var id_table = '#table_team';
        searchDataTable(id_table,true, true, 20);

    });


</script>

@endsection