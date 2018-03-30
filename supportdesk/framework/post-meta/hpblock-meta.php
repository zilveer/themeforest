<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_hpblock_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_hpblock_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_st_';

	
	$meta_boxes[] = array(
		'id'         => 'hpblock_meta',
		'title'      => 'Block Options',
		'pages'      => array( 'st_hpblock', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => 'Block Icon',
				'desc' => 'Upload an image or enter an URL.',
				'id' => $prefix . 'hpblock_icon',
				'type' => 'file',
			),
			array(
				'name' => 'Block Text',
				'desc' => 'The text below the block heading (optional)',
				'id' => $prefix . 'hpblock_text',
				'type' => 'wysiwyg',
				'options' => array(	'textarea_rows' => 5, ),
				),
			array(
				'name' => 'Block Link',
				'desc' => 'Link the block heading & icon (optional)',
				'id' => $prefix . 'hpblock_link',
				'type' => 'text_medium',
				),
		),
		
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
