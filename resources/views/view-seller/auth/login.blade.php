<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Bao gồm tệp tin CSS của Toastr -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bao gồm tệp tin JavaScript của Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        /* Canh giữa màn hình */
        .center {
            margin-top: 280px;
        }
        span.error-message {
            color: red !important;
        }
    </style>
    </head>
    <body>
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
    <div class="center ">
                <form style="margin: auto;
                padding: 30px;
                max-width: 600px;" method="POST" id="form-register-customer" action="{{route('seller.get.login', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)])}}">
                @csrf
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <h4>ĐĂNG NHẬP</h4>
                </div>
                <div class="form-outline mb-4">
                    <input type="email" name='email' id="form2Example1" class="form-control" placeholder  ="Email"/>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name='password' id="form2Example2" class="form-control" placeholder  ="Mật khẩu"/>
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4 g-0">
              
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" />
                        <label class="form-check-label" for="form2Example31"> Ghi nhớ mật khẩu </label>
                    </div>
                    

                    <div class="col">
                    <!-- Simple link -->
                        Bạn chưa có tài khoản?<a href="{{route('seller.register', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)])}}"> Đăng ký ngay</a>
                    </div>
                </div>

                 <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Đăng nhập</button>
                    <div class="col mt-4">
                    <!-- Simple link -->
                        <a href="{{route('seller.business', ['domain' => request()->segment(2), 'category_slug' => request()->segment(3)])}}"> Quay lại</a>
                    </div>
                </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
