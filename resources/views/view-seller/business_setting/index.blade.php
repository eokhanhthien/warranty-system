<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/business_setting/css/style.css') }}">
</head>
<body style="height: 100vh; overflow:hidden;">

    <div class="main">

        <div class="container">
        <form action="" method="POST" id="form-business-setting" class="appointment-form">
            @csrf
            <h2 class="text-primary">Thiêt lập doanh nghiệp của bạn</h2>
            <div class="row">
                <div class="form-group col-lg-6">
                    <label style="color: black;" for="projectName">Tên doanh nghiệp</label>
                    <input type="text" class="form-control mb-2" id="projectName" placeholder="Nhập tên dự án" name="name" oninput="generateSlug(1)">
                    <span  style="color: red;" class="error-message" id="name-error"></span>
                </div>

                <div class="form-group col-lg-6">
                    <label style="color: black; " for="slug">Domain</label>
                    <input type="text" class="form-control mb-2" id="slug" placeholder="Slug" name="domain" readonly>
                </div>
                <div class="form-group col-lg-6">
                    <label style="color: black; " for="email">Email doanh nghiệp</label>
                    <input type="text" class="form-control mb-2" id="email" placeholder="Nhập người dùng" name="email">
                    <span  style="color: red;" class="error-message" id="email-error"></span>
                </div>
                <div class="form-group col-lg-6">
                    <label style="color: black; " for="phone_number">Số điện thoại liên hệ</label>
                    <input type="text" class="form-control mb-2" id="phone_number" placeholder="Nhập Số điện thoại liên hệ" name="phone_number">
                    <span  style="color: red;" class="error-message" id="phone_number-error"></span>
                </div>

                <div class="form-group col-lg-6">
                <label style="color: black; " for="business_category_id">Danh mục doanh nghiệp</label>
                    <select name="business_category_id" id="business_category_id" style="padding-right: 1.9rem !important;" class="form-control mb-2">
                            <option value="">Chọn danh mục</option> 
                            @if(!empty($business_category))
                                @foreach($business_category as $category)
                                    <option value="{{$category->id}}">{{$category->vi_name}}</option>    
                                @endforeach
                            @endif   
                    </select>
                    <span  style="color: red;" class="error-message" id="business_category_id-error"></span>
                </div>
                    
                <div class="form-group col-lg-6">
                    <label style="color: black; " for="business_display_id">Chọn giao diện cho Website</label>
                    <div class="d-flex">
                    <input type="text" class="form-control mb-2" id="business_display_id"  name="business_display_id" readonly>
                    <div><span class="btn btn-success" id="choose-display-btn" >Chọn</button></div>
                    </div>
                    <span  style="color: red;" class="error-message" id="business_display_id-error"></span>
                </div>
                
                </div>
                            
                        
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="submit-btn">Lưu</button>
                </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal fade" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="displayModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="displayModalLabel">Chọn giao diện cho Website</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(!empty($business_display))
                        <div class="row">
                        @foreach($business_display as $display)
                        <div class="col-md-4">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-dark">{{ $display->vi_name }}</h5>
                                <td><iframe src="https://drive.google.com/file/d/{{$display->image}}/preview" alt="" style="width: 100%; height: 120px"></iframe></td>
                                <button class="btn btn-primary select-display-btn" data-display-id="{{ $display->slug }}">Chọn</button>
                            </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    @else
                        <p>Không có giao diện nào.</p>
                    @endif
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
            </div>
        </div>
        </div>


        </div>

    </div>
<!-- Gọi hàm validate để xử lý form -->
<script src="{{ asset('assets/js/validateForm.js') }}"></script>
<!-- Gọi hàm tạo slug -->
<script src="{{ asset('assets/js/slug.js') }}"></script>
<script>
    $(document).ready(function() {
        var formId = '#form-business-setting';
        var validateUrl = '/validate-business-setting';

        setupFormValidation(formId, validateUrl);

    });
</script>

<script>
  // Lắng nghe sự kiện khi nhấp chuột vào nút "Chọn giao diện"
  document.getElementById('choose-display-btn').addEventListener('click', function(e) {
    e.preventDefault(); // Ngăn chặn hành vi mặc định của nút submit

    // Hiển thị modal
    $('#displayModal').modal('show');
  });
</script>

<script>
  // Lắng nghe sự kiện khi nhấp chuột vào nút "Chọn"
  const selectButtons = document.getElementsByClassName('select-display-btn');
  const businessDisplayInput = document.getElementById('business_display_id');

  for (let i = 0; i < selectButtons.length; i++) {
    selectButtons[i].addEventListener('click', function() {
      const displayId = this.getAttribute('data-display-id');
      businessDisplayInput.value = displayId;
      $('#displayModal').modal('hide'); // Đóng modal sau khi chọn
    });
  }
</script>
</body>
</html>