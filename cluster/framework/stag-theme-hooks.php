<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * StagFramework Theme Hooks
 * 
 * @package WordPress
 * @subpackage StagFramework
 * @author Ram Ratan Maurya
 * @category Admin
 * @version 2.0
 * @since 1.0
 */

// header.php
function stag_meta_head() { stag_do_atomic( 'stag_meta_head' ); }
function stag_head() { stag_do_atomic( 'stag_head' ); }
function stag_body_start() { stag_do_atomic( 'stag_body_start' ); }
function stag_header_before() { stag_do_atomic( 'stag_header_before' ); }
function stag_header_after() { stag_do_atomic( 'stag_header_after' ); }
function stag_header_start() { stag_do_atomic( 'stag_header_start' ); }
function stag_header_end() { stag_do_atomic( 'stag_header_end' ); }
function stag_nav_before() { stag_do_atomic( 'stag_nav_before' ); }
function stag_nav_after() { stag_do_atomic( 'stag_nav_after' ); }
function stag_content_start() { stag_do_atomic( 'stag_content_start' ); }

// Template Files: 404, archive, single, index, search
function stag_post_before() { stag_do_atomic( 'stag_post_before' ); }
function stag_post_after() { stag_do_atomic( 'stag_post_after' ); }
function stag_post_start() { stag_do_atomic( 'stag_post_start' ); }
function stag_post_end() { stag_do_atomic( 'stag_post_end' ); }

// Template Files: page
function stag_page_before() { stag_do_atomic( 'stag_page_before' ); }
function stag_page_after() { stag_do_atomic( 'stag_page_after' ); }
function stag_page_start() { stag_do_atomic( 'stag_page_start' ); }
function stag_page_end() { stag_do_atomic( 'stag_page_end' ); }

// Comments: single, page
function stag_comments_before() { stag_do_atomic( 'stag_comments_before' ); }
function stag_comments_after() { stag_do_atomic( 'stag_comments_after' ); }

// Sidebar
function stag_sidebar_before() { stag_do_atomic( 'stag_sidebar_before' ); }
function stag_sidebar_after() { stag_do_atomic( 'stag_sidebar_after' ); }
function stag_sidebar_start() { stag_do_atomic( 'stag_sidebar_start' ); }
function stag_sidebar_end() { stag_do_atomic( 'stag_sidebar_end' ); }

// Footer
function stag_content_end() { stag_do_atomic( 'stag_content_end' ); }
function stag_footer_before() { stag_do_atomic( 'stag_footer_before' ); }
function stag_footer_after() { stag_do_atomic( 'stag_footer_after' ); }
function stag_footer_start() { stag_do_atomic( 'stag_footer_start' ); }
function stag_footer_end() { stag_do_atomic( 'stag_footer_end' ); }
function stag_body_end() { stag_do_atomic( 'stag_body_end' ); }


if( ! function_exists( 'stag_do_atomic' ) ) {
/**
 * stag_do_atomic
 *
 * Adds contextual action hooks to the theme. This allows users to easily add context-based content 
 * without having to know how to use WordPress conditional tags.  The theme handles the logic.
 * 
 * @link http://ptahdunbar.com/wordpress/smarter-hooks-context-sensitive-hooks
 * @since 2.0
 * @uses stag_get_query_context() to get the context of the current page.
 * @param string $tag, usually the location of hook but defines what the base hook is.
 */
function stag_do_atomic( $tag = '', $args = '' ) {
	if( !$tag ) return false;

	// Does actions on the basic hook
	do_action( $tag, $args );

	// Loop through context array and fire actions on a contextual scale.
	foreach( (array) stag_get_query_context() as $context )
		do_action( "{$tag}_{$context}", $args );
} // End stag_do_atomic()
}

