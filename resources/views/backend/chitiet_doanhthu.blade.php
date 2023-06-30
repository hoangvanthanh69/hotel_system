@extends('layouts.admin_layouts')
@section('sidebar-active-home', 'active' )
@section('content')
    <div class="container-fluid">
    <div class="row">
        <h5 class="order-detail-overview">Thống kê chi tiết doanh thu</h5>
        <!-- tổng doanh thu  -->
        <div class="col-6">
            <div class="card statistical-all bg-secondary">
                <div class="row no-gutters ">
                    <div class="col mr-2 p-3 text-light center-total-product">
                        <div class="text-xs font-weight-bold text-uppercase mb-2 text-warning">
                            Tổng doanh thu ngày hôm nay
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <span class="count-all">{{$dates}}: {{number_format ($total_price_today)}} đ</span>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card statistical-all bg-success">
                <div class="row no-gutters ">
                    <div class="col mr-2 p-3 text-light center-total-product">
                        <div class="text-xs font-weight-bold text-uppercase mb-2 text-warning">
                            Tổng doanh thu từng ngày
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <form action="{{ route('chitiet_doanhthu') }}" method="GET">
                                <label for="date">Chọn ngày:</label>
                                <input class="input-total-revenue" type="date" id="date" name="date" value="{{ $date }}" />
                                <button class="button-total-revenue" type="submit">Tìm</button>
                            </form>
                            <span class="count-all">{{$date}}: {{number_format($tong_gia_ngay)}} đ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card statistical-all bg-primary">
                <div class="row no-gutters ">
                    <div class="col mr-2 p-3 text-light center-total-product">
                        <div class="text-xs font-weight-bold text-uppercase mb-2 text-warning">
                            Tổng doanh thu theo năm
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <form action="{{ route('chitiet_doanhthu') }}" method="GET">
                                <label for="date">Chọn năm:</label>
                                <input class="input-total-revenue" type="year" id="year" name="year" value="{{ $year }}" />
                                <button class="button-total-revenue" type="submit">Tìm</button>
                            </form>
                            <span class="count-all">{{$year}}: {{number_format ($total_price_year)}} đ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card statistical-all bg-warning">
                <div class="row no-gutters ">
                    <div class="col mr-2 p-3 text-light center-total-product">
                        <div class="text-xs font-weight-bold text-uppercase mb-2 text-secondary">
                            Tổng doanh thu theo tháng
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <form action="{{ route('chitiet_doanhthu') }}" method="GET">
                                <label for="month">Chọn tháng:</label>
                                <input class="input-total-revenue" type="month" id="month" name="month" value="{{$month}}" />
                                <button class="button-total-revenue" type="submit">Tìm</button>
                            </form>
                            <span class="count-all">{{ $month }}: {{ number_format($total_price_month) }} đ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-6 ">
            <div class="card statistical-all bg-dark">
                <div class="row no-gutters ">
                    <div class="col mr-2 p-3 text-light center-total-product">
                        <div class="text-xs font-weight-bold text-uppercase mb-2 text-warning">
                            Tổng doanh thu theo khoảng
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <form method="GET" action="{{ route('chitiet_doanhthu') }}">
                                @csrf
                                <div class="mb-3 d-flex text-center">
                                    <label for="start_date" class="col-4">Ngày bắt đầu:</label>
                                    <input class="input-total-revenue" type="date" id="start_date" name="start_date" required />
                                </div>
                                <div class="mb-3 d-flex text-center">
                                    <label for="end_date" class="col-4">Ngày kết thúc:</label>
                                    <input class="input-total-revenue" type="date" id="end_date" name="end_date" required />
                                    <button class="button-total-revenue ms-2" type="submit">Tính</button>
                                </div>
                            </form>
                            <span class="count-all">{{$start_date}} đến {{$end_date}} là: {{number_format($total_revenue)}} đ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        
    </div>
@endsection
