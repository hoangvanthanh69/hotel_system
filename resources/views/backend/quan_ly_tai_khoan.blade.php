@extends('layouts.admin_layouts')
@section('sidebar-active-acount', 'active' )
@section('content')
<div>
    <div class="card mb-3 product-list" data-item="product">
        <div class="card-header">
            <span class="product-list-name btnbtn">Admin / Tài khoản</span>
        </div>
        <div class="card-body">
            <div class="table-responsive table-list-product">
                <div class="search-option-infor-amdin">
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
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Chức Vụ</th>
                            <th>Mật khẩu</th>
                            <th>Chức Năng</th>
                        </tr>
                    </thead>
                    
                    <tbody class="infor">
                        @foreach($tbl_admin as $key => $val)
                            <tr class="text-center">
                                <td>{{$key+1}}</td>
                                <td>{{$val['admin_name']}}</td>
                                <td>{{$val['admin_email']}}</td>
                                <td>
                                    <?php if($val['position']==1){echo 'Quản lý';}else{echo 'Nhân viên';}?>
                                </td> 
                                <td class="">{{$val['admin_password']}}</td>
                                <td class="function-icon">
                                    <form action="">
                                        <button class="summit-add-room-button" type='submit'>
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </form>
                                    
                                    <form action="">
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