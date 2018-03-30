<?php

	/*
	*
	*	Meta Box Functions
	*	------------------------------------------------
	*	Swift Framework v1.0
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	function sf_register_meta_boxes() {
	
		$prefix = 'sf_';
		
		global $meta_boxes;
		
		$meta_boxes = array();
		
		$options = get_option('sf_flexform_options');
		$default_page_heading_bg_alt = $options['default_page_heading_bg_alt'];
		$default_show_page_heading = $options['default_show_page_heading'];
		$default_sidebar_config = $options['default_sidebar_config'];
		$default_left_sidebar = $options['default_left_sidebar'];
		$default_right_sidebar = $options['default_right_sidebar'];
		
		if ($default_page_heading_bg_alt == "") {
			$default_page_heading_bg_alt = "none";
		}
		if ($default_show_page_heading == "") {
			$default_show_page_heading = 1;
		}
		if ($default_sidebar_config == "") {
			$default_sidebar_config = "no-sidebars";
		}		
		if ($default_left_sidebar == "") {
			$default_left_sidebar = "Sidebar-1";
		}		
		if ($default_right_sidebar == "") {
			$default_right_sidebar = "Sidebar-1";
		}	
		
		
		/* ==================================================
		
		Portfolio Meta Box
	
		================================================== */
	
		$meta_boxes[] = array(
			// Meta box id, UNIQUE per meta box. Optional since 4.1.5
			'id' => 'portfolio_meta_box',
		
			// Meta box title - Will appear at the drag and drop handle bar. Required.
			'title' => 'Portfolio Meta',
		
			// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
			'pages' => array( 'portfolio' ),
		
			// Where the meta box appear: normal (default), advanced, side. Optional.
			'context' => 'normal',
		
			// Order of meta box: high (default), low. Optional.
			'priority' => 'high',
		
			// List of meta fields
			'fields' => array(
			
				// ITEM DETAILS OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => 'Portfolio Item Details',
				    'id' 	=> "{$prefix}heading_item_details",
				    'type' 	=> 'section'
				),
				
				// Sub Text
				array(
					'name' => 'Subtitle',
					'id' => $prefix . 'portfolio_subtitle',
					'desc' => "Enter a subtitle for use within the portfolio item index (optional).",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// Client
				array(
					'name' => 'Client',
					'id' => $prefix . 'portfolio_client',
					'desc' => "Enter the client's name (optional).",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// External Link
				array(
					'name' => 'External Link',
					'id' => $prefix . 'portfolio_external_link',
					'desc' => "Enter an external link for the item  (optional) (NOTE: INCLUDE HTTP://).",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
						
				// THUMBNAIL TYPE SECTION
				array (
					'name' 	=> '',
					'title' => 'Thumbnail Options',
				    'id' 	=> "{$prefix}heading_thumb",
				    'type' 	=> 'section'
				),
				
				// THUMBNAIL TYPE
				array(
					'name' => 'Portfolio thumbnail type',
					'id'   => "{$prefix}thumbnail_type",
					'type' => 'select',
					'options' => array(
						'none'		=> 'None',
						'image'		=> 'Image',
						'video'		=> 'Video',
						'slider'	=> 'Slider'
					),
					'multiple' => false,
					'std'  => 'image',
					'desc' => 'Choose what will be used for the portfolio item thumbnail.',
				),
				
				// THUMBNAIL IMAGE
				array(
					'name'	=> 'Portfolio thumbnail image',
					'desc'  => 'The image that will be used as the portfolio thumbnail image.',
					'id'    => "{$prefix}thumbnail_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// THUMBNAIL VIDEO
				array(
					'name' => 'Portfolio thumbnail video URL',
					'id' => $prefix . 'thumbnail_video_url',
					'desc' => 'Enter the video url for the portfolio thumbnail. Only links from Vimeo & YouTube are supported.',
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// THUMBNAIL GALLERY
				array(
					'name'             => 'Portfolio thumbnail gallery',
					'desc'             => 'The images that will be used in the portfolio thumbnail gallery.',
					'id'               => "{$prefix}thumbnail_gallery",
					'type'             => 'image_advanced',
					'max_file_uploads' => 50,
				),
				
				// THUMBNAIL LINK SECTION
				array (
					'name' 	=> '',
					'title' => 'Thumbnail Link Options',
				    'id' 	=> "{$prefix}heading_thumb_link",
				    'type' 	=> 'section'
				),
				
				// THUMBNAIL LINK TYPE
				array(
					'name' => 'Portfolio thumbnail link type',
					'id'   => "{$prefix}thumbnail_link_type",
					'type' => 'select',
					'options' => array(
						'link_to_post'		=> 'Link to item',
						'link_to_url'		=> 'Link to URL',
						'link_to_url_nw'	=> 'Link to URL (New Window)',
						'lightbox_thumb'	=> 'Lightbox to the thumbnail image',
						'lightbox_image'	=> 'Lightbox to image (select below)',
						'lightbox_video'	=> 'Lightbox to video (input below)'
					),
					'multiple' => false,
					'std'  => 'link-to-post',
					'desc' => 'Choose what link will be used for the image(s) and title of the portfolio item.',
				),
				
				// THUMBNAIL LINK URL
				array(
					'name' => 'Portfolio thumbnail link URL',
					'id' => $prefix . 'thumbnail_link_url',
					'desc' => 'Enter the url for the portfolio thumbnail link.',
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// THUMBNAIL LINK LIGHTBOX IMAGE
				array(
					'name'	=> 'Portfolio thumbnail link lightbox image',
					'desc'  => 'The image that will be used as the portfolio thumbnail image.',
					'id'    => "{$prefix}thumbnail_link_image",
					'type'  => 'thickbox_image'
				),
				
				// THUMBNAIL LINK LIGHTBOX VIDEO
				array(
					'name' => 'Portfolio thumbnail link lightbox video URL',
					'id' => $prefix . 'thumbnail_link_video_url',
					'desc' => 'Enter the video url for the portfolio thumbnail. Only links from Vimeo & YouTube are supported.',
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// CUSTOM EXCERPT SECTION
				array (
					'name' 	=> '',
					'title' => 'Custom Excerpt',
				    'id' 	=> "{$prefix}heading_custom_excerpt",
				    'type' 	=> 'section'
				),
				
				// CUSTOM EXCERPT
				array(
					'name' => 'Custom excerpt',
					'desc' => "You can optionally write a custom excerpt here to display instead of the excerpt that is automatically generated.",
					'id'   => "{$prefix}custom_excerpt",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
				
				// MAIN DETAIL SECTION
				array (
					'name' 	=> '',
					'title' => 'Main Detail Options',
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// SHOW PAGE TITLE
				array(
					'name' => 'Show page title',    // File type: checkbox
					'id'   => "{$prefix}page_title",
					'type' => 'checkbox',
					'desc' => 'Show the page title at the top of the page.',
					'std' => $default_show_page_heading,
				),
				
				// PAGE TITLE LINE 1
				array(
					'name' => 'Page Title (Line 1)',
					'id' => $prefix . 'page_title_one',
					'desc' => "Enter the first line of the page title area.",
					'type'  => 'text',
					'std' => '',
				),
				
				// PAGE TITLE LINE 2
				array(
					'name' => 'Page Title (Line 2)',
					'id' => $prefix . 'page_title_two',
					'desc' => "Enter the second line of the page title area.",
					'type'  => 'text',
					'std' => '',
				),
				
				// PAGE TITLE BACKGROUND
				array(
					'name' => 'Page Title Background',
					'id'   => "{$prefix}page_title_bg",
					'type' => 'select',
					'options' => array(
						'none'		=> 'None',
						'alt-one'		=> 'Alt 1',
						'alt-two'		=> 'Alt 2',
						'alt-three'		=> 'Alt 3',
						'alt-four'		=> 'Alt 4',
						'alt-five'		=> 'Alt 5',
						'alt-six'		=> 'Alt 6',
						'alt-seven'		=> 'Alt 7',
						'alt-eight'		=> 'Alt 8',
						'alt-nine'		=> 'Alt 9',
						'alt-ten'		=> 'Alt 10'
					),
					'multiple' => false,
					'std'  => $default_page_heading_bg_alt,
					'desc' => 'Choose the background for the page title (configured in the Flexform Options panel).',
				),
				
				// ALT BG PREVIEW
				array (
					'name' 	=> '',
				    'id' 	=> "{$prefix}altbg-preview",
				    'type' 	=> 'altbgpreview'
				),
				
				// HIDE DETAILS BAR
				array(
					'name' => 'Hide item details bar',
					'id'   => "{$prefix}hide_details",
					'type' => 'checkbox',
					'desc' => 'Check this box to hide the item details on the detail page.',
					'std' => 0,
				),
				
				// INCLUDE SOCIAL SHARING
				array(
					'name' => 'Include social sharing',
					'id'   => "{$prefix}social_sharing",
					'type' => 'checkbox',
					'desc' => 'Check this box to show social sharing icons on the detail page.',
					'std' => 1,
				),
				
				// MAIN DETAIL SECTION
				array (
					'name' 	=> '',
					'title' => 'Detail Media Options',
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// USE THUMBNAIL CONTENT FOR THE MAIN DETAIL DISPLAY
				array(
					'name' => 'Use the thumbnail content',    // File type: checkbox
					'id'   => "{$prefix}thumbnail_content_main_detail",
					'type' => 'checkbox',
					'desc' => 'Uncheck this box if you wish to select different media for the main detail display.',
					'std' => 0,
				),
				
				// DETAIL TYPE
				array(
					'name' => 'Portfolio detail type',
					'id'   => "{$prefix}detail_type",
					'type' => 'select',
					'options' => array(
						'none'		=> 'None',
						'image'		=> 'Image',
						'video'		=> 'Video',
						'slider'	=> 'Standard Slider',
						'layer-slider' => 'Layer Slider',
						'custom' => 'Custom'
					),
					'multiple' => false,
					'std'  => 'image',
					'desc' => 'Choose what will be used for the portfolio item detail.',
				),
				
				// DETAIL IMAGE
				array(
					'name'	=> 'Portfolio detail image',
					'desc'  => 'The image that will be used as the portfolio detail image.',
					'id'    => "{$prefix}detail_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// DETAIL VIDEO
				array(
					'name' => 'Portfolio detail video URL',
					'id' => $prefix . 'detail_video_url',
					'desc' => 'Enter the video url for the portfolio thumbnail. Only links from Vimeo & YouTube are supported.',
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// DETAIL GALLERY
				array(
					'name'             => 'Portfolio detail gallery',
					'desc'             => 'The images that will be used in the portfolio detail gallery.',
					'id'               => "{$prefix}detail_gallery",
					'type'             => 'image_advanced',
					'max_file_uploads' => 50,
				),
				
				// DETAIL REV SLIDER
				array(
					'name' => 'Revolution slider alias',
					'id' => $prefix . 'detail_rev_slider_alias',
					'desc' => "Enter the revolution slider alias for the slider that you want to show.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// DETAIL CUSTOM
				array(
					'name' => 'Custom detail display',
					'desc' => "If you'd like to provide your own detail media, please add it here",
					'id'   => "{$prefix}custom_media",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
				
				// SIDEBAR OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => 'Sidebar Options',
				    'id' 	=> "{$prefix}heading_sidebar",
				    'type' 	=> 'section'
				),
				
				// SIDEBAR CONFIG
				array(
					'name' => 'Sidebar configuration',
					'id'   => "{$prefix}sidebar_config",
					'type' => 'select',
					// Array of 'key' => 'value' pairs for select box
					'options' => array(
						'no-sidebars'		=> 'No Sidebars',
						'left-sidebar'		=> 'Left Sidebar',
						'right-sidebar'		=> 'Right Sidebar',
						'both-sidebars'		=> 'Both Sidebars'
					),
					// Select multiple values, optional. Default is false.
					'multiple' => false,
					// Default value, can be string (single value) or array (for both single and multiple values)
					'std'  => $default_sidebar_config,
					'desc' => 'Choose the sidebar configuration for the detail page of this portfolio item.',
				),
				
				// LEFT SIDEBAR
				array (
					'name' 	=> 'Left Sidebar',
				    'id' 	=> "{$prefix}left_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_left_sidebar
				),
				
				// RIGHT SIDEBAR
				array (
					'name' 	=> 'Right Sidebar',
				    'id' 	=> "{$prefix}right_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_right_sidebar
				),
				
				// PAGE BACKGROUND OPTIONS
				array (
					'name' 	=> '',
					'title' => 'Page Background Image Options (boxed layout only)',
				    'id' 	=> "{$prefix}heading_page",
				    'type' 	=> 'section'
				),
				
				// BACKGROUND IMAGE
				array(
					'name'	=> 'Background Image',
					'desc'  => 'The image that will be used as the page background image.',
					'id'    => "{$prefix}background_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// BACKGROUND SIZE
				array(
					'name' => 'Background Image Size',
					'desc' => 'For fullscreen images, choose Cover. For repeating patterns, choose Auto.',
					'id'   => "{$prefix}background_image_size",
					'type' => 'select',
					'options' => array(
						'cover'		=> 'Cover',
						'auto'	=> 'Auto'
					),
					'multiple' => false,
					'std'  => 'cover',
				),	
				
				// SWIFT SLIDER ENTRY SECTION
				array (
					'name' 	=> '',
					'title' => 'Swift Slider Entry Options',
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// SWIFT SLIDER BACKGROUND IMAGE
				array(
					'name'	=> 'Slide background image',
					'desc'  => 'The image that will be used as the slide image in the Swift Slider.',
					'id'    => "{$prefix}posts_slider_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// SWIFT SLIDER CAPTION POSITION
				array(
					'name' => 'Caption Position',
					'id'   => "{$prefix}caption_position",
					'type' => 'select',
					'options' => array(
						'caption-left'		=> 'Left',
						'caption-right'		=> 'Right'
					),
					'multiple' => false,
					'std'  => 'caption-right',
					'desc' => 'Choose which side you would like to display the caption over the slide.',
				),
				
				// MISC
				array (
					'name' 	=> '',
					'title' => 'Misc. Options',
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// REMOVE BREADCRUMBS
				array(
					'name' => 'Remove breadcrumbs',    // File type: checkbox
					'id'   => "{$prefix}no_breadcrumbs",
					'type' => 'checkbox',
					'desc' => 'Remove the breadcrumbs on the page.',
					'std' => 0,
				),
				
				// Extra Page Class
				array(
					'name' => 'Extra page class',
					'id' => $prefix . 'extra_page_class',
					'desc' => "If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				)
			)
		);
		
		/* ==================================================
			
		Post Meta Box
		
		================================================== */
		
		$meta_boxes[] = array(
			// Meta box id, UNIQUE per meta box. Optional since 4.1.5
			'id' => 'post_meta_box',
		
			// Meta box title - Will appear at the drag and drop handle bar. Required.
			'title' => 'Post Meta',
		
			// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
			'pages' => array( 'post' ),
		
			// Where the meta box appear: normal (default), advanced, side. Optional.
			'context' => 'normal',
		
			// Order of meta box: high (default), low. Optional.
			'priority' => 'high',
		
			// List of meta fields
			'fields' => array(
						
				// THUMBNAIL TYPE SECTION
				array (
					'name' 	=> '',
					'title' => 'Thumbnail Options',
				    'id' 	=> "{$prefix}heading_thumb",
				    'type' 	=> 'section'
				),
				
				// THUMBNAIL TYPE
				array(
					'name' => 'Post thumbnail type',
					'id'   => "{$prefix}thumbnail_type",
					'type' => 'select',
					'options' => array(
						'none'		=> 'None',
						'image'		=> 'Image',
						'video'		=> 'Video',
						'slider'	=> 'Slider'
					),
					'multiple' => false,
					'std'  => 'none',
					'desc' => 'Choose what will be used for the post item thumbnail.',
				),
				
				// THUMBNAIL IMAGE
				array(
					'name'	=> 'Post thumbnail image',
					'desc'  => 'The image that will be used as the post thumbnail image.',
					'id'    => "{$prefix}thumbnail_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// THUMBNAIL VIDEO
				array(
					'name' => 'Post thumbnail video URL',
					'id' => $prefix . 'thumbnail_video_url',
					'desc' => 'Enter the video url for the post thumbnail. Only links from Vimeo & YouTube are supported.',
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// THUMBNAIL GALLERY
				array(
					'name'             => 'Post thumbnail gallery',
					'desc'             => 'The images that will be used in the post thumbnail gallery.',
					'id'               => "{$prefix}thumbnail_gallery",
					'type'             => 'image_advanced',
					'max_file_uploads' => 50,
				),
				
				// THUMBNAIL LINK SECTION
				array (
					'name' 	=> '',
					'title' => 'Thumbnail Link Options',
				    'id' 	=> "{$prefix}heading_thumb_link",
				    'type' 	=> 'section'
				),
				
				// THUMBNAIL LINK TYPE
				array(
					'name' => 'Post thumbnail link type',
					'id'   => "{$prefix}thumbnail_link_type",
					'type' => 'select',
					'options' => array(
						'link_to_post'		=> 'Link to item',
						'link_to_url'		=> 'Link to URL',
						'link_to_url_nw'	=> 'Link to URL (New Window)',
						'lightbox_thumb'	=> 'Lightbox to the thumbnail image',
						'lightbox_image'	=> 'Lightbox to image (select below)',
						'lightbox_video'	=> 'Lightbox to video (input below)'
					),
					'multiple' => false,
					'std'  => 'link-to-post',
					'desc' => 'Choose what link will be used for the image(s) and title of the post item.',
				),
				
				// THUMBNAIL LINK URL
				array(
					'name' => 'Post thumbnail link URL',
					'id' => $prefix . 'thumbnail_link_url',
					'desc' => 'Enter the url for the post thumbnail link.',
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// THUMBNAIL LINK LIGHTBOX IMAGE
				array(
					'name'	=> 'Post thumbnail link lightbox image',
					'desc'  => 'The image that will be used as the post thumbnail image.',
					'id'    => "{$prefix}thumbnail_link_image",
					'type'  => 'thickbox_image'
				),
				
				// THUMBNAIL LINK LIGHTBOX VIDEO
				array(
					'name' => 'Post thumbnail link lightbox video URL',
					'id' => $prefix . 'thumbnail_link_video_url',
					'desc' => 'Enter the video url for the post thumbnail. Only links from Vimeo & YouTube are supported.',
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// CUSTOM EXCERPT SECTION
				array (
					'name' 	=> '',
					'title' => 'Custom Excerpt',
				    'id' 	=> "{$prefix}heading_custom_excerpt",
				    'type' 	=> 'section'
				),
				
				// CUSTOM EXCERPT
				array(
					'name' => 'Custom excerpt',
					'desc' => "You can optionally write a custom excerpt here to display instead of the excerpt that is automatically generated.",
					'id'   => "{$prefix}custom_excerpt",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
				
				// MAIN DETAIL SECTION
				array (
					'name' 	=> '',
					'title' => 'Main Detail Options',
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// SHOW PAGE TITLE
				array(
					'name' => 'Show page title',    // File type: checkbox
					'id'   => "{$prefix}page_title",
					'type' => 'checkbox',
					'desc' => 'Show the page title at the top of the page.',
					'std' => $default_show_page_heading,
				),
				
				// PAGE TITLE LINE 1
				array(
					'name' => 'Page Title (Line 1)',
					'id' => $prefix . 'page_title_one',
					'desc' => "Enter the first line of the page title area.",
					'type'  => 'text',
					'std' => '',
				),
				
				// PAGE TITLE LINE 2
				array(
					'name' => 'Page Title (Line 2)',
					'id' => $prefix . 'page_title_two',
					'desc' => "Enter the second line of the page title area.",
					'type'  => 'text',
					'std' => '',
				),
				
				// PAGE TITLE BACKGROUND
				array(
					'name' => 'Page Title Background',
					'id'   => "{$prefix}page_title_bg",
					'type' => 'select',
					'options' => array(
						'none'		=> 'None',
						'alt-one'		=> 'Alt 1',
						'alt-two'		=> 'Alt 2',
						'alt-three'		=> 'Alt 3',
						'alt-four'		=> 'Alt 4',
						'alt-five'		=> 'Alt 5',
						'alt-six'		=> 'Alt 6',
						'alt-seven'		=> 'Alt 7',
						'alt-eight'		=> 'Alt 8',
						'alt-nine'		=> 'Alt 9',
						'alt-ten'		=> 'Alt 10'
					),
					'multiple' => false,
					'std'  => $default_page_heading_bg_alt,
					'desc' => 'Choose the background for the page title (configured in the Flexform Options panel).',
				),
				
				// ALT BG PREVIEW
				array (
					'name' 	=> '',
				    'id' 	=> "{$prefix}altbg-preview",
				    'type' 	=> 'altbgpreview'
				),
				
				// FULL WIDTH MEDIA
				array(
					'name' => 'Full Width Media Display',
					'id'   => "{$prefix}full_width_display",
					'type' => 'checkbox',
					'desc' => 'Check this box to show the detail media above the page content / sidebar config, rather than inside the page content.',
					'std' => 1,
				),
				
				// INCLUDE AUTHOR INFO
				array(
					'name' => 'Include author info',
					'id'   => "{$prefix}author_info",
					'type' => 'checkbox',
					'desc' => 'Check this box to show the author info box on the detail page.',
					'std' => 1,
				),
				
				// INCLUDE SOCIAL SHARING
				array(
					'name' => 'Include social sharing',
					'id'   => "{$prefix}social_sharing",
					'type' => 'checkbox',
					'desc' => 'Check this box to show social sharing icons on the detail page.',
					'std' => 1,
				),
				
				// INCLUDE RELATED ARTICLES
				array(
					'name' => 'Include related articles',
					'id'   => "{$prefix}related_articles",
					'type' => 'checkbox',
					'desc' => 'Check this box to show related articles on the detail page.',
					'std' => 1,
				),
				
				// MAIN DETAIL SECTION
				array (
					'name' 	=> '',
					'title' => 'Detail Media Options',
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// USE THUMBNAIL CONTENT FOR THE MAIN DETAIL DISPLAY
				array(
					'name' => 'Use the thumbnail content',    // File type: checkbox
					'id'   => "{$prefix}thumbnail_content_main_detail",
					'type' => 'checkbox',
					'desc' => 'Uncheck this box if you wish to select different media for the main detail display.',
					'std' => 0,
				),
				
				// DETAIL TYPE
				array(
					'name' => 'Post detail type',
					'id'   => "{$prefix}detail_type",
					'type' => 'select',
					'options' => array(
						'none'		=> 'None',
						'image'		=> 'Image',
						'video'		=> 'Video',
						'slider'	=> 'Standard Slider',
						'layer-slider' => 'Layer Slider',
						'custom' => 'Custom'
					),
					'multiple' => false,
					'std'  => 'image',
					'desc' => 'Choose what will be used for the post item detail.',
				),
				
				// DETAIL IMAGE
				array(
					'name'	=> 'Post detail image',
					'desc'  => 'The image that will be used as the post detail image.',
					'id'    => "{$prefix}detail_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// DETAIL VIDEO
				array(
					'name' => 'Post detail video URL',
					'id' => $prefix . 'detail_video_url',
					'desc' => 'Enter the video url for the post thumbnail. Only links from Vimeo & YouTube are supported.',
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// DETAIL GALLERY
				array(
					'name'             => 'Post detail gallery',
					'desc'             => 'The images that will be used in the post detail gallery.',
					'id'               => "{$prefix}detail_gallery",
					'type'             => 'image_advanced',
					'max_file_uploads' => 50,
				),
				
				// DETAIL REV SLIDER
				array(
					'name' => 'Revolution slider alias',
					'id' => $prefix . 'detail_rev_slider_alias',
					'desc' => "Enter the revolution slider alias for the slider that you want to show.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// DETAIL CUSTOM
				array(
					'name' => 'Custom detail display',
					'desc' => "If you'd like to provide your own detail media, please add it here",
					'id'   => "{$prefix}custom_media",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
				
				// SIDEBAR OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => 'Sidebar Options',
				    'id' 	=> "{$prefix}heading_sidebar",
				    'type' 	=> 'section'
				),
				
				// SIDEBAR CONFIG
				array(
					'name' => 'Sidebar configuration',
					'id'   => "{$prefix}sidebar_config",
					'type' => 'select',
					// Array of 'key' => 'value' pairs for select box
					'options' => array(
						'no-sidebars'		=> 'No Sidebars',
						'left-sidebar'		=> 'Left Sidebar',
						'right-sidebar'		=> 'Right Sidebar',
						'both-sidebars'		=> 'Both Sidebars'
					),
					// Select multiple values, optional. Default is false.
					'multiple' => false,
					// Default value, can be string (single value) or array (for both single and multiple values)
					'std'  => $default_sidebar_config,
					'desc' => 'Choose the sidebar configuration for the detail page of this portfolio item.',
				),
				
				// LEFT SIDEBAR
				array (
					'name' 	=> 'Left Sidebar',
				    'id' 	=> "{$prefix}left_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_left_sidebar
				),
				
				// RIGHT SIDEBAR
				array (
					'name' 	=> 'Right Sidebar',
				    'id' 	=> "{$prefix}right_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_right_sidebar
				),
				
				// PAGE BACKGROUND OPTIONS
				array (
					'name' 	=> '',
					'title' => 'Page Background Image Options (boxed layout only)',
				    'id' 	=> "{$prefix}heading_page",
				    'type' 	=> 'section'
				),
				
				// BACKGROUND IMAGE
				array(
					'name'	=> 'Background Image',
					'desc'  => 'The image that will be used as the page background image.',
					'id'    => "{$prefix}background_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// BACKGROUND SIZE
				array(
					'name' => 'Background Image Size',
					'desc' => 'For fullscreen images, choose Cover. For repeating patterns, choose Auto.',
					'id'   => "{$prefix}background_image_size",
					'type' => 'select',
					'options' => array(
						'cover'		=> 'Cover',
						'auto'	=> 'Auto'
					),
					'multiple' => false,
					'std'  => 'cover',
				),	
				
				// SWIFT SLIDER ENTRY SECTION
				array (
					'name' 	=> '',
					'title' => 'Swift Slider Entry Options',
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// SWIFT SLIDER BACKGROUND IMAGE
				array(
					'name'	=> 'Slide background image',
					'desc'  => 'The image that will be used as the slide image in the Swift Slider.',
					'id'    => "{$prefix}posts_slider_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// SWIFT SLIDER CAPTION POSITION
				array(
					'name' => 'Caption Position',
					'id'   => "{$prefix}caption_position",
					'type' => 'select',
					'options' => array(
						'caption-left'		=> 'Left',
						'caption-right'		=> 'Right'
					),
					'multiple' => false,
					'std'  => 'caption-right',
					'desc' => 'Choose which side you would like to display the caption over the slide.',
				),
				
				// MISC
				array (
					'name' 	=> '',
					'title' => 'Misc. Options',
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// REMOVE BREADCRUMBS
				array(
					'name' => 'Remove breadcrumbs',    // File type: checkbox
					'id'   => "{$prefix}no_breadcrumbs",
					'type' => 'checkbox',
					'desc' => 'Remove the breadcrumbs on the page.',
					'std' => 0,
				),
				
				// Extra Page Class
				array(
					'name' => 'Extra page class',
					'id' => $prefix . 'extra_page_class',
					'desc' => "If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				)
				
			)
		);
		
		
		/* ==================================================
			
		Team Meta Box
		
		================================================== */
		
		$meta_boxes[] = array(
			'id'    => 'team_meta_box',
			'title' => 'Team Member Meta',
			'pages' => array( 'team' ),
			'fields' => array(
			
				// TEAM MEMBER DETAILS SECTION
				array (
					'name' 	=> '',
					'title' => 'Team Member Details',
				    'id' 	=> "{$prefix}heading_team_member_details",
				    'type' 	=> 'section'
				),
				
				// TEAM MEMBER POSITION
				array(
					'name' => 'Position',
					'id' => $prefix . 'team_member_position',
					'desc' => "Enter the team member's position within the team.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER EMAIL
				array(
					'name' => 'Email Address',
					'id' => $prefix . 'team_member_email',
					'desc' => "Enter the team member's email address.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER PHONE NUMBER
				array(
					'name' => 'Phone Number',
					'id' => $prefix . 'team_member_phone_number',
					'desc' => "Enter the team member's phone number.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER TWITTER
				array(
					'name' => 'Twitter',
					'id' => $prefix . 'team_member_twitter',
					'desc' => "Enter the team member's Twitter username.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER FACEBOOK
				array(
					'name' => 'Facebook',
					'id' => $prefix . 'team_member_facebook',
					'desc' => "Enter the team member's Facebook URL.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER LINKEDIN
				array(
					'name' => 'LinkedIn',
					'id' => $prefix . 'team_member_linkedin',
					'desc' => "Enter the team member's LinkedIn URL.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER GOOGLE+
				array(
					'name' => 'Google+',
					'id' => $prefix . 'team_member_google_plus',
					'desc' => "Enter the team member's Google+ URL.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER SKYPE
				array(
					'name' => 'Skype',
					'id' => $prefix . 'team_member_skype',
					'desc' => "Enter the team member's Skype username.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER INSTAGRAM
				array(
					'name' => 'Instagram',
					'id' => $prefix . 'team_member_instagram',
					'desc' => "Enter the team member's Instragram URL (e.g. http://hashgr.am/).",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER DRIBBBLE
				array(
					'name' => 'Dribbble',
					'id' => $prefix . 'team_member_dribbble',
					'desc' => "Enter the team member's Dribbble username.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				)
			)
		);
		
		
		/* ==================================================
			
		Clients Meta Box
		
		================================================== */
		
		$meta_boxes[] = array(
			'id'    => 'client_meta_box',
			'title' => 'Client Meta',
			'pages' => array( 'clients' ),
			'fields' => array(
				
				// CLIENT IMAGE LINK
				array(
					'name' => 'Client Link',
					'id' => $prefix . 'client_link',
					'desc' => "Enter the link for the client if you want the image to be clickable.",
					'clone' => false,
					'type'  => 'text',
					'std' => ''
				)
			)	
		);
		
		
		/* ==================================================
			
		Testimonials Meta Box
		
		================================================== */
		
		$meta_boxes[] = array(
			'id'    => 'testimonials_meta_box',
			'title' => 'Testimonial Meta',
			'pages' => array( 'testimonials' ),
			'fields' => array(
				
				// TESTIMONAIL CITE
				array(
					'name' => 'Testimonial Cite',
					'id' => $prefix . 'testimonial_cite',
					'desc' => "Enter the cite for the testimonial.",
					'clone' => false,
					'type'  => 'text',
					'std' => ''
				)
			)	
		);
		
		/* ==================================================
			
		Product Meta Box
		
		================================================== */
		
		$meta_boxes[] = array(
			// Meta box id, UNIQUE per meta box. Optional since 4.1.5
			'id' => 'product_meta_box',
		
			// Meta box title - Will appear at the drag and drop handle bar. Required.
			'title' => 'Product Meta',
		
			// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
			'pages' => array( 'product' ),
		
			// Where the meta box appear: normal (default), advanced, side. Optional.
			'context' => 'normal',
		
			// Order of meta box: high (default), low. Optional.
			'priority' => 'high',
		
			// List of meta fields
			'fields' => array(
									
				// MAIN DETAIL SECTION
				array (
					'name' 	=> '',
					'title' => 'Main Detail Options',
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// SHOW PAGE TITLE
				array(
					'name' => 'Show page title',    // File type: checkbox
					'id'   => "{$prefix}page_title",
					'type' => 'checkbox',
					'desc' => 'Show the page title at the top of the page.',
					'std' => $default_show_page_heading,
				),
				
				// PAGE TITLE LINE 1
				array(
					'name' => 'Page Title (Line 1)',
					'id' => $prefix . 'page_title_one',
					'desc' => "Enter the first line of the page title area.",
					'type'  => 'text',
					'std' => '',
				),
				
				// PAGE TITLE LINE 2
				array(
					'name' => 'Page Title (Line 2)',
					'id' => $prefix . 'page_title_two',
					'desc' => "Enter the second line of the page title area.",
					'type'  => 'text',
					'std' => '',
				),
				
				// PAGE TITLE BACKGROUND
				array(
					'name' => 'Page Title Background',
					'id'   => "{$prefix}page_title_bg",
					'type' => 'select',
					'options' => array(
						'none'		=> 'None',
						'alt-one'		=> 'Alt 1',
						'alt-two'		=> 'Alt 2',
						'alt-three'		=> 'Alt 3',
						'alt-four'		=> 'Alt 4',
						'alt-five'		=> 'Alt 5',
						'alt-six'		=> 'Alt 6',
						'alt-seven'		=> 'Alt 7',
						'alt-eight'		=> 'Alt 8',
						'alt-nine'		=> 'Alt 9',
						'alt-ten'		=> 'Alt 10'
					),
					'multiple' => false,
					'std'  => $default_page_heading_bg_alt,
					'desc' => 'Choose the background for the page title (configured in the Flexform Options panel).',
				),
				
				// ALT BG PREVIEW
				array (
					'name' 	=> '',
				    'id' 	=> "{$prefix}altbg-preview",
				    'type' 	=> 'altbgpreview'
				),
		
				// SIDEBAR OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => 'Sidebar Options',
				    'id' 	=> "{$prefix}heading_sidebar",
				    'type' 	=> 'section'
				),
				
				// SIDEBAR CONFIG
				array(
					'name' => 'Sidebar configuration',
					'id'   => "{$prefix}sidebar_config",
					'type' => 'select',
					// Array of 'key' => 'value' pairs for select box
					'options' => array(
						'no-sidebars'		=> 'No Sidebars',
						'left-sidebar'		=> 'Left Sidebar',
						'right-sidebar'		=> 'Right Sidebar',
						'both-sidebars'		=> 'Both Sidebars'
					),
					// Select multiple values, optional. Default is false.
					'multiple' => false,
					// Default value, can be string (single value) or array (for both single and multiple values)
					'std'  => $default_sidebar_config,
					'desc' => 'Choose the sidebar configuration for the detail page of this portfolio item.',
				),
				
				// LEFT SIDEBAR
				array (
					'name' 	=> 'Left Sidebar',
				    'id' 	=> "{$prefix}left_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_left_sidebar
				),
				
				// RIGHT SIDEBAR
				array (
					'name' 	=> 'Right Sidebar',
				    'id' 	=> "{$prefix}right_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_right_sidebar
				),
				
				// PAGE BACKGROUND OPTIONS
				array (
					'name' 	=> '',
					'title' => 'Page Background Image Options (boxed layout only)',
				    'id' 	=> "{$prefix}heading_page",
				    'type' 	=> 'section'
				),
				
				// BACKGROUND IMAGE
				array(
					'name'	=> 'Background Image',
					'desc'  => 'The image that will be used as the page background image.',
					'id'    => "{$prefix}background_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// BACKGROUND SIZE
				array(
					'name' => 'Background Image Size',
					'desc' => 'For fullscreen images, choose Cover. For repeating patterns, choose Auto.',
					'id'   => "{$prefix}background_image_size",
					'type' => 'select',
					'options' => array(
						'cover'		=> 'Cover',
						'auto'	=> 'Auto'
					),
					'multiple' => false,
					'std'  => 'cover',
				),	
							
				// MISC
				array (
					'name' 	=> '',
					'title' => 'Misc. Options',
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// REMOVE BREADCRUMBS
				array(
					'name' => 'Remove breadcrumbs',    // File type: checkbox
					'id'   => "{$prefix}no_breadcrumbs",
					'type' => 'checkbox',
					'desc' => 'Remove the breadcrumbs on the page.',
					'std' => 0,
				),
				
				// Extra Page Class
				array(
					'name' => 'Extra page class',
					'id' => $prefix . 'extra_page_class',
					'desc' => "If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				)
				
			)
		);
		
		
		/* ==================================================
			
		Page Meta Box
		
		================================================== */
		
		$meta_boxes[] = array(
			'id'    => 'page_meta_box',
			'title' => 'Page Meta',
			'pages' => array( 'page' ),
			'fields' => array(
			
				// PAGE OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => 'Page Options',
				    'id' 	=> "{$prefix}heading_page",
				    'type' 	=> 'section'
				),
				
				// HIDE PAGE HEADER
				array(
					'name' => 'Hide page header',    // File type: checkbox
					'id'   => "{$prefix}hide_page_header",
					'type' => 'checkbox',
					'desc' => 'Hide the page header / top bar on this page.',
					'std' => 0,
				),
				
				// HIDE PAGE FOOTER
				array(
					'name' => 'Hide page footer',    // File type: checkbox
					'id'   => "{$prefix}hide_page_footer",
					'type' => 'checkbox',
					'desc' => 'Hide the page footer and copyright bar on this page.',
					'std' => 0,
				),
				
				// SHOW PAGE TITLE
				array(
					'name' => 'Show page title',    // File type: checkbox
					'id'   => "{$prefix}page_title",
					'type' => 'checkbox',
					'desc' => 'Show the page title at the top of the page.',
					'std' => $default_show_page_heading,
				),
				
				// PAGE TITLE LINE 1
				array(
					'name' => 'Page Title (Line 1)',
					'id' => $prefix . 'page_title_one',
					'desc' => "Enter the first line of the page title area.",
					'type'  => 'text',
					'std' => '',
				),
				
				// PAGE TITLE LINE 2
				array(
					'name' => 'Page Title (Line 2)',
					'id' => $prefix . 'page_title_two',
					'desc' => "Enter the second line of the page title area.",
					'type'  => 'text',
					'std' => '',
				),
				
				// PAGE TITLE BACKGROUND
				array(
					'name' => 'Page Title Background',
					'id'   => "{$prefix}page_title_bg",
					'type' => 'select',
					'options' => array(
						'none'		=> 'None',
						'alt-one'		=> 'Alt 1',
						'alt-two'		=> 'Alt 2',
						'alt-three'		=> 'Alt 3',
						'alt-four'		=> 'Alt 4',
						'alt-five'		=> 'Alt 5',
						'alt-six'		=> 'Alt 6',
						'alt-seven'		=> 'Alt 7',
						'alt-eight'		=> 'Alt 8',
						'alt-nine'		=> 'Alt 9',
						'alt-ten'		=> 'Alt 10'
					),
					'multiple' => false,
					'std'  => $default_page_heading_bg_alt,
					'desc' => 'Choose the background for the page title (configured in the Flexform Options panel).',
				),
				
				// ALT BG PREVIEW
				array (
					'name' 	=> '',
				    'id' 	=> "{$prefix}altbg-preview",
				    'type' 	=> 'altbgpreview'
				),
				
				// PAGE BACKGROUND OPTIONS
				array (
					'name' 	=> '',
					'title' => 'Page Background Image Options (boxed layout only)',
				    'id' 	=> "{$prefix}heading_page",
				    'type' 	=> 'section'
				),
				
				// BACKGROUND IMAGE
				array(
					'name'	=> 'Background Image',
					'desc'  => 'The image that will be used as the page background image.',
					'id'    => "{$prefix}background_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// BACKGROUND SIZE
				array(
					'name' => 'Background Image Size',
					'desc' => 'For fullscreen images, choose Cover. For repeating patterns, choose Auto.',
					'id'   => "{$prefix}background_image_size",
					'type' => 'select',
					'options' => array(
						'cover'		=> 'Cover',
						'auto'	=> 'Auto'
					),
					'multiple' => false,
					'std'  => 'cover',
				),	
				
				array (
					'name' 	=> '',
					'title' => 'Slider Options',
				    'id' 	=> "{$prefix}heading_page",
				    'type' 	=> 'section'
				),
				
				// SHOW SWIFT SLIDER
				array(
					'name' => 'Show Swift Slider',    // File type: checkbox
					'id'   => "{$prefix}posts_slider",
					'type' => 'checkbox',
					'desc' => 'Show the Swift Slider at the top of the page.',
					'std' => 0,
				),
				
				// SWIFT SLIDER TYPE
				array(
					'name' => 'Swift Slider Type',
					'id'   => "{$prefix}posts_slider_type",
					'type' => 'select',
					'options' => array(
						'post'		=> 'Posts',
						'portfolio'	=> 'Portfolio',
						'hybrid'	=> 'Hybrid'
					),
					'multiple' => false,
					'std'  => 'post',
					'desc' => 'Choose the post type to display in the Swift Slider.',
				),
				
				// SWIFT SLIDER CATEGORY
				array(
					'name' => 'Swift Slider category',    // File type: checkbox
					'id'   => "{$prefix}posts_slider_category",
					'type' => 'select',
					'desc' => 'Select the category for which the Swift Slider should show posts from.',
					'options' => get_category_list('category'),
					'std' => '',
				),
				
				// SWIFT SLIDER PORTFOLIO CATEGORY
				array(
					'name' => 'Swift Slider portfolio category',    // File type: checkbox
					'id'   => "{$prefix}posts_slider_portfolio_category",
					'type' => 'select',
					'desc' => 'Select the category for which the Swift Slider should show portfolio items from.',
					'options' => get_category_list('portfolio-category'),
					'std' => '',
				),
				
				// SWIFT SLIDER COUNT
				array(
					'name' => 'Swift Slider count',
					'id' => $prefix . 'posts_slider_count',
					'desc' => "The number of posts to show in the Swift Slider.",
					'type'  => 'text',
					'std' => '5',
				),
				
				// SHOW FULL WIDTH REV SLIDER
				array(
					'name' => 'Revolution slider alias',
					'id' => $prefix . 'rev_slider_alias',
					'desc' => "Enter the revolution slider alias for the slider that you want to show. NOTE: If you have the Swift Slider enabled above, then this will be ignored.",
					'type'  => 'text',
					'std' => '',
				),
				
				// SIDEBAR OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => 'Sidebar Options',
				    'id' 	=> "{$prefix}heading_sidebar",
				    'type' 	=> 'section'
				),
				
				// SIDEBAR CONFIG
				array(
					'name' => 'Sidebar configuration',
					'id'   => "{$prefix}sidebar_config",
					'type' => 'select',
					// Array of 'key' => 'value' pairs for select box
					'options' => array(
						'no-sidebars'		=> 'No Sidebars',
						'left-sidebar'		=> 'Left Sidebar',
						'right-sidebar'		=> 'Right Sidebar',
						'both-sidebars'		=> 'Both Sidebars'
					),
					// Select multiple values, optional. Default is false.
					'multiple' => false,
					// Default value, can be string (single value) or array (for both single and multiple values)
					'std'  => $default_sidebar_config,
					'desc' => 'Choose the sidebar configuration for the detail page of this portfolio item.',
				),
				
				// LEFT SIDEBAR
				array (
					'name' 	=> 'Left Sidebar',
				    'id' 	=> "{$prefix}left_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_left_sidebar
				),
				
				// RIGHT SIDEBAR
				array (
					'name' 	=> 'Right Sidebar',
				    'id' 	=> "{$prefix}right_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_right_sidebar
				),
				
				// MISC OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => 'Misc. Options',
				    'id' 	=> "{$prefix}heading_sidebar",
				    'type' 	=> 'section'
				),
				
				// REMOVE BREADCRUMBS
				array(
					'name' => 'Remove breadcrumbs',    // File type: checkbox
					'id'   => "{$prefix}no_breadcrumbs",
					'type' => 'checkbox',
					'desc' => 'Remove the breadcrumbs on the page.',
					'std' => 0,
				),
				
				// Extra Page Class
				array(
					'name' => 'Extra page class',
					'id' => $prefix . 'extra_page_class',
					'desc' => "If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.",
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// REMOVE TOP SPACING
				array(
					'name' => 'Remove top spacing',    // File type: checkbox
					'id'   => "{$prefix}no_top_spacing",
					'type' => 'checkbox',
					'desc' => 'Remove the spacing at the top of the page.',
					'std' => 0,
				),
				
				// REMOVE BOTTOM SPACING
				array(
					'name' => 'Remove bottom spacing',    // File type: checkbox
					'id'   => "{$prefix}no_bottom_spacing",
					'type' => 'checkbox',
					'desc' => 'Remove the spacing at the bottom of the page.',
					'std' => 0,
				)
			)
		);
	
		return $meta_boxes;
	}
	add_filter( 'rwmb_meta_boxes', 'sf_register_meta_boxes' );
