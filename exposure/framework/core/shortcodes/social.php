<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Core social shortcodes.
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
 * Flickr
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_flickr', 'frontend/shortcodes/flickr');
$shortcode->setAttributes(array(
	'id'  => '',
	'num'   => 3,
	'title' => ''
));
$shortcode->setExample('[thb_flickr id="..." num="3"]');
$shortcode->setLabel( __('Flickr', 'thb_text_domain') );
$shortcode->setType( __('Social', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Twitter
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_twitter', 'frontend/shortcodes/twitter');
$shortcode->setAttributes(array(
	'user'  => '',
	'num'   => 3,
	'title' => ''
));
$shortcode->setExample('[thb_twitter user="..." num="3"]');
$shortcode->setLabel( __('Twitter', 'thb_text_domain') );
$shortcode->setType( __('Social', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);