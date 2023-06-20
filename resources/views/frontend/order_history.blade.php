@extends('layouts.customer_layouts')
@section('sidebar-active-history', 'actives' )
@section('content')
<div class="history-list m-4">
    <div class="row main-row container-fluid ">
        <div class="mb-3 product-list element_column" data-item="receipt">
            <div class="card-header-chitiet">
                <h4 class="product-list-name">Lịch sử đơn hàng</h4>
            </div>
            <div class="card-body history-orders-list">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr class="tr-name-table">
                            <th>Mã phòng</th>
                            <th>Số đêm</th>
                            <th>Tổng giá</th>
                            <th>Ngày đặt</th>
                            <th>Ngày nhận phòng</th>
                            <th>Ngày trả phòng</th>
                            <th>Trạng thái phòng</th>
                        </tr>
                    </thead>
                    @foreach($order_rooms as $key => $val)
                        <tbody class="text-center">
                            <tr>
                                <td>{{$val['ma_phong']}}</td>
                                <td>{{$val['stayNights']}}</td>
                                <td>{{number_format($val['totalPrice'])}} VNĐ</td>
                                <td>{{$val['created_at']}}</td>
                                <td>{{$val['check_in']}}</td>
                                <td>{{$val['check_out']}}</td>
                                <td>
                                    {{$val['status']}}
                                    <a href="{{route('cancel_order',['id' => $val['id']])}}}">
                                        <i class="fa-solid fa-xmark fs-5 text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="{{asset('frontend/js/frontend.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>