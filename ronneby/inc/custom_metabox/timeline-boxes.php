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

add_filter( 'cmb_meta_boxes', 'cmb_timeline_boxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_timeline_boxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'crum_timeline_';

    $meta_boxes[] = array(
        'id'         => 'timeline_sub_title',
        'title'      => __('Sub Title', 'dfd'),
        'pages'      => array('timeline'), // Post type 
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => false, // Show field names on the left
        'fields'     => array(
            array(
                'name' => 'Sub Title',
                'desc' => '',
                'id'   => $prefix . 'subtitle',
                'type' => 'text',
                'std'  => '',
            ),
        ),
    );
	
	$meta_boxes[] = array(
        'id'         => 'timeline_icon',
        'title'      => __('Icon', 'dfd'),
        'pages'      => array('timeline'), // Post type 
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => false, // Show field names on the left
        'fields'     => array(
            array(
                'name' => 'Icon',
                'desc' => '',
                'id'   => $prefix . 'icon',
                'type' => 'icon',
                'std'  => '',
            ),
        ),
    );
	
	$meta_boxes[] = array(
        'id'         => 'timeline_date',
        'title'      => __('Date', 'dfd'),
        'pages'      => array('timeline'), // Post type 
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => false, // Show field names on the left
        'fields'     => array(
            array(
                'name' => 'Date',
                'desc' => '',
                'id'   => $prefix . 'date',
                'type' => 'text',
                'std'  => '',
            ),
        ),
    );

    // Add other metaboxes as needed

    return $meta_boxes;
}