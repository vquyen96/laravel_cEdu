
$(document).ready(function(){
	var url_string = window.location.href;
	var url = new URL(url_string);

	var widthHeadMenu = $('.mainMenu').css('width');
	window.onscroll = function(){
		if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
			$('.headerTiny').slideDown();
            $('.btnScrollTop').css('bottom','20px');
        	$('.mainMenu').css({'position':'fixed','top':'47px','z-index':'9','width':widthHeadMenu, 'box-shadow': 'rgb(162, 162, 162) 7px 7px 20px'});
	    } else {
	        $('.headerTiny').slideUp();
            $('.btnScrollTop').css('bottom','-120px');
        	$('.mainMenu').css({'position':'unset','top':'0','z-index':'9','width': '100%'});
	    }
	};
	if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    	$('.headMenu').css({'position':'fixed','top':'47px','z-index':'9','width':widthHeadMenu, 'box-shadow': 'rgb(162, 162, 162) 7px 7px 20px'});
    } else {
    	$('.headMenu').css({'position':'unset','top':'0','z-index':'9','width': '100%'});
    }




	var slider = document.getElementById("myRange");
	var output = document.getElementById("slidePrice");
	output.innerHTML = (slider.value*10000).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

	slider.oninput = function() {
	  output.innerHTML = (this.value*10000).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
	}
	
	if(url_string.split('/').reverse()[0].substring(0, 7) == "courses"){
		$(document).on('click', "#courseMostBuy", function() {
			$('.mainMenu .active').removeClass("active");
			$('#courseMostBuy').addClass("active");
			$('html, body').animate({
		      scrollTop: $(".buyMost").offset().top-120
		    }, 800);
		});
		$(document).on('click', "#courseMostNew", function() {
			$('.mainMenu .active').removeClass("active");
			$('#courseMostNew').addClass("active");
			$('html, body').animate({
		      scrollTop: $(".newMost").offset().top-120
		    }, 800);
		});
		$(document).on('click', "#courseMostRate", function() {
			$('.mainMenu .active').removeClass("active");
			$('#courseMostRate').addClass("active");
			$('html, body').animate({
		      scrollTop: $(".ratingMost").offset().top-120
		    }, 800);
		});
		$(document).on('click', "#courseMostSale", function() {
			$('.mainMenu .active').removeClass("active");
			$('#courseMostSale').addClass("active");
			$('html, body').animate({
		      scrollTop: $(".saleMost").offset().top-120
		    }, 800);
		});
	}
		

	
	var tag = url.searchParams.get("tag");
	$(document).on('click', ".btnLevelAll", function() {
		
		if(tag != null){
			var para = "/?price="+$('#myRange').val()*10000+"&level=all&tag="+tag;
			var url = $('#urlPage').val();
			window.location=url+para;
		}
		else{
			var para = "/?price="+$('#myRange').val()*10000+"&level=all";
			var url = $('#urlPage').val();
			window.location=url+para;
		}
			
	});
	$(document).on('click', ".btnLevelBasic", function() {
		
		if(tag != null){
			var para = "/?price="+$('#myRange').val()*10000+"&level=basic&tag="+tag;
			var url = $('#urlPage').val();
			window.location=url+para;
		}
		else{
			var para = "/?price="+$('#myRange').val()*10000+"&level=basic";
			var url = $('#urlPage').val();
			window.location=url+para;
		}
	});
	$(document).on('click', ".btnLevelMaster", function() {
		if(tag != null){
			var para = "/?price="+$('#myRange').val()*10000+"&level=master&tag="+tag;
			var url = $('#urlPage').val();
			
			window.location=url+para;
		}
		else{
			var para = "/?price="+$('#myRange').val()*10000+"&level=master";
			var url = $('#urlPage').val();
			window.location=url+para;
		}
	});
	
	
});
	

function btnTag(value){
	var url_string = window.location.href;
	var url = new URL(url_string);
	var level = url.searchParams.get("level");
	if(level != null){
		var para = "/?price="+$('#myRange').val()*10000+"&tag="+value+"&level="+level;
		var url = $('#urlPage').val();
		window.location=url+para;
	}
	else{
		var para = "/?price="+$('#myRange').val()*10000+"&tag="+value;
		var url = $('#urlPage').val();
		window.location=url+para;
	}
		
}
function btnRemove(value){
	var url_string = window.location.href;
	var url = new URL(url_string);
	var level = url.searchParams.get("level");
	var price = url.searchParams.get("price");
	var tag = url.searchParams.get("tag");
	switch(value){
		case level:
			var para = "/?price="+$('#myRange').val()*10000+"&tag="+tag;
			var url = $('#urlPage').val();
			window.location=url+para;
			break;
		case price:
			var para = "/?level="+level+"&tag="+tag;
			var url = $('#urlPage').val();
			window.location=url+para;
			break;
		case tag:
			var para = "/?price="+$('#myRange').val()*10000+"&level="+level;
			var url = $('#urlPage').val();
			window.location=url+para;
			break;
		
	}

}