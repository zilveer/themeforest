(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity */
	
	function create(idx,t) {
		t = $(t);
		t.peInfluxSlider({
			"delay": parseFloat(t.attr("data-delay"),10)*1000 || 0,
			"fade": t.attr("data-fade") == "enabled",
			"pause": t.attr("data-pause") == "enabled",
			"api": true
		});
	}

	
	function check(target) {
		var t = target.find(".slider");
		if (t.length > 0) {
			t.each(create);
			return true;
		}
		return false;
	}
	$.pixelentity.widgets.add(check);
}(jQuery));