$(document).ready(function(){
	var bodyHeight = $('.paymentBodyRight').css('height');
	$('.paymentBodyLeft').css('height',bodyHeight);


	$("#ship").click(function () {
	    if ($(this).is(":checked")) {
	        $(".paymentRight ").hide();
	        $(".ship").show();
	        var bodyHeight = $('.paymentBodyRight').css('height');
			$('.paymentBodyLeft').css('height',bodyHeight);
	    } 
	});
	var heightOfAtm;
	var heightOfVisa;
	var heightOfBaokim;

	$("#online").click(function () {
	    if ($(this).is(":checked")) {
	        $(".paymentRight ").hide();
	        $(".online").show();
	        var bodyHeight = $('.paymentBodyRight').css('height');
			$('.paymentBodyLeft').css('height',bodyHeight);
	    }
	    heightOfAtm = $('.tableChoose.atm').css('height');
		heightOfVisa = $('.tableChoose.visa').css('height');
		heightOfBaokim = $('.tableChoose.baokim').css('height');
		// $('.tableChoose').css('height','85px');
		
	});
	$("#office").click(function () {
	    if ($(this).is(":checked")) {
	        $(".paymentRight ").hide();
	        $(".office").show();
	        var bodyHeight = $('.paymentBodyRight').css('height');
			$('.paymentBodyLeft').css('height',bodyHeight);
	    } 
	});
	$("#card").click(function () {
	    if ($(this).is(":checked")) {
	        $(".paymentRight ").hide();
	        $(".card").show();
	        var bodyHeight = $('.paymentBodyRight').css('height');
			$('.paymentBodyLeft').css('height',bodyHeight);
	    } 
	});
	$('.choose').click(function(){
		if ($(this).is(":checked")) {
			$(".tableChoose").css('height','85px');
			$(this).next().find('.tableChoose').css('height','auto');
	    } 
	});
	// $("#paymentATM").click(function () {
	//     if ($(this).is(":checked")) {
	//         $(".tableChoose").css('height','85px');
	//         $(".tableChoose.atm").css('height','auto');
	//     } 
	// });
	// $("#paymentVISA").click(function () {
	//     if ($(this).is(":checked")) {
	//         $(".tableChoose").css('height','85px');
	//         $(".tableChoose.visa").css('height','auto');
	//     } 
	// });
	// $("#paymentBAOKIM").click(function () {
	//     if ($(this).is(":checked")) {
	//         $(".tableChoose").css('height','85px');
	//         $(".tableChoose.baokim").css('height','auto');
	//     } 
	// });
	$(".tableChoose .chooseItem").click(function (){
		$(this).parent().siblings().find('.chooseItem').css('border','1px dashed #999');
		$(this).css('border','1px dashed #33f');
		$(this).parents(".tableChoose").find(".formOnline").slideDown();
		$(this).parents(".tableChoose.baokim").css('max-height','auto');
		$(this).parents(".tableChoose").find('.inputLogoBank img').attr('src',$(this).find('img').attr('src'));
	}); 
});