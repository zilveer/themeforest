/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Site description
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-subtitle' ).text( to );
		} );
	} );

	// Header Font
	wp.customize( 'header-font', function( value ) {
		value.bind( function( to ) {
			$( 'h1, h2, h3, h4, h5, h6, h1 a,h2 a,h3 a,h4 a,h5 a,h6 a, .entry-content table th, .entry-title h1 a' ).css( 'font-family', to );
		} );
	} );

	// Paragraph Font
	wp.customize( 'paragraph-font', function( value ) {
		value.bind( function( to ) {
			$( 'p, a, .textwidget, .top-bar-section ul li > a, .blog_area_wrap .blog_section_title h5, .shop_section_title h5, .rescue_text, footer .copyright_wrap .site-info, .entry-content ul li, .entry-content table tr td, .content-area .entry-meta, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce span.onsale, .woocommerce-page span.onsale, .widget-area a.button' ).css( 'font-family', to );
		} );
	} );

	// Top navigation background color
	wp.customize( 'top_nav_bg', function( value ) {
		value.bind( function( to ) {
			$( '.mini_nav_wrap, .mini_nav .menu-top-header-container ul li ul li a, .mini_nav .menu-top-header-container ul li a:hover, .mini_nav .menu-top-header-container li a:focus, .mini_nav .menu-top-header-container li.active:not(.has-form) a:hover:not(.button), .mini_nav .menu-top-header-container ul li:hover:not(.has-form) > a, .mini_nav .menu-top-header-container ul li.has-dropdown:hover:not(.has-form) > a, .mini_nav .menu-top-header-container li.active:not(.has-form) a.menu-item-has-children:hover:not(.button), .mini_nav .menu-top-header-container ul.sub-menu li a:hover' ).css( 'background-color', to );
		} );
	} );

	// Bottom navigation background color
	wp.customize( 'bottom_nav_bg', function( value ) {
		value.bind( function( to ) {
			$( '.inner_header_wrap .header_bg' ).css( 'background-color', to );
		} );
	} );

	// Header button color
	wp.customize( 'button_color', function( value ) {
		value.bind( function( to ) {
			$( '.donate-button-wrap .donate_button' ).css( 'background-color', to );
		} );
	} );

	// Header button text color
	wp.customize( 'button_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.donate-button-wrap .donate_button' ).css( 'color', to );
		} );
	} );

	// Donate Button Text
	wp.customize( 'button_text', function( value ) {
		value.bind( function( to ) {
			$( '.donate_button' ).text( to );
		} );
	} );

	// Bottom navigation background color
	wp.customize( 'hero_widgets_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.hero_sidebar' ).css( 'background-color', to );
		} );
	} );

	// Title for the Home Posts section
	wp.customize( 'home_blog_title', function( value ) {
		value.bind( function( to ) {
			$( '.blog_area_wrap .blog_section_title h2' ).text( to );
		} );
	} );

	// Subtitle for the Home Posts section
	wp.customize( 'home_blog_subtitle', function( value ) {
		value.bind( function( to ) {
			$( '.blog_area_wrap .blog_section_title h5' ).text( to );
		} );
	} );

	// Title for the Home Shop section
	wp.customize( 'home_blog_button_text', function( value ) {
		value.bind( function( to ) {
			$( '.blog_area_wrap .blog_section_title a' ).text( to );
		} );
	} );

	// Bottom navigation background color
	wp.customize( 'home_blog_bg_color', function( value ) {
		value.bind( function( to ) {
			$( '.blog_area_wrap' ).css( 'background-color', to );
		} );
	} );

	// Text for the Home Posts section link
	wp.customize( 'home_shop_title', function( value ) {
		value.bind( function( to ) {
			$( '.shop_section_title h2' ).text( to );
		} );
	} );

	// Sub-Title for the Home Shop section
	wp.customize( 'home_shop_subtitle', function( value ) {
		value.bind( function( to ) {
			$( '.shop_section_title h5' ).text( to );
		} );
	} );

	// Title to main forums page
	wp.customize( 'forum_title', function( value ) {
		value.bind( function( to ) {
			$( '.blog_header_content h1.breadcrumb_wrap a.bbp-forum-title' ).text( to );
		} );
	} );

	// Footer copyright text
	wp.customize( 'footer_copyright', function( value ) {
		value.bind( function( to ) {
			$( '.copyright_wrap span' ).text( to );
		} );
	} );

	// Footer Button Color
	wp.customize( 'footer_button_color', function( value ) {
		value.bind( function( to ) {
			$( '.footer_donate a span' ).css( 'background-color', to );
		} );
	} );

	// Footer Button Text Color
	wp.customize( 'footer_button_text_color', function( value ) {
		value.bind( function( to ) {
			$( '.footer_donate .donate_button' ).css( 'color', to );
		} );
	} );

	// Footer copyright text
	wp.customize( 'footer_button_text', function( value ) {
		value.bind( function( to ) {
			$( '.footer_donate span.donate_button' ).text( to );
		} );
	} );

} )( jQuery );
