<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_counter' ) ) {
	/**
	 * Counter shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_counter( $atts ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_counter', $atts );
		}

		extract( shortcode_atts( array(
			'number' => '',
			'shortcode' => '',
			'text' => '',
			'add_icon' => '',
			'icon' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$style = '';

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$number = ( $shortcode ) ? "[$number]" : $number;

		$output = "<div class='$class'$style>";

		if ( 'yes' == $add_icon ) {
			$output .= "<span class='counter-icon-container'><i class='fa $icon fa-2x'></i></span>";
		}

		$output .= '<span class="counter">' . absint( do_shortcode( $number ) ) . '</span>';
		$output .= '<span class="counter-text">' . sanitize_text_field( $text ) . '</span>';
		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'wolf_counter', 'wolf_shortcode_counter' );
}