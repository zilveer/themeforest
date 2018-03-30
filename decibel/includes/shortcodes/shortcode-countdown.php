<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_countdown' ) ) {
	/**
	 * Countdown shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_countdown( $atts ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_countdown', $atts );
		}

		extract( shortcode_atts( array(
			'date' => '12/24/2020 12:00:00',
			'offset' => -5,
			'message' => __( 'Done!', 'wolf' ),
			'inline_style' => '',
			'class' => '',
		), $atts ) );
		wp_enqueue_script( 'countdown' );
		wp_enqueue_script( 'theme-countdown' );

		$date = sanitize_text_field( $date );
		$offset = sanitize_text_field( $offset );
		$message = sanitize_text_field( $message );
		$inline_style = sanitize_text_field( $inline_style );
		$class = esc_attr( $class );

		$rand_id = rand( 0,999 );
		$output = '';

		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "countdown-container clearfix";

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		/* Format date */
		$format = explode( ' ' , $date );
		$date = $format[0];
		$hours =  $format[1];

		$date = explode( '/', $date );
		$year = $date[2];
		$month = $date[0];
		$day = $date[1];


		$hours = explode( ':', $hours );
		$hour = $hours[0];
		$min = $hours[1];
		$sec = $hours[2];

		$output .= "<section class='$class'$style>";
		$output .= '<div 
		data-year="' . absint( $year ) . '"
		data-month="' . absint( $month ) . '"
		data-day="' . absint( $day ) . '"
		data-hour="' . absint( $hour ) . '"
		data-min="' . absint( $min ) . '"
		data-sec="' . absint( $sec ) . '"
		data-offset="' . intval( $offset ) . '"
		class="countdown wolf-countdown" id="countdown-' . absint( $rand_id ) .'" style="color:#ffffff;"></div>';
		$output .= '</section>';
		
		return $output;
	}
	add_shortcode( 'wolf_countdown', 'wolf_shortcode_countdown' );
}