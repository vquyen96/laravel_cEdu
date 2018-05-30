$(document).ready(function(){
	$('#slide_banner_head .item:first').attr('class','item active');
	$('#slide_banner_head ol li:first').attr('class','active');

	$('#carousel_left_top .item:first').attr('class','item active');
	$('#carousel_left_top ol li:first').attr('class','active');

	$('#carousel_left_bot .item:first').attr('class','item active');
	$('#carousel_left_bot ol li:first').attr('class','active');

	$('#carousel_right .item:first').attr('class','item active');
	$('#carousel_right ol li:first').attr('class','active');

	$('.banner #slide_banner_head .item .slide_item').height($('.banner #slide_banner_head .item .slide_item').width()*648/1440);
	//slide 
	var menuGrLength = $(".menuGroupItem").length;
	var numOfLoop = (menuGrLength - 4);
	var menuGrItem = $(".menuGroupItem");
	menuGrItem.eq(0).addClass("slideGrLeft3");
	menuGrItem.eq(1).addClass("slideGrLeft2");
	menuGrItem.eq(2).addClass("slideGrLeft1");
	menuGrItem.eq(3).addClass("slideGrMain");
	menuGrItem.eq(4).addClass("slideGrRight1");
	menuGrItem.eq(5).addClass("slideGrRight2");
	menuGrItem.eq(6).addClass("slideGrRight3");
	for( var i = 7; i<menuGrLength ; i++){
		menuGrItem.eq(i).addClass("slideNone");
	}	
	$(".slideGrMain").click(function(){
        
    });
    $(document).on('click', ".slideGrLeft1,.btnGroupLeft,.slideGrLeft2", function() {
    	if ($(".slideGrLeft2").prev().length != 0 ){

    		$(".slideGrLeft3").fadeIn();

		    $(".slideGrLeft2").animate({
	        	left: '22%',
	    		top: '23%',
	    		padding: '0 25px',
	    		height: '240px',
	    		padding: '0 25px',
	    		height: '240px'
	        });
	        $(".slideGrLeft1").animate({
	        	left: '41%',
	    		top: '16%',
	    		height: '320px',
				padding: '20px'
	    		
	        });
	        $(".slideGrMain").animate({
	        	left: '60%',
	    		top: '23%',
	    		padding: '0 25px',
	    		height: '240px'
	        });
	        
	        $(".slideGrRight1").animate({
	        	left: '79%',
	    		top: '17%',
	    		padding: '0 25px',
	    		height: '240px'
	        });
	        $(".slideGrRight2").fadeOut();
	        
			$(".slideGrRight3").attr("class","menuGroupItem slideNone");
	        $(".slideGrRight2").attr("class","menuGroupItem slideGrRight3");
			$(".slideGrRight1").attr("class","menuGroupItem slideGrRight2");
			$(".slideGrMain").attr("class","menuGroupItem slideGrRight1");
			$(".slideGrLeft1").attr("class","menuGroupItem slideGrMain");
			$(".slideGrLeft2").attr("class","menuGroupItem slideGrLeft1");    
			$(".slideGrLeft3").attr("class","menuGroupItem slideGrLeft2");
			$(".slideGrLeft2").prev().attr("class","menuGroupItem slideGrLeft3");
    	}
    	if($(".slideGrRight2").next().length != 0 ){
    		$('.btnGroupRight').css('display', 'block');
    	}
    	if($(".slideGrLeft2").prev().length == 0 ){
    		$('.btnGroupLeft').css('display', 'none');
    	}
	});
    $(document).on('click', ".slideGrRight1,.btnGroupRight,.slideGrRight2", function() {
    	if ($(".slideGrRight2").next().length != 0 ){
    		$(".slideGrLeft2").fadeOut();
	        $(".slideGrLeft1").animate({
	        	left: '3%',
	    		top: '17%',
	    		padding: '0 25px',
	    		height: '240px'
	        });
	        $(".slideGrMain").animate({
	        	left: '22%',
	    		top: '23%',
	    		padding: '0 25px',
	    		height: '240px'
	        });
	        $(".slideGrRight1").animate({
	        	left: '41%',
	    		top: '16%',
	    		height: '320px',
				padding: '20px'
	        });
	        $(".slideGrRight2").animate({
	        	left: '60%',
	    		top: '23%',
	    		padding: '0 25px',
	    		height: '240px'

	        });
	        $(".slideGrRight3").fadeIn();

	        $(".slideGrLeft3").attr("class","menuGroupItem slideNone");
			$(".slideGrLeft2").attr("class","menuGroupItem slideGrLeft3");
			$(".slideGrLeft1").attr("class","menuGroupItem slideGrLeft2");
			$(".slideGrMain").attr("class","menuGroupItem slideGrLeft1");
			$(".slideGrRight1").attr("class","menuGroupItem slideGrMain");
			$(".slideGrRight2").attr("class","menuGroupItem slideGrRight1");
			$(".slideGrRight3").attr("class","menuGroupItem slideGrRight2");
			$(".slideGrRight2").next().attr("class","menuGroupItem slideGrRight3");
    	}
    	if($(".slideGrRight2").next().length == 0 ){
    		$('.btnGroupRight').css('display', 'none');
    	}
    	if($(".slideGrLeft2").prev().length != 0 ){
    		$('.btnGroupLeft').css('display', 'block');
    	}
    });

    setInterval(function(){
    	if ($(".slideGrRight2").next().length != 0 ){
    		$(".slideGrLeft2").fadeOut();
	        $(".slideGrLeft1").animate({
	        	left: '3%',
	    		top: '17%',
	    		padding: '0 25px',
	    		height: '240px'
	        });
	        $(".slideGrMain").animate({
	        	left: '22%',
	    		top: '23%',
	    		padding: '0 25px',
	    		height: '240px'
	        });
	        $(".slideGrRight1").animate({
	        	left: '41%',
	    		top: '16%',
	    		height: '320px',
				padding: '20px'
	        });
	        $(".slideGrRight2").animate({
	        	left: '60%',
	    		top: '23%',
	    		padding: '0 25px',
	    		height: '240px'

	        });
	        $(".slideGrRight3").fadeIn();

	        $(".slideGrLeft3").attr("class","menuGroupItem slideNone");
			$(".slideGrLeft2").attr("class","menuGroupItem slideGrLeft3");
			$(".slideGrLeft1").attr("class","menuGroupItem slideGrLeft2");
			$(".slideGrMain").attr("class","menuGroupItem slideGrLeft1");
			$(".slideGrRight1").attr("class","menuGroupItem slideGrMain");
			$(".slideGrRight2").attr("class","menuGroupItem slideGrRight1");
			$(".slideGrRight3").attr("class","menuGroupItem slideGrRight2");
			$(".slideGrRight2").next().attr("class","menuGroupItem slideGrRight3");
    	}
    	if($(".slideGrRight2").next().length == 0 ){
    		$('.btnGroupRight').css('display', 'none');
    	}
    	if($(".slideGrLeft2").prev().length != 0 ){
    		$('.btnGroupLeft').css('display', 'block');
    	}
    }, 3000);
    $(document).on('click', ".khoahocMenuItem ", function(){
    	$('.khoahocMenu_Active').removeClass('khoahocMenu_Active');
    	$(this).addClass('khoahocMenu_Active');
    });

    var slideCourse = $('#carousel-home-course .carousel-inner .item');
    slideCourse.change(function(){
    	for(var i = 0; i<slideCourse.length; i++){
	    	console.log(slideCourse.eq(1).attr('class'));
	    }
    });

    var slideCourseItem = $('#carousel-home-course .carousel-inner .item .khoahocContentItem');
    for(var i = 0; i<slideCourseItem.length; i++){
    	if (i%2) {
    		
    		slideCourseItem.eq(i).addClass('down');
    	}
    	
    }
    
    var featuredHover = $('.featuredMainItemHover');
    for(var i = 0; i<featuredHover.length; i++){
    	if (i%2) {
    		featuredHover.eq(i).addClass('hoverRight');
    	}
    	else{
    		featuredHover.eq(i).addClass('hoverLeft');
    	}
    	
    }




    $('.teacherContentCircle').height($(window).width()/2.3);
    $('.teacherContentCircle').width($(window).width()/2.3);
    var revRotaL = 0;
    var rotateL = 0;
    $('.circleItemTea').eq(3).attr('class','teacherContentAvaLeft styleLeft');
  	$('.circleItemTea').eq(2).attr('class','teacherContentAvaBot styleBot');
  	$('.circleItemTea').eq(1).attr('class','teacherContentAvaRight styleRight');
  	$('.circleItemTea').eq(0).attr('class','teacherContentAvaTop styleTop');

  	var teacherName = $('.styleTop').children('.circleItemNameHide').text();
	var teacherContent = $('.styleTop').children('.circleItemContentHide').text();
	var teacherEmail = $('.styleTop').children('.circleItemLinkHide').text();
	
	$('.teacherContentItem h3').text(teacherName);
	$('.teacherContentItem p').text(teacherContent);
  	$('.teacherContentItem .btnDetail a').attr("href",teacherEmail);

    $(document).on('click', ".styleLeft", function(){
    	
    	$('.teacherContentCircle img').animate({  borderSpacing2: revRotaL+=270}, {
		    step: function(now,fx) {
		      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
		      $(this).css('-moz-transform','rotate('+now+'deg)');
		      $(this).css('transform','rotate('+now+'deg)');
		    },
		    duration:'slow'
		});
        $('.teacherContentCircle').animate({  borderSpacing3: rotateL-=270}, {
		    step: function(now,fx) {
		      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
		      $(this).css('-moz-transform','rotate('+now+'deg)');
		      $(this).css('transform','rotate('+now+'deg)');
		    },
		    duration:'slow'
		});	
		
		$(".styleTop" ).removeClass( "styleTop" ).addClass( "classTemp" );
		$(".styleLeft" ).removeClass( "styleLeft" ).addClass( "styleTop" );
		$(".styleBot" ).removeClass( "styleBot" ).addClass( "styleLeft" );
		$(".styleRight" ).removeClass( "styleRight" ).addClass( "styleBot" );
		
		
		$(".classTemp" ).removeClass( "classTemp" ).addClass( "styleRight" );
		
		var teacherName = $('.styleTop').children('.circleItemNameHide').text();
		var teacherContent = $('.styleTop').children('.circleItemContentHide').text();
		var teacherEmail = $('.styleTop').children('.circleItemLinkHide').text();

		$('.teacherContentItem h3').text(teacherName);
		$('.teacherContentItem p').text(teacherContent);
		$('.teacherContentItem .btnDetail a').attr("href",teacherEmail);

    });
    
    $(document).on('click', ".styleRight", function(){
    	
    	$('.teacherContentCircle img').animate({  borderSpacing2: revRotaL+=90}, {
		    step: function(now,fx) {
		      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
		      $(this).css('-moz-transform','rotate('+now+'deg)');
		      $(this).css('transform','rotate('+now+'deg)');
		    },
		    duration:'slow'
		});
        $('.teacherContentCircle').animate({  borderSpacing3: rotateL-=90}, {
		    step: function(now,fx) {
		      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
		      $(this).css('-moz-transform','rotate('+now+'deg)');
		      $(this).css('transform','rotate('+now+'deg)');
		    },
		    duration:'slow'
		});	
		
		$(".styleTop" ).removeClass( "styleTop" ).addClass( "classTemp" );
		$(".styleRight" ).removeClass( "styleRight" ).addClass( "styleTop" );
		$(".styleBot" ).removeClass( "styleBot" ).addClass( "styleRight" );
		$(".styleLeft" ).removeClass( "styleLeft" ).addClass( "styleBot" );
		$(".classTemp" ).removeClass( "classTemp" ).addClass( "styleLeft" );
		
		var teacherName = $('.styleTop').children('.circleItemNameHide').text();
		var teacherContent = $('.styleTop').children('.circleItemContentHide').text();
		var teacherEmail = $('.styleTop').children('.circleItemLinkHide').text();

		$('.teacherContentItem h3').text(teacherName);
		$('.teacherContentItem p').text(teacherContent);
		$('.teacherContentItem .btnDetail a').attr("href",teacherEmail);
    });
  	$(document).on('click', ".styleBot", function(){
    	
    	$('.teacherContentCircle img').animate({  borderSpacing2: revRotaL+=180}, {
		    step: function(now,fx) {
		      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
		      $(this).css('-moz-transform','rotate('+now+'deg)');
		      $(this).css('transform','rotate('+now+'deg)');
		    },
		    duration:'slow'
		});
        $('.teacherContentCircle').animate({  borderSpacing3: rotateL-=180}, {
		    step: function(now,fx) {
		      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
		      $(this).css('-moz-transform','rotate('+now+'deg)');
		      $(this).css('transform','rotate('+now+'deg)');
		    },
		    duration:'slow'
		});	
		
		$(".styleTop" ).removeClass( "styleTop" ).addClass( "classTemp" );
		$(".styleRight" ).removeClass( "styleRight" ).addClass( "classTemp1" );
		$(".styleBot" ).removeClass( "styleBot" ).addClass( "styleTop" );
		$(".styleLeft" ).removeClass( "styleLeft" ).addClass( "styleRight" );
		$(".classTemp" ).removeClass( "classTemp" ).addClass( "styleBot" );
		$(".classTemp1" ).removeClass( "classTemp1" ).addClass( "styleLeft" );
		
		var teacherName = $('.styleTop').children('.circleItemNameHide').text();
		var teacherContent = $('.styleTop').children('.circleItemContentHide').text();
		var teacherEmail = $('.styleTop').find('.circleItemLinkHide').text();
		
		$('.teacherContentItem h3').text(teacherName);
		$('.teacherContentItem p').text(teacherContent);
		$('.teacherContentItem .btnDetail a').attr("href",teacherEmail);
    });

  	
  	




  	var btnOpenR = 0;
	$(document).on('click', ".ceduItemTop, .ceduBtnHoverRight img", function(){
		if (btnOpenR == 0) {
			$(".ceduHoverRight").animate({
	        	left:'300px'
	        });
	        $('.ceduBtnHoverRight i').animate({  borderSpacing: 180}, {
			    step: function(now,fx) {
			      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
			      $(this).css('-moz-transform','rotate('+now+'deg)');
			      $(this).css('transform','rotate('+now+'deg)');
			    },
			    duration:'slow'
			});	
	        btnOpenR = 1;
		}else{
			$(".ceduHoverRight").animate({
	        	left:'0'
	        });
	        btnOpenR = 0;
	        $('.ceduBtnHoverRight i').animate({  borderSpacing: 360}, {
			    step: function(now,fx) {
			      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
			      $(this).css('-moz-transform','rotate('+now+'deg)');
			      $(this).css('transform','rotate('+now+'deg)');
			    },
			    duration:'slow'
			});
		}
		
	});
	var btnOpenB = 0;
	$(document).on('click', ".ceduBtnHoverBot, .ceduItemRight img", function(){
		if (btnOpenB == 0) {
			$(".ceduHoverBot").animate({
	        	top:'189px'
	        });
	        $('.ceduBtnHoverBot i').animate({  borderSpacing: 180}, {
			    step: function(now,fx) {
			      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
			      $(this).css('-moz-transform','rotate('+now+'deg)');
			      $(this).css('transform','rotate('+now+'deg)');
			    },
			    duration:'slow'
			});	
	        btnOpenB = 1;
		}else{
			$(".ceduHoverBot").animate({
	        	top:'0'
	        });
	        btnOpenB = 0;
	        $('.ceduBtnHoverBot i').animate({  borderSpacing: 360}, {
			    step: function(now,fx) {
			      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
			      $(this).css('-moz-transform','rotate('+now+'deg)');
			      $(this).css('transform','rotate('+now+'deg)');
			    },
			    duration:'slow'
			});
		}
		
	});
	var btnOpenT = 0;
	$(document).on('click', ".ceduBtnHoverTop, .ceduItemLeft img", function(){
		if (btnOpenT == 0) {
			$(".ceduHoverTop").animate({
	        	top:'-187px'
	        });
	        $('.ceduBtnHoverTop i').animate({  borderSpacing: 180}, {
			    step: function(now,fx) {
			      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
			      $(this).css('-moz-transform','rotate('+now+'deg)');
			      $(this).css('transform','rotate('+now+'deg)');
			    },
			    duration:'slow'
			});	
	        btnOpenT = 1;
		}else{
			$(".ceduHoverTop").animate({
	        	top:'0'
	        });
	        btnOpenT = 0;
	        $('.ceduBtnHoverTop i').animate({  borderSpacing: 360}, {
			    step: function(now,fx) {
			      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
			      $(this).css('-moz-transform','rotate('+now+'deg)');
			      $(this).css('transform','rotate('+now+'deg)');
			    },
			    duration:'slow'
			});
		}
		
	});
	var btnOpenL = 0;
	$(document).on('click', ".ceduBtnHoverLeft, .ceduItemBot img", function(){
		if (btnOpenL == 0) {
			$(".ceduHoverLeft").animate({
	        	left:'-300px'
	        });
	        $('.ceduBtnHoverLeft i').animate({  borderSpacing: 180}, {
			    step: function(now,fx) {
			      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
			      $(this).css('-moz-transform','rotate('+now+'deg)');
			      $(this).css('transform','rotate('+now+'deg)');
			    },
			    duration:'slow'
			});	
	        btnOpenL = 1;
		}else{
			$(".ceduHoverLeft").animate({
	        	left:'1px'
	        });
	        btnOpenL = 0;
	        $('.ceduBtnHoverLeft i').animate({  borderSpacing: 360}, {
			    step: function(now,fx) {
			      $(this).css('-webkit-transform','rotate('+now+'deg)'); 
			      $(this).css('-moz-transform','rotate('+now+'deg)');
			      $(this).css('transform','rotate('+now+'deg)');
			    },
			    duration:'slow'
			});
		}
		
	});

	$(document).on('mouseover', ".featuredMainItem", function(){
    	$(this).children(".featuredMainItemHover").slideDown();
		
    });
	// var url = $('input[name=url]').val();
	// console.log(url);
 //    $.get(url+"slide_home_head", function(data, status){
 //        console.log(data[1].ban_img);
 //    });


 	$('#carousel_left_top').height($('#carousel_left_top').width()*5/14);
 	$('#carousel_left_bot').height($('#carousel_left_bot').width()*5/14);
 	$('#carousel_right').height($('#carousel_right').width());


});
