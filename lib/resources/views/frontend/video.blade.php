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
				  poster="" data-setup="{}" autoplay>

					    <source src="{{asset('lib/public/uploads/'.$video)}}" type='video/mp4'>
					    <!-- <source src="MY_VIDEO.webm" type='video/webm'> -->
					    <p class="vjs-no-js">
					      To view this video please enable JavaScript, and consider upgrading to a web browser that
					      <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
					    </p>
				 	</video>
				</div>
					
			</div>
			<div class="col-md-3 col-sm-3 videoMainItem">
				<?php $video = 0 ?>
					@foreach($course->part as $item)
						<h4>{{$item->part_name}}</h4>
						{{-- {{$item->lesson->count()}} --}}
						@foreach($item->lesson as $itemTiny)	
						<a href="{{asset('courses/detail/'.$course->cou_slug.'.html/video/'.$video)}}">
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
						<?php $video++ ?>
						@endforeach
					@endforeach
			</div>
		</div>
		
	</div>
  <!-- If you'd like to support IE8 -->
  	

</div>

@stop
@section('script')
<script src="http://vjs.zencdn.net/6.6.3/video.js"></script>
<script type="text/javascript" src="js/video.js"></script>
<script type="text/javascript">
	var myVideoPlayer = document.getElementById('my-video');
	console.log(myVideoPlayer.duration);
	
</script>

@stop