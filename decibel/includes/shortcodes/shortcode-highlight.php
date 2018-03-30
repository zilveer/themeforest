<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_highlight_shortcode_text' ) ) {
	/**
	 * Highlight text shortcode
	 *
	 * @param array $atts
	 * @param array $content
	 * @return string
	 */
	function wolf_highlight_shortcode_text( $atts, $content = null ) {
		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_highlight_text', $atts );
		}
		return '<span class="wolf-highlight-' . $atts['color'] . '">' . $content . '</span>';
	}
	add_shortcode( 'wolf_highlight_text', 'wolf_highlight_shortcode_text' );
}