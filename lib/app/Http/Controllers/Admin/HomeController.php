<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Account;
use App\Models\Code;
use App\Models\OrderDetail;
use App\Models\Teacher;
use Auth;
use DateTime;
class HomeController extends Controller
{
    public function getHome(){
        if (Auth::user()->level == 7) {
            return redirect('admin/home_teacher');
        }
        else{
            if (Auth::user()->level == 3) {
                $date= new DateTime();
                date_add($date,date_interval_create_from_date_string(" -1 months"));
                $data['student'] = Code::where('code_status', 1)->get()->count();
                $data['teacher'] = Account::where('level',7)->get()->count();
                $data['course'] = Course::get();
                $data['account'] = Account::all();

                $data['chartOrderDe'] = OrderDetail::orderBy('created_at', 'desc')->get();
                $total = 0;
                $total_month = 0;
                foreach ($data['chartOrderDe'] as $item) {
                    if ($item->order->ord_status == 0) {
                        $total += $item->course->cou_price;
                        if (strtotime(date_format($item->created_at,"Y-m-d")) > strtotime(date_format($date,"Y-m-d"))) {
                            $total_month += $item->course->cou_price;
                        }
                    }
                }
                $data['total_price'] = $total;
                $data['total_month'] = $total_month;
                return view('backend.accountant-home',$data);
            }
            $data['student'] = Code::where('code_status', 1)->get()->count();
            $data['teacher'] = Account::where('level',7)->get()->count();
            $data['course'] = Course::get();
            $data['account'] = Account::all();

            $data['chartOrderDe'] = OrderDetail::orderBy('created_at', 'desc')->get();
            $total = 0;
            foreach ($data['chartOrderDe'] as $item) {
                if ($item->order->ord_status == 0) {
                    $total += $item->course->cou_price;
                    
                }
            }
            $data['total_price'] = $total;
            return view('backend.home',$data);
        }
            
    }
    public function getHomeTeacher(){
        
            $acc = Account::where('id', Auth::user()->id)->first();
            $data['acc'] = $acc;
            $data['student'] = 0;
            foreach ($acc->course as $course) {
                $data['student'] += OrderDetail::where('orderDe_cou_id', $course->cou_id)->get()->count();
            }
            $data['teacher'] = Teacher::where('tea_acc_id', Auth::user()->id)->first();
            $data['course'] = $acc->course;
            $data['account'] = Account::all();

            $data['chartOrderDe'] = OrderDetail::where('orderDe_cou_id')->orderBy('created_at', 'desc')->get();
            $total = 0;
            foreach ($acc->course as $course) {
                
                foreach ($course->orderDe as $orderDe) {
                    if ($orderDe->order->ord_status == 0) {
                        $total += $orderDe->orderDe_price;
                    }
                }
            }
            
            $data['total_price'] = $total;
            
            return view('backend.home_teacher',$data);
        
            
    }
    public function getUser(){
        $data['item'] = Account::find(Auth::user()->id);
        
        return view('backend.editaccount', $data);
    }
    public function postUser(Request $request){
        $acc = Account::find(Auth::user()->id);
        $acc->name = $request->name;

        $image = $request->file('img');
        if ($request->hasFile('img')) {
            $acc->img = saveImage([$image], 200, 'avatar');
        }
        
        if ($acc->password != null) {
            $acc->password = bcrypt($request->password);
        }
        
        $acc->content = $request->content;
        $acc->level = $request->level;
        $acc->save();
        return back()->with('success','Sửa tài khoản thành công');
    }
}
