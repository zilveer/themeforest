<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Query helpers.
 *
 * This file contains query-related utility functions.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Build a query args array based on the options linked to a specific post type.
 *
 * @param string $post_type The post type name.
 * @param int $id The entry ID.
 * @param array $args Params overriding default behavior.
 * @return array
 */
if( !function_exists('thb_post_type_query_args') ) {
	function thb_post_type_query_args( $post_type, $id = null, $args = array() ) {
		if( !$id ) {
			$id = thb_get_page_ID();
		}

		$basekey = $post_type . '_query';

		$args = wp_parse_args( $args, array(
			'items_per_page'              => thb_get_post_meta($id, $basekey . '_num'),
			'items_orderby'               => thb_get_post_meta($id, $basekey . '_orderby'),
			'items_order'                 => thb_get_post_meta($id, $basekey . '_order'),
			'items_filter'                => isset($_GET['filter']) ? $_GET['filter'] : thb_get_post_meta($id, $basekey . '_filter'),
			'items_filter_exclude'        => isset($_GET['filter_exclude']) ? $_GET['filter_exclude'] : thb_get_post_meta($id, $basekey . '_filter_exclude'),
			'items_include_subcategories' => isset($_GET['include_subcategories']) ? $_GET['include_subcategories'] : thb_get_post_meta($id, $basekey . '_include_subcategories'),
		) );

		/**
		 * Default args
		 */
		$query_args = array(
			'posts_per_page' => $args['items_per_page'],
			'orderby'        => $args['items_orderby'],
			'order'          => $args['items_order']
		);

		$items_filter = str_replace( ' ', '', (string) $args['items_filter'] );
		$items_filter_exclude = str_replace( ' ', '', (string) $args['items_filter_exclude'] );

		if( ! empty( $items_filter ) || ! empty( $items_filter_exclude ) ) {
			$query_args['tax_query'] = array();

			$pairs = explode( ',', $items_filter );
			array_walk( $pairs, 'trim' );

			$pairs_exclude = explode( ',', $items_filter_exclude );
			array_walk( $pairs_exclude, 'trim' );

			/**
			 * Inclusive filter.
			 */
			if ( ! empty( $pairs ) ) {
				$terms_to_include = array();

				foreach ( $pairs as $index => $pair ) {
					if( thb_text_contains( ':', $pair ) ) {
						list( $taxonomy, $term_id ) = explode(':', $pair);
						$term_id = (int) $term_id;

						if ( term_exists( $term_id, $taxonomy ) ) {
							$terms_to_include[] = $term_id;
						}
					}
				}

				if ( ! empty( $terms_to_include ) ) {
					$query_args['tax_query'][] = array(
						'taxonomy'         => $taxonomy,
						'field'            => 'id',
						'terms'            => $terms_to_include,
						'operator'         => 'IN',
						'include_children' => ! empty( $args['items_include_subcategories'] )
					);
				}
			}

			/**
			 * Exclusive filter.
			 */
			if ( ! empty( $pairs_exclude ) ) {
				$terms_to_exclude = array();

				foreach ( $pairs_exclude as $index => $pair ) {
					if( thb_text_contains( ':', $pair ) ) {
						list( $taxonomy, $term_id ) = explode(':', $pair);
						$term_id = (int) $term_id;

						if ( term_exists( $term_id, $taxonomy ) ) {
							$terms_to_exclude[] = $term_id;
						}
					}
				}

				if ( ! empty( $terms_to_exclude ) ) {
					$query_args['tax_query'][] = array(
						'taxonomy'         => $taxonomy,
						'field'            => 'id',
						'terms'            => $terms_to_exclude,
						'operator'         => 'NOT IN',
						'include_children' => ! empty( $args['items_include_subcategories'] )
					);
				}
			}
		}

		return $query_args;
	}
}

/**
 * Runs a custom loop for a specific custom post type.
 *
 * @param string $post_type The custom post type.
 * @param array $args The loop's parameters.
 * @return void
 */
if( !function_exists('thb_query_posts') ) {
	function thb_query_posts( $post_type, $args=array() ) {
		global $wp_query;

		// Getting the pagination right
		$paged = 1;
		if( isset($args['paged']) ) {
			$paged = $args['paged'];
		}
		else {
			if (get_query_var('paged'))
				$paged = get_query_var('paged');
			elseif (get_query_var('page'))
				$paged = get_query_var('page');
		}

		$args['post_type'] = $post_type;

		$default_args = array(
			'posts_per_page'      => get_option('posts_per_page'),
			'post_status'         => 'publish',
			'paged'               => $paged,
			// 'ignore_sticky_posts' => 1
		);

		if ( ! isset( $args['order'] ) || empty( $args['order'] ) ) {
			$args['order'] = 'desc';
		}

		if ( ! isset( $args['orderby'] ) || empty( $args['orderby'] ) ) {
			$args['orderby'] = 'date';
		}

		$args = wp_parse_args( $args, $default_args );

		query_posts($args);
	}
}

/**
 * Sets the post classes when inside a loop.
 * By default it adds first/last classes.
 *
 * @param int $i Loop counter.
 * @param  array  $classes=array() Post extra classes.
 * @param  array  $step=3 Mod dependent classes. (in form of 'n2', 'n3', ...)
 * @return array
 */
if( !function_exists('thb_get_post_classes') ) {
	function thb_get_post_classes( $i, $classes=array(), $step=3, $wp_query=null ) {

		if( $wp_query == null ) {
			global $wp_query;
		}

		$post_classes = $classes;
		if($i == 1 ) $post_classes[] = "first";
		if($i == $wp_query->post_count) $post_classes[] = "last";

		$ranges=array();

		for( $m=1; $m<=$step; $m++ ) {
			if( $wp_query->post_count - $m >= $step ) {
				$ranges[$m] = range($m, $wp_query->post_count, $step);
			}
			else {
				$ranges[$m] = array($m);
			}
		}

		for( $m=1; $m<=$step; $m++ ) {
			if( in_array($i, $ranges[$m]) ) {
				$post_classes[] = 'n' . ($m);
			}
		}

		return $post_classes;
	}
}