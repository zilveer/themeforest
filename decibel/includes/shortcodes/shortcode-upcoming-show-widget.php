<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_upcoming_shows_widget' ) ) {
	/**
	 * Upcoming Show widget shortcode
	 *
	 * @param array $atts
	 * @param array $content
	 *
	 * @return string
	 */
	function wolf_shortcode_upcoming_shows_widget( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_upcoming_shows_widget', $atts );
		}
		
		extract( shortcode_atts( array(
			'count' => 10,
		), $atts ) );

		if ( function_exists( 'wolf_get_shows_widget' ) ) {
			return wolf_get_shows_widget( $count, null, null );
		}
	}
	add_shortcode( 'wolf_upcoming_shows_widget', 'wolf_shortcode_upcoming_shows_widget' );
}
