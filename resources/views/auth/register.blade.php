@extends('auth.auth_layout')
@section('content')

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
<style>
        /* Quy tắc CSS của toastr */
        .toast-success {
            background-color: #28a745;
            /* Các quy tắc khác */
        }
        
        .toast-error {
            background-color: #dc3545;
            /* Các quy tắc khác */
        }
</style>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img class="logo-img" style=' width: 52px ' src="{{ asset('/img/logo-eo.png') }} " alt="">
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder">Digital-eo</span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Giải pháp chuyển đổi số cho doanh nghiệp</h4>
              <p class="mb-4">Tạo tài khoản ngay</p>

              <form id="form-register" class="mb-3" action="{{route('post.register')}}" method="POST">
              @csrf
                <div class="mb-3">
                  <label for="username" class="form-label">Họ và tên</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="name"
                    placeholder="Enter your username"
                    autofocus
                  />
                  <span class="error-message" id="name-error"></span>
                </div>
                

                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                  <span class="error-message" id="email-error"></span>
                </div>

                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Mật khẩu</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                  <span class="error-message" id="password-error"></span>
                </div>

                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Nhập lại mật khẩu</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="repassword"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                  <span class="error-message" id="repassword-error"></span>
                </div>
                <!-- <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                    <label class="form-check-label" for="terms-conditions">
                      I agree to
                      <a href="javascript:void(0);">privacy policy & terms</a>
                    </label>
                  </div>
                </div> -->
                <button class="btn btn-primary d-grid w-100" id="submit-btn" type="submit">Đăng ký</button>
              </form>

              <p class="text-center">
                <span>Bạn đã có tài khoản?</span>
                <a href="{{route('login')}}">
                  <span>Đăng nhập</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>

    <!-- / Content -->
    <!-- Gọi hàm validate để xử lý form -->
<script src="{{ asset('assets/js/validateForm.js') }}"></script>
<script>
    $(document).ready(function() {
        var formId = '#form-register';
        var validateUrl = '/validate-register';

        setupFormValidation(formId, validateUrl);

    });
</script>
@endsection