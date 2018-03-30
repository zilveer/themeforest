<?php
/**
 * Visual Composer Testimonials Carousel
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

// Define output
$output = '';

// Get shortcode attributes
$atts = vc_map_get_attributes( 'vcex_terms_carousel', $atts );

// Taxonomy is required
if ( ! $atts['taxonomy'] ) {
	return;
}

// Term arguments
$term_args = array();
if ( $atts['parent_terms'] ) {
	$term_args['parent'] = 0;
}
if ( $atts['child_of'] ) {
	$child_of = get_term_by( 'slug', $atts['child_of'], $atts['taxonomy'] );
	if ( $child_of && ! is_wp_error( $child_of ) ) {
		$term_args['child_of'] = $child_of->term_id;
	}
}

// Get terms
$terms = get_terms( $atts['taxonomy'], $term_args );

// Terms needed
if ( ! $terms || is_wp_error( $terms ) ) {
	return;
}

// Get excluded terms
$atts['exclude_terms'] = $atts['exclude_terms'] ? preg_split( '/\,[\s]*/', $atts['exclude_terms'] ) : array();

// Get term thumbnails
$term_data = wpex_get_term_data();

// Load scripts
$inline_js = array( 'carousel' );

// Main Classes
$wrap_classes = array( 'wpex-carousel', 'vcex-terms-carousel', 'clr', 'owl-carousel' );

// Arrow style
if ( $atts['arrows_style'] ) {
	$wrap_classes[] = 'arrwstyle-'. $atts['arrows_style'];
}

// Arrow position
if ( $atts['arrows_position'] && 'default' != $atts['arrows_position'] ) {
	$wrap_classes[] = 'arrwpos-'. $atts['arrows_position'];
}

// Visiblity
if ( $atts['visibility'] ) {
	$wrap_classes[] = $atts['visibility'];
}

// CSS animations
if ( $atts['css_animation'] ) {
	$wrap_classes[] = vcex_get_css_animation( $atts['css_animation'] );
}

// Custom Classes
if ( $atts['classes'] ) {
	$wrap_classes[] = vcex_get_extra_class( $atts['classes'] );
}

// Sanitize carousel data
$arrows                 = wpex_esc_attr( $atts['arrows'], 'true' );
$dots                   = wpex_esc_attr( $atts['dots'], 'false' );
$auto_play              = wpex_esc_attr( $atts['auto_play'], 'false' );
$infinite_loop          = wpex_esc_attr( $atts['infinite_loop'], 'true' );
$center                 = wpex_esc_attr( $atts['center'], 'false' );
$items                  = wpex_intval( $atts['items'], 4 );
$items_scroll           = wpex_intval( $atts['items_scroll'], 1 );
$timeout_duration       = wpex_intval( $atts['timeout_duration'], 5000 );
$items_margin           = wpex_intval( $atts['items_margin'], 15 );
$tablet_items           = wpex_intval( $atts['tablet_items'], 3 );
$mobile_landscape_items = wpex_intval( $atts['mobile_landscape_items'], 2 );
$mobile_portrait_items  = wpex_intval( $atts['mobile_portrait_items'], 1 );
$animation_speed        = wpex_intval( $atts['animation_speed'] );

// Disable autoplay
if ( wpex_vc_is_inline() || '1' == count( $terms ) ) {
	$auto_play = 'false';
}

// Turn arrays into strings
$wrap_classes = implode( ' ', $wrap_classes );

// Inline js
vcex_inline_js( 'carousel' );

// Typography
$title_typo       = vcex_parse_typography_param( $atts['title_typo'] );
$title_tag        = ! empty( $title_typo['tag'] ) ? $title_typo['tag'] : 'h2';
$description_typo = vcex_parse_typography_param( $atts['description_typo'] );

// Remove useless align
if ( isset( $title_typo['text_align'] ) && 'left' == $title_typo['text_align'] ) {
	unset( $title_typo['text_align'] );
}
if ( isset( $description_typo['text_align'] ) && 'left' == $description_typo['text_align'] ) {
	unset( $description_typo['text_align'] );
}

// Load Google Fonts if needed
if ( $atts['title_font_family'] ) {
	wpex_enqueue_google_font( $atts['title_font_family'] );
}
if ( $atts['description_font_family'] ) {
	wpex_enqueue_google_font( $atts['description_font_family'] );
}

// Define post type based on the taxonomy
$taxonomy  = get_taxonomy( $atts['taxonomy'] );
$post_type = $taxonomy->object_type[0];

// Entry CSS wrapper
if ( $atts['entry_css'] ) {
	$entry_css_class = vc_shortcode_custom_css_class( $atts['entry_css'] );
}

// Image classes
$media_classes = array( 'vcex-terms-grid-entry-image', 'wpex-clr' );
if ( 'true' == $atts['title_overlay'] && 'true' == $atts['img'] ) {
	$media_classes[] = 'vcex-has-overlay';
}
if ( $atts['img_filter'] ) {
	$media_classes[] = wpex_image_filter_class( $atts['img_filter'] );
}
if ( $atts['img_hover_style'] ) {
	$media_classes[] = wpex_image_hover_classes( $atts['img_hover_style'] );
}
$media_classes = implode( ' ', $media_classes );

// Title style
$title_style = array(
	'font_family'   => $atts['title_font_family'],
	'font_weight'   => $atts['title_font_weight'],
	'margin_bottom' => $atts['title_bottom_margin'],
);
$title_style = $title_typo + $title_style;
$title_style = vcex_inline_style( $title_style );

