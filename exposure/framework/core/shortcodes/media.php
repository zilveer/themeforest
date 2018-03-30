<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Media shortcodes.
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
 * Gallery
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_gallery', 'frontend/shortcodes/gallery');
$shortcode->setAttributes(array(
	'link' => 'file',
	'size' => 'thumbnail',
	'gallery_id' => ''
));
$shortcode->setExample('[thb_gallery]');
$shortcode->setLabel( __('Gallery', 'thb_text_domain') );
$shortcode->setType( __('Media', 'thb_text_domain') );
$shortcode->setPrivate();
$thb_theme->addShortcode($shortcode);

/* Remove default gallery inline style */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Audio
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_audio', 'frontend/shortcodes/audio');
$shortcode->setAttributes(array(
	'src'   => ''
));
$shortcode->setExample('[thb_audio src="..."]');
$shortcode->setLabel( __('Audio', 'thb_text_domain') );
$shortcode->setType( __('Media', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Video
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_video', 'frontend/shortcodes/video');
$shortcode->setAttributes(array(
	'url'          => '',
	'ratio'        => '16/9',
	'fixed_height' => '',
	'fixed_width'  => '',
	'controls'     => '1',
	'autoplay'     => '0',
	'loop'         => '0'
));
$shortcode->setExample('[thb_video url="..."]');
$shortcode->setLabel( __('Video', 'thb_text_domain') );
$shortcode->setType( __('Media', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);