(function($, undefined) {
	"use strict";

	$(function() {
		$('.wpv-progress.pie').one('wpv-progress-visible', function() {
			$(this).addClass('started').easyPieChart({
				animate: 1000,
				scaleLength: 0,
				lineWidth: 11,
				size: 130,
				lineCap: 'square',
				onStep: function(from, to, value) {
					$(this.el).find('span:first').text(~~value);
				}
			});
		});

		$('.wpv-progress.number').each(function() {
			$(this).one('wpv-progress-visible', function() {
				$(this).addClass('started').wpvAnimateNumber({
					onStep: function(from, to, value) {
						$(this).find('span:first').text(~~value);
					}
				});
			});
		});

		var win = $(window),
			win_factor = 0.6,
			win_height = 0;

		var mobileSafari = navigator.userAgent.match(/(iPod|iPhone|iPad)/) && navigator.userAgent.match(/AppleWebKit/);

		setTimeout(function() {
			$(window).scroll(function() {
				win_height = win.height();

				var all_visible = $(window).scrollTop() + win_height * win_factor;

				$('.wpv-progress:not(.started)').each(function() {
					if( all_visible > $(this).offset().top || mobileSafari ) {
						$(this).trigger('wpv-progress-visible');
					}
				});
			}).scroll();
		}, 300);
	});

})(jQuery);