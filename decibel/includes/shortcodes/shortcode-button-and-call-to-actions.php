<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_do_button' ) ) {
	/**
	 * Output a button with paramters from shortcode
	 *
	 * @param
	 * @return string $button
	 */
	function wolf_do_button(
		$text = '',
		$link = '#',
		$tagline = '',
		$color = '',
		$type = 'square',
		$size = 'medium',
		$custom_style = 'no',
		$button_bg_color = null,
		$button_font_color = null,
		$button_border_color = null,
		$button_bg_color_hover = null,
		$button_font_color_hover = null,
		$button_border_color_hover = null,
		$add_button_icon = false,
		$icon = null,
		$icon_position = 'after',
		$target = '',
		$scroll_to_anchor = '',
		$inline_style = '',
		$class = '',
		$id = ''
	) {

		// style
		$style = '';
		$data_bg_color = '';
		$data_font_color = '';
		$data_border_color = '';

		if ( 'yes' == $custom_style ) {
			if ( $button_bg_color )
				$style .= "background-color:$button_bg_color;";

			if ( $button_font_color )
				$style .= "color:$button_font_color;";

			if ( $button_border_color )
				$style .= "border-color:$button_border_color;";

			// hover style
			if ( $button_bg_color_hover )
				$data_bg_color = " data-hover-bg-color='$button_bg_color_hover'";

			if ( $button_font_color_hover )
				$data_font_color = " data-hover-font-color='$button_font_color_hover'";

			if ( $button_border_color_hover )
				$data_border_color = " data-hover-border-color='$button_border_color_hover'";
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		// link
		//$href = esc_url( $link );
		$href = $link;

		// class
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= 'wolf-button';
		$class .= ( 'yes' == $custom_style ) ? ' wolf-button-custom-style' : '';
		$class .= ' ' . $size;
		$class .= ' ' . $type;
		$class .= " icon_$icon_position";

		if ( $tagline ) {
			$class .= ' has-tagline';
		}

		if ( 'no' == $custom_style ) $class .= ' ' . $color;

		if ( $scroll_to_anchor )
			$class .= ' scroll';

		// icon
		$icon = ( 'yes' == $add_button_icon ) ? "<i class='fa $icon'></i> " : '';
		$tagline = ( $tagline ) ? "<span class='wolf-button-tagline'>$tagline</span>" : '';
		$button = '';
		$button .= '<a '; // beggin button
		$button .= $style;
		$button .= " class='$class'";
		$button .= " href='$href'";
		$button .= " target='$target'";
		$button .= $data_bg_color;
		$button .= $data_font_color;
		$button .= $data_border_color;
		$button .= '>';

		if ( 'before' == $icon_position ) $button .= $icon; // icon before

		$button .= $text; // text

		if ( 'after' == $icon_position ) $button .= $icon; // icon after

		$button .= $tagline; // tagline

		$button .= '</a>'; // end button

		return $button;
	}
}

if ( ! function_exists( 'wolf_buttons_container_shortcode' ) ) {
	/**
	 * Buttons container shortcodes funciton
	 *
	 * @param
	 * @return string
	 */
	function wolf_buttons_container_shortcode( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_buttons_container', $atts );
		}
		
		extract( shortcode_atts( array(
			'alignment' => 'left',
			'margin_top' => '',
			'margin_bottom' => '',
			'animation' => '',
			'animation_delay' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= 'buttons-container';

		if ( $margin_top ) {
			$margin_top = is_numeric( $margin_top ) ? $margin_top . 'px' : $margin_top;
			$style .= "margin-top:$margin_top;";
		}

		if ( $margin_bottom ) {
			$margin_bottom = is_numeric( $margin_bottom ) ? $margin_bottom . 'px' : $margin_bottom;
			$style .= "margin-top:$margin_bottom;";
		}

		if ( $animation )
			$class .= " wow $animation";

		if ( $animation_delay && 'none' != $animation ) {
			$style .= 'animation-delay:' . absint( $animation_delay ) / 1000 . 's;-webkit-animation-delay:' . absint( $animation_delay ) / 1000 . 's;';
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output = "<div class='$class text-$alignment'$style>";
		$output .= do_shortcode( $content );
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'wolf_buttons_container', 'wolf_buttons_container_shortcode' );

}

if ( ! function_exists( 'wolf_button') ) {
	/**
	 * Buttons
	 */
	function wolf_button( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_button', $atts );
		}

		extract( shortcode_atts( array(
			'url' => '#',
			'target' => '_self',
			'color' => '',
			'custom_style' => 'no',
			'size' => 'medium',
			'type' => 'square',
			'tagline' => '',
			'text' => '',
			'add_button_icon' => '',
			'icon' => '',
			'icon_position' => 'after',
			'custom_style' => 'no',
			'button_bg_color' => '',
			'button_font_color' => '',
			'button_border_color' => '',
			'button_bg_color_hover' => '',
			'button_font_color_hover' => '',
			'button_border_color_hover' => '',
			'alignment' => 'left',
			'scroll_to_anchor' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$container_class = "button-container";

		if ( 'very-large' == $size ) {
			$container_class .= ' very-large-button-container';
		}

		$output = "<span class='$container_class'>";

		$output .= wolf_do_button(
			$text,
			$url,
			$tagline,
			$color,
			$type,
			$size,
			$custom_style,
			$button_bg_color,
			$button_font_color,
			$button_border_color,
			$button_bg_color_hover,
			$button_font_color_hover,
			$button_border_color_hover,
			$add_button_icon,
			$icon,
			$icon_position,
			$target,
			$scroll_to_anchor,
			$inline_style,
			$class
		);

		$output .= '</span>';

		return $output;
	}
	add_shortcode( 'wolf_button', 'wolf_button' );
}

if ( ! function_exists( 'wolf_call_to_action') ) {
	/**
	 * Call to action
	 */
	function wolf_call_to_action( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_call_to_action', $atts );
		}

		extract( shortcode_atts( array(
			'main_text' => '',
			'main_tagline' => '',
			'title_tag' => 'h4',
			'url' => '#',
			'target' => '_self',
			'color' => '',
			'custom_style' => 'no',
			'size' => 'medium',
			'type' => 'square',
			'tagline' => '',
			'text' => '',
			'add_button_icon' => '',
			'icon' => '',
			'icon_position' => 'after',
			'custom_style' => 'no',
			'button_bg_color' => '',
			'button_font_color' => '',
			'button_border_color' => '',
			'button_bg_color_hover' => '',
			'button_font_color_hover' => '',
			'button_border_color_hover' => '',
			'scroll_to_anchor' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "call-to-action clearfix";

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output = "<div class='$class'$style>";
		$output .= '<div class="call-to-action-text">';
		$output .= "<$title_tag class='call-to-action-title'>$main_text</$title_tag>";

		if ( $main_tagline )
			$output .= "<p>$main_tagline</p>";

		$output .= '</div>';
		$output .= '<div class="call-to-action-button">';
		$output .= wolf_do_button(
			$text,
			$url,
			$tagline,
			$color,
			$type,
			$size,
			$custom_style,
			$button_bg_color,
			$button_font_color,
			$button_border_color,
			$button_bg_color_hover,
			$button_font_color_hover,
			$button_border_color_hover,
			$add_button_icon,
			$icon,
			$icon_position,
			$target,
			$scroll_to_anchor
		);
		$output .= '</div>';
		$output .= '</div>';

		return $output;

	}
	add_shortcode( 'wolf_call_to_action', 'wolf_call_to_action' );
}