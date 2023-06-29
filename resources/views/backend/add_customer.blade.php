@extends('layouts.admin_layouts')
@section('sidebar-active-invoice', 'active' )
@section('content')
<div class="">
    <div class="add-room-each w-50">
        <form id="signupForm" enctype="multipart/form-data" method='post' action="{{route('order-rooms')}}">
            @csrf
            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Họ Tên:</label>
              <input class="input-add-room col-9" type="text" name="name">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">SĐT:</label>
              <input class="input-add-room col-9" type="text" name="phone">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">CCCD:</label>
              <input class="input-add-room col-9" type="text" name="cccd">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Địa chỉ:</label>
              <input class="input-add-room col-9" type="text" name="address">
            </div>

            <div class="row mt-4">
                <label class="name-add-room-all col-3">Check in: </label>
                <input class="input-add-room col-9" type="date" id="check_in" name="check_in"/>
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Số đêm:</label>
              <input class="input-add-room col-9" type="text" name="stayNights">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3">Dịch vụ</label>
              <div class="col-9">
                @foreach($tbl_service as $tbl_services)
                  <div class="form-check d-flex mt-2">
                      <input class="form-check-input ps-3" type="checkbox" value="{{ $tbl_services->id }}" name="name_service[{{ $tbl_services->id }}]" id="service{{ $tbl_services->id }}">
                      <label class="form-check-label col-8" for="service{{ $tbl_services->id }}">
                          {{ $tbl_services->name_service }} - Giá {{ number_format($tbl_services->price_service) }} VNĐ
                      </label>
                      <input type="number" class="col-5" name="service_quantities[{{ $tbl_services->id }}]" value="{{ $serviceQuantities[$tbl_services->id] ?? '' }}">
                  </div>
                @endforeach
                <a class="fs-5 text-decoration-none" href="{{route('add-service')}}">Thêm dịch vụ</a>
              </div>
            </div>

            <div class="row mt-4">
                <label class="name-add-room-all col-3" for="">MS phòng:</label>
                <div class='col-9 p-0'>
                    <select name="ma_phong" class="form-select" onchange="updateTotalPrice()">
                        <option value="">Chọn Phòng</option>
                        @foreach($tbl_rooms as $tbl_room)
                            <option value="{{$tbl_room->ma_phong}}" data-price="{{ $tbl_room->price }}">{{ $tbl_room->ma_phong }} - Giá {{ number_format($tbl_room->price) }} VNĐ</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="id" value="">
                </div>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="debt_status" id="debt" value="1">
              <label class="form-check-label" for="debt">Nợ</label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="radio" name="debt_status" id="paid" value="2" checked>
              <label class="form-check-label" for="paid">Đã thanh toán</label>
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Tổng giá:</label>
              <span class="input-add-room col-9 text-warning fw-bolder" id="totalPrice"></span>
            </div>

            <div class="back-add-room">
              <a class="back-rooms" href="{{route('quan-ly-hd')}}">Hủy</a>
              <button class="add-room button-add-room-save" type="submit">Lưu</button>
            </div>
        </form>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('frontend/js/jquery.validate.js')}}"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$("#signupForm").validate({
				rules: {
					name: "required",
					phone: "required",
					cccd: "required",
                    address: "required",
                    stayNights: "required",
				},
				messages: {
					name: "Nhập Tên",
					phone: "Nhập Số điện thoại",
					cccd: "Nhập CCCD",
					address: "Nhập địa chỉ",
					stayNights: "Số đêm",

				},
				errorElement: "div",
				errorPlacement: function (error, element) {
					error.addClass("invalid-feedback-room");
					if (element.prop("type") === "checkbox"){
						error.insertAfter(element.siblings("label"));
					} else {
						error.insertAfter(element);
					}
				},
				highlight: function (element, errorClass, validClass) {
					$(element).addClass("is-invalid").removeClass("is-valid");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("is-valid").removeClass("is-invalid");
				} 
			});
    });
</script>
<script>
  function updateTotalPrice() {
    var stayNights = parseInt(document.getElementsByName("stayNights")[0].value);
    var selectedRoomOption = document.getElementsByName("ma_phong")[0].options[document.getElementsByName("ma_phong")[0].selectedIndex];
    var roomPrice = parseInt(selectedRoomOption.getAttribute("data-price"));
    var selectedServiceOptions = document.querySelectorAll("input[name='name_service[]']:checked");
    var totalPrice = stayNights * roomPrice;

    selectedServiceOptions.forEach(function(option) {
        var servicePrice = parseInt(option.nextElementSibling.innerText.match(/Giá (\d+)/)[1]);
        var quantity = parseInt(option.nextElementSibling.nextElementSibling.value);
        totalPrice += servicePrice * quantity;
    });

    document.getElementById("totalPrice").innerText = numberWithCommas(totalPrice) + " VNĐ";
}

function numberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Thêm sự kiện change cho các phần tử liên quan
document.getElementsByName("stayNights")[0].addEventListener("change", updateTotalPrice);
document.getElementsByName("ma_phong")[0].addEventListener("change", updateTotalPrice);
var serviceOptions = document.querySelectorAll("input[name='name_service[]']");
serviceOptions.forEach(function(option) {
    option.addEventListener("change", updateTotalPrice);
});

  function numberWithCommas(number) {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
</script>
