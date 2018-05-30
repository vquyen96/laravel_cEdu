
<div style="background:#ddd; padding: 20px;">
	<div style="width: 500px; margin: 20px auto; background: #fff; padding: 30px;">
		<div style="width: 170px; height: 75px; margin: auto;">
			<img src="{{asset('lib/storage/app/banner/logo.png')}}" style="width: 100%">
		</div>
		
		<h3 style="text-align: center">Khóa học của bạn đã thanh toán</h3>
		<h4>Thông tin khách hàng</h4>
		<p>Tên: {{$code->acc->name}}</p>
		<p>Email: {{$code->acc->email}}</p>
		<h2>Khóa học: {{$code->cou->cou_name}}</h2>
		<h1 style="color: #f44; font-weight: bold; text-align: center;">{{$code->code_value}}</h1>
		<h4 style="color: #f44">Mã kích hoạt khóa học chỉ tồn tại 7 ngày.</h4>
		<div id="xac-nhan">
			<br>
			<p align="justify">
				<b>Quý khách đã thanh toán thành công!</b><br />
				• Quý khách mau chóng kích hoạt trong thời gian sớm nhất<br />
				• Mọi thắc mắc xin liên hệ 1900 6886<br />
				<b><br />Cám ơn Quý khách đã sử dụng Sản phẩm của Công ty chúng Tôi!</b>
			</p>
		</div>
	</div>
		
</div>