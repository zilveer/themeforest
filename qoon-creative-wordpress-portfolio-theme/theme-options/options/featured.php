<?php

$sections[] = array(
	'title' => __('Featured Area', "qoon-creative-wordpress-portfolio-theme"),
	'header' => '',
	'desc' => '',
	'icon_class' => 'icon-small',
    'icon' => 'el el-list',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
	'fields' => array(

			
			
			array(
				'id'=>'oi_featured_upload',
				'type' => 'media', 
				'url'=> true,
				'title' => __('BG image for featured heading ', "qoon-creative-wordpress-portfolio-theme"),
				'desc'=> __('Upload your image or paste the url', "qoon-creative-wordpress-portfolio-theme"),
				'subtitle' => __('Upload image using the native media uploader, or define the URL directly', "qoon-creative-wordpress-portfolio-theme"),
				'default'=>array('url'=> $theme_path_images . 'featured_bg.png' ),
			),			
			
			$fields = array(
				'id'             => 'oi_featured_p',
				'type'           => 'spacing',
				'compiler'         => array('.oi_featured_post_holder'),
				'mode'           => 'padding',
				'units'          => 'px',
				'units_extended' => 'false',
				'title'          => __('Featured Area Paddings', 'qoon-creative-wordpress-portfolio-theme'),
				'default'            => array(
					'padding-top'     => '60px', 
					'padding-right'   => '30px', 
					'padding-bottom'  => '30px', 
					'padding-left'    => '30px',
					'units'          => 'px', 
				)
			),
			$fields = array( 
				'id'       => 'oi_featured_b',
				'type'     => 'border',
				'all' => false,
				'title'    => __('Top Line Border', 'qoon-creative-wordpress-portfolio-theme'),
				'compiler'         => array('.oi_featured_post_holder'),
				'default'  => array(
					'border-color'  => '#D6DABA', 
					'border-style'  => 'solid', 
					'border-top'    => '1px', 
					'border-right'  => '1px', 
					'border-bottom' => '1px', 
					'border-left'   => '1px'
				)
			),
			array(
				'id'       => 'oi_featured_tringle_color',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Main accent color', 'qoon-creative-wordpress-portfolio-theme'), 
				'subtitle' => __('Pick a color for the theme.', 'qoon-creative-wordpress-portfolio-theme'),
				'default'  => '#EEF0E3',
				'validate' => 'color',
			),
			
			
				
				
	),	
	);