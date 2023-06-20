@extends('layouts.customer_layouts')
@section('sidebar-active-home', 'actives' )
@section('content')
    <div class="container">
        <div class="row g-2 mt-2">
            <div>
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner img-item">
                        <div class="carousel-item active">
                            <img src="{{asset('frontend/img/p114c.jpg')}}" class="d-block w-100" alt="..." wight="100%">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('frontend/img/p112c.jpg')}}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('frontend/img/p113c.jpg')}}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <h5 class="mt-3">Danh sách phòng nổi bật</h5>
            @foreach($best_seller as $best)
                @if($best->total_bookings >= 2)
                    @foreach($tbl_rooms as $key => $val)
                        @if($val['ma_phong'] == $best->ma_phong)
                            <div class="col-3 room-customer-choose">
                                <div class="p-3 border bg-light">
                                    <a class="p-3" href="{{route('room-details', $val['id'])}}">
                                        <div class="img-room-customer text-center">
                                            <img class="image-admin-product-edit img-borde" src="{{asset('uploads/rooms/'.$val['image'])}}" width="100px"  alt="">
                                        </div>
                                        <div class="mt-1 p-1 room-infor-customer">
                                            <div class="d-flex pt-2">
                                                <label class="room-info-label">Mã phòng:</label>
                                                <span class="ps-2">{{$val['ma_phong']}}</span>
                                            </div>
                                            
                                            <div class="d-flex pt-2">
                                                <label class="room-info-label"><?php if($val['type'] == 1) {echo 'Phòng đơn';} else {echo 'Phòng đôi';} ?>:</label>
                                                <span class="ps-2">{{$val['amount']}} người</span>
                                            </div>

                                            <div class="d-flex pt-2">
                                                <label class="room-info-label">Giá phòng</label>
                                                <span class="ps-2 price-room-order">{{number_format($val['price'])}} VNĐ / đêm</span>
                                            </div>

                                            <div class="pt-2">
                                                <label class="room-info-label">Mô tả:</label>
                                                <span class="ps-2">{{$val['describe']}}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
@endsection