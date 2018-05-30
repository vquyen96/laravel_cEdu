@extends('backend.master')
@section('title','Home')
@section('main')


<script type="text/javascript" src="{{asset('public/ckeditor/ckeditor.js')}}"></script>

<div>
	<div class="dashboard">
		<div class="item student">
			<a href="{{ asset('admin/course/student/'.$item->cou_id)}}" class="icon red">
				<i class="fa fa-users" aria-hidden="true"></i>
			</a>
			<div class="content">
				<p>Số học viên</p>
				{{$item->orderDe->count()}}
			</div>
		</div>
		<div class="item rating">
			<a href="{{ asset('admin/rating/detail/'.$item->cou_id) }}" class="icon yell">
				<i class="fa fa-star" aria-hidden="true"></i>
			</a>
			<div class="content">
				<p>Đánh giá</p>
				{{$item->cou_star}}
			</div>
		</div>
		<div class="item lesson">
			<a href="{{ asset('admin/course/detail/'.$item->cou_id) }}" class="icon blue">
				<i class="fa fa-book" aria-hidden="true"></i>
			</a>
			<div class="content">
				<p>Số bài học</p>
				{{$lesson}}
			</div>
		</div>
		<div class="item earnings">
			<a href="{{ asset('admin') }}" class="icon green">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i>
			</a>
			<div class="content">
				<p>Thu Nhập</p>
				{{number_format($item->orderDe->count()*$item->cou_price,0,',','.')}}
			</div>
		</div>
	</div>
	<div class="bodyHeader">
		<span class="title">Chỉnh sửa khóa học</span>
		<a href="{{asset('admin/course/detail/'.$item->cou_id)}}" class="btn btn-success">Thêm bài giảng</a>
		<a href="{{asset('admin/course/delete/'.$item->cou_id)}}" class="btnRemove" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')">
			<i class="fa fa-trash" aria-hidden="true"></i>
		</a>
	</div>
	<div>
		<form method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					    <label>Tên khóa học</label>
					    <input type="text" class="form-control" name="cou_name" value="{{$item->cou_name}}" placeholder="Tên của bạn" required>
					</div>
					<div class="form-group">
					    <label>Giá</label>
					    <input type="text" class="form-control" name="cou_price" value="{{$item->cou_price}}" placeholder="Email" required>
					</div>
					@if(Auth::user()->level != 3)
					<div class="form-group">
					    <label>Sale</label>
					    <input type="text" class="form-control" name="cou_sale" placeholder="VD: 15%" value="{{$item->cou_sale}}">
					</div>
					@else
						<b>Sale : {{$item->cou_sale}}%</b>
					@endif
				  	<div class="form-group">
				    	<label>Cấp độ</label>
				    	<select class="form-control" name="cou_level">
				    		<option @if($item->cou_level == "all") selected @endif value="all">Tất cả</option>
				    		<option @if($item->cou_level == "basic") selected @endif value="basic">Cơ bản</option>
				    		<option @if($item->cou_level == "master") selected @endif value="master">Chuyên nghiệp</option>
				    	</select>
				    	
				  	</div>
				  	@if(Auth::user()->level != 3)
				  	<div class="form-group">
				    	<label>Số học viên</label>
				    	<input type="number" class="form-control" name="cou_student" value="{{$item->cou_student}}">
				  	</div>
				  	@else
				  	<b>Sỗ học viên : {{$item->cou_student}}</b>
				  	@endif
				  	<div class="form-group">
				    	<label>Tag</label>
				    	<input type="text" class="form-control" name="cou_tag" required placeholder="VD: #Ngoại ngữ #Giao tiếp-+
				    	" value="{{$item->cou_tag}}">
				  	</div>
				  	<div class="form-group">
				    	<label>Lĩnh vực</label>
				    	<select class="form-control" name="cou_gr_id">
				    		@foreach($group as $gr)
					    	<option value="{{$gr->gr_id}}" @if($gr->gr_id == $item->cou_gr_id) selected @endif>{{$gr->gr_name}}</option>
					    	@endforeach
					    </select>
				  	</div>
				  	
				  	@if(Auth::user()->level != 3)
				  	<div class="form-group">
				    	<label>Giáo viên</label>
				    	<select class="form-control" name="cou_tea_id">
				    		@foreach($tea as $teacher)
					    	<option value="{{$teacher->id}}" @if($teacher->id == $item->cou_tea_id) selected @endif>{{$teacher->name}}</option>
					    	@endforeach
					    </select>
				  	</div>
				  	@endif
				</div>

				<div class="form-group col-md-6">
					<label>Ảnh</label>
					<input id="img" type="file" name="img" class="cssInput " onchange="changeImg(this)" style="display: none!important;">
	                <img style="cursor: pointer;" id="avatar" class="cssInput thumbnail" width="100%" src="{{asset('lib/storage/app/course/'.$item->cou_img)}}">
				</div>
			</div>
			
			
			<div class="form-group">
					<label>Chi tiết</label>
					<textarea class="form-control ckeditor" rows="5" name="content">{{$item->cou_content}}</textarea>
					<script type="text/javascript">
						var editor = CKEDITOR.replace('content',{
							language:'vi',
							filebrowserImageBrowseUrl: '../../ckfinder/ckfinder.html?Type=Images',
							filebrowserFlashBrowseUrl: '../../ckfinder/ckfinder.html?Type=Flash',
							filebrowserImageUploadUrl: '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
							filebrowserFlashUploadUrl: '../../public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
						});
					</script>

				</div>
		  	<div class="form-group">
		    	
		    	<input type="submit" class="btn btn-success" value="Thay đổi">
		    	<a href="{{asset('admin/course')}}" class="btn btn-warning"> Quay lại</a>
		  	</div>
		  	{{csrf_field()}}
		</form>
	</div>
</div>

@stop