<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\tbl_admin;
use App\Models\tbl_rooms;
use App\Models\order_rooms;
use App\Models\tbl_staff;
use App\Models\tbl_service;
use App\Models\tbl_debt;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;
use DB;

class index_backend extends Controller{
    // tong quan admin
    function admin(){
        if (!Session::get('admin')) {
            return redirect()->route('login');
        }
        $order_rooms = order_rooms::get()->toArray(); 
        $count_rooms = tbl_rooms::count();
        $count_order = order_rooms::count();
        $totalOrders = order_rooms::whereIn('status', [2, 3])->sum('totalPrice');
        $lyal_customer = order_rooms::select('phone', 'name', DB::raw('COUNT(*) as total_bookings'))
            ->groupBy('phone', 'name')
            ->havingRaw('COUNT(*) >= 2')
            ->orderByDesc('total_bookings')
            ->get();
        ;
        // print_r($bestseller); die;
        return view('backend.admin',['order_rooms' => $order_rooms], compact('count_rooms', 'count_order', 'totalOrders', 'lyal_customer'));
    }

    // dang nhap admin
    function login_admin(){
        if(!Session::get('admin')){
            return view('backend.login');
        }
        else{
            return redirect()->route('admin');
        }
        return view('backend.login');
    }

    function getlogin(Request $request){
        $data = $request->all();
        $password = $data['admin_password'];
        $result = tbl_admin::where(['admin_email' => $data['admin_email'], 'admin_password' => $data['admin_password']])->first();
        if($result){
            Session::put('admin_name', $result->admin_name); 
            Session::put('admin', [
              'username'  => $result->admin_email,
              'password'  => $result->admin_password,
              'admin_name' => $result->admin_name,
            ]);
            if(Session::get('admin') != NULL){
                return redirect()->route('admin');
            } else {
                return redirect()->back();
            }
        } else {
           return redirect()->back();
        }
    }

    // dang xuat
    function logout(){
        Session::forget('admin') ;
        return redirect()->back();
    }

    // quan ly phong
    function quan_ly_phong(){
        if (!Session::get('admin')) {
            return redirect()->route('login');
        }
        $tbl_rooms = tbl_rooms::get()->toArray();
        return view('backend.quan_ly_phong', ['tbl_rooms' => $tbl_rooms]);
    }

    // quan ly hd
    function quan_ly_hd(){
        if (!Session::get('admin')) {
            return redirect()->route('login');
        }
        $order_rooms = order_rooms::get();
        $currentDate = now();
        foreach ($order_rooms as $order) {
            $checkInDate = date_create($order->check_in);
            $stayNights = $order->stayNights;
            $checkOutDate = date_add($checkInDate, date_interval_create_from_date_string($stayNights . ' days'));
            $order->check_out = $checkOutDate->format('Y-m-d');
            if ($currentDate >= $checkOutDate) {
                $order->status = 3;
                $order->save();
            }
            $selectedServices = json_decode($order->selected_services, true);
            $services = [];
            foreach ($selectedServices as $service) {
                $serviceId = $service['id']; 
                $quantity = $service['service_quantities'];
                $serviceModel = tbl_service::find($serviceId);
                if ($serviceModel) {
                    $serviceName = $serviceModel->name_service;
                    $services[] = [
                        'name_service' => $serviceName,
                        'service_quantities' => $quantity,
                    ];
                }
            }
            $order->selected_services = $services;
        }
        return view('backend.quan_ly_hd', compact('order_rooms'));
    }

    
    // quan ly trang thai phong
    function quan_ly_trang_thai_phong(){
        if (!Session::get('admin')) {
            return redirect()->route('login');
        }
        $tbl_rooms = tbl_rooms::get()->toArray();
        $order_rooms = order_rooms::whereIn('status', [1,2])->get();
        $currentDate = now();
        $upcomingOrderRooms = [];
        foreach ($order_rooms as $order) {
            $checkOutDate = new \DateTime($order->check_out);
            if ($checkOutDate <= $currentDate) {
                continue;
            }
            $checkInDate = new \DateTime($order->check_in);
            $stayNights = $order->stayNights;
            $checkOutDate = $checkInDate->modify("+{$stayNights} days");
            $order->check_out = $checkOutDate->format('Y-m-d');
            $upcomingOrderRooms[] = $order;
        }
        return view('backend.quan_ly_trang_thai_phong', ['order_rooms' => $upcomingOrderRooms, 'tbl_rooms' => $tbl_rooms]);
    }
    

