<?php
/**
 * Fonts helper
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_file( WOLF_THEME_CONFIG_DIR . '/custom-fonts.php' ) ) {
	include_once( WOLF_THEME_CONFIG_DIR . '/custom-fonts.php' );
}

if ( ! function_exists( 'wolf_google_fonts' ) ) {

	global $wolf_fonts, $wolf_google_fonts;
	$wolf_google_fonts = ( isset( $wolf_google_fonts ) ) ? $wolf_google_fonts : array();

	/* Get google font from theme options */
	$wolf_theme_options = get_option( 'wolf_theme_options_' . wolf_get_theme_slug() );

	$font_option = ( isset( $wolf_theme_options['google_fonts'] ) ) ? $wolf_theme_options['google_fonts'] . '|' : null;

	if ( $font_option ) {
		$raw_fonts = explode( '|', $font_option );

		foreach ( $raw_fonts as $font ) {
			$font_name = str_replace( array( '+', ',', '|', ':' ), array( ' ', '' ), preg_replace( '/\d/', '', $font ) );
			if ( '' != $font_name )
				$wolf_google_fonts[$font_name] = $font;
		}
	}

	// merge google fonts in main fonts array
	foreach ( $wolf_google_fonts as $key => $value ) {
		$wolf_fonts[ $key ] = $value;
	}

	/**
	 * Loads our special font CSS file.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'wolf-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 *
	 */
	function wolf_google_fonts() {

		global $wolf_google_fonts;
		$subsets = 'latin,latin-ext';

		if ( $wolf_google_fonts && is_array( $wolf_google_fonts ) && $wolf_google_fonts != array() ) {

			$fonts = array_unique( $wolf_google_fonts );
			/*
			 * Translators: To add an additional character subset specific to your language,
			 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
			 */
			$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'wolf' );

			if ( 'cyrillic' == $subset ) {
				$subsets .= ',cyrillic,cyrillic-ext';
			} elseif ( 'greek' == $subset ) {
				$subsets .= ',greek,greek-ext';
			} elseif ( 'devanagari' == $subset ) {
				$subsets .= ',devanagari';
			} elseif ( 'vietnamese' == $subset ) {
				$subsets .= ',vietnamese';
			}

			$url = add_query_arg( array(
				'family' => implode( '|', $fonts ),
				'subset' => $subsets,
			), '//fonts.googleapis.com/css' );

			wp_enqueue_style( 'wolf-theme-google-fonts', esc_url( $url ), array(), null );
		}
	}
	add_action( 'admin_enqueue_scripts', 'wolf_google_fonts' );
	add_action( 'wp_enqueue_scripts', 'wolf_google_fonts' );
}
