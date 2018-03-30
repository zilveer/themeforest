(function($, undefined) {
	"use strict";

	var win = $(window),
		win_height = win.height();

	var explorer = /MSIE (\d+)/.exec(navigator.userAgent);

	win.bind('resize', function() {
		win_height = win.height();

		if(
			!Modernizr.csscalc ||
			(explorer && parseInt(explorer[1], 10) === 8) ||
			$.WPV.MEDIA.is_mobile() ||
			$.WPV.MEDIA.layout["layout-below-max"]
		) {
			$('.wpv-grid.parallax-bg').removeClass('parallax-bg').addClass('parallax-bg-suspended');
			$('.wpv-parallax-bg-img').css({
				'background-position': '50% 50%'
			});
		} else {
			$('.wpv-grid.parallax-bg-suspended').removeClass('parallax-bg-suspended').addClass('parallax-bg');
			win.scroll();
		}
	});

	var new_pos = function(method, x, top, cpos, inertia, height) {
		var vert = '';

		switch(method) {
			case 'fixed':
				vert = Math.round( (cpos - top) * inertia)  + "px";
			break;

			case 'to-centre':
				vert = 'calc(50% - '+ Math.round( (top + height/2 - cpos - win_height/2)*inertia ) + 'px)';
			break;
		}

		return x + ' ' +  vert;
	};

	win.bind('scroll touchmove load', _.throttle(function() {
		var cpos = win.scrollTop(),
			all_visible = cpos + win_height;

		$('.wpv-grid.parallax-bg').each(function() {
			var top = $(this).offset().top,
				height = $(this).outerHeight();

			if(top + height < cpos || top > all_visible)
				return;

			var fakebg = $('.wpv-parallax-bg-img', this);

			if(!fakebg.length) return;

			var method = $(this).data('parallax-method'),
				inertia = $(this).data('parallax-inertia'),
				bgpos = new_pos(method, '50%', top, cpos, inertia, height),
				css = {'background-position': bgpos};

			fakebg.css(css);
		});
	}, 41));

	var bgprops = 'position image color size attachment repeat'.split(' ');

	$(function() {
		$('.wpv-grid.parallax-bg:not(.parallax-loaded)').each(function() {
			var self = $(this);

			var local_bgprops = {};
			$.each(bgprops, function(i, p) {
				local_bgprops['background-'+p] = self.css('background-'+p);
			});

			self.addClass('parallax-loaded').wrapInner(function() {
				return $('<div></div>').addClass('wpv-parallax-bg-content');
			}).prepend(function() {
				var div = $('<div></div>')
					.addClass('wpv-parallax-bg-img')
					.css(local_bgprops);

				return div;
			}).css('background', '');
		});

		win.scroll();
	});
})(jQuery);