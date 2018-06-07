@extends('frontend.master')
@section('title','Trang chủ')
@section('fb_title','Top khóa học hàng đầu')
@section('fb_description','Nơi cung cấp cho bạn những khóa học tốt nhất, rẻ nhất. Tạo lên một môi trường học tập trên cuộc cách mạng công nghệ 4.0')
@section('fb_image',asset('public/layout/frontend/img/dayne-topkin-60559-unsplash.png'))
@section('main')
<link rel="stylesheet" type="text/css" href="css/home.css">
<div>
	<div class="banner">
		<div id="slide_banner_head" class="carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators">
		  	<?php $i = 0 ?>
		  	@foreach($bannerHead as $item)
		  		<li data-target="#slide_banner_head" data-slide-to="{{$i}}"></li>
		  		<?php $i++ ?>
		  	@endforeach
		    
		  </ol>

		  <div class="carousel-inner" role="listbox">
		  	
		    @foreach($bannerHead as $item)
		    <div class="item">
		      	<div class="slide_item">
		    		<img src="{{ asset('lib/storage/app/banner/'.$item->ban_img) }}">
		    	</div>
		    </div>
		    @endforeach
		    
		  </div>
		  <div class="btnControl">
		  	<a href="#slide_banner_head" role="button" data-slide="prev" class="left">
		  		<i class="fa fa-angle-left" aria-hidden="true"></i>
		  	</a>
		  	<a href="#slide_banner_head" role="button" data-slide="next" class="right">
		  		<i class="fa fa-angle-right" aria-hidden="true"></i>
		  	</a>
		  </div>
		  
		</div>
	</div>
	<div class="menuGroup">
		<div class="menuGroupSmail">
			@for($i=0 ; $i<5; $i++)
				@foreach($groups as $item)
					<div class="menuGroupItem">
						<a href="{{asset('group/'.$item->gr_slug.'.html')}}">
						<div class="menuGroupItemImg">
							<img src="{{asset('lib/storage/app/group/'.$item->gr_img)}}">
						</div>
						<div class="menuGroupItemContent">
							{{$item->gr_name}}
						</div>
						</a>
					</div>
				@endforeach
			@endfor
				
			
		</div>
		<div class="btnGr">
			<div class="btnGroup btnGroupLeft">
				<i class="fa fa-angle-left" aria-hidden="true"></i>
			</div>
			<div class="btnGroup btnGroupRight">
				<i class="fa fa-angle-right" aria-hidden="true"></i>
			</div>
		</div>
	</div>
	<div class="khoahoc">
		<div class="khoahocBgLeft">
			<img src="img/Ellipse 5.png">
		</div>
		<div class="khoahocBgRight">
			<img src="img/Ellipse 5 copy.png">
		</div>
		<div class="khoahocHead">
			<h1 class="khoahocTitle">Khóa học</h1>
			
		</div>
				
		<div id="carousel-home-course" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  	<div class="khoahocMenu">
				<div class="khoahocMenuItem khoahocMenu_Active" data-target="#carousel-home-course" data-slide-to="0">
					<div class="khoahocMenuItemBorder"></div>
					<h4>Được quan tâm nhất</h4>
					<i class="fa fa-circle" aria-hidden="true" data-target="#carousel-home-course" data-slide-to="0"></i>
				</div>
				<div class="khoahocMenuItem" data-target="#carousel-home-course" data-slide-to="1">
					<div class="khoahocMenuItemBorder"></div>
					<h4>Mới ra mắt </h4>
					<i class="fa fa-circle" aria-hidden="true" data-target="#carousel-home-course" data-slide-to="1"></i>
				</div>
				<div class="khoahocMenuItem" data-target="#carousel-home-course" data-slide-to="2">
					<div class="khoahocMenuItemBorder"></div>
					<h4>Đánh giá cao nhất</h4>
					<i class="fa fa-circle" aria-hidden="true" data-target="#carousel-home-course" data-slide-to="2"></i>
				</div>
			</div>
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-home-course" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-home-course" data-slide-to="1"></li>
		    <li data-target="#carousel-home-course" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		    	<div class="carousel-caption">
		    		<div class="container-fluid khoahocContent1 ">
						<div class="row">
							@foreach($coursefollow as $item)
							<div class="col-md-3 col-sm-3">
								<div class="khoahocContentItem ">
									<div class="courseItemPrice">
										<span class="coursePrice">{{number_format($item->cou_price,0,',','.')}}<sup>đ</sup></span>
										@if($item->cou_sale != 0)
											<span class="coursePriceSale">{{number_format((100*ROUND($item->cou_price/ (100 - $item->cou_sale))),0,',','.')}}<sup>đ</sup></span>
										@endif
										
									</div>
									<div class="courseItemSale" @if($item->cou_sale == 0) style="display: none;" @endif>
										<img src="img/tag.png">
										<span class="courseItemSaleContent">
											{{$item->cou_sale}}%
										</span>
									</div>
									<div class="courseItemCart" @if($item->cou_sale != 0) style="display: none;" @endif>
										<a href="{{asset('cart/add/'.$item->cou_slug)}}">
											<img src="img/ic_cart.png">
										</a>
									</div>
									<div class="khoahocContentItemMain">
										<img src="{{asset('lib/storage/app/course/'.$item->cou_img)}}">
									</div>
									<div class="khoahocContentItemDetail">
										<div class="khoahocContentItemDetailUser">
											<img src="{{asset('lib/storage/app/avatar/'.$item->tea->img)}}">
											<span>{{$item->tea->name}}</span>
										</div>
										<div class="khoahocContentItemDetailStar">
											@for($i=0;$i<5;$i++)
												@if($item->cou_star > $i)
													<i class="fa fa-star starActive" aria-hidden="true"></i>
												@else
													<i class="fa fa-star" aria-hidden="true"></i>
												@endif
											@endfor
										</div>
										<div class="khoahocContentItemDetailTitle">
											{{cut_string($item->cou_name, 50)}}
										</div>
									</div>
									<div class="khoahocContentItemHover">
										<a href="{{asset('courses/detail/'.$item->cou_slug.'.html')}}">
											<div class="khoahocContentItemHoverHead">
												{{$item->cou_name}}
											</div>
											<div class="borderHover"></div>
											<div class="khoahocContentItemHoverContent">
												{!!cut_string($item->cou_content,500) !!}
											</div>
										</a>
									</div>
								</div>
							</div>
							@endforeach
							
						</div>
					</div>
		    	</div>

		    </div>
		    <div class="item">
		      	<div class="carousel-caption">
		    		<div class="container-fluid khoahocContent1 ">
						<div class="row">
							@foreach($coursenew as $item)
							<div class="col-md-3 col-sm-3">
								<div class="khoahocContentItem ">
									<div class="courseItemPrice">
										<span class="coursePrice">{{number_format($item->cou_price,0,',','.')}}<sup>đ</sup></span>
										@if($item->cou_sale != 0)
											<span class="coursePriceSale">{{number_format((100*ROUND($item->cou_price/ (100 - $item->cou_sale))),0,',','.')}}<sup>đ</sup></span>
										@endif
										
									</div>
									<div class="courseItemSale" @if($item->cou_sale == 0) style="display: none;" @endif>
										<img src="img/tag.png">
										<span class="courseItemSaleContent">
											{{$item->cou_sale}}%
										</span>
									</div>
									<div class="courseItemCart" @if($item->cou_sale != 0) style="display: none;" @endif>
										<a href="{{asset('cart/add/'.$item->cou_slug)}}">
											<img src="img/ic_cart.png">
										</a>
									</div>
									<div class="khoahocContentItemMain">
										<img src="{{asset('lib/storage/app/course/'.$item->cou_img)}}">
									</div>
									<div class="khoahocContentItemDetail">
										<div class="khoahocContentItemDetailUser">
											<img src="{{asset('lib/storage/app/avatar/'.$item->tea->img)}}">
											<span>{{$item->tea->name}}</span>
										</div>
										<div class="khoahocContentItemDetailStar">
											@for($i=0;$i<5;$i++)
												@if($item->cou_star > $i)
													<i class="fa fa-star starActive" aria-hidden="true"></i>
												@else
													<i class="fa fa-star" aria-hidden="true"></i>
												@endif
											@endfor
										</div>
										<div class="khoahocContentItemDetailTitle">
											{{cut_string($item->cou_name, 50)}}
										</div>
									</div>
									<div class="khoahocContentItemHover">
										<a href="{{asset('courses/detail/'.$item->cou_slug.'.html')}}">
											<div class="khoahocContentItemHoverHead">
												{{$item->cou_name}}
											</div>
											<div class="borderHover"></div>
											<div class="khoahocContentItemHoverContent">
												{!!cut_string($item->cou_content,500) !!}
											</div>
										</a>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
		    	</div>
		    </div>
		    <div class="item">
		      	<div class="carousel-caption">
		    		<div class="container-fluid khoahocContent1 ">
						<div class="row">
							@foreach($courserate as $item)
							<div class="col-md-3 col-sm-3">
								<div class="khoahocContentItem ">
									<div class="courseItemPrice">
										<span class="coursePrice">{{number_format($item->cou_price,0,',','.')}}<sup>đ</sup></span>
										@if($item->cou_sale != 0)
											<span class="coursePriceSale">{{number_format((100*ROUND($item->cou_price/ (100 - $item->cou_sale))),0,',','.')}}<sup>đ</sup></span>
										@endif
										
									</div>
									<div class="courseItemSale" @if($item->cou_sale == 0) style="display: none;" @endif>
										<img src="img/tag.png">
										<span class="courseItemSaleContent">
											{{$item->cou_sale}}%
										</span>
									</div>
									<div class="courseItemCart" @if($item->cou_sale != 0) style="display: none;" @endif>
										<a href="{{asset('cart/add/'.$item->cou_slug)}}">
											<img src="img/ic_cart.png">
										</a>
									</div>
									<div class="khoahocContentItemMain">
										<img src="{{asset('lib/storage/app/course/'.$item->cou_img)}}">
									</div>
									<div class="khoahocContentItemDetail">
										<div class="khoahocContentItemDetailUser">
											<img src="{{asset('lib/storage/app/avatar/'.$item->tea->img)}}">
											<span>{{$item->tea->name}}</span>
										</div>
										<div class="khoahocContentItemDetailStar">
											@for($i=0;$i<5;$i++)
												@if($item->cou_star > $i)
													<i class="fa fa-star starActive" aria-hidden="true"></i>
												@else
													<i class="fa fa-star" aria-hidden="true"></i>
												@endif
											@endfor
											
										</div>
										<div class="khoahocContentItemDetailTitle">
											{{cut_string($item->cou_name, 50)}}
										</div>
									</div>
									<div class="khoahocContentItemHover">
										<a href="{{asset('courses/detail/'.$item->cou_slug.'.html')}}">
											<div class="khoahocContentItemHoverHead">
												{{$item->cou_name}}
											</div>
											<div class="borderHover"></div>
											<div class="khoahocContentItemHoverContent">
												{!!cut_string($item->cou_content,500) !!}
											</div>
										</a>
									</div>
								</div>
							</div>
							@endforeach
							
						</div>
					</div>
		    	</div>
		    </div>
		  </div>

		  
		</div>
		
	</div>
	<div class="featured">
		<div class="featuredHead">
			<h1>NỔI BẬT TRONG THÁNG</h1>
		</div>
		<div class="featuredMain">
			<div class="featuredMainBG">
				<img src="img/Ellipse 5 copy 2.png">
			</div>
			<div class="container">
				<div class="row">
					@foreach($courserate as $item)
					<div class="col-md-6 col-sm-6">
						<div class="featuredMainItem">
							<div class="courseItemPrice">
								<span class="coursePrice">{{number_format($item->cou_price,0,',','.')}}<sup>đ</sup></span>
								@if($item->cou_sale != 0)
									<span class="coursePriceSale">{{number_format((100*ROUND($item->cou_price/ (100 - $item->cou_sale))),0,',','.')}}<sup>đ</sup></span>
								@endif
								
							</div>
							<div class="courseItemSale" @if($item->cou_sale == 0) style="display: none;" @endif>
								<img src="img/tag.png">
								<span class="courseItemSaleContent">
									{{$item->cou_sale}}%
								</span>
							</div>
							<div class="courseItemCart" @if($item->cou_sale != 0) style="display: none;" @endif>
								<a href="{{asset('cart/add/'.$item->cou_slug)}}">
									<img src="img/ic_cart.png">
								</a>
							</div>
							<div class="featuredMainItemBG">
								<a href="{{asset('courses/detail/'.$item->cou_slug.'.html')}}">
									<img src="{{asset('lib/storage/app/course/'.$item->cou_img)}}">
								</a>
								
							</div>
							
							<div class="featuredMainItemHover">
								<a href="{{asset('courses/detail/'.$item->cou_slug.'.html')}}">
									
								</a>
								<h4>{{$item->cou_name}}</h4>
								<p>{!!cut_string($item->cou_content,200)!!}</p>
								<div class="featuredMainItemHoverUser">
									<img src="{{asset('lib/storage/app/avatar/'.$item->tea->img)}}">
									<span class="teaName">
										{{$item->tea->name}}
									</span>
									<div class="featuredMainItemHoverUserStar">
										@for($i=0;$i<5;$i++)
											@if($item->cou_star > $i)
												<i class="fa fa-star starActive" aria-hidden="true"></i>
											@else
												<i class="fa fa-star" aria-hidden="true"></i>
											@endif
										@endfor
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
			
		</div>
	</div>
	
	<div class="hot">
		<div class="hotHead">
			<h1 class="">TOP KHÓA HỌC ĐƯỢC MUA NHIỀU NHẤT</h1>
		</div>
		{{-- <div id="slideCourseHot" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  	
		  <ol class="carousel-indicators">
		    <li data-target="#slideCourseHot" data-slide-to="0" class="active"></li>
		    <li data-target="#slideCourseHot" data-slide-to="1"></li>
		    <li data-target="#slideCourseHot" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		    	<div class="carousel-caption">
		    		<div class="hotContent">
		    			@foreach($hotcourse as $item)
						<div class="hotContentItem">
							<div class="hotContentItemAva">
								<a href="{{asset('courses/detail/'.$item->cou_slug.'.html')}}">
									<img src="{{asset('lib/storage/app/avatar/'.$item->tea->img)}}">
								</a>
							</div>
							<div class="hotContentItemCart">
								<a href="{{asset('cart/add/'.$item->cou_slug)}}">
									<img src="img/ic_cart.png">
								</a>
							</div>
							<div class="hotContentItemHead">
								<span>{{number_format($item->cou_price,0,',','.')}}<sup>đ</sup></span>
							</div>
							<div class="hotContentItemMain">
								<a href="{{asset('courses/detail/'.$item->cou_slug.'.html')}}">
									<img src="{{asset('lib/storage/app/course/'.$item->cou_img)}}">
								</a>
							</div>
							<div class="hotContentItemDetail">
								<div class="hotContentItemDetailUser">
									<img src="{{asset('lib/storage/app/avatar/'.$item->tea->img)}}">
									<span>{{$item->tea->name}}</span>
								</div>
								<div class="hotContentItemDetailStar">
									@for($i=0;$i<5;$i++)
										@if($item->cou_star > $i)
											<i class="fa fa-star starActive" aria-hidden="true"></i>
										@else
											<i class="fa fa-star" aria-hidden="true"></i>
										@endif
									@endfor
								</div>
								<div class="hotContentItemDetailTitle">
									{{cut_string($item->cou_name,30)}}
								</div>
							</div>
						</div>
						@endforeach
					</div>
		    	</div>
		    </div>
		    <div class="item">
		      	<div class="carousel-caption">
		    		<div class="hotContent">
		    			@foreach($hotcourse as $item)
						<div class="hotContentItem">
							<div class="hotContentItemAva">
								<a href="{{asset('courses/detail/'.$item->cou_slug.'.html')}}">
									<img src="{{asset('lib/storage/app/avatar/'.$item->tea->img)}}">
								</a>
							</div>
							<div class="hotContentItemCart">
								<a href="{{asset('cart/add/'.$item->cou_slug)}}">
									<img src="img/ic_cart.png">
								</a>
							</div>
							<div class="hotContentItemHead">
								<span>{{number_format($item->cou_price,0,',','.')}}<sup>đ</sup></span>
							</div>
							<div class="hotContentItemMain">
								<img src="{{asset('lib/storage/app/course/'.$item->cou_img)}}">
							</div>
							<div class="hotContentItemDetail">
								<div class="hotContentItemDetailUser">
									<img src="{{asset('lib/storage/app/avatar/'.$item->tea->img)}}">
									<span>{{$item->tea->name}}</span>
								</div>
								<div class="hotContentItemDetailStar">
									@for($i=0;$i<5;$i++)
										@if($item->cou_star > $i)
											<i class="fa fa-star starActive" aria-hidden="true"></i>
										@else
											<i class="fa fa-star" aria-hidden="true"></i>
										@endif
									@endfor
								</div>
								<div class="hotContentItemDetailTitle">
									Khóa học PHP cơ bản đến nâng cao
								</div>
							</div>
						</div>
						@endforeach
					</div>
		    	</div>
		    </div>
		    <div class="item">
		      	<div class="carousel-caption">
		    		<div class="carousel-caption">
		    		<div class="hotContent">
		    			@foreach($hotcourse as $item)
						<div class="hotContentItem">
							<div class="hotContentItemAva">
								<a href="{{asset('courses/detail/'.$item->cou_slug.'.html')}}">
									<img src="{{asset('lib/storage/app/avatar/'.$item->tea->img)}}">
								</a>
							</div>
							<div class="hotContentItemCart">
								<a href="{{asset('cart/add/'.$item->cou_slug)}}">
									<img src="img/ic_cart.png">
								</a>
								
							</div>
							<div class="hotContentItemHead">
								<span>{{number_format($item->cou_price,0,',','.')}}<sup>đ</sup></span>
							</div>
							<div class="hotContentItemMain">
								<img src="{{asset('lib/storage/app/course/'.$item->cou_img)}}">
							</div>
							<div class="hotContentItemDetail">
								<div class="hotContentItemDetailUser">
									<img src="{{asset('lib/storage/app/avatar/'.$item->tea->img)}}">
									<span>{{$item->tea->name}}</span>
								</div>
								<div class="hotContentItemDetailStar">
									@for($i=0;$i<5;$i++)
										@if($item->cou_star > $i)
											<i class="fa fa-star starActive" aria-hidden="true"></i>
										@else
											<i class="fa fa-star" aria-hidden="true"></i>
										@endif
									@endfor
								</div>
								<div class="hotContentItemDetailTitle">
									Khóa học PHP cơ bản đến nâng cao
								</div>
							</div>
						</div>
						@endforeach
					</div>
		    	</div>
		    	</div>
		    </div>
		  </div>

		  
		</div>
		
		<div class="btnSlideHot">
			<div class="btnSlideHotItem hotLeft" href="#slideCourseHot" role="button" data-slide="prev">
				<i class="fa fa-angle-left" aria-hidden="true"></i>
			</div>
			<div class="btnSlideHotItem hotRight" href="#slideCourseHot" role="button" data-slide="next">
				<i class="fa fa-angle-right" aria-hidden="true"></i>
			</div>
			
		</div>			 --}}
		<div class="slideCourseHot">
			<div class="slideCourseMain">
				@foreach ($hotcourse as $item)
					<div class="hotContentItem">
						<div class="hotContentItemAva">
							<a href="{{asset('courses/detail/'.$item->cou_slug.'.html')}}">
								<img src="{{asset('lib/storage/app/avatar/'.$item->tea->img)}}">
							</a>
						</div>
						<div class="hotContentItemCart">
							<a href="{{asset('cart/buy/'.$item->cou_slug)}}">
								<img src="img/ic_cart.png">
							</a>
							
						</div>
						<div class="hotContentItemHead">
							<span>{{number_format($item->cou_price,0,',','.')}}<sup>đ</sup></span>
						</div>
						<div class="hotContentItemMain">
							<img src="{{asset('lib/storage/app/course/'.$item->cou_img)}}">
						</div>
						<div class="hotContentItemDetail">
							<div class="hotContentItemDetailUser">
								<img src="{{asset('lib/storage/app/avatar/'.$item->tea->img)}}">
								<span>{{$item->tea->name}}</span>
							</div>
							<div class="hotContentItemDetailStar">
								@for($i=0;$i<5;$i++)
									@if($item->cou_star > $i)
										<i class="fa fa-star starActive" aria-hidden="true"></i>
									@else
										<i class="fa fa-star" aria-hidden="true"></i>
									@endif
								@endfor
							</div>
							<div class="hotContentItemDetailTitle">
								Khóa học PHP cơ bản đến nâng cao
							</div>
						</div>
					</div>
				@endforeach
			</div>
				
			<div class="slideCourseHotItem">
				
			</div>
			<div class="btnSlideHot">
				<div class="btnSlideHotItem hotLeft" href="#slideCourseHot" role="button" data-slide="prev">
					<i class="fa fa-angle-left" aria-hidden="true"></i>
				</div>
				<div class="btnSlideHotItem hotRight" href="#slideCourseHot" role="button" data-slide="next">
					<i class="fa fa-angle-right" aria-hidden="true"></i>
				</div>
				
			</div>
		</div>
	</div>

	<div class="teacher">
		<div class="teacherHead">
			<h1>GIẢNG VIÊN TIÊU BIỂU</h1>
		</div>
		<div class="teacherContent">

			<div class="teacherContentCircle">
				@foreach($teacher as $item)
					<div class="circleItemTea">
						<img src="{{asset('lib/storage/app/avatar/'.$item->acc->img)}}">
						<div class="circleItemNameHide">
							{{$item->acc->name}}
						</div>
						<div class="circleItemContentHide">
							{!!cut_string($item->acc->content,300)!!}
						</div>
						<div class="circleItemLinkHide">
							
							{{asset('teacher/'.$item->acc->email)}}
							
						</div>
					</div>
				
				@endforeach
				
				
				
			</div>
			<div class="teacherContentItem">
				<h3></h3>
					<p>
						
					</p>
					<div class="btnDetail">
						<a href="">
							<i class="fa fa-arrow-right" aria-hidden="true"></i>
						</a>
						
					</div>
					
				<div class="teacherContentCircleItem">
					
					
						
				</div>
			</div>
			
		</div>
	</div>
	<div class="container banner">
		<div class="row">
			<div class="col-md-7">
				<div id="carousel_left_top" class="carousel slide" data-ride="carousel">
				  <div class="carousel-inner" role="listbox">
				    @foreach($bannerLeftTop as $item)
				    <div class="item">
				      	<div class="slide_item">
				    		<img src="{{ asset('lib/storage/app/banner/'.$item->ban_img) }}">
				    	</div>
				    </div>
				    @endforeach
				  </div>
				</div>
				<div id="carousel_left_bot" class="carousel slide" data-ride="carousel">
				  <div class="carousel-inner" role="listbox">
				     @foreach($bannerLeftBot as $item)
				    <div class="item">
				      	<div class="slide_item">
				    		<img src="{{ asset('lib/storage/app/banner/'.$item->ban_img) }}">
				    	</div>
				    </div>
				    @endforeach
				  </div>
				</div>


				
			</div>
			<div class="col-md-5">
				<div id="carousel_right" class="carousel slide" data-ride="carousel">
				  <div class="carousel-inner" role="listbox">
				    @foreach($bannerRight as $item)
				    <div class="item">
				      	<div class="slide_item">
				    		<img src="{{ asset('lib/storage/app/banner/'.$item->ban_img) }}">
				    	</div>
				    </div>
				    @endforeach
				  </div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="ceduFeatured">
		<div class="ceduHead">
			<h1>ĐIỂM NỔI BẬT CỦA CEDU</h1>
		</div>
		
		<div class="ceduContent">
			<div class="ceduContentItem ceduItemTop">
				<img src="img/ic_4.0.png">
				<p>Giáo dục theo nền công nghệ 4.0</p>
				<div class="ceduContentItemHover ceduHoverRight">
					<div class="ceduBtnHover ceduBtnHoverRight">
						<i class="fa fa-arrow-right" aria-hidden="true"></i>
					</div>
					<p>
						CEDU tự hào là một trong mô hình giáo dục 4.0 mang lại cho khách hàng những trải nghiệm thú vị ,kiến thức phong phú nhât
					</p>
				</div>
			</div>
			<div class="ceduContentItem ceduItemRight">
				<img src="img/ic_support.png">
				<p>Luôn có đội ngũ giảng viên hỗ trợ nhiệt tình</p>
				<div class="ceduContentItemHover ceduHoverBot">
					<div class="ceduBtnHover ceduBtnHoverBot">
						<i class="fa fa-arrow-down" aria-hidden="true"></i>
					</div>
					<p>
						Tại CEDU thời gian học của bạn sẽ được linh động mọi lúc mọi nơi. Bạn chỉ cần đăng nhập và click vào khóa học bạn muốn 
					</p>
				</div>
			</div>
			<div class="ceduContentItem ceduItemLeft">
				<img src="img/ic_time.png">
				<p>Thời gian học linh hoạt chủ động</p>
				<div class="ceduContentItemHover ceduHoverTop">
					<div class="ceduBtnHover ceduBtnHoverTop">
						<i class="fa fa-arrow-up" aria-hidden="true"></i>
					</div>
					<p>
						CEDU sẽ cùng đội ngũ giảng viên hỗ trợ những thắc mắc mà bạn gặp phải trong các khóa học 
					</p>
				</div>
			</div>
			<div class="ceduContentItem ceduItemBot">
				<img src="img/ic_like.png">
				<p>Luôn đặt chất lượng lên hàng đầu</p>
				<div class="ceduContentItemHover ceduHoverLeft">
					<div class="ceduBtnHover ceduBtnHoverLeft">
						<i class="fa fa-arrow-left" aria-hidden="true"></i>
					</div>
					<p>
						Luôn đặt chất lượng khóa học lên hàng đầu chính vì thế giảng viên của CEDU đều là những chuyên gia nổi tiếng trong các lĩnh vực : luyện thi,kĩ năng mềm, marketing, kĩ thuật, ….. 
					</p>
				</div>
			</div>
			
		</div>
	</div>

	<div class="register">
		<div class="registerBody">
			
			<div class="registerBodyMain">
				<h3>ĐĂNG KÍ NGAY ĐỂ NHẬN ƯU ĐÃI TỪ CEDU</h3>
				<form method="post" >
					<input type="email" name="email" placeholder="Email">
					<input type="submit" name="btnSubmit" value="Gửi">
				</form>
			</div>
		</div>
		
	</div>
</div>
	
@stop	