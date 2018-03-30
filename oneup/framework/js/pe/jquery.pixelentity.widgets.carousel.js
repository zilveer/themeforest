(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,clearTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,prettyPrint */
                
    
	function clickHandler(e) {
		var slider = e.data.slider;
		var target = e.data.target;
		var el = target.find(e.currentTarget);
		if (el.hasClass("prev-btn")) {
			slider.prev();
		} else {
			slider.next();
		}
		return false;
	}

	
	function addTarget() {
		var target = $(this);
		var slider = target.parent().next(".carouselBox");
		if (slider.length === 0) {
			slider = target.parent().prev(".carouselBox");			
		}
		if (slider.length > 0) {
			slider.addClass("peVolo").wrapInner('<div class="peWrap"></div>');
		}
		slider = slider.peVolo({api:true});
		target.on("click","a",{"slider":slider,"target":target},clickHandler);
	}
	
	
	function check(target,controller) {
		var t = target.find(".carousel-nav");
		if (t.length > 0) {
			t.each(addTarget);
			return true;
		}
		return false;
	}
	
	$.pixelentity.widgets.add(check);
	
}(jQuery));