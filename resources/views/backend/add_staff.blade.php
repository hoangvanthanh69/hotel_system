@extends('layouts.admin_layouts')
@section('sidebar-active-staff', 'active' )
@section('content')
<div class="">
    <div class="add-room-each w-50">
        <form id="signupForm" enctype="multipart/form-data" method='post' action="{{route('add-staffs')}}">
            @csrf
            <div class="row">
              <label class="name-add-room-all col-2" for="">Mã NV:</label>
              <input class="input-add-room col-9" type="text" name="code_staff">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-2" for="">Họ Tên:</label>
              <input class="input-add-room col-9" type="text" name="name">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-2" for="">SĐT:</label>
              <input class="input-add-room col-9" type="text" name="phone">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-2" for="">CCCD:</label>
              <input class="input-add-room col-9" type="text" name="cccd">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-2" for="">Địa chỉ:</label>
              <input class="input-add-room col-9" type="text" name="address">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-2" for="">Lương:</label>
              <input class="input-add-room col-9" type="text" name="wage">
            </div>

            <div class="back-add-room">
              <a class="back-rooms" href="{{route('quan-ly-nhan-vien')}}">Hủy</a>
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
					code_staff: "required",
					name: "required",
					phone: "required",
					cccd: "required",
          address: "required",
          wage: "required",
				},
				messages: {
					code_staff: "Nhập mã Nhân viên",
					name: "Nhập Tên",
					phone: "Nhập Số điện thoại",
					cccd: "Nhập CCCD",
					address: "Nhập địa chỉ",
					wage: "Nhập mức lương",

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