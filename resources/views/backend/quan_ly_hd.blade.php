@extends('layouts.admin_layouts')
@section('sidebar-active-invoice', 'active' )
@section('content')
<div>
    <div class="card mb-3 product-list" data-item="product">
        <div class="card-header">
            <span class="product-list-name btnbtn">Admin / Hóa Đơn</span>
        </div>
        <div class="card-body">
            <div class="table-responsive table-list-product">
                <div class="search-option-infor-amdin">
                    <div class="search-infor-amdin-form-room">
                        <a class="add-room" href="{{route('add-customer')}}">Thêm Mới</a>
                    </div>
                    <div class="search-infor-amdin-form-room ">
                        <form action="{{route('admin.searchOrder')}}" method="GET" class="header-with-search-form ">
                            @csrf
                            <input type="text" autocapitalize="off" class="header-with-search-input" placeholder="Tìm kiếm" name="search">
                            <span class="header_search button">
                                <i class=" fas fa-search"></i>
                            </span>
                        </form>
                        @if (session('mesages'))
                            <div class="notification-search">
                            {{ session('mesages') }}
                            </div>
                        @endif
                    </div>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr class="tr-name-table bg-success">
                        <th>STT</th>
                        <th>Khách Hàng</th>
                        <th>SĐT</th>
                        <th>MS Phòng</th>
                        <th>Số đêm</th>
                        <th>Dịch vụ</th>
                        <th>Tổng giá</th>
                        <th>Thời gian đặt</th>
                        <th>Check_in</th>
                        <th>Check_out</th>
                        <th>Trạng thái</th>
                        <th>Chức Năng</th>
                    </tr>
                    </thead>
                    
                    <tbody class="infor">
                        @foreach($order_rooms as $key => $val)
                            <tr class="text-center">
                                <td>{{$key+1}}</td>
                                <td>{{$val['name']}}</td>
                                <td>{{$val['phone']}}</td>
                                <td>{{$val['ma_phong']}}</td>
                                <td>{{$val['stayNights']}}</td>
                                <td>
                                    @if ($val['name_service'] !== null)
                                        {{$val['name_service']}}
                                    @else
                                        null
                                    @endif
                                </td>
                                <td class="">{{number_format($val['totalPrice'])}} VNĐ</td>
                                <td>{{$val['created_at']}}</td>
                                <td>{{$val['check_in']}}</td>
                                <td>{{$val['check_out']}}</td>
                                <td>
                                    @if($val->status == 1)
                                        chở tiếp nhận
                                    @elseif($val->status == 2)
                                        đã nhận phòng
                                    @elseif($val->status == 3)
                                        đã trả phòng
                                    @endif
                                </td>
                                <td class="d-flex ps-4">
                                    <form action="{{route('edit-customer', $val['id'])}}" class="text-center">
                                        <button class="summit-add-room-button" type='submit'>
                                            <i class="fa fa-wrench icon-wrench" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('delete-order', $val['id'])}}">
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