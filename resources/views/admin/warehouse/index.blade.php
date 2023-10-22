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
          <button class="btn btn-primary m-3" data-toggle="modal" data-target="#myModal"><i class='bx bx-plus'></i> Tạo phiếu nhập</button>
    </div>
    <div class="card">

                <h5 class="card-header">Tất cả sản phẩm</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table" id="table_team">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Ảnh</th>
                        <th>Số lượng</th>
                      </tr>
                    </thead>
                    @if(!empty($products))
                    <tbody class="table-border-bottom-0">
                      @foreach($products as $product)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price)}} VNĐ</td>
                        @if(!empty($product->image))
                        <td><img  class="" src="https://drive.google.com/uc?export=view&id={{$product->image}}" alt="" style ="width: 100px"></td>

                        @else
                         <td><img style = "width: 120px; height: 120px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAMFBMVEXFxcX////CwsLGxsb7+/vT09PJycn19fXq6urb29ve3t7w8PDOzs7n5+f5+fnt7e30nlkBAAAFHUlEQVR4nO2dC5qqMAyFMTwUBdz/bq+VYYrKKJCkOfXmXwHna5uTpA+KwnEcx3Ecx3Ecx3Ecx3Ecx3Ecx3Ecx3Ecx3EcA2iO9cdIc5PUdO257y+BU39u66b4HplE3fk6VIcnqmNfl1+gksr6+iIucjl3WYukor7+re6Hoe1y1UhNO3zUd+fUFRmKpOa0Tt6dY5ubRCrOG/QFLk1WGmnt/JxzykcjdZ/jyxJDLlOV2l36AtcsJJb9boG3YcR3DuqODIE3ztYKPkDdmwRmpUToUaSaq++AvRgZMWbOpbQW8hdCAm8ZDugoikzREdCJ2okJPBx6azFLNOwoOgcxojJ98JkaTSJxMpklKrCAKhZGI0drTY/wU5lXoJYibannV9NYy4oozNEAkPHTjop+DTDxVGkIgYJNoyQQJtiIW+EMjGAjm649AjGIaqswcEFQKJ2QPlJbqytki6ZXAAZRJ52J2McaUowzAfs+uFzrYhnzaapphiPWdaJWShqxjqa6kTTQ205TVbsfMa6htL0iYOsXpJrQjHSmCkv1QGPtiHqlYcQ21Gj7fcDU8xOEUuNgSltPzexh+HqFlanCBHZ4OLhCV+gK/3OF6vWvucLv98MUOY2pwu/PS/+D2qJU7pYGbOvDFDW+bbON9p3o3oRxn0bfLgZTgSn6pSfrtr56qLHemtHPTK2319SzGvtjQ9qeb39WgS66Cm073nd0U1PzDdJCO3Gzn6TKpl9Zq7ujGWsQhlA3NwWIMwG9zM08Y/tBrR9VWeczv5CSQuuUNKIUTk23ZJ5RKfVhjnkXotfWIlgX2BSCDYbZR+QTcLhb3dKZDUY2M0d4KWItwhHRah/zsrOgKw4wycwjcgEVcgQDQo23CqSiWEJkFAfod2oE1uIFdA1OsCPqFXYNTjCfb8Ez+iX2x5sKLlVbhtqdDcar9ZevhnbZxoBUD35k23t0d304LYs1ELVbnfFaZ/REJJX9niP8Q19moZGo3m8XR/yBvOnjFfsXcI2c8ZuNo7WMP5HQh6yRGrlmFOJTnyTcT+zRlqPUBI2gTVWNUzUna1ERgecgF4GpNBQ38jGqxVLzQA1A31Rrhk6Yz9QEh/WND0GnuG9huhiTXJkxfAizTHLr6cbJKN6UCU6x/2DTRE1xEeEXi3O0ZUqBN4nJRzHhFB1JPlFTBZlI2kQ8zc3KJ1Le8DIRmFJiknuVS6RK4Ej/JtBfJErDSzOBiY4wJHX6Z1I4v1GUmdCPNirnLLeg3oJLcbX5PcpHNbRvOa1A956QmRPOUXVF+zkaUJynpkYR0bOMJH2nNej1pqyV/aKkz9jr5yj5vrXXz1F5SQLACiMapmierj2ikLyleKdlA/I/2oFxiglxx9B+mHwz0lf34IZQfhDRhlD6bhvgEAoPYooHkTczSIZTLC+cEExsoNKZiGBiY9cCfo/Y/SjIOBMQizWWTe73CMUasJx7jlD+DdKdWUKoY4PRYFtGpO0G1Lx4RaadgTtJhf4fiGqGIwKWCGuGIwKWqP+7IxYCzygjR9IAO5pC7Da9g70TBVpWRNgFBlgT8RV2WxHbKwJMv4BOaEaYaU2K16yZMN/qgV+G7IWIvwyZCxHeDQMsR8wg0DBDDXB5H2EV+hkEGmaoySHQsEJNFoGGFWrAq98JRhUMX1iMMMqLLEIpK5jCbd4vw9nSt/72lewXiN6jmdjfq8Hdknlk92ZwJnbIMMRM7JBhiFlUFoHd1UWaP1QKsPsHA5mkNB+Smn9JqV3wskatnQAAAABJRU5ErkJggg==" alt=""></td> 
                        @endif
                         
                        <td>              
                          <div class="d-flex ">
                        <button class="btn btn-link px-2" onclick="changeQuantity(this, -1)">
                          <i class="fas fa-minus"></i>
                        </button>

                        <input data-id="{{$product->id}}" min="1" name="quantity" value="{{$product->stock}}" type="number"
                          class="form-control form-control-sm" style='width: 100px;' onchange="updateQuantity(this.value, this.getAttribute('data-id'))" />

                        <button class="btn btn-link px-2" onclick="changeQuantity(this, 1)">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div></td>
                       
            
                      </tr>
                      @endforeach
                    </tbody>
                    @endif
                  </table>
                </div>

            <!-- Modal -->
            <form action="{{ route('warehouse.store') }}" method="POST" id="" enctype="multipart/form-data">
              @csrf
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Tạo phiếu nhập kho</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body"> 
                    <div class="nav-align-top mb-4"> 
                        <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">
                          <div class="form-group">
                          <label for="products"><h6 class="card-title text-primary">Nhà cung cấp </h6></label>
                          <select class="form-control" id="" name="supplier_id" required>
                              <option value="">Chọn danh nhà cung cấp</option>
                              @foreach($suppliers as $supplier)
                                  <option value="{{$supplier->id}}"  >{{$supplier->name}}</option>
                              @endforeach
                          </select>
                          </div>

                          <div class="form-group">
                          <label for="products"><h6 class="card-title text-primary">Ngày mua </h6></label>
                            <input class="form-control" type="date" name="purchase_date" required>
                          </div>

                          <div class="form-group">
                          <label for="products"><h6 class="card-title text-primary">Trạng thái nhập hàng </h6></label>
                          <select class="form-control" id="" name="status" required>
                              <option value="">Chọn trạng thái</option>
                               <option value="received"  >Đã nhận</option>
                               <option value="processing"  >Đang xử lý</option>
                               <option value="ordered"  >Đã đặt hàng</option>      
                          </select>
                          </div>


                            <div class="form-group">
                                <label for="products"><h6 class="card-title text-primary">Thêm sản phẩm </h6></label>
                                    <select id="products" class="form-control">
                                        <option value="">Chọn sản phẩm</option>
                                        <!-- Dùng Blade để hiển thị các tùy chọn cho categories -->
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">
                                                {{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <!-- Danh sách sản phẩm đã chọn -->
                            <div id="selectedProducts">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Các sản phẩm đã chọn sẽ được hiển thị ở đây -->
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group mt-3">
                            <label for="stock"><h6 class="card-title text-primary" >Ghi chú </h6> </label> 
                            <textarea class="form-control" placeholder="Nhập ghi chú" name="note" required></textarea>
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
        searchDataTable(id_table,true, true, 20);

    });
