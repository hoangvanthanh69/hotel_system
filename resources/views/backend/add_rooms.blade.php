@extends('layouts.admin_layouts')
@section('sidebar-active-room', 'active' )
@section('content')
<div class="">
    <div class="add-room-each w-50">
        <form id="signupForm" enctype="multipart/form-data" method='post' action="{{route('add-room')}}">
            @csrf
            <div class="row">
              <label class="name-add-room-all col-3" for="">Mã phòng:</label>
              <input class="input-add-room col-9" type="text" name="ma_phong">
            </div>

            <br>
            <div class="room-type row">
              <label class="name-add-room-all col-3" for="type" class="form-label">Loại phòng:</label>
              <div class='col-9 p-0'>
                <select id="type" name="type" class="form-select " aria-label="Default select example">
                  <option value="0">Chọn loại Phòng</option>
                  <option value="1" name="cn">Phòng đơn</option>
                  <option value="2" name="dd">Phòng đôi</option>
                </select>    
              </div>
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Thêm ảnh 1:</label>
              <input  class="input-add-room name-add-room-all-img col-9" type="file" name="image">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Thêm ảnh 2:</label>
              <input  class="input-add-room name-add-room-all-img col-9" type="file" name="image2">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Thêm ảnh 3:</label>
              <input  class="input-add-room name-add-room-all-img col-9" type="file" name="image3">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Giá:</label>
              <input class="input-add-room col-9" type="text" name="price">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">SL người:</label>
              <input class="input-add-room col-9" type="text" name="amount">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Mô tả:</label>
              <textarea name="describe" class="input-add-room col-9" type="text" id="" cols="10" rows="5" ></textarea>
            </div>

            <div class="back-add-room">
              <a class="back-rooms" href="{{route('quan-ly-phong')}}">Trở lại</a>
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
					ma_phong: "required",
					cn: "required",
					dd: "required",
					image: "required",
          price: "required",
          describe: "required",
          amount: "required",         
				},
				messages: {
					ma_phong: "Nhập mã phòng",
					cn: "Chọn loại",
					dd: "Chọn loại",
					image: "Thêm ảnh",
					price: "Nhập Giá",
					describe: "Nhập mô tả",
					amount: "Nhập sl giường",

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