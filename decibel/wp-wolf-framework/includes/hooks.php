<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Create a custom hook definitions
 */

function wolf_meta_head() { wolf_do_contextual_hook( 'wolf_meta_head' ); }
function wolf_head() { wolf_do_contextual_hook( 'wolf_head' ); }
function wolf_body_start() { wolf_do_contextual_hook( 'wolf_body_start' ); }
function wolf_site_content_start() { wolf_do_contextual_hook( 'wolf_site_content_start' ); }

/* header.php -----------------------------------------------------------------*/


function wolf_header_before() { wolf_do_contextual_hook( 'wolf_header_before' ); }
function wolf_header_after() { wolf_do_contextual_hook( 'wolf_header_after' ); }
function wolf_header_start() { wolf_do_contextual_hook( 'wolf_header_start' ); }
function wolf_header_end() { wolf_do_contextual_hook( 'wolf_header_end' ); }
function wolf_nav_before() { wolf_do_contextual_hook( 'wolf_nav_before' ); }
function wolf_nav_after() { wolf_do_contextual_hook( 'wolf_nav_after' ); }
function wolf_content_before() { wolf_do_contextual_hook( 'wolf_content_before' ); }
function wolf_content_start() { wolf_do_contextual_hook( 'wolf_content_start' ); }

/* index.php, single.php, search.php, archive.php -----------------------------*/
function wolf_post_before() { wolf_do_contextual_hook( 'wolf_post_before' ); }
function wolf_post_after() { wolf_do_contextual_hook( 'wolf_post_after' ); }
function wolf_post_start() { wolf_do_contextual_hook( 'wolf_post_start' ); }
function wolf_post_end() { wolf_do_contextual_hook( 'wolf_post_end' ); }

/* page.php -------------------------------------------------------------------*/
function wolf_page_before() { wolf_do_contextual_hook( 'wolf_page_before' ); }
function wolf_page_after() { wolf_do_contextual_hook( 'wolf_page_after' ); }
function wolf_page_start() { wolf_do_contextual_hook( 'wolf_page_start' ); }
function wolf_page_end() { wolf_do_contextual_hook( 'wolf_page_end' ); }

/* Woocommerce -------------------------------------------------------------------*/
function wolf_woocommerce_page_before() { wolf_do_contextual_hook( 'wolf_woocommerce_page_before' ); }
function wolf_woocommerce_page_after() { wolf_do_contextual_hook( 'wolf_woocommerce_page_after' ); }

/* single.php, page.php, templates with comments ------------------------------*/
function wolf_comments_before() { wolf_do_contextual_hook( 'wolf_comments_before' ); }
function wolf_comments_after() { wolf_do_contextual_hook( 'wolf_comments_after' ); }

/* sidebar.php ----------------------------------------------------------------*/
function wolf_sidebar_before() { wolf_do_contextual_hook( 'wolf_sidebar_before' ); }
function wolf_sidebar_after() { wolf_do_contextual_hook( 'wolf_sidebar_after' ); }
function wolf_sidebar_start() { wolf_do_contextual_hook( 'wolf_sidebar_start' ); }
function wolf_sidebar_end() { wolf_do_contextual_hook( 'wolf_sidebar_end' ); }

/* footer.php -----------------------------------------------------------------*/
function wolf_content_end() { wolf_do_contextual_hook( 'wolf_content_end' ); }
function wolf_content_after() { wolf_do_contextual_hook( 'wolf_content_after' ); }
function wolf_footer_before() { wolf_do_contextual_hook( 'wolf_footer_before' ); }
function wolf_footer_after() { wolf_do_contextual_hook( 'wolf_footer_after' ); }
function wolf_footer_start() { wolf_do_contextual_hook( 'wolf_footer_start' ); }
function wolf_footer_end() { wolf_do_contextual_hook( 'wolf_footer_end' ); }
function wolf_body_end() { wolf_do_contextual_hook( 'wolf_body_end' ); }
function wolf_site_info() { wolf_do_contextual_hook( 'wolf_site_info' ); }

if ( ! function_exists( 'wolf_do_contextual_hook' ) ) {
	/**
	 * Adds contextual action hooks. Users do not need to use WordPress conditional tags
	 * because this function handles the logic.
	 *
	 * Basic hook would be 'wolf_head'. wolf_do_contextual_hook() function extends
	 * the hook with context (i.e., 'wolf_head_singular' or 'wolf_head_home' )
	 *
	 * Thanks to Ptah Dunbar for this function
	 * @link https://twitter.com/ptahdunbar
	 *
	 * @uses wolf_get_query_context() Gets the context of the current page
	 * @param string $tag Usually the location of the hook but defines the base hook
	 */
	function wolf_do_contextual_hook( $tag = '', $args = '' ) {

		if ( ! $tag ) { return false; }

		do_action( $tag, $args );

		foreach ( (array) wolf_get_query_context() as $context ) {
			do_action( "{$tag}_{$context}", $args );
		}

	}
}

if ( ! function_exists( 'wolf_get_query_context' ) ) {
	/**
	 * Retrieve the context of the queried template
	 *
	 * @since 1.0.0
	 * @return array $query_context
	 */
	function wolf_get_query_context() {
		global $wp_query, $query_context;

		/* Return query_context if set -------------------------------------------*/
		if ( isset( $query_context->context ) && is_array( $query_context->context ) ) {
			return $query_context->context;
		}

		if ( ! is_object( $query_context ) ) {
			$query_context = new stdClass;
		}

		/* Figure out the context ------------------------------------------------*/
		$query_context->context = array();

		/* Front page */
		if ( is_front_page() ) {
			$query_context->context[] = 'home';
		}

		/* Blog page */
		if ( is_home() && ! is_front_page() ) {

			$query_context->context[] = 'blog';

			/* Singular views */
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
	}
}


if ( ! function_exists( 'wolf_add_options_item_to_admin_bar' ) ) {
	/**
	 * Add wolf theme options to admin toolbar
	 *
	 * @access public
	 * @return void
	 */
	function wolf_add_options_item_to_admin_bar() {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu(
			array(
				'parent' => 'site-name',
				// use 'false' for a root menu, or pass the ID of the parent menu
				'id'     => 'wolf_options',
				// link ID, defaults to a sanitized title value
				'title'  => __( 'Theme Settings', 'wolf' ),
				// link title
				'href'   => esc_url( admin_url( 'admin.php?page=wolf-theme-options' ) ),
				// name of file
				'meta'   => false
				// array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
			)
		);
	}
	add_action( 'wp_before_admin_bar_render', 'wolf_add_options_item_to_admin_bar' );
}