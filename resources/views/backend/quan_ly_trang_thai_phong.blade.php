@extends('layouts.admin_layouts')
@section('sidebar-active-status-room', 'active' )
@section('content')
<div>
    <div class="card mb-3 product-list" data-item="product">
        <div class="card-header">
            <span class="product-list-name btnbtn">Admin / Trạng Thái Phòng</span>
        </div>
        <div class="card-body">
            <div class="table-responsive table-list-product">
                <div class="row container">
                    @foreach($tbl_rooms as $key => $val)
                        <div class="col-3 pb-2">
                            <div class="card card-info-room-order">
                                <div class="mr-2 background-code-room">
                                    <div class="fs-2 font-weight-bold mb-2 text-warning text-center border-bottom">
                                        {{$val['ma_phong']}}
                                    </div>
                                    @foreach($order_rooms as $order)
                                        @if($order->ma_phong == $val['ma_phong'] && ($order->status == 1 || $order->status == 2))
                                            <div class="order-room-info ps-3 border-bottom">
                                                <p>Tên khách hàng: <strong> {{$order->name}}</strong></p>
                                                <p>Số điện thoại: <strong>{{$order->phone}}</strong></p>
                                                <p>Ngày nhận phòng: <strong class="text-light">{{$order->check_in}}</strong></p>
                                                <p>Ngày trả phòng: <strong  class="text-info">{{$order->check_out}}</strong></p>
                                                @if($order->status == 1)
                                                    <form class="" action="{{route('update-status', $order->id)}}" method="POST">
                                                        @csrf
                                                        <button class="status-check-in-room" type="submit">Đã nhận phòng</button>
                                                    </form>
                                                @elseif($order->status == 2)
                                                    <p>Trạng thái: Đã nhận phòng</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection