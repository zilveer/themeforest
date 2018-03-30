<?php
/**
 * Enqueue Front-end Styles and JavaScript
 *
 * Note: admin styles and JavaScript are enqueued in admin.php
 */

/**
 * Inject stylesheet calls into header.php's <head>
 */

function risen_css() {

	// Elusive Icon Font - http://aristeides.com/elusive-iconfont/
	// (before main so can override styles when necessary)
	wp_enqueue_style( 'elusive-webfont', risen_locate_template_uri( 'style-elusive-webfont.css' ), false, RISEN_VERSION );  // bust cache on theme update

	// Main Stylesheet
	wp_enqueue_style( 'risen-style', get_stylesheet_uri(), false, RISEN_VERSION );  // bust cache on theme update

	// Light or Dark Style
	risen_enqueue_base_style( 'risen-base-style' );

	// Google Web Fonts (enqueue those selected in Theme options)
	$fonts = array(
		risen_option( 'body_font' ),
		risen_option( 'menu_font' ),
		risen_option( 'heading_font' )
	);
	$fonts = array_unique( $fonts ); // no duplicates
	$available_fonts = risen_google_web_fonts();
	$font_array = array();
	foreach ( $fonts as $font ) {
		if ( ! empty( $available_fonts[$font] ) ) { // font is valid
			$font_array[] = urlencode( $font ) . ( ! empty( $available_fonts[$font]['sizes'] ) ? ':' . $available_fonts[$font]['sizes'] : '' );
		}
	}
	if ( ! empty( $font_array ) ) {

		//$font_list = implode( '|', $font_array );
		$font_list = implode( '%7C', $font_array ); // HTML5-valid: http://bit.ly/1xfv8yA

		// Character set(s) specified in options?
		$subset_attr = '';
		$font_subsets = risen_option( 'font_subsets' );
		$font_subsets = str_replace( ' ', '', $font_subsets ); // in case spaces between commas
		if ( ! empty( $font_subsets ) && 'latin' != $font_subsets ) {
			$subset_attr = '&subset=' . $font_subsets;
		}

		wp_enqueue_style( 'google-fonts', risen_current_protocol() . '://fonts.googleapis.com/css?family=' . $font_list . $subset_attr, false, null ); // null - don't mess with Google Web Fonts URL by adding version

	}

}

/**
 * Inject JavaScript into header.php's <head>
 */

