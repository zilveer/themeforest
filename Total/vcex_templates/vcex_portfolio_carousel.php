<?php
/**
 * Visual Composer Portfolio Carousel
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

// Deprecated Attributes
if ( ! empty( $atts['term_slug'] ) && empty( $atts['include_categories']) ) {
	$atts['include_categories'] = $atts['term_slug'];
}

// Define output
$output = '';

// Get and extract shortcode attributes
$atts = vc_map_get_attributes( 'vcex_portfolio_carousel', $atts );

// Define attributes
$atts['post_type'] = 'portfolio';
$atts['taxonomy']  = 'portfolio_category';
$atts['tax_query'] = '';

// Build the WordPress query
$wpex_query = vcex_build_wp_query( $atts );

//Output posts
if ( $wpex_query->have_posts() ) :

	// Extract attributes
	extract( $atts );

	// IMPORTANT: Fallback required from VC update when params are defined as empty
	// AKA - set things to enabled by default
	$media   = ( ! $media ) ? 'true' : $media;
	$title   = ( ! $title ) ? 'true' : $title;
	$excerpt = ( ! $excerpt ) ? 'true' : $excerpt;

	// Load scripts
	$inline_js = array( 'carousel' );

	// Items to scroll fallback for old setting
	if ( 'page' == $items_scroll ) {
		$items_scroll = $items;
	}

	// Main Classes
	$wrap_classes = array( 'wpex-carousel', 'wpex-carousel-portfolio', 'clr', 'owl-carousel' );
	
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

	// CSS animations
	if ( $css_animation ) {
		$wrap_classes[] = vcex_get_css_animation( $css_animation );
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

	// Title design
	$heading_style = vcex_inline_style( array(
		'margin'         => $content_heading_margin,
		'text_transform' => $content_heading_transform,
		'font_size'      => $content_heading_size,
		'font_weight'    => $content_heading_weight,
		'line_height'    => $content_heading_line_height,
	) );

	// Heading color
	$content_heading_color = vcex_inline_style( array(
		'color' => $content_heading_color,
	) );

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
	if ( wpex_vc_is_inline() || '1' == count( $wpex_query->posts ) ) {
		$auto_play = 'false';
	}

	// Turn arrays into strings
	$wrap_classes = implode( ' ', $wrap_classes );

	// Inline js
	vcex_inline_js( $inline_js );

	// Begin output
	$output .= '<div class="'. $wrap_classes .'"'. vcex_get_unique_id( $unique_id ) .' data-items="'. $items .'" data-slideby="'. $items_scroll .'" data-nav="'. $arrows .'" data-dots="'. $dots .'" data-autoplay="'. $auto_play .'" data-loop="'. $infinite_loop .'" data-autoplay-timeout="'. $timeout_duration .'" data-center="'. $center .'" data-margin="'. intval( $items_margin ) .'" data-items-tablet="'. $tablet_items .'" data-items-mobile-landscape="'. $mobile_landscape_items .'" data-items-mobile-portrait="'. $mobile_portrait_items .'" data-smart-speed="'. $animation_speed .'">';

		// Start loop
		$count = 0;
		while ( $wpex_query->have_posts() ) :
			$count++;

			// Get post from query
			$wpex_query->the_post();
		
			// Post VARS
			$atts['post_id']        = get_the_ID();
			$atts['post_permalink'] = wpex_get_permalink( $atts['post_id'] );
			$atts['post_title']     = get_the_title( $atts['post_id'] );
			$atts['post_esc_title'] = wpex_get_esc_title();

			$output .= '<div class="wpex-carousel-slide">';

				// Display media
				if ( 'true' == $media && has_post_thumbnail() ) :
					
					// Image html
					$img_html = wpex_get_post_thumbnail( array(
						'size'   => $img_size,
						'crop'   => $img_crop,
						'width'  => $img_width,
						'height' => $img_height,
						'alt'    => $atts['post_esc_title'],
					) );

					$output .= '<div class="'. $media_classes .'">';

						// No links
						if ( 'none' == $thumbnail_link ) :

							$output .= $img_html;

						// Lightbox
						elseif ( 'lightbox' == $thumbnail_link ) :

							$output .= '<a href="'. wpex_get_lightbox_image() .'" title="'. $atts['post_esc_title'] .'" class="wpex-carousel-entry-img wpex-carousel-lightbox-item" data-count="'. $count .'" data-title="'. $atts['post_esc_title'] .'">';

								$output .= $img_html;

						// Link to post
						else :

							$output .= '<a href="'. $atts['post_permalink'] .'" title="'. $atts['post_esc_title'] .'" class="wpex-carousel-entry-img">';

								$output .= $img_html;

						endif;

						// Overlay & close link
						if ( 'none' != $thumbnail_link ) {

							// Inner Overlay
							if ( $overlay_style && 'none' != $overlay_style ) {

								ob_start();
								wpex_overlay( 'inside_link', $overlay_style, $atts );
								$output .= ob_get_clean();

							}

							// Close link
							$output .= '</a>';

							// Outside Overlay
							if ( $overlay_style && 'none' != $overlay_style ) {
								ob_start();
								wpex_overlay( 'outside_link', $overlay_style, $atts );
								$output .= ob_get_clean();
							}

						}

					$output .= '</div>';

				endif;

				// Details
				if ( 'true' == $title || 'true' == $excerpt ) :

					$output .= '<div class="wpex-carousel-entry-details clr"'. $content_style .'>';

						// Title
						if ( 'true' == $title && $atts['post_title'] ) :

							$output .= '<div class="wpex-carousel-entry-title entry-title"'. $heading_style .'>';
								$output .= '<a href="'. $atts['post_permalink'] .'" title="'. $atts['post_esc_title'] .'"'. $content_heading_color .'>';
									$output .= esc_html( $atts['post_title'] );
								$output .= '</a>';
							$output .= '</div>';

						endif;

						// Excerpt
						if ( 'true' == $excerpt ) :

							// Generate excerpt
							$atts['post_excerpt'] = wpex_get_excerpt( array (
								'length' => intval( $excerpt_length ),
							) );

							if ( $atts['post_excerpt'] ) {

								$output .= '<div class="wpex-carousel-entry-excerpt clr">';
									$output .= $atts['post_excerpt']; // Escaped via wp_trim_words
								$output .= '</div>';

							}

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