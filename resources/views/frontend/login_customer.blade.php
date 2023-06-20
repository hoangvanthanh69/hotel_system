<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập tài khoản</title>
    <link rel="icon" type="image/png" href="{{asset('frontend/img/icon.jpg')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/index_frontend.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <div class="grid">
        <div class="icon-login-user">
                <div class="icon-name-login">
                    <a href="{{route('dangnhap')}}">
                        <strong class="logo-name-hotel">
                            Hotel
                        </strong>
                            Tech
                    </a>
                </div>
                <div>Đăng nhập</div>
        </div>
    </div> 

    <div class="login-form-header-user home-filter-user-login login-customer">
        <div class="col-8 form-img-user">
            <img src="{{asset('frontend/img/logo-hotel.jpg')}}" >   
        </div>
        
        <div class="col-4 form-user">
            <form method="POST" action="{{route('dangnhap')}}">
                @csrf
                <h3 class="heading-login-user">Đăng Nhập</h3>
                <div class="form-group form-submit-user">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" class="form-control" placeholder="@gmail.com" value="" required autofocus>
                    <span class="form-mesage"></span>
                </div>
                <div class="form-group form-submit-user">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                    <span class="form-mesage"></span>
                </div>

                <div>
                    <button type="submit" class="form-submit form-submit-user">
                        Đăng Nhập
                    </button>
                </div>

                <!-- <div class="">
                    <button class="form-submit form-submit-user login-user-google">
                        <i class="fa-brands fa-google"></i>
                        Đăng nhập với google
                    </button>
                </div> -->

                <div class="login-user-register">
                    Bạn chưa có tài khoản? 
                    <a href="{{route('register')}}"> Đăng Ký</a>
                </div>
            </form>
        </div>
    </div>
    <div class="footer-imge">
        <div class="footer-imge-license footer-imge-user">
            © HoangThanh
        </div>
    </div>
</body>