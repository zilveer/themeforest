<?php

$sections[] = array(
	'title' => __('General Settings', "orangeidea"),
	'header' => '',
	'desc' => '',
	'icon_class' => 'icon-small',
    'icon' => 'el el-home',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
	'fields' => array(

			
			 array(
				'id'       => 'oi_web_page_layout',
				'type'     => 'select',
				'title'    => __('WebSite Layout', 'redux-framework-demo'), 
				'subtitle' => __('', 'redux-framework-demo'),
				'compiler' => true,
				'desc'     => __('', 'redux-framework-demo'),
				// Must provide key => value pairs for select options
				'options'  => array(
					'boxed' => 'Normal Boxed',
					'smallboxed' => 'Small Boxed',
					'fullwidth' => 'Full Width',
				),
				'default'  => 'smallboxed',
			),
			
			array(
				'id'       => 'oi_page_comments',
				'type'     => 'select',
				'title'    => __('Show Page Comments?', 'redux-framework-demo'), 
				'subtitle' => __('', 'redux-framework-demo'),
				'compiler' => true,
				'desc'     => __('', 'redux-framework-demo'),
				// Must provide key => value pairs for select options
				'options'  => array(
					'yes' => 'yes',
					'no' => 'no',
				),
				'default'  => 'yes',
			),
			 
			 
			
			
			 array(
				'id'       => 'oi-background',
				'type'     => 'background',
				'compiler' => true,
				'title'    => __('Body Background', 'redux-framework-demo'),
				'subtitle' => __('Body background with image, color, etc.', 'redux-framework-demo'),
				'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
				'default'  => array(
					'background-color' => '#f5f5f5',
				)
			),
			
			array(
				'id'       => 'oi-page_background',
				'type'     => 'background',
				'compiler'  => array('.oi_default_page'),
				'title'    => __('Page Holder Background', 'redux-framework-demo'),
				'default'  => array(
					'background-color' => '#fdfdfd',
				)
			),
			
			
			array(
				'id'=>'oi_header_favicon',
				'type' => 'media', 
				'url'=> true,
				'title' => __('Favicon Upload', "orangeidea"),
				'desc'=> __('Upload your favicon the url', "orangeidea"),
				'subtitle' => __('Upload image using the native media uploader, or define the URL directly', "orangeidea"),
				'default'=>array('url'=> $theme_path_images . 'favicon.ico' ),
			),
			
			
			
			
			
			
			
			
			array(
				'id'       => 'oi_accent_color',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Main accent color', 'orangeidea'), 
				'subtitle' => __('Pick a color for the theme (default: red).', 'orangeidea'),
				'default'  => '#aec71e',
				'validate' => 'color',
			),
			
			array(
				'id'               => 'oi_portfolio_link',
				'type'             => 'text',
				'title'            => __('Link to your Portfolio Page', 'orangeidea'), 
				'default'          => '#',
			),
			
			
				
			  
			array(
					'id'=>'oi_custom_css',
					'type' => 'ace_editor',
					'mode' => 'css',
					'compiler' => true,
					'theme' => 'monokai',
					'title' => __('Custom CSS', "orangeidea"), 
					'subtitle' => __('Quickly add some CSS to your theme by adding it to this block.', "orangeidea"),
					'desc' => __('This field is even CSS validated!', "color-theme-framework"),
					'validate' => "css",
					'default' => "",
				),
				
				),
			);