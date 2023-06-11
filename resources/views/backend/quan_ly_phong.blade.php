@extends('layouts.admin_layouts')
@section('sidebar-active-room', 'active' )
@section('content')
<div>
    <div class="card mb-3 product-list" data-item="product">
        <div class="card-header">
            <span class="product-list-name btnbtn">Admin / Phòng</span>
        </div>
        <div class="card-body">
            <div class="table-responsive table-list-product">
                <div class="search-option-infor-amdin">
                    <div class="search-infor-amdin-form-room">
                        <a class="add-room" href="{{route('add-rooms')}}">Thêm phòng</a>
                    </div>
                    <div class="search-infor-amdin-form-room">
                        <form action="{{ route('admin.searchrooms') }}" method="GET" class="header-with-search-form">
                            @csrf
                            <input type="text" autocapitalize="off" class="header-with-search-input" placeholder="Tìm kiếm" name="search">
                            <span class="header_search button">
                                <i class=" fas fa-search"></i>
                            </span>
                        </form>
                    </div>
                </div>
                @if (session('mesages'))
                    <div class="notification-search">
                    {{ session('mesages') }}
                    </div>
                @endif
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="tr-name-table bg-success">
                        <th>Mã phòng</th>
                        <th>Ảnh</th>
                        <th>Loại phòng</th>
                        <th>SL người </th>
                        <th>Giá</th>
                        <th>Mô tả</th>
                        <th>Ngày tạo</th>
                        <th>Chức năng</th>
                    </tr>
                    </thead>
                    
                    <tbody class="infor">
                        @foreach($tbl_rooms as $key => $val)
                            <tr class="hover-color name-product-td">
                                <td class="">{{$val['ma_phong']}}</td>
                                <td class="col-3">
                                    <img class="image-admin-product-edit img-borde" src="{{asset('uploads/rooms/'.$val['image'])}}" width="100px"  alt="">
                                    <img class="image-admin-product-edit img-borde" src="{{asset('uploads/rooms/'.$val['image2'])}}" width="100px"  alt="">
                                    <img class="image-admin-product-edit img-borde" src="{{asset('uploads/rooms/'.$val['image3'])}}" width="100px"  alt="">
                                </td>
                                <td class="col-1">
                                    <?php if($val['type'] == 1) {echo 'Phòng đơn';} else {echo 'Phòng đôi';} ?>
                                </td>
                                <td>{{$val['amount']}}</td>
                                <td>{{number_format($val['price'])}} VNĐ</td>
                                <td class="col-4">{{$val['describe']}}</td>
                                <td>{{$val['created_at']}}</td>
                                <td class="function-icon">
                                    <form action="{{route('edit-rooms', $val['id'])}}">
                                        <button class="summit-add-room-button" type='submit'>
                                            <i class="fa fa-wrench icon-wrench" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    
                                    <form action="{{route('delete-rooms', $val['id'])}}">
                                        <button class="summit-add-room-button" type='submit'>
                                            <i class="fa fa-trash function-icon-delete" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
@endsection