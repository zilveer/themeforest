<?php
/**
 *  Get Google Fonts
 */

function handy_google_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
	$font_var  = '100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic';

	/* Get default fonts used in theme */
	if (class_exists('handyFonts')) {
		$handy_default_fonts = handyFonts::get_default_fonts();
	}

	if ( is_array($handy_default_fonts) || is_object($handy_default_fonts) ) {
		foreach ( $handy_default_fonts as $single_font ) {
			/*  Translators: If there are characters in your language that are not
			 *  supported by font, translate this to 'off'. Do not translate
			 *  into your own language.
			 */
			if ( 'off' !== _x( 'on', $single_font . ' font: on or off', 'plumtree' ) ) {
				$fonts[] = $single_font . ':' . $font_var;
			}
		}
		unset($single_font);
	} else {
		if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'plumtree' ) ) {
			$fonts[] = 'Open Sans:' . $font_var;
		}
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'plumtree' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 *  Add used fonts to frontend
 */
function handy_add_fonts_styles() {
	wp_enqueue_style( 'handy-google-fonts', handy_google_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'handy_add_fonts_styles' );
