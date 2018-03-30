(function ($) {
	"use strict";
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery,setTimeout,location,setInterval,YT,clearInterval,clearTimeout,pixelentity */
	
	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	
	var timer;
	
	function lazy() {
		$("img[data-original]:not(img.pe-lazyload-inited)").peLazyLoading();
	}

	function delayed(e) {
		lazy();
		clearTimeout(timer);
		timer = setTimeout(lazy,500);
	}
	
	if (typeof $.fn.peLazyLoading === "function") {
		$('body').on('wc_fragments_refreshed wc_fragments_loaded added_to_cart',delayed);
	}
	
}(jQuery));