(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity */
	
	pixelentity.classes.Controller = function() {
		
		var iDev = navigator.userAgent.toLowerCase().match(/(iphone|ipod|ipad)/);
		
		function start() {		
			if (iDev) {
				$("html").addClass("iDevices");
			}
		}
		
		$.extend(this, {
			destroy: function() {
			}
		});
		
		start();
	};
	
}(jQuery));
