jQuery(document).ready(function($) {

	"use strict";
	
	// Search
	
	$('#top-search a').on('click', function ( e ) {
		e.preventDefault();
    	$('.show-search').slideToggle('fast');
    });
	
	// Menu
	$('#top-bar .menu').slicknav({
		prependTo:'.menu-mobile',
		label:'',
		allowParentLinks: true
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
	
	// Scroll to top
	
	$('.to-top').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	
	
});