</script>

<!-- Số lượng kho -->
<script>
var csrfToken = $('meta[name="csrf-token"]').attr('content');

function updateQuantity(newQuantity, productId) {
  $.ajax({
    type: 'POST',
    url: "{{ route('stock.update')}}",
    headers: {
        'X-CSRF-TOKEN': csrfToken
    },
    data: {
      id: productId,
      quantity: newQuantity
    },
    dataType: 'json', // Nếu bạn mong đợi nhận JSON response từ server
    success: function(response) {
     
      if(response.success == 1){
        toastr.success(response.message);
      }else{
        toastr.error(response.message);
      }
    },
    error: function(xhr, status, error) {
      console.error('Có lỗi xảy ra khi cập nhật dữ liệu: ' + error);
    }
  });
}


function changeQuantity(button, step) {
  var input = button.parentNode.querySelector('input[type=number]');
  var currentValue = parseInt(input.value);
  
  var newValue = currentValue + step;
  if (newValue >= 1) {
    input.value = newValue;
    var cartId = input.getAttribute('data-id');
    updateQuantity(input.value, cartId);
  }
}
</script>

<script>

    // Sử dụng JavaScript để thêm và xóa sản phẩm
    const productsSelect = document.getElementById("products");
    const selectedProductsTableBody = document.querySelector("#selectedProducts tbody");
    const productsData = @json($products); // Chuyển dữ liệu sản phẩm từ Laravel sang JavaScript

    // Khởi tạo biến để theo dõi thứ tự
    let rowIndex = 0;

    // Mảng để theo dõi các sản phẩm đã thêm vào danh sách
