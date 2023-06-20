<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="icon" type="image/png" href="{{asset('frontend/img/icon.jpg')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/index_frontend.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="grid">
            <div class="header-with">
                <div class="logo-hotel-hotel">
                     <img src="{{asset('frontend/img/icon.jpg')}}" class="" alt="...">
                </div>
                <div class="header-with-logo">
                    <a href="#" class="header-with-logo-name">
                        <strong class="logo-name-hotel">
                            Hotel
                        </strong>
                            Tech
                    </a>
                </div>

                <!-- <div class="header-with-search"> -->
                    <div class="header-with-search-header">
                        <form action="" method="POST" id="input_filter" class="header-with-search-form"></form>
                            <i class="header-with-search-icon fas fa-search"></i>
                            <input type="text" id="search_item" name="fullname" autocapitalize="off" class="header-with-search-input" placeholder="Nhập để tìm kiếm">
                        
                    </div>
                <!-- </div> -->

                <div class="header-criteria">
                    <h3 class="header-criteria-h3">Sạch Sẽ</h3>
                    <p class="header-criteria-p">Uy tính</p>
                </div>

                <div class="header-criteria-quality">
                    <h3 class="header-criteria-h3">Chất lượng</h3>
                    <p class="header-criteria-p">Đảm bảo</p>
                </div>

                <div class="header-criteria-quality">
                    <h3 class="header-criteria-h3">Thiên đường</h3>
                    <p class="header-criteria-p">Nghĩ dưỡng</p>
                </div>

                <div class="header-criteria-quality header-criteria-login ">
                    @if (Session::get('home'))
                        @if (isset(Session::get('home')['name']))
                            <a href="#" aria-expanded="true" id="dropdownMenuAcc" data-bs-toggle="dropdown" class="nav-item nav-link user-action header-criteria-h3 name-login-user">
                                {{ Session::get('home')['name'] }}
                            </a>
                        @else
                            <a href="{{ route('login-customer') }}" class="header-criteria-link-login">Đăng nhập</a>
                        @endif
                    @else
                        <a href="{{ route('login-customer') }}" class="header-criteria-link-login">Đăng nhập</a>
                    @endif
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuAcc">
                        <div class="">
                            <div class="header-with-account-span">
                                <li class="mb-2">
                                    <a href="{{route('logoutuser')}}">
                                        Đăng xuất
                                        <i class="fa-solid fa-right-from-bracket text-warning ps-2"></i>
                                    </a>
                                </li>

                                <li>
                                    <a class="" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Quản lý tài khoản</a>
                                </li>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="">
            <div class="grid-nav">
                <div class="grid-row-12">
                    <div class="home-filter grid" id="filter_button">
                        <a class="" href="{{route('home')}}">
                            <button class="btnbtn home-filter-button @yield('sidebar-active-home')" >
                                Trang chủ
                            </button>
                        </a>

                        <a class="" href="{{route('rooms-customer')}}">
                            <button class="btnbtn home-filter-button @yield('sidebar-active-rooms')">
                                Các phòng
                            </button>
                        </a>
                        

                        <a href="">
                            <button class="btnbtn home-filter-button">
                                Hướng dẫn đặt phòng
                            </button>
                        </a>
                        
                        <a href="{{route('introduce')}}">
                            <button class="btnbtn home-filter-button @yield('sidebar-active-introduce')">
                                Giới thiệu
                            </button>
                        </a>

                        <a href="{{route('order-history')}}">
                            <button class="btnbtn home-filter-button @yield('sidebar-active-history')" >
                                Lịch sử đặt phòng
                            </button>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </main>
    @yield('content')

    <footer>
        <div class="footer">
            <div class="grid">
                <div class="grid-row grid-row-footer">
                    <div class="home-row-column home-row-column-footer">
                        <div class="">
                            <div class="contact">
                                <span class="contact-support">
                                    Hổ trợ khách hàng
                                </span>
                                <ul class="contact-support-list">
                                    
                                    <li class="contact-support-item">
                                        <i class="contact-support-item-icon-call fas fa-tty"></i>
                                        <a href="tel:0837641469" class="contact-support-item-call-link">
                                            <span>Tư vấn: </span>
                                            0837641469
                                        </a>
                                    </li>

                                    <li class="contact-support-item">
                                        <a href="" class="contact-support-item-call-link">
                                            <i class="fa-solid fa-location-dot icon-location"></i>
                                        </a>
                                        <span class="contact-support-item-call contact-support-item-call-link">Đường 3/2, phường Xuân Khánh, quận Ninh Kiều, thành phố Cần Thơ</span>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="home-row-column home-row-column-footer">
                        <div class="">
                            <div class="contact">
                                <span class="contact-support">
                                    Theo dõi chúng tôi trên
                                </span>
                                <ul class="contact-support-list">
                                    <li class="contact-support-item">
                                        <i class="contact-support-item-icon-facebook fab fa-facebook"></i>
                                        <a href="#" class="contact-support-item-call-link">
                                            Facebook
                                        </a>
                                    </li>
                                   
                                    <li class="contact-support-item">
                                        <i class="contact-support-item-icon-youtube fab fa-youtube"></i>
                                        <a href="#" class="contact-support-item-call-link">
                                            Youtube
                                        </a>
                                    </li>

                                    <li class="contact-support-item">
                                        <i class="contact-support-item-icon-instagram fa-brands fa-instagram"></i>
                                        <a href="#" class="contact-support-item-call-link">
                                            Instargram
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="home-row-column home-row-column-footer">
                        <div class="home-product-image home-product-image-footer">
                            <div class="contact">
                                <span class="contact-support">
                                    Về chúng tôi
                                </span>
                                <ul class="contact-support-list">
                                    <li class="contact-support-item">
                                        <a href="" class="contact-support-item-call-link">
                                            Hướng dẫn đặt phòng
                                        </a>
                                    </li>
                                    <li class="contact-support-item">
                                        <a href="#" class="contact-support-item-call-link">
                                            Giới thiệu
                                        </a>
                                    </li>

                                    <li class="contact-support-item">
                                        <a href="#" class="contact-support-item-call-link">
                                            Phòng
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="home-row-column home-row-column-footer">
                        <div class="home-product-image home-product-image-footer">
                            <div class="contact">
                                <h4 class="contact-support">
                                Liên hệ cửa hàng
                                </h4>
                                <div class="hot-line">
                                    <a href="tel:19001011">
                                        19001011
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="footer-imge">
                    <div class="footer-imge-license footer-imge-user">
                        © HoangThanh
                    </div>
                </div>
            </div>
    </footer>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('frontend/js/jquery.validate.js')}}"></script>