<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Sidebars helper.
 *
 * This file contains sidebars utility functions.
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

if( ! function_exists( 'thb_display_sidebar' ) ) {
	/**
	 * Display a sidebar.
	 *
	 * @param string $sidebar The sidebar name.
	 * @param string $type The sidebar type.
	 * @param string $class The sidebar classes.
	 */
	function thb_display_sidebar( $sidebar, $type = 'main', $class = '' ) {
		$show_sidebar = apply_filters( 'thb_show_sidebar', is_active_sidebar( $sidebar ) );

		if( ! $show_sidebar ) {
			return;
		}

		thb_get_framework_template_part( 'frontend/sidebar', array(
			'sidebar'       => $sidebar,
			'sidebar_type'  => $type,
			'sidebar_class' => $class
		) );
	}
}

/**
 * Display a page sidebar.
 *
 * @param string $type The sidebar type.
 * @param string $class The sidebar classes.
 * @return void
 */
if( !function_exists('thb_page_sidebar') ) {
	function thb_page_sidebar( $type='main', $class='' ) {
		$sidebar = thb_get_page_sidebar();

		thb_display_sidebar( $sidebar, $type, $class );
	}
}

/**
 * Get the page sidebar.
 *
 * @param int $page_id The page ID.
 * @return string
 */
if( !function_exists('thb_get_page_sidebar') ) {
	function thb_get_page_sidebar( $page_id=null ) {
		if( !$page_id ) {
			$page_id = thb_get_page_ID();
		}

		$sidebar = thb_get_post_meta( $page_id, 'sidebar' );
		$sidebar = apply_filters( 'thb_page_sidebar', $sidebar );

		return $sidebar;
	}
}

/**
 * Get the post type default sidebar.
 *
 * @param string $post_type The post type.
 * @return string
 */
if( ! function_exists( 'thb_get_post_type_sidebar' ) ) {
	function thb_get_post_type_sidebar( $post_type=null ) {
		if( ! empty( $post_type ) ) {
			$thb_theme = thb_theme();
			$post_type = $thb_theme->getPostType( $post_type );

			if( $post_type ) {
				return $post_type->getSidebar();
			}
		}

		return '';
	}
}

/**
 * Get sidebars in a selectable format.
 *
 * @return array
 */
if( !function_exists('thb_get_sidebars_for_select') ) {
	function thb_get_sidebars_for_select() {
		global $wp_registered_sidebars;

		$sidebars = array(
			0 => __( 'No sidebar', 'thb_text_domain' )
		);

		foreach( $wp_registered_sidebars as $sidebar ) {
			$sidebars[$sidebar['id']] = $sidebar['name'];
		}

		return $sidebars;
	}
}