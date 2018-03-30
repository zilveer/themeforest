/*-----------------------------------------------------------------------------------*/
/*	Admin notices
/*-----------------------------------------------------------------------------------*/

;( function( $ ) {

	'use strict';

	$( '.wolf-close-admin-notice' ).click( function() {

		$( this ).parent().parent().slideUp();

	} );

	$( '.wolf-dismiss-admin-notice' ).click( function() {

		var message = $( this );

		if ( message.attr( 'id' ) ) {
			var id = message.attr( 'id' );
			$.cookie( id,  "false", { path: '/', expires: 365 } );
			$( this ).parent().parent().slideUp();
		}

	} );
} )( jQuery );