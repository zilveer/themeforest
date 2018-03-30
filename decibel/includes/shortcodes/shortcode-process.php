<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_process' ) ) {
	/**
	 * Process Shortcode
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function wolf_shortcode_process( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_process', $atts );
		}

		extract( shortcode_atts( array(
			'title' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$output = $style = '';

		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "process-container";

		if ( $title )
			$output .= "<h4 class='text-center'>$title</h4>";

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output .= "<section class='$class'$style><ul class='process-list clearfix'>";

		$output .= do_shortcode( $content );

		$output .= '</ul></section>';

		return $output;
	}
	add_shortcode( 'wolf_process', 'wolf_shortcode_process' );
}

if ( ! function_exists( 'wolf_shortcode_process_item' ) ) {
	/**
	 * Client Shortcode
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function wolf_shortcode_process_item( $atts, $content = null ) {

		// if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
		// 	$atts = vc_map_get_attributes( 'wolf_process_item', $atts );
		// }

		extract( shortcode_atts(  array(
			'title' => '',
			'text' => '',
			'icon' => 'line-icon-bulb',
			'title_tag' => '',
		), $atts ) );

		$headings_array = array( 'h2', 'h3', 'h4', 'h5', 'h6' );
		$title_tag = ( in_array( $title_tag, $headings_array ) ) ? $title_tag : 'h3';

		$output = "<li>";

		$output .= "<div class='icon-box icon-position-top icon-box-small icon-type-circle'>
		<div class='icon-holder'>
		<span class='fa-stack fa-3x hover-fill-in wolf-icon-no-custom-style'>
		<i class='fa $icon fa-stack-1x'></i></span>
		</div></div>";

		$output .= "<$title_tag class='process-title'>$title</$title_tag>";

		$output .= "<p class='process-text'>$text</p>";

		$output .= '</li>';

		return $output;

	}
	add_shortcode( 'wolf_process_item', 'wolf_shortcode_process_item' );
}