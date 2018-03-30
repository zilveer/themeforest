<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Query helpers.
 *
 * This file contains query-related utility functions.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Build a query args array based on the options linked to a specific post type.
 *
 * @param string $post_type The post type name.
 * @param int $id The entry ID.
 * @return array
 */
if( !function_exists('thb_post_type_query_args') ) {
	function thb_post_type_query_args( $post_type, $id=null ) {
		if( !$id ) {
			$id = thb_get_page_ID();
		}

		$basekey = $post_type . '_query';

		$items_per_page = thb_get_post_meta($id, $basekey . '_num');
		$items_orderby  = thb_get_post_meta($id, $basekey . '_orderby');
		$items_order  = thb_get_post_meta($id, $basekey . '_order');

		$items_filter = isset($_GET['filter']) ? $_GET['filter'] : thb_get_post_meta($id, $basekey . '_filter');
		$items_include_subcategories = isset($_GET['include_subcategories']) ? $_GET['include_subcategories'] : thb_get_post_meta($id, $basekey . '_include_subcategories');

		/**
		 * Default args
		 */
		$args = array(
			'posts_per_page' => $items_per_page,
			'orderby'        => $items_orderby,
			'order'          => $items_order
		);

		/**
		 * Optional filter by work type
		 */
		$items_filter = str_replace(' ', '', $items_filter);
		if( !empty($items_filter) ) {
			$args['tax_query'] = array();

			$pairs = explode(',', $items_filter);
			array_walk($pairs, 'trim');

			if( !empty($pairs) ) {
				$args['tax_query']['relation'] = 'OR';
			}

			foreach( $pairs as $pair ) {
				if( thb_text_contains(':', $pair) ) {
					list($taxonomy, $term_id) = explode(':', $pair);

					if( $term_id > 0 ) {
						$operator = 'IN';
					}
					else {
						$operator = 'NOT IN';
						$term_id *= -1;
					}
					
					$args['tax_query'][] = array(
						'taxonomy'         => $taxonomy,
						'field'            => 'ID',
						'terms'            => $term_id,
						'operator'         => $operator,
						'include_children' => !empty( $items_include_subcategories )
					);
				}
			}
		}

		return $args;
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
			'paged'               => $paged
			// 'ignore_sticky_posts' => 1
		);
		$args = $args + $default_args;

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