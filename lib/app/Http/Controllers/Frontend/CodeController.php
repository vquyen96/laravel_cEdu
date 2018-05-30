<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Course;
use Auth;
use Cart;
use Mail;
class CodeController extends Controller
{
    
    public function getActiveCode(){
        if (Auth::check()) {
            return view('frontend.code');
        }
        else{
            return redirect('')->with('error','Bạn phải đăng nhập đã');
        }
    }
    public function postActiveCode(Request $request){
        //khi đã đăng nhập
        if(Auth::check()){
            $code = Code::where('code_value', $request->code_value)->where('code_acc_id',Auth::user()->id)->first();
            
            if ($code != null) {
                if($code->code_status == 1){
                    return back()->with('success','Khóa học của bạn đã được kích hoạt trước đó');
                }
                else{
                    $code->code_status = 1;
                    $code->save();
                    sleep(1);
                    $course = Course::find($code->code_cou_id);
                    $course->cou_student++;
                    $course->save();
                    
                    
                    $email = Auth::user()->email;
                    $data['code'] = $code;
                    Mail::send('frontend.emailDone', $data, function($message) use ($email){
                        $message->from('vquyenaaa@gmail.com', 'Ceduvn');
                        $message->to($email, $email)->subject('Thank You!');
                        // $message->cc('thongminh.depzai@gmail.com', 'boss');
                        $message->subject('Hóa đơn khóa học');
                    });

                    return redirect('')->with('success','Thành Công ! Khóa học của bạn đã được kích hoạt thành công');
                }
            }
            else{
                return back()->with('error','Mã kích hoạt khóa học không chính xác');
            } 
        }
        else{
            return back()->with('error','Bạn phải đăng nhập đã');
        }
        
        	
    }
}
