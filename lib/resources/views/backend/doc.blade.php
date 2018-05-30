@extends('backend.master')
@section('title','Tài liệu')
@section('main')


<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div>
				<h3>Thêm tài liệu</h3>
			</div>
			<div>
				<form method="post" enctype="multipart/form-data">
				
					<div class="form-group">
					    <label>Tên tài liệu</label>
					    <input type="text" class="form-control" name="name" placeholder="Tên của tài liệu" required>
					</div>
					<div class="form-group">
					    <label>Tải lên</label>
					    <input type="file" class="form-control" name="file" required>
					</div>

				  	<div class="form-group">
				    	<input type="submit" class="btn btn-success" value="Thêm mới">
				    	<a href="{{asset('admin/doc/get_group/'.Request::segment(4))}}" class="btn btn-warning"> Quay lại</a>
				  	</div>
				  	{{csrf_field()}}
				</form>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div>
				<h3>Danh sách lĩnh vực</h3>
			</div>
			<table class="table table-hover">
				<tr>
					<th>Tên</th>
					<th>Tùy chọn</th>
				</tr>
				@foreach($doc as $item)
				<tr>	
					<td class="tableTD">
						{{$item->doc_name}}
					</td>
					<td >
						<a href="{{asset('admin/doc/edit_doc/'.Request::segment(4).'/'.$item->doc_grdoc_id.'/'.$item->doc_id)}}" class="btn btn-primary">Sửa</a>
						<a href="{{asset('admin/doc/delete_group/'.$item->doc_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" class="btn btn-danger">Xóa</a>
					</td>
				</tr>
				@endforeach
			</table>
			{{$doc->links()}}
		</div>
	</div>
</div>

@stop