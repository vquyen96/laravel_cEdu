@extends('frontend.master')
@section('title','Tài liệu')
@section('main')
<link rel="stylesheet" type="text/css" href="css/doc.css">

<div>
	<div class="mainHead">
		<div class="mainHeadLine"></div>
		<div class="mainHeadTitle">
			<h3>Góc chia sẻ tài liệu</h3>
		</div>
	</div>
	<div class="container mainBody">
		<div class="row">
			@foreach($group as $item)
			<div class="col-md-3 col-sm-3 ">
				<a href="{{asset('doc/detail/'.$item->gr_slug)}}" class="docItem">
					<div class="docItemBorder">
						<div class="docItemImg">
							<img src="{{asset('lib/storage/app/group/'.$item->gr_img)}}">
						</div>
						<div class="docItemContent">
							{{$item->gr_name}}
						</div>
					</div>
				</a>
			
			</div>
			@endforeach		
		</div>
	</div>
</div>
@stop
@section('script')
<script type="text/javascript" src="js/doc.js"></script>
@stop

