<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')|| Admin</title>
	<base href="{{asset('public/layout/backend')}}/">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">


</head>
<body>
	<div class="masterError">
		<div class="masterErrorContent">
			@include('errors.note')
			
		</div>
		
	</div>
	<header class="container_fluid">
		<div class="row">
			<div class=" col-md-4 col-sm-6 col-xs-12">
				<div class="headerLogo">
					<a href="{{asset('admin')}}">
						<img src="img/logo cedu.png">
					</a>
					
				</div>
			</div>
			<div class="col-md-8 col-sm-6 col-xs-12">
				<div class="headerAccount">
					<a href="" class="headerAccountName">
						<span class="glyphicon glyphicon-user"></span>
						{{Auth::user()->email}}
					</a>
					<a href="{{asset('logout')}}" class="headerAccountLogout">
						<span class="glyphicon glyphicon-log-out"></span>
						Đăng xuất
					</a>
				</div>
			</div>
			
		</div>
	</header>
	<nav>
		<ul>
			<li>
				<a href="{{asset('admin/account/edit/'.Auth::user()->id)}}" class="navUser">
					<img src="{{asset('lib/storage/app/avatar/'.Auth::user()->img)}}">
					{{Auth::user()->name}}
				</a>
			</li>
			<li>
				<a href="{{asset('admin/')}}" class="navAccount">
					Thống kê
				</a>
			</li>
			@if(Auth::user()->level != 3)
			<li>
				<a href="{{asset('admin/account')}}" class="navAccount">
					Tài khoản
				</a>
			</li>
			@endif
			@if(Auth::user()->level != 3)
			<li>
				<a href="{{asset('admin/affiliate')}}" class="navAccount">
					Cộng tác viên
				</a>
			</li>
			<li>
				<a href="{{asset('admin/teacher')}}" class="navAccount">
					Giáo viên
				</a>
			</li>
			@endif
			@if(Auth::user()->level != 3)
			<li>
				<a href="{{asset('admin/group')}}" class="navAccount">
					Lĩnh vực
				</a>
			</li>
			@endif
			<li>
				<a href="{{asset('admin/course')}}" class="navAccount">
					Khóa học
				</a>
			</li>
			
			@if(Auth::user()->level == 3)
			<li>
				<a href="{{asset('admin/teacher/detail/'.Auth::user()->id)}}" class="navAccount">
					Hồ xơ
				</a>
			</li>
			@endif
			@if(Auth::user()->level != 3)
			<li>
				<a href="{{asset('admin/order')}}" class="navAccount">
					Đơn hàng
				</a>
			</li>
			
			<li>
				<a href="{{asset('admin/banner')}}" class="navAccount">
					Banner
				</a>
			</li>
			
			<li>
				<a href="{{asset('admin/news')}}" class="navAccount">
					Tin tức
				</a>
			</li>
			
			<li>
				<a href="{{asset('admin/doc')}}" class="navAccount">
					Tài liệu
				</a>
			</li>
			<li>
				<a href="{{asset('admin/about')}}" class="navAccount">
					Giới thiệu
				</a>
			</li>
			@endif
		</ul>
	</nav>
	<main>
		@yield('main')
	</main>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/editCom.js"></script>
	<script type="text/javascript">
		function changeImg(input){
	        //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
	        if(input.files && input.files[0]){
	            var reader = new FileReader();
	            //Sự kiện file đã được load vào website
	            reader.onload = function(e){
	                //Thay đổi đường dẫn ảnh
	                $('#avatar').attr('src',e.target.result);
	            }
	            reader.readAsDataURL(input.files[0]);
	        }
	    }
	    $(document).ready(function() {
	        $('#avatar').click(function(){
	            $('#img').click();
	        });
	        
	    });
	</script>
	@yield('script')
</body>
</html>