(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity,$ */
	
	function resize(idx,el) {
		el = $(el);
		var p = el.closest("a");
		var iw = el.width();
		var ih = el.height();
		var scaler = $.pixelentity.Geom.getScaler("fillmax","center","center",p.width(),p.height(),iw,ih);
		el.transform(scaler.ratio,
						  parseInt(scaler.offset.w,10),
						  parseInt(scaler.offset.h,10),
						  iw,
						  ih,
						  true);		
	}

	
	function check(target) {
		var t = target.find(".ngg-gallery-thumbnail a img");
		if (t.length > 0) {
			t.each(resize);
		}
		return false;
	}
	
	$.pixelentity.widgets.add(check);
}(jQuery));