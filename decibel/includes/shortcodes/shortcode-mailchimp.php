<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_mailchimp' ) ) {
	/**
	 * Alert message shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_mailchimp( $atts ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_mailchimp', $atts );
		}

		extract( shortcode_atts( array(
			'list' => '',
			'size' => 'normal',
			'label' => '',
			'submit' => __( 'Subscribe', 'wolf' ),
			'button_style' => '',
			'alignment' => 'center',
			'animation' => '',
			'animation_delay' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		return wolf_mailchimp( $list, $size, $label, $submit , $button_style, $alignment, $animation, $animation_delay, $inline_style, $class );

	}
	add_shortcode( 'wolf_mailchimp', 'wolf_shortcode_mailchimp' );
}

if ( ! function_exists( 'wolf_mailchimp' ) ) {
	/**
	 * Return a mailchimp Subscription form
	 *
	 * @param string $list
	 * @param string $size
	 * @param string $label
	 * @param string $submit
	 * @return string $output
	 */
	function wolf_mailchimp( $list, $size = 'normal', $label = '', $submit = 'Subscribe', $button_style = '', $alignment = 'center', $animation = '', $animation_delay = '', $inline_style = '', $class = '' ) {

		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "wolf-mailchimp-form $size wolf-mailchimp-align-$alignment";
		$style = '';

		if ( $animation )
			$class .= " wow $animation";

		if ( $animation_delay && 'none' != $animation ) {
			$style .= 'animation-delay:' . absint( $animation_delay ) / 1000 . 's;-webkit-animation-delay:' . absint( $animation_delay ) / 1000 . 's;';
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output = "<form class='$class'$style><input type='hidden' name='wolf-mailchimp-list' class='wolf-mailchimp-list' value='$list'>";
		if ( $label )
			$output .= "<h3 class='widget-title'>$label</h3>";
		$output .= '<div class="wolf-mailchimp-email-container"><input placeholder="' . __( 'your email', 'wolf' ) . '"  type="text" name="wolf-mailchimp-email" class="wolf-mailchimp-email"></div>';
		$output .= "<div class='wolf-mailchimp-submit-container'><input type='submit' name='wolf-mailchimp-submit' class='wolf-mailchimp-submit $button_style' value='$submit'></div>";
		$output .= '<span class="wolf-mailchimp-result">&nbsp;</span>';
		$output .= '</form>';

		if ( wolf_get_theme_option( 'mailchimp_api_key' ) && ! empty( $list ) ) {

			return $output;

		} elseif ( is_user_logged_in() ) {

			$output = '<p class="text-center">';

			if ( ! wolf_get_theme_option( 'mailchimp_api_key' ) )
				$output .= __( 'You must set your mailchimp API key in the theme options', 'wolf' ) . '<br>';

			if ( ! $list )
				$output .= __( 'You must set a list ID!', 'wolf' );

			$output .= '</p>';
			return $output;
		}
	}
}