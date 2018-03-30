<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Slideshow.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Backpack\Slideshow
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0.1
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * A list of page templates that implement the Slideshow module.
	 */
	'templates' => array(),

	/**
	 * Slideshow transition effects.
	 */
	'effects' => array(
		'move'  => __('Slide', 'thb_text_domain'),
		'fade' => __('Fade', 'thb_text_domain')
	),

	/**
	 * Slideshow transition speed value option.
	 */
	'speed' => true,

	/**
	 * Slideshow autoplay option.
	 */
	'autoplay' => true,

	/**
	 * Video support.
	 */
	'video' => true
);
$thb_theme->setConfig( 'backpack/slideshow', thb_array_asum( $thb_config, $config ) );

/**
 * Frontend helpers
 * -----------------------------------------------------------------------------
 */
require_once 'helpers.php';

/**
 * Post type operations
 * -----------------------------------------------------------------------------
 */
require_once 'posttype.php';

if( ! function_exists( 'thb_slideshow_localize_script' ) ) {
	/**
	 * Read the page options and make them available for the Javascript side of things
	 */
	function thb_slideshow_localize_script() {
		if ( thb_is_page_template( thb_config( 'backpack/slideshow', 'templates' ) ) ) {
			$localize = apply_filters( 'thb_slideshow_localize_script', array(
				'autoplay'   => (int) thb_is_slideshow_autoplay(),
				'speed'      => (int) thb_get_slideshow_speed(),
				'effect'     => thb_get_slideshow_effect(),
				'num_slides' => count( thb_get_showcase_item_slides() )
			) );

			wp_localize_script( 'jquery', 'thb_slideshow', $localize );
		}
	}

	add_action( 'wp_enqueue_scripts', 'thb_slideshow_localize_script', 11 );
}

if( ! function_exists( 'thb_slideshow' ) ) {
	/**
	 * Display a set of slides or the entry's featured image.
	 *
	 * @param string $size The images size.
	 * @param string $mode
	 * @param string $classes
	 * @param array $data
	 */
	function thb_slideshow( $size = 'full', $mode = 'img', $classes = '', $data = array() ) {
		thb_get_subtemplate( 'backpack/slideshow', dirname(__FILE__), 'slideshow', array(
			'images_size' => $size,
			'mode'        => $mode,
			'classes'     => $classes,
			'data'        => $data
		) );
	}
}

if( ! function_exists( 'thb_slide_caption' ) ) {
	/**
	 * Display a slide's caption.
	 *
	 * @param array $slide The slide data.
	 */
	function thb_slide_caption( $slide ) {
		thb_get_subtemplate( 'backpack/slideshow', dirname(__FILE__), 'slideshow_caption', array(
			'slide' => $slide
		) );
	}
}

if( ! function_exists( 'thb_slide_content' ) ) {
	/**
	 * Display a slide's content.
	 *
	 * @param string $type The slide type.
	 * @param array $data The content data.
	 */
	function thb_slide_content( $type, $data = array() ) {
		thb_get_subtemplate( 'backpack/slideshow', dirname(__FILE__), 'slideshow_slide_' . $type, $data );
	}
}