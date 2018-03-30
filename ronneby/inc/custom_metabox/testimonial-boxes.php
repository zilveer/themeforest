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

add_filter( 'cmb_meta_boxes', 'crum_testimonial_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */

function crum_testimonial_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'testimonial_custom_';

	$meta_boxes[] = array(
		'id'         => 'testimonial_custom_fields',
		'title'      => __('Testimonial info', 'dfd'),
		'pages'      => array('testimonials'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
            array(
                'name' => __('Author of testimonial', 'dfd'),
                'desc'	=> '',
                'id'	=> 'crum_testimonial_autor',
                'type'	=> 'text'
            ),
            array(
                'name' => __('Author additional', 'dfd'),
                'desc'	=> '',
                'id'	=> 'crum_testimonial_additional',
                'type'	=> 'text'
            )
		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}
