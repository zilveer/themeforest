(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity */
	
	function create(idx,t) {
		t = $(t);
		var slider = t.peBackgroundSlider({
			"api": true
		});
		slider.configure("fillmax","center,center");
		$(window).resize(slider.resize);
		
		if (t.attr("data-color") || t.attr("data-bw")) {
			slider.load(t.attr("data-color"),t.attr("data-bw"));
		}
		
		if (t.attr("data-resource") == "slider" && !$.pixelentity.themeBackgroundSlider) {
			$.pixelentity.themeBackgroundSlider = slider;
		}
		
	}

	
	function check(target) {
		var t = target.find("#backgroundSlider");
		if (t.length > 0) {
			t.each(create);
			return true;
		}
		return false;
	}
	$.pixelentity.widgets.add(check);
}(jQuery));