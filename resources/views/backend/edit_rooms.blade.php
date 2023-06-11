@extends('layouts.admin_layouts')
@section('sidebar-active-room', 'active' )
@section('content')
<div class="">
    <div class="add-room-each w-50">
        <form id="signupForm" enctype="multipart/form-data" method='post' action="{{route('update-rooms', $tbl_rooms->id)}}">
            @csrf
            <div class="row">
              <label class="name-add-room-all col-3" for="">Mã phòng:</label>
              <input class="input-add-room col-9" type="text" name="ma_phong" value="{{$tbl_rooms -> ma_phong}}">
            </div>

            <br>
            <div class="room-type row">
              <label class="name-add-room-all col-3" for="type" class="form-label">Loại phòng:</label>
              <div class='col-9 p-0'>
                <select id="type" name="type" class="form-select " aria-label="Default select example">
                  <option value="0">Chọn loại Phòng</option>
                  <option value="1" name="cn" <?php echo  $tbl_rooms['type']==1?'selected':'' ?>>Phòng đơn</option>
                  <option value="2" name="dd" <?php echo  $tbl_rooms['type']==2?'selected':'' ?>>Phòng đôi</option>
                </select>    
              </div>
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Thêm ảnh 1:</label>
              <input  class="input-add-room name-add-room-all-img col-6" type="file" name="image">
              <img class="image-admin-product-edit col-3" src="{{asset('uploads/rooms/'.$tbl_rooms['image']) }}" alt="" style="width: 130px">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Thêm ảnh 2:</label>
              <input  class="input-add-room name-add-room-all-img col-6" type="file" name="image2">
              <img class="image-admin-product-edit col-3" src="{{asset('uploads/rooms/'.$tbl_rooms['image2']) }}" alt="" style="width: 130px">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Thêm ảnh 3:</label>
              <input  class="input-add-room name-add-room-all-img col-6" type="file" name="image3">
              <img class="image-admin-product-edit col-3" src="{{asset('uploads/rooms/'.$tbl_rooms['image3']) }}" alt="" style="width: 130px">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Giá:</label>
              <input class="input-add-room col-9" type="text" name="price" value="{{$tbl_rooms -> price}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">SL người:</label>
              <input class="input-add-room col-9" type="text" name="amount" value="{{$tbl_rooms -> amount}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Mô tả:</label>
              <textarea name="describe" class="input-add-room col-9" type="text" cols="10" rows="5">{{$tbl_rooms->describe}}</textarea>
            </div>

            <div class="back-add-room">
              <a class="back-rooms" href="{{route('quan-ly-phong')}}">Trở lại</a>
              <button class="add-room button-add-room-save" name="update-category-product" type="submit">Cập nhật</button>
            </div>
        </form>
</div>
@endsection