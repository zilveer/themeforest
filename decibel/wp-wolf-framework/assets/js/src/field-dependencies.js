/*-----------------------------------------------------------------------------------*/
/*	Field dependencies
/*-----------------------------------------------------------------------------------*/

;( function( $ ) {

	'use strict';

	$( '.has-dependency' ).each( function () {

		var $this = $( this ),
			selectValue,
			relatedElement = $( this ).data( 'dependency-element' ),
			values = $( this ).data( 'dependency-values' );


		selectValue = $( '.option-section-' + relatedElement ).find( 'select' ).val();
			
		if ( $.inArray( selectValue, values )  !== -1 ) {
			$this.show();
		} else {
			$this.hide();
		}

		$( '.option-section-' + relatedElement ).find( 'select' ).on( 'change', function() {
			selectValue = $( this ).val();
			
			if ( $.inArray( selectValue, values )  !== -1 ) {
				$this.show();
			} else {
				$this.hide();
			}
		} );
	} );

} )( jQuery );