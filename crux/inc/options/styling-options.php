<?php

add_action( 'admin_init', 'stag_styling_options' );

function stag_styling_options() {
	$settings['description'] = __( 'Configure the visual appearance of your theme, or insert any custom CSS.', 'stag' );

	$settings[] = array(
		'title' => __( 'Background Color', 'stag' ),
		'desc'  => __( 'Choose the background color of your site', 'stag' ),
		'type'  => 'color',
		'id'    => 'style_background_color',
		'val'   => '#ffffff'
	);

	$settings[] = array(
		'title' => __( 'Accent Color', 'stag' ),
		'desc'  => __( 'Choose the accent color of your site', 'stag' ),
		'type'  => 'color',
		'id'    => 'style_accent_color',
		'val'   => '#71a32f'
	);

	$settings[] = array(
		'title' => __( 'Body Font', 'stag' ),
		'desc'  => __( 'Quickly add a custom Google Font for body from <a href="//www.google.com/webfonts/" target="_blank">Google Font Directory.</a>
				   <code>Example font name: "Source Sans Pro"</code>, for including font weights type <code>Source Sans Pro:400,700,400italic</code>.', 'stag' ),
		'type'  => 'text',
		'id'    => 'style_body_font',
		'val'   => 'Ropa Sans:400,400italic'
	);

	$settings[] = array(
		'title' => __( 'Heading Font', 'stag' ),
		'desc'  => __( 'Quickly add a custom Google Font for heading from <a href="//www.google.com/webfonts/" target="_blank">Google Font Directory</a>.', 'stag' ),
		'type'  => 'text',
		'id'    => 'style_heading_font',
		'val'   => ''
	);

	$settings[] = array(
		'title' => __( 'Google Font Script', 'stag' ),
		'desc' => __( 'Choose the character sets you want for Google Web Font', 'stag' ),
		'type' => 'select',
		'id' => 'style_font_script',
		'val' => 'latin',
		'options' => array(
			'cyrillic'        => __( 'Cyrillic', 'stag' ),
			'cyrillic-ext'    => __( 'Cyrillic Extended', 'stag' ),
			'greek'           => __( 'Greek', 'stag' ),
			'greek-ext'       => __( 'Greek Extended', 'stag' ),
			'khmer'           => __( 'Khmer', 'stag' ),
			'latin'           => __( 'Latin', 'stag' ),
			'latin,latin-ext' => __( 'Latin Extended', 'stag' ),
			'vietnamese'      => __( 'Vietnamese', 'stag' ),
		)
	);

	$settings[] = array(
		'title' => __( 'Custom CSS', 'stag' ),
		'desc'  => __( 'Quickly add some CSS to your theme by adding it to this block.', 'stag' ),
		'type'  => 'textarea',
		'id'    => 'style_custom_css',
	);

	$settings[] = array(
		'title' => __( 'Minify Custom CSS', 'stag' ),
		'desc'  => __( 'Minify the output of custom CSS.', 'stag' ),
		'type'  => 'checkbox',
		'val'   => 'on',
		'id'    => 'style_minify_css',
	);

	stag_add_framework_page( __( 'Styling Options', 'stag' ), $settings, 5 );
}

/**
 * Custom Stylsheet output
 *
 * @param $content Get previous values, if any
 * @return $content Output CSS Properties
 */
function stag_custom_css( $content ) {
	$stag_values      = get_option( 'stag_framework_values' );
	$background_color = ( isset( $stag_values['style_background_color'] ) ) ? $stag_values['style_background_color'] : '#ffffff';
	$accent           = ( isset( $stag_values['style_accent_color'] ) ) ? $stag_values['style_accent_color'] : '#71a32f';
	$body_font        = explode( ':', stag_get_option('style_body_font') );
	$heading_font     = explode( ':', stag_get_option('style_heading_font') );

	if ( stag_get_option( 'style_body_font' ) != '' ) {
		$content .= "body { font-family: '{$body_font[0]}'; }\n";
	}

	if ( stag_get_option( 'style_body_font' ) != '' && strpos( $body_font[1], '700' ) === false ) {
		$content .= "b, strong { font-weight: normal; }\n";
	}

	if ( stag_get_option('style_heading_font') != '' ) {
		$content .= "h1, h2, h3, h4, h5, h6, .woocommerce-tabs .tabs, .comment-list .fn, .entry-content table th, .comment-content table th, .commentlist .meta { font-family: '{$heading_font[0]}'; }\n";
	}

	if ( $background_color != '' ) {
		$content .= "body, .site-content { background-color: {$background_color}; }\n";
	}

	if ( $accent != '' ) {
		$content .= "a { color: {$accent}; }\n";
		$content .= "input[type='submit'], button, .button, .cart_dropdown_link .count{ background-color: {$accent}; }\n";
		$content .= ".tagcloud a:hover { background-color: {$accent}; }\n";
		$content .= ".cart_dropdown .dropdown_widget:before { border-top-color: {$accent} !important; }\n";
		$content .= ".onsale:before { border-right-color: {$accent} !important; }\n";
		$content .= ".cart_dropdown_link .count { border-color: {$accent} !important; }\n";
		$content .= ".main-navigation a:hover, .mobile-menu a:hover, .mobile-menu .current-menu-item > a, .main-navigation .current-menu-item > a, .archive-lists a:hover { color: {$accent}; }\n";
		$content .= ".ls-crux .ls-bar-timer, .ls-crux .ls-nav-prev:hover, .ls-crux .ls-nav-next:hover, .ls-crux .ls-nav-stop-active, .ls-crux .ls-nav-start-active { background: {$accent} !important; }\n";
	}

	if ( function_exists('stag_is_woocommerce_active') && stag_is_woocommerce_active() ) {
		$content .= "\n\n/* WooCommerce CSS */\n";
		$content .= ".onsale, .woocommerce-message, .widget_price_filter .ui-slider-horizontal .ui-slider-range { background-color: {$accent}; }\n";
		$content .= ".order_details strong, .product-title a, .product-category h3 mark { color: {$accent}; }\n";
		$content .= ".widget_price_filter .ui-slider-handle { background-color: ". woocommerce_hex_darker($accent, 30) ."; }\n";
	}

	return apply_filters( 'stag_minify_css', $content );
}
add_filter( 'stag_custom_css_output', 'stag_custom_css' );

/**
 * Filter the font family names and ready for enqueue
 *
 * @return Fonts URL
 */
function stag_google_font_url() {
	$fonts_url     = '';
	$font_families = array();
	$body_font     = stag_get_option('style_body_font');
	$heading_font  = stag_get_option('style_heading_font');

	if ( $body_font == '' && $heading_font == '' )
		return;

	if ( $body_font != '' ) {
		$font_families[] = $body_font;
	}

	if ( $heading_font != '' ) {
		$font_families[] = $heading_font;
	}

	$query_args = array(
		'family' => urlencode( implode( '|', array_filter($font_families) ) ),
		'subset' => urlencode( stag_get_option('style_font_script') )
	);

	$protocol = ( is_ssl() ) ? 'https:' : 'http:';

	$fonts_url = add_query_arg( $query_args, $protocol . "//fonts.googleapis.com/css" );

	return esc_url( $fonts_url );
}

/**
 * Check if there is any space
 *
 * @param $string String to check for
 */
function stag_remove_trailing_char( $string, $char = ' ' ) {
  $offset = strlen( $string ) - 1;
  $trailing_char = strpos( $string, $char, $offset );
  if ( $trailing_char )
    $string = substr( $string, 0, -1 );
  return $string;
}

/**
 * Get font face name
 *
 * @param $option Get font face e.g. Open Sans:300,400,700
 */
function stag_get_font_face( $option ) {
  $stack = null;
  if ( $option !=  '') {
    $option = explode( ':', $option );
    $name = stag_remove_trailing_char( $option[0] );
    $stack = $name;
  } else {
    $stack = '';
  }
  return $stack;
}
