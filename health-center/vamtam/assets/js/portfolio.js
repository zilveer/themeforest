(function($, undefined) {
	'use strict';

	var transDuration = 700,
		body = $('body');

	var doClose = function() {
		if($(this).hasClass('state-closed'))
			return;

		body.unbind('touchstart.portfolio-overlay-close'+$(this).data('id'));

		$(this).addClass('state-closed').removeClass('state-open');
		$('.portfolio_details.has-overlay', this).stop(true, true).animate({
			opacity: 1
		}, transDuration/2);

		$('.thumbnail-overlay, .love-count-outer', this).fadeOut({
			opacity: 0
		}, {
			duration: transDuration
		});
	};

	var doOpen = function() {
		var self = $(this);
		if(self.hasClass('state-open'))
			return;

		self.addClass('state-open').removeClass('state-closed');

		$('.portfolio_details.has-overlay', this).stop(true, true).animate({
			opacity: 0
		}, transDuration);

		$('.thumbnail-overlay, .love-count-outer', this).stop(true, true).fadeIn({
			duration: transDuration,
			easing: 'easeOutQuint'
		});

		if(Modernizr.touch) {
			var bodyEvent = 'touchstart.portfolio-overlay-close'+self.data('id');
			body.bind(bodyEvent, function() {
				// console.log('event 2');
				body.unbind(bodyEvent);
				doClose.call(self);
			});
		} else {
			$(this).bind('mouseleave.portfolio-overlay-close', function() {
				// console.log('event 3');
				$(this).unbind('mouseleave.portfolio-overlay-close');
				doClose.call(this);
			});
		}
	};

	$(function() {
		var portfolios = $('.portfolios');

		if(Modernizr.touch) {
			portfolios.on('click.portfolio-overlay', '.portfolio-items > li', function() {
				// console.log('event 4');
				doOpen.call(this);
			});

			portfolios.on('click', '.portfolio-items > li a', function(e) {
				var self = $(this).closest('.portfolios .portfolio-items > li');

				// console.log('event 5');
				if($(self).hasClass('state-closed')) {
					e.preventDefault();
				} else {
					e.stopPropagation();
				}
			});

			portfolios.on('touchstart', '.portfolio-items > li a', function(e) {
				var self = $(this).closest('.portfolios .portfolio-items > li');

				// console.log('event 5.1');
				if(!$(self).hasClass('state-closed')) {
					e.stopPropagation();
				}
			});
		} else {
			portfolios.on('mouseenter', '.portfolio-items > li', function() {
				// console.log('event 6');
				doOpen.call(this);
			});
		}
	});
})(jQuery);