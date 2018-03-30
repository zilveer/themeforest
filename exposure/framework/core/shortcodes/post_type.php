<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Core post type shortcodes.
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
 * Latest posts
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_latest_posts', 'frontend/shortcodes/list-posts');
$shortcode->setLoopAttributes(array(
	'paged' => 1
));
$shortcode->setAttributes(array(
	'title' => __('Latest posts', 'thb_text_domain'),
	'num'   => 3,
	'thumb' => 0,
	'thumb_size' => 'micro'
));
$shortcode->setExample('[thb_latest_posts num="3"]');
$shortcode->setLabel( __('Latest posts', 'thb_text_domain') );
$shortcode->setType( __('Content', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Popular posts
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_popular_posts', 'frontend/shortcodes/list-posts');
$shortcode->setLoopAttributes(array(
	'paged' => 1,
	'orderby' => 'comment_count',
	'order' => 'desc'
));
$shortcode->setAttributes(array(
	'title' => __('Popular posts', 'thb_text_domain'),
	'num' => 3,
	'thumb' => 0,
	'thumb_size' => 'micro'
));
$shortcode->setExample('[thb_popular_posts num="3"]');
$shortcode->setLabel( __('Popular posts', 'thb_text_domain') );
$shortcode->setType( __('Content', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Posts from a category
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_category_posts', 'frontend/shortcodes/list-posts');
$shortcode->setLoopAttributes(array(
	'paged' => 1,
	'cat' => 0
));
$shortcode->setAttributes(array(
	'title' => __('Posts from a category', 'thb_text_domain'),
	'num' => 3,
	'thumb' => 0,
	'thumb_size' => 'micro'
));
$shortcode->setExample('[thb_category_posts num="3" cat="1"]');
$shortcode->setLabel( __('Posts from a category', 'thb_text_domain') );
$shortcode->setType( __('Content', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Related posts
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_related_posts', 'frontend/shortcodes/list-posts');
$shortcode->setLoopAttributes(array(
	'paged' => 1
));
$shortcode->setDynamicLoopAttributes('thb_related_posts_query');
$shortcode->setAttributes(array(
	'title' => __('Related posts', 'thb_text_domain'),
	'num'   => 3,
	'thumb' => 0,
	'thumb_size' => 'micro'
));
$shortcode->setExample('[thb_related_posts num="3"]');
$shortcode->setLabel( __('Related posts', 'thb_text_domain') );
$shortcode->setType( __('Content', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Custom tag cloud
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_tag_cloud', 'frontend/shortcodes/tagcloud');
$shortcode->setAttributes(array(
	'title' => __('Custom tag cloud', 'thb_text_domain'),
	'num' => 0,
	'tax' => 'post_tag',
	'orderby' => 'name',
	'order' => 'asc'
));
$shortcode->setExample('[thb_tag_cloud]');
$shortcode->setLabel( __('Tag cloud', 'thb_text_domain') );
$shortcode->setType( __('Content', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);

/**
 * Single page
 * -----------------------------------------------------------------------------
 */
$shortcode = new THB_Shortcode('thb_page', 'frontend/shortcodes/single');
$shortcode->setLoopAttributes(array(
	'posts_per_page' => 1,
	'post_type' => 'page',
	'page_id' => 0
));
$shortcode->setAttributes(array(
	'thumb' => 0
));
$shortcode->setExample('[thb_page id="1"]');
$shortcode->setLabel( __('Page', 'thb_text_domain') );
$shortcode->setType( __('Content', 'thb_text_domain') );
$thb_theme->addShortcode($shortcode);