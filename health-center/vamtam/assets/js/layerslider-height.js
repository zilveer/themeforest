(function($, undefined) {
	"use strict";

	$(function() {
		var wrap = $('#header-slider-container.layerslider').find('.layerslider-fixed-wrapper'),
			first = wrap.find('>div:first');

		if(!first.length) return;

		var timeout = false,
			wait = 0,
			remove_height = function() {
				if(first.height() > 0 || wait++ > 5) {
					wrap.height('auto');
					return;
				}

				timeout = setTimeout(remove_height, 500);
			};

		timeout = setTimeout(remove_height, 0);
	});
})(jQuery);