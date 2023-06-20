@extends('layouts.customer_layouts')
@section('sidebar-active-rooms', 'actives' )
@section('content')
    <div class="container">
        <div class="row g-2 mt-2">
            @if (session('error'))
                <div class="notification-order">
                  {{ session('error') }}
                </div>
            @endif
            @foreach($tbl_rooms as $key => $val)
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
            @endforeach
            
        </div>
    </div>
@endsection
