<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\tbl_customer;
use App\Models\tbl_rooms;
use App\Models\order_rooms;
use Session;
use DB; 

class index_frontend extends Controller{
    //dang nhap
    function login_customer(){
        return view('frontend.login_customer');
    }
    function dangnhap(Request $request) {
        $data = $request->all();
        $password = $data['password'];
        $user = tbl_customer::where(['email' => $data['email'], 'password' => $password])->first();
        if ($user) {
            Session::put('home', [
                    'id' => $user->id,
                    'email' => $user->email,
                    'password' => $user->password,
                    'name' => $user->name,
            ]);
    
            if (Session::get('home') != NULL) {
                return redirect()->route('home');
            } 
            else {
                return redirect()->back();
            }
        } 
        else {
           return redirect()->back();
        }
    }

    // dang xuat
    function logoutuser(){ 
        Session::forget('home')  ;
        return redirect()->back();
    }

    // dang ky khach hang
    function register(){
        return view('frontend.register');
    }
    function register_customer(Request $request){
        $tbl_customer = new tbl_customer([
            'name' => $request ->input('name'),
            'email' => $request ->input('email'),
            'password' => $request -> input('password'),
        ]);
        $tbl_customer -> save();
        return redirect('/login-customer');
    }

    // trang home khachs hang
    function home(){
        $best_seller = order_rooms::select('ma_phong', DB::raw('COUNT(*) as total_bookings'))
            ->groupBy('ma_phong')
            ->havingRaw('COUNT(*) >= 1')
            ->orderByDesc('total_bookings')
            ->get();
        ;
        // print_r($best_seller); die;
        $tbl_rooms = tbl_rooms::get()->toArray();
        return view('frontend.home', ['tbl_rooms' => $tbl_rooms, 'best_seller' => $best_seller]);
    }

    // chi tiet phong
    function room_details(Request $request,$id){
        $tbl_rooms = tbl_rooms::find($id);
        $product_info = tbl_rooms::where('id', $id)->first();
        return view('frontend.room_details',['tbl_rooms' => $tbl_rooms], compact('product_info'));
    }
    function chitiet(Request $request,$id){
        $tbl_rooms = tbl_rooms::find($id);
        return view('frontend.chitiet',['tbl_rooms' => $tbl_rooms]);
    }

    // cac phong
    function rooms_customer(){
        $tbl_rooms = tbl_rooms::get()->toArray();
        return view('frontend.rooms_customer', ['tbl_rooms' => $tbl_rooms]);
    }

    // đặt phòng
    function order_room(Request $request) {
        $order_room = new order_rooms;
        $user_id = Session::get('home')['id'];
        $order_room->phone = $request->input('phone');
        $order_room->name = $request->input('name');
        $order_room->stayNights = $request->input('stay_nights');
        $order_room->totalPrice = $request->input('totalPrice');
        $order_room->user_id = $user_id;
        $order_room->ma_phong = $request->input('ma_phong');
        // $order_room->price = $request->input('price');
        $order_room->check_in = $request->input('check_in');
        $order_room->status = 1;
    
        $checkInDate = new \DateTime($order_room->check_in);
        $stayNights = $order_room->stayNights;
        $checkOutDate = $checkInDate->modify("+{$stayNights} days");
        $order_room->check_out = $checkOutDate->format('Y-m-d');
        $existingOrder = order_rooms::where('ma_phong', $order_room->ma_phong)
            ->where('check_in', '<=', $order_room->check_in)
            ->where('check_out', '>', $order_room->check_in)
            ->first();
    
        if ($existingOrder) {
            return redirect()->back()->with('error', 'Phòng đã được đặt trong ngày này.');
        }
        $availableOrder = order_rooms::where('ma_phong', $order_room->ma_phong)
            ->where('check_in', '>', $order_room->check_in)
            ->where('check_in', '<', $order_room->check_out)
            ->first();
    
        if ($availableOrder) {
            return redirect()->back()->with('error', 'Phòng không trống trong ngày này.');
        }
        $order_room->selected_services = '[]';
        $order_room->save();
        return redirect()->route('rooms-customer')->with('message', 'Đặt phòng thành công');
    }
    
    // lich su don hang
    function order_history(){
        $user_id = Session::get('home')['id'];
        $order_rooms = order_rooms::where(['user_id' => $user_id])->get()->toArray(); 
        $users = tbl_customer::find($user_id);
        return view('frontend.order_history',['order_rooms' => $order_rooms]);
    }

    // hủy đơn hàng
    function cancelOrder($id) {
        $order_room = order_rooms::find($id);
        $order_room->status = 4; 
        $order_room->save();
        return redirect()->route('order-history')->with('message', 'Đã hủy đơn hàng thành công');
    
    }
    // giới thiệu
    function introduce(){
        return view('frontend.introduce');
    }
    
}