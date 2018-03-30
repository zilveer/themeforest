var WolfCustomizer =  WolfCustomizer || {};

;( function( $ ) {

	'use strict';

	$( '.wolf-preset-button' ).on( 'click', function( event ) {
		event.preventDefault();
		var skin = $( this ).attr( 'rel' ),
			data = {
				action : 'wolf_live_presets',
				skin : skin
			};

		if ( ( skin === 'reset' && window.confirm( WolfCustomizer.resetOptionsConfirmMessage ) ) || ( skin !== 'reset' ) ) {
			$.post( WolfCustomizer.ajaxUrl , data, function( response ) {

				if ( response === 'OK' ) {
					window.location.reload();
				}

			} );
		}
	} );

} )( jQuery );