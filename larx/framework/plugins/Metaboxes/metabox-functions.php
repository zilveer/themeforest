<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';


	$meta_boxes['test_metabox'] = array(
		'id'         => 'test_metabox',
		'title'      => __( 'Page Settings', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'low',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name' => __( 'Alternate page title', 'cmb' ),
				'desc' => __( 'Set alternate page title', 'cmb' ),
				'id'   => $prefix . 'alternate_title',
				'type' => 'text_medium',
			),
            array(
                'name' => 'Background image',
                'id'   => 'alternate_background',
                'type' => 'file',
                'desc' => __( 'Upload your custom header background parallax image', 'cmb' ),
            ),
			array(
                'name' => __( 'Overlay for header image', 'cmb' ),
                'desc' => __( 'If is checked, this options will add overlay for header background image', 'cmb' ),
                'id'   => $prefix . 'overlay_background',
                'type' => 'checkbox',
            ),
            array(
                'name'    => __( 'Main menu style', 'cmb' ),
                'desc'    => __( 'Choose a style for your menu', 'cmb' ),
                'id'      => $prefix . 'menu_style',
                'type'    => 'select',
                'options' => array(
                    'default' => __( 'Default set in Theme Options', 'cmb' ),
                    'top' => __( 'Top Navbar', 'cmb' ),
                    'bottom'   => __( 'Bottom Navbar', 'cmb' ),
                    'canvas'     => __( 'Canvas Navbar', 'cmb' ),
                ),
            ),
            array(
                'name'    => __( 'Theme style', 'cmb' ),
                'desc'    => __( 'Choose a style for your theme', 'cmb' ),
                'id'      => $prefix . 'theme_style',
                'type'    => 'select',
                'options' => array(
                    'default' => __( 'Default set in Theme Options', 'cmb' ),
                    'white' => __( 'White', 'cmb' ),
                    'dark'   => __( 'Dark', 'cmb' ),
                ),
            ),
            array(
                'name'    => __( 'Sidebar Position', 'cmb' ),
                'desc'    => __( 'Choose layout for this post', 'cmb' ),
                'id'      => $prefix . 'post_sidebar_layout',
                'type'    => 'select',
                'options' => array(
                    'default' => __( 'Default set in Theme Options', 'cmb' ),
                    'fullwidth' => __( 'Fullwidth', 'cmb' ),
                    'sidebar_left'   => __( 'Sidebar Left', 'cmb' ),
                    'sidebar_right'     => __( 'Sidebar Right', 'cmb' ),
                ),
            ),
		),
	);

    $meta_boxes['post_metabox'] = array(
        'id'         => 'post_metabox',
        'title'      => __( 'Page Settings', 'cmb' ),
        'pages'      => array( 'post', ), // Post type
        'context'    => 'normal',
        'priority'   => 'low',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name'    => __( 'Sidebar Position', 'cmb' ),
                'desc'    => __( 'Choose layout for this post', 'cmb' ),
                'id'      => $prefix . 'post_sidebar_layout',
                'type'    => 'select',
                'options' => array(
                    'default' => __( 'Default set in Theme Options', 'cmb' ),
                    'fullwidth' => __( 'Fullwidth', 'cmb' ),
                    'sidebar_left'   => __( 'Sidebar Left', 'cmb' ),
                    'sidebar_right'     => __( 'Sidebar Right', 'cmb' ),
                ),
            ),
            array(
                'name'    => __( 'Theme style', 'cmb' ),
                'desc'    => __( 'Choose a style for this post', 'cmb' ),
                'id'      => $prefix . 'theme_style',
                'type'    => 'select',
                'options' => array(
                    'default' => __( 'Default set in Theme Options', 'cmb' ),
                    'white' => __( 'White', 'cmb' ),
                    'dark'   => __( 'Dark', 'cmb' ),
                ),
            ),
        ),
    );

    /* Portfolio*/
    $meta_boxes['single_field_group'] = array(
        'id'         => 'single_project_setup',
        'title'      => __( 'Single Project Page Setup', 'cmb' ),
        'pages'      => array( 'portfolio', ),
        //'context' => 'side', //  'normal', 'advanced', or 'side'
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name'         => __( 'Gallery Images', 'cmb' ),
                'desc'         => __( 'Upload images for the project gallery. They will appear only on single project page.', 'cmb' ),
                'id'           => $prefix . 'project_gallery_images',
                'type'         => 'file_list',
                'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
            ),
            array(
                'name' => __( 'Wrap images in a slider', 'cmb' ),
                'desc' => __( 'If is checked, Gallery Images will be displayed in slder', 'cmb' ),
                'id'   => $prefix . 'project_is_slider',
                'type' => 'checkbox',
            ),
            array(
                'name' => __( 'Thumbnail in gallery', 'cmb' ),
                'desc' => __( 'If is checked, the project thumbnail will be include in Gallery Images', 'cmb' ),
                'id'   => $prefix . 'project_is_thumb_include',
                'type' => 'checkbox',
            ),
            array(
                'name' => 'Background image',
                'id'   => 'project_alter_bg',
                'type' => 'file',
                'desc' => __( 'Upload your custom header background parallax image', 'cmb' ),
            ),
        ),
    );

    /**
     * Aditional project description
     */
    $meta_boxes['field_group'] = array(
        'id'         => 'project_description',
        'title'      => __( 'Aditional Project Description', 'cmb' ),
        'pages'      => array( 'portfolio', ),
        'priority'   => 'default',
        'fields'     => array(
            array(
                'id'          => $prefix . 'projects-custom-fields',
                'type'        => 'group',
                //'description' => __( 'Generates reusable form entries', 'cmb' ),
                'options'     => array(
                    'group_title'   => __( 'Entry {#}', 'cmb' ), // {#} gets replaced by row number
                    'add_button'    => __( 'Add Another Entry', 'cmb' ),
                    'remove_button' => __( 'Remove Entry', 'cmb' ),
                    'sortable'      => true, // beta
                ),
                // Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
                'fields'      => array(
                    array(
                        'name' => 'Entry Title',
                        'id'   => 'title',
                        'type' => 'text',
                        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
                    ),
                    array(
                        'name' => 'Description',
                        'description' => 'Write a short description for this entry',
                        'id'   => 'description',
                        'type' => 'textarea_small',
                    ),
                ),
            ),
        ),
    );


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