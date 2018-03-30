jQuery.noConflict();

(function($)
{

	"use strict";
	
	$.fn.aetherNavigation = function(){

		var navigationButton = jQuery('.nav-button'),
			navigation = jQuery('.navigation'),
			navigationHeight = jQuery('.logo').height(),
			windowWidth = jQuery(window).width();

		jQuery('#main-content section:first-child').css({
			"margin-top" : navigationHeight + 30 + "px"
		});

		var sections = jQuery(jQuery('nav a[href=#footer]').length > 0 ? 'section, footer' : 'section');
		var navigation_links = jQuery('nav a');
		sections.waypoint({
		handler: function(direction) {
			var pos = jQuery.inArray(this,sections);
			var active_section = sections.eq(direction === "up" ? Math.max(0,pos-1) : pos);
			var active_link = jQuery('nav a[href$="#' + active_section.attr("id") + '"]');
			navigation_links.removeClass("active");
			active_link.addClass("active");
		},
		offset: '10%'
		});

		if ( windowWidth > 960 ) {
	  		navigation.addClass('desktop');
	  		navigation.removeClass('mobile');
	  	}

	  	if ( windowWidth < 960 ) {
	  		navigation.addClass('mobile');
	  		navigation.removeClass('desktop');
	  	}

	  	navigationButton.click(function(){
			if(navigation.is(':hidden')) {
				navigation.slideDown();
			} else {
				navigation.slideUp();
			}
		});

	  	jQuery('.navigation a').click(function(){
	  		if(navigation.is(':visible') && navigation.hasClass('mobile')) {
	  			navigation.slideUp();
	  		}
	  	});

	  	jQuery(window).resize(function() {
			var ww = jQuery(window).width(),
				nav = jQuery('.navigation');

		  	if ( ww > 960 ) {
		  		nav.addClass('desktop');
		  		nav.removeClass('mobile');
		  	}

		  	if ( ww < 960 ) {
		  		nav.addClass('mobile');
		  		nav.removeClass('desktop');
		  	}
		});
	};

})(jQuery);