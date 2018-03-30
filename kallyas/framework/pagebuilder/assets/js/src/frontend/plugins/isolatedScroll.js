var $ = require( 'jQuery' );

$.fn.isolatedScroll = function () {
	return this.on('mousewheel DOMMouseScroll', function (e) {
		var bottomOverflow, delta, topOverflow;
		delta = e.wheelDelta || e.originalEvent && e.originalEvent.wheelDelta || -e.detail;
		bottomOverflow = this.scrollTop + $(this).outerHeight() - this.scrollHeight >= 0;
		topOverflow = this.scrollTop <= 0;

		if (delta < 0 && bottomOverflow || delta > 0 && topOverflow) {
			return e.preventDefault();
		}
	});
};