function risen_js() {

	// jQuery (included with WordPress)
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-migrate' ); // keep things working in jQuery 1.9 / WordPress 3.6

	// Modernizr (custom production version)
	wp_enqueue_script( 'modernizr-custom', risen_locate_template_uri( 'js/modernizr.custom.js' ), false, RISEN_VERSION ); // bust cache on theme update

	// Backstretch
	wp_enqueue_script( 'jquery-backstretch', risen_locate_template_uri( 'js/jquery.backstretch.min.js' ), false, RISEN_VERSION ); // bust cache on theme update

	// Superfish Menu
	// Note: hoverIntent package with WordPress 3.6+ but including locally in case needed for older version
	wp_enqueue_script( 'hoverIntent', risen_locate_template_uri( 'js/hoverIntent.js' ), false, RISEN_VERSION ); // packaged with WordPress
	wp_enqueue_script( 'superfish', risen_locate_template_uri( 'js/superfish.min.js' ), false, RISEN_VERSION ); // bust cache on theme update
	wp_enqueue_script( 'supersubs', risen_locate_template_uri( 'js/supersubs.js' ), false, RISEN_VERSION ); // bust cache on theme update

	//SelectNav.js (converts Superfish menu into <select> for small screens)
	wp_enqueue_script( 'selectnav', risen_locate_template_uri( 'js/selectnav.min.js' ), false, RISEN_VERSION ); // bust cache on theme update

	// Google Maps
	// Shortcode and locations widget can be used anywhere, so make maps always available
	$gmaps_url = risen_current_protocol() . '://maps.googleapis.com/maps/api/js';
	if ( $gmaps_api_key = risen_option( 'gmaps_api_key' ) ) {
		$gmaps_url .= '?key=' . $gmaps_api_key;
	}
	wp_enqueue_script( 'google-maps', $gmaps_url, false, null ); // null - don't mess with Google Maps URL by adding version

	// Flexslider
	if ( is_home() ) {
		wp_enqueue_script( 'jquery-flexslider', risen_locate_template_uri( 'js/jquery.flexslider-min.js' ), false, RISEN_VERSION ); // bust cache on theme update
	}

	// debouncedresize
	if ( is_singular( 'risen_multimedia' ) ) { // for single Multimedia post pages
		wp_enqueue_script( 'jquery-debouncedresize', risen_locate_template_uri( 'js/jquery.debouncedresize.min.js' ), array( 'jquery' ), RISEN_VERSION ); // bust cache on theme update
	}

	// Comments
	if ( is_singular() ) { // single post or page

		// comment-reply.js to cause comment form to show below a comment when replying to a comment
		wp_enqueue_script( 'comment-reply' );

		// Comment Validation with jQuery Plugin
		if ( is_singular() ) { // single post
			wp_enqueue_script( 'jquery-validate', risen_locate_template_uri( 'js/jquery.validate.min.js' ), false, RISEN_VERSION ); // bust cache on theme update
		}

		// jQuery Easing
		wp_enqueue_script( 'jquery-easing', risen_locate_template_uri( 'js/jquery.easing.js' ), false, RISEN_VERSION ); // bust cache on theme update

		// Smooth scroll (when click comments link at top)
		wp_enqueue_script( 'jquery-smooth-scroll', risen_locate_template_uri( 'js/jquery.smooth-scroll.min.js' ), false, RISEN_VERSION ); // bust cache on theme update

	}

	// prettyPhoto Lightbox (modified)
	if (is_singular( 'risen_gallery' )
		|| is_tax( 'risen_gallery_category' )
		|| is_page_template( 'tpl-gallery-categories.php' )
		|| is_page_template( 'tpl-gallery-all.php' )
		|| is_page_template( 'tpl-gallery-images.php' )
		|| is_page_template( 'tpl-gallery-videos.php' )
	) { // for Gallery only
		wp_enqueue_script( 'jquery-prettyphoto', risen_locate_template_uri( 'js/jquery.prettyPhoto.modified.js' ), false, RISEN_VERSION ); // bust cache on theme update
	}

	// FitVids.js
	wp_enqueue_script( 'fitvids', risen_locate_template_uri( 'js/jquery.fitvids.js' ), array( 'jquery' ), RISEN_VERSION ); // bust cache on theme update

	// Risen Main JS
	wp_enqueue_script( 'risen-main', risen_locate_template_uri( 'js/main.js' ), false, RISEN_VERSION ); // bust cache on theme update

		// Theme data for JS
		wp_localize_script( 'risen-main', 'risen_wp', array( // pass WP data into JS from this point on
			'theme_uri' 						=> RISEN_THEME_URI, // would be nice to use child theme URI, but then certain files HAVE to exist
			'is_home' 							=> is_home(),
			'site_url'							=> site_url(),
			'home_url'							=> home_url(),
			'is_ssl'							=> is_ssl(),
			'current_protocol'					=> risen_current_protocol(),
			'ie_unsupported_message'			=> __( 'You are using an outdated version of Internet Explorer. Please upgrade your browser to use this site.', 'risen' ),
			'ie_unsupported_redirect_url' 		=> apply_filters( 'risen_upgrade_browser_url', 'http://browsehappy.com/' ),
			'mobile_menu_label'					=> _x( 'Menu', 'menu dropdown', 'risen' ),
			'slider_enabled' 					=> risen_option( 'slider_enabled' ) ? '1' : '',
			'slider_slideshow'					=> risen_option( 'slider_slideshow' ) ? '1' : '',
			'slider_speed'						=> ( risen_option( 'slider_speed' ) ? risen_option( 'slider_speed' ) : risen_option_default( 'slider_speed' ) ) * 1000, // convert seconds to milliseconds
			'gmaps_api_key'						=> risen_option( 'gmaps_api_key' ),
			'ajax_url'							=> admin_url( 'admin-ajax.php' ), // used by contact form
			'contact_form_nonce'				=> wp_create_nonce( 'risen_contact_form_nonce' ), // security
			'comment_name_required'				=> get_option('require_name_email'), // name and email required on comments? (WP Admin: Settings > Discussion)
			'comment_email_required'			=> get_option('require_name_email'),
			'comment_name_error_required'		=> __( 'Required', 'risen' ), // translatable string for comment form validation
			'comment_email_error_required'		=> __( 'Required', 'risen' ),
			'comment_email_error_invalid'		=> __( 'Invalid Email', 'risen' ),
			'comment_url_error_invalid'			=> __( 'Invalid URL', 'risen' ),
			'comment_message_error_required'	=> __( 'Comment Required', 'risen' ),
			'lightbox_prev' 					=> _x( 'Prev', 'lightbox', 'risen' ),
			'lightbox_next' 					=> _x( 'Next', 'lightbox', 'risen' ),
			'lightbox_expand' 					=> _x( 'Expand', 'lightbox', 'risen' ),
			'lightbox_close' 					=> _x( 'Close', 'lightbox', 'risen' )
		));

}
