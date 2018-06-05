<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Account;
use App\Models\Code;
use App\Models\OrderDetail;
use Auth;
class HomeController extends Controller
{
    public function getHome(){
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
