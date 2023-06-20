@extends('layouts.customer_layouts')
@section('sidebar-active-rooms', 'actives' )
@section('content')
@if (session('error'))
    <div class="notification-order">
        {{ session('error') }}
    </div>
@endif
<form enctype="multipart/form-data" method='post' action="{{route('room-details', $tbl_rooms->id)}}">
    @csrf
    <div class="grid d-flex">
        <div class="col-6 mt-2">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" id="carouselImage" src="{{asset('uploads/rooms/'.$tbl_rooms['image'])}}" alt="">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" id="carouselImage2" src="{{asset('uploads/rooms/'.$tbl_rooms['image2'])}}" alt="">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" id="carouselImage3" src="{{asset('uploads/rooms/'.$tbl_rooms['image3'])}}" alt="">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="carousel-thumbnails">
                <div class="thumbnail active">
                    <img src="{{asset('uploads/rooms/'.$tbl_rooms['image'])}}" alt="" onclick="changeSlide(0)">
                </div>
                <div class="thumbnail">
                    <img src="{{asset('uploads/rooms/'.$tbl_rooms['image2'])}}" alt="" onclick="changeSlide(1)">
                </div>
                <div class="thumbnail">
                    <img src="{{asset('uploads/rooms/'.$tbl_rooms['image3'])}}" alt="" onclick="changeSlide(2)">
                </div>
            </div>
            <div>
                <h5 class="text-center">Đánh giá</h5>
                <div class="text-center text-warning">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star ps-3"></i>
                    <i class="fas fa-star ps-3"></i>
                    <i class="fas fa-star ps-3"></i>
                    <i class="fas fa-star ps-3"></i>
                </div>
            </div>   
            <div>
                <span class="describe-rooms-customer mt-2">{{$tbl_rooms['describe']}}</span>
            </div>   
        </div>
        <div class="col-6 mt-2">
            <h5 class="text-center text-primary">Thông tin Chi Tiết</h5>
            <div class="mt-3 ms-5">
                <div class="row container border-bottom">
                    <div class="col-6">
                        <h6 class="fs-5 text-secondary">Thông tin Phòng</h6>
                        <div class="d-flex">
                            <i class="fas fa-key"></i>
                            <p class="ps-3" id="roomCode">{{$tbl_rooms['ma_phong']}}</p>
                        </div>
                        <div class="d-flex">
                            <i class="fas fa-ruler-combined"></i>
                            <p class="ps-3">Chiều dài 332</p>
                        </div>
                        <div class="d-flex">
                            <i class="fas fa-users"></i>
                            <p class="ps-3">Số khách: {{$tbl_rooms['amount']}}</p>
                        </div>
                    </div>
                    <div class="col-6 ">
                        <h6 class="fs-5 text-secondary">Tính năng phòng</h6>
                        <div class="d-flex">
                            <i class="fas fa-warehouse"></i>
                            <p class="ps-3">Ban công</p>
                        </div>
                        <div class="d-flex">
                            <i class="fas fa-swimming-pool"></i>
                            <p class="ps-3">Hồ bơi</p>
                        </div>
                        <div class="d-flex">
                            <i class="fas fa-wifi"></i>
                            <p class="ps-3">Wifi miễn phí</p>
                        </div>
                        <div class="d-flex">
                            <i class="fas fa-snowflake"></i>
                            <p class="ps-3">Máy lạnh</p>
                        </div>
                    </div>
                </div>
                <div class="row container mt-3">
                    <div class="col-6">
                        <h6 class="fs-5 text-secondary">Tiện nghi phòng</h6>
                        <div class="pt-2">
                            <li>Máy lạnh</li>
                        </div>
                        <div class="pt-2">
                            <li>Nước đóng chai miễn phí</li>
                        </div>
                        <div class="pt-2">
                            <li>TV</li>
                        </div>
                        <div class="pt-2">
                            <li>Bàn làm việc</li>
                        </div>
                        <div class="pt-2">
                            <li>Quạt</li>
                        </div>
                        <div class="pt-2">
                            <li>Tủ lạnh</li>
                        </div>
                        <div class="pt-2">
                            <li>Ban công / sân hiên</li>
                        </div>
                    </div>
                    <div class="col-6">
                        <h6 class="fs-5 text-secondary">Tiện nghi phòng tắm</h6>
                        <div class="pt-2">
                            <li>Phòng tắm riêng</li>
                        </div>
                        <div class="pt-2">
                            <li>Vòi tắm đứng</li>
                        </div>
                        <div class="pt-2">
                            <li>Bộ vệ sinh cá nhân</li>
                        </div>
                        <div class="pt-2">
                            <li>Máy sấy tóc</li>
                        </div>
                    </div>
                </div>
                <div class="mt-3 price-room-order-customer d-flex">Giá phòng
                    <p id="roomPrice" class="ms-2"> {{number_format($tbl_rooms['price'])}} </p> VNĐ / đêm
                </div>
            </div>
        </div>
    </div>
