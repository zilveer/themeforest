<?php

/*
 *	Media functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


 /**
 * Generic function that prints a slider/carousel navigation
 */
function blade_grve_element_navigation( $navigation_type = 0, $navigation_color = 'dark' ) {

	$output = '';

	if ( 0 != $navigation_type ) {

		switch( $navigation_type ) {

			case '2':
				$icon_nav_prev = 'grve-icon-arrow-left-alt';
				$icon_nav_next = 'grve-icon-arrow-right-alt';
				break;
			case '3':
				$icon_nav_prev = 'grve-icon-arrow-left';
				$icon_nav_next = 'grve-icon-arrow-right';
				break;
			case '4':
				$icon_nav_prev = 'grve-icon-arrow-left';
				$icon_nav_next = 'grve-icon-arrow-right';
				break;
			default:
				$navigation_type = '1';
				$icon_nav_prev = 'grve-icon-arrow-left-lg-alt';
				$icon_nav_next = 'grve-icon-arrow-right-lg-alt';
				break;
		}

		$output .= '<div class="grve-carousel-navigation grve-' . esc_attr( $navigation_color ) . ' grve-navigation-' . esc_attr( $navigation_type ) . '">';
		$output .= '	<div class="grve-carousel-buttons">';
		$output .= '		<div class="grve-carousel-prev">';
		$output .= '			<i class="' . esc_attr( $icon_nav_prev ) . '"></i>';
		$output .= '		</div>';
		$output .= '		<div class="grve-carousel-next">';
		$output .= '			<i class="' . esc_attr( $icon_nav_next ) . '"></i>';
		$output .= '		</div>';
		$output .= '	</div>';
		$output .= '</div>';
	}

	return 	$output;

}

/**
 * Generic function that prints a slider or gallery
 */
function blade_grve_print_gallery_slider( $gallery_mode, $slider_items , $image_size_slider = 'blade-grve-large-rect-horizontal', $extra_class = "") {

	if ( empty( $slider_items ) ) {
		return;
	}
	$image_size_gallery_thumb = 'blade-grve-small-rect-horizontal';
	if( 'gallery-vertical' == $gallery_mode ) {
		$image_size_gallery_thumb = $image_size_slider;
	}

	$start_block = $end_block = $item_class = '';


	if ( 'gallery' == $gallery_mode || '' == $gallery_mode || 'gallery-vertical' == $gallery_mode ) {

		$gallery_index = 0;

?>
		<div class="grve-media">
			<ul class="grve-post-gallery grve-post-gallery-popup <?php echo esc_attr( $extra_class ); ?>">
<?php

		foreach ( $slider_items as $slider_item ) {

			$media_id = $slider_item['id'];
			$full_src = wp_get_attachment_image_src( $media_id, 'blade-grve-fullscreen' );
			$image_full_url = $full_src[0];

			$thumb_src = wp_get_attachment_image_src( $media_id, $image_size_gallery_thumb );
			$image_thumb_url = $thumb_src[0];

			$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
			$caption = get_post_field( 'post_excerpt', $media_id );
			$figcaption = '';

			if	( !empty( $caption ) ) {
				$figcaption = wptexturize( $caption );
			}
			echo '

				<li class="grve-image-hover">
					<a title="' . esc_attr( $figcaption ) . '" href="' . esc_url( $image_full_url ) . '">
						<img src="' . esc_url( $image_thumb_url ) . '" alt="' . esc_attr( $alt ) . '" width="' . esc_attr( $thumb_src[1] ) . '" height="' . esc_attr( $thumb_src[2] ) . '">
					</a>
				</li>
			';
		}
?>
			</ul>
		</div>
<?php

	} else {

		$slider_settings = array();
		if ( is_singular( 'post' ) || is_singular( 'portfolio' ) ) {
			if ( is_singular( 'post' ) ) {
				$slider_settings = blade_grve_post_meta( 'grve_post_slider_settings' );
			} else {
				$slider_settings = blade_grve_post_meta( 'grve_portfolio_slider_settings' );
			}
		}
		$slider_speed = blade_grve_array_value( $slider_settings, 'slideshow_speed', '2500' );
		$slider_dir_nav = blade_grve_array_value( $slider_settings, 'direction_nav', '1' );
		$slider_dir_nav_color = blade_grve_array_value( $slider_settings, 'direction_nav_color', 'dark' );

?>
		<div class="grve-media clearfix">
			<div class="grve-element grve-carousel-wrapper">

			<?php echo blade_grve_element_navigation( $slider_dir_nav, $slider_dir_nav_color ); ?>

				<div class="grve-slider grve-carousel-element " data-slider-speed="<?php echo esc_attr( $slider_speed ); ?>" data-slider-pause="yes" data-slider-autoheight="no">
<?php
					foreach ( $slider_items as $slider_item ) {
						$media_id = $slider_item['id'];
						$full_src = wp_get_attachment_image_src( $media_id, $image_size_slider );
						$image_url = $full_src[0];
						$alt = get_post_meta( $media_id, '_wp_attachment_image_alt', true );
						echo '<div class="grve-slider-item"><img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $alt ) . '" width="' . esc_attr( $full_src[1] ) . '" height="' . esc_attr( $full_src[2] ) . '"></div>';

					}
?>
				</div>

			</div>
		</div>
<?php
	}
}

