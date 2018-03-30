(function ($) {
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */ 
	/*global jQuery,setTimeout,projekktor,location,setInterval,YT,clearInterval,pixelentity */
	
	var slider,background;
	
	function change(e,data) {
		var slide = slider.getSlide(data.slideIdx-1);
		var backImg = slide.attr("data-background");
		background.load(backImg,backImg);
	}

	
	function create(backSlider,skin) {
		slider = skin.getSlider();
		background = backSlider;
		slider.bind("change.pixelentity",change);
	}

	
	function check(target) {
		var bgs = $.pixelentity.themeBackgroundSlider;
		if (bgs && !bgs.isMobile() && $.pixelentity.themeSlider) {
			create($.pixelentity.themeBackgroundSlider,$.pixelentity.themeSlider);
			return true;
		}
		return false;
	}
	$.pixelentity.widgets.add(check);
}(jQuery));