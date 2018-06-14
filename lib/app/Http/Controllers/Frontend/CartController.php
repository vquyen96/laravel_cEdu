<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Aff;
use App\Models\Code;
use Cart;
use Auth;
use Mail;
class CartController extends Controller
{
    public function getAddCart(Request $request, $slug){
    	$course = Course::where('cou_slug',$slug)->first();
        // Kiểm tra người dùng đã từng mua khóa học chưa
        $countCouExit = 0;
        if (Auth::check()) {
            $order = Order::where('ord_acc_id', Auth()->user()->id)->get();
            foreach ($order as $item) {
                $courseExist = OrderDetail::where('orderDe_cou_id',$course->cou_id)->where('orderDe_ord_id',$item->ord_id)->first();
                if ($courseExist != null) {
                    $countCouExit = 1;
                }
            }
        }
        
        if ($countCouExit == 0) {
            //Kiểm tra khóa học có trong giỏ hàng không
            $courseExit = 0;
            foreach (Cart::content() as $cart) {
                if ($cart->id == $course->cou_id) {
                    $courseExit = 1;
                }
            }
            if ($courseExit == 0) {
                if($request->aff == null){
                    Cart::add(['id'=>$course->cou_id, 'name'=>$course->cou_name, 'qty'=>1, 'price'=>$course->cou_price , 'options'=>['img'=>$course->cou_img,'tea'=>$course->tea->name]]);
                }
                else{
                    Cart::add(['id'=>$course->cou_id, 'name'=>$course->cou_name, 'qty'=>1, 'price'=>$course->cou_price , 'options'=>['img'=>$course->cou_img,'tea'=>$course->tea->name, 'aff'=>$request->aff]]);
                }
                return back()->with('success','Khoá học đã được thêm vào giỏ hàng');
            }
            else{
                return back()->with('error','Khoá học đã được thêm trước đó');
            }
        }   
        else{
            return back()->with('error','Tài khoản của bạn đã mua khóa học này');
        }   
           
    	
    }
    public function getBuyNow(Request $request, $slug){
        $course = Course::where('cou_slug',$slug)->first();
        // Kiểm tra người dùng đã từng mua khóa học chưa
        $countCouExit = 0;
        if (Auth::check()) {
            $order = Order::where('ord_acc_id', Auth()->user()->id)->get();
            foreach ($order as $item) {
                $courseExist = OrderDetail::where('orderDe_cou_id',$course->cou_id)->where('orderDe_ord_id',$item->ord_id)->first();
                if ($courseExist != null) {
                    $countCouExit = 1;
                }
            }
        }
        
        if ($countCouExit == 0) {
            //Kiểm tra khóa học có trong giỏ hàng không
            $courseExit = 0;
            foreach (Cart::content() as $cart) {
                if ($cart->id == $course->cou_id) {
                    $courseExit = 1;
                }
            }
            if ($courseExit == 0) {
                if($request->aff == null){
                    Cart::add(['id'=>$course->cou_id, 'name'=>$course->cou_name, 'qty'=>1, 'price'=>$course->cou_price , 'options'=>['img'=>$course->cou_img,'tea'=>$course->tea->name]]);
                }
                else{
                    Cart::add(['id'=>$course->cou_id, 'name'=>$course->cou_name, 'qty'=>1, 'price'=>$course->cou_price , 'options'=>['img'=>$course->cou_img,'tea'=>$course->tea->name, 'aff'=>$request->aff]]);
                }
                return redirect('cart/show')->with('success','Khoá học đã được thêm vào giỏ hàng');
            }
            else{
                return redirect('cart/show')->with('error','Khoá học đã được thêm trước đó');
            }
        }   
        else{
            return back()->with('error','Tài khoản của bạn đã mua khóa học này');
        } 
        
    }
    public function getShowCart(){
    	$data['total'] = str_replace(".00","",Cart::total());
    	$data['items'] = Cart::content();
        
    	return view('frontend.cart', $data);
    }
    public function getDeleteCart($id){
    	if($id == 'all'){
    		Cart::destroy();
    	}
    	else{
    		Cart::remove($id);
    	}
    	return back();
    }

