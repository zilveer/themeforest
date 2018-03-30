<?php
/**
 * Visual Composer Staff Carousel
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
if ( ! function_exists( 'vc_map_get_attributes' ) ) {
	vcex_function_needed_notice();
	return;
}

// Define output var
$output = '';

// Deprecated Attributes
if ( ! empty( $atts['term_slug'] ) && empty( $atts['include_categories']) ) {
	$atts['include_categories'] = $atts['term_slug'];
}

// Get and extract shortcode attributes
$atts = vc_map_get_attributes( 'vcex_staff_carousel', $atts );

// Extract shortcode atts
extract( $atts );

// Inline check
$is_inline = wpex_vc_is_inline();

// Build the WordPress query
$atts['post_type'] = 'staff';
$atts['tax_query'] = '';
$wpex_query = vcex_build_wp_query( $atts );

// Output posts
if ( $wpex_query->have_posts() ) :

	// IMPORTANT: Fallback required from VC update when params are defined as empty
	// AKA - set things to enabled by default
	$title   = ( ! $title ) ? 'true' : $title;
	$excerpt = ( ! $excerpt ) ? 'true' : $excerpt;

	// Load scripts
	$inline_js = array( 'carousel' );

	// Prevent auto play in visual composer
	if ( $is_inline ) {
		$auto_play = 'false';
	}

	// Items to scroll fallback for old setting
	if ( 'page' == $items_scroll ) {
		$items_scroll = $items;
	}

	// Main Classes
	$wrap_classes = array( 'wpex-carousel', 'wpex-carousel-staff', 'clr', 'owl-carousel' );
	
	// Carousel style
	if ( $style && 'default' != $style ) {
		$wrap_classes[] = $style;
		$arrows_position = ( 'no-margins' == $style && 'default' == $arrows_position ) ? 'abs' : $arrows_position;
	}

	// Arrow style
	if ( $arrows_style ) {
		$wrap_classes[] = 'arrwstyle-'. $arrows_style;
	}

	// Arrow position
	if ( $arrows_position && 'default' != $arrows_position ) {
		$wrap_classes[] = 'arrwpos-'. $arrows_position;
	}

	// Visiblity
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}

	// Custom Classes
	if ( $classes ) {
		$wrap_classes[] = vcex_get_extra_class( $classes );
	}

	// Entry media classes
	if ( 'true' == $media ) {
		$media_classes = array( 'wpex-carousel-entry-media', 'clr' );
		if ( $img_hover_style ) {
			$media_classes[] = wpex_image_hover_classes( $img_hover_style );
		}
		if ( $img_filter ) {
			$media_classes[] = wpex_image_filter_class( $img_filter );
		}
		if ( $overlay_style ) {
			$media_classes[] = wpex_overlay_classes( $overlay_style );
		}
		if ( 'lightbox' == $thumbnail_link ) {
			$inline_js[] = 'carousel_lightbox';
			$wrap_classes[] = 'wpex-carousel-lightbox';
			vcex_enque_style( 'ilightbox' );
		}
		$media_classes = implode( ' ', $media_classes );
	}

	// Position design
	if ( 'true' == $position ) {
		$position_style = vcex_inline_style( array(
			'font_size'   => $position_size,
			'font_weight' => $position_weight,
			'margin'      => $position_margin,
			'color'       => $position_color,
		) );
	}

	// Content Design
	$content_style = vcex_inline_style( array(
		'background' => $content_background,
		'padding'    => $content_padding,
		'margin'     => $content_margin,
		'border'     => $content_border,
		'font_size'  => $content_font_size,
		'color'      => $content_color,
		'opacity'    => $content_opacity,
		'text_align' => $content_alignment,

	) );

	// Social links style
	if ( 'true' == $social_links ) {
		$social_links_inline_css = vcex_inline_style( array(
			'margin' => $social_links_margin,
		) );
	}

	// Title design
	if ( 'true' == $title ) {
		$heading_style = vcex_inline_style( array(
			'margin'         => $content_heading_margin,
			'text_transform' => $content_heading_transform,
			'font_weight'    => $content_heading_weight,
			'font_size'      => $content_heading_size,
			'line_height'    => $content_heading_line_height,
		) );
		$heading_link_style = vcex_inline_style( array(
			'color' => $content_heading_color,
		) );
	}

	// Sanitize carousel data
	$arrows                 = wpex_esc_attr( $arrows, 'true' );
	$dots                   = wpex_esc_attr( $dots, 'false' );
	$auto_play              = wpex_esc_attr( $auto_play, 'false' );
	$infinite_loop          = wpex_esc_attr( $infinite_loop, 'true' );
	$center                 = wpex_esc_attr( $center, 'false' );
	$items                  = wpex_intval( $items, 4 );
	$items_scroll           = wpex_intval( $items_scroll, 1 );
	$timeout_duration       = wpex_intval( $timeout_duration, 5000 );
	$items_margin           = wpex_intval( $items_margin, 15 );
	$items_margin           = ( 'no-margins' == $style ) ? 0 : $items_margin;
	$tablet_items           = wpex_intval( $tablet_items, 3 );
	$mobile_landscape_items = wpex_intval( $mobile_landscape_items, 2 );
	$mobile_portrait_items  = wpex_intval( $mobile_portrait_items, 1 );
	$animation_speed        = wpex_intval( $animation_speed );

	// Disable autoplay
	if ( $is_inline || '1' == count( $wpex_query->posts ) ) {
		$auto_play = 'false';
	}

	// Turn array to strings
	$wrap_classes = implode( ' ', $wrap_classes );

	// Add inline js
	vcex_inline_js( $inline_js );

	// Begin output
	$output .='<div class="'. $wrap_classes .'"'. vcex_get_unique_id( $unique_id ) .' data-items="'. $items .'" data-slideby="'. $items_scroll .'" data-nav="'. $arrows .'" data-dots="'. $dots .'" data-autoplay="'. $auto_play .'" data-loop="'. $infinite_loop .'" data-autoplay-timeout="'. $timeout_duration .'" data-center="'. $center .'" data-margin="'. intval( $items_margin ) .'" data-items-tablet="'. $tablet_items .'" data-items-mobile-landscape="'. $mobile_landscape_items .'" data-items-mobile-portrait="'. $mobile_portrait_items .'" data-smart-speed="'. $animation_speed .'">';

		// Loop through posts
		$loop_count = 0;
		while ( $wpex_query->have_posts() ) :
			$loop_count ++;

			// Get post from query
			$wpex_query->the_post();
		
			// Post VARS
			$atts['post_id']        = get_the_ID();
			$atts['post_excerpt']   = wpex_get_permalink( $atts['post_id'] );
			$atts['post_esc_title'] = wpex_get_esc_title( $atts['post_id'] );

			$output .='<div class="wpex-carousel-slide wpex-clr">';

				// Media Wrap
				if ( has_post_thumbnail() ) :

					// Generate featured image
					$thumbnail = wpex_get_post_thumbnail( array(
						'size'   => $img_size,
						'crop'   => $img_crop,
						'width'  => $img_width,
						'height' => $img_height,
						'alt'    => wpex_get_esc_title(),
					) );

					$output .= '<div class="'. $media_classes .'">';

						// No links
						if ( in_array( $thumbnail_link, array( 'none', 'nowhere' ) ) ) {

							$output .= $thumbnail;

						}
						// Lightbox
						elseif ( 'lightbox' == $thumbnail_link ) {

							$output .= '<a href="'. wpex_get_lightbox_image() .'" title="'. $atts['post_esc_title'] .'" data-title="'. $atts['post_esc_title'] .'" data-count="'. $loop_count .'" class="wpex-carousel-entry-img wpex-carousel-lightbox-item">';

								$output .= $thumbnail;

						}
						// Link to post
						else {

							$output .= '<a href="'. $atts['post_excerpt'] .'" title="'. $atts['post_esc_title'] .'" class="wpex-carousel-entry-img">';

								$output .= $thumbnail;

						}

						// Inner Overlay
						if ( 'none' != $overlay_style ) {
							ob_start();
							wpex_overlay( 'inside_link', $overlay_style, $atts );
							$output .= ob_get_clean();
						}

						// Close link
						if ( ! in_array( $thumbnail_link, array( 'none', 'nowhere' ) ) ) {

							// Close link
							$output .= '</a>';

						}

						// Outside Overlay
						if ( 'none' != $overlay_style ) {
							ob_start();
							wpex_overlay( 'outside_link', $overlay_style, $atts );
							$output .= ob_get_clean();
						}

					$output .= '</div>';

				endif;

				// Title
				if ( 'true' == $title
					|| 'true' == $position
					|| 'true' == $excerpt
					|| 'true' == $social_links
				) :

					$output .= '<div class="wpex-carousel-entry-details clr"'. $content_style .'>';

						// Title
						if ( 'true' == $title ) :

							$output .= '<div class="wpex-carousel-entry-title entry-title"'. $heading_style .'>';

								if ( 'nowhere' == $title_link ) :

									$output .= esc_html( get_the_title() );

								else :

									$output .= '<a href="'. $atts['post_excerpt'] .'" title="'. $atts['post_esc_title'] .'"'. $heading_link_style .'>';
										
										$output .= esc_html( get_the_title() );

									$output .= '</a>';

								endif;

							$output .= '</div>';

						endif;

						// Display staff member position
						if ( 'true' == $position
							&& $get_position = get_post_meta( $atts['post_id'], 'wpex_staff_position', true )
						) :

							$output .= '<div class="staff-entry-position" '. $position_style .'>';

								$output .= esc_html( apply_filters( 'wpex_staff_entry_position', $get_position ) );

							$output .= '</div>';

						endif;

						// Check if the excerpt is enabled
						if ( 'true' == $excerpt ) :

							// Generate excerpt
							$atts['post_excerpt'] = wpex_get_excerpt( array (
								'length' => intval( $excerpt_length ),
							) );

							// Display excerpt if there is one
							if ( $atts['post_excerpt'] ) :

								$output .= '<div class="wpex-carousel-entry-excerpt clr">';

									$output .= $atts['post_excerpt'];

								$output .= '</div>';

							endif;

						endif;

						// Check if social is enabled
						if ( 'true' == $social_links ) :

							$output .= wpex_get_staff_social( array(
								'style'     => $social_links_style,
								'font_size' => $social_links_size,
							) );

						endif;

					$output .= '</div>';

				endif;

			$output .= '</div>';

		endwhile;

	$output .= '</div>';

	// Reset the post data to prevent conflicts with WP globals
	wp_reset_postdata();

	// Output shortcode HTML
	echo $output;

// If no posts are found display message
else :

	// Display no posts found error if function exists
	echo vcex_no_posts_found_message( $atts );

// End post check
endif;