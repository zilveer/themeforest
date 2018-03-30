<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_theme_socials' ) ) {
	/**
	 * Output social icons
	 *
	 * @access public
	 * @param string $services
	 * @param string $size
	 * @param string $type
	 * @param string $target
	 * @param string $custom_style
	 * @param string $hover_effect
	 * @param string $margin
	 * @param string $bg_color
	 * @param string $icon_color
	 * @param string $border_color
	 * @param string $bg_color_hover
	 * @param string $icon_color_hover
	 * @param string $border_color_hover
	 * @param string $alignment
	 * @return string $output
	 */
	function wolf_theme_socials(
			$services 		= '',
			$size 			= '2x',
			$type 			= 'normal',
			$target 		= '_blank',
			$custom_style 	= 'no',
			$hover_effect 	= 'none',
			$margin 		= '',
			$bg_color 		= '',
			$icon_color		= '',
			$border_color 	= '',
			$bg_color_hover 	= '',
			$icon_color_hover 	= '',
			$border_color_hover = '',
			$alignment		= 'center',
			$animation = '',
			$animation_delay = '',
			$inline_style = '',
			$class = ''
		) {

		global $theme_socials, $ti_icons;

		if ( ! $services ) {
			$services = $theme_socials;
		} else {
			$services = strtolower( preg_replace( '/\s+/', '', $services ) );
			$services = explode( ',', $services );
		}

		$style = '';
		$icon_style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "theme-socials-container text-$alignment";

		if ( $animation )
			$class .= " wow $animation";

		if ( $animation_delay && 'none' != $animation ) {
			$style .= 'animation-delay:' . absint( $animation_delay ) / 1000 . 's;-webkit-animation-delay:' . absint( $animation_delay ) / 1000 . 's;';
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output = "<div class='$class'$style>"; // container open tag


		$icon_class = "$type wolf-social-$size hover-$hover_effect";
		$icon_class .= ( 'yes' == $custom_style ) ? ' wolf-social-custom-style' : ' wolf-social-no-custom-style';

		$data = '';
		if ( 'yes' == $custom_style ) {

			if ( $bg_color )
				$icon_style .= "background-color:$bg_color;";

			if ( $icon_color )
				$icon_style .= "color:$icon_color;";

			if ( $border_color )
				$icon_style .= "border-color:$border_color;";

			if ( $margin )
				$icon_style .= "margin:$margin;";

			// hover style
			if ( $bg_color_hover )
				$data .= " data-hover-bg-color='$bg_color_hover'";

			if ( $icon_color_hover )
				$data .= " data-hover-font-color='$icon_color_hover'";

			if ( $border_color_hover )
				$data .= " data-hover-border-color='$border_color_hover'";

		}

		$icon_style = ( $icon_style ) ? "style='$icon_style'" : '';

		$prefix = '';

		foreach ( $services as $s ) {
			$social = wolf_get_theme_option( $s );
			if ( $social ) {
				$prefix = ( in_array( 'ti-' . $s, array_keys( $ti_icons ) ) ) ? 'ti' : 'fa fa';
				$title = str_replace( '-', ' ', $s );
				$output .= "<a href='$social' title='$title' target='$target' class='wolf-social-link'>";
				$output .= "<span $icon_style $data class='wolf-social $prefix-$s $icon_class'></span>";
				$output .= '</a>';
			}
		}

		$output .= '</div><!-- .theme-socials-container -->';

		return $output;
	}
}

if ( ! function_exists( 'wolf_shortcode_theme_socials' ) ) {
	/**
	 * Socials shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_theme_socials( $atts ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_theme_socials', $atts );
		}

		extract( shortcode_atts( array(
			'services' 		=> '',
			'size' 			=> '2x',
			'type' 			=> 'normal',
			'target' 		=> '_blank',
			'custom_style' 	=> 'no',
			'hover_effect' 		=> 'none',
			'margin' 		=> '',
			'bg_color' 		=> '',
			'icon_color' 		=> '',
			'border_color' 	=> '',
			'bg_color_hover' 	=> '',
			'icon_color_hover' 	=> '',
			'border_color_hover' 	=> '',
			'alignment' 		=> 'center',
			'animation' 		=> '',
			'animation_delay' 	=> '',
			'inline_style'		=> '',
			'class'			=> '',
		), $atts ) );

		return wolf_theme_socials(
			$services 		,
			$size 			,
			$type 			,
			$target 		,
			$custom_style 	,
			$hover_effect 	,
			$margin 		,
			$bg_color 		,
			$icon_color		,
			$border_color 	,
			$bg_color_hover 	,
			$icon_color_hover 	,
			$border_color_hover ,
			$alignment,
			$animation,
			$animation_delay,
			$inline_style,
			$class
		);
	}
	add_shortcode( 'wolf_theme_socials', 'wolf_shortcode_theme_socials' );
}
