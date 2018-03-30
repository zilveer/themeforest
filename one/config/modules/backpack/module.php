<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Backpack.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Backpack
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Module configuration
 * -----------------------------------------------------------------------------
 */
$thb_config = array(
	/**
	 * General
	 */
	'general' => array(),

	/**
	 * Layout
	 */
	'layout' => array(),

	/**
	 * Sidebars
	 */
	'sidebars' => array(),

	/**
	 * Blog
	 */
	'blog' => array(),

	/**
	 * Photogallery
	 */
	'photogallery' => array(),

	/**
	 * Appearance
	 */
	'lightbox' => array(),

	/**
	 * Appearance
	 */
	'appearance' => array(),

	/**
	 * Slideshow
	 */
	'slideshow' => array()
);
$thb_theme->setConfig('backpack', thb_array_asum($thb_config, $config));

/**
 * Bootstrap
 * -----------------------------------------------------------------------------
 */
foreach( thb_config('backpack') as $module => $options ) {
	if( $options !== false ) {
		$thb_theme->loadModule('backpack/' . $module, $options);
	}
}