/**
 * Filters for WooCommerce
 */

define( [ 'jquery', 'underscore' ], function ( $, _ ) {
	/**
	 * Populate hidden input fields
	 */
	var $filterForm     = $( '.js--filter-form-organique' ),
		getFilterData = function () {

		var $hiddenFields = $( '.js--filter-form-organique-fields' );

		$hiddenFields.empty();

		$( '.filter-attribute' ).each( function() {
			var attribute = $( this ).attr( 'data-attribute' );
			var content   = [];
			$( 'input[data-attribute="' + attribute + '"]:checked' ).each( function() {
				content.push( $( this ).val() );
			} );

			if ( content.length ) {
				$hiddenFields.append( '<input type="hidden" name="' + attribute + '" value="' + content.join( ',' ) + '" />' );
			}
		} );
	};

	$( 'input[data-attribute]' ).on( 'change', function() {
		getFilterData();
	} );

	$filterForm.on( 'submit.tmpDisable', function( ev ) {
		ev.preventDefault();
		getFilterData();
		$filterForm.off( 'submit.tmpDisable' );
		$filterForm.submit();
	} );

	/**
	 * Check all the children for shop filter categories
	 */
	$( '.js--categories-checkboxes' ).on( 'change', '.js--cat', function () {
		var $this     = $(this),
			$children = $this.parent().siblings( '.js--categories-checkboxes' ).find( '.js--cat' );

		if ( $this.is(':checked') ) {
			$children.prop( 'checked', true );
		} else {
			$children.prop( 'checked', false );
		}
	} );
} );