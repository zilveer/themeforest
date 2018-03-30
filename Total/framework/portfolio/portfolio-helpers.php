<?php
/**
 * Useful global functions for the portfolio
 *
 * @package Total WordPress Theme
 * @subpackage Portfolio Functions
 * @version 3.3.2
 */

/**
 * Returns portfolio entry blocks
 *
 * @since 2.1.0
 */
function wpex_portfolio_entry_blocks() {

	// Get layout blocks
	$blocks = wpex_get_mod( 'portfolio_entry_composer' );

	// If blocks are 100% empty return defaults
	$blocks = $blocks ? $blocks : 'media,title,content,read_more';

	// Convert blocks to array so we can loop through them
	if ( ! is_array( $blocks ) ) {
		$blocks = explode( ',', $blocks );
	}

	// Apply filters and return blocks
	return apply_filters( 'wpex_portfolio_entry_blocks', $blocks );

}

/**
 * Returns portfolio post blocks
 *
 * @since 2.1.0
 */
function wpex_portfolio_post_blocks() {

	// Get layout blocks
	$blocks = wpex_get_mod( 'portfolio_post_composer' );

	// If blocks are empty return defaults - should never be empty!
	$blocks = $blocks ? $blocks : array( 'content', 'share', 'related' );

	// Convert blocks to array so we can loop through them
	if ( ! is_array( $blocks ) ) {
		$blocks = explode( ',', $blocks );
	}

	// Apply filters and return blocks
	return apply_filters( 'wpex_portfolio_single_blocks', $blocks );

}

/**
 * Returns portfolio single meta sections
 *
 * @since 2.0.0
 */
function wpex_portfolio_single_meta_sections() {

	// Default sections
	$sections = array( 'date', 'author', 'categories', 'comments' );

	// Apply filters for easy modification
	$sections = apply_filters( 'wpex_portfolio_single_meta_sections', $sections );

	// Turn into array if string
	if ( $sections && ! is_array( $sections ) ) {
		$sections = explode( ',', $sections );
	}

	// Return sections
	return $sections;

}

/**
 * Returns correct thumbnail HTML for the portfolio entries
 *
 * @since 2.0.0
 */
function wpex_get_portfolio_entry_thumbnail( $loop = 'archive' ) {
	$size = 'archive' === $loop ? 'portfolio_entry' : 'portfolio_related';
	return wpex_get_post_thumbnail( apply_filters( 'wpex_get_portfolio_entry_thumbnail_args', array(
		'size'  => $size,
		'class' => 'portfolio-entry-img',
		'alt'   => wpex_get_esc_title(),
	) ) );
}

/**
 * Returns correct thumbnail HTML for the portfolio posts
 *
 * @since 2.0.0
 */
function wpex_get_portfolio_post_thumbnail( $args = array() ) {

	// Define thumbnail args
	$defaults = array(
		'size'          => 'portfolio_post',
		'class'         => 'portfolio-single-media-img',
		'alt'           => wpex_get_esc_title(),
		'schema_markup' => true,
	);

	// Parse arguments
	$args = wp_parse_args( $args, $defaults );

	// Return thumbanil
	return wpex_get_post_thumbnail( apply_filters( 'wpex_get_portfolio_post_thumbnail_args', $args ) );

}

/**
 * Displays the media (featured image or video ) for the portfolio entries
 *
 * @since 1.3.6
 */
if ( ! function_exists( 'wpex_portfolio_entry_media' ) ) {
	function wpex_portfolio_entry_media() {
		get_template_part( 'partials/portfolio/entry-media' );
	}
}

/**
 * Displays the details for the portfolio entries
 *
 * @since 1.3.6
 */
if ( ! function_exists( 'wpex_portfolio_entry_content' ) ) {
	function wpex_portfolio_entry_content() {
		get_template_part( 'partials/portfolio/entry-content' );
	}
}

/**
 * Returns correct classes for the portfolio wrap
 *
 * @since Total 1.5.3
 */
if ( ! function_exists( 'wpex_get_portfolio_wrap_classes' ) ) {
	function wpex_get_portfolio_wrap_classes() {

		// Get grid style
		$grid_style = wpex_get_mod( 'portfolio_archive_grid_style' ) ? wpex_get_mod( 'portfolio_archive_grid_style' ) : 'fit-rows';

		// Add default classes
		$classes = array( 'wpex-row', 'clr' );

		// Add grid style class
		$classes[] = 'portfolio-'. $grid_style;

		// Add equal height class
		$classes[] = wpex_portfolio_match_height() ? 'match-height-grid' : '';

		// Apply filters
		$classes  = apply_filters( 'wpex_portfolio_wrap_classes', $classes );

		// Turn into string
		$classes = implode( " ",$classes );

		// Return classes
		return $classes;

	}
}

/**
 * Returns portfolio archive columns
 *
 * @since 2.0.0
 */
