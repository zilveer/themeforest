<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package Customizer Library
 */

if ( ! function_exists( 'heartfelt_customizer_library_build_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function heartfelt_customizer_library_build_styles() {

	// Header Top Nav BG
	$setting = 'top_nav_bg';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.mini_nav_wrap, .mini_nav .menu-top-header-container ul li ul li a, .mini_nav .menu-top-header-container ul li a:hover, .mini_nav .menu-top-header-container li a:focus, .mini_nav .menu-top-header-container li.active:not(.has-form) a:hover:not(.button), .mini_nav .menu-top-header-container ul li:hover:not(.has-form) > a, .mini_nav .menu-top-header-container ul li.has-dropdown:hover:not(.has-form) > a, .mini_nav .menu-top-header-container li.active:not(.has-form) a.menu-item-has-children:hover:not(.button), .mini_nav .menu-top-header-container ul.sub-menu li a:hover'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Header Bottom Nav BG
	$setting = 'bottom_nav_bg';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.inner_header_wrap .header_bg'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Header Button Color
	$setting = 'button_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.donate-button-wrap .donate_button'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Header Button Text Color
	$setting = 'button_text_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.donate-button-wrap .donate_button'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Header Button Hover Color
	$setting = 'button_hover_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.donate-button-wrap a:hover .donate_button'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Home Top Widgets Background Color
	$setting = 'hero_widgets_bg_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.hero_sidebar'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Home Top Widgets Text Hover Color
	$setting = 'hero_text_hover_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.hero_sidebar i, .hero_sidebar .textwidget a:hover, .hero_sidebar .textwidget:hover a'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Home Blog Section Background Color
	$setting = 'home_blog_bg_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.blog_area_wrap'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Main Background Color
	$setting = 'main_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.home_shop_wrap .woocommerce span.onsale, .blog_area_wrap .blog_meta, .blog_area_wrap .owl-controls .owl-pagination .active span, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .header-cart ul#cart_drop li a.checkout_button, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover, .woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce-page span.onsale, .woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce .woocommerce-error, .woocommerce .woocommerce-info, .woocommerce .woocommerce-message, .woocommerce-page .woocommerce-error, .woocommerce-page .woocommerce-info, .woocommerce-page .woocommerce-message, .woocommerce .woocommerce-error a.button, .woocommerce .woocommerce-info a.button, .woocommerce .woocommerce-message a.button, .woocommerce-page .woocommerce-error a.button, .woocommerce-page .woocommerce-info a.button, .woocommerce-page .woocommerce-message a.button, .woocommerce-checkout .woocommerce-info a.showlogin, .woocommerce-checkout .woocommerce-info a.showcoupon, ul.products li.product:hover a.button, aside.widget_tag_cloud a,.widget_categories li:hover span, .widget_archive li:hover span, .entry-footer a, #bbp-search-form input#bbp_search_submit:hover, #comments .comment-text .rescue_staff, #tribe-events-content .tribe-events-event-cost button, footer.site-footer .wpcf7-form input[type="submit"], .bbpress button, .bbpress .button'
			),
			'declarations' => array(
				'background' => $color
			)
		) );
	}

	// Main Color
	$setting = 'main_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'a:hover, a:focus, .rescue-toggle h3.rescue-toggle-trigger:hover, .bottom_nav_wrap .top-bar-section ul li a:hover, .bottom_nav_wrap .top-bar-section li a:focus, .bottom_nav_wrap .top-bar-section li.active:not(.has-form) a:hover:not(.button), .bottom_nav_wrap .top-bar-section ul li:hover:not(.has-form) > a, .bottom_nav_wrap .top-bar-section ul li.has-dropdown:hover:not(.has-form) > a, .bottom_nav_wrap .top-bar-section li.active:not(.has-form) a.menu-item-has-children:hover:not(.button), .mini_nav .menu-top-header-container ul li a:hover, .mini_nav .menu-top-header-container li a:focus, .mini_nav .menu-top-header-container li.active:not(.has-form) a:hover:not(.button), .mini_nav .menu-top-header-container ul li:hover:not(.has-form) > a, .mini_nav .menu-top-header-container ul li.has-dropdown:hover:not(.has-form) > a, .mini_nav .menu-top-header-container li.active:not(.has-form) a.menu-item-has-children:hover:not(.button), .mini_nav .menu-top-header-container ul.sub-menu li a:hover, .home_shop_wrap .shop_section_title a:hover, .blog_area_wrap .blog_section_title a:hover, .blog_area_wrap span.text-content a:hover, .blog_area_wrap .blog_title h5 a, .header-cart ul#cart_drop li a.header_shop_button:hover, .header-cart a.cart-contents:hover, .woocommerce .star-rating span, .woocommerce-page .star-rating span, .woocommerce #content div.product p.price, .woocommerce #content div.product span.price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-page #content div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page div.product span.price, .woocommerce .woocommerce-error a.button:hover, .woocommerce .woocommerce-info a.button:hover, .woocommerce .woocommerce-message a.button:hover, .woocommerce-page .woocommerce-error a.button:hover, .woocommerce-page .woocommerce-info a.button:hover, .woocommerce-page .woocommerce-message a.button:hover, .woocommerce-checkout .woocommerce-info a.showlogin:hover, .woocommerce-checkout .woocommerce-info a.showcoupon:hover, .rescue_about_wrap ul li i.fa:hover, aside.widget_tag_cloud a:hover,.post_share_wrap i:hover, .entry-footer a:hover, .entry-header h1:hover, .entry-header h1 a:hover, .content-area .entry-meta .blog_comments i:hover,.widget-area aside a:hover, ul.bbp-forums li.bbp-body ul li.bbp-forum-topic-count:before, ul.bbp-forums li.bbp-body ul li.bbp-forum-reply-count:before, ul.bbp-topics li.bbp-body ul li.bbp-topic-reply-count:before, ul.bbp-topics li.bbp-body ul li.bbp-topic-voice-count:before, #bbpress-forums li a:hover, .bbpress button:hover, .bbpress .button:hover, #comments .comment-text .comment-reply-link:hover, .tribe-events-list .tribe-events-loop .tribe-events-content a:hover, footer.site-footer aside a:hover, footer.site-footer a:hover'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Main Border Color
	$setting = 'main_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.header-cart ul#cart_drop li a.view_cart_button:hover, .header-cart ul#cart_drop li a.checkout_button, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover, .woocommerce #content input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, ul.products li.product:hover a.button'
			),
			'declarations' => array(
				'border-color' => $color
			)
		) );
	}

	// Main Border Top Color
	$setting = 'main_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range'
			),
			'declarations' => array(
				'border-top-color' => $color
			)
		) );
	}


	// Main Border Bottom Color
	$setting = 'main_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.woocommerce div.product .woocommerce-tabs ul.tabs li.active a'
			),
			'declarations' => array(
				'border-bottom-color' => $color
			)
		) );
	}

	// Footer Button Color
	$setting = 'footer_button_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.footer_donate a span'
			),
			'declarations' => array(
				'background-color' => $color
			)
		) );
	}

	// Footer Button Text Color
	$setting = 'footer_button_text_color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod !== customizer_library_get_default( $setting ) ) {

		$color = sanitize_hex_color( $mod );

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.footer_donate .donate_button'
			),
			'declarations' => array(
				'color' => $color
			)
		) );
	}

	// Header Font
	$setting = 'header-font';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	$stack = customizer_library_get_font_stack( $mod );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'h1, h2, h3, h4, h5, h6, h1 a,h2 a,h3 a,h4 a,h5 a,h6 a, .entry-content table th, .entry-title h1 a'
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

	}

	// Paragraph Font
	$setting = 'paragraph-font';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	$stack = customizer_library_get_font_stack( $mod );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'p, a, .textwidget, .top-bar-section ul li > a, .blog_area_wrap .blog_section_title h5, .shop_section_title h5, .rescue_text, footer .copyright_wrap .site-info, .entry-content ul li, .entry-content table tr td, .content-area .entry-meta, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce span.onsale, .woocommerce-page span.onsale, .widget-area a.button',
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

	}

}
endif;

