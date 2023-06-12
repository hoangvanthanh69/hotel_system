@extends('layouts.admin_layouts')
@section('sidebar-active-staff', 'active' )
@section('content')
<div>
    <div class="card mb-3 product-list" data-item="product">
        <div class="card-header">
            <span class="product-list-name btnbtn">Admin / Nhân viên</span>
        </div>
        <div class="card-body">
            <div class="table-responsive table-list-product">
                <div class="search-option-infor-amdin">
                    <div class="search-infor-amdin-form-room">
                        <a class="add-room" href="{{route('add-staff')}}">Thêm Mới</a>
                    </div>
                    <div class="search-infor-amdin-form-room">
                        <form action="" method="GET" class="header-with-search-form">
                            @csrf
                            <input type="text" autocapitalize="off" class="header-with-search-input" placeholder="Tìm kiếm" name="search">
                            <span class="header_search button">
                                <i class=" fas fa-search"></i>
                            </span>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="tr-name-table bg-success">
                            <th>STT</th>
                            <th>Mã NV</th>
                            <th>Họ Tên</th>
                            <th>SĐT</th>
                            <th>CCCD</th>
                            <th>Địa chỉ</th>
                            <th>Lương/Tháng</th>
                            <th>Chức Năng</th>
                        </tr>
                    </thead>
                    
                    <tbody class="infor">
                    @foreach($tbl_staff as $key => $val)
                        <tr class="text-center">
                            <td>{{$key+1}}</td>
                            <td>{{$val['code_staff']}}</td>
                            <td>{{$val['name']}}</td>
                            <td>{{$val['phone']}}</td>
                            <td>{{$val['cccd']}}</td>
                            <td>{{$val['address']}}</td>
                            <td>{{number_format($val['wage'])}} VNĐ</td>
                            <td class="d-flex ps-4">
                                <form action="{{route('edit-customer', $val['id'])}}" class="text-center">
                                    <button class="summit-add-room-button" type='submit'>
                                        <i class="fa fa-wrench icon-wrench" aria-hidden="true"></i>
                                    </button>
                                </form>
                                
                                <form action="" class="text-center">
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