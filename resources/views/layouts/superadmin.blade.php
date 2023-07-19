<?php
// echo "<pre>";
// print_r(Auth::user());die;
?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>@yield('title')</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/logo-eo.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" /> -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Style.css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!--  jQuery -  bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Bao gồm tệp tin CSS của Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bao gồm tệp tin JavaScript của Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
    <!-- Phần này là data table js -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsPDF/1.5.3/jspdf.debug.js" defer></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar" id="top-page">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo mt-3">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo ">
                <img class="logo-img" style=' width: 52px' src="{{ asset('/img/logo-eo.png') }} " alt="">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Digital-eo</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- SUPER ADMIN -->
            @if (auth()->check() && auth()->user()->role == 1) 
            <!-- Dashboard -->
            <li class="{{ str_starts_with(request()->url(), url('superadmin/dashboard')) ? 'menu-item active' : 'menu-item' }}">
              <a href="{{ route('superadmin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">{{__('lang_v1.dashboard')}}</div>
              </a>
            </li>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Doanh nghiệp</span>
            </li>
            <li class="{{ str_starts_with(request()->url(), url('superadmin/businesses')) && url()->current() === url('superadmin/businesses') ? 'menu-item open' : 'menu-item' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class='menu-icon bx bx-git-branch'> </i>
                <div data-i18n="Layouts">{{__('lang_v1.branch')}}</div>
              </a>

              <ul class="menu-sub">
                <li class="{{ str_starts_with(request()->url(), url('superadmin/businesses')) && url()->current() === url('superadmin/businesses') ? 'menu-item active' : 'menu-item' }}">
                  <a href="{{ route('superadmin.businesses') }}" class="menu-link">
                    <div data-i18n="Without menu">Quản lý doanh nghiệp</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Nhân sự -->
            <li class="{{ str_starts_with(request()->url(), url('superadmin/team/')) ? 'menu-item open' : 'menu-item' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class='menu-icon bx bx-user-plus' ></i>
                <div data-i18n="Layouts">Khách hàng</div>
              </a>

              <ul class="menu-sub">
                <li class="{{ str_starts_with(request()->url(), url('superadmin/team/')) ? 'menu-item active' : 'menu-item' }}">
                  <a href="{{ route('superadmin.team') }}" class="menu-link">
                    <div data-i18n="Without menu">Quản lý khách hàng</div>
                  </a>
                </li>        
              </ul>
            </li>

            <li class="{{ str_starts_with(request()->url(), url('superadmin/businesses-categories/')) ? 'menu-item open' : 'menu-item' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class='menu-icon bx bxs-category'></i>
                <div data-i18n="Layouts">Danh mục</div>
              </a>

              <ul class="menu-sub">
                <li class="{{ str_starts_with(request()->url(), url('superadmin/businesses-categories/')) ? 'menu-item active' : 'menu-item' }}">
                  <a href="{{ route('superadmin.businesses.categories') }}" class="menu-link">
                    <div data-i18n="Without menu">Danh mục doanh nghiệp</div>
                  </a>
                </li>        
              </ul>
            </li>

            <li class="{{ str_starts_with(request()->url(), url('superadmin/businesses-display/')) ? 'menu-item open' : 'menu-item' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class='menu-icon bx bx-desktop'></i>
                <div data-i18n="Layouts">Giao diện</div>
              </a>

              <ul class="menu-sub">
                <li class="{{ str_starts_with(request()->url(), url('superadmin/businesses-display/')) ? 'menu-item active' : 'menu-item' }}">
                  <a href="{{ route('superadmin.businesses.display') }}" class="menu-link">
                    <div data-i18n="Without menu">Giao diện doanh nghiệp</div>
                  </a>
                </li>        
              </ul>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Gói doanh nghiệp</span>
            </li>

            <li class="{{ str_starts_with(request()->url(), url('superadmin/businesses-package/')) ? 'menu-item open' : 'menu-item' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class='menu-icon bx bx-package'></i>
                <div data-i18n="Layouts">Gói</div>
              </a>

              <ul class="menu-sub">
                <li class="{{ str_starts_with(request()->url(), url('superadmin/businesses-package/')) ? 'menu-item active' : 'menu-item' }}">
                  <a href="{{ route('businesses-package.index') }}" class="menu-link">
                    <div data-i18n="Without menu">Gói đăng ký</div>
                  </a>
                </li>        
              </ul>
            </li>

            @endif

            <!--  ADMIN  -->
            @if (auth()->check() && auth()->user()->role == 2) 
            <!-- Dashboard -->
            <li class="{{ str_starts_with(request()->url(), url('admin/dashboard')) ? 'menu-item active' : 'menu-item' }}">
              <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">{{__('lang_v1.dashboard')}}</div>
              </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Gói</span>
            </li>

            <li class="{{ str_starts_with(request()->url(), url('admin/subscription-package')) || str_starts_with(request()->url(), url('admin/show-packages')) ? 'menu-item open' : 'menu-item' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle" >
              <i class='menu-icon bx bx-package' ></i>
                <div data-i18n="Layouts">Gói doanh nghiệp</div>
              </a>
             
              <ul class="menu-sub">
                <li class="{{ str_starts_with(request()->url(), url('admin/show-packages')) ? 'menu-item active' : 'menu-item' }}">
                  <a href="{{route('package.show.packages')}}" class="menu-link">
                    <div data-i18n="Without menu">Gói của bạn</div>
                  </a>
                </li>        
              </ul>

              <ul class="menu-sub">
                <li class="{{ str_starts_with(request()->url(), url('admin/subscription-package')) ? 'menu-item active' : 'menu-item' }}">
                  <a href="/admin/subscription-package" class="menu-link">
                    <div data-i18n="Without menu">Đăng ký gói</div>
                  </a>
                </li>        
              </ul>

            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Doanh nghiệp</span>
            </li>
            <!-- Thông tin doanh nghiệp -->

            <li class="{{ str_starts_with(request()->url(), url('admin/business-info')) || str_starts_with(request()->url(), url('admin/business-display')) ? 'menu-item open' : 'menu-item' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle" >
              <i class='menu-icon bx bxs-business'></i>
                <div data-i18n="Layouts">Cài đặt doanh nghiệp</div>
              </a>

              <ul class="menu-sub">
                <li class="{{ str_starts_with(request()->url(), url('admin/business-info')) ? 'menu-item active' : 'menu-item' }}">
                  <a href="{{ route('admin.business.info') }}" class="menu-link">
                    <div data-i18n="Without menu">Thông tin chung</div>
                  </a>
                </li>        
              </ul>

              <ul class="menu-sub">
                <li class="{{ str_starts_with(request()->url(), url('admin/business-display')) ? 'menu-item active' : 'menu-item' }}">
                  <a href="{{ route('admin.business.display') }}" class="menu-link">
                    <div data-i18n="Without menu">Giao diện</div>
                  </a>
                </li>        
              </ul>
            </li>

            <li class="{{ str_starts_with(request()->url(), url('admin/business-service')) || str_starts_with(request()->url(), url('admin/business-products')) ? 'menu-item open' : 'menu-item' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle" >
              <i class='menu-icon bx bxs-component'></i>
                <div data-i18n="Layouts">Dịch vụ và sản phẩm</div>
              </a>

              <ul class="menu-sub">
                <li class="{{ str_starts_with(request()->url(), url('admin/business-service')) ? 'menu-item active' : 'menu-item' }}">
                  <a href="/admin/business-service" class="menu-link">
                    <div data-i18n="Without menu">Dịch vụ</div>
                  </a>
                </li>        
              </ul>

              <ul class="menu-sub">
                <li class="{{ str_starts_with(request()->url(), url('admin/business-products')) ? 'menu-item active' : 'menu-item' }}">
                  <a href="{{ route('admin.business.display') }}" class="menu-link">
                    <div data-i18n="Without menu">Sản phẩm</div>
                  </a>
                </li>        
              </ul>
            </li>
            @endif
            <!-- <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Pages</span>
            </li> -->

      
          

          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
           style="flex-wrap: inherit !important;">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                    <a href="{{ route('app.setLocale', ['locale' => 'en']) }}" class="flex-c-m trans-04 p-lr-25 language-link {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                        EN
                    </a>

                    <a href="{{ route('app.setLocale', ['locale' => 'vi']) }}" class="flex-c-m trans-04 p-lr-25 language-link {{ app()->getLocale() == 'vi' ? 'active' : '' }}">
                        VI
                    </a>
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                    @php
                        $name = auth()->user()->name;
                        $lastSpacePosition = mb_strrpos($name, ' ');
                        $lastName = mb_substr($name, $lastSpacePosition + 1);
                        $initial = mb_strtoupper(mb_substr($lastName, 0, 1));
                    @endphp

                    <div class="avatar avatar-online" style="background-color: #f8f9fa; text-align: center; display: inline-block; width: 40px; height: 40px; border-radius: 50%; line-height: 40px; font-weight: bold;">
                        <span style="display: inline-block; vertical-align: middle;">{{ $initial }}</span>
                    </div>

                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                            @php
                                $name = auth()->user()->name;
                                $lastSpacePosition = mb_strrpos($name, ' ');
                                $lastName = mb_substr($name, $lastSpacePosition + 1);
                                $initial = mb_strtoupper(mb_substr($lastName, 0, 1));
                            @endphp

                            <div class="avatar avatar-online" style="background-color: #f8f9fa; text-align: center; display: inline-block; width: 40px; height: 40px; border-radius: 50%; line-height: 40px; font-weight: bold;">
                                <span style="display: inline-block; vertical-align: middle;">{{ $initial }}</span>
                            </div>

                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{auth()->user()->name}}</span>
                            <small class="text-muted">{{auth()->user()->role == 1 ? 'Superadmin' : 'Admin'}}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('logout')}}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          @yield('content')
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <div class="buy-now" style="display: none;">
      <a href="#top-page" class="btn btn-danger btn-buy-now">
        <i class="fa fa-arrow-up"></i>
      </a>
    </div>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js')}}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
 window.addEventListener('scroll', function() {
    var buyNowDiv = document.querySelector('.buy-now');
    var scrollY = window.scrollY;

    if (scrollY > 100) {
      buyNowDiv.style.display = 'block'; // Hiển thị phần tử khi scroll y vượt quá 100
    } else {
      buyNowDiv.style.display = 'none'; // Ẩn phần tử khi scroll y nhỏ hơn hoặc bằng 100
    }
  });
</script>
  </body>
</html>