if( ! function_exists( 'stag_apply_atomic' ) ) {
/**
 * stag_apply_atomic()
 * 
 * Adds contextual filter hooks to the theme. This allows users to easily filter context-based content 
 * without having to know how to use WordPress conditional tags. The theme handles the logic.
 * 
 * @since 2.0
 * @uses stag_get_query_context() to get the context of the current page.
 * @param string $tag, usually the location of hook but defines what the base hook is.
 * @param mixed $value, the value to be filtered
 * @return mixed $value, the value after it has been filtered
 */
function stag_apply_atomic( $tag = '', $value = '' ) {
	if( !$tag ) return false;

	$prefix = 'stag'; // theme prefix

	// Apply filters on basic hook
	$value = apply_filters( "{$prefix}_{$tag}", $value );

	// Loop through context array and apply filters on a contextual scale.
	foreach( (array) stag_get_query_context() as $context )
		$value = apply_filters( "{$pre}_{$context}_{$tag}", $value );

	return $value;
} // End stag_apply_atomic()
}

if( ! function_exists( 'stag_get_query_context' ) ) {
/**
 * stag_get_query_context()
 * 
 * Retrieve the context of the queried template
 * @since 2.0
 * @return array $query_context
 */
function stag_get_query_context() {
	global $wp_query, $query_context;
	
	/* If $query_context->context has been set, don't run through the conditionals again. Just return the variable. */
	if ( is_object( $query_context ) && isset( $query_context->context ) && is_array( $query_context->context ) ) {
		return $query_context->context;
	}

	unset( $query_context );
	$query_context = new stdClass();
	$query_context->context = array();

	/* Front page of the site. */
	if ( is_front_page() ) {
		$query_context->context[] = 'home';
	}

	/* Blog page. */
	if ( is_home() && ! is_front_page() ) {
		$query_context->context[] = 'blog';

	/* Singular views. */
	} elseif ( is_singular() ) {
		$query_context->context[] = 'singular';
		$query_context->context[] = "singular-{$wp_query->post->post_type}";
	
		/* Page Templates. */
		if ( is_page_template() ) {
			$to_skip = array( 'page', 'post' );
		
			$page_template = basename( get_page_template() );
			$page_template = str_replace( '.php', '', $page_template );
			$page_template = str_replace( '.', '-', $page_template );
		
			if ( $page_template && ! in_array( $page_template, $to_skip ) ) {
				$query_context->context[] = $page_template;
			}
		}
		
		$query_context->context[] = "singular-{$wp_query->post->post_type}-{$wp_query->post->ID}";
	}

	/* Archive views. */
	elseif ( is_archive() ) {
		$query_context->context[] = 'archive';

		/* Taxonomy archives. */
		if ( is_tax() || is_category() || is_tag() ) {
			$term = $wp_query->get_queried_object();
			$query_context->context[] = 'taxonomy';
			$query_context->context[] = $term->taxonomy;
			$query_context->context[] = "{$term->taxonomy}-" . sanitize_html_class( $term->slug, $term->term_id );
		}

		/* User/author archives. */
		elseif ( is_author() ) {
			$query_context->context[] = 'user';
			$query_context->context[] = 'user-' . sanitize_html_class( get_the_author_meta( 'user_nicename', get_query_var( 'author' ) ), $wp_query->get_queried_object_id() );
		}

		/* Time/Date archives. */
		else {
			if ( is_date() ) {
				$query_context->context[] = 'date';
				if ( is_year() )
					$query_context->context[] = 'year';
				if ( is_month() )
					$query_context->context[] = 'month';
				if ( get_query_var( 'w' ) )
					$query_context->context[] = 'week';
				if ( is_day() )
					$query_context->context[] = 'day';
			}
			if ( is_time() ) {
				$query_context->context[] = 'time';
				if ( get_query_var( 'hour' ) )
					$query_context->context[] = 'hour';
				if ( get_query_var( 'minute' ) )
					$query_context->context[] = 'minute';
			}
		}
	}

	/* Search results. */
	elseif ( is_search() ) {
		$query_context->context[] = 'search';
	/* Error 404 pages. */
	} elseif ( is_404() ) {
		$query_context->context[] = 'error-404';
	}
	
	return $query_context->context;
} // End stag_get_query_context()
}
