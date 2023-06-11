<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\tbl_admin;
use App\Models\tbl_rooms;
use App\Models\order_rooms;
use App\Models\tbl_staff;
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
        $bestseller = order_rooms::select('ma_phong', DB::raw('sum(stayNights) as total_amount'))
        ->groupBy('ma_phong')->havingRaw('COUNT(*) >= 2')->orderByDesc('total_amount')->get();
        // print_r($bestseller); die;
        return view('backend.admin',['order_rooms' => $order_rooms], compact('count_rooms', 'count_order', 'totalOrders', 'bestseller'));
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
    function quan_ly_hd() {
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
        }
        return view('backend.quan_ly_hd', ['order_rooms' => $order_rooms]);
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
}