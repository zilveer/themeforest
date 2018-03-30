/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity */
(function($) {

	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	$.pixelentity.effects = $.pixelentity.effects || {version: '1.0.0'};
	
	var fadeTime = $.browser.msie && $.browser.version < 9 ? 0 : 300;
	
	$.pixelentity.effects.icon = function(e) {
		var target = $(e.currentTarget);
		if (e.type == "mouseenter" && target.hasClass("disabled")) {
			return;
		}
		var w = target.width();
		if (w && w < 170) {
			target.data("icon").addClass("small");
		}
		target.data("icon").fadeTo(fadeTime,e.type == "mouseenter" ? 1 : 0,"easeOutQuad");
	};
	
		
}(jQuery));