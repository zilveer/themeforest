<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_images_slider' ) ) {
	/**
	 * Image Slider shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_images_slider( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_images_slider', $atts );
		}

		extract( shortcode_atts( array(
			'ids' => '',
			'layout' => 'default',
			'autoplay' => '',
			'transition' => 'auto',
			'animation' => '',
			'animation_delay' => '',
			'autoplay' => 'yes',
			'transition' => 'auto',
			'slideshow_speed' => 4000,
			'pause_on_hover' => 'yes',
			'nav_bullets' => 'yes',
			'nav_arrows' => 'yes',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$images = explode( ',', $ids );

		$size = ( 'default' == $layout ) ? 'slide' : 'slide-' . $layout;

		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "wolf-images-slider-container slider-background-$layout";

		if ( $animation )
			$class .= " wow $animation";

		if ( $animation_delay && 'none' != $animation ) {
			$style .= 'animation-delay:' . absint( $animation_delay ) / 1000 . 's;-webkit-animation-delay:' . absint( $animation_delay ) / 1000 . 's;';
		}

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$slider_data = "data-pause-on-hover='$autoplay'
		data-autoplay='$autoplay'
		data-transition='$transition'
		data-slideshow-speed='$slideshow_speed'
		data-nav-arrows='$nav_arrows'
		data-nav-bullets='$nav_bullets'";

		$output = '';
		$output .= "<div class='wolf-slider-style-container'$style>";
		$output .= "<div class='$class'>";
		$output .= "<div $slider_data class='flexslider wolf-images-slider'>";
		$output .= '<ul class="slides">';

		foreach ( $images as $image_id ) {
			$attachment = get_post( $image_id );
			$image_url  = esc_url( wolf_get_url_from_attachment_id( $image_id, $size ) );
			$full_size  = esc_url( wolf_get_url_from_attachment_id( $image_id, 'extra-large' ) );
			$title = ( $attachment ) ? wptexturize( $attachment->post_title ) : '';
			$alt = ( $attachment ) ? esc_attr( get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) ) : '';
			$alt = ( $alt ) ? $alt : $title;
			$post_excerpt = ( $attachment ) ? wolf_sample( wptexturize( $attachment->post_excerpt ), 88 ) : '';
			$output .= '<li class="slide">';
			$output .= "<img src='$image_url' alt='$alt'>";
			if ( $post_excerpt )
				$output .= "<p class='flex-caption'>$post_excerpt</p>";
			$output .= '</li>';
		}

		$output .= '</ul>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';

		return $output;

	}
	add_shortcode( 'wolf_images_slider', 'wolf_shortcode_images_slider' );
}
