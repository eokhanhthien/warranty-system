<form action="{{ route('business-service.update', ['id' => $business_service->id]) }}" method="POST" id="form-admin-service" enctype="multipart/form-data">
@csrf
@method('PUT')
    <div class="nav-align-top mb-4">
      
                      <div class="tab-pane fade active show" id="navs-justified-home" role="tabpanel">

                        <div class="form-group">
                            <label for="name"><h6 class="card-title text-primary">Tên dịch vụ  </h6> </label>
                            <input type="text" class="form-control" id="name" name="name" value ="{{!empty($business_service->name) ? $business_service->name : '' }}">
                            <span class="error-message" id="name-error"></span>

                        </div>

                        <h6 class="card-title text-primary">Ảnh</h6>
                        <div class="form-group">
                                <label for="image">Ảnh nhỏ</label>
                                <input type="file" class="form-control" id="image" name="image" onchange="displayThumbnail(event)">
                                <span class="error-message" id="image-error"></span>
                        </div>
                        @include('select-options.show_thumnail', ['image' => $business_service->image])
                        <input type="hidden" id="" name="image_width" value="408" >
                        <input type="hidden" id="" name="image_height" value="230" >


                        
                        <div class="form-group">
                          <label for="short_description"><h6 class="card-title text-primary mt-3">Mô tả ngắn gọn dịch vụ của bạn</h6> </label>
                          <textarea id ="short_description" class="form-control mt-3 mb-3" style="height: 100px" placeholder="Mô tả chung về dịch vụ của bạn" name="short_description">{{!empty($business_service->short_description) ? $business_service->short_description : '' }}</textarea>    
                          <span class="error-message" id="short_description-error"></span>
                        
                        </div>    

                        <h6 class="card-title text-primary">Tính năng của dịch vụ</h6> 
                        <div id="input-container">
                        <!-- Input ban đầu -->
                        <?php
                        $business_service = json_decode($business_service->service);
                        ?>
                        @if (!empty($business_service) )
                            @foreach ($business_service as $index => $value)
                                <div class="input-group">
                                    <input type="text" name="service[{{ $index }}]" class="form-control" value="{{ $value }}">
                                    <div class="btn btn-danger" onclick="removeInput(this)">Xóa</div>
                                </div>
                            @endforeach
                        @else
                        <div class="input-group">
                            <input type="text" name="service[0]" class="form-control">
                            <div class="btn btn-danger" onclick="removeInput(this)">Xóa</div>
                        </div>
                        @endif
                        </div>
                        <div class="btn btn-success mt-4 mb-4" onclick="addInput()">Thêm tính năng</div>

                        <h6 class="card-title text-primary">Mô tả chi tiết dịch vụ</h6> 
                        @include('ckeditor.ckeditor')
                        
                        <!-- <div class="text-right">
                          <button style="submit" class="btn btn-primary mt-3">Lưu</button>
                        </div> -->
                      
        </div>
    </div>
    <div class="text-right">
    <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>

    </div>

</form>

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

<script>
    $(document).ready(function() {
        var formId = '#form-admin-service';
        var validateUrl = '/validate-admin-service';

        setupFormValidation(formId, validateUrl);

        var id_table = '#table_team';
        searchDataTable(id_table,true, true, 20);

    });

const roleSelect = document.getElementById('role');
const businessSelect = document.getElementById('business_id');

roleSelect.addEventListener('change', function() {
    const selectedRole = roleSelect.value;

    if (selectedRole == '1') {
        businessSelect.disabled = true;
        businessSelect.value = ''; // Reset giá trị trường "Thuộc doanh nghiệp" thành rỗng
    } else {
        businessSelect.disabled = false;
    }
});

</script>