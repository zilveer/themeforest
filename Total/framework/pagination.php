<?php
/**
 * Custom pagination functions
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.0
 */

/**
 * Numbered Pagination
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_pagination' ) ) {

	function wpex_pagination( $query = '', $echo = true ) {
		
		// Arrows with RTL support
		$prev_arrow = is_rtl() ? 'fa fa-angle-right' : 'fa fa-angle-left';
		$next_arrow = is_rtl() ? 'fa fa-angle-left' : 'fa fa-angle-right';
		
		// Get global $query
		if ( ! $query ) {
			global $wp_query;
			$query = $wp_query;
		}

		// Set vars
		$total  = $query->max_num_pages;
		$big    = 999999999;

		// Display pagination
		if ( $total > 1 ) {

			// Get current page
			if ( $current_page = get_query_var( 'paged' ) ) {
				$current_page = $current_page;
			} elseif ( $current_page = get_query_var( 'page' ) ) {
				$current_page = $current_page;
			} else {
				$current_page = 1;
			}

			// Get permalink structure
			if ( get_option( 'permalink_structure' ) ) {
				if ( is_page() ) {
					$format = 'page/%#%/';
				} else {
					$format = '/%#%/';
				}
			} else {
				$format = '&paged=%#%';
			}

			$args = apply_filters( 'wpex_pagination_args', array(
				'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
				'format'    => $format,
				'current'   => max( 1, $current_page ),
				'total'     => $total,
				'mid_size'  => 3,
				'type'      => 'list',
				'prev_text' => '<span class="'. $prev_arrow .'"></span>',
				'next_text' => '<span class="'. $next_arrow .'"></span>',
			) );

			$align = wpex_get_mod( 'pagination_align' );
			$align = ( 'left' != $align ) ? ' wpex-'. $align : '';

			// Output pagination
			if ( $echo ) {
				echo '<div class="wpex-pagination wpex-clr'. $align .'">'. paginate_links( $args ) .'</div>';
			} else {
				return '<div class="wpex-pagination wpex-clr'. $align .'">'. paginate_links( $args ) .'</div>';
			}

		}

	}
	
}

/**
 * Next/Prev Pagination
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_pagejump' ) ) {
	function wpex_pagejump( $pages = '', $range = 4, $echo = true ) {
		$output     = '';
		$showitems  = ($range * 2)+1; 
		global $paged;
		if ( empty( $paged ) ) $paged = 1;
		
		if ( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( ! $pages) {
				$pages = 1;
			}
		}
		if ( 1 != $pages ) {

			$output .= '<div class="page-jump wpex-clr">';
				$output .= '<div class="alignleft newer-posts">';
					$output .= get_previous_posts_link( '&larr; '. esc_html__( 'Newer Posts', 'total' ) );
				$output .= '</div>';
				$output .= '<div class="alignright older-posts">';
					$output .= get_next_posts_link( esc_html__( 'Older Posts', 'total' ) .' &rarr;' );
				$output .= '</div>';
			$output .= '</div>';

			if ( $echo ) {
				echo $output;
			} else {
				return $output;
			}

		}
	}
}

/**
 * Infinite Scroll Pagination
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_infinite_scroll' ) ) {
	function wpex_infinite_scroll( $type = 'standard' ) {

		// Make sure lightbox CSS is loaded to prevent bugs when items are loaded that must load this CSS
		wpex_enqueue_ilightbox_skin();

		// Load infinite scroll script
		wp_enqueue_script(
			'wpex-infinitescroll',
			WPEX_JS_DIR_URI .'dynamic/infinitescroll.js',
			array( 'jquery' ),
			1.0,
			true
		);
		
		// Localize loading text
		$is_params = array( 'msgText' => esc_html__( 'Loading...', 'total' ) );
		wp_localize_script( 'wpex-infinitescroll', 'wpexInfiniteScroll', $is_params );  
		
		// Output pagination HTML
		$output = '';
		$output .= '<div class="infinite-scroll-nav clr">';
			$output .= '<div class="alignleft newer-posts">';
				$output .= get_previous_posts_link('&larr; '. esc_html__( 'Newer Posts', 'total' ) );
			$output .= '</div>';
			$output .= '<div class="alignright older-posts">';
				$output .= get_next_posts_link( esc_html__( 'Older Posts', 'total' ) .' &rarr;');
			$output .= '</div>';
		$output .= '</div>';

		echo $output;

	}
}

/**
 * Blog Pagination
 * Used to load the correct pagination function for blog archives
 * Execute the correct pagination function based on the theme settings
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'wpex_blog_pagination' ) ) {
	function wpex_blog_pagination() {
		
		// Admin Options
		$blog_style       = wpex_get_mod( 'blog_style', 'large-image' );
		$pagination_style = wpex_get_mod( 'blog_pagination_style', 'standard' );
		
		// Category based settings
		if ( is_category() ) {
			
			// Get taxonomy meta
			$term       = get_query_var( 'cat' );
			$term_data  = get_option( 'category_'. $term );
			$term_style = $term_pagination = '';
			
			if ( isset( $term_data['wpex_term_style'] ) ) {
				$term_style = '' != $term_data['wpex_term_style'] ? $term_data['wpex_term_style'] .'' : $term_style;
			}
			
			if ( isset( $term_data['wpex_term_pagination'] ) ) {
				$term_pagination = '' != $term_data['wpex_term_pagination'] ? $term_data['wpex_term_pagination'] .'' : '';
			}
			
			if ( $term_style ) {
				$blog_style = $term_style .'-entry-style';
			}
			
			if ( $term_pagination ) {
				$pagination_style = $term_pagination;
			}
			
		}
		
		// Set default $type for infnite scroll
		if ( 'grid-entry-style' == $blog_style ) {
			$infinite_type = 'standard-grid';
		} else {
			$infinite_type = 'standard';
		}
		
		// Execute the correct pagination function
		if ( 'infinite_scroll' == $pagination_style ) {
			wpex_infinite_scroll( $infinite_type );
		} elseif ( $pagination_style == 'next_prev' ) {
			wpex_pagejump();
		} else {
			wpex_pagination();
		}

	}
}