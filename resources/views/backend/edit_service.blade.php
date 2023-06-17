@extends('layouts.admin_layouts')
@section('sidebar-active-service', 'active' )
@section('content')
<div class="">
    <div class="add-room-each w-50">
        <form id="signupForm" enctype="multipart/form-data" method='post' action="{{route('update-service', $tbl_service->id)}}">
            @csrf
            <div class="row">
              <label class="name-add-room-all col-3" for="">Tên dịch vụ:</label>
              <input class="input-add-room col-9" type="text" name="name_service" value="{{$tbl_service->name_service}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Loại dịch vụ:</label>
              <input class="input-add-room col-9" type="text" name="type_service" value="{{$tbl_service->type_service}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Đơn giá:</label>
              <input class="input-add-room col-9" type="text" name="price_service" value="{{$tbl_service->price_service}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Ghi chú:</label>
              <input class="input-add-room col-9" type="text" name="note_service" value="{{$tbl_service->note_service}}">
            </div>
            <div class="back-add-room">
              <a class="back-rooms" href="{{route('quan-ly-dich-vu')}}">Hủy</a>
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
					name_service: "required",
					type_service: "required",
					price_service: "required",
                    note_service: "required",
				},
				messages: {
					name_service: "Nhập tên dịch vụ",
					type_service: "Nhập loại dịch vụ",
					price_service: "Nhập giá dịch vụ",
					note_service: "Ghi chú",
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