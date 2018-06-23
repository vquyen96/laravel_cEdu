<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Course;
use App\Models\Account;
use App\Models\Banner;
use App\Models\About;
use App\Models\Teacher;
use App\Http\Requests\AddAccountRequest;
use Auth;
class HomeController extends Controller
{
    public function getHome(){
		$data['groups'] = Group::all();
		$data['coursefollow'] = Course::orderBy('cou_price','desc')->paginate(4);
		$data['coursenew'] = Course::orderBy('created_at','desc')->paginate(4);
		$data['courserate'] = Course::orderBy('cou_star','desc')->paginate(4);
		$data['hotcourse'] = Course::orderBy('cou_price','asc')->paginate(8);
		$data['courseHot'] = Course::orderBy('cou_price','asc')->paginate(7);
		$data['teacher'] = Teacher::orderBy('tea_featured','desc')->paginate(4);
        // dd($data['teacher']);
		$data['courseFeatured'] = Course::orderBy('cou_featured','desc')->paginate(21);
        $data['bannerHead'] = Banner::where('ban_name','like','Banner Trang Chủ_Phía Trên')->get();
        $data['bannerRight'] = Banner::where('ban_name', 'like', 'Banner Thân Trang Chủ Bên Phải')->get();
        $data['bannerLeftTop'] = Banner::where('ban_name', 'like', 'Banner Thân Trang Chủ Bên Trái Phía Trên')->get();
        $data['bannerLeftBot'] = Banner::where('ban_name', 'like',  'Banner Thân Trang Chủ Bên Trái Phía Dưới')->get();
        
    	return view('frontend.home2',$data);
    }
    public function postRegister(AddAccountRequest $request){
    	$acc = new Account;
        $acc->name = $request->name;
        $acc->email = $request->email;
        $acc->password = bcrypt($request->password);
        $acc->level = 9;
        $acc->content = " ";
        $acc->save();
        sleep(1);
        
        $arr = ['email' => $request->email, 'password' => $request->password];
        if(Auth::attempt($arr, true)){
            return back();
        }
        else{
            return back()->withInput()->with('error','Tài khoản khặc mật khẩu của bạn không đúng');
        }
    }
    public function postLogin(Request $request){
        $arr = ['email' => $request->email, 'password' => $request->password];

        // dd($arr);
        if(Auth::attempt($arr, true)){
            if (Auth::user()->level >7) {
                return back()->with('success','Đăng nhập thành công');
            }
            else{
                return redirect('admin');
            }
        }
        else{
            return back()->withInput()->with('error','Tài khoản khặc mật khẩu của bạn không đúng');
        }
    }

    public function getAbout($slug){
        // dd('ok');
        $data['about'] = About::where('about_slug', $slug)->first();
        return view('frontend.about',$data);
    }
}
