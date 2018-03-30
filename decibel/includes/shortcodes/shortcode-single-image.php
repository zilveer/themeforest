<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_single_image' ) ) {
	/**
	 * Single Image shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_single_image( $atts ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_single_image', $atts );
		}

		extract( shortcode_atts( array(
			'image' => '',
			'alignment' => '',
			'image_style' => '',
			'full_size' => '',
			'link' => '',
			'class' => '',
			'image_size' => 'large',
			'animation' => '',
			'animation_delay' => '',
			'hover_effect' => '',
			'inline_style' => '',
			'class' => '',
			'target' => '_self',
		), $atts ) );

		$href = $image_css = '';

		$image_class     = $class;
		$image_style     = sanitize_text_field( $image_style );
		$container_class = "wolf-single-image text-$alignment hover-$hover_effect $image_style";

		if ( $inline_style ) {
			$image_css .= $inline_style;
		}

		if ( 'round' == $image_style ) {
			$image_size = '2x2';
		}

		$image_size = wolf_get_image_size( $image_size );

		$image_css = ( $inline_style ) ? " style='$inline_style'" : '';

		if ( $animation )
			$container_class .= " wow $animation";

		$src = wolf_get_url_from_attachment_id( absint( $image ), $image_size );
		$src = ( $src ) ? $src : wolf_get_theme_uri( '/images/placeholders/' . $image_size . '.jpg' );
		$alt = esc_attr( get_post_meta( absint( $image ), '_wp_attachment_image_alt', true) );

		$output = "<div class='$container_class'>";

		if ( $full_size ) {

			$href    = wolf_get_url_from_attachment_id( absint( $image ), 'extra-large' );
			$output .= "<a href='$href' class='lightbox image-item'>";

		} elseif ( 'http://' != $link && $link ) {

			$link    = esc_url( $link );
			$output .= "<a href='$link' target='$target'>";
		
		} else {
			$output .= "<span class='image-item'>";
		}

		$output .= "<img src='$src' alt='$alt' $image_css class='$image_class'>";

		if ( $full_size || ( 'http://' != $link && $link ) )
			$output .= "</a>";

		else
			$output .= "</span>";

		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'wolf_single_image', 'wolf_shortcode_single_image' );
}