function wpex_portfolio_archive_columns() {
	return wpex_get_mod( 'portfolio_entry_columns', '4' );
}

/**
 * Checks if match heights are enabled for the portfolio
 *
 * @since 1.5.3
 */
if ( ! function_exists( 'wpex_portfolio_match_height' ) ) {
	function wpex_portfolio_match_height() {
		$grid_style = wpex_get_mod( 'portfolio_archive_grid_style', 'fit-rows' ) ? wpex_get_mod( 'portfolio_archive_grid_style', 'fit-rows' ) : 'fit-rows';
		$columns    = wpex_get_mod( 'portfolio_entry_columns', '4' ) ? wpex_get_mod( 'portfolio_entry_columns', '4' ) : '4';
		if ( 'fit-rows' == $grid_style && wpex_get_mod( 'portfolio_archive_grid_equal_heights' ) && $columns > '1' ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Returns correct classes for the portfolio grid
 *
 * @since 1.5.2
 */
if ( ! function_exists( 'wpex_portfolio_column_class' ) ) {
	function wpex_portfolio_column_class( $query ) {
		if ( 'related' == $query ) {
			$columns = wpex_get_mod( 'portfolio_related_columns', '4' );
		} else {
			$columns = wpex_get_mod( 'portfolio_entry_columns', '4' );
		}
		return wpex_grid_class( $columns );
	}
}

/**
 * Returns portfolio featured video url
 *
 * @since 1.5.2
 */
if ( ! function_exists( 'wpex_get_portfolio_featured_video_url' ) ) {
	function wpex_get_portfolio_featured_video_url( $post_id = '') {
		if ( function_exists( 'wpex_post_video' ) ) {
			return wpex_get_post_video( $post_id );
		}
	}
}

/**
 * Displays the portfolio featured video
 *
 * @since 1.5.2
 */
if ( ! function_exists( 'wpex_portfolio_post_video' ) ) {
	function wpex_portfolio_post_video( $post_id = '', $video = false ) {
		echo wpex_get_portfolio_post_video();
	}
}

/**
 * Displays the portfolio featured video
 *
 * @since 1.5.2
 */
function wpex_get_portfolio_post_video() {

	// Get video URl
	$video = wpex_get_post_video_html();

	// Return if no video
	if ( empty( $video ) ) {
		return;
	}

	// Return video
	return '<div class="portfolio-featured-video clr">'. $video .'</div>';

}

/**
 * Gets correct heading for the related blog items
 *
 * @since 2.0.0
 */
function wpex_portfolio_related_heading() {
	$heading = wpex_get_translated_theme_mod( 'portfolio_related_title' );
	$heading = $heading ? esc_html( $heading ) : esc_html__( 'Related Projects', 'total' );
	return $heading;
}

/**
 * Displays Portfolio Categories For current postid
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_portfolio_cats' ) ) {
	function wpex_portfolio_cats( $postid ) {
		$cats = get_the_terms( $postid, 'portfolio_category' );
		if( $cats ) {
			$output = '';
			$output .= '<div class="portfolio-entry-cats clearfix">';
				foreach( $cats as $cat ) {
					$output .= '<a href="'. get_term_link($cat->slug, 'portfolio_category') .'" title="'. $cat->name .'">'. $cat->name .'<span>,</span></a>';
				}
			$output .='</div><!-- .portfolio-entry-cats -->';
			return $output; 
		} else {
			return;
		}
	}
}

/**
 * Displays the first category of a given portfolio
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_portfolio_first_cat' ) ) {
	function wpex_portfolio_first_cat( $postid=false ) {
		global $post;
		$postid = $postid ? $postid : $post->ID;
		$cats   = get_the_terms( $postid, 'portfolio_category' );
		$output = '';   
		if( $cats ) {
			$count=0;
			foreach( $cats as $cat ) {
				$count++;
				if ( $count == 1 ) {
					$output .= '<a href="'. get_term_link($cat->slug, 'portfolio_category') .'" title="'. $cat->name .'">'. $cat->name .'</a>';
				}
			}
		}
		return $output;
	}
}

/**
 * Output Portfolio terms for use with isotope scripts
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_portfolio_entry_terms' ) ) {
	function wpex_portfolio_entry_terms() {
		if ( ! post_type_exists( 'portfolio' ) ) {
			return;
		}
		global $post;
		if ( ! $post ) {
			return;
		}
		$output ='';
		$terms = get_the_terms( $post, 'portfolio_category' );
		if( $terms ) {
			$output = '';
			foreach ( $terms as $term ) {
				$output .= $term->slug .' ';
			}
		}
		return $output;
	}
}

/**
 * Check if the current portfolio style supports equal heights
 *
 * @since 1.0.0
 */
function wpex_portfolio_style_supports_equal_heights() {
	$style = wpex_get_mod( 'portfolio_archive_grid_style' );
	if ( 'masonry' != $style && 'no-margins' != $style ) {
		return true;
	}
}