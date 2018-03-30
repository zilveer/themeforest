<?php

add_action('admin_init', 'uxbarn_create_post_meta_boxes');

if( ! function_exists('uxbarn_create_post_meta_boxes')) {
	
	function uxbarn_create_post_meta_boxes() {
		uxbarn_create_post_excerpt_meta_box();
        uxbarn_create_post_header_image_setting();
		uxbarn_create_post_misc_meta_box();
	}
	
}
	

if( ! function_exists('uxbarn_create_post_excerpt_meta_box')) {

	function uxbarn_create_post_excerpt_meta_box() {
		$excerpt = array(
			'id'          => 'uxbarn_post_excerpt_meta_box',
			'title'       => __('Post Excerpt Settings', 'uxbarn'),
			'desc'        => '',
			'pages'       => array( 'post' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
				array(
		        'id'          => 'uxbarn_post_excerpt',
		        'label'       => __('Post Excerpt', 'uxbarn'),
		        'desc'        => __('This post excerpt will be used as a summarized description for your blog post. It will be displayed on the blog post list. <p>If you leave this blank, the very first post content will be used to display instead.</p>', 'uxbarn'),
		        'std'         => '',
		        'type'        => 'textarea-simple',
		        'section'     => 'uxbarn_sec_post_excerpt',
		        'rows'        => '',
		        'post_type'   => '',
		        'taxonomy'    => '',
		        'class'       => ''
		      ),
			)
		);
		
		ot_register_meta_box($excerpt);
	}
	
}


if( ! function_exists('uxbarn_create_post_header_image_setting')) {

    function uxbarn_create_post_header_image_setting() {
        $header_image = array(
            'id'          => 'uxbarn_post_header_image_meta_box',
            'title'       => __('Post\'s Header Image Setting', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'post' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_post_header_image_upload',
                    'label'       => __('Upload Post\'s Header Image', 'uxbarn'),
                    'desc'        => __('Click the icon to upload the file or if you already know the URL of the image, just paste it into the box. Recommended size is 2000x330.<p><strong>This header image will only be displayed on post\'s single page. To upload post\'s thumbnail, use "Featured Image".</strong></p><p>If you leave this blank, the post will use the Featured Image of "Posts page" or blog page that you set in "Settings > Reading".</p>', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'upload',
                    'section'     => 'uxbarn_sec_room_header_image',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                  ),
            )
        );
        
        ot_register_meta_box($header_image);
    }

}


if( ! function_exists('uxbarn_create_post_misc_meta_box')) {

	function uxbarn_create_post_misc_meta_box() {
		$misc = array(
			'id'          => 'uxbarn_post_misc_meta_box',
			'title'       => __('Miscellaneous Settings', 'uxbarn'),
			'desc'        => '',
			'pages'       => array( 'post' ),
			'context'     => 'normal',
			'priority'    => 'high',
			'fields'      => array(
			/*	array(
		        'id'          => 'uxbarn_post_thumbnail_cropping',
		        'label'       => __('Post Thumbnail Cropping', 'uxbarn'),
		        'desc'        => __('By default, the theme will crop uploaded thumbnail (Featured Image) to 765x255 or 1020x255 pixels (has sidebar or no sidebar). <p>This option lets you choose whether to ignore that cropping for flexible height (depending on the thumbnail ratio).</p>', 'uxbarn'),
		        'std'         => 'true',
		        'type'        => 'checkbox',
		        'section'     => 'uxbarn_sec_miscellaneous',
		        'rows'        => '',
		        'post_type'   => '',
		        'taxonomy'    => '',
		        'class'       => '',
		        'choices'     => array( 
		          array(
		            'value'       => 'true',
		            'label'       => __('Crop post thumbnail?', 'uxbarn'),
		            'src'         => ''
		          )
		        ),
		      ),*/
		      
		      array(
                'id'          => 'uxbarn_post_meta_info_and_elements_display',
                'label'       => __('Show All Post Meta Info and Elements?', 'uxbarn'),
                'desc'        => __('Whether to display post info like date, author name, comment count, author box and tags.', 'uxbarn'),
                'std'         => 'true',
                'type'        => 'radio',
                'section'     => 'uxbarn_to_blog_section',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'choices'     => array( 
                  array(
                    'value'       => 'true',
                    'label'       => __('Yes, show them all.', 'uxbarn'),
                    'src'         => ''
                  ),
                  array(
                    'value'       => 'false',
                    'label'       => __('No, I will choose which info to show.', 'uxbarn'),
                    'src'         => ''
                  )
                ),
              ),
              
		      array(
		        'id'          => 'uxbarn_post_meta_info_display',
		        'label'       => __('Meta Info', 'uxbarn'),
		        'desc'        => __('Use this option if you want to show or hide meta information. This will affect both blot-posts page and single page.', 'uxbarn'),
		        'std'         => '',
		        'type'        => 'checkbox',
		        'section'     => 'uxbarn_sec_miscellaneous',
		        'rows'        => '',
		        'post_type'   => '',
		        'taxonomy'    => '',
		        'class'       => '',
		        'choices'     => array( 
		          array(
		            'value'       => 'date',
		            'label'       => __('Show date?', 'uxbarn'),
		            'src'         => ''
		          ),
		          array(
		            'value'       => 'author_name',
		            'label'       => __('Show author name?', 'uxbarn'),
		            'src'         => ''
		          ),
		          array(
		            'value'       => 'comment',
		            'label'       => __('Show comment count?', 'uxbarn'),
		            'src'         => ''
		          )
		        ),
                'condition'   => 'uxbarn_post_meta_info_and_elements_display:is(false)',
				'operator'    => 'and'
		      ),
		      array(
		        'id'          => 'uxbarn_post_single_post_element_display',
		        'label'       => __('Single Post Element', 'uxbarn'),
		        'desc'        => __('These elements are in the single post page. You can use this option whether to display them or not.', 'uxbarn'),
		        'std'         => '',
		        'type'        => 'checkbox',
		        'section'     => 'uxbarn_sec_miscellaneous',
		        'rows'        => '',
		        'post_type'   => '',
		        'taxonomy'    => '',
		        'class'       => '',
		        'choices'     => array( 
		          array(
		            'value'       => 'author',
		            'label'       => __('Show author box?', 'uxbarn'),
		            'src'         => ''
		          ),
		          array(
		            'value'       => 'tags',
		            'label'       => __('Show tags?', 'uxbarn'),
		            'src'         => ''
		          ),
        		),
                'condition'   => 'uxbarn_post_meta_info_and_elements_display:is(false)',
				'operator'    => 'and'
    		)
			)
		);
		
		ot_register_meta_box($misc);
	}

}
		

?>