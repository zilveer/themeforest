( function( $, undefined ) {
	"use strict";

	$.fn.uirange = function() {
		return this.each(function() {
			this.type = 'text';

			var input = $( this );
			input.parent().wrap( '<div class="ui-range"></div>' );

			var wrap = $( this ).closest( '.ui-range' );
			var sl = wrap.append( '<div class="ui-range-slider"></div>' ).find( '.ui-range-slider' );

			// an object with the definitions of our range
			var range = {};
			range.min = parseFloat( input.attr( "min" ), 10 );
			range.max = parseFloat( input.attr( "max" ), 10 );
			range.step = parseFloat( input.attr( "step" ), 10 );

			if ( input.val() === '' ) {
				input.val( range.min );
			}

			// initialize ui.slider
			sl.slider( {
				range: "min",
				min: range.min,
				max: range.max,
				value: ( input.val() === '' ? range.min : parseFloat( input.val(), 10 ) ),
				step: range.step || 1,
				slide: function( evt, ui ) {
					input.val( ui.value ).change();
				},
				change: function( evt, ui ) {
					input.val( ui.value ).change();
				}
			} );

			input.change( function() {
				// undo the user input if it's outside the range
				if ( input.val() < range.min || input.val() > range.max || input.val() === '' ) {
					input.val( sl.slider( 'value' ) );
				} else {
					// otherwise correct the slider's position

					var prev = $( this ).data( 'prev-value' );
					if ( prev !== input.val() ) {
						$( this ).data( 'prev-value', input.val() );
						sl.slider( 'value', input.val() );
					}
				}
			});
		});
	};

} )( jQuery );