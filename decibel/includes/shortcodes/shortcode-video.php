<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_video' ) ) {
	/**
	 * Videoshortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_video( $atts ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_video', $atts );
		}

		extract( shortcode_atts( array(
			'url' => 'http://vimeo.com/86571319',
			'max_width' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$url = esc_url( $url );
		$max_width = sanitize_text_field( $max_width );
		$class = sanitize_text_field( $class );
		$inline_style = sanitize_text_field( $inline_style );

		$output = $style = '';
		$embed = wp_oembed_get( $url );

		$class .= 'wolf-video-container';

		if ( $max_width ) {
			$max_width = ( is_numeric( $max_width ) ) ? $max_width . 'px' : $max_width;
			$style .= "max-width:$max_width;";
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output .= "<div $style class='$class'>$embed</div>";

		return $output;
	}
	add_shortcode( 'wolf_video', 'wolf_shortcode_video' );
}