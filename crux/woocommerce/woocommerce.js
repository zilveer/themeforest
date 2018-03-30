/**
 * Favicon badge.
 *
 * Display number of items in cart.
 */
if( "on" === stag.show_favicon_badge ) {
	var favicon = new Favico({
	    bgColor: stag.accent_color,
	    textColor: '#fff',
		animation: 'none',
	});

	favicon.badge( parseInt(stag.cart_contents_count) );
}

(function($){
	"use strict";

	var toggleState = function (elem, one, two) {
		elem.html( elem.html() === one ? two : one );
	};

	$(document).ready(function(){

		cart_dropdown_improvement();

		$(".quantity input[type=number]").each(function(){
			var number = $(this),
				newNum = $($('<div />').append(number.clone(true)).html().replace('number','text')).insertAfter(number);
				number.remove();
		});

	});

	function cart_dropdown_improvement() {
		var dropdown = $('.cart_dropdown'),
			subelement = dropdown.find('.dropdown_widget').css({display:'none', opacity:0});

		dropdown.hover(
		function(){ subelement.css({display:'block'}).stop().animate({opacity:1}, 200); },
		function(){ subelement.stop().animate({opacity:0}, function(){ subelement.css({display:'none'}); }); }
		);
	}

}(jQuery));