    // quan ly tai khoan admin
    function quan_ly_tai_khoan(){
        if (!Session::get('admin')) {
            return redirect()->route('login');
        }
        $tbl_admin = tbl_admin::get()->toArray();
        return view('backend.quan_ly_tai_khoan', ['tbl_admin' => $tbl_admin]);
    }

    // quan ly nhan vien
    function quan_ly_nhan_vien(){
        if (!Session::get('admin')) {
            return redirect()->route('login');
        }
        $tbl_staff = tbl_staff::get()->toArray();
        return view('backend.quan_ly_nhan_vien', ['tbl_staff' => $tbl_staff]);
    }

    // them phong
    function add_rooms(){
        if(!Session::get('admin')){
            return redirect()->route('login');
        }
        return view('backend.add_rooms');
    }
    function add_room(Request $request) {
        $data = $request->all();
        $tbl_rooms = new tbl_rooms;
        $tbl_rooms->ma_phong = $data['ma_phong'];
        $tbl_rooms->type = $data['type'];
        $tbl_rooms->amount = $data['amount'];
        $tbl_rooms->price = $data['price'];
        $tbl_rooms->describe = $data['describe'];
        $path = 'uploads/rooms/';

        if ($request->hasFile('image')) {
            $get_image = $request->file('image');
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $tbl_rooms->image = $new_image;
        }
    
        if ($request->hasFile('image2')) {
            $get_image2 = $request->file('image2');
            $get_name_image2 = $get_image2->getClientOriginalName();
            $name_image2 = current(explode('.', $get_name_image2));
            $new_image2 = $name_image2 . rand(0, 99) . '.' . $get_image2->getClientOriginalExtension();
            $get_image2->move($path, $new_image2);
            $tbl_rooms->image2 = $new_image2;
        } else {
            $tbl_rooms->image2 = 'null';
        }
    
        if ($request->hasFile('image3')) {
            $get_image3 = $request->file('image3');
            $get_name_image3 = $get_image3->getClientOriginalName();
            $name_image3 = current(explode('.', $get_name_image3));
            $new_image3 = $name_image3 . rand(0, 99) . '.' . $get_image3->getClientOriginalExtension();
            $get_image3->move($path, $new_image3);
            $tbl_rooms->image3 = $new_image3;
        } else {
            $tbl_rooms->image3 = 'null';
        }
    
        $tbl_rooms->save();
        return redirect()->route('quan-ly-phong');
    }
    // sua phong
    function edit_rooms($id){
        $tbl_rooms = tbl_rooms::find($id);
        return view('backend.edit_rooms', ['tbl_rooms' => $tbl_rooms]);
    }
    // cap nhat phong
    function update_rooms(Request $request, $id){
        $tbl_rooms = tbl_rooms::find($id);
        $tbl_rooms -> ma_phong = $request -> ma_phong;
        $tbl_rooms -> type = $request -> type;
        $tbl_rooms -> amount = $request -> amount;
        $tbl_rooms -> price = $request -> price;
        $tbl_rooms -> describe = $request -> describe;
        $images = ['image', 'image2', 'image3'];
        foreach ($images as $image) {
            if ($request->hasFile($image)) {
                $get_image = $request->file($image);
                $path = 'uploads/rooms/';
                $path_unlink = $path . $tbl_rooms->$image;

                if (file_exists($path_unlink) && is_file($path_unlink)) {
                    unlink($path_unlink);
                }

                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $tbl_rooms->$image = $new_image;
            }
        }
        $tbl_rooms -> save();
        return redirect()->route('quan-ly-phong');
    }
    // xoa phong
    function delete_rooms($id){
        $tbl_rooms = tbl_rooms::find($id);
        $tbl_rooms->delete();
        return redirect()->route('quan-ly-phong')->with('success','Xóa sản phẩm thành công');
    }

