<?php
/**
 * Returns the correct title to display for any post/page/archive
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.4.0
 */

function wpex_title() {

	// Default title is null
	$title = NULL;
	
	// Get post ID from global object
	$post_id = wpex_global_obj( 'post_id' );
	
	// Homepage - display blog description if not a static page
	if ( is_front_page() && ! is_singular( 'page' ) ) {
		
		if ( get_bloginfo( 'description' ) ) {
			$title = get_bloginfo( 'description' );
		} else {
			return esc_html__( 'Recent Posts', 'total' );
		}

	// Homepage posts page
	} elseif ( is_home() && ! is_singular( 'page' ) ) {

		$title = get_the_title( get_option( 'page_for_posts', true ) );

	}

	// Search => NEEDS to go before archives
	elseif ( is_search() ) {
		global $wp_query;
		$title = '<span id="search-results-count">'. $wp_query->found_posts .'</span> '. esc_html__( 'Search Results Found', 'total' );
	}
		
	// Archives
	elseif ( is_archive() ) {

		// Author
		if ( is_author() ) {
			/*$title = sprintf(
				esc_html__( 'All posts by%s', 'total' ),': <span class="vcard">' . get_the_author() . '</span>'
			);*/
			$title = get_the_archive_title();
		}

		// Post Type archive title
		elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		}

		// Daily archive title
		elseif ( is_day() ) {
			$title = sprintf( esc_html__( 'Daily Archives: %s', 'total' ), get_the_date() );
		}

		// Monthly archive title
		elseif ( is_month() ) {
			$title = sprintf( esc_html__( 'Monthly Archives: %s', 'total' ), get_the_date( 'F Y' ) );
		}

		// Yearly archive title
		elseif ( is_year() ) {
			$title = sprintf( esc_html__( 'Yearly Archives: %s', 'total' ), get_the_date( 'Y' ) );
		}

		// Categories/Tags/Other
		else {

			// Get term title
			$title = single_term_title( '', false );

			// Fix for bbPress and other plugins that are archives but use pages
			if ( ! $title ) {
				global $post;
				$title = get_the_title( $post_id );
			}

		}

	} // End is archive check

	// 404 Page
	elseif ( is_404() && ! wpex_get_mod( 'error_page_content_id' ) ) {

		$title = wpex_get_translated_theme_mod( 'error_page_title' );
		$title = $title ? $title : esc_html__( '404: Page Not Found', 'total' );

	}
	
	// Anything else with a post_id defined
	elseif ( $post_id ) {

		// Single Pages
		if ( is_singular( 'page' ) || is_singular( 'attachment' ) ) {
			$title = get_the_title( $post_id );
		}

		// Single blog posts
		elseif ( is_singular( 'post' ) ) {
			$display = wpex_get_mod( 'blog_single_header' );
			$display = $display ? $display : 'custom_text';
			if ( 'custom_text' == $display ) {
				$title = wpex_get_mod( 'blog_single_header_custom_text' );
				$title = $title ? $title : esc_html__( 'Blog', 'total' );
			} elseif ( 'first_category' == $display ) {
				$title = wpex_get_first_term_name();
			} else {
				$title = get_the_title( $post_id );
			}
		}

		// Other posts (custom types)
		else {
			$obj = get_post_type_object( get_post_type() );
			if ( is_object( $obj ) ) {
				$title = $obj->labels->name;
			}
		}

		// Custom meta title
		if ( $meta = get_post_meta( $post_id, 'wpex_post_title', true ) ) {
			$title = $meta;
		}

	}

	// Last check if title is empty
	$title = $title ? $title : get_the_title();

	// Apply filters and return title
	return apply_filters( 'wpex_title', $title );
	
}