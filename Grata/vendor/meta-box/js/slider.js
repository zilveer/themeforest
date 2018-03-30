jQuery( function( $ )
{
	$( ':input.rwmb-slider-value' ).each( rwmb_update_slider );
	$( '.rwmb-input' ).on( 'clone', ':input.rwmb-slider-value', rwmb_update_slider );

	function rwmb_update_slider()
	{
		var $input = $( this ),
			$slider = $input.siblings( '.rwmb-slider' ),
			$valueLabel = $slider.siblings( '.rwmb-slider-value-label' ).find( 'span' ),
			value = $input.val(),
			options = $slider.data( 'options' );

		$slider.html( '' );

		if ( !value )
		{
			value = 50;
			$input.val( 50 );
			$valueLabel.text( '50' );
		}
		else
		{
			$valueLabel.text( value );
		}

		// Assign field value and callback function when slide
		options.value = value;
		options.slide = function( event, ui )
		{
			$input.val( ui.value );
			$valueLabel.text( ui.value );
		};

		$slider.slider( options );
	}
} );
