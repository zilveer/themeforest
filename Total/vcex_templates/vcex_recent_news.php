<?php
/**
 * Visual Composer Recent News
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.5.0
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
$term_slug = isset( $atts['term_slug'] ) ? $atts['term_slug'] : '';

// Get and extract shortcode attributes
$atts = vc_map_get_attributes( 'vcex_recent_news', $atts );

// Define non-vc attributes
$atts['tax_query']  = '';
$atts['taxonomies'] = 'category';

// Extract shortcode atts
extract( $atts );

// IMPORTANT: Fallback required from VC update when params are defined as empty
// AKA - set things to enabled by default
$title     = ( ! $title ) ? 'true' : $title;
$date      = ( ! $date ) ? 'true' : $date;
$excerpt   = ( ! $excerpt ) ? 'true' : $excerpt;
$read_more = ( ! $read_more ) ? 'true' : $read_more;

// Fallback for term slug
if ( ! empty( $term_slug ) && empty( $include_categories ) ) {
	$include_categories = $term_slug;
}

// Custom taxonomy only for standard posts
if ( 'custom_post_types' == $get_posts ) {
	$atts['include_categories'] = $atts['exclude_categories'] = '';
}

// Get Standard posts
if ( 'standard_post_types' == $get_posts ) {
	$atts['post_types'] = 'post';
}

// Build the WordPress query
$wpex_query = vcex_build_wp_query( $atts );

//Output posts
if ( $wpex_query->have_posts() ) :

	// Sanitize data + declare vars
	$inline_js = array();
	$grid_columns = $grid_columns ? $grid_columns : '1';
	
	// Wrap Classes
	$wrap_classes = array( 'vcex-recent-news', 'clr' );
	if ( $classes ) {
		$wrap_classes[] = vcex_get_extra_class( $classes );
	}
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}
	if ( '1' != $grid_columns ) {
		$wrap_classes[] = 'wpex-row';
		if ( $columns_gap ) {
			$wrap_classes[] = 'gap-'. $columns_gap;
		}
	}
	if ( $css ) {
		$wrap_classes[] = vc_shortcode_custom_css_class( $css );
	}

	// Entry Classes
	$entry_classes = array( 'vcex-recent-news-entry', 'clr' );
	if ( 'true' != $date ) {
		$entry_classes[] = 'no-left-padding';
	}
	if ( $css_animation ) {
		$entry_classes[] = vcex_get_css_animation( $css_animation );
	}

	// Entry Style
	$entry_style = vcex_inline_style( array(
		'border_color' => $entry_bottom_border_color
	) );

	// Heading style
	if ( 'true' == $title ) {
		$heading_style = vcex_inline_style( array(
			'font_size'      => $title_size,
			'font_weight'    => $title_weight,
			'text_transform' => $title_transform,
			'line_height'    => $title_line_height,
			'margin'         => $title_margin,
			'color'          => $title_color,
		) );
	}

	// Excerpt style
	if ( 'true' == $excerpt ) {
		$excerpt_style = vcex_inline_style( array(
			'font_size' => $excerpt_font_size,
			'color' => $excerpt_color,
		) );
	}

	// Month Style
	if ( 'true' == $date ) {
		$month_style = vcex_inline_style( array(
			'background_color' => $month_background,
			'color' => $month_color,
		) );
	}

	// Readmore design and classes
	if ( 'true' == $read_more ) {

		// Readmore text
		$read_more_text = $read_more_text ? $read_more_text : esc_html__( 'read more', 'total' );

		// Readmore classes
		$readmore_classes = wpex_get_button_classes( $readmore_style, $readmore_style_color );
		if ( $readmore_hover_color || $readmore_hover_background ) {
			$readmore_classes .= ' wpex-data-hover';
		}

		// Read more style
		$readmore_border_color  = ( 'outline' == $readmore_style ) ? $readmore_color : '';
		$readmore_style = vcex_inline_style( array(
			'background' => $readmore_background,
			'color' => $readmore_color,
			'border_color' => $readmore_border_color,
			'font_size' => $readmore_size,
			'padding' => $readmore_padding,
			'border_radius' => $readmore_border_radius,
			'margin' => $readmore_margin,
		) );

		// Readmore data
		$readmore_data = '';
		if ( $readmore_hover_color ) {
			$readmore_data .= ' data-hover-color="'. $readmore_hover_color .'"';
		}
		if ( $readmore_hover_background ) {
			$readmore_data .= ' data-hover-background="'. $readmore_hover_background .'"';
		}
	}

	// Hover js
	if ( $readmore_hover_color || $readmore_hover_background ) {
		 $inline_js[] = 'data_hover';
	}

	// Load inline js
	if ( ! empty( $inline_js ) ) {
		vcex_inline_js( $inline_js );
	}

	// Convert arrays to strings
	$wrap_classes = implode( ' ', $wrap_classes );
	
	// Output module
	$output .= '<div class="'. $wrap_classes .'"'. vcex_get_unique_id( $unique_id ) .'>';
	
		// Display header if enabled
		if ( $header ) :

			$output .= wpex_heading( array(
				'echo'    => false,
				'content' => $header,
				'tag'     => 'h2',
				'classes' => array( 'vcex-recent-news-header' ),
			) );

		endif;

		// Loop through posts
		$count = '0';
		while ( $wpex_query->have_posts() ) :

			// Get post from query
			$wpex_query->the_post();

			// Add to counter
			$count++;

			// Create new post object.
			$post = new stdClass();
		
			// Post vars
			$post->ID            = get_the_ID();
			$post->permalink     = wpex_get_permalink( $post->ID );
			$post->the_title     = get_the_title( $post->ID );
			$post->the_title_esc = esc_attr( the_title_attribute( 'echo=0' ) );
			$post->type          = get_post_type( $post->ID );
			$post->video_embed   = wpex_get_post_video_html();
			$post->format        = get_post_format( $post->ID );

			// Open grid columns wrap
			if ( $grid_columns > '1' ) :

				$output .= '<div class="col span_1_of_'. $grid_columns .' vcex-recent-news-entry-wrap col-'. $count .'">';

			endif;

			$output .= '<article '. wpex_get_post_class( $entry_classes, $post->ID ) .''. $entry_style .'>';

				// Display date
				if ( 'true' == $date ) :

					$output .= '<div class="vcex-recent-news-date">';

						$output .= '<span class="day">';

							// Standard day display
							$day = get_the_time( 'd', $post->ID );

							// Filter day display for tribe events calendar plugin
							// @todo move to events config file
							if ( 'tribe_events' == $post->type && function_exists( 'tribe_get_start_date' ) ) {
								$day = tribe_get_start_date( $post->ID, false, 'd' );
							}

							// Apply filters and return date
							$output .= apply_filters( 'vcex_recent_news_day_output', $day );

						// Close day
						$output .= '</span>';

						$output .= '<span class="month"'. $month_style .'>';

							// Standard month year display
							$month_year = '<span>'. get_the_time( 'M', $post->ID ) .'</span>';
							$month_year .= ' <span class="year">'. get_the_time( 'y', $post->ID ) .'</span>';

							// Filter month/year display for tribe events calendar plugin
							// @todo move to events config file
							if ( 'tribe_events' == $post->type && function_exists( 'tribe_get_start_date' ) ) {
								$month_year = '<span>'. tribe_get_start_date( $post->ID, false, 'M' ) .'</span>';
								$month_year .= ' <span class="year">'. tribe_get_start_date( $post->ID, false, 'y' ) .'</span>';
							}

							// Echo the month/year
							$output .= apply_filters( 'vcex_recent_news_month_year_output', $month_year );

						// Close month
						$output .= '</span>';

					$output .= '</div>';

				endif;

				$output .= '<div class="vcex-news-entry-details clr">';

					// Show featured media if enabled
					if ( 'true' == $featured_image ) :

						// Display video
						if ( 'true' == $featured_video && $post->video_embed ) :

							$output .= '<div class="vcex-news-entry-video clr">'. $post->video_embed .'</div>';

						// Display featured image
						elseif ( has_post_thumbnail( $post->ID ) ) :

							$output .= '<div class="vcex-news-entry-thumbnail clr">';

								$output .= '<a href="'. $post->permalink .'" title="'. wpex_get_esc_title() .'">';

									// Display thumbnail
									$output .= wpex_get_post_thumbnail( array(
										'size'   => $img_size,
										'crop'   => $img_crop,
										'width'  => $img_width,
										'height' => $img_height,
										'alt'    => wpex_get_esc_title(),
									) );

								$output .= '</a>';

							$output .= '</div>';

						endif; // End thumbnail check

					endif; // End featured image check

					// Show title if enabled
					if ( 'true' == $title ) :

						$output .= '<header class="vcex-recent-news-entry-title entry-title">';
							$output .= '<'. $title_tag .' class="vcex-recent-news-entry-title-heading"'. $heading_style .'>';
								$output .= '<a href="'. $post->permalink .'" title="'. $post->the_title_esc .'">'. $post->the_title .'</a>';
							$output .= '</'. $title_tag .'>';
						$output .= '</header>';

					endif; // End title check

					// Excerpt and readmore
					if ( 'true' == $excerpt || 'true' == $read_more ) :

						$output .= '<div class="vcex-recent-news-entry-excerpt clr">';

							if ( 'true' == $excerpt ) :

								$output .= '<div class="entry"'. $excerpt_style .'>';

									// Output excerpt
									$output .= wpex_get_excerpt( array (
										'length' => $excerpt_length,
									) );

								$output .= '</div>';

							endif;

							// Display readmore link
							if ( 'true' == $read_more ) :

								$output .= '<a href="'. $post->permalink .'" title="'. esc_attr( $read_more_text ) .'" rel="bookmark" class="'. $readmore_classes .'"'. $readmore_style .''. $readmore_data .'>';

									$output .= $read_more_text;

									// Show readmore rarr
									if ( 'true' == $readmore_rarr ) {

										$output .= '<span class="vcex-readmore-rarr">'. wpex_element( 'rarr' ) .'</span>';

									}
								$output .= '</a>';

							endif;

						$output .= '</div>';

					endif; // End excerpt + readmore

				$output .= '</div>';

			$output .= '</article>';

			// Close grid columns wrap
			if ( $grid_columns > '1' ) {
				$output .= '</div>';
			}

			if ( $count == $grid_columns ) {
				$count = '';
			}

		endwhile;

		// Display pagination
		if ( 'true' == $pagination ) :
			$output .= '<div class="wpex-clear"></div>';
			$output .= wpex_pagination( $wpex_query, false );
		endif;
	
	$output .= '</div>';

	// Remove post object from memory
	$post = null;

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