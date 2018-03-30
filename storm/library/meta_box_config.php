<?php
/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'bk_';

global $meta_boxes;

$meta_boxes = array();

// Post Layout Options
$meta_boxes[] = array(
    'id' => "{$prefix}post_fullwidth",
    'title' => __( 'BK Post Option', 'bkninja' ),
    'pages' => array( 'post' ),
    'context' => 'normal',
    'priority' => 'high',

    'fields' => array(
        // Enable Review
        array(
            'name' => __( 'Make this post full-width', 'bkninja' ),
            'id' => "{$prefix}post_fullwidth_checkbox",
            'type' => 'checkbox',
            'std'  => 0,
        ),
    )
);
// Page Layout Options
$meta_boxes[] = array(
    'id' => "{$prefix}page_fullwidth",
    'title' => __( 'BK Page Option', 'bkninja' ),
    'pages' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',

    'fields' => array(
        // Enable Review
        array(
            'name' => __( 'Make this page full-width', 'bkninja' ),
            'id' => "{$prefix}page_fullwidth_checkbox",
            'type' => 'checkbox',
            'std'  => 0,
        ),
    )
);
// 2nd meta box
$meta_boxes[] = array(
    'id' => "{$prefix}format_options",
    'title' => __( 'BK Post Format Options', 'bkninja' ),
    'pages' => array( 'post' ),
    'context' => 'normal',
    'priority' => 'high',
	'fields' => array(        
        //Video
        array(
            'name' => __( 'Format Options: Video, Audio', 'bkninja' ),
            'desc' => __('Support Youtube, Vimeo, SoundCloud, DailyMotion, ... iframe embed code', 'bkninja'),
            'id' => "{$prefix}media_embed_code_post",
            'type' => 'textarea',
            'placeholder' => __('Link ...', 'bkninja'),
            'std' => ''
        ),
		// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
		array(
			'name'             => __( 'Format Options: Image', 'bkninja' ),
            'desc'             => __('Image Upload', 'bkninja'),
			'id'               => "{$prefix}image_upload",
			'type'             => 'plupload_image',
			'max_file_uploads' => 1,
		),
        //Gallery
        array(
            'name' => __( 'Format Options: Gallery', 'bkninja' ),
            'desc' => __('Gallery Images', 'bkninja'),
            'id' => "{$prefix}gallery_content",
            'type' => 'image_advanced',
            'std' => ''
        )
    )
);
// Post Review Options
$meta_boxes[] = array(
    'id' => "{$prefix}review",
    'title' => __( 'BK Review System', 'bkninja' ),
    'pages' => array( 'post' ),
    'context' => 'normal',
    'priority' => 'high',

    'fields' => array(
        // Enable Review
        array(
            'name' => __( 'Include Review Box', 'bkninja' ),
            'id' => "{$prefix}review_checkbox",
            'type' => 'checkbox',
            'desc' => __( 'Enable Review On This Post', 'bkninja' ),
            'std'  => 0,
        ),
        // Criteria 1 Text & Score
        array(
            'name'  => __( 'Criteria 1 Title', 'bkninja' ),
            'id'    => "{$prefix}ct1",
            'type'  => 'text',
        ),
        array(
            'name' => __( 'Criteria 1 Score', 'bkninja' ),
            'id' => "{$prefix}cs1",
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 10,
                'step'  => .1,
            ),
        ),
        // Criteria 2 Text & Score
        array(
            'name'  => __( 'Criteria 2 Title', 'bkninja' ),
            'id'    => "{$prefix}ct2",
            'type'  => 'text',
        ),
        array(
            'name' => __( 'Criteria 2 Score', 'bkninja' ),
            'id' => "{$prefix}cs2",
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 10,
                'step'  => .1,
            ),
        ),    
        // Criteria 3 Text & Score
        array(
            'name'  => __( 'Criteria 3 Title', 'bkninja' ),
            'id'    => "{$prefix}ct3",
            'type'  => 'text',
        ),
        array(
            'name' => __( 'Criteria 3 Score', 'bkninja' ),
            'id' => "{$prefix}cs3",
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 10,
                'step'  => .1,
            ),
        ),
        // Criteria 4 Text & Score
        array(
            'name'  => __( 'Criteria 4 Title', 'bkninja' ),
            'id'    => "{$prefix}ct4",
            'type'  => 'text',
        ),
        array(
            'name' => __( 'Criteria 4 Score', 'bkninja' ),
            'id' => "{$prefix}cs4",
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 10,
                'step'  => .1,
            ),
        ),
        // Criteria 5 Text & Score
        array(
            'name'  => __( 'Criteria 5 Title', 'bkninja' ),
            'id'    => "{$prefix}ct5",
            'type'  => 'text',
        ),
        array(
            'name' => __( 'Criteria 5 Score', 'bkninja' ),
            'id' => "{$prefix}cs5",
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 10,
                'step'  => .1,
            ),
        ),    
        // Criteria 6 Text & Score
        array(
            'name'  => __( 'Criteria 6 Title', 'bkninja' ),
            'id'    => "{$prefix}ct6",
            'type'  => 'text',
        ),
        array(
            'name' => __( 'Criteria 6 Score', 'bkninja' ),
            'id' => "{$prefix}cs6",
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 10,
                'step'  => .1,
            ),
        ),
        // Score
        array(
            'name' => __( 'Author Score', 'bkninja' ),
            'id' => "{$prefix}author_score",
            'type' => 'slider',
            'js_options' => array(
                'min'   => 0,
                'max'   => 10,
                'step'  => .1,
            ),
        ),
        // Summary
        array(
            'name' => __( 'Summary', 'bkninja' ),
            'id'   => "{$prefix}summary",
            'type' => 'textarea',
            'cols' => 20,
            'rows' => 4,
        ),
        
        // Final average
        array(
            'name'  => __('Final Average Score','bkninja'),
            'id'    => "{$prefix}final_score",
            'type'  => 'text',
        ),

    )
);
/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
if ( ! function_exists( 'bk_register_meta_boxes' ) ) {
    function bk_register_meta_boxes() {
    	// Make sure there's no errors when the plugin is deactivated or during upgrade
    	if ( !class_exists( 'RW_Meta_Box' ) )
    		return;
    
    	global $meta_boxes;
    	foreach ( $meta_boxes as $meta_box )
    	{
    		new RW_Meta_Box( $meta_box );
    	}
    }
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'bk_register_meta_boxes' );
