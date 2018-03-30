<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Slideshow.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Slideshow
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Module libraries
 * -----------------------------------------------------------------------------
 */

/**
 * Including the Slideshow class that's entitled to grab a collection of slides.
 */
include dirname(__FILE__) . '/lib.php';

/**
 * Including the file with the means to the creation of a Slideshow custom post
 * type. Also in this file, are the functions that allow for the creation of
 * a Slideshow metabox in selected templates, and the relative shortcode.
 */
include dirname(__FILE__) . '/posttype.php';

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * Enables the creation of a Slideshows custom post type.
	 */
	'post_type' => false,

	/**
	 * A list of submodules to be loaded, with their own configuration.
	 */
	'submodules' => array(),

	/**
	 * Page templates that implement the Slideshow functionality.
	 */
	'templates' => array(),

	/**
	 * Slideshow types.
	 */
	'types' => array()
);
$thb_theme->setConfig( 'core/slideshows', thb_array_asum($thb_config, $config) );

/**
 * Submodules
 * -----------------------------------------------------------------------------
 */
if( !empty($config['submodules']) ) {
	foreach( $config['submodules'] as $submodule => $submodule_config ) {
		$thb_theme->loadModule('core/slideshows/submodules/' . $submodule, $submodule_config);
	}
}

/**
 * Module bootstrap
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_slideshows_boot') ) {
	/**
	 * Bootstrap the Slideshow base component.
	 *
	 * @return void
	 */
	function thb_slideshows_boot() {
		$config = thb_config('core/slideshows');

		/**
		 * Running filters on the Slideshow control points options.
		 */
		$config['templates'] = apply_filters('thb_slideshows_templates', $config['templates']);

		/**
		 * If the Slideshows custom post type needs to be created, call the
		 * procedure to create it, alongside with the relative shortcode,
		 * and metabox in the page templates specified.
		 */
		if( $config['post_type'] == true ) {
			// Create the Slideshow custom post type
			thb_create_slideshows_posttype();

			// Create the Slideshow shortcode
			thb_create_slideshows_shortcode();

			if( !empty($config['templates']) ) {
				thb_add_entry_slideshow_metabox($config['templates']);
			}
		}
	}

	add_action('after_setup_theme', 'thb_slideshows_boot');
}

/**
 * Scripts and styles
 * -----------------------------------------------------------------------------
 */
$thb_slideshows = thb_get_module_url('core/slideshows');

$thb_theme->getAdmin()->addStyle($thb_slideshows . '/css/admin.css');
$thb_theme->getAdmin()->addScript( $thb_slideshows . '/js/admin-views.js', array('jquery', 'backbone') );

/**
 * Slideshow body class
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_slideshow_body_class') ) {
	function thb_slideshow_body_class( $classes ) {
		$config = thb_config('core/slideshows');
		$page_id = thb_get_page_ID();

		if( thb_is_page_template($config['templates']) ) {
			$slideshow = thb_get_post_meta($page_id, 'slideshow');

			if( !empty($slideshow) && trim($slideshow) != '' ) {
				$classes[] = 'w-slideshow';
			}
		}

		return $classes;
	}

	add_filter('body_class', 'thb_slideshow_body_class');
}

/**
 * Slideshow hook
 * -----------------------------------------------------------------------------
 */
if( !function_exists('thb_slideshow') ) {
	function thb_slideshow() {

		// $config = thb_config('core/slideshows');
		$page_id = thb_get_page_ID();
		$slideshow_shortcode = thb_get_post_meta($page_id, 'slideshow');

		if( empty($slideshow_shortcode) ) {
			return;
		}

		if( thb_text_contains($slideshow_shortcode, 'thb_') ) {
			$slideshow_id = thb_get_shortcode_attribute($slideshow_shortcode, 'id');
			$thb_slideshow = new THB_Slideshow($slideshow_id);
			$slideshow_type = $thb_slideshow->getType();

			if( thb_is_page_template(thb_config('core/slideshows/submodules/' . $slideshow_type, 'templates')) ) {
				if( !empty($slideshow_shortcode) && trim($slideshow_shortcode) != '' ) {
					echo thb_do_shortcode($slideshow_shortcode);
				}
			}
		}
		else {
			echo thb_do_shortcode($slideshow_shortcode);
		}
	}

	add_action('thb_slideshow_start', 'thb_slideshow');
}