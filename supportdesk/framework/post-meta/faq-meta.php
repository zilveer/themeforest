<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_faq_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_faq_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_st_';

	
	$meta_boxes[] = array(
		'id'         => 'faq_options',
		'title'      => 'FAQ Options',
		'pages'      => array( 'st_faq', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Page Tagline',
				'desc' => 'Add a tagline below the page title.',
				'id'   => $prefix . 'faq_tagline',
				'type' => 'text',
			),
			array(
				'name' => 'Disable Breadcrumbs?',
				'desc' => 'Check this box to disable the breadcrumbs.',
				'id'   => $prefix . 'faq_breadcrumbs',
				'type' => 'checkbox',
			),

		),

		
	);
	

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
