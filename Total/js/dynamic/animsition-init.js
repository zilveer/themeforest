( function( $ ) {
	'use strict';
	$( document ).on( 'ready', function() {
		if ( $( '.animsition' ).length ) {
			var $settings = wpexLocalize.animsition;
			$( '.animsition' ).animsition( {
				touchSupport : false,
				inClass      : $settings.inClass,
				outClass     : $settings.outClass,
				inDuration   : parseInt( $settings.inDuration ),
				outDuration  : parseInt( $settings.outDuration ),
				linkElement  : $settings.linkElement,
				loading      : true
			} );
		}
	} );
} ) ( jQuery );