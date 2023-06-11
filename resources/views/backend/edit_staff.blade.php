@extends('layouts.admin_layouts')
@section('sidebar-active-staff', 'active' )
@section('content')
<div class="">
    <div class="add-room-each w-50">
        <form id="signupForm" enctype="multipart/form-data" method='post' action="{{route('update-staff', $tbl_staff->id)}}">
            @csrf
            <div class="row">
              <label class="name-add-room-all col-2" for="">Mã NV:</label>
              <input class="input-add-room col-9" type="text" name="code_staff" value="{{$tbl_staff -> code_staff}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-2" for="">Họ Tên:</label>
              <input class="input-add-room col-9" type="text" name="name" value="{{$tbl_staff -> name}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-2" for="">SĐT:</label>
              <input class="input-add-room col-9" type="text" name="phone" value="{{$tbl_staff -> phone}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-2" for="">CCCD:</label>
              <input class="input-add-room col-9" type="text" name="cccd" value="{{$tbl_staff -> cccd}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-2" for="">Địa chỉ:</label>
              <input class="input-add-room col-9" type="text" name="address" value="{{$tbl_staff -> address}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-2" for="">Lương:</label>
              <input class="input-add-room col-9" type="text" name="wage" value="{{$tbl_staff -> wage}}">
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