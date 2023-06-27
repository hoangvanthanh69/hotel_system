@extends('layouts.admin_layouts')
@section('sidebar-active-expenditure', 'active' )
@section('content')
<div class="">
    <div class="add-room-each w-50">
        <form id="signupForm" enctype="multipart/form-data" method='post' action="{{route('update-expenditure', $tbl_expenditure->id)}}">
            @csrf
            <div class="row">
              <label class="name-add-room-all col-3" for="">Loại thu chi:</label>
              <input class="input-add-room col-9" type="text" name="type" value="{{$tbl_expenditure->type}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Tên:</label>
              <input class="input-add-room col-9" type="text" name="name" value="{{$tbl_expenditure->name}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Số lượng:</label>
              <input class="input-add-room col-9" type="text" name="quantity" value="{{$tbl_expenditure->quantity}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Giá:</label>
              <input class="input-add-room col-9" type="text" name="price" value="{{$tbl_expenditure->price}}">
            </div>

            <div class="row mt-4">
              <label class="name-add-room-all col-3" for="">Nội dung:</label>
              <input class="input-add-room col-9" type="text" name="content" value="{{$tbl_expenditure->content}}">
            </div>
            <div class="back-add-room">
              <a class="back-rooms" href="{{route('quan-ly-thu-chi')}}">Hủy</a>
              <button class="add-room button-add-room-save" type="submit">Lưu</button>
            </div>
        </form>
</div>
@endsection