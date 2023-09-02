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
          <!-- Register -->
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
              <p class="mb-4">Vui lòng đăng nhập vào tài khoản của bạn</p>

              <form id="formAuthentication" class="mb-3" action="{{ route('auth.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Mật khẩu</label>
                    <!-- <a href="auth-forgot-password-basic.html">
                      <small>Quên mật khẩu?</small>
                    </a> -->
                  </div>
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
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Ghi nhớ tôi </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Đăng nhập</button>
                </div>
              </form>
              <div class="mb-3">
                  <button class="btn btn-light d-grid w-100" type="submit">
                  <a href="{{ url('auth/google') }}" class="custom-google-button">
                    <span class="icon"><i class="fa fa-google"></i></span>
                    Đăng nhập bằng Google
                  </a>
                  </button>
                </div>
         


              <p class="text-center">
                <span>Bạn là người mới?</span>
                <a href="{{route('register')}}">
                  <span>Tạo tài khoản</span>
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
    <script>
        // Clear sessionStorage
        sessionStorage.clear();
    </script>
    <!-- / Content -->
@endsection