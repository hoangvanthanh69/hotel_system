@extends('layouts.admin_layouts')
@section('sidebar-active-invoice', 'active' )
@section('content')
<div class="">
    <div class="add-room-each w-50">
        <form id="signupForm" enctype="multipart/form-data" method='post' action="{{route('update-customer',$order_rooms->id)}}">
            @csrf
            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Họ Tên:</label>
              <input class="input-add-room col-9" type="text" name="name" value="{{$order_rooms -> name}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">SĐT:</label>
              <input class="input-add-room col-9" type="text" name="phone" value="{{$order_rooms -> phone}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">CCCD:</label>
              <input class="input-add-room col-9" type="text" name="cccd" value="{{$order_rooms -> cccd}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Địa chỉ:</label>
              <input class="input-add-room col-9" type="text" name="address" value="{{$order_rooms -> address}}">
            </div>

            <div class="row mt-4">
                <label class="name-add-room-all col-3">Check in: </label>
                <input class="input-add-room col-9" type="date" id="check_in" name="check_in" value="{{$order_rooms -> check_in}}"/>
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Số đêm:</label>
              <input class="input-add-room col-9" type="number" name="stayNights" value="{{$order_rooms -> stayNights}}">
            </div>

            <div class="row mt-4">
                <label class="name-add-room-all col-3" for="">MS phòng:</label>
                <div class="col-9 p-0">
                    <select name="ma_phong" class="form-select" onchange="updateTotalPrice()">
                        <option value="">Chọn Phòng</option>
                        @foreach($tbl_rooms as $tbl_room)
                            <option value="{{ $tbl_room->ma_phong }}" data-price="{{ $tbl_room->price }}" {{ $tbl_room->ma_phong == $order_rooms->ma_phong ? 'selected' : '' }}>
                                {{ $tbl_room->ma_phong }} - Giá {{ number_format($tbl_room->price) }} VNĐ
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="id" value="{{ $order_rooms->id }}">
                </div>
            </div>
            <div class="row mt-4">
                <label class="name-add-room-all col-3" for="">Dịch vụ:</label>
                <div class='col-9 p-0'>
                    <select name="name_service" class="form-select" onchange="updateTotalPrice()">
                        <option value="">Chọn dịch vụ</option>
                        @foreach($tbl_service as $tbl_services)
                        <option value="{{ $tbl_services->name_service }}" data-price="{{ $tbl_services->price_service }}" {{ $tbl_services->name_service == $order_rooms->name_service ? 'selected' : '' }}>
                                {{ $tbl_services->name_service }} - Giá {{ number_format($tbl_services->price_service) }} VNĐ
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="id" value="">
                </div>
            </div>

            <div class="row mt-4" id="oldPriceRow">
                <label class="name-add-room-all col-3" for="">Tổng giá:</label>
                <div class="col-9 input-add-room">
                    <span class="input-add-room text-warning fw-bolder">{{ number_format($order_rooms->totalPrice) }} VNĐ</span>
                </div>
            </div>

            <div class="row mt-4" id="newPriceRow" style="display: none;">
                <div class="d-flex">
                    <label class="name-add-room-all col-3" for="">Tổng giá:</label>
                    <div class="col-9 input-add-room">
                        <span class="input-add-room text-warning fw-bolder" id="totalPrice">{{ $order_rooms->totalPrice }}</span>
                    </div>
                </div>
            </div>

            <div class="back-add-room">
              <a class="back-rooms" href="{{route('quan-ly-hd')}}">Hủy</a>
              <button class="add-room button-add-room-save" type="submit">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('frontend/js/jquery.validate.js')}}"></script>
<script>
    function updateTotalPrice() {
        var price = parseFloat(document.querySelector('select[name="ma_phong"]').selectedOptions[0].getAttribute('data-price'));
        var stayNights = parseFloat(document.querySelector('input[name="stayNights"]').value);
        var selectedService = document.querySelector('select[name="name_service"]').selectedOptions[0];
        var servicePrice = selectedService ? parseFloat(selectedService.getAttribute('data-price')) : 0;
        var totalPrice = price * stayNights + servicePrice;
        document.getElementById('totalPrice').innerText = totalPrice.toLocaleString('vi-VN') + ' VNĐ';
        document.getElementById('oldPriceRow').style.display = 'none';
        document.getElementById('newPriceRow').style.display = 'block';
    }
</script>