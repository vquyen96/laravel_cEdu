<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupDoc;
use App\Models\Doc;
use Auth;


class GroupDocController extends Controller
{
    public function getGroup(){
    	$data['group'] = Group::all();

    	return view('backend.doc_group',$data);
    }
    public function getGroupDoc($group){
    	$group = Group::find($group);
    	$data['grdoc'] = GroupDoc::where('grdoc_gr_id',$group->gr_id)->paginate(8);

    	return view('backend.doc_groupdoc',$data);
    }
    public function postGroupDoc(Request $request, $group){
    	$grdoc = new GroupDoc;
    	$grdoc->grdoc_name = $request->name;
    	$grdoc->grdoc_slug = str_slug($request->name);
    	$grdoc->grdoc_gr_id = $group;
    	$grdoc->save();

    	return back()->with('success','Tạo thành công nhóm tài liệu');
    }
    public function getEditGroupDoc($group, $groupdoc){
    	
		$group = Group::find($group);
		$data['edit_gr'] = GroupDoc::find($groupdoc);
    	$data['grdoc'] = GroupDoc::where('grdoc_gr_id',$group->gr_id)->paginate(8);
    	return view('backend.edit_groupdoc',$data);
    }
    public function postEditGroupDoc(Request $request, $group, $groupdoc){
    	$group = Group::find($group);
		$grdoc = GroupDoc::find($groupdoc);
    	$grdoc->grdoc_name = $request->name;
    	$grdoc->grdoc_slug = str_slug($request->name);
    	$grdoc->grdoc_gr_id = $group->gr_id;
    	$grdoc->save();

    	return back()->with('success','Sửa thành công nhóm tài liệu');
    }
    public function getDeleteGroupDoc($group, $groupdoc){
        GroupDoc::destroy($groupdoc);
    	return back()->with('success','Xóa Thành Công !');
    }


    public function getDoc($group, $groupdoc){
        $data['doc'] = Doc::where('doc_grdoc_id', $groupdoc)->paginate(8);
        return view('backend.doc',$data);
    }
    public function postDoc(Request $request, $group, $groupdoc){
        $doc = new Doc;
        $doc->doc_name = $request->name;
        $doc->doc_grdoc_id = $groupdoc;
        $doc->doc_acc_id = Auth::user()->id;
        $filedoc = $request->file('file');
        if ($request->hasFile('file')) {
            $filename = time() . '.' . $filedoc->getClientOriginalExtension();
            $doc->doc_link = $filename;
            $request->file->storeAs('doc',$filename);
            $doc->save();
            return back()->with('success','Thêm tài liệu thành công');
        }
        else{
            return back()->with('error','File bị lỗi');
        }
    }
    public function getEditDoc($group, $groupdoc, $doc){
        $data['doc'] = Doc::where('doc_grdoc_id', $groupdoc)->paginate(8);
        $data['edit_doc'] = Doc::find($doc);
        return view('backend.editdoc',$data);
    }

    public function postEditDoc(Request $request, $group, $groupdoc, $doc){
        $data['doc'] = Doc::where('doc_grdoc_id', $groupdoc)->paginate(8);
        $doc = Doc::find($doc);
        $doc->doc_name = $request->name;
        $doc->doc_grdoc_id = $groupdoc;
        $doc->doc_acc_id = Auth::user()->id;
        $filedoc = $request->file('file');
        if ($request->hasFile('file')) {
            $filename = time() . '.' . $filedoc->getClientOriginalExtension();
            $doc->doc_link = $filename;
            $request->file->storeAs('doc',$filename);
            $doc->save();
            return back()->with('success','Sửa tài liệu thành công');
        }
        else{
            $doc->save();
            return back()->with('success','Sửa tên tài liệu thành công');
        }
    }

    public function getDeleteDoc($doc){
        Doc::destroy($doc);
        return back()->with('success','Xóa thành công');
    }

}
