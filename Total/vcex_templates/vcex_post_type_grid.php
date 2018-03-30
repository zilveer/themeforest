<?php
/**
 * Visual Composer Post Type Grid
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

// Get and extract shortcode attributes
$atts = vc_map_get_attributes( 'vcex_post_type_grid', $atts );
extract( $atts );

// Build the WordPress query
$wpex_query = vcex_build_wp_query( $atts );

// Output posts
if ( $wpex_query->have_posts() ) :

	// IMPORTANT: Fallback required from VC update when params are defined as empty
	// AKA - set things to enabled by default
	$entry_media = ( ! $entry_media ) ? 'true' : $entry_media;
	$title       = ( ! $title ) ? 'true' : $title;
	$date        = ( ! $date ) ? 'true' : $date;
	$excerpt     = ( ! $excerpt ) ? 'true' : $excerpt;
	$read_more   = ( ! $read_more ) ? 'true' : $read_more;

	// Declare and sanitize variables
	$wrap_classes       = array( 'vcex-post-type-grid-wrap', 'wpex-clr' );
	$grid_classes       = array( 'wpex-row', 'vcex-post-type-grid', 'entries', 'wpex-clr' );
	$grid_data          = array();
	$inline_js          = array();
	$is_isotope         = false;
	$url_target         = vcex_html( 'target_attr', $url_target );
	$equal_heights_grid = ( 'true' == $equal_heights_grid && $columns > '1' ) ? true : false;
	$css_animation      = vcex_get_css_animation( $css_animation );
	$css_animation      = 'true' == $filter ? false : $css_animation;
	$title_tag          = apply_filters( 'vcex_grid_default_title_tag', $title_tag, $atts );
	$title_tag          = $title_tag ? $title_tag : 'h2';

	// Advanced sanitization
	if ( 'true' == $filter || 'masonry' == $grid_style || 'no_margins' == $grid_style ) {
		$is_isotope = true;
	}
	if ( 'true' != $filter && 'masonry' == $grid_style ) {
		$post_count = count( $wpex_query->posts );
		if ( $post_count <= $columns ) {
			$is_isotope = false;
		}
	}

	// Check url for filter cat
	$filter_url_param = vcex_grid_filter_url_param();
	if ( isset( $_GET[$filter_url_param] ) ) {
		if ( 'post_types' == $filter_type ) {
			$filter_active_category = 'post-type-'. $_GET[$filter_url_param];
		}
		// Add show on load animation when active filter is enabled to prevent double animation
		$grid_classes[] = 'wpex-show-on-load';
	} else {
		$filter_active_category = false;
	}

	// Load lightbox scripts
	if ( 'lightbox' == $thumb_link ) {
		wpex_enqueue_ilightbox_skin();
	}

	// Turn post types into array
	$post_types = $post_types ? $post_types : 'post';
	$post_types = explode( ',', $post_types );

	// Add inline JS
	if ( $equal_heights_grid ) {
		$inline_js[] = 'equal_heights';
	}
	if ( $is_isotope ) {
		$inline_js[] = 'isotope';
	}
	if ( $readmore_hover_color || $readmore_hover_background ) {
		$inline_js[] = 'data_hover';
	}
	vcex_inline_js( $inline_js );

	// Wrap classes
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}
	if ( $classes ) {
		$wrap_classes[] = vcex_get_extra_class( $classes );
	}

	// Grid classes
	if ( $columns_gap ) {
		$grid_classes[] = 'gap-'. $columns_gap;
	}
	if ( 'left_thumbs' == $single_column_style ) {
		$grid_classes[] = 'left-thumbs';
	}
	if ( $is_isotope ) {
		$grid_classes[] = 'vcex-isotope-grid';
	}
	if ( 'no_margins' == $grid_style ) {
		$grid_classes[] = 'vcex-no-margin-grid';
	}
	if ( $equal_heights_grid ) {
		$grid_classes[] = 'match-height-grid';
	}

	// Entry CSS class
	if ( $entry_css ) {
		$entry_css = vc_shortcode_custom_css_class( $entry_css );
	}

	// Content Design
	$content_style = array(
		'color'      => $content_color,
		'opacity'    => $content_opacity,
		'text_align' => $content_alignment,
	);
	if ( ! $content_css ) {
		if ( isset( $content_background ) ) {
			$content_style['background'] = $content_background;
		}
		if ( isset( $content_padding ) ) {
			$content_style['padding'] = $content_padding;
		}
		if ( isset( $content_margin ) ) {
			$content_style['margin'] = $content_margin;
		}
		if ( isset( $content_border ) ) {
			$content_style['border'] = $content_border;
		}
	} else {
		$content_css = vc_shortcode_custom_css_class( $content_css );
	}
	$content_style = vcex_inline_style( $content_style );

	// Categories style
	if ( 'true' == $show_categories ) {
		$categories_style = vcex_inline_style( array(
			'margin'    => $categories_margin,
			'font_size' => $categories_font_size,
			'color'     => $categories_color,
		) );
		$categories_classes = 'vcex-post-type-entry-categories entry-categories wpex-clr';
		if ( $categories_color ) {
			$categories_classes .= ' wpex-child-inherit-color';
		}
	}

	// Excerpt Design
	if ( 'true' == $excerpt ) {
		$excerpt_style = vcex_inline_style( array(
			'font_size' => $content_font_size,
			'color'     => $content_color,
		) );
	}

	// Heading Design
	if ( 'true' == $title ) {
		$heading_style = vcex_inline_style( array(
			'margin'         => $content_heading_margin,
			'font_size'      => $content_heading_size,
			'color'          => $content_heading_color,
			'line_height'    => $content_heading_line_height,
			'text_transform' => $content_heading_transform,
			'font_weight'    => $content_heading_weight,
		) );
		$heading_link_style = vcex_inline_style( array(
			'color' => $content_heading_color,
		) );
	}

	// Readmore design and classes
	if ( 'true' == $read_more ) {

		// Read more text
		$read_more_text = $read_more_text ? $read_more_text : esc_html__( 'read more', 'total' );

		// Readmore classes
		$readmore_classes = wpex_get_button_classes( $readmore_style, $readmore_style_color );
		if ( $readmore_hover_color || $readmore_hover_background ) {
			$readmore_classes .= ' wpex-data-hover';
		}

		// Readmore style
		$readmore_style = vcex_inline_style( array(
			'background'    => $readmore_background,
			'color'         => $readmore_color,
			'font_size'     => $readmore_size,
			'padding'       => $readmore_padding,
			'border_radius' => $readmore_border_radius,
			'margin'        => $readmore_margin,
		) );

		// Readmore data
		$readmore_data = array();
		if ( $readmore_hover_color ) {
			$readmore_data[] = 'data-hover-color="'. $readmore_hover_color .'"';
		}
		if ( $readmore_hover_background ) {
			$readmore_data[] = 'data-hover-background="'. $readmore_hover_background .'"';
		}
		$readmore_data = ' '. implode( ' ', $readmore_data );

	}

	// Date design
	if ( 'true' == $date ) {
		$date_style = vcex_inline_style( array(
			'color'     => $date_color,
			'font_size' => $date_font_size,
		) );
	}

	// Data
	if ( 'true' == $filter ) {
		if ( 'fitRows' == $masonry_layout_mode ) {
			$grid_data[] = 'data-layout-mode="fitRows"';
		}
		if ( $filter_speed ) {
			$grid_data[] = 'data-transition-duration="'. $filter_speed .'"';
		}
		if ( $filter_active_category ) {
			$grid_data[] = 'data-filter=".'. $filter_active_category .'"';
		}
	} else {
		$grid_data[] = 'data-transition-duration="0.0"';
	}

	// Static entry classes
	$static_entry_classes = array( 'vcex-post-type-entry', 'clr' );
	if ( 'false' == $columns_responsive ) {
		$static_entry_classes[] = 'nr-col';
	} else {
		$static_entry_classes[] = 'col';
	}
	$static_entry_classes[] = 'span_1_of_'. $columns;
	if ( $is_isotope ) {
		$static_entry_classes[] = 'vcex-isotope-entry';
	}
	if ( 'no_margins' == $grid_style ) {
		$static_entry_classes[] = 'vcex-no-margin-entry';
	}
	if ( $css_animation ) {
		$static_entry_classes[] = $css_animation;
	}
	if ( 'true' != $entry_media ) {
		$static_entry_classes[] = 'vcex-post-type-no-media-entry';
	}

	// Entry media classes
	$media_classes = array( 'vcex-post-type-entry-media', 'entry-media', 'wpex-clr' );
	if ( 'true' == $entry_media ) {
		if ( $img_filter ) {
			$media_classes[] = wpex_image_filter_class( $img_filter );
		}
		if ( $img_hover_style ) {
			$media_classes[] = wpex_image_hover_classes( $img_hover_style );
		}
		if ( $overlay_style ) {
			$media_classes[] = wpex_overlay_classes( $overlay_style );
		}
	}

	// Apply filters
	$wrap_classes  = apply_filters( 'vcex_post_type_grid_wrap_classes', $wrap_classes );
	$grid_classes  = apply_filters( 'vcex_post_type_grid_classes', $grid_classes );
	$grid_data     = apply_filters( 'vcex_post_type_grid_data_attr', $grid_data );

	// Convert arrays into strings
	$wrap_classes  = implode( ' ', $wrap_classes );
	$grid_classes  = implode( ' ', $grid_classes );
	$grid_data     = $grid_data ? ' '. implode( ' ', $grid_data ) : '';
	$media_classes = implode( ' ', $media_classes );

	// Start output
	$output .= '<div class="'. $wrap_classes .'"'. vcex_get_unique_id( $unique_id ) .'>';

		// Display filter links
		if ( 'true' == $filter ) :

			// Make sure the filter should display
			if ( count( $post_types ) > 1 || 'taxonomy' == $filter_type ) {

				// Filter button classes
				$filter_button_classes = wpex_get_button_classes( $filter_button_style, $filter_button_color );

				// Filter font size
				$filter_style = vcex_inline_style( array(
					'font_size' => $filter_font_size,
				) );

				$filter_classes = 'vcex-post-type-filter vcex-filter-links vcex-clr';
				if ( 'yes' == $center_filter ) {
					$filter_classes .= ' center';
				}

				$output .= '<ul class="'. $filter_classes .'"'. $filter_style .'>';

					// Sanitize all text
					$all_text = $all_text ? $all_text : esc_html__( 'All', 'total' );

					$output .= '<li';
						if ( ! $filter_active_category ) {
							$output .= ' class="active"';
						}
					$output .= '>';

						$output .= '<a href="#" data-filter="*" class="'. $filter_button_classes .'"><span>'. $all_text .'</span></a>';

					$output .= '</li>';

					// Taxonomy style filter
					if ( 'taxonomy' == $filter_type ) :

						// If taxonony exists get terms
						if ( taxonomy_exists( $filter_taxonomy ) ) :

							// Get filter args
							$atts['filter_taxonomy'] = $filter_taxonomy;
							$args = vcex_grid_filter_args( $atts, $wpex_query );
							$terms = get_terms( $filter_taxonomy, $args );

							// Display filter
							if ( ! empty( $terms ) ) :

								foreach ( $terms as $term ) :

									$output .= '<li class="filter-cat-'. $term->term_id .'">';
										$output .= '<a href="#" data-filter=".cat-'. $term->term_id .'" class="'. $filter_button_classes .'">';
											$output .= $term->name;
										$output .= '</a>';
									$output .= '</li>';

								endforeach;

							endif; // Terms check

						endif; // Taxonomy exists check

					// Post types filter
					else :

						// Get array of post types in loop so we don't display empty results
						$active_types = array();
						$post_ids = wp_list_pluck( $wpex_query->posts, 'ID' );
						foreach ( $post_ids as $post_id ) {
							$type = get_post_type( $post_id );
							$active_types[$type] = $type;
						}

						// Loop through active types
						foreach ( $active_types as $type ) :
							
							// Get type object
							$obj = get_post_type_object( $type );

							$output .= '<li class="vcex-filter-link-'. $type;
								if ( $filter_active_category == 'post-type-'. $type ) {
									$output .= ' active';
								}
							$output .= '">';

							$output .= '<a href="#" data-filter=".type-'. $type .'" class="'. $filter_button_classes .'">';
								$output .= $obj->labels->name;
							$output .= '</a></li>';

						endforeach;

					endif;

				$output .= '</ul>';

				if ( $vcex_after_grid_filter = apply_filters( 'vcex_after_grid_filter', '', $atts ) ) { 
					$output .= $vcex_after_grid_filter;
				}

			}

		endif; // End filter

		$output .= '<div class="'. $grid_classes .'"'. $grid_data .'>';

			// Define counter var to clear floats
			$count='';

			// Loop through posts
			while ( $wpex_query->have_posts() ) :

				// Get post from query
				$wpex_query->the_post();

				// Add to counter var
				$count++;

				// Post Data
				$atts['post_id']        = get_the_ID();
				$atts['post_type']      = get_post_type( $atts['post_id'] );
				$atts['post_title']     = get_the_title();
				$atts['post_esc_title'] = wpex_get_esc_title();
				$atts['post_permalink'] = wpex_get_permalink( $atts['post_id'] );
				$atts['post_format']    = get_post_format( $atts['post_id'] );
				$atts['post_excerpt']   = '';
				$atts['post_thumbnail'] = wp_get_attachment_url( get_post_thumbnail_id() );
				$atts['post_video']     = wpex_get_post_video_html();

				// Entry Classes
				$entry_classes   = array();
				$entry_classes[] = 'col-'. $count;
				$entry_classes = array_merge( $static_entry_classes, $entry_classes );

				// Define entry link and entry link classes
				$entry_link = $atts['post_permalink'];
				if ( $thumb_link == 'lightbox' ) {
					//$entry_link         = $atts['post_video'] ? $atts['post_video'] : $atts['post_thumbnail'];
					//$entry_link_classes = $atts['post_video'] ? 'wpex-lightbox-video' : 'wpex-lightbox';
					$entry_link            = wpex_get_lightbox_image();
					$entry_link_classes    = 'wpex-lightbox';
					$atts['lightbox_link'] = $entry_link;
				}
				$entry_link_classes = ! empty( $entry_link_classes ) ? ' class="'. $entry_link_classes .'"' : '';

				// Entry image output HTMl
				if ( $atts['post_thumbnail'] ) {
					$entry_image = wpex_get_post_thumbnail( array(
						'size'   => $img_size,
						'crop'   => $img_crop,
						'width'  => $img_width,
						'height' => $img_height,
						'alt'   => $atts['post_esc_title'],
					) );
				}

				// Apply filters to attributes
				$latts = apply_filters( 'vcex_shortcode_loop_atts', $atts );

				// Begin entry output
				$output .= '<div '. vcex_grid_get_post_class( $entry_classes, $atts['post_id'] ) .'>';

					$classes = 'vcex-post-type-entry-inner entry-inner vcex-clr';
					if ( $entry_css ) {
						$classes .= ' '. $entry_css;
					}

					$output .= '<div class="'. $classes .'">';

						// Display media
						if ( 'true' == $entry_media ) :

							// Display video
							if ( 'true' == $featured_video && $latts['post_video'] ) :

								$output .= '<div class="vcex-post-type-entry-media entry-media vcex-clr">';

									$output .= '<div class="vcex-video-wrap">';

										$output .= $latts['post_video'];

									$output .= '</div>';

								$output .= '</div>';

							// Display featured image
							elseif ( $latts['post_thumbnail'] ) :

								$output .= '<div class="'. $media_classes .'">';

									// Image with link
									if ( $thumb_link == 'post' || $thumb_link == 'lightbox' ) :

										$output .= '<a href="'. $entry_link .'" title="'. $latts['post_esc_title'] .'"'. $url_target .''. $entry_link_classes .'>';

											$output .= $entry_image;

											if ( $overlay_style && 'none' != $overlay_style ) {
												ob_start();
												wpex_overlay( 'inside_link', $overlay_style, $latts );
												$output .= ob_get_clean();
											}

										$output .= '</a>';

									// Just the image
									else :

										// Display image
										$output .= $entry_image;

										// Inside overlay
										if ( $overlay_style && 'none' != $overlay_style ) {
											ob_start();
											wpex_overlay( 'inside_link', $overlay_style, $latts );
											$output .= ob_get_clean();
										}

									endif;

									// Outside link overlay
									if ( $overlay_style && 'none' != $overlay_style ) {
										ob_start();
										wpex_overlay( 'outside_link', $overlay_style, $latts );
										$output .= ob_get_clean();
									}

								$output .= '</div>';

							endif;

						endif;

						// Display entry details (title, categories, excerpt, button )
						if ( 'true' == $title
							|| 'true' == $show_categories
							|| 'true' == $excerpt
							|| 'true' == $read_more
						) :

							$classes = 'vcex-post-type-entry-details entry-details wpex-clr';
							if ( $content_css ) {
								$classes .= ' '. $content_css;
							}

							$output .= '<div class="'. $classes .'"'. $content_style .'>';

								// Open equal heights wrapper
								if ( $equal_heights_grid ) :
									$output .= '<div class="match-height-content">';
								endif;

								// Display title
								if ( 'true' == $title ) :

									$output .= '<'. $title_tag .' class="vcex-post-type-entry-title entry-title" '. $heading_style .'>';
										$output .= '<a href="'. $latts['post_permalink'] .'" title="'. $latts['post_esc_title'] .'"'. $url_target .''. $heading_link_style .'>';
											$output .= $latts['post_title'];
										$output .= '</a>';
									$output .= '</'. $title_tag .' >';

								endif;

								// Display date
								if ( 'true' == $date ) :

									$output .= '<div class="vcex-post-type-entry-date"'. $date_style .'>';

										// Get Tribe Events date
										if ( 'tribe_events' == $latts['post_type']
											&& function_exists( 'wpex_get_tribe_event_date' )
										) {
											$instance = $unique_id ? $unique_id : 'vcex_post_type_grid';
											$latts['post_date'] = wpex_get_tribe_event_date( $instance );

										// Get standard date
										} else {
											$latts['post_date'] = get_the_date();
										}

										// Output date
										$output .= $latts['post_date'];

									$output .= '</div>';

								endif;

								// Display categories
								if ( 'true' == $show_categories && taxonomy_exists( $categories_taxonomy ) ) :

									$output .= '<div class="'. $categories_classes .'"'. $categories_style .'>';
										// Display categories
										if ( 'true' == $show_first_category_only ) {
											$output .= wpex_get_first_term_link( $latts['post_id'], $categories_taxonomy );
										} else {
											$output .= wpex_get_list_post_terms( $categories_taxonomy, true, true );
										}
									$output .= '</div>';

								endif;

								// Display excerpt
								if ( 'true' == $excerpt ) :

									$output .= '<div class="vcex-post-type-entry-excerpt clr"'. $excerpt_style .'>';

										// Display Excerpt
										$output .= wpex_get_excerpt( array (
											'length' => intval( $excerpt_length ),
										) );

									$output .= '</div>';

								endif;

								// Display read more button
								if ( 'true' == $read_more ) :

									$output .= '<div class="vcex-post-type-entry-readmore-wrap clr">';

										$output .= '<a href="'. $latts['post_permalink'] .'" title="'. esc_attr( $read_more_text ) .'" rel="bookmark" class="'. $readmore_classes .'"'. $url_target .''. $readmore_style .''. $readmore_data .'>';
											$output .= $read_more_text;
											if ( 'true' == $readmore_rarr ) :
												$output .= '<span class="vcex-readmore-rarr">'. wpex_element( 'rarr' ) .'</span>';
											endif;
										$output .= '</a>';

									$output .= '</div>';

								endif;

								// Close equal heights wrap
								if ( $equal_heights_grid ) :
									$output .= '</div>';
								endif;

							$output .= '</div>';

						endif;

					$output .= '</div>';

				$output .= '</div>';

			// Reset count clear floats
			if ( $count == $columns ) {
				$count = '';
			}

			endwhile;

		$output .= '</div>';
		
		// Display pagination if enabled
		if ( 'true' == $pagination ) :

			$output .= wpex_pagination( $wpex_query, false );

		endif;

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