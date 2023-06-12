<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Phòng Khách Sạn</title>
    <link rel="stylesheet" href="{{asset('backend/css/index.css')}}">
    <link rel="icon" type="image/png" href="{{asset('frontend/img/icon.jpg')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <div class="main">
        <div class="row main-row container-fluid">
            <div class="col-2 nav-row-2">
                <div class="row-2-ul">
                    <ul class="flex-column">
                        <div class="header-with-logo-name">
                            <strong class="logo-name-travel">
                                Hotel
                            </strong>
                                Tech
                        </div>
                        <div class="logout-admin">
                            <span>
                                Xin chào
                                @if (Session::get('admin'))
                                    @if (isset(Session::get('admin')['admin_name']))
                                        {{ Session::get('admin')['admin_name'] }} !
                                    @else
                                        <p>Welcome</p>
                                    @endif
                                @endif
                            </span>
                            <span>
                                <a href="{{route('logout')}}">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </a>
                            </span>
                        </div>
                        <div class="home-filter" id="filter_button">
                            <div class="home-filter-button" data-filter="all">
                                <a class="@yield('sidebar-active-home')" href="{{route('admin')}}">
                                    <i class=" fa fa-home icon-all-admin-nav" aria-hidden="true"></i>
                                    Tổng quan
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="home-filter" id="filter_button">
                            <div class="home-filter-button" data-filter="all">
                                <a class="@yield('sidebar-active-room')" href="{{route('quan-ly-phong')}}">
                                <i class="fas fa-person-booth"></i>
                                    Quản lý phòng
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="home-filter" id="filter_button">
                            <div class="home-filter-button" data-filter="all">
                                <a class="@yield('sidebar-active-invoice')" href="{{route('quan-ly-hd')}}">
                                    <i class="fas fa-file-invoice-dollar icon-all-admin-nav"></i>
                                    QL Khách thuê Phòng
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="home-filter" id="filter_button">
                            <div class="home-filter-button" data-filter="all">
                                <a class="@yield('sidebar-active-status-room')" href="{{route('quan-ly-trang-thai-phong')}}">
                                    <i class="fas fa-quidditch"></i>
                                    Trạng thái phòng
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="home-filter" id="filter_button">
                            <div class="home-filter-button" data-filter="all">
                                <a class="@yield('sidebar-active-staff')" href="{{route('quan-ly-nhan-vien')}}">
                                    <i class="fa-solid fa-clipboard-user"></i>
                                    Quản lý nhân viên
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="home-filter" id="filter_button">
                            <div class="home-filter-button" data-filter="all">
                                <a class="@yield('sidebar-active-acount')" href="{{route('quan-ly-tai-khoan')}}">
                                    <i class="fa-solid fa-user"></i>
                                    Quản lý tài khoản
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="home-filter" id="filter_button">
                            <div class="home-filter-button" data-filter="all">
                                <a class="@yield('sidebar-active-service')" href="{{route('quan-ly-dich-vu')}}">
                                <i class="fa-brands fa-usps"></i>
                                    Quản lý dịch vụ
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="home-filter" id="filter_button">
                            <div class="home-filter-button" data-filter="all">
                                <a class="" href="{{route('admin')}}">
                                    <i class=" fa fa-home icon-all-admin-nav" aria-hidden="true"></i>
                                    Quản lý khách hàng
                                </a>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="col-10 nav-row-10">
            @yield('content')

                <footer class="sticky-footer">
                    <div class="container">
                        <div class="text-center">
                            <small>© HoangThanh</small>
                        </div>
                    </div>
                </footer>
            </div>
            
        </div>
    </div>
    
</body>
</html>