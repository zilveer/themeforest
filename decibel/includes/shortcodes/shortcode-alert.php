<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_alert_message' ) ) {
	/**
	 * Alert message shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_alert_message( $atts ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_alert_message', $atts );
		}

		extract( shortcode_atts( array(
			'type' => 'info',
			'message' => '',
			'close' => '',
			'display_icon' => 'yes',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$type = sanitize_text_field( $type );
		$message = sanitize_text_field( $message );
		// $message = $content;
		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "wolf-alert $type";
		$icon = '';

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		if ( 'alert' == $type ) {

			$icon = 'fa-exclamation-circle';

		} elseif ( 'info' == $type ) {

			$icon = 'fa-info-circle';

		} elseif ( 'success' == $type ) {

			$icon = 'fa-thumbs-o-up';

		} elseif ( 'error' == $type ) {

			$icon = 'fa-exclamation-triangle';
		}

		$output = "<div class='$class'$style>
		<p>";

		if ( 'yes' == $display_icon )
			$output .= "<i class='fa $icon fa-lg'></i>";

		$output .= "$message</p>";

		if ( $close )
			$output .= '<span class="wolf-alert-close">&times;</span>';

		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'wolf_alert_message', 'wolf_shortcode_alert_message' );
}