<?php
/**
 * Visual Composer Testimonials Grid
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

// Deprecated Attributes
if ( ! empty( $atts['term_slug'] ) && empty( $atts['include_categories'] ) ) {
	$atts['include_categories'] = $atts['term_slug'];
}

// Get and extract shortcode attributes
$atts = vc_map_get_attributes( 'vcex_testimonials_grid', $atts );
extract( $atts );

// Define user-generated attributes
$atts['post_type'] = 'testimonials';
$atts['taxonomy']  = 'testimonials_category';
$atts['tax_query'] = '';

// Build the WordPress query
$wpex_query = vcex_build_wp_query( $atts );

// Output posts
if ( $wpex_query->have_posts() ) :

	// IMPORTANT: Fallback required from VC update when params are defined as empty
	// AKA - set things to enabled by default
	$entry_media = ( ! $entry_media ) ? 'true' : $entry_media;
	$title       = ( ! $title ) ? 'true' : $title;
	$excerpt     = ( ! $excerpt ) ? 'true' : $excerpt;
	$read_more   = ( ! $read_more ) ? 'true' : $read_more;

	// Declare and sanitize vars
	$inline_js     = array();
	$wrap_classes  = array( 'vcex-testimonials-grid-wrap', 'clr' );
	$grid_classes  = array( 'wpex-row', 'vcex-testimonials-grid', 'clr' );
	$grid_data     = array();
	$css_animation = $css_animation ? vcex_get_css_animation( $css_animation ) : '';
	$css_animation = ( 'true' == $filter ) ? false : $css_animation;
	$title_tag     = $title_tag ? $title_tag : 'div';

	// Is Isotope var
	if ( 'true' == $filter || 'masonry' == $grid_style ) {
		$is_isotope = true;
	} else {
		$is_isotope = false;
	}

	// No need for masonry if not enough columns and filter is disabled
	if ( 'true' != $filter && 'masonry' == $grid_style ) {
		$post_count = count( $wpex_query->posts );
		if ( $post_count <= $columns ) {
			$is_isotope = false;
		}
	}

	// Get filter taxonomy
	if ( 'true' == $filter ) {
		$filter_taxonomy = apply_filters( 'vcex_filter_taxonomy', $atts['taxonomy'], $atts );
		$filter_taxonomy = taxonomy_exists( $filter_taxonomy ) ? $filter_taxonomy : '';
		if ( $filter_taxonomy ) {
			$atts['filter_taxonomy'] = $filter_taxonomy; // Add to array to pass on to vcex_grid_filter_args()
		}
	} else {
		$filter_taxonomy = null;
	}

	// Get filter categories
	if ( $filter_taxonomy ) {

		// Get filter terms
		$filter_terms = get_terms( $filter_taxonomy, vcex_grid_filter_args( $atts, $wpex_query ) );

		// Make sure we have terms before doing things
		if ( $filter_terms ) {

			// Get term ids
			$filter_terms_ids = wp_list_pluck( $filter_terms, 'term_id' );

			// Check url for filter cat
			$filter_url_param = vcex_grid_filter_url_param();
			if ( isset( $_GET[$filter_url_param] ) ) {
				$filter_active_category = esc_html( $_GET[$filter_url_param] );
				if ( ! is_numeric( $filter_active_category ) ) {
					$get_term = get_term_by( 'name', $filter_active_category, $filter_taxonomy );
					if ( $get_term ) {
						$filter_active_category = $get_term->term_id;
					}
				}
			}

			// Check if filter active cat exists on current page
			$filter_has_active_cat = in_array( $filter_active_category, $filter_terms_ids ) ? true : false;

			// Add show on load animation when active filter is enabled to prevent double animation
			if ( $filter_has_active_cat ) {
				$grid_classes[] = 'wpex-show-on-load';
			}

		} else {

			$filter = false; // No terms so we can't have a filter

		}

	}

	// Output script for inline JS for the Visual composer front-end builder
	if ( $is_isotope ) {
		$inline_js[] = 'isotope';
	}

	// Image Style
	$img_style = vcex_inline_style( array(
		'border_radius' => $img_border_radius,
	), false );

	// Image classes
	$img_classes = '';
	if ( $img_width || $img_height || 'wpex_custom' != $img_size ) {
		$img_classes = 'remove-dims';
	}

	// Wrap classes
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}
	if ( $classes ) {
		$wrap_classes[] = vcex_get_extra_class( $classes );
	}

	// Grid Classes
	if ( $columns_gap ) {
		$grid_classes[] = 'gap-'. $columns_gap;
	}
	if ( $is_isotope ) {
		$grid_classes[] = 'vcex-isotope-grid';
	}

	// Data
	if ( $is_isotope && 'true' == $filter ) {
		if ( 'no_margins' != $grid_style && $masonry_layout_mode ) {
			$grid_data[] = 'data-layout-mode="'. $masonry_layout_mode .'"';
		}
		if ( $filter_speed ) {
			$grid_data[] = 'data-transition-duration="'. $filter_speed .'"';
		}
		if ( ! empty( $filter_has_active_cat ) ) {
			$grid_data[] = 'data-filter=".cat-'. $filter_active_category .'"';
		}
	}

	// Load inline js
	if ( $inline_js ) {
		vcex_inline_js( $inline_js );
	}

	// Load Google fonts if needed
	if ( $title_font_family ) {
		wpex_enqueue_google_font( $title_font_family );
	}

	// Title style
	$title_style = '';
	if ( 'true' == $title ) {
		$title_style = vcex_inline_style( array(
			'font_size'     => $title_font_size,
			'font_family'   => $title_font_family,
			'color'         => $title_color,
			'margin_bottom' => $title_bottom_margin,
		) );
	}

	// Excerpt style
	$content_style = vcex_inline_style( array(
		'font_size' => $content_font_size,
		'color'     => $content_color,
	) );

	// Apply filters
	$wrap_classes  = apply_filters( 'vcex_testimonials_grid_wrap_classes', $wrap_classes );
	$grid_classes  = apply_filters( 'vcex_testimonials_grid_classes', $grid_classes );
	$grid_data     = apply_filters( 'vcex_testimonials_grid_data_attr', $grid_data );

	// Convert arrays into strings
	$wrap_classes  = implode( ' ', $wrap_classes );
	$grid_classes  = implode( ' ', $grid_classes );
	$grid_data     = $grid_data ? ' '. implode( ' ', $grid_data ) : '';

	// Begin shortcode output
	$output .= '<div class="'. $wrap_classes .'"'. vcex_get_unique_id( $unique_id ) .'>';
	
		// Display filter links
		if ( 'true' == $filter && ! empty( $filter_terms ) ) {

			// Sanitize all text
			$all_text = $all_text ? $all_text : esc_html__( 'All', 'total' );

			// Filter button classes
			$filter_button_classes = wpex_get_button_classes( $filter_button_style, $filter_button_color );

			// Filter font size
			$filter_style = vcex_inline_style( array(
				'font_size' => $filter_font_size,
			) );

			$filter_classes = 'vcex-testimonials-filter vcex-filter-links clr';
			if ( 'yes' == $center_filter ) {
				$filter_classes .= ' center';
			}

			$output .= '<ul class="'. $filter_classes .'"'. $filter_style .'>';
				
				if ( 'true' == $filter_all_link ) {

					$output .= '<li';
						if ( ! $filter_has_active_cat ) {
							$output .= ' class="active"';
						}
					$output .= '>';

						$output .= '<a href="#" data-filter="*" class="'. $filter_button_classes .'"><span>'. $all_text .'</span></a>';

					$output .= '</li>';

				}

				foreach ( $filter_terms as $term ) :

					$output .= '<li class="filter-cat-'. $term->term_id;
						if ( $filter_active_category == $term->term_id ) {
							$output .= ' active';
						}
					$output .= '">';

					$output .= '<a href="#" data-filter=".cat-'. $term->term_id .'" class="'. $filter_button_classes .'">';
						$output .= $term->name;
					$output .= '</a></li>';

				endforeach;

				if ( $vcex_after_grid_filter = apply_filters( 'vcex_after_grid_filter', '', $atts ) ) { 
					$output .= $vcex_after_grid_filter;
				}

			$output .= '</ul>';

		}

		$output .= '<div class="'. $grid_classes .'"'. $grid_data .'>';

			// Define counter var to clear floats
			$count = 0;

			// Start loop
			while ( $wpex_query->have_posts() ) :

				// Get post from query
				$wpex_query->the_post();

				// Add to the counter var
				$count++;

				// Get post data
				$atts['post_id']           = get_the_ID();
				$atts['post_title']        = get_the_title();
				$atts['post_meta_author']  = get_post_meta( $atts['post_id'], 'wpex_testimonial_author', true );
				$atts['post_meta_company'] = get_post_meta( $atts['post_id'], 'wpex_testimonial_company', true );
				$atts['post_meta_url']     = get_post_meta( $atts['post_id'], 'wpex_testimonial_url', true );

				// Add classes to the entries
				$entry_classes = array( 'testimonial-entry' );
				$entry_classes[] = 'span_1_of_'. $columns;
				$entry_classes[] = 'col-'. $count;
				if ( 'false' == $columns_responsive ) {
					$entry_classes[] = 'nr-col';
				} else {
					$entry_classes[] = 'col';
				}
				if ( $css_animation ) {
					$entry_classes[] = $css_animation;
				}
				if ( $is_isotope ) {
					$entry_classes[] = 'vcex-isotope-entry';
				}

				// Begin entry output
				$output .= '<div '. vcex_grid_get_post_class( $entry_classes, $atts['post_id'] ) .'>';

					$output .= '<div class="testimonial-entry-content clr">';

						$output .= '<span class="testimonial-caret"></span>';

						// Display title
						if ( 'true' == $title ) :

							$output .= '<'. esc_attr( $title_tag ) .' class="testimonial-entry-title entry-title"'. $title_style .'>';

								$output .= esc_html( $atts['post_title'] );

							$output .= '</'. esc_attr( $title_tag ) .'>';

						endif;

						$output .= '<div class="testimonial-entry-details clr"'. $content_style .'>';

							// Display excerpt if enabled (default dispays full content )
							if ( 'true' == $excerpt ) :

								// Custom readmore text
								if ( 'true' == $read_more ) :

									// Add arrow
									if ( 'false' != $read_more_rarr ) {

										$read_more_rarr_html = '<span>&rarr;</span>';

									} else {

										$read_more_rarr_html = '';

									}

									// Read more text
									if ( is_rtl() ) {
										$read_more_link = '...<a href="'. wpex_get_permalink() .'" title="'. esc_attr( $read_more_text ) .'">'. $read_more_text .'</a>';
									} else {
										$read_more_link = '...<a href="'. wpex_get_permalink() .'" title="'. esc_attr( $read_more_text ) .'">'. esc_html( $read_more_text ) . $read_more_rarr_html .'</a>';
									}

								else :

									$read_more_link = '...';

								endif;

								// Custom Excerpt function
								$output .= wpex_get_excerpt( array(
									'post_id' => $atts['post_id'],
									'length'  => intval( $excerpt_length ),
									'more'    => $read_more_link,
								) );

							// Display full post content
							else :

								$output .= apply_filters( 'the_content', get_the_content() );
							
							// End excerpt check
							endif;

						$output .= '</div>';

					$output .= '</div>';

					$output .= '<div class="testimonial-entry-bottom">';

						// Check if post thumbnail is defined
						if ( has_post_thumbnail( $atts['post_id'] ) && 'true' == $entry_media ) {

							$output .= '<div class="testimonial-entry-thumb">';

								// Display post thumbnail
								$output .= wpex_get_post_thumbnail( array(
									'attachment' => get_post_thumbnail_id( $atts['post_id'] ),
									'size'       => $img_size,
									'width'      => $img_width,
									'height'     => $img_height,
									'class'      => $img_classes,
									'style'      => $img_style,
									'crop'       => $img_crop,
								) );

							$output .= '</div>';

						}

						$output .= '<div class="testimonial-entry-meta">';

							// Display testimonial author
							if ( 'true' == $author && $atts['post_meta_author'] ) :

								$output .= '<span class="testimonial-entry-author entry-title">';

									$output .= esc_html( $atts['post_meta_author'] );

								$output .= '</span>';

							endif;

							// Display testimonial company
							if ( 'true' == $company && $atts['post_meta_company'] ) {

								// Display testimonial company with URL
								if ( $atts['post_meta_url'] ) {

									$output .= '<a href="'. esc_url( $atts['post_meta_url'] ) .'" class="testimonial-entry-company" title="'. $atts['post_meta_company'] .'" target="_blank">';
									
										$output .= esc_html( $atts['post_meta_company'] );

									$output .= '</a>';

								// Display testimonial company without URL since it's not defined
								} else {

									$output .= '<span class="testimonial-entry-company">';

										$output .= esc_html( $atts['post_meta_company'] );

									$output .= '</span>';

								}

							}

							// Display rating
							if ( 'true' == $rating && $atts['post_rating'] = gds_get_star_rating( '', $atts['post_id'] ) ) {

								$output .= '<div class="testimonial-entry-rating clr">'. $atts['post_rating'] .'</div>';

							}

						$output .= '</div>';

					$output .= '</div>';

				$output .= '</div>';

				// Reset post loop counter
				if ( $count == $columns ) {
					$count = '';
				}

			endwhile; // End loop

		$output .= '</div>';
		
		// Display pagination if enabled
		if ( 'true' == $pagination ) :

			$output .= wpex_pagination( $wpex_query, false );
		
		endif;

	$output .= '</div>';

	// Reset the post data to prevent conflicts with WP globals
	wp_reset_postdata();

	// Output shortcode
	echo $output;

// If no posts are found display message
else :

	// Display no posts found error if function exists
	echo vcex_no_posts_found_message( $atts );

// End post check
endif;