const addedProductIds = [];

productsSelect.addEventListener("change", function () {
    const selectedOption = productsSelect.options[productsSelect.selectedIndex];
    const productId = selectedOption.value;

    // Kiểm tra xem sản phẩm đã được thêm trước đó hay chưa
    if (!addedProductIds.includes(productId)) {
        const selectedProduct = productsData.find(product => product.id == productId);

        if (selectedProduct) {
            const productRow = document.createElement("tr");
            productRow.setAttribute("data-product-id", productId);
            productRow.innerHTML = `
                <td>${selectedProduct.name}</td>
                <td>${selectedProduct.price} VNĐ</td>
                <td><img src="https://drive.google.com/uc?export=view&id=${selectedProduct.image}" alt="Hình ảnh sản phẩm" style="width: 100px;"></td>
                <td>
                    <input type='hidden' name="selected_product_ids[${rowIndex}]" value="${productId}">
                    <input data-id="${productId}" min="1" name="quantity[${rowIndex}]" value="1" type="number" class="form-control form-control-sm" style="width: 100px;">
                </td>
                <td>
                    <div class="btn btn-danger btn-sm" onclick="removeProduct(${productId})">Xóa</div>
                </td>
            `;

            rowIndex++; // Tăng thứ tự tự động sau khi sử dụng
            selectedProductsTableBody.appendChild(productRow);

            // Đánh dấu sản phẩm đã được thêm vào danh sách
            addedProductIds.push(productId);
        }
        productsSelect.value = '';
    }
});


function findProductIndex(productId) {
    for (let i = 0; i < addedProductIds.length; i++) {
        if (addedProductIds[i] == productId) {
            return i; // Trả về index nếu tìm thấy
        }
    }
    return -1; // Trả về -1 nếu không tìm thấy
}

// Hàm xóa sản phẩm
function removeProduct(productId) {

    // Xóa trong mảng kiểm tra trùng
     const indexToRemove = findProductIndex(productId);
    if (indexToRemove !== -1) {
        // Xóa sản phẩm khỏi mảng addedProductIds
        addedProductIds.splice(indexToRemove, 1);
    }

    // Lấy thẻ tr chứa sản phẩm theo productId
    const productRow = document.querySelector(`[data-product-id="${productId}"]`);
    if (productRow) {
        // Xóa thẻ tr khỏi DOM
        productRow.remove();
    }
}




</script>
@endsection