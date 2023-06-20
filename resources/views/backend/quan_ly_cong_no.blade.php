@extends('layouts.admin_layouts')
@section('sidebar-active-debt', 'active' )
@section('content')
<div>
    <div class="card mb-3 product-list" data-item="product">
        <div class="card-header">
            <span class="product-list-name btnbtn">Admin / Công nợ</span>
        </div>
        <div class="card-body">
            <div class="table-responsive table-list-product">
                <div class="search-option-infor-amdin">
                    <div class="search-infor-amdin-form-room">
                        <a class="add-room" href="{{route('add-debt')}}">Thêm công nợ</a>
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
                            <th>Tên khách hàng</th>
                            <th>MS phòng</th>
                            <th>Ngày đặt</th>
                            <th>Ngày trả phòng</th>
                            <th>Tiền còn nợ</th>
                            <th>Chức Năng</th>
                        </tr>
                    </thead>
                    
                    <tbody class="infor">
                        @foreach($tbl_debt as $key => $val)
                            <tr class="text-center">
                                <td>{{$key+1}}</td>
                                <td>{{$val['name']}}</td>
                                <td>{{$val['ms_phong']}}</td>
                                <td>{{$val['check_in']}}</td>
                                <td>{{$val['check_out']}}</td>
                                <td>{{number_format($val['debt'])}} VNĐ</td>
                                <td class="d-flex ps-4">
                                    <form action="{{route('edit-debt', $val['id'])}}" class="text-center">
                                        <button class="summit-add-room-button" type='submit'>
                                            <i class="fa fa-wrench icon-wrench" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    
                                    <form action="{{route('delete-service', $val['id'])}}" class="text-center">
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
