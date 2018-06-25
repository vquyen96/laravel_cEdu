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

    {{-- <meta property="og:url" content="https://developers.zalo.me/" />
	<meta property="og:title" content="Zalo For Developers" />
	<meta property="og:image" content="https://developers.zalo.me/web/static/prodution/zalo.png" />
	<meta property="og:description" content="Trang thông tin về Zalo dành cho cộng đồng lập trình viên" />  --}}

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=IBM+Plex+Serif:500|Roboto:400,500" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/master2.css">
</head>
<body>
	
	<div id="status">
	</div>
	
	<div class="masterError">
		<div class="masterErrorContent">
			@include('errors.note')
		</div>
	</div>
	<div class="loadingPage">
		<div class="loadingPageIcon">
			<div class="mainFormHeadCircle">
				<img src="img/vongtron.png">
			</div>
			<div class="mainFormHeadLogo">
				<img src="img/logo.png">
			</div>
		</div>
	</div>
	<input type="hidden" name="url" value="{{ asset('')}}">
   
	<div class="btnScrollTop">
		<i class="fa fa-angle-double-up" aria-hidden="true"></i>
	</div>

	<header>
		<div class="headerItem headerTop">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="headerLogo">
							<img src="img/LOGO_CEDU1.png">
						</div>
					</div>
					<div class="col-md-9">
						<div class="headerTopMenu">
							<div class="headerTopMenuItem">
								<div class="headerTopMenuItemIcon">
									<i class="fa fa-phone" aria-hidden="true"></i>
								</div>
								<div class="headerTopMenuItemRight">
									<div class="headerTopMenuItemRightTitle">
										08.887.790.111
									</div>
									<div class="headerTopMenuItemRightContent">
										Hỗ trợ 24/7
									</div>
								</div>
							</div>
							<div class="headerTopMenuItem">
								<div class="headerTopMenuItemIcon">
									<i class="fa fa-bell" aria-hidden="true"></i>
								</div>
								<div class="headerTopMenuItemRight">
									<div class="headerTopMenuItemRightTitle">
										Thông báo 
									</div>
									<div class="headerTopMenuItemRightContent">
										2 tin mới
									</div>
								</div>
							</div>
							<div class="headerTopMenuItem">
								<div class="headerTopMenuItemIcon">
									<i class="fa fa-shopping-basket" aria-hidden="true"></i>
								</div>
								<div class="headerTopMenuItemRight">
									<div class="headerTopMenuItemRightTitle">
										Giỏ hàng
									</div>
									<div class="headerTopMenuItemRightContent">
										{{Cart::count()}} khóa học
									</div>
								</div>
							</div>
							<div class="headerTopMenuItem">
								<div class="headerTopMenuItemIcon">
									<i class="fa fa-user-circle" aria-hidden="true"></i>
								</div>
								<div class="headerTopMenuItemRight">
									<div class="headerTopMenuItemRightTitle">
										
									</div>
									<div class="headerTopMenuItemRightContent user">
										Đăng nhập 
										<i class="fa fa-angle-down" aria-hidden="true"></i>
									</div>
								</div>
								<div class="headerTopMenuItemIcon iconSearch">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div>
							</div>
							<!-- <div class="headerTopMenuItem">
								<div class="headerTopMenuItemIconSearch">
									<i class="fa fa-search" aria-hidden="true"></i>
								</div>
								<div class="headerTopMenuItemRight">
									<div class="headerTopMenuItemRightTitle">
										
									</div>
									<div class="headerTopMenuItemRightContent">
										Đăng nhập
									</div>
								</div>
							</div> -->

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="headerItem headerBot">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="headerBotMenu">
							<div class="headerBotMenuItem">
								<a href="{{ asset('') }}">
									Trang chủ
								</a>
							</div>
							<div class="headerBotMenuItem">
								<a href="{{ asset('courses') }}">
									Khóa học
									<i class="fa fa-angle-down" aria-hidden="true"></i> 
								</a>
							</div>
							<div class="headerBotMenuItem">
								<a href="{{ asset('news') }}">
									Tin tức
								</a>
							</div>
							<div class="headerBotMenuItem">
								<a href="{{ asset('partner') }}">
									Trở thành đối tác
								</a>
							</div>
							<div class="headerBotMenuItem">
								<a href="{{ asset('doc') }}">
									Tài liệu
								</a>
							</div>
							
						</div>
					</div>
					<div class="col-md-3">
						<div class="headerBotRight">
							<a href="{{ asset('code') }}" class="headerBotCode">
								<div class="headerBotCodeLeft">
									<i class="fa fa-lock" aria-hidden="true"></i>
								</div>
								<div class="headerBotCodeRight">
									Kích hoạt mã code
								</div>
							</a>
						</div>
					</div>
				</div>
				
					
			</div>

		</div>
	</header>

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
	<script type="text/javascript" src="js/master2.js"></script>
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