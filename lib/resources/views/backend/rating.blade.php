@extends('backend.master')
@section('title','Home')
@section('main')



<div>
	<div>
		<h3 class="">Đánh giá khóa học</h3>
		<div class="accountBtnAdd">
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
				<th>Sao</th>
				<th>Cập nhật</th>
			</tr>
			@foreach($items as $item)
			<tr>	
				<td class="tableCourseImg">
					<a href="{{asset('admin/rating/detail/'.$item->cou_id)}}">
						<img class="" src="{{asset('lib/storage/app/course/'.$item->cou_img)}}">
					</a>
					
				</td>
				<td class="tableTD">
					<a href="{{asset('admin/rating/detail/'.$item->cou_id)}}">
						{{cut_string($item->cou_name,30)}}
					</a>
				</td>
				<td class="tableTD">
					<a href="{{asset('admin/rating/detail/'.$item->cou_id)}}">
						{{number_format($item->cou_price,0,',','.')}} VND
					</a>
				</td>
				<td class="tableTD">
					<a href="{{asset('admin/rating/detail/'.$item->cou_id)}}">
						@for($i=0;$i<5;$i++)
							@if(FLOOR($item->cou_star) > $i)
								<i class="fa fa-star starActive" aria-hidden="true"></i>
							@else
								<i class="fa fa-star" aria-hidden="true"></i>
							@endif
						@endfor
					</a>
						
				</td>
				<td>
					<a href="{{asset('admin/rating/update/'.$item->cou_id)}}" name="" class="btn btn-success">Cập nhật</a>
				</td>
			</tr>
			@endforeach
		</table>
		{{$items->links()}}
	</div>
</div>

@stop