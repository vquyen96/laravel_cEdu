$(document).ready(function(){
	$('body').height($(window).height());

	$('.btnRegister').click(function(){
		$('.loginBody').css('left', '491px');
		$('.formRegister').toggle();
		$('.formLogin').toggle();
		$('.loginMainTitleLeft').text("Đăng ký");
		
	});
	$('.btnLogin').click(function(){
		$('.loginBody').css('left', '20px');
		$('.formRegister').toggle();
		$('.formLogin').toggle();
		$('.loginMainTitleLeft').text("Đăng nhập");
	});
});