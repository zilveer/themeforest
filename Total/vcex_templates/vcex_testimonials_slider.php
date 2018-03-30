<?php
/**
 * Visual Composer Testimonials Slider
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Not needed in admin ever
if ( is_admin() ) {
	return;
}

// Required VC functions
if ( ! function_exists( 'vc_map_get_attributes' ) || ! function_exists( 'vc_shortcode_custom_css_class' ) ) {
	vcex_function_needed_notice();
	return;
}

// Define output var
$output = '';

// Deprecated Attributes
if ( ! empty( $atts['term_slug'] ) && empty( $atts['include_categories']) ) {
	$atts['include_categories'] = $atts['term_slug'];
}

// Define non-vc attributes
$atts['post_type'] = 'testimonials';
$atts['taxonomy']  = 'testimonials_category';
$atts['tax_query'] = '';

// Extract shortcode atts
extract( vc_map_get_attributes( 'vcex_testimonials_slider', $atts ) );

// Posts per page
$posts_per_page = $count;

// Build the WordPress query
$wpex_query = vcex_build_wp_query( $atts );

// Output posts
if ( $wpex_query->have_posts() ) :

	// Define and sanitize variables
	$slideshow = vc_is_inline() ? 'false' : $slideshow;

	// Load js
	vcex_inline_js( array( 'slider_pro' ) );

	// Add Style - OLD deprecated params.
	$wrap_style = '';
	if ( ! $css ) {
		$wrap_style = array();
		if ( isset( $atts['background'] ) ) {
			$wrap_style['background_color'] = $atts['background'];
		}
		if ( isset( $atts['background_image'] ) ) {
			$wrap_style['background_image'] = wp_get_attachment_url( $atts['background_image'] ) ;
		}
		if ( isset( $atts['padding_top'] ) ) {
			$wrap_style['padding_top'] = $atts['padding_top'];
		}
		if ( isset( $atts['padding_bottom'] ) ) {
			$wrap_style['padding_bottom'] = $atts['padding_bottom'];
		}
		$wrap_style = vcex_inline_style( $wrap_style );
	}

	// Slide Style
	$slide_style = vcex_inline_style( array(
		'font_size'   => $font_size,
		'font_weight' => $font_weight,
	) );

	// Image classes
	$img_classes = '';
	if ( ( $img_width || $img_height ) || 'wpex_custom' != $img_size ) {
		$img_classes .= 'remove-dims';
	}

	// Wrap classes
	$wrap_classes = array( 'vcex-testimonials-fullslider', 'vcex-flexslider-wrap', 'wpex-fs-21px' );
	if ( $skin ) {
		$wrap_classes[] = $skin .'-skin';
	}
	if ( 'true' == $direction_nav ) {
		$wrap_classes[] = 'has-arrows';
	}
	if ( 'true' == $control_thumbs ) {
		$wrap_classes[] = 'has-thumbs';
	}
	if ( ! empty( $background_style ) && ! empty( $background_image ) ) {
		$wrap_classes[] = 'vcex-background-'. $background_style;
	}
	if ( $css_animation ) {
		$wrap_classes[] = vcex_get_css_animation( $css_animation );
	}
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}
	if ( $css ) {
		$wrap_classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_testimonials_slider', $atts );
	}
	$wrap_classes   = implode( ' ', $wrap_classes );

	// Wrap data
	$slider_data = '';
	$slider_data .= ' data-dots="true"';
	$slider_data .= ' data-fade-arrows="false"';
	if ( 'false' != $loop ) {
		$slider_data .= ' data-loop="true"';
	}
	if ( 'false' == $slideshow ) {
		$slider_data .= ' data-auto-play="false"';
	}
	if ( in_array( $animation, array( 'fade', 'fade_slides' ) ) ) {
		$slider_data .= ' data-fade="true"';
	}
	if ( $slideshow && $slideshow_speed ) {
		$slider_data .= ' data-auto-play-delay="'. $slideshow_speed .'"';
	}
	if ( 'true' != $direction_nav ) {
		$slider_data .= ' data-arrows="false"';
	}
	if ( 'false' == $control_nav ) {
		$slider_data .= ' data-buttons="false"';
	}
	if ( 'true' == $control_thumbs ) {
		$slider_data .= ' data-thumbnails="true"';
	}
	if ( $animation_speed ) {
		$slider_data .= ' data-animation-speed="'. intval( $animation_speed ) .'"';
	}
	if ( $height_animation ) {
		$height_animation = intval( $height_animation );
		$height_animation = 0 == $height_animation ? '0.0' : $height_animation;
		$wrap_data[] = 'data-height-animation-duration="'. $height_animation .'"';
	}
	if ( $control_thumbs_height ) {
		$slider_data .= ' data-thumbnail-height="'. intval( $control_thumbs_height ) .'"';
	}
	if ( $control_thumbs_width ) {
		$slider_data .= ' data-thumbnail-width="'. intval( $control_thumbs_width ) .'"';
	}

	// Image settings & style
	$img_style = vcex_inline_style( array(
		'border_radius' => $img_border_radius,
	), false );

	// Start output
	$output .= '<div class="'. esc_attr( $wrap_classes ) .'"'. vcex_get_unique_id( $unique_id ) .''. $wrap_style .'>';

		$output .= '<div class="wpex-slider slider-pro"'. $slider_data .'>';

			$output .= '<div class="wpex-slider-slides sp-slides">';

				// Store posts in an array for use with the thumbnails later
				$posts_cache = array();

				// Loop through posts
				while ( $wpex_query->have_posts() ) :

					// Get post from query
					$wpex_query->the_post();

					// Get post data and make available in $atts array
					$atts['post_id']           = get_the_ID();
					$atts['post_content']      = get_the_content();
					$atts['post_meta_author']  = get_post_meta( $atts['post_id'], 'wpex_testimonial_author', true );
					$atts['post_meta_company'] = get_post_meta( $atts['post_id'], 'wpex_testimonial_company', true );
					$atts['post_meta_url']     = get_post_meta( $atts['post_id'], 'wpex_testimonial_url', true );

					// Store post ids
					$posts_cache[] = $atts['post_id'];

					// Testimonial start
					if ( '' != $atts['post_content'] ) :

						$output .= '<div class="wpex-slider-slide sp-slide">';

							$output .= '<div class="vcex-testimonials-fullslider-inner textcenter clr">';

								// Author avatar
								if ( 'yes' == $display_author_avatar && has_post_thumbnail( $atts['post_id'] ) ) :

									$output .= '<div class="vcex-testimonials-fullslider-avatar">';

										// Output thumbnail
										$output .= wpex_get_post_thumbnail( array(
											'size'   => $img_size,
											'crop'   => $img_crop,
											'width'  => $img_width,
											'height' => $img_height,
											'alt'    => wpex_get_esc_title(),
											'style'  => $img_style,
											'class'  => $img_classes,
										) );

									$output .= '</div>';

								endif;

								// Custom Excerpt
								if ( 'true' == $excerpt ) :

									if ( 'true' == $read_more ) {

										$read_more_text = $read_more_text ? esc_html( $read_more_text ) : esc_html__( 'read more', 'total' );
										$read_more_link = '&hellip;<a href="'. get_permalink() .'" title="'. $read_more_text .'">'. $read_more_text .'<span>&rarr;</span></a>';

									} else {

										$read_more_link = '&hellip;';

									}

									$output .= '<div class="entry remove-last-p-margin wpex-fw-300 clr"'. $slide_style .'>';
										$output .= wpex_get_excerpt( array (
											'length' => intval( $excerpt_length ),
											'more'   => $read_more_link,
										) );
									$output .= '</div>';

								// Full content
								else :

									$output .= '<div class="entry remove-last-p-margin wpex-fw-300 clr"'. $slide_style .'>';
									$output .= apply_filters( 'the_content', get_the_content() );
									$output .= '</div>';
								
								endif;

								// Author name
								if ( 'yes' == $display_author_name || 'true' == $display_author_company ) :

									$output .= '<div class="vcex-testimonials-fullslider-author wpex-fs-14px clr">';

										// Display author name
										if ( 'yes' == $display_author_name ) {
											$output .= $atts['post_meta_author'];
										}

										// Display company
										if ( $atts['post_meta_company'] && 'true' == $display_author_company ) {
											if ( $atts['post_meta_url'] ) {

												$output .= '<a href="'. esc_url( $atts['post_meta_url'] ) .'" class="vcex-testimonials-fullslider-company display-block" title="'. esc_attr( $atts['post_meta_company'] ) .'" target="_blank">'. esc_html( $atts['post_meta_company'] ) .'</a>';

											} else {

												$output .= '<div class="vcex-testimonials-fullslider-company">'. esc_html( $atts['post_meta_company'] ) .'</div>';

											}
										}

										// Display rating
										if ( 'true' == $rating && $atts['post_rating'] = gds_get_star_rating( '', $atts['post_id'] ) ) {

											$output .= '<div class="vcex-testimonials-fullslider-rating clr">'. $atts['post_rating'] .'</div>';

										}

									$output .= '</div>';

								endif;

							$output .= '</div>';

						$output .= '</div>';

					endif;

				endwhile;

			$output .= '</div>';

			if ( 'true' == $control_thumbs ) :

				$output .= '<div class="sp-nc-thumbnails">';

					foreach ( $posts_cache as $post_id ) :

						// Output thumbnail image
						$output .= wpex_get_post_thumbnail( array(
							'attachment' => get_post_thumbnail_id( $post_id ),
							'size'       => $img_size,
							'crop'       => $img_crop,
							'width'      => $img_width,
							'height'     => $img_height,
							'class'      => 'sp-nc-thumbnail',
						) );

					endforeach;

				$output .= '</div>';

			endif;

		$output .= '</div>';

	$output .= '</div>';

	// Reset the post data to prevent conflicts with WP globals
	wp_reset_postdata();

	// Echo output
	echo $output;

// If no posts are found display message
else :

	// Display no posts found error if function exists
	echo vcex_no_posts_found_message( $atts );

// End post check
endif;