add_action( 'customizer_library_styles', 'heartfelt_customizer_library_build_styles' );

if ( ! function_exists( 'heartfelt_customizer_library_styles' ) ) :
/**
 * Generates the style tag and CSS needed for the theme options.
 *
 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
 * It is organized this way to ensure there is only one "style" tag.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function heartfelt_customizer_library_styles() {

	do_action( 'customizer_library_styles' );

	// Echo the rules
	$css = Customizer_Library_Styles()->build();

	if ( ! empty( $css ) ) {
		echo "\n<!-- Begin Custom CSS -->\n<style type=\"text/css\" id=\"rescue-custom-css\">\n";
		echo $css;
		echo "\n</style>\n<!-- End Custom CSS -->\n";
	}
}
endif;

add_action( 'wp_head', 'heartfelt_customizer_library_styles', 11 );

/*----------------------------------------------------*/
/*	Custom CSS Options
/*----------------------------------------------------*/
if ( ! function_exists( 'heartfelt_custom_css' ) ) :
function heartfelt_custom_css() { ?>

	<style type="text/css">
	<?php
	if( get_theme_mod('custom_css_textarea') ) {
		echo esc_attr( get_theme_mod( 'custom_css_textarea' ) ); 
	} ?>
	</style>

<?php }
endif;
add_action('wp_head','heartfelt_custom_css');