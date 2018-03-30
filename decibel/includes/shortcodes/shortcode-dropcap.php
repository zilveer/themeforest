<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_dropcap' ) ) {
	/**
	 * Dropcap shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_dropcap( $atts ) {

		// if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
		// 	$atts = vc_map_get_attributes( 'wolf_dropcap', $atts );
		// }

		extract( shortcode_atts( array(
			'text' => '',
			'font' => '',
			'font_style' => 'normal',
		), $atts ) );

		$style = 'style="';
		$style .= "font-style:$font_style;";

		if ( $font )
			$style .= "font-family:$font;";

		$style .= '"';

		return "<span class='dropcap' $style>$text</span>";
	}
	add_shortcode( 'wolf_dropcap', 'wolf_shortcode_dropcap' );
}