    // tim kiem phong
    function searchrooms(Request $request){
        if ($request->isMethod('get')) {
            $search = $request->input('search');
            $tbl_rooms = tbl_rooms::where('id', 'LIKE', "%$search%")->orWhere('ma_phong', 'LIKE', "%$search%")->paginate(6);
            if(empty($tbl_rooms->items())){
                return back()->with('mesages', 'Không tìm thấy kết quả');
            } else {
                return view('backend.quan_ly_phong', ['tbl_rooms' => $tbl_rooms, 'search' => $search]);
            }
        } else {
            return redirect()->back();
        }
    }

    // xóa đơn đặt phòng
    function delete_order($id){
        $order_rooms = order_rooms::find($id);
        $order_rooms->delete();
        return redirect()->route('quan-ly-hd')->with('success','Xóa sản phẩm thành công');
    }

    // cập nhật trạng thai đơn hàng
    function update_status($id){
        $order = order_rooms::find($id);
        if ($order) {
            $order->status = 2;
            $order->save();
        }
        return redirect()->back();
    } 
    // tìm kiếm hóa đơn
    function searchOrder(Request $request){
        if ($request->isMethod('get')) {
            $search = $request->input('search');
            $order_rooms = order_rooms::where('id', 'LIKE', "%$search%")->orWhere('name', 'LIKE', "%$search%")->paginate(6);
            if(empty($order_rooms->items())){
                return back()->with('mesages', 'Không tìm thấy kết quả');
            } else {
                return view('backend.quan_ly_hd', ['order_rooms' => $order_rooms, 'search' => $search]);
            }
        } else {
            return redirect()->back();
        }
    }

    // thêm nhân viên
    function add_staff(){
        if(!Session::get('admin')){
            return redirect()->route('login');
        }
        return view('backend.add_staff');
    }

    function add_staffs(Request $request){
        $data = $request->all();
        $tbl_staff = new tbl_staff;
        $tbl_staff->code_staff = $data['code_staff'];
        $tbl_staff->name = $data['name'];
        $tbl_staff->phone = $data['phone'];
        $tbl_staff->cccd = $data['cccd'];
        $tbl_staff->address = $data['address'];
        $tbl_staff->wage = $data['wage'];
        $tbl_staff->save();
        return redirect()->route('quan-ly-nhan-vien');
    }

    // chinh sua nhan vien
    function edit_staff($id){
        $tbl_staff = tbl_staff::find($id);
        return view('backend.edit_staff', ['tbl_staff' => $tbl_staff]);
    }
    function update_staff(Request $request, $id){
        $tbl_staff = tbl_staff::find($id);
        $tbl_staff -> code_staff = $request -> code_staff;
        $tbl_staff -> name = $request -> name;
        $tbl_staff -> phone = $request -> phone;
        $tbl_staff -> cccd = $request -> cccd;
        $tbl_staff -> address = $request -> address;
        $tbl_staff -> wage = $request -> wage;
        $tbl_staff -> save();
        return redirect()->route('quan-ly-nhan-vien');
    }

    // xóa nhân viên
    function delete_staff($id){
        $tbl_staff = tbl_staff::find($id);
        $tbl_staff->delete();
        return redirect()->route('quan-ly-nhan-vien')->with('success','Xóa sản phẩm thành công');
    }

    function add_customer() {
        $tbl_rooms = tbl_rooms::whereNotIn('ma_phong', function ($query) {
            $query->select('ma_phong')->from('order_rooms')->whereIn('status', [2]);
        })->get();
        $tbl_service = tbl_service::get();
        return view('backend.add_customer', ['tbl_rooms' => $tbl_rooms, 'tbl_service' => $tbl_service]);
    }

