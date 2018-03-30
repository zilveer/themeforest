<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Bismuth
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	$prefix = '_portfolio_';

	$meta_boxes[] = array(
		'id'         => 'portf_metabox',
		'title'      => 'Portfolio Project',
		'pages'      => array( 'portfolio', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array( // Text Input
			    'name' => 'Thumbnail', // <label>
			    'desc'  => 'Add the thumbnail of this project', // description
			    'id'    => $prefix . 'thumb', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide Image 1', // <label>
			    'desc'  => 'The first image in the slider, is optional', // description
			    'id'    => $prefix . 'image1', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide Image 2', // <label>
			    'desc'  => 'The second image in the slider, is optional', // description
			    'id'    => $prefix . 'image2', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide Image 3', // <label>
			    'desc'  => 'The third image in the slider, is optional', // description
			    'id'    => $prefix . 'image3', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide 4 image', // <label>
			    'desc'  => 'The fourth image in the slider, is optional', // description
			    'id'    => $prefix . 'image4', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide Image 5', // <label>
			    'desc'  => 'The fifth image in the slider, is optional', // description
			    'id'    => $prefix . 'image5', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Slide Image 6', // <label>
			    'desc'  => 'The sixth image in the slider, is optional', // description
			    'id'    => $prefix . 'image6', // field id and name
			    'type'  => 'file', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Type', // <label>
			    'desc'  => 'The type of your project. Leave empty if not applicable. ', // description
			    'id'    => $prefix . 'type', // field id and name
			    'type'  => 'text', // type of field,
			    ),
			array(
				'name'    => 'Layout type',
				'desc'    => 'The type of your project',
				'id'      => $prefix . 'size',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Big', 'value' => 1, ),
					array( 'name' => 'Medium', 'value' => 2, ),
					array( 'name' => 'Normal', 'value' => 3, ),
					array( 'name' => 'Small', 'value' => 4, ),
				),
				'std' => 3
			),
			array( // Text Input
			    'name' => 'Description', // <label>
			    'desc'  => 'Some description of your project. ', // description
			    'id'    => $prefix . 'description', // field id and name
			    'type'  => 'textarea_small', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Button Text', // <label>
			    'desc'  => 'The text on the call to action button, if applicable. ', // description
			    'id'    => $prefix . 'buttontext', // field id and name
			    'type'  => 'text', // type of field,
			    ),
			array( // Text Input
			    'name' => 'Button URL', // <label>
			    'desc'  => 'The url to button, if applicable. ', // description
			    'id'    => $prefix . 'buttonurl', // field id and name
			    'type'  => 'text', // type of field,
			    ),

		)
	);
	
	
	$prefix = '_page_';

	$meta_boxes[] = array(
		'id'         => 'page_metabox',
		'title'      => 'Page Width Options',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name'    => 'Page Width',
				'desc'    => 'This option only works on pages that are not on the home page (page with can show sidebar)',
				'id'      => $prefix . 'fullwidth',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => 'Full width', 'value' => 1, ),
					array( 'name' => 'With sidebar', 'value' => 2, ),
				),
				'std' => 2
			),
		)
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}