<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_testimonials' ) ) {
	/**
	 * Testimonials shortcode
	 *
	 * @param array $atts
	 * @param array $content
	 * @return string
	 */
	function wolf_shortcode_testimonials( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_testimonials', $atts );
		}

		extract( shortcode_atts( array(
			'title' => '',
			'autoplay' => 'yes',
			'transition' => 'auto',
			'slideshow_speed' => 4000,
			'pause_on_hover' => 'yes',
			'animation' => '',
			'animation_delay' => '',
			'nav_bullets' => 'yes',
			'nav_arrows' => 'yes',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		//$autoplay = esc_attr( $autoplay );
		//$transition = esc_attr( $transition );
		//$slideshow_speed = absint( $slideshow_speed );
		//$pause_on_hover = esc_attr( $pause_on_hover );
		//$animation_delay = absint( $animation_delay );
		//$nav_bullets = absint( $nav_bullets );
		//$nav_arrows = absint( $nav_arrows );
		//$inline_style = sanitize_text_field( $inline_style );
		//$title = esc_attr( $title );
		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= 'testimonials-container';

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

		$output = "<section class='$class'$style>";
		$output .= "<div $slider_data class='testimonials-slider'>";
		//$output .= "<ul class='slides'>";

		$output .= do_shortcode( $content );

		//$output .= '</ul>';
		$output .= '</div></section>';

		return $output;
	}
	add_shortcode( 'wolf_testimonials', 'wolf_shortcode_testimonials' );
}

if ( ! function_exists( 'wolf_shortcode_testimonial' ) ) {
	/**
	 * Testimonial shortcode
	 *
	 * @param array $atts
	 * @param array $content
	 * @return string
	 */
	function wolf_shortcode_testimonial( $atts, $content = null ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_testimonial', $atts );
		}

		extract( shortcode_atts(  array(
			'name' => '',
			'avatar' => '',
			'link' => '',
		), $atts ) );

		$cite = '<cite class="testimonial-cite">';

		if ( $avatar ) {
			$avatar = wolf_get_url_from_attachment_id( absint( $avatar ), 'avatar' );
		}

		if ( $name )
			$cite .= $name;

		if ( $link ) {
			$link = esc_url( $link );
			$cite .= " | <a href='$link' target='_blank'>$link</a>";
		}

		$cite .= '</cite>';

		$output = "<div class='slide'><div class='testimonal-container'>";

		if ( $avatar )
		$output .= "<span class='testimonial-avatar'><img src='$avatar' alt='testimonial-avatar'></span>";

		$output .= "<blockquote class='testimonial-content'>";
		$output .= sanitize_text_field( $content );
		$output .= $cite;
		$output .= '</blockquote>';
		$output .= '</div>
		</div>';

		return $output;
	}
	add_shortcode( 'wolf_testimonial', 'wolf_shortcode_testimonial' );
}