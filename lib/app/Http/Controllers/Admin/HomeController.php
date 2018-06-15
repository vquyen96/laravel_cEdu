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
class HomeController extends Controller
{
    public function getHome(){
        if (Auth::user()->level > 2) {
            return redirect('admin/home_teacher');
        }
        else{
            $data['student'] = Code::where('code_status', 1)->get()->count();
            $data['teacher'] = Account::where('level',3)->get()->count();
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
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $acc->img = $filename;
            $request->img->storeAs('avatar',$filename);
        }
        $acc->job = 'Tu do';
        $acc->email = $request->email;
        if ($acc->password != null) {
            $acc->password = bcrypt($request->password);
        }
        
        $acc->content = $request->content;
        $acc->level = $request->level;
        $acc->save();
        return back()->with('success','Sửa tài khoản thành công');
    }
}
