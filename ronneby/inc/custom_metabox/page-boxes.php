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

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'crum_page_custom_';

    $meta_boxes[] = array(
        'id'         => 'blog_params',
        'title'      => __('Select Blog parameters', 'dfd'),
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_on' => array( 'key' => 'page-template', 'value' => array( 'posts-sidebar-sel.php' ) ),
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => __('Select blog page layout', 'dfd'),
                'desc' => __('You can select layout for current blog page', 'dfd'),
                'id'   => 'blog_layout_select',
                'type' => 'radio_inline',
                'options' => array(
                    array( 'name' => __('Default', 'dfd'), 'value' => '', ),
                    array( 'name' => __('No sidebars', 'dfd'), 'value' => '1col-fixed', ),
                    array( 'name' => __('Sidebar on left', 'dfd'), 'value' => '2c-l-fixed', ),
                    array( 'name' => __('Sidebar on right', 'dfd'), 'value' => '2c-r-fixed', ),
                    array( 'name' => __('2 left sidebars', 'dfd'), 'value' => '3c-l-fixed', ),
                    array( 'name' => __('2 right sidebars', 'dfd'), 'value' => '3c-r-fixed', ),
                    array( 'name' => __('Sidebar on either side', 'dfd'), 'value' => '3c-fixed', ),
                ),
            ),
            array(
                'name' => __('Display posts of certain category?', 'dfd'),
                'desc' => __('Check, if you want to display posts from a certain category', 'dfd'),
                'id'   => 'blog_sort_category',
                'type' => 'checkbox'
            ),
            array(
                'name' => __('Blog Category', 'dfd'),
                'desc'	=> __('Select blog category', 'dfd'),
                'id'	=> 'blog_category',
                'taxonomy' => 'category',
                'type' => 'taxonomy_multicheck',
            ),
            array (
                'name' => __('Number of posts to display', 'dfd'),
                'desc'	=> '',
                'id'	=> 'blog_number_to_display',
                'type'	=> 'text'
            ),
			array(
                'name'    => __('Layout width', 'dfd'),
                'desc'    => '',
                'id'      => $prefix . 'lay_width',
                'type'    => 'select',
                'options' => array(
                    array(
						'name' => __('Boxed', 'dfd'),
						'value' => 'boxed',
					),
                    array(
						'name' => __('Fullwidth', 'dfd'),
						'value' => 'full-width-offset',
					),
                ),
            ),
        ),
    );
	
    $meta_boxes[] = array(
        'id'         => 'masonry_blog_params',
        'title'      => __('Select Blog parameters', 'dfd'),
        'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_on' => array(
			'key' => 'page-template',
			'value' => array(
				//'posts-sidebar-sel.php',
				'tmp-posts-grid-2-left-side.php',
				'tmp-posts-grid-2-right-sidebar.php',
				'tmp-posts-grid-2.php',
				'tmp-posts-grid-3-left-sidebar-fullwidth.php',
				'tmp-posts-grid-3-left-sidebar.php',
				'tmp-posts-grid-3-right-sidebar-fullwidth.php',
				'tmp-posts-grid-3-right-sidebar.php',
				'tmp-posts-grid-3.php',
				'tmp-posts-grid-4-fullwidth.php',
				'tmp-posts-grid-4.php',
				'tmp-posts-left-img.php',
				'tmp-posts-masonry-2-left-side.php',
				'tmp-posts-masonry-2-side.php',
				'tmp-posts-masonry-2.php',
				'tmp-posts-masonry-3-left-sidebar.php',
				'tmp-posts-masonry-3-left-sidebar-fullwidth.php',
				'tmp-posts-masonry-3-right-sidebar.php',
				'tmp-posts-masonry-3-right-sidebar-fullwidth.php',
				'tmp-posts-masonry-3.php', 
				'tmp-posts-masonry-4.php', 
				'tmp-posts-masonry-4-fullwidth.php', 
				'tmp-posts-right-img.php',
				'tmp-news-layout.php',
			),
		),
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => __('Display posts of certain category?', 'dfd'),
                'desc' => __('Check, if you want to display posts from a certain category', 'dfd'),
                'id'   => 'blog_sort_category',
                'type' => 'checkbox'
            ),
            array(
                'name' => __('Blog Category', 'dfd'),
                'desc'	=> __('Select blog category', 'dfd'),
                'id'	=> 'blog_category',
                'taxonomy' => 'category',
                'type' => 'taxonomy_multicheck',
            ),
            array (
                'name' => __('Number of posts to display', 'dfd'),
                'desc'	=> '',
                'id'	=> 'blog_number_to_display',
                'type'	=> 'text'
            ),
			array(
                'name' => __('Save image ratio for thumbnails', 'dfd'),
                'desc' => '',
                'id'   => 'save_image_ratio',
                'type' => 'checkbox'
            ),
        ),
    );
	
	$meta_boxes[] = array(
		'id' => $prefix . 'pagination_type',
		'title' => __('Pagination type', 'dfd'),
		'pages'      => array( 'page', ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_on' => array(
			'key' => 'page-template',
			'value' => array(
				'tmp-posts-masonry-2-left-side.php',
				'tmp-posts-masonry-2-side.php',
				'tmp-posts-masonry-2.php',
				//'tmp-news-layout.php',
				'tmp-posts-masonry-3-left-sidebar.php',
				'tmp-posts-masonry-3-left-sidebar-fullwidth.php',
				'tmp-posts-masonry-3-right-sidebar.php',
				'tmp-posts-masonry-3-right-sidebar-fullwidth.php',
				'tmp-posts-masonry-3.php',
				'tmp-posts-masonry-4.php',
				'tmp-posts-masonry-4-fullwidth.php',
				'tmp-portfolio.php',
				'tmp-blog.php',
				'tmp-gallery.php',
			),
		),
		'show_names' => true,
		'fields' => array(
			array(
				'name' => __('Pagination type', 'dfd'),
				'desc' => '',
				'id' => 'dfd_pagination_type',
				'type' => 'select',
				'std' => 'default',
				'options' => array(
					array(
						'name' => __('Default', 'dfd'),
						'value' => 'default',
					),
					array(
						'name' => __('Ajax', 'dfd'),
						'value' => '1'
					),
					array(
						'name' => __('Lazy load', 'dfd'),
						'value' => '2'
					),
				),
			),
			array(
				'name' => __('Pagination style', 'dfd'),
				'desc' => '',
				'id' => 'dfd_pagination_style',
				'type' => 'select',
				'std' => '0',
				'options' => array(
					array(
						'name' => __('Inherit from theme options', 'dfd'),
						'value' => '',
					),
					array(
						'name' => __('Style 1', 'dfd'),
						'value' => '1'
					),
					array(
						'name' => __('Style 2', 'dfd'),
						'value' => '2'
					),
					array(
						'name' => __('Style 3', 'dfd'),
						'value' => '3'
					),
					array(
						'name' => __('Style 4', 'dfd'),
						'value' => '4'
					),
					array(
						'name' => __('Style 5', 'dfd'),
						'value' => '5'
					),
				),
				'dep_option'    => 'dfd_pagination_type',
				'dep_values'    => 'default',
			),
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'page_bg_metabox',
		'title'      => __('Page options', 'dfd'),
		'pages'      => array('page','post','my-product','product','gallery'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
	            'name' => __('Background color', 'dfd'),
	            'desc' => __('Color of body of page (page will be set to boxed)', 'dfd'),
	            'id'   => $prefix . 'bg_color',
	            'type' => 'colorpicker',
				'std'  => '#ffffff'
	        ),
            array(
                'name' => __('Fixed backrgound', 'dfd'),
                'desc' => __('Check if you want to bg will be fixed on page scroll', 'dfd'),
                'id'   => $prefix . 'bg_fixed',
                'type' => 'checkbox',
            ),
			array(
				'name' => __('Background image', 'dfd'),
				'desc' => __('Upload an image or enter an URL.', 'dfd'),
				'id'   => $prefix . 'bg_image',
				'type' => 'file',
			),
            array(
                'name'    => __('Background image repeat', 'dfd'),
                'desc'    => '',
                'id'      => $prefix . 'bg_repeat',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => __('All', 'dfd'), 'value' => 'repeat', ),
                    array( 'name' => __('Horizontally', 'dfd'), 'value' => 'repeat-x', ),
                    array( 'name' => __('Vertically', 'dfd'), 'value' => 'repeat-y', ),
                    array( 'name' => __('No-Repeat', 'dfd'), 'value' => 'no-repeat', ),
                ),
            ),
			array(
				'name' => esc_attr__( 'Enable white space', 'dfd' ),
				'desc' => '',
				'id'   => 'dfd_enable_page_spacer',
				'type' => 'checkbox',
			),
			array(
				'name' => esc_attr__( 'Parallax footer', 'dfd' ),
				'desc' => esc_attr__( 'Please check this checkbox if you would like to enable parallax effect for footer section', 'dfd' ),
				'id'   => 'crum_page_custom_footer_parallax',
				'type' => 'checkbox',
			),
		),
	);


    $meta_boxes[] = array(
        'id'         => 'top_text_fields',
        'title'      => __('Block before content', 'dfd'),
        'pages'      => array( 'page', ), // Post type
        'show_on'    => array('key' => 'page-template', 'value' => 'large-right-aside.php'),
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => __('Text block ( shortcodes will work here )', 'dfd'),
                'id' =>   '_top_page_text',
                'type' => 'wysiwyg',
                'options' => array(
                    'wpautop' => false, // use wpautop?
                    'media_buttons' => false, // show insert/upload button(s)
                    'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
                    'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
                    'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                    'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                ),
                'std' => ''
            ),
        ),
    );
	
    $meta_boxes[] = array(
        'id'         => 'top_text_fields',
        'title'      => __('Block after content', 'dfd'),
        'pages'      => array( 'page', ), // Post type
        'show_on'    => array('key' => 'page-template', 'value' => 'tmp-news-layout.php'),
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => __('Text block ( shortcodes will work here )', 'dfd'),
                'id' =>   'after_content_shortcode',
                'type' => 'wysiwyg',
                'options' => array(
                    'wpautop' => false, // use wpautop?
                    'media_buttons' => false, // show insert/upload button(s)
                    'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
                    'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
                    'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                    'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                ),
                'std' => ''
            ),
        ),
    );

	// Add other metaboxes as needed

	return $meta_boxes;
}
