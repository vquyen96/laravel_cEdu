<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Group;
use App\Models\Account;
use Auth;
class CourseController extends Controller
{
    public function getList(){
        if(Auth::user()->level == 3){
            $data['items'] = Course::where('cou_tea_id',Auth::user()->id)->orderBy('cou_id','desc')->paginate(7);
        }
        else{
            $data['items'] = Course::orderBy('cou_name','asc')->paginate(20);
        }
    	
    	return view('backend.course',$data);
    }
    public function getAdd(){
    	$data['tea'] = Account::where('level',3)->get();
    	$data['group'] = Group::all();
    	return view('backend.addcourse',$data);
    }
    public function postAdd(Request $request){
    	$cou = new Course;
        $cou->cou_name = $request->cou_name;
		$cou->cou_slug = str_slug($request->cou_name);
        $image = $request->file('img');
        if ($request->hasFile('img')) {
            
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $cou->cou_img = $filename;
            $request->img->storeAs('course',$filename);
        }
        $cou->cou_price = $request->cou_price;
        $cou->cou_level = $request->cou_level;
        $cou->cou_content = $request->content;
        $cou->cou_video = '0';
        $cou->cou_star = 0;
        $cou->cou_gr_id = $request->cou_gr_id;
        
        $cou->cou_tag = $request->cou_tag;
        
        
        if (Auth::user()->level == 3) {
            $cou->cou_sale = 0;
            $cou->cou_student = 0;
        	$cou->cou_tea_id = Auth::user()->id;
        }
        else{
            if ($request->cou_sale == null) {
                $cou->cou_sale = 0;
            }
            else{
                $cou->cou_sale = $request->cou_sale;
            }

            if ($request->cou_student == null) {
                $cou->cou_student = 0;
            }
            else{
               $cou->cou_student = $request->cou_student; 
            }
            
        	$cou->cou_tea_id = $request->cou_tea_id;
        }
        $cou->save();

    	return redirect('admin/course')->with('success','Thêm khóa học thành công');
    }
    public function getEdit($id){
    	$data['tea'] = Account::where('level',3)->get();
    	$data['group'] = Group::all();
        $data['item'] = Course::find($id);
        $i=0;
        foreach ($data['item']->part as $part) {
            foreach ($part->lesson as $item) {
                $i++;
            }
        }
        $data['lesson'] = $i;
        return view('backend.editcourse', $data);
    }
    public function postEdit(Request $request, $id){
        $cou  = Course::find($id);
        $cou->cou_name = $request->cou_name;
        $cou->cou_slug = str_slug($request->cou_name);
        $image = $request->file('img');
        if ($request->hasFile('img')) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $cou->cou_img = $filename;
            $request->img->storeAs('course',$filename);
        }
        $cou->cou_price = $request->cou_price;
        $cou->cou_level = $request->cou_level;
        $cou->cou_content = $request->content;
        $cou->cou_gr_id = $request->cou_gr_id;
        $cou->cou_tag = $request->cou_tag;

        if (Auth::user()->level == 3) {
            $cou->cou_tea_id = Auth::user()->id;
        }
        else{
            $cou->cou_sale = $request->cou_sale;
            $cou->cou_student = $request->cou_student;
            $cou->cou_tea_id = $request->cou_tea_id;
        }
        $cou->save();


        return redirect('admin/course')->with('success','Sửa khóa học thành công');
    }

    public function getStudent($id){
        $data['course'] = Course::find($id);
        $data['orderDe'] = $data['course']->orderDe;

        return view('backend.student',$data);
    }
    public function getDelete($id){
        Course::destroy($id);
        return redirect('admin/course');
    }
}
