<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Course;
use App\Models\Code;
use App\Models\Teacher;
use App\Models\Teacher_Rating;
use App\Models\OrderDetail;
use Auth;
class UserController extends Controller
{
    public function getUser(){
        if (Auth::check()) {
            $data['user'] = Account::find(Auth::user()->id);
            // $data['code'] = Code::where('code_acc_id',Auth::user()->id)->get();
            $data['orderDe'] = OrderDetail::where('orderDe_aff_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(8);
            // dd($data['orderDe']);
            return view('frontend.user',$data);
        }
    	else{
            return redirect('/');
        }
    }
    public function postUser(Request $request){
    	$acc = Account::find(Auth::user()->id);
        $acc->name = $request->name;

        $image = $request->file('img');
        if ($request->hasFile('img')) {
            $filename = $image->getClientOriginalName();
            $acc->img = $filename;
            $request->img->storeAs('avatar',$filename);
        }
        $acc->job = $request->job;
        $acc->content = $request->content;
        $acc->save();
        return back()->with('success','Sửa tài khoản thành công');
    }
    public function getTeacher($email){
        $data['teacher'] = Account::where('email',$email)->first();
        
        if(Auth::check()){
            $data['rate'] = Teacher_Rating::where('tr_acc_id', Auth::user()->id)->where('tr_tea_id',$data['teacher']->teacher->tea_id)->first();
        }
        else{
            $data['rate'] = "";
        }
        
        switch ($data['teacher']->teacher->tea_templace) {
            case 1:
                return view('frontend.teacher1',$data);
            case 2:
                return view('frontend.teacher2',$data);
            case 3:
                return view('frontend.teacher3',$data);
            default:
                return view('frontend.teacher1',$data);
        }
        return view('frontend.teacher1',$data);
    }

    public function getTeacherRating($email ,$rate){
       
        //Check xem người dùng đẵ đăng nhập chưa
        if(Auth::check()){
            $account = Account::find(Auth::user()->id);
            $teacher = Teacher::where('tea_email', $email)->first();
            //check xem tài khoản có đăng ký khóa học không
            $check = 0;
            foreach ($account->code as $item) {
                if($item->cou->tea->email == $email){
                    $check = 1;
                }
            }
            if ($check == 1) {
                $teacher_rating = Teacher_Rating::where('tr_acc_id', Auth::user()->id)->where('tr_tea_id', $teacher->tea_id)->first();
                //Check xem người dùng đã đánh giá hay chưa ??
                if ($teacher_rating == null) {
                    //Tài khoản chưa đánh giá
                    $teacher_rating = new Teacher_Rating;
                    $teacher_rating->tr_rate = $rate;
                    $teacher_rating->tr_tea_id = $teacher->tea_id;
                    $teacher_rating->tr_acc_id = $account->id;
                    $teacher_rating->save();
                    return back();
                }
                else{
                    //Tài khoản chưa đánh giá giáo viên
                    $teacher_rating->tr_rate = $rate;
                    $teacher_rating->tr_tea_id = $teacher->tea_id;
                    $teacher_rating->tr_acc_id = $account->id;
                    $teacher_rating->save();
                    return back();
                }
            }
            else{
                return back()->with("error","Bạn chưa học khóa học nào của giáo viên này");
            }
        }
        else{
            return back()->with("error","Bạn Phải đăng nhập để đánh giá giáo viên");
        }
    }

}
