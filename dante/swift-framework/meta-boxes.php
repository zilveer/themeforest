<?php

	/*
	*
	*	Meta Box Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
	*
	*/
	
	function sf_register_meta_boxes() { 
	
		$prefix = 'sf_';
		$text_domain = "swift-framework-admin";
		
		global $meta_boxes;
		
		$meta_boxes = array();
			
		$options = get_option('sf_dante_options');
		$default_page_heading_bg_alt = $options['default_page_heading_bg_alt'];
		$default_show_page_heading = $options['default_show_page_heading'];
		$default_sidebar_config = $options['default_sidebar_config'];
		$default_left_sidebar = $options['default_left_sidebar'];
		$default_right_sidebar = $options['default_right_sidebar'];
		
		if (!$default_page_heading_bg_alt || $default_page_heading_bg_alt == "") {
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
		
		$default_product_sidebar_config = $default_product_left_sidebar = $default_product_right_sidebar = "";
		$default_include_author_info = true;
		
		if (isset($options['default_product_sidebar_config'])) {
		$default_product_sidebar_config = $options['default_product_sidebar_config'];
		}
		if (isset($options['default_product_left_sidebar'])) {
		$default_product_left_sidebar = $options['default_product_left_sidebar'];
		}
		if (isset($options['default_product_right_sidebar'])) {
		$default_product_right_sidebar = $options['default_product_right_sidebar'];
		}
		if (isset($options['default_include_author_info'])) {
		$default_include_author_info = $options['default_include_author_info'];
		}
		
		if ($default_product_sidebar_config == "") {
			$default_product_sidebar_config = "no-sidebars";
		}
		if ($default_product_left_sidebar == "") {
			$default_product_left_sidebar = "Sidebar-1";
		}		
		if ($default_product_right_sidebar == "") {
			$default_product_right_sidebar = "Sidebar-1";
		}
		
		$registered_menus = array('' => '');	
		$registered_menus = array_merge($registered_menus, get_registered_nav_menus());
		
		
		/* Thumbnail Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id' => 'thumbnail_meta_box',
			'title' => __('Thumbnail Options', $text_domain),
			'pages' => array( 'post', 'portfolio' ),
			'context' => 'normal',
			'fields' => array(
		
				// THUMBNAIL TYPE
				array(
					'name' => __('Thumbnail type', $text_domain),
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
					'desc' => __('Choose what will be used for the item thumbnail.', $text_domain)
				),
				
				// THUMBNAIL IMAGE
				array(
					'name'  => __('Thumbnail image', $text_domain),
					'desc'  => __('The image that will be used as the thumbnail image.', $text_domain),
					'id'    => "{$prefix}thumbnail_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// THUMBNAIL VIDEO
				array(
					'name' => __('Thumbnail video URL', $text_domain),
					'id' => $prefix . 'thumbnail_video_url',
					'desc' => __('Enter the video url for the thumbnail. Only links from Vimeo & YouTube are supported.', $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// THUMBNAIL GALLERY
				array(
					'name'             => __('Thumbnail gallery', $text_domain),
					'desc'             => __('The images that will be used in the thumbnail gallery.', $text_domain),
					'id'               => "{$prefix}thumbnail_gallery",
					'type'             => 'image_advanced',
					'max_file_uploads' => 50,
				),
				
				// THUMBNAIL LINK TYPE
				array(
					'name' => __('Thumbnail link type', $text_domain),
					'id'   => "{$prefix}thumbnail_link_type",
					'type' => 'select',
					'options' => array(
						'link_to_post'		=> __('Link to item', $text_domain),
						'link_to_url'		=> __('Link to URL', $text_domain),
						'link_to_url_nw'	=> __('Link to URL (New Window)', $text_domain),
						'lightbox_thumb'	=> __('Lightbox to the thumbnail image', $text_domain),
						'lightbox_image'	=> __('Lightbox to image (select below)', $text_domain),
						'lightbox_video'	=> __('Fullscreen Video Overlay (input below)', $text_domain)
					),
					'multiple' => false,
					'std'  => 'link-to-post',
					'desc' => __('Choose what link will be used for the image(s) and title of the item.', $text_domain)
				),
				
				// THUMBNAIL LINK URL
				array(
					'name' => __('Thumbnail link URL', $text_domain),
					'id' => $prefix . 'thumbnail_link_url',
					'desc' => __('Enter the url for the thumbnail link.', $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// THUMBNAIL LINK LIGHTBOX IMAGE
				array(
					'name'  => __('Thumbnail link lightbox image', $text_domain),
					'desc'  => __('The image that will be used as the lightbox image.', $text_domain),
					'id'    => "{$prefix}thumbnail_link_image",
					'type'  => 'thickbox_image'
				),
				
				// THUMBNAIL LINK LIGHTBOX VIDEO
				array(
					'name' => __('Thumbnail link lightbox video URL', $text_domain),
					'id' => $prefix . 'thumbnail_link_video_url',
					'desc' => __('Enter the video url for the thumbnail lightbox. Only links from Vimeo & YouTube are supported.', $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				)
			)
		);
		
		
		/* Detail Media Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id' => 'detail_media_meta_box',
			'title' => __('Detail Media Options', $text_domain),
			'pages' => array( 'post', 'portfolio' ),
			'context' => 'normal',
			'fields' => array(
			
				// USE THUMBNAIL CONTENT FOR THE MAIN DETAIL DISPLAY
				array(
					'name' => __('Use the thumbnail content', $text_domain),    // File type: checkbox
					'id'   => "{$prefix}thumbnail_content_main_detail",
					'type' => 'checkbox',
					'desc' => __('Uncheck this box if you wish to select different media for the main detail display.', $text_domain),
					'std' => 0,
				),
				
				// DETAIL TYPE
				array(
					'name' => __('Post detail type', $text_domain),
					'id'   => "{$prefix}detail_type",
					'type' => 'select',
					'options' => array(
						'none'		=> __('None', $text_domain),
						'image'		=> __('Image', $text_domain),
						'video'		=> __('Video', $text_domain),
						'slider'	=> __('Standard Slider', $text_domain),
						'layer-slider' => __('Revolution/Layer Slider', $text_domain),
						'custom' => __('Custom', $text_domain)
					),
					'multiple' => false,
					'std'  => 'image',
					'desc' => __('Choose what will be used for the post item detail.', $text_domain)
				),
				
				// DETAIL IMAGE
				array(
					'name'  => __('Post detail image', $text_domain),
					'desc'  => __('The image that will be used as the post detail image.', $text_domain),
					'id'    => "{$prefix}detail_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// DETAIL VIDEO
				array(
					'name' => __('Post detail video URL', $text_domain),
					'id' => $prefix . 'detail_video_url',
					'desc' => __('Enter the video url for the post thumbnail. Only links from Vimeo & YouTube are supported.', $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// DETAIL GALLERY
				array(
					'name'             => __('Post detail gallery', $text_domain),
					'desc'             => __('The images that will be used in the post detail gallery.', $text_domain),
					'id'               => "{$prefix}detail_gallery",
					'type'             => 'image_advanced',
					'max_file_uploads' => 50,
				),
				
				// DETAIL REV SLIDER
				array(
					'name' => __('Revolution slider alias', $text_domain),
					'id' => $prefix . 'detail_rev_slider_alias',
					'desc' => __("Enter the revolution slider alias for the slider that you want to show.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// DETAIL LAYER SLIDER
				array(
					'name' => __('Layer Slider alias', $text_domain),
					'id' => $prefix . 'detail_layer_slider_alias',
					'desc' => __("Enter the Layer Slider ID for the slider that you want to show.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// DETAIL CUSTOM
				array(
					'name' => __('Custom detail display', $text_domain),
					'desc' => __("If you'd like to provide your own detail media, please add it here", $text_domain),
					'id'   => "{$prefix}custom_media",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
			)
		);
		
		/* Page Heading Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id' => 'page_heading_meta_box',
			'title' => __('Page Heading Options', $text_domain),
			'pages' => array( 'post', 'portfolio', 'page', 'product', 'team', 'galleries' ),
			'context' => 'normal',
			'fields' => array(
				// SHOW PAGE TITLE
				array(
					'name' => __('Show page title', $text_domain),    // File type: checkbox
					'id'   => "{$prefix}page_title",
					'type' => 'checkbox',
					'desc' => __('Show the page title at the top of the page.', $text_domain),
					'std' => $default_show_page_heading,
				),
				
				// PAGE TITLE STYLE
				array(
					'name' => __('Page Title Style', $text_domain),
					'id'   => "{$prefix}page_title_style",
					'type' => 'select',
					'options' => array(
						'standard'		=> __('Standard', $text_domain),
						'fancy'		=> __('Fancy', $text_domain)
					),
					'multiple' => false,
					'std'  => 'standard',
					'desc' => __('Choose the heading style.', $text_domain)
				),
				
				// PAGE TITLE LINE 1
				array(
					'name' => __('Page Title', $text_domain),
					'id' => $prefix . 'page_title_one',
					'desc' => __("Enter a custom page title if you'd like.", $text_domain),
					'type'  => 'text',
					'std' => '',
				),
				
				// PAGE TITLE LINE 2
				array(
					'name' => __('Page Subtitle', $text_domain),
					'id' => $prefix . 'page_subtitle',
					'desc' => __("Enter a custom page title if you'd like (Fancy Page Title Style Only).", $text_domain),
					'type'  => 'text',
					'std' => '',
				),
				
				// REMOVE BREADCRUMBS
				array(
					'name' => __('Remove breadcrumbs', $text_domain),    // File type: checkbox
					'id'   => "{$prefix}no_breadcrumbs",
					'type' => 'checkbox',
					'desc' => __('Remove the breadcrumbs on the page (only shown on standard page titles).', $text_domain),
					'std' => 0,
				),
				
				// PAGE TITLE BACKGROUND
				array(
					'name' => __('Page Title Background', $text_domain),
					'id'   => "{$prefix}page_title_bg",
					'type' => 'select',
					'options' => array(
						'none'			=> __('None', $text_domain),
						'alt-one'		=> __('Alt 1', $text_domain),
						'alt-two'		=> __('Alt 2', $text_domain),
						'alt-three'		=> __('Alt 3', $text_domain),
						'alt-four'		=> __('Alt 4', $text_domain),
						'alt-five'		=> __('Alt 5', $text_domain),
						'alt-six'		=> __('Alt 6', $text_domain),
						'alt-seven'		=> __('Alt 7', $text_domain),
						'alt-eight'		=> __('Alt 8', $text_domain),
						'alt-nine'		=> __('Alt 9', $text_domain),
						'alt-ten'		=> __('Alt 10', $text_domain)
					),
					'multiple' => false,
					'std'  => $default_page_heading_bg_alt,
					'desc' => __('Choose the background for the page title (configured in the Dante Options panel).', $text_domain),
				),
				
				// ALT BG PREVIEW
				array (
					'name' 	=> '',
				    'id' 	=> "{$prefix}altbg-preview",
				    'type' 	=> 'altbgpreview'
				),
				
				// FANCY HEADING IMAGE UPLOAD
				array(
					'name'  => __('Fancy Heading Background Image', $text_domain),
					'desc'  => __('The image that will be used as the background for the fancy header. This will override the alt background selection.', $text_domain),
					'id'    => "{$prefix}page_title_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// FANCY HEADING TEXT STYLE
				array(
					'name' => __('Fancy Heading Text Style', $text_domain),
					'id'   => "{$prefix}page_title_text_style",
					'type' => 'select',
					'options' => array(
						'light'		=> __('Light', $text_domain),
						'dark'		=> __('Dark', $text_domain)
					),
					'multiple' => false,
					'std'  => 'light',
					'desc' => __('If you uploaded an image in the option above, choose light/dark styling for the text heading text here.', $text_domain)
				),
				
			
			)
		);
		
		
		
		/* Portfolio Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id' => 'portfolio_meta_box',
			'title' => __('Portfolio Meta', $text_domain),
			'pages' => array( 'portfolio' ),
			'context' => 'normal',
			'fields' => array(
			
				// ITEM DETAILS OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('Portfolio Item Details', $text_domain),
				    'id' 	=> "{$prefix}heading_item_details",
				    'type' 	=> 'section'
				),
				
				// Sub Text
				array(
					'name' => __('Subtitle', $text_domain),
					'id' => $prefix . 'portfolio_subtitle',
					'desc' => __("Enter a subtitle for use within the portfolio item index (optional).", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// External Link
				array(
					'name' => __('External Link', $text_domain),
					'id' => $prefix . 'portfolio_external_link',
					'desc' => __("Enter an external link for the item  (optional) (NOTE: INCLUDE HTTP://).", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
							
				// CUSTOM EXCERPT SECTION
				array (
					'name' 	=> '',
					'title' => __('Custom Excerpt', $text_domain),
				    'id' 	=> "{$prefix}heading_custom_excerpt",
				    'type' 	=> 'section'
				),
				
				// CUSTOM EXCERPT
				array(
					'name' => __('Custom excerpt', $text_domain),
					'desc' => __("You can optionally write a custom excerpt here to display instead of the excerpt that is automatically generated. If you use the page builder, then you'll want to add content to this box.", $text_domain),
					'id'   => "{$prefix}custom_excerpt",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
				
				// MAIN DETAIL SECTION
				array (
					'name' 	=> '',
					'title' => __('Main Detail Options', $text_domain),
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// FULL WIDTH MEDIA DISPLAY
				array(
					'name' => __('Media Display', $text_domain),
					'id'   => "{$prefix}fw_media_display",
					'type' => 'select',
					'options' => array(
						'fw-media'		=> __('Full Width Media', $text_domain),
						'split'		=> __('Split Media / Description', $text_domain),
						'standard'	=> __('Standard', $text_domain),
					),
					'multiple' => false,
					'std'  => 'standard',
					'desc' => __('Choose how you would like to display your selected media - full width (edge to edge), split, or standard (media with content below).', $text_domain)
				),
				
				array(
					'name' => __('Item Sidebar Content', $text_domain),
					'desc' => __("You can optionally add some content here to display in the details column, including shortcodes etc. Only visible on Standard and Full Width Media display types.", $text_domain),
					'id'   => "{$prefix}item_sidebar_content",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
							
				// HIDE DETAILS BAR
				array(
					'name' => __('Hide item details bar', $text_domain),
					'id'   => "{$prefix}hide_details",
					'type' => 'checkbox',
					'desc' => __('Check this box to hide the item details on the detail page.', $text_domain),
					'std' => 0,
				),
				
				// INCLUDE SOCIAL SHARING
				array(
					'name' => __('Include social sharing', $text_domain),
					'id'   => "{$prefix}social_sharing",
					'type' => 'checkbox',
					'desc' => __('Check this box to show social sharing icons on the detail page.', $text_domain),
					'std' => 1,
				),
							
				// SWIFT SLIDER ENTRY SECTION
				array (
					'name' 	=> '',
					'title' => __('Swift Slider Entry Options', $text_domain),
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// SWIFT SLIDER BACKGROUND IMAGE
				array(
					'name'  => __('Slide background image', $text_domain),
					'desc'  => __('The image that will be used as the slide image in the Swift Slider.', $text_domain),
					'id'    => "{$prefix}posts_slider_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// SWIFT SLIDER CAPTION POSITION
				array(
					'name' => __('Caption Position', $text_domain),
					'id'   => "{$prefix}caption_position",
					'type' => 'select',
					'options' => array(
						'caption-left'		=> __('Left', $text_domain),
						'caption-right'		=> __('Right', $text_domain)
					),
					'multiple' => false,
					'std'  => 'caption-right',
					'desc' => __('Choose which side you would like to display the caption over the slide.', $text_domain)
				),
				
				// MISC
				array (
					'name' 	=> '',
					'title' => __('Misc. Options', $text_domain),
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// Extra Page Class
				array(
					'name' => __('Extra page class', $text_domain),
					'id' => $prefix . 'extra_page_class',
					'desc' => __("If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// REMOVE PROMO BAR
				array(
					'name' => __('Remove promo bar', $text_domain),   // File type: checkbox
					'id'   => "{$prefix}remove_promo_bar",
					'type' => 'checkbox',
					'desc' => __('Remove the promo bar at the bottom of the page.', $text_domain),
					'std' => 0,
				)
			)
		);
		
		
		/* Page Background Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id' => 'page_background_meta_box',
			'title' => __('Page Background Options', $text_domain),
			'pages' => array( 'post', 'portfolio', 'page' ),
			'context' => 'normal',
			'fields' => array(
	
				// BACKGROUND IMAGE
				array(
					'name'  => __('Background Image', $text_domain),
					'desc'  => __('The image that will be used as the OUTER page background image.', $text_domain),
					'id'    => "{$prefix}background_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// BACKGROUND SIZE
				array(
					'name' => __('Background Image Size', $text_domain),
					'desc' => __('For fullscreen images, choose Cover. For repeating patterns, choose Auto.', $text_domain),
					'id'   => "{$prefix}background_image_size",
					'type' => 'select',
					'options' => array(
						'cover'		=> 'Cover',
						'auto'	=> 'Auto'
					),
					'multiple' => false,
					'std'  => 'cover',
				),
				
				// INNER BACKGROUND IMAGE
				array(
					'name'  => __('Inner Background Image', $text_domain),
					'desc'  => __('The image that will be used as the INNER page background image.', $text_domain),
					'id'    => "{$prefix}inner_background_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				)
				
			)
		);
		
		
		/* Post Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id' => 'post_meta_box',
			'title' => __('Post Meta', $text_domain),
			'pages' => array( 'post' ),
			'context' => 'normal',
			'fields' => array(
							
				// CUSTOM EXCERPT SECTION
				array (
					'name' 	=> '',
					'title' => __('Custom Excerpt', $text_domain),
				    'id' 	=> "{$prefix}heading_custom_excerpt",
				    'type' 	=> 'section'
				),
				
				// CUSTOM EXCERPT
				array(
					'name' => __('Custom excerpt', $text_domain),
					'desc' => __("You can optionally write a custom excerpt here to display instead of the excerpt that is automatically generated. If you use the page builder, then you'll want to add content to this box.", $text_domain),
					'id'   => "{$prefix}custom_excerpt",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
				
				// MAIN DETAIL SECTION
				array (
					'name' 	=> '',
					'title' => __('Main Detail Options', $text_domain),
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
							
				// FULL WIDTH MEDIA
				array(
					'name' => __('Full Width Media Display', $text_domain),
					'id'   => "{$prefix}full_width_display",
					'type' => 'checkbox',
					'desc' => __('Check this box to show the detail media above the page content / sidebar config, rather than inside the page content.', $text_domain),
					'std' => 0,
				),
				
				// INCLUDE AUTHOR INFO
				array(
					'name' => __('Include author info', $text_domain),
					'id'   => "{$prefix}author_info",
					'type' => 'checkbox',
					'desc' => __('Check this box to show the author info box on the detail page.', $text_domain),
					'std' => $default_include_author_info,
				),
				
				// INCLUDE SOCIAL SHARING
				array(
					'name' => __('Include social sharing', $text_domain),
					'id'   => "{$prefix}social_sharing",
					'type' => 'checkbox',
					'desc' => __('Check this box to show social sharing icons on the detail page.', $text_domain),
					'std' => 1,
				),
				
				// INCLUDE RELATED ARTICLES
				array(
					'name' => __('Include related articles', $text_domain),
					'id'   => "{$prefix}related_articles",
					'type' => 'checkbox',
					'desc' => __('Check this box to show related articles on the detail page.', $text_domain),
					'std' => 1,
				),
				
				// SIDEBAR OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('Sidebar Options', $text_domain),
				    'id' 	=> "{$prefix}heading_sidebar",
				    'type' 	=> 'section'
				),
				
				// SIDEBAR CONFIG
				array(
					'name' => __('Sidebar configuration', $text_domain),
					'id'   => "{$prefix}sidebar_config",
					'type' => 'select',
					'options' => array(
						'no-sidebars'		=> __('No Sidebars', $text_domain),
						'left-sidebar'		=> __('Left Sidebar', $text_domain),
						'right-sidebar'		=> __('Right Sidebar', $text_domain),
						'both-sidebars'		=> __('Both Sidebars', $text_domain)
					),
					'multiple' => false,
					'std'  => $default_sidebar_config,
					'desc' => __('Choose the sidebar configuration for the detail page of this post.', $text_domain),
				),
				
				// LEFT SIDEBAR
				array (
					'name' 	=> __('Left Sidebar', $text_domain),
				    'id' 	=> "{$prefix}left_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_left_sidebar
				),
				
				// RIGHT SIDEBAR
				array (
					'name' 	=> __('Right Sidebar', $text_domain),
				    'id' 	=> "{$prefix}right_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_right_sidebar
				),
							
				// SWIFT SLIDER ENTRY SECTION
				array (
					'name' 	=> '',
					'title' => __('Swift Slider Entry Options', $text_domain),
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// SWIFT SLIDER BACKGROUND IMAGE
				array(
					'name'  => __('Slide background image', $text_domain),
					'desc'  => __('The image that will be used as the slide image in the Swift Slider.', $text_domain),
					'id'    => "{$prefix}posts_slider_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
				
				// SWIFT SLIDER CAPTION POSITION
				array(
					'name' => __('Caption Position', $text_domain),
					'id'   => "{$prefix}caption_position",
					'type' => 'select',
					'options' => array(
						'caption-left'		=> __('Left', $text_domain),
						'caption-right'		=> __('Right', $text_domain)
					),
					'multiple' => false,
					'std'  => 'caption-right',
					'desc' => __('Choose which side you would like to display the caption over the slide.', $text_domain),
				),
				
				// MISC
				array (
					'name' 	=> '',
					'title' => __('Misc. Options', $text_domain),
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// Extra Page Class
				array(
					'name' => __('Extra page class', $text_domain),
					'id' => $prefix . 'extra_page_class',
					'desc' => __("If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// REMOVE PROMO BAR
				array(
					'name' => __('Remove promo bar', $text_domain),   // File type: checkbox
					'id'   => "{$prefix}remove_promo_bar",
					'type' => 'checkbox',
					'desc' => __('Remove the promo bar at the bottom of the page.', $text_domain),
					'std' => 0,
				)
				
			)
		);
		
		
		/* Product Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id' => 'product_meta_box',
			'title' => __('Product Meta', $text_domain),
			'pages' => array( 'product' ),
			'context' => 'normal',
			'fields' => array(
							
				// PRODUCT DESCRIPTION SECTION
				array (
					'name' 	=> '',
					'title' => __('Product Description', $text_domain),
				    'id' 	=> "{$prefix}heading_custom_excerpt",
				    'type' 	=> 'section'
				),
				
				// PRODUCT DESCRIPTION
				array(
					'name' => __('Product Short Description', $text_domain),
					'desc' => __("You can optionally write a short description here, which shows above the variations/shopping bag options.", $text_domain),
					'id'   => "{$prefix}product_short_description",
					'type' => 'wysiwyg',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
				
				// PRODUCT DESCRIPTION
				array(
					'name' => __('Product Description', $text_domain),
					'desc' => __("You can optionally write a product description here, which shows under the description accordion heading if you have the page builder enabled for product pages.", $text_domain),
					'id'   => "{$prefix}product_description",
					'type' => 'wysiwyg',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
				
				// SIDEBAR OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('Sidebar Options', $text_domain),
				    'id' 	=> "{$prefix}heading_sidebar",
				    'type' 	=> 'section'
				),
				
				// SIDEBAR CONFIG
				array(
					'name' => __('Sidebar configuration', $text_domain),
					'id'   => "{$prefix}sidebar_config",
					'type' => 'select',
					// Array of 'key' => 'value' pairs for select box
					'options' => array(
						'no-sidebars'		=> __('No Sidebars', $text_domain),
						'left-sidebar'		=> __('Left Sidebar', $text_domain),
						'right-sidebar'		=> __('Right Sidebar', $text_domain),
						'both-sidebars'		=> __('Both Sidebars', $text_domain)
					),
					// Select multiple values, optional. Default is false.
					'multiple' => false,
					// Default value, can be string (single value) or array (for both single and multiple values)
					'std'  => $default_product_sidebar_config,
					'desc' => __('Choose the sidebar configuration for the detail page of this product.', $text_domain),
				),
				
				// LEFT SIDEBAR
				array (
					'name' 	=> __('Left Sidebar', $text_domain),
				    'id' 	=> "{$prefix}left_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_product_left_sidebar
				),
				
				// RIGHT SIDEBAR
				array (
					'name' 	=> __('Right Sidebar', $text_domain),
				    'id' 	=> "{$prefix}right_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_product_right_sidebar
				),
										
				// MISC
				array (
					'name' 	=> '',
					'title' => __('Misc. Options', $text_domain),
				    'id' 	=> "{$prefix}heading_detail",
				    'type' 	=> 'section'
				),
				
				// Extra Page Class
				array(
					'name' => __('Extra page class', $text_domain),
					'id' => $prefix . 'extra_page_class',
					'desc' => __("If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// REMOVE PROMO BAR
				array(
					'name' => __('Remove promo bar', $text_domain),    // File type: checkbox
					'id'   => "{$prefix}remove_promo_bar",
					'type' => 'checkbox',
					'desc' => __('Remove the promo bar at the bottom of the page.', $text_domain),
					'std' => 0,
				)
				
			)
		);
		
		
		/* Team Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id'    => 'team_meta_box',
			'title' => __('Team Member Meta', $text_domain),
			'pages' => array( 'team' ),
			'fields' => array(
				
				// CUSTOM EXCERPT SECTION
				array (
					'name' 	=> '',
					'title' => __('Custom Excerpt', $text_domain),
				    'id' 	=> "{$prefix}heading_custom_excerpt",
				    'type' 	=> 'section'
				),
				
				// CUSTOM EXCERPT
				array(
					'name' => __('Custom excerpt', $text_domain),
					'desc' => __("You can optionally write a custom excerpt here to display instead of the excerpt that is automatically generated (this is needed if you use the page builder above).", $text_domain),
					'id'   => "{$prefix}custom_excerpt",
					'type' => 'textarea',
					'std'  => "",
					'cols' => '40',
					'rows' => '8',
				),
			
				// TEAM MEMBER DETAILS SECTION
				array (
					'name' 	=> '',
					'title' => __('Team Member Details', $text_domain),
				    'id' 	=> "{$prefix}heading_team_member_details",
				    'type' 	=> 'section'
				),
				
				// TEAM MEMBER POSITION
				array(
					'name' => __('Position', $text_domain),
					'id' => $prefix . 'team_member_position',
					'desc' => __("Enter the team member's position within the team.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER EMAIL
				array(
					'name' => __('Email Address', $text_domain),
					'id' => $prefix . 'team_member_email',
					'desc' => __("Enter the team member's email address.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER PHONE NUMBER
				array(
					'name' => __('Phone Number', $text_domain),
					'id' => $prefix . 'team_member_phone_number',
					'desc' => __("Enter the team member's phone number.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER TWITTER
				array(
					'name' => __('Twitter', $text_domain),
					'id' => $prefix . 'team_member_twitter',
					'desc' => __("Enter the team member's Twitter username.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER FACEBOOK
				array(
					'name' => __('Facebook', $text_domain),
					'id' => $prefix . 'team_member_facebook',
					'desc' => __("Enter the team member's Facebook URL.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER LINKEDIN
				array(
					'name' => __('LinkedIn', $text_domain),
					'id' => $prefix . 'team_member_linkedin',
					'desc' => __("Enter the team member's LinkedIn URL.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER GOOGLE+
				array(
					'name' => __('Google+', $text_domain),
					'id' => $prefix . 'team_member_google_plus',
					'desc' => __("Enter the team member's Google+ URL.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER SKYPE
				array(
					'name' => __('Skype', $text_domain),
					'id' => $prefix . 'team_member_skype',
					'desc' => __("Enter the team member's Skype username.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER INSTAGRAM
				array(
					'name' => __('Instagram', $text_domain),
					'id' => $prefix . 'team_member_instagram',
					'desc' => __("Enter the team member's Instragram URL (e.g. http://hashgr.am/).", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER DRIBBBLE
				array(
					'name' => __('Dribbble', $text_domain),
					'id' => $prefix . 'team_member_dribbble',
					'desc' => __("Enter the team member's Dribbble username.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// TEAM MEMBER XING
				array(
					'name' => __('Xing', $text_domain),
					'id' => $prefix . 'team_member_xing',
					'desc' => __("Enter the team member's Xing URL.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				)
			)
		);
		
		
		/* Clients Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id'    => 'client_meta_box',
			'title' => __('Client Meta', $text_domain),
			'pages' => array( 'clients' ),
			'fields' => array(
				
				// CLIENT IMAGE LINK
				array(
					'name' => __('Client Link', $text_domain),
					'id' => $prefix . 'client_link',
					'desc' => __("Enter the link for the client if you want the image to be clickable.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => ''
				),
				
				// CLIENT LINK TARGET
				array(
					'name' => __('Link to same window', $text_domain),
					'id'   => "{$prefix}client_link_same_window",
					'type' => 'checkbox',
					'desc' => __('Check this box to set the client link to open in the same browser window/tab.', $text_domain),
					'std' => 1,
				),
			)	
		);
		
		
		/* Testimonials Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id'    => 'testimonials_meta_box',
			'title' => __('Testimonial Meta', $text_domain),
			'pages' => array( 'testimonials' ),
			'fields' => array(
				
				// TESTIMONAIL CITE
				array(
					'name' => __('Testimonial Cite', $text_domain),
					'id' => $prefix . 'testimonial_cite',
					'desc' => __("Enter the cite name for the testimonial.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => ''
				),
				
				// TESTIMONAIL CITE
				array(
					'name' => __('Testimonial Cite Subtext', $text_domain),
					'id' => $prefix . 'testimonial_cite_subtext',
					'desc' => __("Enter the cite subtext for the testimonial (optional).", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => ''
				),
				
				// TESTIMONAIL IMAGE
				array(
					'name'  => __('Testimonial Cite Image', $text_domain),
					'desc'  => __('Enter the cite image for the testimonial (optional).', $text_domain),
					'id'    => "{$prefix}testimonial_cite_image",
					'type'  => 'image_advanced',
					'max_file_uploads' => 1
				),
			)	
		);
		
		
		/* Slider Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id'    => 'slider_meta_box',
			'title' => __('Page Slider Options', $text_domain),
			'pages' => array( 'page' ),
			'fields' => array(
				
				// SHOW SWIFT SLIDER
				array(
					'name' => __('Show Swift Slider', $text_domain),
					'id'   => "{$prefix}posts_slider",
					'type' => 'checkbox',
					'desc' => __('Show the Swift Slider at the top of the page.', $text_domain),
					'std' => 0,
				),
				
				// SWIFT SLIDER TYPE
				array(
					'name' => __('Swift Slider Type', $text_domain),
					'id'   => "{$prefix}posts_slider_type",
					'type' => 'select',
					'options' => array(
						'post'		=> __('Posts', $text_domain),
						'portfolio'	=> __('Portfolio', $text_domain),
						'hybrid'	=> __('Hybrid', $text_domain)
					),
					'multiple' => false,
					'std'  => 'post',
					'desc' => __('Choose the post type to display in the Swift Slider.', $text_domain),
				),
				
				// SWIFT SLIDER CATEGORY
				array(
					'name' => __('Swift Slider category', $text_domain),
					'id'   => "{$prefix}posts_slider_category",
					'type' => 'select',
					'desc' => __('Select the category for which the Swift Slider should show posts from.', $text_domain),
					'options' => sf_get_category_list_key_array('category'),
					'std' => '',
				),
				
				// SWIFT SLIDER PORTFOLIO CATEGORY
				array(
					'name' => __('Swift Slider portfolio category', $text_domain),
					'id'   => "{$prefix}posts_slider_portfolio_category",
					'type' => 'select',
					'desc' => __('Select the category for which the Swift Slider should show portfolio items from.', $text_domain),
					'options' => sf_get_category_list_key_array('portfolio-category'),
					'std' => '',
				),
				
				// SWIFT SLIDER COUNT
				array(
					'name' => __('Swift Slider count', $text_domain),
					'id' => $prefix . 'posts_slider_count',
					'desc' => __("The number of posts to show in the Swift Slider.", $text_domain),
					'type'  => 'text',
					'std' => '5',
				),
				
				// SHOW FULL WIDTH REV SLIDER
				array(
					'name' => __('Revolution slider alias', $text_domain),
					'id' => $prefix . 'rev_slider_alias',
					'desc' => __("Enter the revolution slider alias for the slider that you want to show. NOTE: If you have the Swift Slider enabled above, then this will be ignored.", $text_domain),
					'type'  => 'text',
					'std' => '',
				),
				
				// SHOW FULL WIDTH REV SLIDER
				array(
					'name' => __('LayerSlider ID', $text_domain),
					'id' => $prefix . 'layerslider_id',
					'desc' => __("Enter the LayerSlider ID for the slider that you want to show. NOTE: If you have the Swift Slider enabled above, then this will be ignored.", $text_domain),
					'type'  => 'text',
					'std' => '',
				)
			)	
		);
		
			
		/* Page Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id'    => 'page_meta_box',
			'title' => __('Page Meta', $text_domain),
			'pages' => array( 'page' ),
			'fields' => array(
				
				// HEADER OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('Header Options', $text_domain),
				    'id' 	=> "{$prefix}heading_sidebar",
				    'type' 	=> 'section'
				),
				
				// NAKED HEADER
				array(
					'name' => __('Enable Naked Header', $text_domain),    // File type: checkbox
					'id'   => "{$prefix}enable_naked_header",
					'type' => 'select',
					'options' => array(
						''		=> __('Standard Header', $text_domain),
						'naked-light'		=> __('Naked (Light)', $text_domain),
						'naked-dark'		=> __('Naked (Dark)', $text_domain),
					),
					'desc' => __('Enable naked header on this page. NOTE: It is important that you use a page slider for the naked header to be shown over.', $text_domain),
					'std' => '',
				),
				
				// SIDEBAR OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('Sidebar Options', $text_domain),
				    'id' 	=> "{$prefix}heading_sidebar",
				    'type' 	=> 'section'
				),
				
				// SIDEBAR CONFIG
				array(
					'name' => __('Sidebar configuration', $text_domain),
					'id'   => "{$prefix}sidebar_config",
					'type' => 'select',
					'options' => array(
						'no-sidebars'		=> __('No Sidebars', $text_domain),
						'left-sidebar'		=> __('Left Sidebar', $text_domain),
						'right-sidebar'		=> __('Right Sidebar', $text_domain),
						'both-sidebars'		=> __('Both Sidebars', $text_domain)
					),
					'multiple' => false,
					'std'  => $default_sidebar_config,
					'desc' => __('Choose the sidebar configuration for the detail page of this page.', $text_domain),
				),
				
				// LEFT SIDEBAR
				array (
					'name' 	=> __('Left Sidebar', $text_domain),
				    'id' 	=> "{$prefix}left_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_left_sidebar
				),
				
				// RIGHT SIDEBAR
				array (
					'name' 	=> __('Right Sidebar', $text_domain),
				    'id' 	=> "{$prefix}right_sidebar",
				    'type' 	=> 'sidebars',
				    'std' 	=> $default_right_sidebar
				),
				
				// MISC OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('One Page Options', $text_domain),
				    'id' 	=> "{$prefix}heading_onepage",
				    'type' 	=> 'section'
				),
				
				// REMOVE PROMO BAR
				array(
					'name' => __('Enable One Page Navigation', $text_domain),    // File type: checkbox
					'id'   => "{$prefix}enable_one_page_nav",
					'type' => 'checkbox',
					'desc' => __('Enable the one page nav which appears on the right of the page.', $text_domain),
					'std' => 0,
				),
				
				// MISC OPTIONS SECTION
				array (
					'name' 	=> '',
					'title' => __('Misc. Options', $text_domain),
				    'id' 	=> "{$prefix}heading_misc",
				    'type' 	=> 'section'
				),
				
				// PAGE MENU
				array(
					'name' => __('Page Menu', 'swift-framework-admin'),
					'id'   => "{$prefix}page_menu",
					'type' => 'select',
					'options' => sf_get_menu_list(),
					'multiple' => false,
					'std'  => '',
					'desc' => __('Optionally you can choose to override the menu that is used on the page. This is ideal if you want to create a page with a anchor link scroll menu.', 'swift-framework-admin'),
				),
				
				// Extra Page Class
				array(
					'name' => __('Extra page class', $text_domain),
					'id' => $prefix . 'extra_page_class',
					'desc' => __("If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.", $text_domain),
					'clone' => false,
					'type'  => 'text',
					'std' => '',
				),
				
				// REMOVE PROMO BAR
				array(
					'name' => __('Remove promo bar', $text_domain),    // File type: checkbox
					'id'   => "{$prefix}remove_promo_bar",
					'type' => 'checkbox',
					'desc' => __('Remove the promo bar at the bottom of the page.', $text_domain),
					'std' => 0,
				),
				
				// REMOVE TOP SPACING
				array(
					'name' => __('Remove top spacing', $text_domain),    // File type: checkbox
					'id'   => "{$prefix}no_top_spacing",
					'type' => 'checkbox',
					'desc' => __('Remove the spacing at the top of the page.', $text_domain),
					'std' => 0,
				),
				
				// REMOVE BOTTOM SPACING
				array(
					'name' => __('Remove bottom spacing', $text_domain),    // File type: checkbox
					'id'   => "{$prefix}no_bottom_spacing",
					'type' => 'checkbox',
					'desc' => __('Remove the spacing at the bottom of the page.', $text_domain),
					'std' => 0,
				)
			)
		);
	
	
		/* Gallery Meta Box
		================================================== */ 
		$meta_boxes[] = array(
			'id' => 'gallery_meta_box',
			'title' => __('Gallery Options', $text_domain),
			'pages' => array( 'galleries' ),
			'context' => 'normal',
			'fields' => array(
		
				// GALLERY IMAGES
				array(
					'name'             => __('Gallery Images', $text_domain),
					'desc'             => __('The images that will be used in the gallery.', $text_domain),
					'id'               => "{$prefix}gallery_images",
					'type'             => 'image_advanced',
					'max_file_uploads' => 200,
				)
			)
		);
	
		return $meta_boxes;
	}
	add_filter( 'rwmb_meta_boxes', 'sf_register_meta_boxes' );	
	
	
	function sf_build_meta_box() {
		echo'<div class="sf-meta-tabs-wrap"><div id="sf-tabbed-meta-boxes"></div></div>';
	}
	
	function sf_register_meta_box_holder() {
		add_meta_box( 'sf_meta_box', __( 'Meta Options', 'swiftframework' ), 'sf_build_meta_box', '', 'normal', 'high' );
	}
	add_action( 'add_meta_boxes', 'sf_register_meta_box_holder' );
?>