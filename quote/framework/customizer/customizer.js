/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-name a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'footer_background_colour', function( value ) {
		value.bind( function( to ) {
				$( '#footer' ).css( {
					'background': to
				} );
		} );
	} );

	wp.customize( 'header_background_colour', function( value ) {
		value.bind( function( to ) {
				$( '#header, .header-menu ul ul.sub-menu, .header-menu ul ul.sub-menu li, .header-menu ul ul.children li' ).css( {
					'background': to
				} );
		} );
	} );

	wp.customize('accent_colour', function(value){ 
        value.bind(function(to){
            $('#loop-nav-next-prev a, #loop-nav-singlular-post a, #respond input[type="submit"], a.comment-reply-link, a.more-link:link, a.more-link:visited, #scrollUp').css('background', to);
        });
    });

	wp.customize('body_width', function(value){ 
        value.bind(function(newval){
        	val = newval+'px';
            $('.container').css('max-width', val);
   		});
    });

	wp.customize('logo_margin', function(value){ 
        value.bind(function(newval){
        	val = newval;
            $('.logo-img').css('margin-top', val);
   		});
    });


} )( jQuery );
