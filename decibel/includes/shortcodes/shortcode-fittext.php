<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_fittext' ) ) {
	/**
	 * Headline shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_fittext( $atts ) {
		
		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_fittext', $atts );
		}
		
		extract( shortcode_atts( array(
			'max_font_size' => 72,
			'font_family' => '',
			'letter_spacing' => 0,
			'font_weight' => 700,
			'text_transform' => 'none',
			'color' => '',
			'animation' => '',
			'animation_delay' => '',
			'text' => '',
			'title_tag' => 'h4',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$text_transform = esc_attr( $text_transform );
		$max_font_size = absint( $max_font_size );
		$font_weight = absint( $font_weight );
		$letter_spacing = preg_replace( "/[^0-9-]/", "", $letter_spacing );

		$class = ( $class ) ? "$class " : ''; // add space
		$class .= 'fittext text-center clearfix';

		$style = 'line-height:1;';
		$style .= "font-weight:$font_weight;";
		$style .= 'letter-spacing:' . $letter_spacing . 'px;';


		if ( $font_family )
			$style .= "font-family:$font_family;";

		if ( $text_transform )
			$style .= "text-transform:$text_transform;";

		if ( $color )
			$style .= "color:$color;";

		if ( $animation )
			$class .= " wow $animation";

		if ( $animation_delay && 'none' != $animation ) {
			$style .= 'animation-delay:' . absint( $animation_delay ) / 1000 . 's;-webkit-animation-delay:' . absint( $animation_delay ) / 1000 . 's;';
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output = "<$title_tag $style class='$class' data-max-font-size='$max_font_size'>";
		$output .= $text;
		$output .= "</$title_tag>";
		return $output;
	}
	add_shortcode( 'wolf_fittext', 'wolf_shortcode_fittext' );
}
