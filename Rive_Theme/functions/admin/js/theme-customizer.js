/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 */

(function($) {
	// Site title and description.
	/*wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.content p' ).html( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).html( to );
		} );
	} );*/
	wp.customize( 'ch_color_scheme', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'red-color-scheme teal-color-scheme blue-color-scheme autum-color-scheme' ).addClass(to);
		});
	} );

	wp.customize( 'ch_site_layout_style', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).removeClass( 'layout-boxed layout-wide' ).addClass('layout-' + to);
			if ( to == 'boxed' ) {
				$( '#header_container_class' ).removeClass('container');
			} else {
				$( '#header_container_class' ).addClass( 'container' );
			}
		});
	} );

	// Hook into background color change and adjust body class value as needed.
	wp.customize('background_color', function( value ) {
		value.bind( function( to ) {
			if ( '#ffffff' == to || '#fff' == to ) {
				$( 'body' ).addClass( 'custom-background-white' );
			} else if ( '' == to ) { console.log(to);
				$( 'body' ).addClass( 'custom-background-empty' );
			} else {
				$( 'body' ).removeClass( 'custom-background-empty custom-background-white' );
			}
		});
	});
})(jQuery);