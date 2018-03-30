( function( $, undefined ) {
	'use strict';

	var win = $( window ),
		win_height = 0;

	var explorer = /MSIE (\d+)/.exec( navigator.userAgent ),
		mobileSafari = navigator.userAgent.match( /(iPod|iPhone|iPad)/ ) && navigator.userAgent.match( /AppleWebKit/ );

	win.resize(function() {
		win_height = win.height();

		if (
			( explorer && parseInt( explorer[1], 10 ) === 8 ) ||
			mobileSafari ||
			$.WPV.MEDIA.layout['layout-below-max']
		) {
			$( '.wpv-grid.animated-active' ).removeClass( 'animated-active' ).addClass( 'animated-suspended' );
		} else {
			$( '.wpv-grid.animated-suspended' ).removeClass( 'animated-suspended' ).addClass( 'animated-active' );
		}
	}).resize();

	win.bind( 'scroll touchmove load', function() {
		var win_height = win.height();
		var all_in = $(window).scrollTop() + win_height;

		$( '.wpv-grid.animated-active:not(.animation-ended)' ).each( function() {
			var el = $( this );
			var el_height = el.outerHeight();
			var visible   = all_in > el.offset().top + el_height * ( el_height > 100 ? 0.3 : 0.6 );

			if ( visible || mobileSafari ) {
				el.addClass( 'animation-ended' );
			} else {
				return false;
			}
		} );
	} ).scroll();
} )( jQuery );