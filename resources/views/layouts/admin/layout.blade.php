<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
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
                            <a class="sidebar-link" href="./index.html" aria-expanded="false">
                                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                                <span class="hide-menu">Trang chủ</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-contract.html" aria-expanded="false">
                                <span>
                  <i class="ti ti-article"></i>
                </span>
                                <span class="hide-menu">Quản lí phòng</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-bill.html" aria-expanded="false">
                                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                                <span class="hide-menu">Quản lí điện điện</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-PayBill.html" aria-expanded="false">
                                <span>
                  <i class="ti ti-cards"></i>
                </span>
                                <span class="hide-menu">Quản lí nước</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-TransactionHistory.html" aria-expanded="false">
                                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                                <span class="hide-menu">Quản lí hóa đơn</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="ui-contact.html" aria-expanded="false">
                                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                                <span class="hide-menu">Quản lí hợp đồng</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="ui-contact.html" aria-expanded="false">
                                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                                <span class="hide-menu">Quản lí giao dịch</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="ui-contact.html" aria-expanded="false">
                                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                                <span class="hide-menu">Quản lí cơ sở vật chất</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="ui-contact.html" aria-expanded="false">
                                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                                <span class="hide-menu">Thống kê</span>
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
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
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
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="authentication-MyInformation.html" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">Thông tin cá nhân</p>
                                        </a>
                                        <a href="authentication-ChangePassword.html" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">Đổi mật khẩu</p>
                                        </a>

                                        <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Đăng xuất</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <img class="card-img" src="data:image/jpeg;base64,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"
                                    alt=" ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }} "></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }} "></script>
    <script src="{{ asset('assets/js/app.min.js') }} "></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }} "></script>
</body>

</html>
