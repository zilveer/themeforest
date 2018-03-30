(function($, undefined) {
	"use strict";

	var show = function() {
		var self = $(this);

		if(self.closest('.animated-active:not(.animation-ended)').length > 0)
			return;

		if(self.data('closed-at') && (+new Date()) - self.data('closed-at') < 300)
			return;

		var	c = self.clone();

		setTimeout(function() {
			var parent_width = $.WPV.MEDIA.layout["layout-below-max"] ? self.width() : self.parent().width();

			c.css({
				width: parent_width,
				position: 'absolute',
				left: self.parent().position().left + parseFloat(self.parent().css('padding-left'), 10),
				top: self.parent().position().top,
				zIndex: 10000000000
			})
			.addClass('transitionable');

			if(!self.attr('id'))
				self.attr('id', 'hover-id-'+Math.round(Math.random()*100000000));

			if(!c.attr('id'))
				c.attr('id', 'hover-clone-id-'+Math.round(Math.random()*100000000));

			if($('#'+self.attr('id')+':hover').length === 0) return;

			self.css({visibility: 'hidden'});

			c.appendTo(self.closest('.row')).addClass('state-hover');

			c.find('.shrinking .icon').transit({
				'font-size': Math.min(100, parent_width - 15)
			}, 200, 'easeOutQuad');

			var content = c.find('.services-content').slideDown({
				duration: 200,
				easing: 'easeOutQuad'
			});

			var interval = setInterval(function() {
				if(!Modernizr.touch && $('#'+c.attr('id')+':hover').length === 0) {
					clearInterval(interval);
					c.trigger('mouseleave');
				}
			}, 500);

			var close = function() {
				if(!$(this).hasClass('state-hover')) return;

				c.removeClass('state-hover');

				c.find('.shrinking .icon').transit({
					'font-size': 60
				}, 500, 'easeOutQuad');

				content.slideUp({
					duration: 500,
					easing: 'easeOutQuad',
					complete: function() {
						c.remove();
						self.css({visibility: 'visible'}).data('closed-at', (+new Date()));
					}
				});
			};

			if ( ! Modernizr.touch ) {
				c.unbind('mouseleave.shrinking').bind('mouseleave.shrinking', close);
			}
		}, 20);
	};

	$.rawContentHandler(function() {
		var s = $('.services:has(.shrinking)');

		if ( ! Modernizr.touch ) {
			s.unbind('mouseenter.shrinking').bind('mouseenter.shrinking', show);
		}
	});

	var resize = function() {
		$('.services:not(.transitionable) .shrinking').each(function() {
			var _w = $(this).width();
				$(this).height(_w);
				$(this).find('.icon').css({'line-height': _w+'px'});

				$(this).closest('.services').prev().css({width: _w});
			});
	};

	$(window).bind('resize', resize);
	resize();

})(jQuery);