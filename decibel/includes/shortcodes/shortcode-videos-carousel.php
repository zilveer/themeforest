<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_shortcode_last_videos_carousel' ) ) {
	/**
	 * countdown shortcode
	 *
	 * @param array $atts
	 * @return string
	 */
	function wolf_shortcode_last_videos_carousel( $atts ) {

		if ( class_exists( 'Vc_Manager' ) && function_exists( 'vc_map_get_attributes' ) ) {
			$atts = vc_map_get_attributes( 'wolf_last_videos_carousel', $atts );
		}

		extract( shortcode_atts( array(
			'count' => 3,
			'category' => '',
			'inline_style' => '',
			'class' => '',
		), $atts ) );

		$count = absint( $count );
		$category = sanitize_text_field( $category );
		$class = sanitize_text_field( $class );
		$inline_style = sanitize_text_field( $inline_style );

		$args = array(
			'post_type' => 'video',
			'posts_per_page' => absint( $count ),
		);

		if ( wolf_get_theme_option( 'video_reorder' ) ) {
			$args['order'] = 'ASC';
			$args['meta_key'] = '_position';
			$args['orderby'] = 'meta_value_num';
		}

		if ( $category ) {
			$args['video_type'] = $category;
		}

		$loop = new WP_Query( $args );

		$style = '';
		$class = ( $class ) ? "$class " : ''; // add space
		$class .= "videos-carousel";

		if ( $inline_style ) {
			$style .= $inline_style;
		}

		$style = ( $style ) ? " style='$style'" : '';

		$output = "<section class='$class'$style>";

		if ( $loop->have_posts() ) {
			while( $loop->have_posts() ) {
				$loop->the_post();

				$video_url = wolf_get_first_video_url();
				$thumbnail = wolf_get_post_thumbnail_url( 'classic-video-thumb' );

				if ( $video_url )
					$output .= "<div class='item-video' data-merge='2' style='background-image:url($thumbnail);'><a class='owl-video' href='$video_url'></a></div>";
			}
		}

		$output .= '</section>';
		wp_reset_postdata();
		return $output;
	}
	add_shortcode( 'wolf_last_videos_carousel', 'wolf_shortcode_last_videos_carousel' );
}
