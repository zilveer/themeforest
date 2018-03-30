(function($, undefined) {
	'use strict';

	$.fn.wpvAnimateNumber = function(options) {
		var defaultOptions = {
			from: 0,
			to: 0,
			animate: 1000,
			easing: function (x, t, b, c, d) {
				t = t / (d/2);
				if (t < 1) {
					return c / 2 * t * t + b;
				}
				return -c/2 * ((--t)*(t-2) - 1) + b;
			},
			onStep: $.noop,
			el: null
		};

		options = $.extend(defaultOptions, options);

		if (typeof(options.easing) === 'string' && typeof(jQuery) !== 'undefined' && jQuery.isFunction(jQuery.easing[options.easing])) {
			options.easing = jQuery.easing[options.easing];
		} else {
			options.easing = defaultOptions.easing;
		}

		var reqAnimationFrame = (function() {
			return  window.requestAnimationFrame ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame ||
					function(callback) {
						window.setTimeout(callback, 1000 / 60);
					};
		}());

		$(this).each(function() {
			options.to = $(this).data('number') || options.to;
			var init = function() {
				var startTime = Date.now();
				var animation = function() {
					var process = Math.min(Date.now() - startTime, options.animate);
					var currentValue = options.easing(this, process, options.from, options.to - options.from, options.animate);
					options.onStep.call(this, options.from, options.to, currentValue);
					if (process < options.animate) {
						reqAnimationFrame(animation);
					}
				}.bind(this);

				reqAnimationFrame(animation);
			}.bind(this);

			init();
		});
	};
})(jQuery);
