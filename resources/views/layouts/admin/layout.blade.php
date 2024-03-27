<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CodeFlow</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/Logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="" class="font-monospace" style="color: orange">
                        <img  src="{{ asset('assets/images/logos/CodeFlow.png') }}" width="200px" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link @if ($title === 'Trang chủ')
                                active
                            @endif" href="{{ route('admin.index') }}" aria-expanded="false">
                                <span>
                                    <i class="fa-solid fa-house"></i>
                                     {{-- sửa lại icon của menu --}}
                                </span>
                                <span class="hide-menu">Trang chủ</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link @if ($title === 'Quản lí phòng')
                            active
                        @endif" href="{{ route('room.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Quản lí phòng</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link @if ($title === 'Quản lí dịch vụ')
                            active
                        @endif" href="{{ route('service.index') }}" aria-expanded="false">
                                <span>
                                    <i class="fa-solid fa-wifi"></i>
                                    {{-- sửa lại icon của menu --}}
                                </span>
                                <span class="hide-menu">Quản lí dịch vụ</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link @if ($title === 'Quản lí điện')
                            active
                        @endif" href="./ui-bill.html" aria-expanded="false">
                                <span>
                                                      <i class="fa-solid fa-bolt"></i>
                                                    {{-- sửa lại icon của menu --}}
                </span>
                                <span class="hide-menu">Quản lí điện</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link @if ($title === 'Quản lí nước')
                            active
                        @endif" href="{{ route('waters.index') }}" aria-expanded="false">
                                <span>
                                    <i class="fa-solid fa-water"></i>
                                    {{-- sửa lại icon của menu --}}
                                </span>
                                <span class="hide-menu">Quản lí nước</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link @if ($title === 'Quản lí hóa đơn')
                            active
                        @endif" href="{{ route('bill.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-description"></i>
                                </span>
                                <span class="hide-menu">Quản lí hóa đơn</span>
                            </a>
                        </li>


                        <li class="sidebar-item">
                            <a class="sidebar-link @if ($title === 'Quản lí giao dịch')
                            active
                        @endif" href="ui-contact.html" aria-expanded="false">
                                <span>
                                    <i class="fa-solid fa-money-bill"></i>
                                 {{-- sửa lại icon của menu --}}
                                </span>
                                <span class="hide-menu">Quản lí giao dịch</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link @if ($title === 'Quản lí cơ sở vật chất')
                            active
                        @endif" href="{{route('interiors.index')}}" aria-expanded="false">
                                <span>
                                    <i class="fa-brands fa-intercom"></i>
                                    {{-- sửa lại icon của menu --}}
                                </span>
                                <span class="hide-menu">Quản lí cơ sở vật chất</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link @if ($title === 'Danh sách khách hàng')
                            active
                        @endif" href="{{route('user_information.index')}}" aria-expanded="false">
                                <span>
                                    <i class="fa-brands fa-intercom"></i>
                                    {{-- sửa lại icon của menu --}}
                                </span>
                                <span class="hide-menu">Danh sách khách hàng</span>
                            </a>
                        </li>


                        <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                                <i class="ti ti-bell-ringing"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <p target="_blank" class="btn btn-primary mt-3">hello ĐVĐ</p>
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt=""
                                        width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="authentication-MyInformation.html"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">Thông tin cá nhân</p>
                                        </a>
                                        <a href="authentication-ChangePassword.html"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">Đổi mật khẩu</p>
                                        </a>

                                        <a href="{{ route('admin.signout') }}"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Đăng xuất</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->

            <div class="container-fluid">
                @yield('content')
            </div>

        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }} "></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }} "></script>
    <script src="{{ asset('assets/js/app.min.js') }} "></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }} "></script>
    @yield('script')
</body>

</html>