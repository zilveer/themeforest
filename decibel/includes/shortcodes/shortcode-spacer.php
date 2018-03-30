<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_spacer_shortcode' ) ) {
	/**
	 * Vertical space text shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_spacer_shortcode ( $atts ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_spacer', $atts );
		}
		extract( shortcode_atts( array(
			'height' => 10,
		), $atts ) );

		$height = ( is_numeric( $height ) ) ? absint( $height ) . 'px' : sanitize_text_field( $height );

		return '<div style="height:' . $height . ';"></div>';
	}
	add_shortcode( 'wolf_spacer', 'wolf_spacer_shortcode' );
}