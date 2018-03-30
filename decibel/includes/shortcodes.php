<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Includes files from theme shortcodes dir
$shortcode_dir = WOLF_THEME_DIR . '/includes/shortcodes';
if ( is_dir( $shortcode_dir ) ) {
	foreach ( glob( $shortcode_dir . '/*.php' ) as $filename ) {
		include_once( $filename );
	}
}

// if ( ! function_exists( 'wolf_shortcode_content_format' ) ) {
// 	/**
// 	 * Format shortcode content output
// 	 *
// 	 * Remove empty p tag around shortcodes
// 	 */
// 	function wolf_shortcode_content_format( $content ) {
// 		$array = array(
// 			'<p>[' => '[',
// 			']</p>' => ']',
// 			']<br />' => ']',
// 			']<br>' => ']',
// 		);
// 		$content = strtr( $content, $array );
// 		return $content;
// 	}
// 	add_filter( 'the_content', 'wolf_shortcode_content_format' );
// }