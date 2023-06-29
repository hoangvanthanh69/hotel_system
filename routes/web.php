<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\index_backend;
use App\Http\Controllers\index_frontend;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// tong quan admin
Route::get('/admin', [index_backend::class, 'admin'] )->name('admin');

// dang nhap admin
Route::get('/login', [index_backend::class, 'login_admin'] )->name('login');
Route::post('/getlogin', [index_backend::class, 'getlogin'] )->name('getlogin');

// dang xuat admin
Route::get('/logout', [index_backend::class, 'logout'])->name('logout');

// quan ly phong
Route::get('/quan-ly-phong', [index_backend::class, 'quan_ly_phong'])->name('quan-ly-phong');

// quan ly hd
Route::get('/quan-ly-hd', [index_backend::class, 'quan_ly_hd'])->name('quan-ly-hd');

// quan ly trang thai phong
Route::get('/quan-ly-trang-thai-phong', [index_backend::class, 'quan_ly_trang_thai_phong'])->name('quan-ly-trang-thai-phong');

// quan ly tai khoan admin
Route::get('/quan-ly-tai-khoan', [index_backend::class, 'quan_ly_tai_khoan'])->name('quan-ly-tai-khoan');

// quan ly nhan vien
Route::get('/quan-ly-nhan-vien', [index_backend::class,'quan_ly_nhan_vien'])->name('quan-ly-nhan-vien');

// dang nhap khach hang
Route::get('login-customer',[index_frontend::class,'login_customer'])->name('login-customer');
Route::post('/dangnhap', [index_frontend::class, 'dangnhap'] )->name('dangnhap');

// dang xuat
Route::get('logoutuser', [index_frontend::class,'logoutuser'])->name('logoutuser');

// dang ky tai khoan khach hang
Route::get('register',[index_frontend::class, 'register'])->name('register');
Route::post('register-customer',[index_frontend::class, 'register_customer'])->name('register-customer');

// tran chu
Route::get('home', [index_frontend::class, 'home'])->name('home');

// chi tiet phong 
Route::get('/room-details/{id}', [index_frontend::class, 'room_details'])->name('room-details');
Route::get('/chitiet/{id}', [index_frontend::class, 'chitiet'] )->name('chitiet');

// cac phong
Route::get('/rooms-customer', [index_frontend::class, 'rooms_customer'])->name('rooms-customer');

// them phong
Route::get('/add-rooms', [index_backend::class, 'add_rooms'])->name('add-rooms');
Route::post('/add-room', [index_backend::class, 'add_room'])->name('add-room');

// sua san pham
Route::get('/edit-rooms/{id}', [index_backend::class, 'edit_rooms'])->name('edit-rooms');
Route::post('/update-rooms/{id}', [index_backend::class, 'update_rooms'] )->name('update-rooms');
Route::get('/delete-rooms/{id}/tbl_rooms', [index_backend::class, 'delete_rooms'] )->name('delete-rooms');

// tìm kiếm phong
Route::get('searchrooms', [index_backend::class, 'searchrooms'])->name('admin.searchrooms');

// dat phong
Route::post('/order-rooms', [index_backend::class, 'order_rooms'] )->name('order-rooms');
Route::post('/order-room', [index_frontend::class, 'order_room'] )->name('order-room');


// xóa đơn hàng
Route::get('/delete-order/{id}/order_rooms', [index_backend::class, 'delete_order'] )->name('delete-order');

// cập nhật trạng thái đơn hàng
Route::post('/update-status/{id}', [index_backend::class, 'update_status'])->name('update-status');

// tìm kiếm hóa đơn
Route::get('searchOrder', [index_backend::class, 'searchOrder'])->name('admin.searchOrder');

// lịch sử đơn hàng
Route::get('/order-history', [index_frontend::class, 'order_history'])->name('order-history');

Route::get('/introduce', [index_frontend::class,'introduce'])->name('introduce');

// thêm mới nhân viên
Route::get('add-staff', [index_backend::class, 'add_staff'])->name('add-staff');
Route::post('add-staffs', [index_backend::class, 'add_staffs'])->name('add-staffs');

// edit nhan vien 
Route::get('/edit-staff/{id}', [index_backend::class, 'edit_staff'])->name('edit-staff');
Route::post('/update-staff/{id}', [index_backend::class, 'update_staff'] )->name('update-staff');

// xóa nhân viên
Route::get('/delete-staff/{id}', [index_backend::class, 'delete_staff'] )->name('delete-staff');

// thêm khách hàng mới
Route::get('/add-customer', [index_backend::class, 'add_customer'])->name('add-customer');

// edit khách thuê phòng
Route::get('/edit-customer/{id}', [index_backend::class, 'edit_customer'])->name('edit-customer');
Route::post('/update-customer/{id}', [index_backend::class, 'update_customer'] )->name('update-customer');

//quản lý dịch vụ 
Route::get('/quan-ly-dich-vu', [index_backend::class,'quan_ly_dich_vu'])->name('quan-ly-dich-vu');
Route::get('/add-service', [index_backend::class,'add_service'])->name('add-service');
Route::post('add-services', [index_backend::class, 'add_services'])->name('add-services');

// chỉnh sửa dịch vụ
Route::get('/edit-service/{id}', [index_backend::class, 'edit_service'])->name('edit-service');
Route::post('/update-service/{id}', [index_backend::class, 'update_service'] )->name('update-service');

// xóa dịch vụ 
Route::get('/delete-service/{id}', [index_backend::class, 'delete_service'] )->name('delete-service');

// quản lý công nợ
Route::get('/quan-ly-cong-no', [index_backend::class,'quan_ly_cong_no'])->name('quan-ly-cong-no');

// thêm công nợ
Route::get('/add-debt', [index_backend::class, 'add_debt'])->name('add-debt');
Route::post('/add-debts', [index_backend::class, 'add_debts'])->name('add-debts');

// chỉnh sửa công nợ
Route::get('/edit-debt/{id}', [index_backend::class, 'edit_debt'])->name('edit-debt');
Route::post('/update-debt/{id}', [index_backend::class, 'update_debt'] )->name('update-debt');

// hủy đơn đặt
Route::get('/cancel_order/{id}', [index_frontend::class, 'cancelOrder'])->name('cancel_order');

// cập nhật trạng thái nợ
Route::post('/status_debt/{id}', [index_backend::class, 'status_debt'])->name('status_debt');

// quản lý thu chi
Route::get('/quan-ly-thu-chi', [index_backend::class, 'quan_ly_thu_chi'])->name('quan-ly-thu-chi');

// them thu chi
Route::get('/add-expenditure', [index_backend::class,'add_expenditure'])->name('add-expenditure');
Route::post('/add-expenditures', [index_backend::class,'add_expenditures'])->name('add-expenditures');

// chinh sua thu chi
Route::get('/edit-expenditure/{id}', [index_backend::class, 'edit_expenditure'])->name('edit-expenditure');
Route::post('update-expenditure/{id}', [index_backend::class,'update_expenditure'])->name('update-expenditure');

// xoa thu chi
Route::get('/delete-expenditure/{id}', [index_backend::class, 'delete_expenditure'] )->name('delete-expenditure');

// chi tiet doanh thu
Route::get('/chitiet_doanhthu', [index_backend::class, 'chitiet_doanhthu'])->name('chitiet_doanhthu');