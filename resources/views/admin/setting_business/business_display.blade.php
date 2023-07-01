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
    @if(View::exists('admin.setting_business.display_custom.' . session()->get('businesses.slug') . '.' . session()->get('businesses.display')))
      @include('admin.setting_business.display_custom.' . session()->get('businesses.slug') . '.' . session()->get('businesses.display'))
      @else
      <p>Chưa  cấu hình, hãy liên hệ tổng đài 0946144333 được hướng dẫn</p>
  @endif
    </div>

    </div>
</div>
<script>
  // Xử lý sự kiện khi người dùng chọn hình ảnh
  $('#imageUpload').on('change', function() {
    var files = Array.from(this.files);  
    // Xóa các thumbnail hiện tại (nếu có)
    $('#thumbnailContainer').empty();
    // Lặp qua từng tệp được chọn và tạo thumbnail
    var count = 0;
    files.forEach(function(file) {
      if (count >= 4) {
        return;
      }
      var reader = new FileReader();
      reader.onload = function(event) {
        var thumbnail = $('<div class="col-sm-2"></div>').html('<img class="img-thumbnail" src="' + event.target.result + '">');
        $('#thumbnailContainer').append(thumbnail);
      };
      reader.readAsDataURL(file);
      count++;
    });
    // Hiển thị thông báo nếu vượt quá số lượng hình ảnh cho phép
    if (count > 4) {
      $('#imageUploadMessage').text('Chỉ được chọn tối đa 4 ảnh.');
    } else {
      $('#imageUploadMessage').text('');
    }
  });
</script>

<script>
    let inputCount = 1;

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
    }
  </script>
@endsection