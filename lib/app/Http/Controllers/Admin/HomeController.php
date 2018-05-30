<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Account;
use App\Models\Code;
class HomeController extends Controller
{
    public function getHome(){
    	$data['student'] = Code::where('code_status', 1)->get()->count();
    	$data['teacher'] = Account::where('level',3)->get()->count();
    	$data['ctv'] = Account::where('level',4)->get()->count();
    	return view('backend.home',$data);
    }
}
