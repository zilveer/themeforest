<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_clients_carousel' ) ) {
	/**
	 * Clients Carousel Shortcode
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function wolf_shortcode_clients_carousel( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_clients_carousel', $atts );
		}

		extract( shortcode_atts( array(
			'title' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$title = sanitize_title( $title );
		$inline_style = sanitize_text_field( $inline_style );
		$class = esc_attr( $class );
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= 'clients-carousel';
		$style = '';
		$output = '';

		if ( $title )
			$output .= "<h2 class='text-center'>$title</h2>";

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';
		$output .= "<section class='$class'$style>";

		$output .= do_shortcode( $content );

		$output .= '</section>';

		return $output;
	}
	add_shortcode( 'wolf_clients_carousel', 'wolf_shortcode_clients_carousel' );
}

if ( ! function_exists( 'wolf_shortcode_clients_carousel_item' ) ) {
	/**
	 * Client Shortcode
	 *
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function wolf_shortcode_clients_carousel_item( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_clients_carousel_item', $atts );
		}

		extract( shortcode_atts(  array(
			'image' => '',
			'link' => '#',
		), $atts ) );

		$link = esc_url( $link );
		$src = esc_url( wolf_get_url_from_attachment_id( absint( $image ), 'extra-large' ) );
		$output = "<div class='block'>";

		$output .= "<a href='$link' target='_blank'><img src='$src' alt='client-image'></a>";

		$output .= '</div>';

		return $output;

	}
	add_shortcode( 'wolf_clients_carousel_item', 'wolf_shortcode_clients_carousel_item' );
}