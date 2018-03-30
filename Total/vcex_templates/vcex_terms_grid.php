<?php
/**
 * Visual Composer Terms Grid
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

// Get shortcode attributes
$atts = vc_map_get_attributes( 'vcex_terms_grid', $atts );

// Taxonomy is required
if ( ! $atts['taxonomy'] ) {
	return;
}

// Sanitize data
$title_typo              = vcex_parse_typography_param( $atts['title_typo'] );
$title_font_family       = $atts['title_font_family'] ? $atts['title_font_family'] : $title_typo['font_family']; // Fallback
$atts['title_tag']       = ! empty( $title_typo['tag'] ) ? $title_typo['tag'] : 'h2';
$description_typo        = vcex_parse_typography_param( $atts['description_typo'] );
$description_font_family = $atts['description_font_family'] ? $atts['description_font_family'] : $description_typo['font_family']; // Fallback
$atts['exclude_terms']   = $atts['exclude_terms'] ? preg_split( '/\,[\s]*/', $atts['exclude_terms'] ) : array();

// Remove useless align
if ( isset( $title_typo['text_align'] ) && 'left' == $title_typo['text_align'] ) {
	unset( $title_typo['text_align'] );
}
if ( isset( $description_typo['text_align'] ) && 'left' == $description_typo['text_align'] ) {
	unset( $description_typo['text_align'] );
}

// Load Google Fonts if needed
if ( $atts['title_font_family'] ) {
	unset( $title_typo['font_family'] ); // Fallback
	wpex_enqueue_google_font( $atts['title_font_family'] );
}
if ( $atts['description_font_family'] ) {
	unset( $description_typo['font_family'] ); // Fallback
	wpex_enqueue_google_font( $atts['description_font_family'] );
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

// Get term thumbnails
$term_data = wpex_get_term_data();

// Define post type based on the taxonomy
$taxonomy  = get_taxonomy( $atts['taxonomy'] );
$post_type = $taxonomy->object_type[0];

// Grid classes
$grid_classes = array( 'vcex-terms-grid', 'wpex-row', 'clr' );
if ( 'masonry' == $atts['grid_style'] ) {
	$grid_classes[] = 'vcex-isotope-grid';
	vcex_inline_js( 'isotope' );
}
if ( $atts['columns_gap'] ) {
	$grid_classes[] = 'gap-'. $atts['columns_gap'];
}
if ( $atts['visibility'] ) {
	$grid_classes[] = $atts['visibility'];
}
if ( $atts['classes'] ) {
	$grid_classes[] = vcex_get_extra_class( $atts['classes'] );
}
$grid_classes = implode( ' ', $grid_classes );

// Entry classes
$entry_classes = array( 'vcex-terms-grid-entry', 'clr' );
if ( 'masonry' == $atts['grid_style'] ) {
	$entry_classes[] = 'vcex-isotope-entry';
}
$entry_classes[] = 'span_1_of_'. $atts['columns'];
if ( 'false' == $atts['columns_responsive'] ) {
	$entry_classes[] = 'nr-col';
} else {
	$entry_classes[] = 'col';
} 
if ( $atts['css_animation'] ) {
	$entry_classes[] = vcex_get_css_animation( $atts['css_animation'] );
}
$entry_classes = implode( ' ', $entry_classes );

// Entry CSS wrapper
if ( $atts['entry_css'] ) {
	$entry_css_class = vc_shortcode_custom_css_class( $atts['entry_css'] );
} else {
	$entry_css_class = '';
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
$output .= '<div class="'. esc_attr( $grid_classes ) .'">';
		
	// Start counter
	$counter = 0;

	// Loop through terms
	foreach( $terms as $term ) :

		// Excluded
		if ( in_array( $term->slug, $atts['exclude_terms'] ) ) {
			continue;
		}

		// Add to counter
		$counter++;

		$output .= '<div class="'. esc_attr( $entry_classes ) .' term-'. $term->term_id . $term->slug .' col-'. $counter .'">';

			if ( $entry_css_class ) {
				$output .= '<div class="'. $entry_css_class .'">';
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
						$wpex_query = new WP_Query( array(
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
						if ( $wpex_query->have_posts() ) {

							while ( $wpex_query->have_posts() ) : $wpex_query->the_post();

								$img_id = get_post_thumbnail_id();

							endwhile;

						}

						// Reset query
						wp_reset_postdata();

					endif;

					if ( $img_id ) :

						$output .= '<div class="'. $media_classes .'">';

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
								if ( 'true' == $atts['title_overlay'] && 'true' == $atts['title'] && ! empty( $term->name ) ) :
									$output .= '<div class="vcex-terms-grid-entry-overlay wpex-clr">';
										$output .= '<div class="vcex-terms-grid-entry-overlay-table wpex-clr">';
											$output .= '<div class="vcex-terms-grid-entry-overlay-cell wpex-clr">';
												$output .= '<'. esc_attr( $atts['title_tag'] ) .' class="vcex-terms-grid-entry-title entry-title"'. $title_style .'>';
													$output .= '<span>'. esc_html( $term->name ) .'</span>';
													if ( 'true' == $atts['term_count'] ) {
														$output .= '<span class="vcex-terms-grid-entry-count">('. $term->count .')</span>';
													}
												$output .= '</'. esc_attr( $atts['title_tag'] ) .'>';
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

						$output .= '<'. esc_attr( $atts['title_tag'] ) .' class="vcex-terms-grid-entry-title entry-title"'. $title_style .'>';
							
							$output .= '<a href="'. get_term_link( $term, $taxonomy ) .'" title="'. esc_attr( $term->name ) .'">';
								
								$output .= esc_html( $term->name );
								
								if ( 'true' == $atts['term_count'] ) {
									$output .= ' <span class="vcex-terms-grid-entry-count">('. $term->count .')</span>';
								}
							
							$output .= '</a>';
						$output .= '</'. esc_attr( $atts['title_tag'] ) .'>';

					endif;

					// Display term description
					if ( 'true' == $atts['description'] && $term->description ) :

						$output .= '<div class="vcex-terms-grid-entry-excerpt clr"'. $description_style .'>';

							$output .= wp_kses_post( $term->description );

						$output .= '</div>';

					endif;

				endif;

			$output .= '</div>';

		// Close entry
		if ( $entry_css_class ) {
			$output .= '</div>';
		}

		// Clear counter
		if ( $counter == $atts['columns'] ) {
			$counter = 0;
		}

	endforeach;

$output .= '</div>';

echo $output;