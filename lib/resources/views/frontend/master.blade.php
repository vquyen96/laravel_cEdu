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
			<img src="img/Pacman-0.8s-200px.gif">
			{{-- <div class="mainFormHeadCircle">
				<img src="img/vongtron.png">
			</div>
			<div class="mainFormHeadLogo">
				<img src="img/logo.png">
			</div> --}}
		</div>
	</div>
	<input type="hidden" name="url" value="{{ asset('')}}">
   
	{{-- <div class="btnScrollTop">
		<i class="fa fa-angle-double-up" aria-hidden="true"></i>
	</div> --}}

	<header>
		<div class="headerItem headerTop">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<a href="{{ asset('') }}" class="headerLogo">
							<img src="img/LOGO_CEDU1.png">
						</a>
					</div>
					<div class="col-md-9">
						<div class="headerTopMenu">
							<div class="headerTopMenuItem">
								<div class="headerTopMenuItemIcon">
									<i class="fa fa-phone" aria-hidden="true"></i>
								</div>
								<div class="headerTopMenuItemRight">
									<div class="headerTopMenuItemRightTitle">
										1900.633.972
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
									<div class="headerTopMenuItemHover headerBell">
										<div class="headerTopMenuItemHoverHead">
											<img src="img/ic_menuc2.png">
										</div>
										<?php $countNoti = 0?>
										@foreach ($noti as $item)
											
											@if ($item->noti_status == 1)
												<?php $countNoti++ ?>
												
											@endif
											<a href="{{$item->noti_link}}" class="headerBellItem">
												<div class="headerBellItemImg">
													<img src="{{ asset('lib/storage/app/noti/resized-'.$item->noti_img) }}">
												</div>
												<div class="headerBellItemContent">
													<span class="title">{{$item->noti_name}}</span>
													{{$item->noti_content}}
												</div>
												<div class="headerBellItemTime">
													<i class="fa fa-clock-o" aria-hidden="true"></i>
													{{time_format($item->created_at)}}
												</div>
											</a>
										@endforeach
									</div>
									<div class="headerTopMenuItemRightTitle">
										Thông báo 
									</div>
									<div class="headerTopMenuItemRightContent">
										{{$countNoti}} tin mới
									</div>
									
								</div>
							</div>
							<div class="headerTopMenuItem">
								<a href="{{ asset('cart/show') }}">
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
								</a>
									
							</div>
							<div class="headerTopMenuItem">
								
								@if (Auth::check())

									<div class="headerTopMenuItemIcon">
										<img src="{{ asset('lib/storage/app/avatar/'.Auth::user()->img) }}">
									</div>
									<div class="headerTopMenuItemRight">
										<div class="headerTopMenuItemRightContent user">
											{{Auth::user()->name}}
											<i class="fa fa-angle-down" aria-hidden="true"></i>
										</div>
									</div>
									{{-- <div class="headerTopMenuItemIcon iconSearch">
										<i class="fa fa-search" aria-hidden="true"></i>
									</div> --}}
									<div class="headerTopMenuItemHover">
										<div class="headerTopMenuItemHoverHead">
											<img src="img/ic_menuc2.png">
										</div>
										<a href="{{ asset('user') }}">
											Quản lý hồ sơ
										</a>
										<a href="{{ asset('user') }}">
											Các khóa học đang học
										</a>
										<a href="{{ asset('logout') }}">
											Đăng xuất
										</a>
									</div>
								@else
									<a href="{{ asset('login') }}">
										<div class="headerTopMenuItemIcon">
											<i class="fa fa-user-circle" aria-hidden="true"></i>
										</div>
										<div class="headerTopMenuItemRight">
											<div class="headerTopMenuItemRightContent user">
												Đăng nhập 
												<i class="fa fa-angle-down" aria-hidden="true"></i>
											</div>
										</div>
										
									</a>
									
								@endif
								
							</div>	
							<div class="headerTopMenuItemIcon iconSearch show">
								<i class="fa fa-search" aria-hidden="true"></i>
							</div>
							<div class="headerSearch">
								<form method="get" action="{{asset('search/')}}">
									<input type="text" name="search" class="inputSearch" placeholder="Tìm kiếm">
									{{-- <input type="submit" name="btnSubmit" style="display: none;"> --}}
								</form>
								<div class="headerTopMenuItemIcon iconSearch hide">
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
								<a href="{{ asset('') }}" @if (Request::segment(1) == "") class="active" @endif >
									Trang chủ
								</a>
							</div>
							<div class="headerBotMenuItem course">
								<a href="{{ asset('courses') }}" @if (Request::segment(1) == "courses") class="active" @endif >
									Khóa học
									<i class="fa fa-angle-down" aria-hidden="true"></i> 

								</a>
								<div class="headerBotMenuItemHover">
									<div class="headerBotMenuItemHoverHead">
										<img src="img/ic_menuc2.png">
									</div>
									
									@foreach($group as $item)
									<a href="{{asset('group/'.$item->gr_slug.'.html')}}">{{$item->gr_name}}</a>
									@endforeach
								</div>
								
							</div>
							<div class="headerBotMenuItem">
								<a href="{{ asset('news') }}" @if (Request::segment(1) == "news") class="active" @endif >
									Tin tức
								</a>
							</div>
							<div class="headerBotMenuItem">
								<a href="{{ asset('partner') }}" @if (Request::segment(1) == "partner") class="active" @endif >
									Trở thành đối tác
								</a>
							</div>
							<div class="headerBotMenuItem">
								<a href="{{ asset('doc') }}" @if (Request::segment(1) == "doc") class="active" @endif >
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
	<div class="headerTiny">
		<div class="headerTinyLeft">
			<ul>
				<li><a class="@if (Request::segment(1) == "") active @endif" href="{{asset("/")}}">Trang chủ</a></li>
				<li><a class="@if (Request::segment(1) == "courses") active @endif" href="{{asset("courses")}}">Khóa học</a></li>
				<li><a class="@if (Request::segment(1) == "news") active @endif" href="{{asset("news")}}">Tin tức</a></li>
				<li><a class="@if (Request::segment(1) == "partner") active @endif" href="{{asset("partner")}}">Trở thành đối tác</a></li>
				<li><a class="@if (Request::segment(1) == "doc") active @endif" href="{{asset("doc")}}">Tài liệu</a></li>
			</ul>
		</div>
		<div class="headerTinyRight">
			<ul>
				<li>
					{{-- <a href="{{ asset('code') }}">
						<div class="headerActiveCodeTiny">
							<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							<span>Kích hoạt mã code</span>
						</div>
					</a> --}}
					<a href="{{ asset('code') }}" class="headerTinyCode">
						<div class="headerTinyCodeLeft">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</div>
						<div class="headerTinyCodeRight">
							Kích hoạt mã code
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
						<img src="{{asset('lib/storage/app/avatar/resized-'.Auth::user()->img)}}">
						<span>{{Auth::user()->name}}</span>
					</a>
				</li>
				@else
				<li>
					<a href="{{ asset('login') }}">
						<i class="fa fa-user-circle-o" aria-hidden="true"></i>
						<span>Đăng nhập</span>
					</a>
				</li>
				@endif
				<li>
					<a href="" class="bellTiny">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<div class="bellTinyHide">
							<img src="img/ic_menuc2.png">
							<div class="bellTinyItem">
								
							</div>
						</div>
					</a>
				</li>
				<li>
					<a href="{{asset('cart/show')}}" class="cart">
						<i class="fa fa-shopping-basket" aria-hidden="true"></i>
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


	<div class="giftShow">
		<div class="giftShowTop">
			<img src="img/king.png">
			<span class="giftShowTopContent">
				Nhận quà hấp dẫn từ Cedu
			</span>
			

		</div>
		<div class="giftShowBot">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</div>
	</div>
	<div class="giftHide">
		<div class="giftHideBtn">
			<div class="giftHideBtnLine"></div>
		</div>
		<div class="giftHideTitle">
			Nhận kho tài liệu khủng từ Cedu
		</div>
		<form method="post" action="{{ asset('gift') }}">
			<input type="email" name="email" class="giftHideInput" placeholder="Email">
			<input type="submit" name="sbm" class="giftHideSubmit" value="Gửi">
			{{csrf_field()}}
		</form>
	</div> 
	<div>
		@yield('main')
	</div>

	{{-- <footer>

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
	</footer> --}}
	<footer>
		<div class="footerTop">
			<div class="footerTopItem">
				<div class="footerTopItemMain">
					<div class="footerTopItemMainTitle">
						Trụ sở công ty
					</div>
					<div class="footerMainItemContent">
						<p>
							<i class="fa fa-map-marker" aria-hidden="true"></i>
							Tầng 2, 5, 6 CPHONE Tower, Số 456 Xô Viết Nghệ Tĩnh, P25, Q Bình Thạnh, HCM
						</p>
						<p>
							<i class="fa fa-map-marker" aria-hidden="true"></i>
							Tầng 5, Tòa Nhà Diamond Flower, Số 1 Hoàng Đạo Thúy, Thanh Xuân, Hà Nội
						</p>
						{{-- <p>
							MST: 0314813082 do Sở kế hoạch và đầu tư TP.HCM cấp

						</p>
						<p>
							Đại diện :Ông Đoàn Công Chung
						</p> --}}
					</div>
					<div class="footerItemFootPlace">
						<a href="{{ asset('') }}">
							<img src="img/dadangky.png">
						</a>
					</div>
				</div>
				
			</div>
			<div class="footerTopItem">
				<div class="footerTopItemMain">
					<div class="footerTopItemMainTitle">
						Thông tin liên hệ
					</div>
					<div class="footerMainItemContent">
						<p>
							<i class="fa fa-phone" aria-hidden="true"></i>
							08.887.790.111<br>
							02.473.016.366<br>
							1900.633.972 nhánh 1
						</p>
						<p>
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<span class="oneLine">info@ceduvn.com</span>
						</p>
					</div>
				</div>
				<div class="footerTopItemBtnScrollTop">
					<i class="fa fa-angle-up" aria-hidden="true"></i>
				</div>
				
			</div>
			<div class="footerTopItem">
				<div class="footerTopItemMain">
					<div class="footerTopItemMainTitle">Thông tin về CEDU</div>
					<div class="footerMainItemContent">
						@foreach($about_list as $item)
						<a href="{{ asset('about/'.$item->about_slug.'.html') }}" class="footerMainItemContentItem">{{$item->about_name}}</a>
						@endforeach
							
					</div>
					<div class="footerItemFootPlace">
						<a href="{{ asset('') }}">
							<img src="img/appios.png">

						</a>
					</div>
				</div>
				
			</div>
		</div>
		<div class="footerBot">
			<a href="{{ asset('') }}">
				<i class="fa fa-facebook" aria-hidden="true"></i>
			</a>
			<a href="{{ asset('') }}">
				<i class="fa fa-google-plus" aria-hidden="true"></i>
			</a>
			<a href="{{ asset('') }}">
				<i class="fa fa-twitter" aria-hidden="true"></i>
			</a>
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
	<!--Start of Tawk.to Script-->
	{{-- <script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/5b3c71934af8e57442dc5245/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
	</script>
	<!--End of Tawk.to Script--> --}}
</body>
</html>