    public function getUpdateCart(Request $request){
    	Cart::update($request->rowId, $request->qty);
    }
    public function postComplete(Request $request, $type){

    	$order = new Order;
        $order->ord_payment = 1;
        $order->ord_acc_id = Auth::user()->id;
        $order->ord_note = $request->note;
        $order->ord_adress = $request->adress;
        $order->ord_phone = $request->name;
        $total = str_replace(",","",Cart::total());
    	$total = (int)$total;
    	$order->ord_total_price = $total;
        if ($type == 'paypal') {
            $order->ord_status = 0 ;
        }
        else{
            $order->ord_status = 1 ;
        }
        // dd($order);
        $order->save();
    	$data['cart'] = Cart::content();
    	
    	sleep(2);
        foreach ($data['cart'] as $item) {
            
        	$orderdetail = new OrderDetail;
        	$orderdetail->orderDe_name = $item->name;
	        $orderdetail->orderDe_price = $item->price;
	        $orderdetail->orderDe_qty = $item->qty;
	        $orderdetail->orderDe_ord_id = $order->ord_id;
	        $orderdetail->orderDe_cou_id = $item->id;
            $aff = Aff::where('aff_code', $item->options->aff)->first();
            $orderdetail->orderDe_aff_id = $aff->aff_acc_id;
	        $orderdetail->save();
        }
        $data['order'] = $order;
        $email = $request->email;
        $data['cart'] = Cart::content();
        $data['total'] = Cart::total();
        // return view('frontend.email', $data);
        // dd($data);
        Mail::send('frontend.emailShip', $data, function($message) use ($email){
            $message->from('info@ceduvn.com', 'Ceduvn');
            $message->to($email, $email)->subject('Thank You!');
            // $message->cc('thongminh.depzai@gmail.com', 'boss');
            $message->subject('Hóa đơn khóa học');
        });

    	Cart::destroy();
    	
    	return back();
    }
    public function getComplete($type){
        if ($type == 'paypal' ) {
            $order = new Order;
            $order->ord_payment = 1;
            $order->ord_acc_id = Auth::user()->id;
            $total = str_replace(",","",Cart::total());
            $total = (int)$total;
            $order->ord_total_price = $total;
            $order->ord_status = 0 ;
            // dd($order);
            $order->save();
            $data['cart'] = Cart::content();



            $data['order'] = $order;
            $email = Auth::user()->email;
            $data['cart'] = Cart::content();
            $data['total'] = Cart::total();
            
            Mail::send('frontend.emailShip', $data, function($message) use ($email){
                $message->from('info@ceduvn.com', 'Ceduvn');
                $message->to($email, $email)->subject('Thank You!');
                $message->subject('Hóa đơn khóa học');
            });
            
            sleep(1);
            foreach ($data['cart'] as $item) {
                $orderdetail = new OrderDetail;
                $orderdetail->orderDe_name = $item->name;
                $orderdetail->orderDe_price = $item->price;
                $orderdetail->orderDe_qty = $item->qty;
                $orderdetail->orderDe_ord_id = $order->ord_id;
                $orderdetail->orderDe_cou_id = $item->id;
                if ($item->options->aff != null) {
                    $aff = Aff::where('aff_code', $item->options->aff)->first();
                    $orderdetail->orderDe_aff_id = $aff->aff_acc_id;
                }
                $orderdetail->save();
            }
            sleep(1);
            
            foreach ($order->orderDe as $orderDe) {
                while (true) {
                    $code_value   = mt_rand(100000, 999999);
                    $codeExit = Code::where('code_value',$code_value)->first();
                    if($codeExit == null){
                        $code = new Code;
                        $code->code_value = $code_value;
                        $code->code_orderDe_id = $orderDe->orderDe_id;
                        $code->code_status = 0;
                        $code->save();
                        $email = $order->acc->email;
                        $data['code'] = $code;
                        
                        Mail::send('frontend.emailCode', $data, function($message) use ($email){
                            $message->from('info@ceduvn.com', 'Ceduvn');
                            $message->to($email, $email);
                            $message->subject('Mã code khóa học');
                        });
                        break;
                    }
                }
            }

            

            Cart::destroy();
        }

    	return view('frontend.complete');
    }
    public function getPaymentLogin(){
        if(Auth::check()){
            return redirect('cart/');
        }
        $data['total'] = Cart::total();
        $data['items'] = Cart::content();
        return view('frontend.payment-login', $data);

    }
    public function getPayment(){
        if (Auth::check()) {
            return view('frontend.payment');
        }
        else{
            return redirect('cart/login');
        }
        
    }
    public function postPayment(Request $request){
        $order = new Order;
        $order->ord_payment = 1;
        $order->ord_acc_id = Auth::user()->id;
        $order->ord_note = $request->note;
        $order->ord_adress = $request->city." | ".$request->quan." | ".$request->phuong." | ".$request->adress;
        // dd($order->ord_adress);
        $order->ord_phone = $request->phone;
        $total = str_replace(",","",Cart::total());
        $total = (int)$total;
        $order->ord_total_price = $total;
        $order->ord_status = 1 ;
        // dd($order);
        $order->save();
        $data['cart'] = Cart::content();
        
        sleep(2);
        foreach ($data['cart'] as $item) {
            $orderdetail = new OrderDetail;
            $orderdetail->orderDe_name = $item->name;
            $orderdetail->orderDe_price = $item->price;
            $orderdetail->orderDe_qty = $item->qty;
            $orderdetail->orderDe_ord_id = $order->ord_id;
            $orderdetail->orderDe_cou_id = $item->id;
            $aff = Aff::where('aff_code', $item->options->aff)->first();
            if($aff != null){
                $orderdetail->orderDe_aff_id = $aff->aff_acc_id;
            }
            
            $orderdetail->save();
        }
        $data['order'] = $order;
        $email = Auth::user()->email;
        $data['cart'] = Cart::content();
        $data['total'] = Cart::total();
        // return view('frontend.email', $data);
        // dd($data);
        Mail::send('frontend.emailShip', $data, function($message) use ($email){
            $message->from('info@ceduvn.com', 'Ceduvn');
            $message->to($email, $email)->subject('Thank You!');
            // $message->cc('thongminh.depzai@gmail.com', 'boss');
            $message->subject('Hóa đơn khóa học');
        });
        
        Cart::destroy();
        
        return redirect('cart/complete/all');
        
    }
    public function getNganLuong(){

        if (Auth::check() && Cart::total() != "0.00") {
            while (true) {
                $ord_code   = mt_rand(100000, 999999);
                $codeExit = Order::where('ord_code',$ord_code)->first();
                if($codeExit == null){
                    break;

                }
            }
            return redirect('https://www.nganluong.vn/button_payment.php?receiver=info@ceduvn.com&product_name='.$ord_code.'&price='.Cart::total().'&return_url='.asset('cart/done_ngan_luong/'.$ord_code).'&comments=test');
        }
        else{
            return redirect('');
            
        }
    }

    
}
