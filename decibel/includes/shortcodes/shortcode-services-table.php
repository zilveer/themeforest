<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_services_table' ) ) {
	/**
	 * Services table shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_services_table( $atts, $content ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_services_table', $atts );
		}
		
		extract( shortcode_atts( array(
			'title' => '',
			'bg_color' => '',
			'title_color' => '',
			'font_color' => '',
			'add_icon' => '',
			'icon' => '',
			'icon_color' => '',
			'title_tag' => 'h3',
			//'content' => '',
			'animation' => '',
			'animation_delay' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$output = '';

		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= 'services-table';

		if ( $bg_color )
			$style .= "background-color:$bg_color;";

		if ( $font_color )
			$style .= "color:$font_color;";

		if ( $animation )
			$class .= " wow $animation";

		if ( $animation_delay && 'none' != $animation ) {
			$style .= 'animation-delay:' . absint( $animation_delay ) / 1000 . 's;-webkit-animation-delay:' . absint( $animation_delay ) / 1000 . 's;';
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		// title style
		$title_style = '';

		if ( $title_color )
			$title_style .= "color:$title_color;";

		$title_inline_style = ( $title_style ) ? " style='$title_style'" : '';

		$icon_style = '';

		if ( $icon_color )
			$icon_style .= "color:$icon_color;";

		$icon_inline_style = ( $icon_style ) ? " style='$icon_style'" : '';

		$output .= "<div class='$class'$style>";

		$output .= '<ul>';

		$headings_array = array( 'h2', 'h3', 'h4', 'h5', 'h6' );
		$title_tag = ( in_array( $title_tag, $headings_array ) ) ? $title_tag : 'h3';

		if ( $title )
			$output .= "<li class='service-title-container'><$title_tag class='service-title'$title_inline_style>$title</$title_tag></li>";

		if ( $icon )
			$output .= "<li class='service-icon-container'><i class='fa fa-3x $icon'$icon_inline_style></i></li>";

		if ( $content )
			$output .= wp_kses( $content, array( 'li' => array() ) );

		$output .= '</ul>';

		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'wolf_services_table', 'wolf_shortcode_services_table' );
}
