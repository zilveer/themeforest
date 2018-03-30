define( ['jquery'], function ( $ ) {
	'use strict';

	// We assume there is a global Moderniz object with test for touch
	if ( !! Modernizr && Modernizr.touch && Modernizr.mq( '(min-width: 992px)' ) ) {
		// Each menu should where we want to add dropdown functionality should have a .js-dropdown class
		$( 'ul.js-dropdown' ).each( function ( i, elm ) {
			$( elm ).children( '.menu-item-has-children' ).on( 'click.td', 'a', function ( ev ) {
				ev.preventDefault();

				$( ev.delegateTarget ).addClass( 'is-hover' );
				$( ev.delegateTarget ).off( 'click.td' );
			} );
		} );
	}

} );