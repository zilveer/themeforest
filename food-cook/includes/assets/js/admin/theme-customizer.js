/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 */
(function($) {

	   // HEADER
  	var callusTrigger = $('#customize-control-df_options-check_callus input');
    var callustextOption = $('#customize-control-df_options-text_callus');
    
        if (!callusTrigger.is(':checked')) {
    callustextOption.css('display', 'none');
  	}
  	
      callusTrigger.change( function() {
    if (callusTrigger.is(':checked')) {
      callustextOption.css('display', 'block');
    } else {
      callustextOption.css('display', 'none');
    }
    });
    
    // FOOTER 
	var footerRightTrigger = $('#customize-control-df_options-footer_right input');
	var footerLeftTrigger = $('#customize-control-df_options-footer_left input');
    var footertextRightOption = $('#customize-control-df_options-footer_right_text');
    var footertextLeftOption = $('#customize-control-df_options-footer_left_text');

    if (!footerRightTrigger.is(':checked')) {
    footertextRightOption.css('display', 'none');
  	}

    if (!footerLeftTrigger.is(':checked')) {
    footertextLeftOption.css('display', 'none');
  	}

  	    footerRightTrigger.change( function() {
    if (footerRightTrigger.is(':checked')) {
      footertextRightOption.css('display', 'block');
    } else if (!footerRightTrigger.is(':checked')) {
      footertextRightOption.css('display', 'none');
    }
  });

  	    footerLeftTrigger.change( function() {
    if (footerLeftTrigger.is(':checked')) {
      footertextLeftOption.css('display', 'block');
    } else if (!footerLeftTrigger.is(':checked')) {
      footertextLeftOption.css('display', 'none');
    }
  });

  


	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).html( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).html( to );
		} );
	} );

	// Hook into background color change and adjust body class value as needed.
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			if ( '#ffffff' == to || '#fff' == to )
				$( 'body' ).addClass( 'custom-background-white' );
			else if ( '' == to )
				$( 'body' ).addClass( 'custom-background-empty' );
			else
				$( 'body' ).removeClass( 'custom-background-empty custom-background-white' );
		} );
	} );
} )(jQuery);