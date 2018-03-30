<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Core utility shortcodes.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Core\Shortcodes
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_theme = thb_theme();

/**
 * Map
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_map', 'frontend/shortcodes/map');
$shortcode->setAttributes(array(
	'height'  => 200,
	'width'   => '',
	'latlong' => '10,10',
	'zoom'    => 10,
	'marker'  => '',
	'type'    => 'ROADMAP',
	'import'  => 1
));
$shortcode->setExample('[thb_map latlong="..." height="300"]');
$shortcode->setLabel( __('Google Map', 'thb_text_domain') );
$shortcode->setType( __('Utility', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);