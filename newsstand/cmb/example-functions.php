<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

function cmb_get_post_options() {

    $args = wp_parse_args( array(
        'post_type' => 'post',
        'numberposts' => 30,
        'posts_per_age' => 30
    ) );

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
            $post_options[ $post->ID ] = $post->post_title;
        }
    }

    return $post_options;
}

function cmb_get_categories() {

    $args = array(
    	'type'                     => 'post',
    );

    $categories = get_categories( $args );

    $cat_options = array();
    if ( $categories ) {
        foreach ( $categories as $cat ) {
            $cat_options[ $cat->cat_ID ] = $cat->cat_name;
        }
    }
    return $cat_options;
}

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'newsstand_';

	// <a href="http://411posters.com/wp-content/uploads/2012/08/taylor-breaking-bad1.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$img_src = "http://avathemes.co/WP/Newsstand_images/";
	$meta_boxes['home_1_opts'] = array(
		'id'         => 'home_1_opts',
		'title'      => __( 'Home Options', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/home-1.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
			    'name' => 'Block 1',
			    'desc' => '<a href="'.$img_src.'home1_block1.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
			    'type' => 'title',
			    'id' => $prefix . 'test_title'
			),
			array(
			    'name'    => 'Show',
			    'desc'    => 'Select an option',
			    'id'      => $prefix . 'block_1_show',
			    'type'    => 'select',
			    'options' => array(
			        'latest' => __( 'Latest Posts', 'cmb2' ),
			        'mostpopular'   => __( 'Most Popular', 'cmb2' ),
			        'category'     => __( 'From Category', 'cmb2' ),
			    ),
			    'default' => 'custom',
			),

			array(
		        'name'     => __( 'Posts from what Category?', 'cmb' ),
		        'desc'     => __( '', 'cmb' ),
		        'id'      => $prefix . 'block_1_category',
		        'type'    => 'select',
		        'options' => cmb_get_categories(),
		    ),

			array(
			    'name' => 'Block 2 (Editors Pick)',
			    'desc' => '<a href="'.$img_src.'home1_block2.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
			    'type' => 'title',
			    'id' => $prefix . 'test_title'
			),
			array(
		        'name'    => 'Editors Pick (Listed Latest 30 posts)',
		        'desc'    => '',
		        'id'      => $prefix . 'editors_pick',
		        'type'    => 'multicheck',
		        'options' => cmb_get_post_options(),
		    ),


		    array(
		        'name' => 'Block 3 (Events Section)',
		        'desc' => '<a href="'.$img_src.'home1_block3.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
		        'type' => 'title',
		        'id' => $prefix . 'test_title'
		    ),
		    array(
		        'name' => 'Display Events Section',
		        'id' => $prefix . 'show_events',
		        'type' => 'checkbox'
		    ),

		    array(
		        'name' => 'Block 4 (Posts Section)',
		        'desc' => '<a href="'.$img_src.'home1_block4.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
		        'type' => 'title',
		        'id' => $prefix . 'test_title'
		    ),
	    	array(
	            'name'     => __( 'Posts from what Category?', 'cmb' ),
	            'desc'     => __( '', 'cmb' ),
	            'id'       => $prefix . 'block_4_category',
	            'type'    => 'select',
	            'options' => cmb_get_categories(),
	        ),

		    array(
		        'name' => 'Block 5 (Upcoming Events Section)',
		        'desc' => '<a href="'.$img_src.'home1_block5.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
		        'type' => 'title',
		        'id' => $prefix . 'test_title'
		    ),
		    array(
		        'name' => 'Display Upcoming Events Section',
		        'id' => $prefix . 'show_upcomingevents',
		        'type' => 'checkbox'
		    ),

		    array(
		        'name' => 'Block 6 (Posts from Category)',
		        'desc' => '<a href="'.$img_src.'home1_block6.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
		        'type' => 'title',
		        'id' => $prefix . 'test_title'
		    ),
		    array(
		        'name' => 'Display This Section?',
		        'id' => $prefix . 'show_b6',
		        'type' => 'checkbox'
		    ),
	    	array(
	            'name'     => __( 'Posts from what Category?', 'cmb' ),
	            'desc'     => __( '', 'cmb' ),
	            'id'       => $prefix . 'block_6_category',
	            'type'    => 'select',
	            'options' => cmb_get_categories(),
	        ),

		    array(
		        'name' => 'Block 7 (Posts from Category)',
		        'desc' => '<a href="'.$img_src.'home1_block7.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
		        'type' => 'title',
		        'id' => $prefix . 'test_title'
		    ),
		    array(
		        'name' => 'Display This Section?',
		        'id' => $prefix . 'show_b7',
		        'type' => 'checkbox'
		    ),
	    	array(
	            'name'     => __( 'Posts from what Category?', 'cmb' ),
	            'desc'     => __( '', 'cmb' ),
	            'id'       => $prefix . 'block_7_category',
	            'type'    => 'select',
	            'options' => cmb_get_categories(),
	        ),
		),
	);

	$meta_boxes['home_2_opts'] = array(
		'id'         => 'home_2_opts',
		'title'      => __( 'Home Options', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/home-2.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
			    'name' => 'Banner 1',
			    'desc' => '<a href="'.$img_src.'home2_block1.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
			    'type' => 'title',
			    'id' => $prefix . 'test_title'
			),
			array(
			    'name' => 'Banner Image',
			    'desc' => 'Upload an image or enter an URL.',
			    'id' => $prefix . 'banner_1_image',
			    'type' => 'file',
			    'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
			),
			array(
		        'name' => 'Banner Link',
		        'desc' => '',
		        'id' => $prefix . 'banner_1_link',
		        'type' => 'text_url'
		    ),

	    	array(
	    	    'name' => 'Banner 2',
	    	    'desc' => '<a href="'.$img_src.'home2_block2.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	    	    'type' => 'title',
	    	    'id' => $prefix . 'test_title'
	    	),
	    	array(
	    	    'name' => 'Banner Image',
	    	    'desc' => 'Upload an image or enter an URL.',
	    	    'id' => $prefix . 'banner_2_image',
	    	    'type' => 'file',
	    	    'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
	    	),
	    	array(
	            'name' => 'Banner Link',
	            'desc' => '',
	            'id' => $prefix . 'banner_2_link',
	            'type' => 'text_url'
	        ),

			array(
			    'name' => 'Block Other News',
			    'desc' => '<a href="'.$img_src.'home2_block3.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
			    'type' => 'title',
			    'id' => $prefix . 'test_title'
			),
	        array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_othernews_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),

	    	array(
	    	    'name' => 'Block Newsletter',
	    	    'desc' => '<a href="'.$img_src.'home2_block4.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	    	    'type' => 'title',
	    	    'id' => $prefix . 'test_title'
	    	),
	        array(
	        	'name'     => __( 'Newsletter Subtitle', 'cmb' ),
	        	'desc'     => __( '', 'cmb' ),
	        	'id'       => $prefix . 'block_newsletter_subtitle',
	        	'type' 	   => 'text'
	        ),
	        array(
	        	'name'     => __( 'Newsletter Contact Form 7 Shortcode', 'cmb' ),
	        	'desc'     => __( '', 'cmb' ),
	        	'id'       => $prefix . 'block_newsletter_shortcode',
	        	'type' 	   => 'text'
	        ),

	        array(
	            'name' => 'Block with Events',
	            'desc' => '<a href="'.$img_src.'home2_block5.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name' => 'Display Events Section',
	            'id' => $prefix . 'show_b_events',
	            'type' => 'checkbox'
	        ),

	        array(
	            'name' => 'Block with Posts',
	            'desc' => '<a href="'.$img_src.'home2_block6.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name'    => 'Show',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_wposts_show',
	            'type'    => 'select',
	            'options' => array(
	                'latest' => __( 'Latest Posts', 'cmb2' ),
	                'mostpopular'   => __( 'Most Popular', 'cmb2' ),
	                'category'     => __( 'From Category', 'cmb2' ),
	            ),
	            'default' => 'custom',
	        ),

	        array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_wposts_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),
		),
	);

	$meta_boxes['home_3_opts'] = array(
		'id'         => 'home_3_opts',
		'title'      => __( 'Home Options', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/home-3.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
	        array(
	            'name' => 'Great News Slider',
	            'desc' => '<a href="'.$img_src.'home3_block1.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name'    => 'Style',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_gns_style',
	            'type'    => 'select',
	            'options' => array(
	                'onside' => __( 'On the Side', 'cmb2' ),
	                'fullwidth'   => __( 'Full Width', 'cmb2' ),
	                'incontainer'     => __( 'In Container', 'cmb2' ),
	            ),
	            'default' => 'onside',
	        ),
	        array(
	            'name'    => 'Show',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_gns_show',
	            'type'    => 'select',
	            'options' => array(
	                'latest' => __( 'Latest Posts', 'cmb2' ),
	                'mostpopular'   => __( 'Most Popular', 'cmb2' ),
	                'category'     => __( 'From Category', 'cmb2' ),
	            ),
	            'default' => 'custom',
	        ),
	        array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_gns_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),

	        array(
	            'name' => 'Block 8',
	            'desc' => '<a href="'.$img_src.'home3_block2.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name' => 'Display This Section?',
	            'id' => $prefix . 'show_b8',
	            'type' => 'checkbox'
	        ),
	        array(
	            'name'    => 'Show',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_8_show',
	            'type'    => 'select',
	            'options' => array(
	                'latest' => __( 'Latest Posts', 'cmb2' ),
	                'mostpopular'   => __( 'Most Popular', 'cmb2' ),
	                'category'     => __( 'From Category', 'cmb2' ),
	            ),
	            'default' => 'latest',
	        ),
	        array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_8_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),
        	array(
                'name' => 'More Link',
                'desc' => '',
                'id' => $prefix . 'block_8_morelink',
                'type' => 'text_url'
            ),

	        array(
	            'name' => 'Block 9',
	            'desc' => '<a href="'.$img_src.'home3_block3.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name' => 'Display This Section?',
	            'id' => $prefix . 'show_b9',
	            'type' => 'checkbox'
	        ),
	        array(
	            'name'    => 'Show',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_9_show',
	            'type'    => 'select',
	            'options' => array(
	                'latest' => __( 'Latest Posts', 'cmb2' ),
	                'videos'   => __( 'Latest Videos', 'cmb2' ),
	                'category'     => __( 'Posts From Category', 'cmb2' ),
	            ),
	            'default' => 'latest',
	        ),
	        array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_9_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),

	        array(
	            'name' => 'Block 10',
	            'desc' => '<a href="'.$img_src.'home3_block4.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name' => 'Display This Section?',
	            'id' => $prefix . 'show_b10',
	            'type' => 'checkbox'
	        ),
	        array(
	            'name'    => 'Show',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_10_show',
	            'type'    => 'select',
	            'options' => array(
	                'latest' => __( 'Latest Posts', 'cmb2' ),
	                'mostpopular'   => __( 'Most Popular', 'cmb2' ),
	                'category'     => __( 'From Category', 'cmb2' ),
	            ),
	            'default' => 'latest',
	        ),
	        array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_10_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),

	        array(
	            'name' => 'Latest Videos',
	            'desc' => '<a href="'.$img_src.'home3_block5.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name' => 'Display This Section?',
	            'id' => $prefix . 'show_blv',
	            'type' => 'checkbox'
	        ),
		),
	);

	$meta_boxes['home_4_opts'] = array(
		'id'         => 'home_4_opts',
		'title'      => __( 'Home Options', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/home-4.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
			    'name' => 'Banner 1',
			    'desc' => '<a href="'.$img_src.'home4_block1.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
			    'type' => 'title',
			    'id' => $prefix . 'test_title'
			),
			array(
			    'name' => 'Banner Image',
			    'desc' => 'Upload an image or enter an URL.',
			    'id' => $prefix . 'banner_3_image',
			    'type' => 'file',
			    'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
			),
			array(
		        'name' => 'Banner Link',
		        'desc' => '',
		        'id' => $prefix . 'banner_3_link',
		        'type' => 'text_url'
		    ),

	    	array(
	    	    'name' => 'Banner 2',
	    	    'desc' => '<a href="'.$img_src.'home4_block2.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	    	    'type' => 'title',
	    	    'id' => $prefix . 'test_title'
	    	),
	    	array(
	    	    'name' => 'Banner Image',
	    	    'desc' => 'Upload an image or enter an URL.',
	    	    'id' => $prefix . 'banner_4_image',
	    	    'type' => 'file',
	    	    'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
	    	),
	    	array(
	            'name' => 'Banner Link',
	            'desc' => '',
	            'id' => $prefix . 'banner_4_link',
	            'type' => 'text_url'
	        ),

	        array(
	            'name' => 'Sidebar Left',
	            'desc' => '<a href="'.$img_src.'home4_block8.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name'    => 'Show',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_4left_show',
	            'type'    => 'select',
	            'options' => array(
	                'latest' => __( 'Latest Posts', 'cmb2' ),
	                'mostpopular'   => __( 'Most Popular', 'cmb2' ),
	                'category'     => __( 'From Category', 'cmb2' ),
	            ),
	            'default' => 'custom',
	        ),
	        array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_4left_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),

            array(
	            'name' => 'Sidebar Right',
	            'desc' => '<a href="'.$img_src.'home4_block9.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name'    => 'Show',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_4right_show',
	            'type'    => 'select',
	            'options' => array(
	                'latest' => __( 'Latest Posts', 'cmb2' ),
	                'mostpopular'   => __( 'Most Popular', 'cmb2' ),
	                'category'     => __( 'From Category', 'cmb2' ),
	                'videos'     => __( 'Latest Videos', 'cmb2' ),
	            ),
	            'default' => 'custom',
	        ),
	        array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_4right_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),

		    array(
		        'name' => 'Specific Post',
		        'desc' => '<a href="'.$img_src.'home4_block3.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
		        'type' => 'title',
		        'id' => $prefix . 'test_title'
		    ),
	    	array(
	            'name' => 'Post Slug',
	            'desc' => '',
	            'id' => $prefix . 'specific_post_slug',
	            'type' => 'text'
	        ),
	        array(
	            'name' => 'Show Related posts?',
	            'id' => $prefix . 'specific_post_related',
	            'type' => 'checkbox'
	        ),

	        array(
	            'name' => 'Posts Block',
	            'desc' => '<a href="'.$img_src.'home4_block4.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name' => 'Display This Section?',
	            'id' => $prefix . 'show_pb',
	            'type' => 'checkbox'
	        ),
	        array(
	            'name'    => 'Show',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_pb_show',
	            'type'    => 'select',
	            'options' => array(
	                'latest' => __( 'Latest Posts', 'cmb2' ),
	                'mostpopular'   => __( 'Most Popular', 'cmb2' ),
	                'category'     => __( 'From Category', 'cmb2' ),
	            ),
	            'default' => 'latest',
	        ),
        	array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_pb_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),

	        array(
	            'name' => 'Second Posts Block',
	            'desc' => '<a href="'.$img_src.'home4_block5.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name' => 'Display This Section?',
	            'id' => $prefix . 'show_2pb',
	            'type' => 'checkbox'
	        ),
	        array(
	            'name'    => 'Show',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_2pb_show',
	            'type'    => 'select',
	            'options' => array(
	                'latest' => __( 'Latest Posts', 'cmb2' ),
	                'mostpopular'   => __( 'Most Popular', 'cmb2' ),
	                'category'     => __( 'From Category', 'cmb2' ),
	            ),
	            'default' => 'latest',
	        ),
        	array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_2pb_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),

	        array(
	            'name' => 'News Block',
	            'desc' => '<a href="'.$img_src.'home4_block6.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_newsblock_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),

	        array(
	            'name' => 'Second News Block',
	            'desc' => '<a href="'.$img_src.'home4_block7.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name' => 'This is Blogging Block?',
	            'desc'     => __( 'No need for category select if is checked.', 'cmb' ),
	            'id' => $prefix . 'block_snewsblock_blogging',
	            'type' => 'checkbox'
	        ),
	        array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_snewsblock_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),
		),
	);

	$meta_boxes['home_5_opts'] = array(
		'id'         => 'home_5_opts',
		'title'      => __( 'Home Options', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/home-5.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
	        array(
	            'name' => 'Posts Block',
	            'desc' => '<a href="'.$img_src.'home5_block1.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name'    => 'Show',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_block20_show',
	            'type'    => 'select',
	            'options' => array(
	                'latest' => __( 'Latest Posts', 'cmb2' ),
	                'mostpopular'   => __( 'Most Popular', 'cmb2' ),
	                'category'     => __( 'From Category', 'cmb2' ),
	            ),
	            'default' => 'latest',
	        ),
        	array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_block20_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),

	        array(
	            'name' => 'Second Posts Block',
	            'desc' => '<a href="'.$img_src.'home5_block2.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name'    => 'Show',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_block21_show',
	            'type'    => 'select',
	            'options' => array(
	                'latest' => __( 'Latest Posts', 'cmb2' ),
	                'mostpopular'   => __( 'Most Popular', 'cmb2' ),
	                'category'     => __( 'From Category', 'cmb2' ),
	            ),
	            'default' => 'latest',
	        ),
        	array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_block21_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),

	        array(
	            'name' => 'Third Posts Block',
	            'desc' => '<a href="'.$img_src.'home5_block3.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
	            'type' => 'title',
	            'id' => $prefix . 'test_title'
	        ),
	        array(
	            'name'    => 'Show',
	            'desc'    => 'Select an option',
	            'id'      => $prefix . 'block_block22_show',
	            'type'    => 'select',
	            'options' => array(
	                'latest' => __( 'Latest Posts', 'cmb2' ),
	                'mostpopular'   => __( 'Most Popular', 'cmb2' ),
	                'category'     => __( 'From Category', 'cmb2' ),
	            ),
	            'default' => 'latest',
	        ),
        	array(
                'name'     => __( 'Posts from what Category?', 'cmb' ),
                'desc'     => __( '', 'cmb' ),
                'id'       => $prefix . 'block_block22_category',
                'type'    => 'select',
                'options' => cmb_get_categories(),
            ),

            array(
                'name' => 'Instagram Feed',
                'desc' => '<a href="'.$img_src.'home5_block4.jpg" class="acpopover"><i class="fa fa-question-circle"></i></a>',
                'type' => 'title',
                'id' => $prefix . 'test_title'
            ),
            array(
                'name' => 'Show Instagram Feed?',
                'id' => $prefix . 'show_instagram_feed',
                'type' => 'checkbox'
            ),
		),
	);

	$meta_boxes['page_about'] = array(
		'id'         => 'page_about',
		'title'      => __( 'Page About Options', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/page-about.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
            array(
                'name' => 'Show Our Members Block?',
                'id' => $prefix . 'show_ourmembers',
                'type' => 'checkbox'
            ),
    		array(
                'name' => 'Main Editor',
                'description' => __('Enter ID of user you want to be listed as main editor.', 'newsstand'),
                'id'   => $prefix . 'main_editor_id',
                'type' => 'text_small',
            ),
    		array(
                'name' => 'Contact Form Shortcode',
                'description' => __('Enter Shortcode from Contact Form 7.', 'newsstand'),
                'id'   => $prefix . 'contact_shortcode',
                'type' => 'text_medium',
            ),
		),
	);

	$meta_boxes['page_contact'] = array(
		'id'         => 'page_contact',
		'title'      => __( 'Page Contact Options', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/page-contact.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
    		array(
                'name' => 'Google Maps LatLng',
                'description' => __('Paste here like this: 51.1506508, -113.9116261<br>You can get Coordinates <a href="http://www.latlong.net/" target="_blank">here</a>.'),
                'id'   => $prefix . 'gmaps_latlng',
                'type' => 'text_medium',
            ),
    		array(
    		    'name'    => 'Google Maps Zoom Level',
    		    'desc'    => 'Select an option',
    		    'id'      => $prefix . 'gmaps_zoom',
    		    'type'    => 'select',
    		    'options' => array(
    		        '4' 	=> __( '4', 'cmb2' ),
    		        '5'   	=> __( '5', 'cmb2' ),
    		        '6'   	=> __( '6', 'cmb2' ),
    		        '7'   	=> __( '7', 'cmb2' ),
    		        '8'   	=> __( '8', 'cmb2' ),
    		        '9'   	=> __( '9', 'cmb2' ),
    		        '10'   	=> __( '10', 'cmb2' ),
    		        '11'   	=> __( '11', 'cmb2' ),
    		        '12'   	=> __( '12', 'cmb2' ),
    		        '13'   	=> __( '13', 'cmb2' ),
    		        '14'   	=> __( '14', 'cmb2' ),
    		        '15'   	=> __( '15', 'cmb2' ),
    		    ),
    		    'default' => '8',
    		),
    		array(
    		    'name' => 'Google Maps Custom Style',
    		    'desc' => 'Find Style you like <a href="https://snazzymaps.com/">here</a> and paste code in square brackets here.',
    		    'default' => '[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]',
    		    'id' => $prefix . 'gmaps_style',
    		    'type' => 'textarea'
    		),
			array(
	            'name' => 'Contact Form Shortcode',
	            'description' => __('Enter Shortcode from Contact Form 7.', 'newsstand'),
	            'id'   => $prefix . 'contact_page_shortcode',
	            'type' => 'text_medium',
	        ),
		),
	);

	$meta_boxes['page_authors'] = array(
		'id'         => 'page_authors',
		'title'      => __( 'Page Options', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => 'templates/page-membersandauthors.php' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
    		array(
    		    'name'    => 'What to Show here?',
    		    'desc'    => 'Select an option',
    		    'id'      => $prefix . 'maa_what',
    		    'type'    => 'select',
    		    'options' => array(
    		        'members' 		=> __( 'Members', 'cmb2' ),
    		        'authors'   	=> __( 'Authors', 'cmb2' ),
    		    ),
    		    'default' => 'members',
    		),
		),
	);

	$meta_boxes['page_review'] = array(
		'id'         => 'page_review',
		'title'      => __( 'Page Options', 'cmb' ),
		'pages'      => array( 'review', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
    		array(
    		    'name' => 'Review Rating',
    		    'desc' => 'Enter something like this: <b>4/5</b>',
    		    'id' => $prefix . 'review_rating',
    		    'type' => 'text_small'
    		),
		),
	);

	$meta_boxes['page_reviews'] = array(
		'id'         => 'page_reviews',
		'title'      => __( 'Page Options', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on' => array( 'key' => 'page-template', 'value' => array('templates/page-reviews.php', 'templates/page-blog.php') ),
		'fields'     => array(
    		array(
    		    'name'    => 'Show what posts? (on the right side)',
    		    'desc'    => 'Select an option',
    		    'id'      => $prefix . 'swp_what',
    		    'type'    => 'select',
    		    'options' => array(
    		        'latestvideos' 		=> __( 'Latest Videos', 'cmb2' ),
    		        'latestposts'   	=> __( 'Latest Posts', 'cmb2' ),
    		        'fromcategory'   	=> __( 'From Category', 'cmb2' ),
    		    ),
    		    'default' => 'latestvideos',
    		),
			array(
		        'name'     => __( 'Posts from what Category?', 'cmb' ),
		        'desc'     => __( '', 'cmb' ),
		        'id'       => $prefix . 'block_block29_category',
		        'type'    => 'select',
		        'options' => cmb_get_categories(),
		    ),
		),
	);

	$meta_boxes['strip_option'] = array(
		'id'         => 'strip_option',
		'title'      => __( 'Strip With Text', 'cmb' ),
		'pages'      => array( 'page', ), // Post type
		'show_on' => array( 'key' => 'page-template', 'value' => array('templates/home-2.php', 'templates/home-3.php', 'templates/home-4.php', 'templates/home-6.php', 'templates/page-about.php', 'templates/page-contact.php', 'templates/page-reviews.php', 'templates/page-blog.php') ),
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
			    'name' => 'Background Color',
			    'id'   => $prefix . 'strip_bg',
			    'type' => 'colorpicker',
			    'default'  => '#fddc32',
			),
			array(
	            'name' => 'Strip Text',
	            'id'   => $prefix . 'strip_text',
	            'type' => 'text',
	        ),
    		array(
                'name' => 'Strip Button Link',
                'id'   => $prefix . 'strip_link',
                'type' => 'text_url',
            ),
            array(
                'name' => 'Open Link in new tab?',
                'desc' => 'If checked, link will be opened in new tab.',
                'id' => $prefix . 'strip_link_newtab',
                'type' => 'checkbox'
            ),
		),
	);

	$meta_boxes['event_options'] = array(
		'id'         => 'event_options',
		'title'      => __( 'Event Options', 'cmb' ),
		'pages'      => array( 'event', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
		        'name' => 'Date of Event',
		        'desc' => '',
		        'id' => $prefix . 'event_date',
		        'type' => 'text_date'
		    ),
	    	array(
	            'name' => 'Short Description (Few Words)',
	            'desc' => '',
	            'id' => $prefix . 'event_shortdesc',
	            'type' => 'text'
	        ),
		),
	);

	$meta_boxes['video_options'] = array(
		'id'         => 'video_options',
		'title'      => __( 'Video Options', 'cmb' ),
		'pages'      => array( 'video', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
		        'name' => 'Video URL',
		        'desc' => 'URL to Vimeo or Youtube Video',
		        'id' => $prefix . 'video_url',
		        'type' => 'text'
		    ),
		),
	);

	$meta_boxes['user_options'] = array(
		'id'         => 'user_options',
		'title'      => __( 'User Options', 'cmb' ),
		'pages'      => array( 'user', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
			    'name' => 'User Position',
			    'id' => $prefix . 'user_position',
			    'type' => 'text_medium'
			),
			array(
			    'name' => 'User Photo',
			    'desc' => 'Upload an image or enter an URL.',
			    'id' => $prefix . 'user_photo',
			    'type' => 'file',
			    'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
			),
			array(
			    'id'          => $prefix . 'user_stats',
			    'type'        => 'group',
			    'description' => __( 'Some User Statistic', 'cmb2' ),
			    'options'     => array(
			        'group_title'   => __( 'Statistic {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
			        'add_button'    => __( 'Add Another Statistic', 'cmb2' ),
			        'remove_button' => __( 'Remove Statistic', 'cmb2' ),
			        'sortable'      => true, // beta
			    ),
			    // Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
			    'fields'      => array(
			        array(
			            'name' => 'Statistic Title',
			            'id'   => 'title',
			            'type' => 'text_medium',
			        ),
			        array(
			            'name' => 'Statistic Number',
			            'id'   => 'number',
			            'type' => 'text_medium',
			        ),
			    ),
			),
		),
	);

	$meta_boxes['recipe_options'] = array(
		'id'         => 'recipe_options',
		'title'      => __( 'Recipe Options', 'cmb' ),
		'pages'      => array( 'recipe', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
		        'name' => 'Prep Time',
		        'desc' => 'Example: <b>15-20 Min.</b>',
		        'id' => $prefix . 'prep_time',
		        'type' => 'text_medium'
		    ),
	    	array(
	            'name' => 'For how many Persons?',
	            'desc' => 'Example: <b>2 Persons</b>',
	            'id' => $prefix . 'persons',
	            'type' => 'text_medium'
	        ),
		),
	);

	$meta_boxes['gallery_options'] = array(
		'id'         => 'gallery_options',
		'title'      => __( 'Gallery Options', 'cmb' ),
		'pages'      => array( 'gallery', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
			    'name' => 'Gallery Images',
			    'desc' => '',
			    'id' => $prefix . 'images',
			    'type' => 'file_list',
			),
		),
	);

	$meta_boxes['member_option'] = array(
		'id'         => 'member_option',
		'title'      => __( 'Member Options', 'cmb' ),
		'pages'      => array( 'team', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
			    'name' => 'Member Photo',
			    'desc' => '',
			    'id' => $prefix . 'member_photo',
			    'type' => 'file',
			    'allow' => array( 'attachment' ) // limit to just attachments with array( 'attachment' )
			),
			array(
		        'name' => 'Name and Surname',
		        'desc' => '',
		        'id' => $prefix . 'member_namesurname',
		        'type' => 'text_medium'
		    ),
	    	array(
	            'name' => 'Position',
	            'desc' => '',
	            'id' => $prefix . 'member_position',
	            'type' => 'text_medium'
	        ),
	        array(
	            'name' => 'Short Description',
	            'desc' => '',
	            'id' => $prefix . 'member_shortdesc',
	            'type' => 'textarea_small'
	        ),
        	array(
                'name' => 'Site URL',
                'desc' => '',
                'id' => $prefix . 'member_siteurl',
                'type' => 'text_url'
            ),
	        array(
	            'id'          => $prefix . 'member_social',
	            'type'        => 'group',
	            'description' => __( '', 'cmb2' ),
	            'options'     => array(
	                'group_title'   => __( 'Social Network {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
	                'add_button'    => __( 'Add Another Social Network', 'cmb2' ),
	                'remove_button' => __( 'Remove Social Network', 'cmb2' ),
	                'sortable'      => true, // beta
	            ),
	            'fields'      => array(
	                array(
	                    'name' => 'Icon',
	                    'description' => __( "For icon, go <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>here</a>, choose icon you like and then paste here name like this: <b>fa-facebook</b>.", 'cmb2' ),
	                    'id'   => 'icon',
	                    'type' => 'text',
	                ),
	                array(
	                    'name' => 'URL',
	                    'id'   => 'url',
	                    'type' => 'text',
	                ),
	            ),
	        ),
		),
	);

	$meta_boxes['post_video_options'] = array(
		'id'         => 'post_video_options',
		'title'      => __( 'Post Options', 'cmb' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
		        'name' => 'Video Iframe code',
		        'desc' => 'Paste here embed code from Youtube or Vimeo.',
		        'id' => $prefix . 'post_video_iframe',
		        'type' => 'textarea_code'
		    ),
		),
	);

	$meta_boxes['post_gallery_options'] = array(
		'id'         => 'post_gallery_options',
		'title'      => __( 'Post Options', 'cmb' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
			    'name' => 'Gallery Images',
			    'desc' => '',
			    'id' => $prefix . 'post_gallery_images',
			    'type' => 'file_list',
			),
		),
	);

	$meta_boxes['post_audio_options'] = array(
		'id'         => 'post_audio_options',
		'title'      => __( 'Post Options', 'cmb' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
		        'name' => 'Soundcloud Track ID',
		        'desc' => 'Paste here ID from Song.',
		        'id' => $prefix . 'post_audio_id',
		        'type' => 'text_medium'
		    ),
		),
	);

	$meta_boxes['post_quote_options'] = array(
		'id'         => 'post_quote_options',
		'title'      => __( 'Post Options', 'cmb' ),
		'pages'      => array( 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
		'fields'     => array(
			array(
		        'name' => 'Quote Text',
		        'desc' => '',
		        'id' => $prefix . 'post_quote_text',
		        'type' => 'textarea_small'
		    ),
	    	array(
	            'name' => 'Quote By',
	            'desc' => '',
	            'id' => $prefix . 'post_quote_by',
	            'type' => 'text_medium'
	        ),
	        array(
	            'name' => 'Quote Image',
	            'desc' => '',
	            'id' => $prefix . 'post_quote_image',
	            'type' => 'file',
	            'allow' => array( 'attachment' ) // limit to just attachments with array( 'attachment' )
	        ),
		),
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


function cmb_taxonomy_meta_initiate() {

    require_once('Taxonomy_MetaData_CMB.php' );

    /**
     * Semi-standard CMB metabox/fields array
     */
    $meta_box = array(
        'id'         => 'newsstand_cat_options',
        'show_on'    => array( 'key' => 'options-page', 'value' => array( 'unknown', ), ),
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                'name' => 'Category Color',
                'id'   => 'newsstand_cat_color',
                'type' => 'colorpicker',
                'default'  => '#2dbda8',
            ),
        )
    );


    /**
     * Instantiate our taxonomy meta class
     */
    $cats = new Taxonomy_MetaData_CMB( 'category', $meta_box, __( 'Category Settings', 'taxonomy-metadata' ) );
}
cmb_taxonomy_meta_initiate();