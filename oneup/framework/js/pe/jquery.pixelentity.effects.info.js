/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity */
(function($) {

	$.pixelentity = $.pixelentity || {version: '1.0.0'};
	$.pixelentity.effects = $.pixelentity.effects || {version: '1.0.0'};	
	
	$.pixelentity.effects.info = function(e) {
		var target = $(e.currentTarget);
		
		var over = e.type == "mouseenter";
		if (over && target.hasClass("disabled")) {
			return;
		}
		
		var bg = target.data("bg") || (target.data("bg",$(target.find(".peOverElementInnerBG"))) && target.data("bg"));
		var text = target.data("text") || (target.data("text",$(target.find(".peOverElementText"))) && target.data("text"));
		var icon = target.data("icon") || (target.data("icon",$(target.find(".peOverElementIcon"))) && target.data("icon"));
		var iconBG = target.data("iconBG") || (target.data("iconBG",$(target.find(".peOverElementIconBG"))) && target.data("iconBG"));
		
		var tw = target.width();
		if (tw < 140) {
			target.removeClass("peOverSmall").addClass("peOverXSmall");
		} else if (tw < 200) {
			target.removeClass("peOverXSmall").addClass("peOverSmall");
		} else {
			target.removeClass("peOverXSmall").removeClass("peOverSmall");
		}
		
		if (bg.length > 0) {
			bg.stop().fadeTo(0,over ? 0 : 0.3).fadeTo(300,over ? 0.3 : 0);
		}
		if (text.length > 0) {
			text.stop().delay(over ? 200 : 0).animate({opacity: over ? 1 : 0,"margin-top": over ? 0 : 10},300);
		}
		if (icon.length > 0) {
			icon.stop().delay(over ? 200 : 0).animate({opacity: over ? 1 : 0},300,"easeOutQuad");
		}
		if (!$.support.csstransitions && iconBG.length > 0) {
			iconBG.stop().animate({opacity: over ? 1 : 0},300);
		}
	};
	
		
}(jQuery));