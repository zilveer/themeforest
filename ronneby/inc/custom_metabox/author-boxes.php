<?php

/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter('cmb_meta_boxes', 'dfd_author_metaboxes');

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function dfd_author_metaboxes(array $meta_boxes) {


	// Start with an underscore to hide fields from custom fields list
	$prefix = 'author_';

	$meta_boxes[] = array(
		'id' => 'portfolio-page-options',
		'title' => __('Set author parameters', 'dfd'),
		'pages' => array('author','dfd-author',), // Post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Author name', 'dfd'),
				'desc' => __('', 'dfd'),
				'id' => 'dfd_author_name',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
			array(
				'name' => __('Author info', 'dfd'),
				'desc' => __('', 'dfd'),
				'id' => 'dfd_author_subtitle',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
			array(
				'name' => __('Author Facebook url', 'dfd'),
				'desc' => __('', 'dfd'),
				'id' => 'dfd_author_facebook',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
			array(
				'name' => __('Author Twitter url', 'dfd'),
				'desc' => __('', 'dfd'),
				'id' => 'dfd_author_twitter',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
			array(
				'name' => __('Author Google + url', 'dfd'),
				'desc' => __('', 'dfd'),
				'id' => 'dfd_author_google',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
			array(
				'name' => __('Author Skype url', 'dfd'),
				'desc' => __('', 'dfd'),
				'id' => 'dfd_author_linkedin',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
			array(
				'name' => __('Author Flickr url', 'dfd'),
				'desc' => __('', 'dfd'),
				'id' => 'dfd_author_flickr',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
			array(
				'name' => __('Author Vimeo page url', 'dfd'),
				'desc' => __('', 'dfd'),
				'id' => 'dfd_author_vimeo',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
			array(
				'name' => __('Author Instagram page url', 'dfd'),
				'desc' => __('', 'dfd'),
				'id' => 'dfd_author_instagram',
				'type' => 'text',
				'save_id' => false, // save ID using true
				'std' => ''
			),
		),
	);

	return $meta_boxes;
}
