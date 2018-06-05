<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>


	<base href="{{asset('public/layout/frontend')}}/">
	<link rel="shortcut icon" href="{{ asset('public/layout/frontend/img/BUT.png') }}">
	<meta charset="utf-8">

	<meta property="og:url" 		content="{{Request::url()}}" />

	
	<meta property="fb:app_id" 		content="1577563652342523" />
	 
	<meta property="og:title" 		content="@yield('fb_title')" />
	<meta property="og:description" content="@yield('fb_description')" />
    <meta property="og:image" 		content="@yield('fb_image')" />
    <meta property="og:image:type" 	content="image/png">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">


	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Serif:500|Roboto:400,500" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/master.css">
</head>
<body>
	<script>
	  // This is called with the results from from FB.getLoginStatus().
	  function statusChangeCallback(response) {
	    console.log('statusChangeCallback');
	    console.log(response);
	    // The response object is returned with a status field that lets the
	    // app know the current login status of the person.
	    // Full docs on the response object can be found in the documentation
	    // for FB.getLoginStatus().
	    if (response.status === 'connected') {
	      // Logged into your app and Facebook.
	      testAPI();
	    } else {
	      // The person is not logged into your app or we are unable to tell.
	      document.getElementById('status').innerHTML = 'Please log ' +
	        'into this app.';
	    }
	  }

	  // This function is called when someone finishes with the Login
	  // Button.  See the onlogin handler attached to it in the sample
	  // code below.
	  function checkLoginState() {
	    FB.getLoginStatus(function(response) {
	      statusChangeCallback(response);
	    });
	  }

	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '1577563652342523',
	      cookie     : true,  // enable cookies to allow the server to access 
	                          // the session
	      xfbml      : true,  // parse social plugins on this page
	      version    : 'v2.8' // use graph api version 2.8
	    });

	    // Now that we've initialized the JavaScript SDK, we call 
	    // FB.getLoginStatus().  This function gets the state of the
	    // person visiting this page and can return one of three states to
	    // the callback you provide.  They can be:
	    //
	    // 1. Logged into your app ('connected')
	    // 2. Logged into Facebook, but not your app ('not_authorized')
	    // 3. Not logged into Facebook and can't tell if they are logged into
	    //    your app or not.
	    //
	    // These three cases are handled in the callback function.

	    FB.getLoginStatus(function(response) {
	      statusChangeCallback(response);
	    });

	  };

	  // Load the SDK asynchronously
	  (function(d, s, id) {
	    var js, fjs = d.getElementsByTagName(s)[0];
	    if (d.getElementById(id)) return;
	    js = d.createElement(s); js.id = id;
	    js.src = "https://connect.facebook.net/en_US/sdk.js";
	    fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));

	  // Here we run a very simple test of the Graph API after login is
	  // successful.  See statusChangeCallback() for when this call is made.
	  function testAPI() {
	    console.log('Welcome!  Fetching your information.... ');
	    FB.api('/me', function(response) {
	      console.log('Successful login for: ' + response.name);
	      document.getElementById('status').innerHTML =
	        'Thanks for logging in, ' + response.name + '!';
	    });
	  }
	</script>

	<!--
	  Below we include the Login Button social plugin. This button uses
	  the JavaScript SDK to present a graphical Login button that triggers
	  the FB.login() function when clicked.
	-->

	{{-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
	</fb:login-button> --}}

	<div id="status">
	</div>
	{{-- <div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=1577563652342523&autoLogAppEvents=1';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script> --}}
	<div class="masterError">
		<div class="masterErrorContent">
			@include('errors.note')
		</div>
		
	</div>
	<input type="hidden" name="url" value="{{ asset('')}}">
        
	<header>
		<div class="headerHead">
			<div class="headerHeadLeft">
				{{-- <div class="headerHeadLeftItem">
					<i class="fa fa-envelope" aria-hidden="true"></i>
					<span>info@ceduvn.com</span>
				</div> --}}
				<div class="headerHeadLeftItem">
					<i class="fa fa-phone" aria-hidden="true"></i>
					<span>08.887.790.111 {{ Auth::check()}}</span>
				</div>	
				<a href="{{asset('code')}}" class="headerActiveCode">
					<i class="fa fa-unlock-alt" aria-hidden="true"></i>
					<span>Kích hoạt mã code</span>
				</a>	
			</div>
			<div class="headerHeadRight">
				<div class="headerHeadMenu">
					<ul>
						@if(Auth::check())
						<li>
							<a href="{{asset('logout')}}">
								<i class="fa fa-sign-out" aria-hidden="true"></i>
								<span>Đăng xuất</span>
							</a>
						</li>
						<li>
							<a href="{{asset('user')}}" class="headerTinyUser">
								<img src="{{asset('lib/storage/app/avatar/'.Auth::user()->img)}}">
								<span>{{cut_string_name(Auth::user()->name, 5)}}</span>
							</a>
						</li>
						@else
						<li>
							<a href="" data-toggle="modal" data-target=".modal-login">
								<i class="fa fa-user-circle-o" aria-hidden="true"></i>
								<span>Đăng nhập</span>
							</a>
						</li>
						@endif
						
						<li>
							<a href="">
								<i class="fa fa-bell" aria-hidden="true"></i>
								<span>Thông báo</span>
							</a>
							
						</li>
						<li>
							<a href="{{asset('cart/show')}}" class="cart">
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>
								<span>Giỏ hàng</span>
								@if(Cart::count() != 0)
									<div class="numOfCart">{{Cart::count()}}</div>
								@endif
							</a>
							
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="headerMenu">
			<div class="headerMenuLogo">
				<a href="{{asset('')}}">
					<img src="img/logo cedu.png">
				</a>
				
			</div>
			
			<div class="headerMenuNav">
				<ul>
					<li>
						<a href="{{asset('')}}" @if(Request::segment(1) == '') class="headerMenuNavActive" @endif>
							Trang chủ
							@if(Request::segment(1) == '')
								<div class="headerMenuBorderActive"></div>
							@endif
						</a>
					</li>
					<li class="headerMenuNavCourse">
						<a href="{{asset('courses')}}" @if(Request::segment(1) == 'courses') class="headerMenuNavActive" @endif>
							Khóa học
							@if(Request::segment(1) == 'courses')
								<div class="headerMenuBorderActive"></div>
							@endif
						</a>
						<ul class="headerMenuNavCourseItem">
							<div class="headerMenuNavCourseItemBorder">
								<img src="img/ic_menuc2.png">
							</div>
							@foreach($group as $item)
							<li><a href="{{asset('group/'.$item->gr_slug.'.html')}}">{{$item->gr_name}}</a></li>
							
							@endforeach
						</ul>
					</li>
					<li>
						<a href="{{asset('news')}}" @if(Request::segment(1) == 'news') class="headerMenuNavActive" @endif>
							Tin tức
							@if(Request::segment(1) == 'news')
								<div class="headerMenuBorderActive"></div>
							@endif
						</a>
					</li>
					<li>
						<a href="{{asset('partner')}}" @if(Request::segment(1) == 'partner') class="headerMenuNavActive" @endif>
							Trở thành đối tác
							@if(Request::segment(1) == 'partner')
								<div class="headerMenuBorderActive"></div>
							@endif
						</a>
					</li>
					<li>
						<a href="{{asset('doc')}}" @if(Request::segment(1) == 'doc') class="headerMenuNavActive" @endif>
							Tài liệu
							@if(Request::segment(1) == 'doc')
								<div class="headerMenuBorderActive"></div>
							@endif
						</a>
					</li>
					<li class="btnSearchHead">
						<a>
							<span class="glyphicon glyphicon-search"></span>
						</a>
					</li>
				</ul>
				<div class="headerSearch">
					<form method="get" action="{{asset('search/')}}">
						<input type="text" name="search" class="inputSearch" placeholder="Tìm kiếm">
						{{-- <input type="submit" name="btnSubmit" style="display: none;"> --}}
					</form>
						
					<span class="glyphicon glyphicon-search iconSearch"></span>
				</div>
			</div>
		</div>
	</header>
	<div class="headerTiny">
		<div class="headerTinyLeft">
			<ul>
				<li><a href="{{asset("/")}}">Trang chủ</a></li>
				<li><a href="{{asset("courses")}}">Khóa học</a></li>
				<li><a href="{{asset("news")}}">Tin tức</a></li>
				<li><a href="{{asset("partner")}}">Trở thành đối tác</a></li>
				<li><a href="{{asset("doc")}}">Tài liệu</a></li>
			</ul>
		</div>
		<div class="headerTinyRight">
			<ul>
				<li>
					<a href="{{ asset('code') }}">
						<div class="headerActiveCodeTiny">
							<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							<span>Kích hoạt mã code</span>
						</div>
					</a>
					
				</li>
				@if(Auth::check())
				<li>
					<a href="{{asset('logout')}}">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Đăng xuất</span>
					</a>
				</li>
				<li>
					<a  href="{{asset('user')}}" class="headerTinyUser">
						<img src="{{asset('lib/storage/app/avatar/'.Auth::user()->img)}}">
						<span>{{Auth::user()->name}}</span>
					</a>
				</li>
				@else
				<li>
					<a href="" data-toggle="modal" data-target=".modal-login">
						<i class="fa fa-user-circle-o" aria-hidden="true"></i>
						<span>Đăng nhập</span>
					</a>
				</li>
				@endif
				<li>
					<a href="">
						<i class="fa fa-bell" aria-hidden="true"></i>
					</a>
				</li>
				<li>
					<a href="{{asset('cart/show')}}" class="cart">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						@if(Cart::count() != 0)
							<div class="numOfCartTiny">{{Cart::count()}}</div>
						@endif
					</a>
				</li>
				<li class="btnSearchHeadTiny"> 
					<a >
						<i class="fa fa-search" aria-hidden="true"></i>
					</a>
					<div class="headerSearchTiny">
						<form method="get" action="{{asset('search/')}}">
							<input type="text" name="search" class="inputSearchTiny" placeholder="Tìm kiếm">
							{{-- <input type="submit" name="btnSubmit" style="display: none;"> --}}
						</form>
						
					</div>
				</li>

			</ul>
		</div>
	</div>
	<div class="btnScrollTop">
		<i class="fa fa-angle-double-up" aria-hidden="true"></i>
	</div>

	<!-- Large modal -->
	
	<div class="modal fade modal-login" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  	<div class="modal-dialog modal-md" role="document">
	    	<div class="modal-content">
		      	
			    <div class="modal-body">
			    	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <div class="loginMain">
						@include('errors.note')
						<div class="mainFormHead">
							<div class="mainFormHeadContent">

								<div class="mainFormHeadCircle">
									<img src="img/vongtron.png">
								</div>
								<div class="mainFormHeadLogo">
									<img src="img/logo.png">
								</div>
							</div>
							
						</div>
						<h3 class="modal-title formTitleLogin">Đăng nhập</h3>
			        	<h3 class="modal-title formTitleRegister">Đăng kí</h3>
						<form method="post" class="formModal" id="login" action="{{asset('loginHome')}}">
							<div class="">
								<div class="form-group">
									<input type="text" class="form-control" name="email" required placeholder="Email">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</div>
							</div>
							<div class="" >
								<div class="form-group">
									<input type="password" class="form-control" name="password" required placeholder="Mật khẩu">
									<i class="fa fa-lock" aria-hidden="true"></i>
								</div>
							</div>
							<div class="forgotPassword">
								<a href="">
									Bạn quên mật khẩu ?
								</a>
								
							</div>
							<div class="form-group">
								<input type="submit" name="" class="btn-Modal" value="Đăng Nhập">
							</div>
							<div class="formModalOr">
								<div class="borderLine"></div>
								<div class="content">hoặc</div>
								
							</div>
							<div class="connect">
								{{-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
								<a href="{{asset('redirect/facebook')}}" onlogin="checkLoginState();">
									<img src="img/Facebook-Icon-300x300.png">
								</a> --}}
								<a href="{{asset('redirect/google')}}">
									Login with Google
								</a>
								{{-- 
								<a href="">
									<img src="img/brasol.vn-logo-zalo-vector-logo-zalo-vector.png">
								</a> --}}
							</div>
							{{csrf_field()}}
						</form>
						<form method="post" class="formModal" id="register" action="{{asset('register')}}">
							<div class="">
								<div class="form-group">
									<input type="text" class="form-control" name="name" required placeholder="Tên của bạn">
									<i class="fa fa-user" aria-hidden="true"></i>
								</div>
							</div>
							<div class="">
								<div class="form-group">
									<input type="text" class="form-control" name="email" required placeholder="Email">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</div>
							</div>
							<div class="" >
								<div class="form-group">
									<input type="password" class="form-control" name="password" required placeholder="Mật khẩu">
									<i class="fa fa-lock" aria-hidden="true"></i>
								</div>
							</div>
							<div class="form-group">
								<input type="submit" name="" class="btn-Modal" value="Đăng kí">
							</div>
							<div class="formModalOr">
								<div class="borderLine"></div>
								<div class="content">hoặc</div>
								
							</div>
							<div class="connect">
								{{-- <a href="{{asset('redirect/facebook')}}">
									<img src="img/Facebook-Icon-300x300.png">
								</a> --}}
								<a href="{{asset('redirect/google')}}">
									Login with Google
									
								</a>
								{{-- <a href="">
									<img src="img/brasol.vn-logo-zalo-vector-logo-zalo-vector.png">
								</a>	 --}}
							</div>
							{{csrf_field()}}
						</form>
						<div class="formFooterLogin">
					        <span>Bạn chưa có tài khoản?</span>
					        <a >Đăng kí</a>
					    </div>
					    <div class="formFooterRegister">
					        <span>Bạn đã có tài khoản </span>
					        <a >Đăng nhập</a>
					    </div>
					</div>

			    </div>
			    
		    </div>
		</div>
	</div>

	<div>
		@yield('main')
	</div>

	<footer>

		<div class="container footerMain">
			<div class="row">
				<div class="col-md-4 col-sm-4 ">
					<div class="footerItem footerMainItemPlace">
						<h4>TRỤ SỞ CÔNG TY</h4>
						<div class="footerHoverBorder"></div>
						<div class="footerMainItemContent">
							<p>
								<img src="img/ic_placeholder.png">
								Tầng 4, 5, 6 CPHONE Tower, Số 456 Xô Viết Nghệ Tĩnh, P25, Q Bình Thạnh, HCM
							</p>
							<p>
								<img src="img/ic_placeholder.png">
								Tầng 5, Tòa Nhà Diamond Flower, Sớ 1 Hoàng Đạo Thúy, Thanh Xuân, Hà Nội
							</p>
							<p>
								MST: 0314813082 do Sở kế hoạch và đầu tư TP.HCM cấp

							</p>
							<p>
								Đại diện :Ông Đoàn Công Chung
							</p>
						</div>
						<div class="footerItemFootPlace">
							<a href="">
								<img src="img/dadangky.png">
							</a>
						</div>
					</div>
						
					
				</div>
				<div class="col-md-4 col-sm-4 ">
					<div class=" footerItem footerContact">
						<h4>THÔNG TIN LIÊN HỆ</h4>
						<div class="footerHoverBorder"></div>
						<div class="footerMainItemContent">
							<p>
								<img src="img/ic_placeholder.png">
								08.887.790.111<br>
								02.473.016.366
							</p>
							<p>
								<img src="img/ic_mail.png">
								info@ceduvn.com
							</p>
							
						</div>
						<div class="footerItemFoot">
							<a href="">
								<img src="img/ic_facebook.png">
							</a>
							<a href="">
								<img src="img/ic_g+.png">
							</a>
							<a href="">
								<img src="img/ic_ins.png">
							</a>
							<a href="">
								<img src="img/ic_youtube.png">
							</a>
						</div>
					</div>
					
				</div>
				<div class="col-md-4 col-sm-4">
					<div class=" footerItem footerInfo">
						<h4>THÔNG TIN VỀ CEDU</h4>
						<div class="footerHoverBorder"></div>
						<div class="footerMainItemContent">
							<ul>
								@foreach($about_list as $item)
								<li><a href="{{ asset('about/'.$item->about_slug.'.html') }}">{{$item->about_name}}</a></li>
								@endforeach
								{{-- <li><a href=""> Điều khoản</a></li>
								<li><a href=""> Chính sách bảo mật</a></li>
								<li><a href=""> Liên hệ hợp tác</a></li>
								<li><a href=""> Câu hỏi thường gặp</a></li> --}}
							</ul>
						</div>
						<div class="footerItemFootInfo">
							<a href="">
								<img src="img/appios.png">
							</a>
						</div>
					</div>
					
				</div>

			</div>
		</div>
		<div class="footerFoot">
			<div class="footerCopyright">
				<p>@ 2018 by CEDU All rights reserved</p>
			</div>
			<div class="foooterCart">
				<ul>
					<li><img src="img/ic_mastercard.png"></li>
					<li><img src="img/ic_paypal.png"></li>
					<li><img src="img/ic_visa.png"></li>
					<li><img src="img/ic_discover.png"></li>
					<li><img src="img/ic_baokim.png"></li>
					<li><img src="img/ic_nganluong.png"></li>
				</ul>
			</div>
		</div>
		<div class="footerFly">
			<img src="img/ic_plane_dichuyen.png">
		</div>
	</footer>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>

	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/home.js"></script>
	<script type="text/javascript" src="js/master.js"></script>
	@yield('script')

	
	</script>
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '1577563652342523',
	      xfbml      : true,
	      version    : 'v2.12'
	    });
	    FB.AppEvents.logPageView();
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "https://connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>	
	
</body>
</html>