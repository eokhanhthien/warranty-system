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
          <button class="btn btn-primary  m-3" data-toggle="modal" data-target="#myModal"><i class='bx bx-plus'></i> Thêm</button>
    </div>
    <div class="card">

                <h5 class="card-header">Tất cả dịch vụ</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="table_team">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>description</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    @if(!empty($business_service))
                    <tbody class="table-border-bottom-0">
                      @foreach($business_service as $service)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $service->name }}</td>
                        @if(!empty($service->image))
                        <td><img  style = "width: 120px;" class="img-fluid" src="https://drive.google.com/uc?export=view&id={{$service->image}}" alt=""></td>

                        @else
                         <td><img style = "width: 120px; height: 120px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAMFBMVEXFxcX////CwsLGxsb7+/vT09PJycn19fXq6urb29ve3t7w8PDOzs7n5+f5+fnt7e30nlkBAAAFHUlEQVR4nO2dC5qqMAyFMTwUBdz/bq+VYYrKKJCkOfXmXwHna5uTpA+KwnEcx3Ecx3Ecx3Ecx3Ecx3Ecx3Ecx3Ecx3EcA2iO9cdIc5PUdO257y+BU39u66b4HplE3fk6VIcnqmNfl1+gksr6+iIucjl3WYukor7+re6Hoe1y1UhNO3zUd+fUFRmKpOa0Tt6dY5ubRCrOG/QFLk1WGmnt/JxzykcjdZ/jyxJDLlOV2l36AtcsJJb9boG3YcR3DuqODIE3ztYKPkDdmwRmpUToUaSaq++AvRgZMWbOpbQW8hdCAm8ZDugoikzREdCJ2okJPBx6azFLNOwoOgcxojJ98JkaTSJxMpklKrCAKhZGI0drTY/wU5lXoJYibannV9NYy4oozNEAkPHTjop+DTDxVGkIgYJNoyQQJtiIW+EMjGAjm649AjGIaqswcEFQKJ2QPlJbqytki6ZXAAZRJ52J2McaUowzAfs+uFzrYhnzaapphiPWdaJWShqxjqa6kTTQ205TVbsfMa6htL0iYOsXpJrQjHSmCkv1QGPtiHqlYcQ21Gj7fcDU8xOEUuNgSltPzexh+HqFlanCBHZ4OLhCV+gK/3OF6vWvucLv98MUOY2pwu/PS/+D2qJU7pYGbOvDFDW+bbON9p3o3oRxn0bfLgZTgSn6pSfrtr56qLHemtHPTK2319SzGvtjQ9qeb39WgS66Cm073nd0U1PzDdJCO3Gzn6TKpl9Zq7ujGWsQhlA3NwWIMwG9zM08Y/tBrR9VWeczv5CSQuuUNKIUTk23ZJ5RKfVhjnkXotfWIlgX2BSCDYbZR+QTcLhb3dKZDUY2M0d4KWItwhHRah/zsrOgKw4wycwjcgEVcgQDQo23CqSiWEJkFAfod2oE1uIFdA1OsCPqFXYNTjCfb8Ez+iX2x5sKLlVbhtqdDcar9ZevhnbZxoBUD35k23t0d304LYs1ELVbnfFaZ/REJJX9niP8Q19moZGo3m8XR/yBvOnjFfsXcI2c8ZuNo7WMP5HQh6yRGrlmFOJTnyTcT+zRlqPUBI2gTVWNUzUna1ERgecgF4GpNBQ38jGqxVLzQA1A31Rrhk6Yz9QEh/WND0GnuG9huhiTXJkxfAizTHLr6cbJKN6UCU6x/2DTRE1xEeEXi3O0ZUqBN4nJRzHhFB1JPlFTBZlI2kQ8zc3KJ1Le8DIRmFJiknuVS6RK4Ej/JtBfJErDSzOBiY4wJHX6Z1I4v1GUmdCPNirnLLeg3oJLcbX5PcpHNbRvOa1A956QmRPOUXVF+zkaUJynpkYR0bOMJH2nNej1pqyV/aKkz9jr5yj5vrXXz1F5SQLACiMapmierj2ikLyleKdlA/I/2oFxiglxx9B+mHwz0lf34IZQfhDRhlD6bhvgEAoPYooHkTczSIZTLC+cEExsoNKZiGBiY9cCfo/Y/SjIOBMQizWWTe73CMUasJx7jlD+DdKdWUKoY4PRYFtGpO0G1Lx4RaadgTtJhf4fiGqGIwKWCGuGIwKWqP+7IxYCzygjR9IAO5pC7Da9g70TBVpWRNgFBlgT8RV2WxHbKwJMv4BOaEaYaU2K16yZMN/qgV+G7IWIvwyZCxHeDQMsR8wg0DBDDXB5H2EV+hkEGmaoySHQsEJNFoGGFWrAq98JRhUMX1iMMMqLLEIpK5jCbd4vw9nSt/72lewXiN6jmdjfq8Hdknlk92ZwJnbIMMRM7JBhiFlUFoHd1UWaP1QKsPsHA5mkNB+Smn9JqV3wskatnQAAAABJRU5ErkJggg==" alt=""></td> 
                        @endif
                          <td>{{ $service->short_description }}</td>
                       
                        <td>
                          <button class="btn btn-primary btn-pd">
                            <a style="color: white" class="d-inline-block" href="{{route('business-service.edit',[$service->id])}}">
                              <i class="bx bx-edit-alt me-1"></i> Sửa
                            </a>
                          </button> 
                          <button type="button" class="btn btn-danger btn-pd" data-toggle="modal" data-target="#confirmationModal{{ $service->id }}">
                              <i class="bx bx-trash me-1"></i> Xóa
                          </button>
                          <div class="modal fade" id="confirmationModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
                                      <form action="{{ route('business-service.destroy', ['id' => $service->id]) }}" method="POST" style="display: inline-block;">
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
            <form action="{{ route('business-service.store') }}" method="POST" id="form-admin-service" enctype="multipart/form-data">
              @csrf
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Thêm dịch vụ</h4>
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