    // đặt phòng
    function order_rooms(Request $request) {
        $order_room = new order_rooms;
        $order_room->phone = $request->input('phone');
        $order_room->name = $request->input('name');
        $order_room->stayNights = $request->input('stayNights');
        $order_room->ma_phong = $request->input('ma_phong');
        $order_room->check_in = $request->input('check_in');
        $order_room->cccd = $request->input('cccd');
        $order_room->address = $request->input('address');
        $order_room->debt_status = $request->input('debt_status');
        $order_room->status = 1;
        
        $checkInDate = new \DateTime($order_room->check_in);
        $stayNights = $order_room->stayNights;
        $checkOutDate = clone $checkInDate;
        $checkOutDate->modify("+" . $stayNights . " days");
        $order_room->check_out = $checkOutDate->format('Y-m-d');
    
        $tbl_room = tbl_rooms::where('ma_phong', $order_room->ma_phong)->first();
        $order_room->totalPrice = $stayNights * $tbl_room->price;
    
        $selectedServices = $request->input('name_service', []);
        $serviceQuantities = $request->input('service_quantities', []);
        $services = [];
        $totalServicePrice = 0;
        foreach ($selectedServices as $index => $serviceId) {
            $serviceModel = tbl_service::find($serviceId);
            if ($serviceModel) {
                $serviceName = $serviceModel->name_service;
                $servicePrice = $serviceModel->price_service;
                $quantity = $serviceQuantities[$index];
                $serviceTotalPrice = $servicePrice * $quantity; // Tính tổng giá dịch vụ cho mỗi dịch vụ
                $totalServicePrice += $serviceTotalPrice; // Cộng tổng giá dịch vụ vào biến $totalServicePrice
                $services[] = [
                    'id' => $serviceId,
                    'name_service' => $serviceName,
                    'service_quantities' => $quantity,
                    'service_total_price' => $serviceTotalPrice,
                ];
            }
        }
        $order_room->totalPrice += $totalServicePrice;
        $order_room->selected_services = json_encode($services);
        $order_room->save();
    
        return redirect()->route('quan-ly-hd')->with('message', 'Đặt phòng thành công');
    }
    
    

    // edit đơn đặt phòng của khách hàng
    function edit_customer($id){
        $tbl_rooms = tbl_rooms::whereNotIn('ma_phong', function ($query) {
            $query->select('ma_phong')->from('order_rooms')->whereIn('status', [2]);
        })->get();
        $tbl_service = tbl_service::all();
        $order_rooms = order_rooms::find($id);
        $selectedServices = [];

        $selectedServicesData = $order_rooms->selected_services;
        if (!empty($selectedServicesData)) {
            $selectedServices = json_decode($selectedServicesData, true);
        }
        return view('backend.edit_customer', ['order_rooms' => $order_rooms, 'tbl_rooms' => $tbl_rooms, 'tbl_service' => $tbl_service, 'selectedServices' => $selectedServices]);
    }

    function update_customer(Request $request, $id){
        $order_rooms = order_rooms::find($id);
        $order_rooms->name = $request->name;
        $order_rooms->phone = $request->phone;
        $order_rooms->stayNights = $request->stayNights;
        $order_rooms->ma_phong = $request->ma_phong;
        $order_rooms->check_in = $request->check_in;
        $order_rooms->cccd = $request->cccd;
        $order_rooms->address = $request->address;
        $room = tbl_rooms::where('ma_phong', $request->ma_phong)->first();
        $price = $room->price;
        $stayNights = $request->stayNights;
        $order_rooms->debt_status = $request->debt_status;
        $totalPrice = $price * $stayNights;
        $selectedServices = [];
        foreach ($request->input('name_service', []) as $index => $serviceId) {
            $quantity = $request->input('service_quantities.' . $index);
            $service = tbl_service::find($serviceId);
            if ($service) {
                $servicePrice = $service->price_service;
                $serviceTotalPrice = $servicePrice * $quantity;
                $totalPrice += $serviceTotalPrice;
    
                $selectedServices[] = [
                    'id' => $serviceId,
                    'name_service' => $service->name_service,
                    'price_service' => $servicePrice,
                    'service_quantities' => $quantity,
                    'service_total_price' => $serviceTotalPrice,
                ];
            }
        }
        $order_rooms->totalPrice = $totalPrice;
        $order_rooms->selected_services = json_encode($selectedServices);
    
        $order_rooms->save();
        return redirect()->route('quan-ly-hd');
    }

