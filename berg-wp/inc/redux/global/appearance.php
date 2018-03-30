<?php

return array(
	'icon'   => 'el el-screen',
	'title'  => __( 'Appearance', 'BERG' ),
	'fields' => array(


		array(
			'id'    => 'main_theme_font',
			'type'  => 'typography',
			'title' => __('Font family', 'BERG'),
			
			'line-height' => false,
			'color' => false,
			'text-align' => false,
			'letter-spacing' => false,
			'text-transform' => false,
			'font-weight' => false,
			'font-style' => false,
			'font-size' => false, 
			'all_styles' => true,
			'subsets' => false,
			'output' => array('body'),
			'default' => array(
				'font-family' => 'Lato',
				'font-size' => '14px',
				'font-weight' => '400',
			)
		),		

		array(
			'id'    => 'header_theme_font',
			'type'  => 'typography',
			'title' => __('Header font family', 'BERG'),
			
			'line-height' => false,
			'color' => false,
			'text-align' => false,
			'letter-spacing' => false,
			'text-transform' => false,
			'font-weight' => false,
			'font-style' => false,
			'font-size' => false, 
			'all_styles' => true,
			'subsets' => false,
			'output' => array('h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, .header-font-family, .product_list_widget li'),
			'default' => array(
				'font-family' => 'Cabin',
			)
		),		

		array(
			'id' => 'logo_image_light',
			'type' => 'media',
			'title' => __('Light logo image', 'BERG'),
			'default' => array(
				'url' => THEME_DIR_URI.'/img/logo1.png',
				'id' => '',
				'height' => '',
				'width' => '',
  				'thumbnail' => '',
			),			
			'htmlOptions' => array()
		),
		array(
			'id' => 'logo_image_dark',
			'type' => 'media',
			'title' => __('Dark logo image', 'BERG'),
			'default' => array(
				'url' => THEME_DIR_URI.'/img/logo2.png',
				'id' => '',
				'height' => '',
				'width' => '',
  				'thumbnail' => '',
			),	
			'htmlOptions' => array()
		),
		array(
			'id' => 'loading_image',
			'type' => 'media',
			'title' => __('Loading image', 'BERG'),
			'default' => array(
				'url' => THEME_DIR_URI.'/img/logo2.png',
				'id' => '',
				'height' => '',
				'width' => '',
  				'thumbnail' => '',
			),	
			'htmlOptions' => array()
		),		
		array(
			'id' => 'logo_animation',
			'type' => 'select',
			'title' => __('Logo animation appearance', 'BERG'),
			'options' => array( 'all' => __('On all pages', 'BERG'), 'homepage' => __('On homepage', 'BERG'), 'none' => __('None', 'BERG')),
			'default' => 'all',
			'select2'  => array( 'allowClear' => false ),
		),
		array(
			'id' => 'disable_logo_animation_mobile',
			'type' => 'checkbox',
			'title' => __('Disable logo animation on mobile', 'BERG'),
			'default' => '0'
		),

		array(
			'id' => 'berg_show_page_title',
			'type' => 'switch',
			'title' => __('Page title on pages', 'BERG'),
			'on' => 'On',
			'off' => 'Off',
			'default' => true,
		),

		array(
			'id' => 'scrollbar_handle_color',
			'type' => 'color',
			'title' => __('Scrollbar handle color', 'BERG'),
			'default' => '#aeaeae',
			'htmlOptions' =>array()
		),
		array(
			'id' => 'scrollbar_handle_color_active',
			'type' => 'color',
			'title' => __('Scrollbar handle active color', 'BERG'),
			'default' => '#bbb',
			'htmlOptions' =>array()
		),
		array(
			'id' => 'scrollbar_background_color',
			'type' => 'color',
			'title' => __('Scrollbar background color', 'BERG'),
			'default' => '#d5d5d5',
			'htmlOptions' =>array()
		),		


	),
);
