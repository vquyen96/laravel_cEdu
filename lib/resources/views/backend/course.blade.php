@extends('backend.master')
@section('title','Home')
@section('main')


<link rel="stylesheet" type="text/css" href="css/course.css">
<div>
	<div>
		<h3 class="col-md-6 col-sm-6 col-xs-12">Quản lý khóa học</h3>
		<div class="col-md-6 col-sm-6 col-xs-12 accountBtnAdd">
			<a href="{{asset('admin/course/add')}}" class="btn btn-success"> 
				<span class="glyphicon glyphicon-plus"></span>
				Thêm mới
			</a>
		</div>
	</div>
	<div>
		<table class="table table-hover">
			<tr>
				<th>Hình ảnh</th>
				<th>Tên</th>
				<th>Giá</th>
				<th class="tableOption">Tùy Chọn</th>
			</tr>
			@foreach($items as $item)
			<tr>	
				<td class="tableCourseImg">
					<a href="{{asset('admin/course/edit/'.$item->cou_id)}}">
						<img class="" src="{{asset('lib/storage/app/course/'.$item->cou_img)}}">
					</a>
				</td>
				<td class="tableTD">
					<a href="{{asset('admin/course/edit/'.$item->cou_id)}}">
						{{$item->cou_name}}
					</a>
				</td>
				<td class="tableTD">
					<a href="{{asset('admin/course/edit/'.$item->cou_id)}}">
						{{number_format($item->cou_price,0,',','.')}} VND
					</a>
				</td>
				
				<td> 
					<a href="{{asset('admin/course/edit/'.$item->cou_id)}}" class="btn btn-primary">Chi tiết</a>
				{{-- 
					<a href="{{asset('admin/course/delete/'.$item->cou_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" class="btn btn-danger">Xóa</a>
					 --}}
					
				</td>
			</tr>
			@endforeach
		</table>
		{{$items->links()}}
	</div>
</div>

@stop