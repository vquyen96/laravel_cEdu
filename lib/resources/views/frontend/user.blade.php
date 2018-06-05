@extends('frontend.master')
@section('title','Bạn')
@section('main')
<link rel="stylesheet" type="text/css" href="css/user.css">
<script>
window.onload = function () {

var chartSpLine_month = new CanvasJS.Chart("chartSpLine_month", {
	animationEnabled: true,  
	title:{
		text: "Doanh thu theo Tháng"
	},
	axisY: {
		title: "Doanh thu theo VNĐ",
		valueFormatString: "",
		suffix: "",
		prefix: ""
	},
	axisX: {
		title: "",
		valueFormatString: "DD/MM",
		suffix: "",
		prefix: ""
	},
	data: [{
		type: "splineArea",
		color: "rgba(40, 77, 169, 0.7)",
		markerSize: 5,
		xValueFormatString: "DD/MM/YYYY",
		yValueFormatString: "",
		dataPoints: [
			<?php $date= new DateTime(); ?>
			@for ($i = 0; $i < 30; $i++)
				<?php $count = 0 ?>
				@foreach ($orderDe as $item)
					@if (date_format($item->order->created_at,"Y-m-d") == date_format($date,"Y-m-d") && $item->order->ord_status == 0)
						<?php $count += $item->orderDe_price?>
					@endif
				@endforeach
				{ x: new Date('{{date_format($date,"Y-m-d")}}'), y: {{$count}} },
				<?php date_add($date,date_interval_create_from_date_string(" -1 days"));?>
			@endfor
		]
	}]
	});
chartSpLine_month.render();
var chartSpLine_year = new CanvasJS.Chart("chartSpLine_year", {
	animationEnabled: true,  
	title:{
		text: "Doanh thu theo Năm"
	},
	axisY: {
		title: "Doanh thu theo VNĐ",
		valueFormatString: "",
		suffix: "",
		prefix: ""
	},
	axisX: {
		title: "",
		valueFormatString: "MM/YYYY",
		suffix: "",
		prefix: ""
	},
	data: [{
		type: "splineArea",
		color: "rgba(40, 77, 169, 0.7)",
		markerSize: 5,
		xValueFormatString: "MM/YYYY",
		yValueFormatString: "",
		dataPoints: [
			<?php $date= new DateTime(); ?>
			@for ($i = 0; $i < 12; $i++)
				<?php $count = 0 ?>
				@foreach ($orderDe as $item)
					@if (date_format($item->order->created_at,"Y-m") == date_format($date,"Y-m") && $item->order->ord_status == 0)
						<?php $count += $item->orderDe_price?>
					@endif
				@endforeach
				{ x: new Date('{{date_format($date,"Y-m-d")}}'), y: {{$count}} },
				<?php date_add($date,date_interval_create_from_date_string(" -1 months"));?>
			@endfor
		]
	}]
	});
chartSpLine_year.render();
var chartLine = new CanvasJS.Chart("chartline", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Biểu đồ cộng tác"
	},
	axisX:{
		valueFormatString: "DD MMM",
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	axisY: {
		title: "Số học viên mua khóa học",
		crosshair: {
			enabled: true
		}
	},
	toolTip:{
		shared:true
	},  
	legend:{
		cursor:"pointer",
		verticalAlign: "bottom",
		horizontalAlign: "left",
		dockInsidePlotArea: true,
		itemclick: toogleDataSeries
	},
	data: [{
		type: "line",
		showInLegend: true,
		name: "Người đặt mua",
		markerType: "square",
		xValueFormatString: "DD MMM, YYYY",
		color: "#F08080",
		dataPoints: [
			<?php $date= new DateTime(); ?>
			@for ($i = 0; $i < 30; $i++)
				<?php $count = 0 ?>
				@foreach ($orderDe as $item)
					@if (date_format($item->order->created_at,"Y-m-d") == date_format($date,"Y-m-d"))
						<?php $count++?>
					@endif
				@endforeach
				{ x: new Date('{{date_format($date,"Y-m-d")}}'), y: {{$count}} },
				<?php date_add($date,date_interval_create_from_date_string(" -1 days"));?>
			@endfor
		]
	},
	{
		type: "line",
		showInLegend: true,
		name: "Người thanh toán",
		lineDashType: "dash",
		dataPoints: [
			<?php $date= new DateTime(); ?>
			@for ($i = 0; $i < 30; $i++)
				<?php $count = 0 ?>
				@foreach ($orderDe as $item)
					@if (date_format($item->order->created_at,"Y-m-d") == date_format($date,"Y-m-d") && $item->order->ord_status == 0)
						<?php $count++?>
					@endif
				@endforeach
				{ x: new Date('{{date_format($date,"Y-m-d")}}'), y: {{$count}} },
				<?php date_add($date,date_interval_create_from_date_string(" -1 days"));?>
			@endfor
		]
	}]
});
chartLine.render();
var chart = new CanvasJS.Chart("chartCỉcle", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: "Tỷ lệ các loại khóa học bán được"
	},
	data: [{
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}%",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}%",
		dataPoints: [
			<?php $total = $orderDe->count();?>
		 	@for ($i = 0; $i < $group->count(); $i++)
		 		<?php $count = 0;?>
	 			@foreach ($orderDe as $item)
	 				@if ($item->course->group->gr_id == $group[$i]->gr_id )
	 					<?php $count++ ?>
	 				@endif
	 			@endforeach
	 			@if ($count != 0)
	 				{ y: {{($count/$total)*100}}, label: "{{$group[$i]->gr_name}}" },
	 			@endif
	 		@endfor	
		]
	}]
});
chart.render();





function toogleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
@foreach ($orderDe as $item)
	<?php $date= new DateTime();date_add($date,date_interval_create_from_date_string(" -10 days"));?>
	console.log('{{date_format($date,"Y, m,d")}}');
@endforeach
}
</script>
<div class="container user">
	<?php $total = $orderDe->count(); $count = 0?>

		 	@foreach ($orderDe as $item)
		 		<?php $group_name = "oke";?>
		 		@if ($item->course->group->gr_name == $group_name)
		 			<?php $count++ ?>
		 		@else
		 			
		 			@if ($orderDe[$item->index - 1] != null)
		 				{{$count}}
		 			@endif
		 			<?php $group_name =  $item->course->group->gr_name; $count = 0;?>
		 		@endif
		 	@endforeach
	@if(Auth::user()->level == 5)
	<div class="row ">
		<div class="col-md-12">
			<div class="chart chartSpLine">
				<div>
					<div class="btnChangeChart">
						1 năm >>>
					</div>
					<div id="chartSpLine_month"></div>
					<div id="chartSpLine_year"></div>
				</div>
					
			</div>
		</div>
		<div class="col-md-6">
			<div class="chart"><div id="chartCỉcle" style="height: 370px; width: 100%; margin: 0px auto;"></div></div>
		</div>
		<div class="col-md-6">
			<div class="chart">
				<div id="chartline" style="height: 370px; width: auto; margin: 0px auto;"></div>
			</div>
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="userTable">
				<h3>Danh sách khóa học đã bán được</h3>
					
			 		
				 		
				 		
				 	
				<table class="table table-hover">
					<tr>
						<th>Tên học sinh</th>
						<th>Ảnh khóa học</th>
						<th>Tên khóa học</th>
						<th>Giá</th>
						<th>Trạng thái</th>
						<th>Thời gian</th>
					</tr>
					@foreach($orderDe as $item)
					<tr>
						<td>
							{{$item->order->acc->name}}
						</td>	
						<td class="tableCourseImg">
							<img class="" src="{{asset('lib/storage/app/course/'.$item->course->cou_img)}}">
						</td>
						<td class="tableTD">
							{{$item->course->cou_name}}
						</td>
						<td class="tableTD">
							{{number_format($item->course->cou_price,0,',','.')}} VND
						</td>
						<td>@if($item->order->ord_status == 0) Xong @else Chưa @endif</td>
						<td> 
							{{$item->created_at}}
						</td>
					</tr>
					@endforeach
				</table>
			</div>
				
			{{$orderDe->links()}}
		</div>
	</div>
	@endif
	<div class="row userCourse">
		@foreach($user->order as $order)
			@foreach ($order->orderDe as $item)
				@if ($item->code != null)
					<div class="col-md-3 col-sm-4 col-xs-6">
						<a href="{{asset('courses/detail/'.$item->course->cou_slug.'.html')}}" class="courseItem">
							<div class="courseImg">
								<img src="{{asset('lib/storage/app/course/'.$item->course->cou_img)}}">

									@if($item->code->code_status == 0)
										<div class="courseWait">
											<div class="courseWaitContent">
												Đang chờ kích hoạt
											</div>
										</div>
									@endif
								
									
							</div>
							<div class="courseContent">
								<h4>{{cut_string($item->course->cou_name,60)}}</h4>
								<div class="courseTeacher">
									<img src="{{asset('lib/storage/app/avatar/'.$item->course->tea->img)}}">
									<span>{{$item->course->tea->name}}</span>
								</div>
							</div>
						</a>
					</div>
				@endif
			@endforeach
				
		@endforeach
	</div>
	<div class="row userDetail">
		<div class="col-md-4 userAva">
			<div class="userAvaImg">
				<img style="cursor: pointer;" id="avatarImg" class="cssInput thumbnail tableImgAvatar" width="s%" src="{{asset('lib/storage/app/avatar/'.Auth::user()->img)}}">
				<div class="userAvaHover" id="avatar">
	        		Thay đổi ảnh
	        	</div>
			</div>
        	
        	
		</div>
		<div class="col-md-8 userInfo">
			<div class="userInfoTitle">
				<h4>Thông tin cơ bản</h4>
				<form method="post" enctype="multipart/form-data">
					<div class="form-group row">
					    <label class="formName col-md-3 col-xs-5">Tên của bạn</label>
					    <div class="inputGr col-md-9 col-xs-7">
					    	<input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" placeholder="Tên của bạn" required>
					    </div>
					    
					</div>
					<div class="form-group row">
					    <label class="formName  col-md-3 col-xs-5">Nghề nghiệp</label>
					    <div class="inputGr col-md-9 col-xs-7">
					    	<input type="text" class="form-control" name="job" value="{{Auth::user()->job}}" placeholder="Nghề nghiệp" required>
					    </div>
					</div>
				  	{{-- <div class="form-group row">
				    	<label class="formName  col-md-3 col-xs-5">Mật khẩu</label>
				    	<div class="inputGr col-md-9 col-xs-7">

				    		<input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
				    	</div>
				  	</div> --}}
		  			<input id="img" type="file" name="img" class="cssInput " onchange="changeImg(this)" style="display: none!important;">
					<div class="form-group row">
						<label  class="formName col-md-3 col-xs-5">Giới thiệu bản thân</label>
						<div class="inputGr col-md-9 col-xs-7">
							<textarea class="form-control ckeditor" rows="5" name="content" placeholder="Mục tiêu sống">{!! Auth::user()->content!!}</textarea>
						</div>
					</div>
				  	<div class="form-group row">
				    	<input type="submit" class="btn btn-warning" value="Lưu thay đổi">
				  	</div>
				  	{{csrf_field()}}
				</form>
			</div>
		</div>
	</div>
	
</div>


@stop

@section('script')
<script type="text/javascript" src="js/user.js"></script>
<script type="text/javascript" src="js/canvasjs.min.js"></script>

@stop