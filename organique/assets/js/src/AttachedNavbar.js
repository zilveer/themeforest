/**
 * Sticky/attached header
 */
define(['jquery', 'underscore', 'enquire'], function ($, _) {

	var attachedNavbar = function () {
		if( $('.js--navbar').length > 0 ) {
			$(window).on('scroll.attachedNavbar', _.throttle(function() {
				$('body').toggleClass( 'fixed-header', $(window).scrollTop() > $('.js--fixed-header-offset').height() );
			}, 40 )); // only trigered once every 40ms = 25 fps = very cool for performance
		}
	};

	var removeAttachedNavbar = function () {
		$(window).off('scroll.attachedNavbar');
		$('body').removeClass( 'fixed-header' );
	};


	enquire.register('screen and (min-width: 992px)', {
		match: function() {
			attachedNavbar();
		},
		unmatch: function () {
			removeAttachedNavbar();
		}
	});
});