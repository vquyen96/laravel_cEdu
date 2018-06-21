$(document).ready(function () {
    setTimeout(function(){
        $('.loadingPage').fadeOut();
    },100);


    window.onscroll = function(){
        
		if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        	$('.headerTiny').slideDown();
            $('.btnScrollTop').css('bottom','20px');
	    } else {
	        $('.headerTiny').slideUp();
            $('.btnScrollTop').css('bottom','-120px');
	    }
	};
	if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        $('.headerTiny').slideDown();
        $('.btnScrollTop').css('bottom','20px');
    } else {
        $('.headerTiny').slideUp();
        $('.btnScrollTop').css('bottom','-120px');
    }

    setTimeout(function(){
        $('.masterError').fadeOut();
    },2000);
});