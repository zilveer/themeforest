/*-----------------------------------------------------------------------------------*/
/*	Searchable Dropdown
/*-----------------------------------------------------------------------------------*/

var WolfAdminParams =  WolfAdminParams || {};

;( function( $ ) {

	'use strict';

	$( '.wolf-searchable' ).chosen( {
		no_results_text: WolfAdminParams.noResult,
		width: '100%'
	} );

	$( document ).on( 'hover', '#menu-to-edit .pending', function() {
		if ( ! $( this ).find( '.chosen-container' ).length && $( this ).find( '.wolf-searchable' ).length ) {
			$( this ).find( '.wolf-searchable' ).chosen( {
				no_results_text: WolfAdminParams.noResult,
				width: '100%'
			} );
		}
	} );

} )( jQuery );