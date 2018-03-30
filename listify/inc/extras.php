<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Listify
 */

function listify_wp_video_shortcode( $html ) {
	$html = str_replace( 'controls="controls"', '', $html );

	return $html;
}

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function listify_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'listify' ), max( $paged, $page ) );

	return $title;
}
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	add_filter( 'wp_title', 'listify_wp_title', 10, 2 );
}

/**
 * Callback for a short excerpt length.
 *
 * @since 1.5.0
 * @param int $length
 * @return int
 */
function listify_short_excerpt_length( $length ) {
	return 15;
}

/**
 * Remove ellipsis from the excerpt
 */
function listify_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'listify_excerpt_more' );

function listify_widget_posts_args( $args ) {
	if ( ! is_author() ) {
		return $args;
	}

	$args[ 'author' ] = get_the_author_meta( 'ID' );

	return $args;
}
add_filter( 'widget_posts_args', 'listify_widget_posts_args' );

// Shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

function listify_array_filter_deep( $item ) {
    if ( is_array( $item ) ) {
        return array_filter( $item, 'listify_array_filter_deep' );
    }

    if ( ! empty( $item ) ) {
        return true;
    }
}

function listify_get_terms( $args = array() ) {
	$args = wp_parse_args( $args, apply_filters( 'listify_get_terms_args', array(
		'orderby' => 'id',
		'order' => 'ASC',
		'hide_empty' => 1,
		'child_of' => 0,
		'exclude' => '',
		'hierarchical' => 0,
		'update_term_meta_cache' => false,
		'taxonomy' => 'job_listing_category'
	) ) );

	if ( ! listify_has_integration( 'wp-job-manager' ) ) {
		return get_terms( $args );
	}

	$terms_hash = 'jm_cats_' . md5( json_encode( $args ) . WP_Job_Manager_Cache_Helper::get_transient_version( 'jm_get_' . $args[ 'taxonomy' ] ) );
	$terms = get_transient( $terms_hash );

	if ( is_array( $terms ) ) {
		$terms = array_filter( $terms );
	}

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		$terms = get_terms( $args );

		set_transient( $terms_hash, $terms );
	}

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return array();
	}

	return $terms;
}
