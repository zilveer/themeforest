jQuery(document).ready(function($) {

	"use strict";
	
	// Search
	
	$('#top-search a').on('click', function ( e ) {
		e.preventDefault();
    	$('.show-search').slideToggle('fast');
    });
	
	// Scroll to top
	
	$('.to-top').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	
	// Bxslider
	
	$('.bxslider').bxSlider({
	  adaptiveHeight: true,
	  mode: 'fade',
	  pager: false,
	  captions: true
	});
	
	// Fitvids
	$(document).ready(function(){
		// Target your .container, .wrapper, .post, etc.
		$(".container").fitVids();
	});
	
	// Menu
	$('#navigation .menu').slicknav({
		prependTo:'.menu-mobile',
		label:'',
		allowParentLinks: true
	});
	
	// slider
	$("#owl-demo").owlCarousel({
		navigation : false,
		items : 3,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [980,2],
		itemsTablet: [768,2],
		itemsTabletSmall: [568,1],
		itemsMobile : [479,1],
	});

	
	
});