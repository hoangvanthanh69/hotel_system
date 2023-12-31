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
                        <option value="{{ $tbl_room->ma_phong }}" data-price="{{ $tbl_room->price }}" {{ isset($order_rooms->ma_phong) && $tbl_room->ma_phong == $order_rooms->ma_phong ? 'selected' : '' }}>
                            {{ $tbl_room->ma_phong }} - Giá {{ number_format($tbl_room->price) }} VNĐ
                        </option>
                    @endforeach
                </select>
                    <input type="hidden" name="id" value="{{ $order_rooms->id }}">
                </div>
            </div>

            <div class="row mt-4">
                <label class="name-add-room-all col-3">Dịch vụ</label>
                <div class="col-9">
                @foreach($tbl_service as $index => $tbl_services)
                    <div class="form-check d-flex mt-2">
                        @php
                            $serviceId = $tbl_services->id;
                            $isChecked = in_array($serviceId, array_column($selectedServices, 'id'));
                            $quantity = 0;
                            if ($isChecked) {
                                $index = array_search($serviceId, array_column($selectedServices, 'id'));
                                if (isset($selectedServices[$index]['service_quantity'])) {
                                    $quantity = $selectedServices[$index]['service_quantity'];
                                }
                            }
                            $servicePrice = $tbl_services->price_service;
                            $serviceTotalPrice = $servicePrice * $quantity;
                        @endphp
                        <input class="form-check-input ps-3" type="checkbox" value="{{ $tbl_services->id }}" name="name_service[]" id="service{{ $tbl_services->id }}" @if($isChecked) checked @endif>
                        <label class="form-check-label col-8" for="service{{ $tbl_services->id }}">
                            {{ $tbl_services->name_service }} - Giá {{ number_format($servicePrice) }} VNĐ
                        </label>
                        <input type="number" class="col-5" name="service_quantities[{{ $index }}]" min="0" value="{{ $quantity }}" onchange="updateTotalPrice()">

                        <input type="hidden" class="service-total-price" data-price="{{ $servicePrice }}" value="{{ $serviceTotalPrice }}">
                    </div>
                    @endforeach
                    <a class="fs-5 text-decoration-none" href="{{ route('add-service') }}">Thêm dịch vụ</a>
                </div>
            </div>

            <div class="row mt-4">
                <label class="name-add-room-all col-3" for="">Tổng giá:</label>
                <input class="input-add-room col-9" type="text" id="totalPrice" name="totalPrice" value="{{ number_format($order_rooms->totalPrice) }} VNĐ" readonly>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="debt_status" id="debt" value="1" {{ $order_rooms->debt_status == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="debt">Nợ</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="debt_status" id="paid" value="2" {{ $order_rooms->debt_status == 2 ? 'checked' : '' }}>
                <label class="form-check-label" for="paid">Đã thanh toán</label>
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
        var stayNights = parseInt(document.getElementsByName("stayNights")[0].value);
        var roomSelect = document.getElementsByName("ma_phong")[0];
        var roomPrice = parseFloat(roomSelect.options[roomSelect.selectedIndex].getAttribute("data-price"));
        var totalPrice = stayNights * roomPrice;
        var serviceQuantities = document.querySelectorAll("input[name^='service_quantities[']");
        var serviceTotalPrices = document.getElementsByClassName("service-total-price");
        for (var i = 0; i < serviceQuantities.length; i++) {
            var quantity = parseInt(serviceQuantities[i].value);
            var servicePrice = parseFloat(serviceTotalPrices[i].getAttribute("data-price"));
            var serviceTotalPrice = quantity * servicePrice;
            serviceTotalPrices[i].value = numberWithCommas(serviceTotalPrice) + " VNĐ";
            totalPrice += serviceTotalPrice;
        }
        console.log("Quantity:", quantity);
        document.getElementById("totalPrice").value = numberWithCommas(totalPrice) + " VNĐ";
    }

    function numberWithCommas(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>