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
// use App\Http\Controllers\Frontend\nganluong.class;
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
            return redirect('https://www.nganluong.vn/button_payment.php?receiver=info@ceduvn.com&product_name='.$ord_code.'&price=2000&return_url='.asset('cart/complete_nganluong').'&comments=test');
        }
        else{
            return redirect('');
            
        }
    }
    public function postNganLuong(Request $request){
        // Lấy các tham số để chuyển sang Ngânlượng thanh toán:

        //$ten= $_POST["txt_test"];
        $receiver='info@ceduvn.com';
        //Mã đơn hàng 
        $order_code='NL_'.time();
        //Khai báo url trả về 
        $return_url= 'http://localhost/laravel_c_edu/cart/complete_nganluong';
        // Link nut hủy đơn hàng
        $cancel_url= 'http://localhost/laravel_c_edu/cart';  
        //Giá của cả giỏ hàng 
        $txh_name =$request->txh_name;  
        $txt_email =$request->txt_email;    
        $txt_phone =$request->txt_phone;    
        $price =(int)$request->txt_gia;     
        //Thông tin giao dịch
        $transaction_info="Thong tin giao dich";
        $currency= "vnd";
        $quantity=1;
        $tax=0;
        $discount=0;
        $fee_cal=0;
        $fee_shipping=0;
        $order_description="Thong tin don hang: ".$order_code;
        $buyer_info=$txh_name."*|*".$txt_email."*|*".$txt_phone;
        $affiliate_code="";
        //Khai báo đối tượng của lớp NL_Checkout
        // $nl= new NL_Checkout();
        // $nl->nganluong_url = NGANLUONG_URL;
        // $nl->merchant_site_code = MERCHANT_ID;
        // $nl->secure_pass = MERCHANT_PASS;
        //Tạo link thanh toán đến nganluong.vn
        $url= $this->buildCheckoutUrlExpand($return_url, $receiver, $transaction_info, $order_code, $price, $currency, $quantity, $tax, $discount , $fee_cal,    $fee_shipping, $order_description, $buyer_info , $affiliate_code);
        //$url= $nl->buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price);
        
        
        //echo $url; die;
        if ($order_code != "") {
            //một số tham số lưu ý
            //&cancel_url=http://yourdomain.com --> Link bấm nút hủy giao dịch
            //&option_payment=bank_online --> Mặc định forcus vào phương thức Ngân Hàng
            $url .='&cancel_url='. $cancel_url;
            //$url .='&option_payment=bank_online';
            
            echo '<meta http-equiv="refresh" content="0; url='.$url.'" >';
            //&lang=en --> Ngôn ngữ hiển thị google translate
        }
        
    }
    
    public function getCompleteNganLuong(){
        if (isset($_GET['payment_id'])) {
            // Lấy các tham số để chuyển sang Ngânlượng thanh toán:

            $transaction_info =$_GET['transaction_info'];
            $order_code =$_GET['order_code'];
            $price =$_GET['price'];
            $payment_id =$_GET['payment_id'];
            $payment_type =$_GET['payment_type'];
            $error_text =$_GET['error_text'];
            $secure_code =$_GET['secure_code'];
            //Khai báo đối tượng của lớp NL_Checkout
            // $nl= new NL_Checkout();
            // $nl->merchant_site_code = '199bcafb2d959a25cd6ab550a4c2ed88';
            // $nl->secure_pass = MERCHANT_PASS;
            //Tạo link thanh toán đến nganluong.vn
            $checkpay= $this->verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code);
            
            if ($checkpay) {    
                echo 'Payment success: <pre>'; 
                // bạn viết code vào đây để cung cấp sản phẩm cho người mua     
                print_r($_GET);
            }else{
                echo "payment failed";
            }
            
        }
    }
    public function verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code)
    {
        // Tạo mã xác thực từ chủ web
        $str = '';
        $str .= ' ' . strval($transaction_info);
        $str .= ' ' . strval($order_code);
        $str .= ' ' . strval($price);
        $str .= ' ' . strval($payment_id);
        $str .= ' ' . strval($payment_type);
        $str .= ' ' . strval($error_text);
        // $str .= ' ' . strval('199bcafb2d959a25cd6ab550a4c2ed88');
        $str .= ' ' . strval('123456');

        // Mã hóa các tham số
        $verify_secure_code = '';
        $verify_secure_code = md5($str);
        
        // Xác thực mã của chủ web với mã trả về từ nganluong.vn
        if ($verify_secure_code === $secure_code) return true;
        else return false;
    }

    public function buildCheckoutUrlExpand($return_url, $receiver, $transaction_info, $order_code, $price, $currency = 'vnd', $quantity = 1, $tax = 0, $discount = 0, $fee_cal = 0, $fee_shipping = 0, $order_description = '', $buyer_info = '', $affiliate_code = '')
    {   
        if ($affiliate_code == "") $affiliate_code = '';
        $arr_param = array(
            // 'merchant_site_code'=>  strval('199bcafb2d959a25cd6ab550a4c2ed88'),
            'return_url'        =>  strval(strtolower($return_url)),
            'receiver'          =>  strval($receiver),
            'transaction_info'  =>  strval($transaction_info),
            'order_code'        =>  strval($order_code),
            'price'             =>  strval($price),
            'currency'          =>  strval($currency),
            'quantity'          =>  strval($quantity),
            'tax'               =>  strval($tax),
            'discount'          =>  strval($discount),
            'fee_cal'           =>  strval($fee_cal),
            'fee_shipping'      =>  strval($fee_shipping),
            'order_description' =>  strval($order_description),
            'buyer_info'        =>  strval($buyer_info), //"Họ tên người mua *|* Địa chỉ Email *|* Điện thoại *|* Địa chỉ nhận hàng"
            'affiliate_code'    =>  strval($affiliate_code)
        );
        
        $secure_code ='';
        $secure_code = implode(' ', $arr_param) . ' ' . '123456';
        //var_dump($secure_code). "<br/>";
        $arr_param['secure_code'] = md5($secure_code);      
        //echo $arr_param['secure_code'];
        /* */
        $redirect_url = 'https://www.nganluong.vn/checkout.php';
        if (strpos($redirect_url, '?') === false) {
            $redirect_url .= '?';
        } else if (substr($redirect_url, strlen($redirect_url)-1, 1) != '?' && strpos($redirect_url, '&') === false) {
            $redirect_url .= '&';           
        }
                
        /* */
        $url = '';
        foreach ($arr_param as $key=>$value) {
            $value = urlencode($value);
            if ($url == '') {
                $url .= $key . '=' . $value;
            } else {
                $url .= '&' . $key . '=' . $value;
            }
        }
        //echo $url;
        // die;
        return $redirect_url.$url;
    }
}
