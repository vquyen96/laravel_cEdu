<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Http\Requests\AddAccountRequest;
// use Image;
class AccountController extends Controller
{
    public function getList(){
    	$data['items'] = Account::orderBy('id','desc')->paginate(7);
    	return view('backend.account',$data);
    }
    public function getAdd(){
    	
    	return view('backend.addaccount');
    }
    public function postAdd(AddAccountRequest $request){
    	$acc = new Account;
        $acc->name = $request->name;

        $image = $request->file('img');
        if ($request->hasFile('img')) {
            
            $filename = time() . '.' . $image->getClientOriginalExtension();
            // Image::make($image->getRealPath())->resize(200, 200)->save($path);
            $acc->img = $filename;
            $request->img->storeAs('avatar',$filename);
        }
        $acc->job = 'Tu do';
        $acc->email = $request->email;
        $acc->password = bcrypt($request->password);
        
        if($acc->content != null){
            $acc->content = $request->content;
        }
        else{
            $acc->content = "";
        }
        if($acc->level != null){
            $acc->level = $request->level;
        }
        else{
            $acc->level = 4;
        }
        $acc->save();

    	return redirect('admin/account')->with('success','Thêm tài khoản thành công');
    }
    public function getEdit($id){
        $data['item'] = Account::find($id);
        return view('backend.editaccount', $data);
    }
    public function postEdit(Request $request, $id){
        $acc = Account::find($id);
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

        return redirect('admin/account')->with('success','Sửa tài khoản thành công');
    }

    public function getDelete($id){
        Account::destroy($id);
        return back();
    }

    public function getSearch(Request $request){
        $result = $request->search;
        $data['keyword'] = $result;
        $result = str_replace(' ', '%', $result);
        $data['items'] =  Account::where('name', 'like', '%'.$result.'%')->paginate(8);
        // dd($data['items']);
        return view('backend.account',$data);
    }
}
