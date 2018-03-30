<?php

add_action('admin_init', 'uxbarn_create_portfolio_meta_boxes');

if( ! function_exists('uxbarn_create_portfolio_meta_boxes')) {
	
    function uxbarn_create_portfolio_meta_boxes() {
        
        uxbarn_create_portfolio_singe_title();
        uxbarn_create_portfolio_meta_info();
        uxbarn_create_portfolio_item_format_setting();
        uxbarn_create_image_slideshow_format_content();
        uxbarn_create_video_format_content();
        uxbarn_create_portfolio_header_image_setting();
        
    }
	
}

if( ! function_exists('uxbarn_create_portfolio_singe_title')) {
	
    function uxbarn_create_portfolio_singe_title() {
        $args = array(
            'id'          => 'uxbarn_portfolio_single_title_meta_box',
            'title'       => __('Portfolio Title Setting', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_portfolio_single_title',
                    'label'       => __('Alternate Title on Single Page', 'uxbarn'),
                    'desc'        => __('You can use this field to enter the alternate title to be displayed on portfolio single page. You may use a basic HTML tag like "strong" to create a contrast on title.<p>If you leave this blank, the normal title will be used.</p><p><strong>Important:</strong> If you put HTML tag here, ensure that you open and close the tag properly.</p>', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_portfolio_single_title_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
            )
        );
        
        ot_register_meta_box($args);
    }

}

if( ! function_exists('uxbarn_create_portfolio_meta_info')) {
	
    function uxbarn_create_portfolio_meta_info() {
        $meta_info = array(
            'id'          => 'uxbarn_portfolio_meta_info_meta_box',
            'title'       => __('Portfolio Meta Info Setting', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_portfolio_meta_info_display',
                    'label'       => __('Meta Info Display?', 'uxbarn'),
                    'desc'        => __('Use this option if you want to show or hide meta information.', 'uxbarn'),
                    'std'         => 'true',
                    'type'        => 'radio',
                    'section'     => 'uxbarn_portfolio_meta_info_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                    'choices'     => array( 
                      array(
	                    'value'       => 'true',
	                    'label'       => __('Yes', 'uxbarn'),
	                    'src'         => ''
	                  ),
	                  array(
	                    'value'       => 'false',
	                    'label'       => __('No', 'uxbarn'),
	                    'src'         => ''
	                  )
                  )
              ),
                array(
                    'id'          => 'uxbarn_portfolio_meta_info_date',
                    'label'       => __('Date', 'uxbarn'),
                    'desc'        => __('Enter the creation date of this item. Example: <em>March 15, 2013</em>', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_portfolio_meta_info_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
                array(
                    'id'          => 'uxbarn_portfolio_meta_info_client',
                    'label'       => __('Client', 'uxbarn'),
                    'desc'        => __('Enter the client name', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_portfolio_meta_info_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
                array(
                    'id'          => 'uxbarn_portfolio_meta_info_website',
                    'label'       => __('Website', 'uxbarn'),
                    'desc'        => __('Enter the website. Example: <em>www.smart-living.com</em>', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_portfolio_meta_info_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => ''
                ),
            )
        );
        
        ot_register_meta_box($meta_info);
    }

}

if( ! function_exists('uxbarn_create_portfolio_item_format_setting')) {
	
    function uxbarn_create_portfolio_item_format_setting() {
        $item_format = array(
            'id'          => 'uxbarn_portfolio_item_format_meta_box',
            'title'       => __('Portfolio Item Format Setting', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_portfolio_item_format',
                    'label'       => __('Portfolio Item Format', 'uxbarn'),
                    'desc'        => __('Select the format for this item. Then you can manage its specific content using the meta box below.<p>Every format uses <strong>Featured Image for thumbnail</strong> and <strong>meta box below for content</strong> (in single page).</p>', 'uxbarn'),
                    'std'         => 'image-slideshow',
                    'type'        => 'radio',
                    'section'     => 'uxbarn_portfolio_item_format_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                    'choices'     => array( 
                      array(
                        'value'       => 'image-slideshow',
                        'label'       => __('Image/Slideshow', 'uxbarn'),
                        'src'         => ''
                      ),
                      array(
                        'value'       => 'video',
                        'label'       => __('Video', 'uxbarn'),
                        'src'         => ''
                      ),
                    ),
                ),
            )
        );
        
        ot_register_meta_box($item_format);
    }

}

if( ! function_exists('uxbarn_create_image_slideshow_format_content')) {
	
    function uxbarn_create_image_slideshow_format_content() {
        
        $format_content = array(
            'id'          => 'uxbarn_portfolio_image_slideshow_format_meta_box',
            'title'       => __('Meta Box for Image/Slideshow Format', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                'id'          => 'uxbarn_portfolio_image_slideshow',
                'label'       => __('Images', 'uxbarn'),
                'desc'        => __('Use this setting to add images and rearrange the order by drag and drop. You can upload the image at any size. The full size of the image will be displayed on lightbox (when it is clicked). What is shown on the front end is a scaled down version.<p>Note that the field "Title" will only be used here in the backend. In the frontend, theme will use "alt", "title" and "caption" values from the image itself.</p>', 'uxbarn'),
                'std'         => '',
                'type'        => 'list-item',
                'section'     => 'uxbarn_portfolio_slideshow_format_sec',
                'rows'        => '',
                'post_type'   => '',
                'taxonomy'    => '',
                'class'       => '',
                'settings'    => array( 
                    array(
                        'id'          => 'uxbarn_portfolio_image_slideshow_upload',
                        'label'       => __('Image', 'uxbarn'),
                        'desc'        => '',
                        'std'         => '',
                        'type'        => 'upload',
                        'rows'        => '',
                        'post_type'   => '',
                        'taxonomy'    => '',
                        'class'       => ''
                      ),
                ),
                'condition'   => 'uxbarn_portfolio_item_format:is(image-slideshow)',
				'operator'    => 'and'
              )
            )
        );
        
        ot_register_meta_box($format_content);
    }

}

if( ! function_exists('uxbarn_create_video_format_content')) {
	
    function uxbarn_create_video_format_content() {
        $format_content = array(
            'id'          => 'uxbarn_portfolio_video_format_meta_box',
            'title'       => __('Meta Box for Video Format', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_portfolio_video_source',
                    'label'       => __('Source', 'uxbarn'),
                    'desc'        => __('Select either YouTube or Vimeo for the source of your video content.', 'uxbarn'),
                    'std'         => 'vimeo',
                    'type'        => 'select',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
                    'choices'     => array( 
                      array(
                        'value'       => 'vimeo',
                        'label'       => __('Vimeo', 'uxbarn'),
                        'src'         => ''
                      ),
                      array(
                        'value'       => 'youtube',
                        'label'       => __('YouTube', 'uxbarn'),
                        'src'         => ''
                      ),
                    ),
	                'condition'   => 'uxbarn_portfolio_item_format:is(video)',
					'operator'    => 'and'
                  ),
                array(
                    'id'          => 'uxbarn_portfolio_video_id',
                    'label'       => __('Video ID', 'uxbarn'),
                    'desc'        => __('Enter the ID of video. For examples, <strong>"c9MnSeYYtYY"</strong> for YouTube or <strong>"24535181"</strong> for Vimeo.', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'text',
                    'section'     => 'uxbarn_portfolio_video_format_sec',
                    'rows'        => '',
                    'post_type'   => '',
                    'taxonomy'    => '',
                    'class'       => '',
	                'condition'   => 'uxbarn_portfolio_item_format:is(video)',
					'operator'    => 'and'
                  ),
            ),
        
            'condition'   => 'uxbarn_portfolio_item_format:is(video)',
			'operator'    => 'and'
        );
        
        ot_register_meta_box($format_content);
    }

}


if( ! function_exists('uxbarn_create_portfolio_header_image_setting')) {
	
    function uxbarn_create_portfolio_header_image_setting() {
        $header_image = array(
            'id'          => 'uxbarn_portfolio_header_image_meta_box',
            'title'       => __('Portfolio Item\'s Header Image Setting', 'uxbarn'),
            'desc'        => '',
            'pages'       => array( 'portfolio' ),
            'context'     => 'normal',
            'priority'    => 'high',
            'fields'      => array(
                array(
                    'id'          => 'uxbarn_portfolio_header_image_upload',
                    'label'       => __('Upload Header Image', 'uxbarn'),
                    'desc'        => __('Click the icon to upload the file or if you already know the URL of the image, just paste it into the box. Recommended size is 2000x330.<p>This header image will only be displayed on portfolio\'s single page.</p>', 'uxbarn'),
                    'std'         => '',
                    'type'        => 'upload',
                    'section'     => 'uxbarn_portfolio_header_image_sec',
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


?>