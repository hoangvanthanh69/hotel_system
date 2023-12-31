@extends('layouts.admin_layouts')
@section('sidebar-active-service', 'active' )
@section('content')
<div>
    <div class="card mb-3 product-list" data-item="product">
        <div class="card-header">
            <span class="product-list-name btnbtn">Admin / Dịch vụ</span>
        </div>
        <div class="card-body">
            <div class="table-responsive table-list-product">
                <div class="search-option-infor-amdin">
                    <div class="search-infor-amdin-form-room">
                        <a class="add-room" href="{{route('add-service')}}">Thêm dịch vụ</a>
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
                            <th>Loại dịch vụ</th>
                            <th>Tên dịch vụ</th>
                            <th>Đơn giá</th>
                            <th>Ghi chú </th>
                            <th>Chức Năng</th>
                        </tr>
                    </thead>
                    
                    <tbody class="infor">
                        @foreach($tbl_service as $key => $val)
                            <tr class="text-center">
                                <td>{{$key+1}}</td>
                                <td>{{$val['type_service']}}</td>
                                <td>{{$val['name_service']}}</td>
                                <td>{{number_format($val['price_service'])}} VNĐ</td>
                                <td>{{$val['note_service']}}</td>
                                <td class="function-icon-expenditure">
                                    <form action="{{route('edit-service', $val['id'])}}" class="text-center">
                                        <button class="summit-add-room-button" type='submit'>
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('delete-service', $val['id'])}}">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$val['id']}}">
                                            <i class="fa fa-trash function-icon-delete" aria-hidden="true"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{$val['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger" id="exampleModalLabel">Bạn có chắc muốn xóa dịch vụ này</h5>
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