<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_columns_shortcode' ) ) {
	/**
	 * Columns shortcode
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function wolf_columns_shortcode( $atts, $content = null ) {

		// if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
		// 	$atts = vc_map_get_attributes( 'wolf_column', $atts );
		// }

		extract( shortcode_atts(  array(
			'col' => 'col-6',
			'class' => '',
			'first' => '',
			'last' => '',
			'inline_style' => '',
		), $atts ) );

		$col = esc_attr( $col );
		$first = esc_attr( $first );
		$last = esc_attr( $last );
		$col = esc_attr( $col );
		$inline_style = sanitize_text_field( $inline_style );
		$output = '';
		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		if ( $first ) {
			$class = 'first';
		} elseif ( $last ) {
			$class = 'last';
		}

		if ( $class == 'first' ) {
			$output .='<div class="clear"></div>';
		}
		$output .= '<div class="' . $col . ' ' . $class . '"' . $style . '>' . do_shortcode( $content ) . '</div>';

		if ( $class == 'last' ) {
			$output .='<div class="clear"></div>';
		}

		return $output;
	}

	add_shortcode( 'wolf_column', 'wolf_columns_shortcode'  );
}