jQuery( function( $ ) {

	// Quantity buttons
	function add_quantity_buttons() {
		$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );
	}
	add_quantity_buttons();

	$( document ).ajaxComplete(function() {
		add_quantity_buttons();
		
		// Fix for shop quick view which does not respect $( document ).on( 'click', '.plus, .minus'...
		$( '.mk-modal' ).find('.plus, .minus').off('click').on('click', function() {
			handle_quantity_buttons( $(this) );
		});
	});

	$( document ).on( 'click', '.plus, .minus', function() {
		handle_quantity_buttons( $(this) );
	});

	function handle_quantity_buttons($elem) {
		// Get values
		var $qty		= $elem.closest( '.quantity' ).find( '.qty' ),
			currentVal	= parseFloat( $qty.val() ),
			max			= parseFloat( $qty.attr( 'max' ) ),
			min			= parseFloat( $qty.attr( 'min' ) ),
			step		= $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if ( max === '' || max === 'NaN' ) max = '';
		if ( min === '' || min === 'NaN' ) min = 0;
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

		// Change the value
		if ( $elem.is( '.plus' ) ) {

			if ( max && ( max == currentVal || currentVal > max ) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && ( min == currentVal || currentVal < min ) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}

		// Trigger change event
		$qty.trigger( 'change' );
	}

});