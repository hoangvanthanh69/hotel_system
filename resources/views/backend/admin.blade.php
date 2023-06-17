@extends('layouts.admin_layouts')
@section('sidebar-active-home', 'active' )
@section('content')
<div class="row">
        <!-- phòng -->
        <div class="col-3 min-height-prodcuct">
            <div class="statistical-all img-admin-chart">
                <img class="img-statistical-admin img-statistical-product" src="{{asset('backend/img/png-clipart-line-chart-graph-of-a-function-line-angle-text-thumbnail.png')}}" alt="">
                <div class="row no-gutters infor-statisticala-admin">
                    <div class="col mr-2 p-3 text-light">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-light">
                            Tổng Số Phòng
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <span class="count-all">{{$count_rooms}}</span>
                            Phòng
                        </div>
                    </div>
                    <div class="col-auto card-icon">
                        <i class="fas fa-database fa-2x "></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- đơn đặt-->
        <div class="col-3 min-height-prodcuct">
            <div class="statistical-all img-admin-chart">
                <img class="img-statistical-admin img-statistical-order" src="{{asset('backend/img/images-pie.png')}}" alt="">
                <div class="row no-gutters infor-statisticala-admin">
                    <div class="col mr-2 p-3 text-light">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-light">
                            Tổng đơn hàng
                        </div>
                        <div class="h5 mb-2 font-weight-bold text-gray-800">
                            <span class="count-all">{{$count_order}}</span>
                            Đơn hàng
                        </div>
                    </div>
                    <div class="col-auto card-icon">
                        <i class="fas fa-calendar-check fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- nhân viên -->
        <div class="col-3 min-height-prodcuct">
            <div class="statistical-all img-admin-chart ">
                <img class="img-statistical-admin img-statistical-staff" src="{{asset('backend/img/28-280057_flat-icon-bar-graphics-statistics-chart-graph-graph.png')}}" alt="">
                <div class="row no-gutters infor-statisticala-admin ">
                    <div class="col mr-2 p-3 text-light">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-light">
                            Tổng nhân viên
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <span class="count-all"></span> 
                            Nhân viên
                        </div>

                        <div class="mb-0 text-Warning">
                            <span class="count-product"></span>
                            Quản lý
                        </div>

                        <div class="mb-0 text-Info">
                            <span class="count-product"></span>
                            Biên tập
                        </div>
                    </div>
                    <div class="col-auto card-icon">
                        <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- tổng doanh thu -->
        <div class="col-3 min-height-prodcuct">
            <div class="statistical-all bg-total-product img-admin-chart">
                <img class="img-statistical-admin" src="{{asset('backend/img/Graph-PNG-Transparent-Image.png')}}" alt="">
                <div class="row no-gutters infor-statisticala-admin">
                    <div class="col mr-2 p-3 text-light">
                        <div class="text-xs font-weight-bold text-uppercase mb-1 text-light">
                            Tổng Doanh thu 
                        </div>
                        <div class="h5 mb-2 font-weight-bold text-gray-800">
                            <span class="count-all">{{number_format($totalOrders)}} VNĐ</span>
                        </div>
                    </div>
                    <div class="col-auto card-icon text-success" style="font-size: 38px;">
                        <i class="fa-sharp fa-solid fa-money-check-dollar"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- sản phẩm bán chạy -->
        <div class="col-6">
            <div class="card statistical-all bg-Secondary">
                <div class="row no-gutters ">
                    <div class="col mr-2 text-light center-total-product m-3">
                        <div class="text-xs fw-bolder text-uppercase mb-1 text-dark">
                            Phòng được đặt nhiều nhất
                        </div>
                        <table class="table">
                            <tbody>
                                <thead>
                                    <tr class="text-center">
                                        <th>STT</th>
                                        <th>MS phòng</th>
                                        <th>SL đặt</th>
                                    </tr>
                                </thead>
                                    <tr class="text-center">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- khách hàng thân thiết -->
        <div class="col-6">
            <div class="card statistical-all bg-Secondary">
                <div class="row no-gutters ">
                    <div class="col mr-2 text-light center-total-product m-3">
                        <div class="text-xs fw-bolder text-uppercase mb-1 text-dark">
                            Khách hàng thân thiết
                        </div>
                        <table class="table">
                            <tbody>
                                <thead>
                                    <tr class="text-center">
                                        <th>STT</th>
                                        <th>Họ tên</th>
                                        <th>Số điện thoại</th>
                                        <th>SL đặt</th>
                                    </tr>
                                </thead>
                                @foreach ($lyal_customer as $key => $sp) 
                                    <tr class="text-center">
                                        <td>{{$key+1}}</td>
                                        <td>{{$sp->name}}</td>
                                        <td>{{$sp->phone}}</td>
                                        <td>{{$sp->total_bookings}}</td>
                                    </tr> 
                                @endforeach                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
