<?php
/**
 * Shortcodes for BuildPress WP theme defined
 *
 * @package BuildPress
 */


/**
 * Shortcode for Font Awesome
 * @param  array $atts
 * @return string HTML
 */
if ( ! function_exists( 'buildpress_fa_shortcode' ) ) {
	function buildpress_fa_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'icon'   => 'fa-home',
			'href'   => '',
			'target' => '_self',
		), $atts ) );

		if ( empty( $href ) ) {
			return '<span class="icon-container"><span class="fa ' . strtolower( $icon ) . '"></span></span>';
		}
		else if ( 'fa-envelope' === $icon || 'fa-envelope-o' === $icon || 'fa-envelope-square' === $icon ) {
			return '<a class="icon-container" href="mailto:' . $href . '" target="' . $target . '"><span class="fa ' . strtolower( $icon ) . '"></span></a>';
		}
		else {
			return '<a class="icon-container" href="' . $href . '" target="' . $target . '"><span class="fa ' . strtolower( $icon ) . '"></span></a>';
		}
	}
	add_shortcode( 'fa', 'buildpress_fa_shortcode' );
}


/**
 * Shortcode for Buttons
 * @param  array $atts
 * @return string HTML
 */
if ( ! function_exists( 'buildpress_button_shortcode' ) ) {
	function buildpress_button_shortcode( $atts , $content = '' ) {
		extract( shortcode_atts( array(
			'style'  => 'primary',
			'href'   => '#',
			'target' => '_self',
		), $atts ) );

		return '<a class="btn  btn-' . strtolower( $style ) . '" href="' . $href . '" target="' . $target . '">' . $content . '</a>';
	}
	add_shortcode( 'button', 'buildpress_button_shortcode' );
}