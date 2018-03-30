// IE8 ployfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
    window.getComputedStyle = function(el, pseudo) {
        this.el = el;
        this.getPropertyValue = function(prop) {
            var re = /(\-([a-z]){1})/g;
            if (prop === 'float') {prop = 'styleFloat';}
            if (re.test(prop)) {
                prop = prop.replace(re, function () {
                    return arguments[2].toUpperCase();
                });
            }
            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
        };
        return this;
    };
}

// as the page loads, call these scripts
jQuery(document).ready(function($) {
	"use strict";

	$("#content .article").fitVids();

	$('li.dropdown').attr('style', 'display:table-cell; position:relative;');

    /*
    Responsive jQuery is a tricky thing.
    There's a bunch of different ways to handle
    it, so be sure to research and find the one
    that works for you best.
    */

    /* getting viewport width */
    var responsive_viewport = $(window).width();

    /* if is below 481px */
    if (responsive_viewport < 481) {

    } /* end smallest screen */

    /* if is larger than 481px */
    if (responsive_viewport > 481) {

	    $(".add_to_cart_button").click(function(){
			$(".minicart").fadeIn(1000);
		});

    } /* end larger than 481px */

    /* if is above or equal to 768px */
    if (responsive_viewport >= 992) {


		var divHeight = $('#sidebar').outerHeight();
		$('#content .article').css('min-height', divHeight+'px');

		 /* load gravatars */
        $('.comment img[data-gravatar]').each(function(){
            $(this).attr('src',$(this).attr('data-gravatar'));
        });


    }

    /* off the bat large screen actions */
    if (responsive_viewport > 1030) {

    }


	// WOOCOMMERCE CART BUTTON

	$(".add_to_cart_button").click(function(){
		$(".minicart").fadeIn(1000);
	});


}); /* end of as page load scripts */