// Description style
$description_font_family = array( 'font_family' => $atts['description_font_family'] );
$description_typo        = $description_typo + $description_font_family;
$description_style       = vcex_inline_style( $description_typo );

// Begin output
$output .= '<div class="'. $wrap_classes .'"'. vcex_get_unique_id( $atts['unique_id'] ) .' data-items="'. $items .'" data-slideby="'. $items_scroll .'" data-nav="'. $arrows .'" data-dots="'. $dots .'" data-autoplay="'. $auto_play .'" data-loop="'. $infinite_loop .'" data-autoplay-timeout="'. $timeout_duration .'" data-center="'. $center .'" data-margin="'. intval( $items_margin ) .'" data-items-tablet="'. $tablet_items .'" data-items-mobile-landscape="'. $mobile_landscape_items .'" data-items-mobile-portrait="'. $mobile_portrait_items .'" data-smart-speed="'. $animation_speed .'">';

	// Loop through terms
	foreach( $terms as $term ) :

		// Excluded
		if ( in_array( $term->slug, $atts['exclude_terms'] ) ) {
			continue;
		}

		// Begin entry output
		$output .= '<div class="vcex-terms-carousel-entry clr term-'. $term->term_id . $term->slug .'">';

		// Entry css wrapper
		if ( $atts['entry_css'] && $entry_css_class ) {

			$output .= '<div class="'. esc_attr( $entry_css_class ) .'">';

		}

			// Display image if enabled
			if ( 'true' == $atts['img'] ) :

				// Check meta for featured image
				$img_id = '';

				// Check wpex_term_thumbnails option for custom category image
				if ( ! empty( $term_data[$term->term_id]['thumbnail'] ) ) {
					$img_id = $term_data[$term->term_id]['thumbnail'];
				}

				// Get woo product image
				elseif ( 'product' == $post_type && function_exists( 'get_woocommerce_term_meta' ) ) {
					$img_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
				}

				// Image not defined via meta, display image from first post in term
				if ( ! $img_id ) :

					// Query first post in term
					$first_post = new WP_Query( array(
						'post_type'      => $post_type,
						'posts_per_page' => '1',
						'no_found_rows'  => true,
						'tax_query'      => array(
							array(
								'taxonomy' => $term->taxonomy,
								'field'    => 'id',
								'terms'    => $term->term_id,
							)
						),
					) );

					// Get featured image of first post
					if ( $first_post->have_posts() ) {

						while ( $first_post->have_posts() ) : $first_post->the_post();

							$img_id = get_post_thumbnail_id();

						endwhile;

					}

					// Reset query
					wp_reset_postdata();

				endif;

				if ( $img_id ) :

					$output .= '<div class="'. esc_attr( $media_classes ) .'">';

						$output .= '<a href="'. get_term_link( $term, $taxonomy ) .'" title="'. $term->name .'">';

							// Display post thumbnail
							$output .= wpex_get_post_thumbnail( array(
								'attachment' => $img_id,
								'alt'        => $term->name,
								'width'      => $atts['img_width'],
								'height'     => $atts['img_height'],
								'crop'       => $atts['img_crop'],
								'size'       => $atts['img_size'],
							) );

							// Overlay title
							if ( 'true' == $atts['title_overlay']
								&& 'true' == $atts['title']
								&& ! empty( $term->name )
							) :

								$output .= '<div class="vcex-terms-grid-entry-overlay wpex-clr">';

									$output .= '<div class="vcex-terms-grid-entry-overlay-table wpex-clr">';

										$output .= '<div class="vcex-terms-grid-entry-overlay-cell wpex-clr">';

											$output .= '<'. esc_attr( $title_tag ) .' class="vcex-terms-grid-entry-title entry-title"'. $title_style .'>';
												$output .= '<span>'. esc_html( $term->name ) .'</span>';

												if ( 'true' == $atts['term_count'] ) {

													$output .= '<span class="vcex-terms-grid-entry-count">('. $term->count .')</span>';

												}

											$output .= '</'. esc_attr( $title_tag ) .'>';

										$output .= '</div>';

									$output .= '</div>';

								$output .= '</div>';

							endif;

						$output .= '</a>';
					$output .= '</div>';

				endif; // End img ID check

			endif; // End image check

			// Inline title and description
			if ( 'false' == $atts['title_overlay'] || 'false' == $atts['img'] ) :

				// Show title
				if ( 'false' == $atts['title_overlay'] && 'true' == $atts['title'] && ! empty( $term->name ) ) :

					$output .= '<'. esc_attr( $title_tag ) .' class="vcex-terms-grid-entry-title entry-title"'. $title_style .'>';

						$output .= '<a href="'. get_term_link( $term, $taxonomy ) .'" title="'. esc_attr( $term->name ) .'">';

							$output .= esc_html( $term->name );

							if ( 'true' == $atts['term_count'] ) {

								$output .= ' <span class="vcex-terms-grid-entry-count">('. $term->count .')</span>';

							}

						$output .= '</a>';

					$output .= '</'. esc_attr( $title_tag ) .'>';

				endif;

				// Display term description
				if ( 'true' == $atts['description'] && ! empty( $term->description ) ) :

					$output .= '<div class="vcex-terms-grid-entry-excerpt clr"'. $description_style .'>';

						$output .= wp_kses_post( $term->description );

					$output .= '</div>';

				endif;

			endif;

		$output .= '</div>';

		// Close entry
		if ( $atts['entry_css'] && $entry_css_class ) {

			$output .= '</div>';

		}

	endforeach;

$output .= '</div>';

// Output shortcode HTML
echo $output;