    // quản lý dịch vụ
    function quan_ly_dich_vu(){
        if (!Session::get('admin')) {
            return redirect()->route('login');
        }
        $tbl_service = tbl_service::get()->toArray();
        return view('backend.quan_ly_dich_vu', ['tbl_service'=> $tbl_service]);
    }
    function add_service(){
        if(!Session::get('admin')){
            return redirect()->route('login');
        }
        return view('backend.add_service');
    }
    function add_services(Request $request){
        $data = $request->all();
        $tbl_service = new tbl_service;
        $tbl_service->type_service = $data['type_service'];
        $tbl_service->name_service = $data['name_service'];
        $tbl_service->price_service = $data['price_service'];
        $tbl_service->note_service = $data['note_service'];
        $tbl_service->save();
        return redirect()->route('quan-ly-dich-vu');
    }

    // chỉnh sửa dịch vụ
    function edit_service($id){
        $tbl_service = tbl_service::find($id);
        return view('backend.edit_service', ['tbl_service' => $tbl_service]);
    }
    function update_service(Request $request, $id){
        $tbl_service = tbl_service::find($id);
        $tbl_service->type_service = $request->type_service;
        $tbl_service->name_service = $request->name_service;
        $tbl_service->price_service = $request->price_service;
        $tbl_service->note_service = $request->note_service;
        $tbl_service->save();
        return redirect()->route('quan-ly-dich-vu');
    }

    // xoa dich vuj
    function delete_service($id){
        $tbl_service = tbl_service::find($id);
        $tbl_service->delete();
        return redirect()->route('quan-ly-dich-vu')->with('success','Xóa dịch vụ thành công');
    }

    // quản lý công nợ
    function quan_ly_cong_no(){
        if (!Session::get('admin')) {
            return redirect()->route('login');
        }
        $order_rooms = order_rooms::where('debt_status','1')->get()->toArray();
        return view('backend.quan_ly_cong_no', ['order_rooms' => $order_rooms]);
    }

    // thêm công nợ
    function add_debt(){
        if(!Session::get('admin')){
            return redirect()->route('login');
        }
        return view('backend.add_debt');
    }
    function add_debts(Request $request){
        $data = $request->all();
        $tbl_debt = new tbl_debt;
        $tbl_debt->name = $data['name'];
        $tbl_debt->ms_phong = $data['ms_phong'];
        $tbl_debt->check_in = $data['check_in'];
        $tbl_debt->check_out = $data['check_out'];
        $tbl_debt->debt = $data['debt'];
        $tbl_debt -> save();
        return redirect()->route('quan-ly-cong-no'); 
    }

    // chỉnh sửa công nợ
    function edit_debt($id){
        $tbl_debt = tbl_debt::find($id);
        return view('backend.edit_debt', ['tbl_debt' => $tbl_debt]);
    }
    function update_debt(Request $request, $id){
        $tbl_debt = tbl_debt::find($id);
        $tbl_debt -> name = $request -> name;
        $tbl_debt -> ms_phong = $request -> ms_phong;
        $tbl_debt -> check_in = $request -> check_in;
        $tbl_debt -> check_out = $request -> check_out;
        $tbl_debt -> debt = $request -> debt;
        $tbl_debt -> save();
        return redirect()->route('quan-ly-cong-no');
    }

    // cập nhật trạng thái nợ
    public function status_debt($id){
        $status_debt = order_rooms::find($id);
        if ($status_debt) {
            $status_debt->debt_status = 2;
            $status_debt->save();
        }
        return redirect()->back();
    }
}