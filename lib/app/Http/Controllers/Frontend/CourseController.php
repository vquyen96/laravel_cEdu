<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Group;
use App\Models\Account;
use App\Models\Code;
use App\Models\Rating;
use App\Models\Teacher;
use Auth;
class CourseController extends Controller
{
    public function getList(Request $request){

        if (($request->price != null && $request->price != "null") || ($request->level != null && $request->level != "null") || ($request->tag != null && $request->tag != "null")) {
            if($request->price != null && $request->price != "null"){
                $price = (int)$request->price;
            }
            else{
                $price = 10000000;
            }
            if($request->tag != null && $request->tag != "null"){
                $tag = $request->tag;
            }
            else{
                
                $tag = "";
            }
            if($request->level != null && $request->level != "null"){
                $level = $request->level;
            }
            else{
                
                $level = "all";
            }
            $data['course'] = Course::all();
            $data['courseByMost'] = Course::where('cou_price','<', $price)->where('cou_tag', 'like', '%'.$tag.'%')->where('cou_level', $level)->orderBy('cou_student','desc')->paginate(6);
            $data['courseNewMost'] = Course::where('cou_price','<', $price)->where('cou_tag', 'like', '%'.$tag.'%')->where('cou_level', $level)->orderBy('created_at','desc')->paginate(6);
            $data['courseVoteMost'] = Course::where('cou_price','<', $price)->where('cou_tag', 'like', '%'.$tag.'%')->where('cou_level', $level)->orderBy('cou_star','desc')->paginate(6);
            $data['courseSaleMost'] = Course::where('cou_price','<', $price)->where('cou_tag', 'like', '%'.$tag.'%')->where('cou_level', $level)->orderBy('cou_sale','desc')->paginate(6);

            $data['teacher'] = Teacher::orderBy('tea_featured','desc')->paginate(7);
            $data['teacher_total'] = Teacher::count();
            
            // dd($data['teacher']);
            return view('frontend/course',$data);
        }
        $data['course'] = Course::all();
    	$data['courseByMost'] = Course::orderBy('cou_student','desc')->paginate(6);
        $data['courseNewMost'] = Course::orderBy('created_at','desc')->paginate(6);
        $data['courseVoteMost'] = Course::orderBy('cou_star','desc')->paginate(6);
        $data['courseSaleMost'] = Course::orderBy('cou_sale','desc')->paginate(6);

    	$data['teacher'] = Teacher::orderBy('tea_featured','desc')->paginate(7);
        $data['teacher_total'] = Teacher::count();
        
    	return view('frontend/course',$data);
    }
    public function getDetail($slug){
    	$data['course'] = Course::where('cou_slug',$slug)->first();
        // dd(Auth::user()->aff);

        // $data['acc'] = Account::where('id', Auth::user()->id)->where('level', 5)->first();
        // dd($acc->aff);
        if(Auth::check()){
            $data['acc'] = Account::where('id', Auth::user()->id)->where('level', 5)->first();
            $orderDe_id = 0;
            $code = 0;
            foreach ($data['course']->orderDe as $item) {
                if ($item->order != null && $item->order->ord_acc_id == Auth::user()->id) {
                    $orderDe_id = $item->orderDe_id;
                }
            }
            if ($orderDe_id != null) {
                $code = Code::where('code_orderDe_id',$orderDe_id)->first();
            }
            
    	    if($code != null){
                if($code->code_status == 1){
                    return redirect('courses/detail/'.$slug.'.html/active');
                }
                else{
                    return view('frontend.detailcourse',$data)->with('error','Bạn chưa kích hoạt khóa học này');
                }
            }
            else{
                return view('frontend.detailcourse',$data);
            }
        }
        else{
            return view('frontend.detailcourse',$data);
        }
    	
    }
    public function getGroup($slug){
    	$group = Group::where('gr_slug', $slug)->first();
    	$groupId = $group->gr_id;
    	$data['groupName'] = $group->gr_name;
    	$data['course'] = Course::where('cou_gr_id',$groupId)->get();
        $data['courseByMost'] = Course::where('cou_gr_id',$groupId)->orderBy('cou_star','desc')->paginate(6);
        $data['courseNewMost'] = Course::where('cou_gr_id',$groupId)->orderBy('created_at','desc')->paginate(6);
        $data['courseVoteMost'] = Course::where('cou_gr_id',$groupId)->orderBy('cou_star','desc')->paginate(6);
        $data['courseSaleMost'] = Course::where('cou_gr_id',$groupId)->orderBy('cou_star','desc')->paginate(6);
    	$data['teacher'] = Teacher::orderBy('tea_featured','desc')->paginate(7);
        $data['teacher_total'] = Teacher::count();
    	return view('frontend/course',$data);
    }
    public function getVideo($slug, $id){
        $data['course'] = Course::where('cou_slug',$slug)->first();

        if(Auth::check()){
            $acc = Account::where('id',Auth::user()->id)->first();
            $orderDe_id = null;
            foreach ($data['course']->orderDe as $item) {
                if ($item->order->ord_acc_id == Auth::user()->id) {
                    $orderDe_id = $item->orderDe_id;
                }
            }
            
            $code = Code::where('code_orderDe_id',$orderDe_id)->first();
            if($code != null){
                if($code->code_status == 1){
                    $data['course'] = Course::where('cou_slug',$slug)->first();
                    $data['part'] = $data['course']->part;
                    $i = 0;
                    foreach ($data['part'] as $part) {
                        foreach ($part->lesson as $lesson) {
                           
                           $data['listVideo'][$i] = $lesson->les_link;
                           $i++;
                        }
                    }
                    $data['video'] = $data['listVideo'][$id];
                   /* dd($data['video']);*/
                    // dd($data['video']);
                    // dd($data['video']);
                    return view('frontend.video',$data);
                }
                else{
                    return redirect('courses/detail/'.$slug.'.html')->with('error','Bạn chưa kích hoạt khóa học này');
                }
            }
            else{
                return redirect('courses/detail/'.$slug.'.html');
            }
        }
        else{
            return redirect('courses/detail/'.$slug.'.html');
        }

                    
    }

    public function getTeacher($slug){
        $course = Course::where('cou_slug',$slug)->first();
        $data['teacher'] = $course->tea;
        return view('frontend.teacher',$data);
    }

    public function getActive($slug){
        if(Auth::check()){
            $cou = Course::where('cou_slug',$slug)->first();
            foreach ($cou->orderDe as $item) {
                if ($item->order->ord_acc_id == Auth::user()->id) {
                    $orderDe_id = $item->orderDe_id;
                }
            }

            $code = Code::where('code_orderDe_id',$orderDe_id)->first();
            if($code != null){
                if($code->code_status == 1){
                    $data['course'] = $cou;
                    $data['rat'] = Rating::where('rat_cou_id',$cou->cou_id)->where('rat_acc_id',Auth::user()->id)->first();
                    
                    return view('frontend.courseActive',$data);
                }
                else{
                    return redirect('courses/detail/'.$slug.'.html')->with('error','Bạn chưa kích hoạt khóa học này');
                }
            }
            else{
                return redirect('courses/detail/'.$slug.'.html')->with('error','Bạn đã cố gắng');
            }
        }
        else{
            return redirect('courses/detail/'.$slug.'.html')->with('error','Bạn phải đăng nhập');
        }
    }
}

