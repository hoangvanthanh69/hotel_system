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
                            <th>Thanh toán</th>
                            <th>Chức Năng</th>
                        </tr>
                    </thead>
                    
                    <tbody class="infor">
                        @foreach($order_rooms as $val)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$val['name']}}</td>
                                <td>{{$val['phone']}}</td>
                                <td>{{$val['ma_phong']}}</td>
                                <td>{{$val['stayNights']}}</td>
                                <td>
                                    <div>
                                        <table class=" table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Tên</th>
                                                    <th>Sl</th>
                                                </tr>
                                            </thead>
                                            @if ($val->selected_services) 
                                                @foreach ($val->selected_services as $service)
                                                <tbody>
                                                    <tr>
                                                        @php
                                                            $serviceName = $service['name_service'];
                                                            $quantity = $service['service_quantity'];
                                                        @endphp
                                                        <td>{{ $serviceName}} </td>
                                                        <td> {{ $quantity }}</td>

                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>
                                </td>
                                <td>{{number_format($val['totalPrice'])}} VNĐ</td>
                                <td>{{$val['created_at']}}</td>
                                <td>{{$val['check_in']}}</td>
                                <td>{{$val['check_out']}}</td>
                                <td>
                                <?php 
                                    if ($val['status'] == 1) {
                                                echo '<span style="color: orange;">chở tiếp nhận</span>';
                                    }
                                    else if ($val['status'] == 2) {
                                                echo '<span style="color: #52de20;">đã nhận phòng</span>';
                                    }
                                    else if ($val['status'] == 3) {
                                        echo '<span style="color: #198754;">đã trả phòng</span>';
                                    }
                                    else if ($val['status'] == 4) {
                                        echo '<span style="color: red;">Đã hủy</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        if ($val['debt_status'] == 1) {echo '<span>Nợ</span>';}
                                        else if ($val['debt_status'] == 2) {echo '<span>đã thanh toán</span>';}
                                    ?>
                                </td>
                                <td class="ps-4">
                                    <form action="{{route('edit-customer', $val['id'])}}" class="text-center">
                                        <button class="summit-add-room-button" type='submit'>
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('delete-order', $val['id'])}}">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$val['id']}}">
                                            <i class="fa fa-trash function-icon-delete" aria-hidden="true"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$val['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger" id="exampleModalLabel">Bạn có chắc muốn xóa đơn hàng này</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Quay lại</button>
                                                        <button class="summit-add-room-button btn btn-primary" type='submit'>Xóa</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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