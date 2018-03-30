<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Like.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Backpack\Like
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0.1
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Frontend helpers.
 * -----------------------------------------------------------------------------
 */
require_once 'helpers.php';

/**
 * Scripts.
 * -----------------------------------------------------------------------------
 */
if ( ! function_exists( 'thb_like_scripts' ) ) {
	function thb_like_scripts( $scripts ) {
		$scripts[] = thb_get_module_path( 'backpack/like' ) . '/js/thb-like.js';

		return $scripts;
	}
}

add_filter( 'thb_frontend_scripts', 'thb_like_scripts' );

if ( ! thb_compress_frontend_scripts() ) {
	thb_theme()->getFrontend()->addScript( thb_get_module_url('backpack/like') . '/js/thb-like.js', array(
		'name' => 'thb_like'
	) );
}

// if( ! function_exists( 'thb_like_enqueue_scripts' ) ) {
// 	/**
// 	 * Enqueue scripts for the like functionality.
// 	 */
// 	function thb_like_enqueue_scripts() {
// 		thb_theme()->getFrontend()->addScript( thb_get_module_url('backpack/like') . '/js/thb-like.js', array(
// 			'name' => 'thb_like'
// 		) );
// 	}
// }

// add_action( 'wp_enqueue_scripts', 'thb_like_enqueue_scripts' );
add_action( 'wp_ajax_thb_like', 'thb_do_like' );
add_action( 'wp_ajax_nopriv_thb_like', 'thb_do_like' );