</form>
<div class="d-flex mt-4 back-rooms-customer">
    <div class="">
        <a href="{{route('rooms-customer')}}">
            <button class="p-1 submit-order-back">Quay lại</button>
        </a>
    </div>
    <div class="ms-5">
        @if (Session::get('home') && isset(Session::get('home')['name']))
            <button class="p-1 submit-order-next" id="view-order-info" onclick="placeOrder()">Tiếp tục</button>
        @else
            <a href="{{ route('login-customer') }}">
                <button class="p-1 submit-order-next">Tiếp tục</button>
            </a>
        @endif
    </div>
</div>
<!-- hiển thị thông tin đặt hàng trước khi đặt -->
<form id="" method="post" class="form-horizontal" action="{{route('order-room')}}">
@csrf
    <div class="modal fade" id="orderInfoModal" tabindex="-1" aria-labelledby="orderInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderInfoModalLabel">Thông tin đặt phòng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex mb-3">
                        <label class="me-2 col-4 order-room-customer-label">Họ Tên: </label>
                        @if (Session::get('home') && isset(Session::get('home')['name']))
                            <input type="text" name="name" class="order-room-customer-infor col-6" value="{{ Session::get('home')['name'] }}">
                        @endif
                    </div>

                    <div class="d-flex mb-3">
                        <label class="me-2 col-4 order-room-customer-label">Số điện thoại: </label>
                        <input type="text" name="phone" class="order-room-customer-infor col-6">
                    </div>

                    <div class="d-flex mb-3">
                        <label class="me-2 col-4 order-room-customer-label">Số đêm: </label>
                        <input type="number" id="stayNights" name="stay_nights" min="1" onchange="calculateTotalPrice()" class="order-room-customer-infor col-6">
                    </div>

                    <div class="d-flex mb-3">
                        <label class="me-2 col-4 order-room-customer-label">Ngày nhận phòng: </label>
                        <input class="input-total-revenue" type="date" id="check_in" name="check_in"/>
                    </div>

                    <div class="d-flex mb-3">
                        <label class="me-2 col-4 order-room-customer-label">Mã phòng:  </label>
                        <span id="orderRoomCode">{{ $product_info->ma_phong }}</span>
                        <input type="hidden" name="ma_phong" value="{{ $product_info->ma_phong }}">
                    </div>

                    <div class="d-flex mb-3">
                        <label class="me-2 col-4 order-room-customer-label">Giá phòng:  </label>
                        <span id="orderRoomPrice" class="pe-2" >{{ $product_info->price }}</span> VNĐ/đêm
                    </div>

                    <div class="d-flex total-order-room-customer">
                        <label class="me-2 col-4 order-room-customer-label ">Tổng: </label>
                        <p id="totalPrice">0 VNĐ</p>
                        <input type="hidden" name="totalPrice" id="totalPriceInput">
                    </div>
                </div>
                <div class="modal-footer">
                    <h6 class="text-success payment-delivery">Thanh toán khi nhận phòng</h6>
                    <button class="btn btn-primary submit">Đặt phòng</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="{{asset('frontend/js/frontend.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>