<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Group;
use App\Models\Account;
class SearchController extends Controller
{
    public function getList(Request $request){
    	$data['searchValue'] = $request->search;
    	$data['course'] = Course::where('cou_name','like','%'.$request->search.'%')->get();
    	$data['teacher'] = Account::where('level',3)->paginate(5);
    	return view('frontend.course',$data);
    }
}
