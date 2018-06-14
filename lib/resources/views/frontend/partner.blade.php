@extends('frontend.master')
@section('title','Hợp tác')
@section('main')
<link rel="stylesheet" type="text/css" href="css/partner.css">

<div>
	<div class="mainHead">
		<div class="mainHeadLine"></div>
		<div class="mainHeadTitle">
			<h3>Trở thành đối tác</h3>
		</div>
	</div>
	<div class="mainBody">
		<div class="mainBodyHeadBanner">
			<div class="mainBodyHeadBannerImg">
				<img src="img/charles-forerunner-378-unsplash.png">
			</div>
			<div class="mainBodyHeadBannerIcon">
				<div class="mainBodyHeadBannerIconMain">
					<a href="{{ asset('doitacgiaovien') }}" class="iconItem">
						<div class="iconItemImg">
							<img src="img/IC_GIANGVIEN.png">
						</div>
						<div class="iconItemContent">
							<h4>Đăng kí trở thành giảng viên</h4>
						</div>
					</a>
					<a href="{{ asset('affiliate') }}" class="iconItem">
						<div class="iconItemImg">
							<img src="img/ic_CTV.png">
						</div>
						<div class="iconItemContent">
							<h4>Đăng kí trở thành CTV</h4>
						</div>
					</a>
				</div>
				
			</div>
		</div>
		<div class="mainBodyBee">
			<img src="img/loiichkhitrothanhdoitac.png">
		</div>
		<div class="mainBodyMapTitle">
			<h3>Quy trình chia sẻ đam mê cùng Cedu</h3>
		</div>
		<div class="mainMap">
			<div class="mainBodyMap">
				<div class="mapTeacher">
					Giảng viên
				</div>
				<div class="mapCTV">
					Cộng tác viên
				</div>
				<div class="mapItem mapMidTop">
					<div class="mapItemTop">
						<div class="mapItemImg">
							<img src="img/ic_user.png">
						</div>
						<div class="mapItemTitle">
							Đăng ký
						</div>
					</div>
					<div class="mapItemBot">
						Lorem Ipsum is simply dummy text of the printing and typesetting.
					</div>
				</div>
				<div class="mapItem mapLeftTop">
					<div class="mapItemTop">
						<div class="mapItemImg">
							<img src="img/ic_notepad.png">
						</div>
						<div class="mapItemTitle">
							Soạn đề cương
						</div>
					</div>
					<div class="mapItemBot">
						Lorem Ipsum is simply dummy text of the printing and typesetting.
					</div>
				</div>
				<div class="mapItem mapLeft">
					<div class="mapItemTop">
						<div class="mapItemImg">
							<img src="img/IC_Video.png">
						</div>
						<div class="mapItemTitle">
							Dựng video
						</div>
					</div>
					<div class="mapItemBot">
						Lorem Ipsum is simply dummy text of the printing and typesetting.
					</div>
				</div>
				<div class="mapItem mapLeftBot">
					<div class="mapItemTop">
						<div class="mapItemImg">
							<img src="img/ic_phathanh.png">
						</div>
						<div class="mapItemTitle">
							Phát hành
						</div>
					</div>
					<div class="mapItemBot">
						Lorem Ipsum is simply dummy text of the printing and typesetting.
					</div>
				</div>
				<div class="mapItem mapMidBot">
					<div class="mapItemTop">
						<div class="mapItemImg">
							<img src="img/ic_thunhap.png">
						</div>
						<div class="mapItemTitle">
							Thu Nhập
						</div>
					</div>
					<div class="mapItemBot">
						Lorem Ipsum is simply dummy text of the printing and typesetting.
					</div>
				</div>
				<div class="mapItem mapRightTop">
					<div class="mapItemTop">
						<div class="mapItemImg">
							<img src="img/ic_interview.png">
						</div>
						<div class="mapItemTitle">
							Phỏng vấn
						</div>
					</div>
					<div class="mapItemBot">
						Lorem Ipsum is simply dummy text of the printing and typesetting.
					</div>
				</div>
				<div class="mapItem mapRight">
					<div class="mapItemTop">
						<div class="mapItemImg">
							<img src="img/ic_xacthuc.png">
						</div>
						<div class="mapItemTitle">
							Xác thực
						</div>
					</div>
					<div class="mapItemBot">
						Lorem Ipsum is simply dummy text of the printing and typesetting.
					</div>
				</div>
				<div class="mapItem mapRightBot">
					<div class="mapItemTop">
						<div class="mapItemImg">
							<img src="img/ic_banhang.png">
						</div>
						<div class="mapItemTitle">
							Bán hàng
						</div>
					</div>
					<div class="mapItemBot">
						Lorem Ipsum is simply dummy text of the printing and typesetting.
					</div>
				</div>
			</div>
		</div>
		<div class="mainTeacher">
			<div class="mainTeacherHead">
				<h3>Những đối tác tiêu biểu của CEDU</h3>
			</div>
			<div class="container mainTeacherBody">
				<div class="row">
					<div class="col-md-3">
						<div class="teacherTitle">
							<h4>Giảng viên tiêu biểu</h4>
						</div>
						<div class="teacherMain">
							@foreach($teacher as $item)
							<div class="teacherItem">
								<img src="{{asset('lib/storage/app/avatar/resized-'.$item->acc->img)}}">
								<div class="teacherName">
									{{$item->acc->name}}
								</div>
								<div class="teacherImg">
									{{ asset('lib/storage/app/teacher/'.$item->tea_img_foot) }}
								</div>
								<div class="teacherContent">
									{!!cut_string($item->acc->content,300)!!}
								</div>
							</div>
							@endforeach
							
						</div>
					</div>
					<div class="col-md-6 teacherDetail">
						<div class="teacherDetailLeft">
							<div class="teacherDetailImg">
								<img src="img/Layer 602.png">
							</div>
							<div class="teacherDetailName">
								Giảng viên
								<h4>Nguyễn Văn A</h4>
							</div>
						</div>
						<div class="teacherDetailRight">
							Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
						</div>
					</div>
					<div class="col-md-3">
						<div class="teacherTitle">
							<h4>CTV tiêu biểu</h4>
						</div>
						<div class="teacherMain">
							@foreach($teacher as $item)
							<div class="teacherItem">
								<img src="{{asset('lib/storage/app/avatar/resized-'.$item->acc->img)}}">
								<div class="teacherName">
									{{$item->acc->name}}
								</div>
								<div class="teacherImg">
									{{ asset('lib/storage/app/teacher/'.$item->tea_img_head) }}
								</div>
								<div class="teacherContent">
									{!!cut_string($item->acc->content,300)!!}
								</div>
							</div>
							@endforeach
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="mainFormTitle">
			<h3>Bạn đã sẵn sàng đồng hành cùng cedu</h3>
		</div>
		<div class="mainForm">
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
			<div class="mainFormBody">
				<form method="post">
					<div class="form-group">
						<input type="text" name="" class="form-control" placeholder="Họ và tên">
					</div>
					<div class="form-group">
						<input type="text" name="" class="form-control" placeholder="Email">
					</div>
					<div class="form-group">
						<input type="text" name="" class="form-control" placeholder="Số điện thoại">
					</div>
					<div class="form-group">
						<input type="radio">
						<span>Trở thành giảng viên</span>
					</div>
					<div class="form-group">
						<input type="radio">
						<span>Trở thành CTV</span>
					</div>
					<div class="form-group">
						<input type="submit" name="" class="btnSubmit" value="Gửi">
					</div>
				</form>
			</div>
		</div>	
	</div>
</div>
@stop
@section('script')
<script type="text/javascript" src="js/partner.js"></script>
@stop


