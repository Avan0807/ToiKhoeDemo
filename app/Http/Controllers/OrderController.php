<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;
use App\User;
use PDF;
use Notification;
use Helper;
use Illuminate\Support\Str;
use App\Notifications\StatusNotification;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng (phía admin).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id','DESC')->paginate(10);
        return view('backend.order.index')->with('orders',$orders);
    }

    /**
     * Tạo đơn hàng mới (trang create nếu có).
     */
    public function create()
    {
        //
    }

    /**
     * Lưu đơn hàng mới.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'string|required',
            'last_name'  => 'string|required',
            'address1'   => 'string|required',
            'address2'   => 'string|nullable',
            'coupon'     => 'nullable|numeric',
            'phone'      => 'numeric|required',
            'post_code'  => 'string|nullable',
            'email'      => 'string|required'
        ]);

        // Kiểm tra giỏ hàng có trống hay không
        if(empty(Cart::where('user_id', auth()->user()->id)->where('order_id', null)->first())){
            request()->session()->flash('error','Giỏ hàng đang trống!');
            return back();
        }

        // Tạo đơn hàng
        $order        = new Order();
        $order_data   = $request->all();
        $order_data['order_number'] = 'ORD-'.strtoupper(Str::random(10));
        $order_data['user_id']      = $request->user()->id;
        $order_data['shipping_id']  = $request->shipping;

        // Lấy giá ship
        $shipping = Shipping::where('id',$order_data['shipping_id'])->pluck('price');

        // Tính sub_total, quantity, coupon,...
        $order_data['sub_total'] = Helper::totalCartPrice();
        $order_data['quantity']  = Helper::cartCount();

        // Nếu có áp dụng mã giảm giá
        if(session('coupon')){
            $order_data['coupon'] = session('coupon')['value'];
        }

        // Tính toán total_amount
        if($request->shipping){
            if(session('coupon')){
                $order_data['total_amount'] = Helper::totalCartPrice() + $shipping[0] - session('coupon')['value'];
            } else {
                $order_data['total_amount'] = Helper::totalCartPrice() + $shipping[0];
            }
        }
        else{
            if(session('coupon')){
                $order_data['total_amount'] = Helper::totalCartPrice() - session('coupon')['value'];
            } else {
                $order_data['total_amount'] = Helper::totalCartPrice();
            }
        }

        // Xử lý phương thức thanh toán
        if (request('payment_method') == 'paypal') {
            $order_data['payment_method'] = 'paypal';
            $order_data['payment_status'] = 'paid';
        } elseif (request('payment_method') == 'cardpay') {
            $order_data['payment_method'] = 'cardpay';
            $order_data['payment_status'] = 'paid';
        } else {
            $order_data['payment_method'] = 'cod';
            $order_data['payment_status'] = 'Unpaid';
        }

        // Lưu thông tin đơn hàng
        $order->fill($order_data);
        $status = $order->save();

        if($order) {
            // Gửi thông báo cho admin
            $users   = User::where('role','admin')->first();
            $details = [
                'title'     => 'Đơn hàng mới',
                'actionURL' => route('order.show', $order->id),
                'fas'       => 'fa-file-alt'
            ];
            Notification::send($users, new StatusNotification($details));
        }

        // Nếu thanh toán paypal, chuyển hướng sang trang thanh toán
        if(request('payment_method')=='paypal'){
            return redirect()->route('payment')->with(['id'=>$order->id]);
        }
        else{
            // Xóa session giỏ hàng, coupon nếu có
            session()->forget('cart');
            session()->forget('coupon');
        }

        // Cập nhật order_id cho giỏ hàng
        Cart::where('user_id', auth()->user()->id)
            ->where('order_id', null)
            ->update(['order_id' => $order->id]);

        request()->session()->flash('success','Đơn hàng của bạn đã được tạo. Cảm ơn bạn đã mua sắm!');
        return redirect()->route('home');
    }

    /**
     * Hiển thị chi tiết đơn hàng (phía admin).
     */
    public function show($id)
    {
        $order = Order::find($id);
        if (!$order) {
            // Ở đây có thể xử lý lỗi hoặc redirect nếu không tìm thấy đơn hàng
        }
        return view('backend.order.show')->with('order', $order);
    }

    /**
     * Form chỉnh sửa đơn hàng (phía admin).
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('backend.order.edit')->with('order',$order);
    }

    /**
     * Cập nhật đơn hàng (phía admin).
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $this->validate($request,[
            'status' => 'required|in:new,process,delivered,cancel'
        ]);
        $data = $request->all();

        // Nếu đơn hàng được chuyển sang trạng thái 'delivered'
        // => Trừ stock của các sản phẩm liên quan
        if($request->status=='delivered'){
            foreach($order->cart as $cart){
                $product = $cart->product;
                $product->stock -= $cart->quantity;
                $product->save();
            }
        }

        $status = $order->fill($data)->save();
        if($status){
            request()->session()->flash('success','Cập nhật đơn hàng thành công');
        }
        else{
            request()->session()->flash('error','Không thể cập nhật đơn hàng');
        }
        return redirect()->route('order.index');
    }

    /**
     * Xóa đơn hàng (phía admin).
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if($order){
            $status = $order->delete();
            if($status){
                request()->session()->flash('success','Đã xóa đơn hàng thành công');
            }
            else{
                request()->session()->flash('error','Không thể xóa đơn hàng');
            }
            return redirect()->route('order.index');
        }
        else{
            request()->session()->flash('error','Không tìm thấy đơn hàng');
            return redirect()->back();
        }
    }

    /**
     * Trang theo dõi đơn hàng (phía frontend).
     */
    public function orderTrack(){
        return view('frontend.pages.order-track');
    }

    /**
     * Kiểm tra tình trạng đơn hàng (phía frontend).
     */
    public function productTrackOrder(Request $request){
        $order = Order::where('user_id', auth()->user()->id)
                      ->where('order_number', $request->order_number)
                      ->first();

        if($order){
            if($order->status == "new"){
                request()->session()->flash('success','Đơn hàng của bạn đã được đặt.');
                return redirect()->route('home');
            }
            elseif($order->status == "process"){
                request()->session()->flash('success','Đơn hàng của bạn đang được xử lý.');
                return redirect()->route('home');
            }
            elseif($order->status == "delivered"){
                request()->session()->flash('success','Đơn hàng của bạn đã được giao. Cảm ơn bạn đã mua sắm!');
                return redirect()->route('home');
            }
            else{
                request()->session()->flash('error','Rất tiếc, đơn hàng của bạn đã bị hủy.');
                return redirect()->route('home');
            }
        }
        else{
            request()->session()->flash('error','Mã đơn hàng không hợp lệ. Vui lòng thử lại!');
            return back();
        }
    }

    /**
     * Xuất hóa đơn PDF (phía admin).
     */
    public function pdf(Request $request){
        $order = Order::getAllOrder($request->id);
        $file_name = $order->order_number.'-'.$order->first_name.'.pdf';

        $pdf = PDF::loadview('backend.order.pdf', compact('order'));
        return $pdf->download($file_name);
    }

    /**
     * Lấy dữ liệu thống kê thu nhập theo tháng (phía admin).
     */
    public function incomeChart(Request $request){
        $year = \Carbon\Carbon::now()->year;
        $items = Order::with(['cart_info'])
                      ->whereYear('created_at', $year)
                      ->where('status','delivered')
                      ->get()
                      ->groupBy(function($d){
                          return \Carbon\Carbon::parse($d->created_at)->format('m');
                      });

        $result = [];
        foreach($items as $month => $item_collections){
            foreach($item_collections as $item){
                $amount = $item->cart_info->sum('amount');
                $m = intval($month);
                isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
            }
        }

        $data = [];
        for($i = 1; $i <= 12; $i++){
            $monthName = date('F', mktime(0, 0, 0, $i, 1));
            $data[$monthName] = (!empty($result[$i]))
                ? number_format((float)($result[$i]), 2, '.', '')
                : 0.0;
        }

        return $data;
    }
}
