(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity */
	
	function create(idx,t) {
		t = $(t);
		var slider = t.peVoloSimpleSkin({api:true});
		
		if (!$.pixelentity.themeSlider) {
			$.pixelentity.themeSlider = slider;
		}
	}

	function check(target) {
		var t = target.find(".peVolo");
		if (t.length > 0) {
			t.each(create);
			return true;
		}
		return false;
	}
	
	$.pixelentity.widgets.add(check);
}(jQuery));