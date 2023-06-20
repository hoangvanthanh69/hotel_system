@extends('layouts.admin_layouts')
@section('sidebar-active-debt', 'active' )
@section('content')
<div class="">
    <div class="add-room-each w-50">
        <form id="signupForm" enctype="multipart/form-data" method='post' action="{{route('update-debt', $tbl_debt->id)}}">
            @csrf
            <div class="row">
              <label class="name-add-room-all col-3" for="">Tên khách hàng:</label>
              <input class="input-add-room col-9" type="text" name="name" value="{{$tbl_debt->name}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Mã phòng:</label>
              <input class="input-add-room col-9" type="text" name="ms_phong" value="{{$tbl_debt->ms_phong}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Check in:</label>
              <input class="input-add-room col-9" type="date" name="check_in" value="{{$tbl_debt->check_in}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">check out:</label>
              <input class="input-add-room col-9" type="date" name="check_out" value="{{$tbl_debt->check_out}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Còn nợ:</label>
              <input class="input-add-room col-9" type="text" name="debt" value="{{$tbl_debt->debt}}">
            </div>
            <div class="back-add-room">
              <a class="back-rooms" href="{{route('quan-ly-cong-no')}}">Hủy</a>
              <button class="add-room button-add-room-save" type="submit">Lưu</button>
            </div>
        </form>
</div>
@endsection