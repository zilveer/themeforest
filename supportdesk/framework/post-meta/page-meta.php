<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_page_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_page_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_st_';

	
	$meta_boxes[] = array(
		'id'         => 'page_options',
		'title'      => 'Page Options',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Page Tagline',
				'desc' => 'Add a tagline below the page title.',
				'id'   => $prefix . 'page_tagline',
				'type' => 'text',
			),
			array(
				'name' => 'Disable Breadcrumbs?',
				'desc' => 'Check this box to disable the breadcrumbs.',
				'id'   => $prefix . 'page_breadcrumbs',
				'type' => 'checkbox',
			),
			array(
				'name'    => 'Sidebar Position',
				'desc'    => 'Adjust the position of the sidebar.',
				'id'      => $prefix . 'page_sidebar',
				'type'    => 'select',
				'options' => array(
					array( 'name' => 'Left', 'value' => 'left', ),
					array( 'name' => 'Right', 'value' => 'right', ),
					array( 'name' => 'Off', 'value' => 'off', ),
				),
				'std'     => 'right',
			),
		),

		
	);
	

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
