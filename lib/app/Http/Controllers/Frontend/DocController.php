<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupDoc;
use App\Models\Doc;
use Auth;

class DocController extends Controller
{
    public function getList(){
    	$data['group'] = Group::all();
    	return view('frontend.doc',$data);
    }
    public function getGroup($gr_slug){
    	$group = Group::where('gr_slug',$gr_slug)->first();
    	$grdoc_slug = GroupDoc::where('grdoc_gr_id',$group->gr_id)->first()->grdoc_slug;
    	
    	return redirect('doc/detail/'.$gr_slug.'/'.$grdoc_slug);
    }
    public function getDoc($gr_slug, $grdoc_slug){
    	$group = Group::where('gr_slug',$gr_slug)->first();

    	if ($grdoc_slug == 'all') {
    		$grdoc = GroupDoc::where('grdoc_gr_id',$group->gr_id)->get();
    		$data['doc_list']=array();
    		$count = 0;
    		for($i = 0; $i < $grdoc->count(); $i++){
    			for($j = 0; $j < $grdoc[$i]->doc->count(); $j++){
    				array_push($data['doc_list'],$grdoc[$i]->doc[$j]);
    			}
    		}
    	}
    	else{
    		$grdoc = GroupDoc::where('grdoc_slug',$grdoc_slug)->first();
    		$data['doc_list'] = Doc::where('doc_grdoc_id', $grdoc->grdoc_id)->get();
    	}
    	$data['gr_name'] = $group->gr_name;
    	$data['grdoc_list'] = GroupDoc::where('grdoc_gr_id',$group->gr_id)->get();
    	
    	return view('frontend.docdetail',$data);
    }

}
