(function($, undefined) {
	'use strict';

	$(function() {
		$('.wpv-countdown').each(function() {
			var days = $('.wpvc-days .value', this);
			var hours = $('.wpvc-hours .value', this);
			var minutes = $('.wpvc-minutes .value', this);
			var seconds = $('.wpvc-seconds .value', this);

			var until = parseInt($(this).data('until'), 10);
			var done = $(this).data('done');

			var self = $(this);

			var updateTime = function() {
				var now = Math.round( (+new Date()) / 1000 );

				if(until <= now) {
					clearInterval(interval);
					self.html($('<span />').addClass('wpvc-done wpvc-block').html($('<span />').addClass('value').text(done)));
					return;
				}

				var left = until-now;

				seconds.text(left%60);

				left = Math.floor(left/60);
				minutes.text(left%60);

				left = Math.floor(left/60);
				hours.text(left%24);

				left = Math.floor(left/24);
				days.text(left);
			};

			var interval = setInterval(updateTime, 1000);
		});
	});
})(jQuery);