/*-----------------------------------------------------------------------------------*/
/* Get rid of useless paragraphs & Navigation Functions Init
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($){
	"use strict";
	
	//remove paragraphs
	$("p:empty").remove();
	
	//Navigation Functions below here
	var menuWidth = $('#main-header #main-nav').width();
	$('#main-header #main-nav ul ul').css({
		'left' : menuWidth,
		'width' : menuWidth
	});
	
	$('#main-header #main-nav ul ul').prepend('<li class="menu-close-link-wrapper"><a href="#" class="menu-close-link"><i class="fa fa-angle-left"></i></a></l>');
	$('#main-header #main-nav li').has('ul').prepend('<span class="menu-link"><i class="fa fa-angle-right"></i></span>');
	
	$('.menu-link, #main-header #main-nav a[href="#"]:not(a[href="#"].menu-close-link)').click(function(){
		$(this).parent().find('ul').eq(0).css('display','block');
		$('#main-header #main-nav').height( $(this).parent().find('ul').eq(0).height() );
		$('#main-header #main-nav > div > ul').animate({
			'left' : '-='+menuWidth+'px'
		});
		return false;
	});
	
	$('.menu-close-link').click(function(){
		
		var $this = $(this);
		
		$('#main-header #main-nav > div > ul').animate({
			'left' : '+='+menuWidth+'px'
		}, function(){
			$this.parent().parent().css('display','none');
			$('#main-header #main-nav').height( $this.parent().parent().parent().parent().height() );
		});
		
		return false;
	});
	
	$('#top-header #main-nav ul li > ul').parent().children('a').append('<i class="fa fa-angle-down"></i>');
	$('#top-header #main-nav ul ul li').find('i').removeClass('fa-angle-down').addClass('fa-angle-right');
	
	/**
	 * Mobile Menus
	 */
	$('#menu-button').click(function(){
		$('.mobile-dropdown #main-nav').slideToggle();
	});
	
	$(window).resize(function(){
		$('.mobile-dropdown #main-nav').css('display', '');
	});
	
	selectnav('nav');
	$('.selectnav').appendTo('#main-header');
	$('.selectnav').appendTo('#top-header');
	
});
/*-----------------------------------------------------------------------------------*/
/* IMAGE LAZY LOADING
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($){
	"use strict";
	
	$(".video-container").fitVids();
	
	$("img").not('.frame img').unveil(250, function() {
	  $(this).load(function() {
	    $(this).animate({
	    	'opacity' : '1'
	    }, 500);
	    
	    if( $('.isotope-wrapper').hasClass('isotope') )
	    	jQuery('.isotope-wrapper').isotope('reLayout');
	    	
	    if( $('.feed-wrapper').hasClass('isotope') )
	    	jQuery('.feed-wrapper').isotope('reLayout');
	    
	  });
	});
	
	jQuery('.post-password-form').wrapInner('<div class="post-password-form-inner" />');
	
});
/*-----------------------------------------------------------------------------------*/
/* Make sure images don't get larger than window height
/*-----------------------------------------------------------------------------------*/
jQuery(window).load(function($){
	"use strict";
	
	jQuery(".gallery-image img").css({
		'max-height' : jQuery(window).height() - 40,
		'width' : 'auto'
	});
	
	jQuery(window).resize(function(){
		jQuery(".gallery-image img").css({
			'max-height' : jQuery(window).height() - 40,
			'width' : 'auto'
		});
	});
	
	if( jQuery('.flexslider').length > 0 ){
		jQuery('.flexslider').flexslider({
			controlNav: false,
			directionNav: true,
			prevText: "<i class='fa fa-angle-left'></i>",
			nextText: "<i class='fa fa-angle-right'></i>",
		});
	}
	
});
/*-----------------------------------------------------------------------------------*/
/*	ISOTOPE
/*-----------------------------------------------------------------------------------*/
jQuery(window).load(function($){
'use strict';

	jQuery('.isotope-wrapper').isotope({
		itemSelector : 'div'
	}).animate({
		'opacity' : '1'
	});
	
	jQuery('.feed-wrapper').isotope({
		itemSelector : 'article'
	}).animate({
		'opacity' : '1'
	});
	
	jQuery(window).resize(function(){
		jQuery('.isotope-wrapper').isotope('reLayout');
		jQuery('.feed-wrapper').isotope('reLayout');
	});
	
	jQuery(window).trigger('resize');
	
});