/**
 * Generic function that prints video settings ( HTML5 )
 */

if ( !function_exists( 'blade_grve_print_media_video_settings' ) ) {
	function blade_grve_print_media_video_settings( $video_settings ) {
		$video_attr = '';

		if ( !empty( $video_settings ) ) {

			$video_poster = blade_grve_array_value( $video_settings, 'poster' );
			$video_preload = blade_grve_array_value( $video_settings, 'preload', 'metadata' );

			if( 'yes' == blade_grve_array_value( $video_settings, 'controls' ) ) {
				$video_attr .= ' controls';
			}
			if( 'yes' == blade_grve_array_value( $video_settings, 'loop' ) ) {
				$video_attr .= ' loop="loop"';
			}
			if( 'yes' ==  blade_grve_array_value( $video_settings, 'muted' ) ) {
				$video_attr .= ' muted="muted"';
			}
			if( 'yes' == blade_grve_array_value( $video_settings, 'autoplay' ) ) {
				$video_attr .= ' autoplay="autoplay"';
			}
			if( !empty( $video_poster ) ) {
				$video_attr .= ' poster="' . esc_url( $video_poster ) . '"';
			}
			$video_attr .= ' preload="' . esc_attr( $video_preload ) . '"';

		}
		return $video_attr;
	}
}

/**
 * Generic function that prints a video ( Embed or HTML5 )
 */
function blade_grve_print_media_video( $video_mode, $video_webm, $video_mp4, $video_ogv, $video_embed, $video_poster = '' ) {
	global $wp_embed;
	$video_output = '';

	if( empty( $video_mode ) && !empty( $video_embed ) ) {
		$video_output .= '<div class="grve-media">';
		$video_output .= $wp_embed->run_shortcode( '[embed]' . $video_embed . '[/embed]' );
		$video_output .= '</div>';
	} else {


		if ( !empty( $video_webm ) || !empty( $video_mp4 ) || !empty( $video_ogv ) ) {

			$video_settings = array(
				'controls' => 'yes',
				'poster' => $video_poster,
			);
			$video_settings = apply_filters( 'blade_grve_media_video_settings', $video_settings );

			$video_output .= '<div class="grve-media">';
			$video_output .= '  <video ' . blade_grve_print_media_video_settings( $video_settings ) . ' >';

			if ( !empty( $video_webm ) ) {
				$video_output .= '<source src="' . esc_url( $video_webm ) . '" type="video/webm">';
			}
			if ( !empty( $video_mp4 ) ) {
				$video_output .= '<source src="' . esc_url( $video_mp4 ) . '" type="video/mp4">';
			}
			if ( !empty( $video_ogv ) ) {
				$video_output .= '<source src="' . esc_url( $video_ogv ) . '" type="video/ogg">';
			}
			$video_output .='  </video>';
			$video_output .= '</div>';

		}
	}

	echo  $video_output;

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
