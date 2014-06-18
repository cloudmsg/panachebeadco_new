jQuery(function($) {	
	$social = $(".top-social");
	$socialWidth = $(".top-social").width();
	$social.css('width',$socialWidth);
	

	$(".block-currency").css('marginRight', $socialWidth);	
	$currencyWidth = $(".block-currency").width();
	$(".form-language ").css('marginRight', $socialWidth + $currencyWidth);
	
	$topDrop = $(".top-dropdow");
	$topDrop.hover(function(){	
		$heightCt = $(this).find(".block-content").height();		
		$(this).stop().animate({height: $heightCt + 38}, 500);
		
	},function(){
		$(this).stop().animate({height: '38px'}, 500);
	
	});
	
	$wrapOption = $(this).find(".productscroll-action");
	//$height = $wrapOption.height();
	//$wrapOption.height(0);
	$(".item-content").hover(function(){		
		
		//$(this).find(".productscroll-action").stop().animate({height: '100%'}, 300);
		$(this).find(".productscroll-action").stop().fadeIn(300);
		},function(){
		$(this).find(".productscroll-action").stop().fadeOut(250);
		//$(this).find(".productscroll-action").stop().animate({height: '0'}, 300);
		
		
	});

});
 