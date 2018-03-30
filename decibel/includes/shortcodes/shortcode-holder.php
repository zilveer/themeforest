<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_element_holder' ) ) {
	/**
	 * Holder shortcode
	 *
	 * @param array $atts
	 * @param array $content
	 * @return string
	 */
	function wolf_shortcode_element_holder( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_elements_holder', $atts );
		}

		extract( shortcode_atts( array(
			'columns' => 2,
		), $atts ) );

		$output = "<section class='holder clearfix holder-$columns-cols'>";

		$output .= do_shortcode( $content );

		$output .= '</section>';

		return $output;

	}
	add_shortcode( 'wolf_elements_holder', 'wolf_shortcode_element_holder' );
}

if ( ! function_exists( 'wolf_shortcode_element_holder_item' ) ) {
	/**
	 * Holder Item shortcode
	 *
	 * @param array $atts
	 * @param array $content
	 * @return string
	 */
	function wolf_shortcode_element_holder_item( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_elements_holder_item', $atts );
		}

		extract( shortcode_atts(  array(
			'padding' => '',
			'background_color' => '',
			'background_image' => '',
			'font_color' => 'dark',
			'type' => 'text',
			'inline_style' => '',
			'class' => '',
			'padding' => '',
		), $atts ) );

		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "holder-element holder-content-$type content-$font_color-font";
		$output = '';
		$style = '';

		if ( $background_color ){
			$style .= "background-color:$background_color;";
		}

		if ( $background_image ){
			$image = wolf_get_url_from_attachment_id( $background_image, 'extra-large' );
			$style .= "background:url($image);";
		}

		if ( $padding ) {
			$style .= "padding:$padding;";
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output .= "<div class='$class'$style>";

			$output .= '<div class="holder-element-inner">';

			if ( 'text' == $type ) {
				$output .= '<div class="holder-text-element-inner">';
			}

				$output .= do_shortcode( $content );

			if ( 'text' == $type ) {
				$output .= '</div>';
			}

			$output .= '</div>';

		$output .= '</div>';

		return $output;

	}
	add_shortcode( 'wolf_elements_holder_item', 'wolf_shortcode_element_holder_item' );
}