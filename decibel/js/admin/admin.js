var WolfAdminParams =  WolfAdminParams || {},
	console = console || {};

;( function( $ ) {

	'use strict';

	// alert( $( '.wpb_el_type_searchable .wolf-vc-searchable' ).attr('name') );

/*-----------------------------------------------------------------------------------*/
/*	Searchable Dropdown
/*-----------------------------------------------------------------------------------*/

	$( '.wpb_el_type_searchable .wolf-searchable, .searchable-icon' ).chosen( {
		no_results_text: WolfAdminParams.noResult,
		width: '100%'
	} );

	$( document ).on( 'hover', '.wpb_el_type_searchable', function() {
		if ( ! $( this ).find( '.chosen-container' ).length && $( this ).find( '.wolf-searchable' ).length ) {
			$( this ).find( '.wolf-searchable' ).chosen( {
				no_results_text: WolfAdminParams.noResult,
				width: '100%'
			} );
		}
	} );

	/* Search */
	$( 'input.icon-search' ).on( 'keyup', function() {
		var valThis = $( this ).val().toLowerCase();
		// console.log( valThis );
		$( '.icon-box-container ').find( '.icon-box' ).each( function() {
			var text = $( this ).data( 'name' ).toLowerCase();
			// console.log( text );
			( text.indexOf( valThis ) === 0 ) ? $( this ).show() : $( this ).hide();
		} );
	} );

} )( jQuery );