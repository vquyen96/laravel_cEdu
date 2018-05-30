<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\OrderDetail;
use App\Models\Aff;
class AffController extends Controller
{
    public function getList(){
    	$data['items'] = Account::where('level', 5)->orderBy('id','desc')->paginate(7);
    	return view('backend.affiliate',$data);
    }
    public function getDetail($id){
    	// $aff = Aff::where('aff_acc_id', $id)->first();
    	// if ($aff == null) {
    	// 	while (true) {
	    //         $code_value   = mt_rand(100000, 999999);
	    //         $codeExit = Aff::where('aff_code', $code_value)->first();
	    //         if($codeExit == null){
	    //             $aff = new Aff;
	    //             $aff->aff_code = $code_value;
	    //             $aff->aff_acc_id = $id;
	    //             $aff->save();
	                
	    //             break;
	    //         }
	    //     }
    	// }
    	// return back();

    	$data['orderDe'] = OrderDetail::where('orderDe_aff_id', $id)->paginate(8);
	    return view('backend.affiliate_detail', $data);
    }
}
