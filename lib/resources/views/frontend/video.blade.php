@extends('frontend.master')
@section('title',$course->cou_name)
@section('main')
<link rel="stylesheet" type="text/css" href="css/video.css">
<div class="videoMain">
	<link href="http://vjs.zencdn.net/6.6.3/video-js.css" rel="stylesheet">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-9 col-sm-9">
				<div class="videoCourse">
					<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
					<video id="my-video" class="video-js" controls preload="auto"
				  poster="" data-setup="{}" autoplay src="">
					    <source src="{{ asset('lib/public/uploads/'.$video) }}" type='video/webm'>
					    <p class="vjs-no-js">
					      To view this video please enable JavaScript, and consider upgrading to a web browser that
					      <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
					    </p>
				 	</video>
				</div>
				<div id="link" style="display: none;">
					{{$video}}
				</div>
			</div>
			<div class="col-md-3 col-sm-3 videoMainItem">
				<?php $videoCount = 0 ?>
					@foreach($course->part as $item)
						<h4>{{$item->part_name}}</h4>
						@foreach($item->lesson as $itemTiny)	
						<a href="{{asset('courses/detail/'.$course->cou_slug.'.html/video/'.$videoCount)}}">
							<div class="videoItem">
								<div class="videoIctemBtnPlay">
									<i class="fa fa-play-circle-o" aria-hidden="true"></i>
								</div>
								<div class="videoItemTitle">
									{{$itemTiny->les_name}}
								</div>
								<div class="videoItemTime">
									{{$itemTiny->les_video_duration}}
								</div>
							</div>
						</a>
						<?php $videoCount++ ?>
						@endforeach
					@endforeach
			</div>
		</div>
		
	</div>
  	

</div>

@stop
@section('script')
<script src="http://vjs.zencdn.net/6.6.3/video.js"></script>
<script type="text/javascript" src="js/video.js"></script>
{{-- <script type="text/javascript">
	var myVideoPlayer = document.getElementById('my-video');
	
	var URL = window.URL || window.webkitURL;
	var video = document.getElementsByTagName('video')[0];
	var vid = document.getElementsByTagName('textarea');
	$('#video').attr('style','display: none');
	var url = '{{asset('lib/public/uploads')}}/';
	url += '{{$video}}';
	console.log(url);
	var xhr = new XMLHttpRequest();
	xhr.open('GET', url, true);
	xhr.responseType = 'blob';
	xhr.onload = function(e) {
	  	if (this.status == 200) {
	  	  	var myObject = this.response;
	  	  	var url = URL.createObjectURL(myObject);
	  	  	console.log(url);
	  	  	video.src = url;
	  	}
	};
	xhr.send();
	console.log(xhr);
	function onChange() {
	    var fileItem = document.getElementById('fileItem');
	    var files = fileItem.files;
	    var file = files[0];
	    $('#video').show();
	   	var url = URL.createObjectURL(file);
	   	video.src = url;
	    video.load();
	    video.onloadeddata = function() {
	    	URL.revokeObjectURL(this.src); 
	        video.play();
	        $('#duration').val(video.duration);
	        console.log(video.duration);
	    }
	}
</script> --}}

@stop