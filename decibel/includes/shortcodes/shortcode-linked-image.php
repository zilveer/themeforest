<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_linked_image' ) ) {
	/**
	 * Single Image shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_linked_image( $atts ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_linked_image', $atts );
		}

		extract( shortcode_atts( array(
			'image' => '',
			'alignment' => 'center',
			'text_alignment' => 'center',
			'image_style' => '',
			'full_size' => '',
			'link' => '',
			'text' => '',
			'secondary_text' => '',
			'overlay_color' => '#000',
			'overlay_opacity' => '40',
			'text_color' => '#fff',
			'text_tag' => 'h3',
			'font' => '',
			'class' => '',
			'image_size' => 'large',
			'animation' => '',
			'animation_delay' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$href = $image_css = '';

		$image_class     = $class;
		$image_style     = sanitize_text_field( $image_style );
		$container_class = "wolf-linked-image text-$alignment $image_style";
		$overlay_opacity = absint( $overlay_opacity ) / 100;
		$text = sanitize_text_field( $text );

		$link = vc_build_link( $link );
		$url = esc_url( $link['url'] );
		$target = $link['target'];
		$title = $link['title'];

		$secondary_text = sanitize_text_field( $secondary_text );
		$secondary_text = "<span class='wolf-linked-image-secondary-text text-$text_alignment' style='color:$text_color'>$secondary_text</span>";
		$text_color = ( $text_color ) ? sanitize_text_field( $text_color ) : '#fff';
		$caption = "<$text_tag class='wolf-linked-image-caption text-$text_alignment' style='color:$text_color'>$text</$text_tag>";
		$alt = esc_attr( get_post_meta( absint( $image ), '_wp_attachment_image_alt', true) );

		if ( $inline_style ) {
			$image_css .= $inline_style;
		}

		if ( 'round' == $image_style )
			$image_size = '2x2';


		$image_css = ( $inline_style ) ? " style='$inline_style'" : '';

		if ( $animation )
			$container_class .= " wow $animation";


		$src = wolf_get_url_from_attachment_id( absint( $image ), $image_size );
		$src = ( $src ) ? $src : wolf_get_theme_uri( '/images/placeholders/' . $image_size . '.jpg' );

		$output = "<div class='$container_class'>";

		if ( 'http://' != $url && $url ) {
			$output .= '<a href="' . esc_url( $url ) . '" title="' . esc_attr( $title ) . '" target="' . esc_attr( $target ) . '" class="image-item">';
		} else {
			$output .= "<span class='image-item'>";
		}

		$output .= "<img src='$src' alt='$alt' $image_css class='$image_class'>";
		$output .= "<span class='wolf-linked-image-overlay' style='opacity:$overlay_opacity;background-color:$overlay_color'></span>";
		$output .= "<span class='wolf-linked-image-caption-container'><span class='wolf-linked-image-caption-table'>
		<span class='wolf-linked-image-caption-table-cell'>
		$caption
		$secondary_text
		</span>
		</span>
		</span>";

		if ( $full_size || ( 'http://' != $link && $link ) )
			$output .= "</a>";

		else
			$output .= "</span>";

		$output .= '</div>';

		return $output;
	}
	add_shortcode( 'wolf_linked_image', 'wolf_shortcode_linked_image' );
}
