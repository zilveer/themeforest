<?php

$sections[] = array(
	'title' => __('General Settings', "qoon-creative-wordpress-portfolio-theme"),
	'header' => '',
	'desc' => '',
	'icon_class' => 'icon-small',
    'icon' => 'el el-cog',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
	'fields' => array(
			
			
			
			$fields = array(
				'id'       => 'site-layout',
				'type'     => 'image_select',
				'title'    => __('Main Layout', 'qoon-creative-wordpress-portfolio-theme'), 
				'subtitle' => __('Select Site Layout', 'qoon-creative-wordpress-portfolio-theme'),
				'options'  => array(
					'left-menu'      => array(
						'alt'   => 'Left Menu', 
						'img'   => $redux_path_images.'left-menu.png'
					),
					'standard'      => array(
						'alt'   => 'Standard', 
						'img'   => $redux_path_images.'standard.png'
					),
					'halfs'      => array(
						'alt'   => 'Halfs', 
						'img'  =>  $redux_path_images.'halfs.png'
					)
				),
				'default' => 'left-menu'
			),
			
			array(
				'id'       => 'oi_concept_ajax',
				'type'     => 'switch',
				'required' => array('site-layout','equals','left-menu'),
				'compiler'    => true, 
				'title'    => __('Show ajax page loading?', 'qoon-creative-wordpress-portfolio-theme'),
				'on'     => 'Yes', 
				'off'     => 'No', 
				'default'  => true,
			),
			
			
			array(
				'id'       => 'oi_first_page',
				'type'     => 'switch',
				'compiler'    => true,
				'required' => array('site-layout','equals','standard'),
				'title'    => __('Full Height Main Page?', 'qoon-creative-wordpress-portfolio-theme'),
				'subtitle' => __('Perfect if you want to use Full Height Revolution Slider on Home Page', 'qoon-creative-wordpress-portfolio-theme'),
				'on'     => 'Normal', 
				'off'     => 'Full Height', 
				'default'  => true,
			),
			
			$fields[] = array(         
				'id'       => 'site-background',
				'type'     => 'background',
				'compiler'    => array('body', '.oi_layout_standard'),
				'title'    => __('Body Background', 'qoon-creative-wordpress-portfolio-theme'),
				'subtitle' => __('Body background with image, color, etc.', 'qoon-creative-wordpress-portfolio-theme'),
				'default'  => array(
					'background-color' => '#fff',
				)
			),
			
			
			array(
				'id'       => 'oi_logo_style',
				'type'     => 'switch', 
				'title'    => __('Logo Style', 'qoon-creative-wordpress-portfolio-theme'),
				'on'     => 'TEXT LOGO', 
				'off'     => 'IMAGE LOGO', 
				'default'  => true,
			),
			
			
			array(
				'id'               => 'oi_logo_text',
				'type'             => 'text',
				'title'            => __('Text Logo', 'qoon-creative-wordpress-portfolio-theme'), 
				'default'          => 'QOON',
				'required' => array('oi_logo_style','equals',true)
			),
			array(
				'id'               => 'oi_logo_descr',
				'type'             => 'text',
				'title'            => __('Logo Description', 'qoon-creative-wordpress-portfolio-theme'), 
				'default'          => 'CREATIVE PORTFOLIO THEME',
				'required' => array('oi_logo_style','equals',true)
			),
			
			array(
				'id'          => 'oi_logo-typography',
				'type'        => 'typography', 
				'title'       => __('Text Logo Typography(for light BG)', 'qoon-creative-wordpress-portfolio-theme'),
				'google'      => true,
				'letter-spacing'=> true,
				'text-transform'=> true, 
				'compiler'    => array('.oi_text_logo a.oi_text_logo_a'),
				'font-backup' => true,
				'units'       =>'px',
				'default'     => array(
					'color'       => '#000', 
					'font-weight' => '800',
					'font-family' => 'Raleway', 
					'google'      => true,
					'font-size'   => '64px', 
					'line-height' => '64px',
					'letter-spacing'=>'1px'
				),
				'required' => array('oi_logo_style','equals',true)
			),
			array(
				'id'       => 'oi_logo-typography-dark',
				'type'     => 'color',
				'compiler'    => array('.background--dark:not(.oi_scrolled) .oi_text_logo a.oi_text_logo_a'),
				'title'    => __('Text Logo Color for Dark BG', 'qoon-creative-wordpress-portfolio-theme'), 
				'default'  => '#FFFFFF',
				'validate' => 'color',
			),
			
			
			
			array(
				'id'          => 'oi_logo_descr-typography',
				'type'        => 'typography', 
				'title'       => __('Logo Description Typography(for light BG)', 'qoon-creative-wordpress-portfolio-theme'),
				'google'      => true,
				'letter-spacing'=> true,
				'text-transform'=> true, 
				'compiler'    => array('.oi_site_description'),
				'font-backup' => true,
				'units'       =>'px',
				'default'     => array(
					'color'       => '#000', 
					'font-weight' => '600', 
					'font-family' => 'Raleway', 
					'google'      => true,
					'font-size'   => '12px', 
					'line-height' => '22px',
					'letter-spacing'=> '1px'
				),
				'required' => array('oi_logo_style','equals',true)
			),
			array(
				'id'       => 'oi_logo_descr-dark',
				'type'     => 'color',
				'compiler'    => array('.background--dark:not(.oi_scrolled) .oi_site_description'),
				'title'    => __('Logo Description Color for Dark BG', 'qoon-creative-wordpress-portfolio-theme'), 
				'default'  => '#FFFFFF',
				'validate' => 'color',
			),
			
			
				
			array(
				'id'=>'oi_logo_upload',
				'type' => 'media', 
				'url'=> true,
				'title' => __('Logo Upload', "qoon-creative-wordpress-portfolio-theme"),
				'desc'=> __('Upload your logo or paste the url', "qoon-creative-wordpress-portfolio-theme"),
				'subtitle' => __('Upload image using the native media uploader, or define the URL directly', "qoon-creative-wordpress-portfolio-theme"),
				'default'=>array('url'=> $theme_path_images . 'logo.png' ),
				'required' => array('oi_logo_style','equals',false)
			),			

			
			
			array(
				'id'=>'oi_header_favicon',
				'type' => 'media', 
				'url'=> true,
				'title' => __('Favicon Upload', "qoon-creative-wordpress-portfolio-theme"),
				'desc'=> __('Upload your favicon the url', "qoon-creative-wordpress-portfolio-theme"),
				'subtitle' => __('Upload image using the native media uploader, or define the URL directly', "qoon-creative-wordpress-portfolio-theme"),
				'default'=>array('url'=> $theme_path_images . 'favicon.ico' ),
			),
			
			
			array(
				'id'       => 'oi_accent_color',
				'type'     => 'color',
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'title'    => __('Main accent color', 'qoon-creative-wordpress-portfolio-theme'), 
				'subtitle' => __('Pick a color for the theme.', 'qoon-creative-wordpress-portfolio-theme'),
				'default'  => '#ffde00',
				'validate' => 'color',
			),
			
			
			array(
				'id'       => 'oi_breadcrumbs_style',
				'type'     => 'switch',
				'compiler' => true,
				'title'    => __('Show Breadcrumbs?', 'qoon-creative-wordpress-portfolio-theme'),
				'on'     => 'Yes', 
				'off'     => 'No', 
				'default'  => true,
			),
			
			array(
			'id'       => 'breadcrumbs-position',
			'type'     => 'select',
			'required' => array('oi_breadcrumbs_style','equals',true),
			'compiler' => true,
			'title'    => __('Breadcrumbs Position', 'qoon-creative-wordpress-portfolio-theme'), 
			'options'  => array(
				'left' => 'left',
				'center' => 'center',
				'right' => 'right'
			),
			'default'  => 'center',
		),
			
			
			
			$fields = array(
			'id'          => 'oi_breadcrumbs-typography',
			'type'        => 'typography', 
			'title'       => __('Breadcrumbs Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'required' => array('oi_breadcrumbs_style','equals',true),
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			'color'=> false,
			'compiler'         => array('.breadcrumbs a','.breadcrumbs span'),
			'units'       =>'px',
			'subtitle'    => __('Typography option for menu links', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'font-weight' => '400',
				'font-family' => 'Lato', 
				'google'      => true,
				'font-size'   => '12px', 
				'line-height' => '22px',
				'letter-spacing'=> '0px',
				'text-transform'=>'uppercase',
			),
		),
		
		
		$fields = array(
			'id'             => 'oi_breadcrumbs-padding',
			'type'           => 'spacing',
			'required' => array('oi_breadcrumbs_style','equals',true),
			'compiler'         => array('.breadcrumbs'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Breadcrumbs Holder Padding', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'padding-top'     => '0px', 
				'padding-right'   => '0px', 
				'padding-bottom'  => '0px', 
				'padding-left'    => '0px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'             => 'oi_breadcrumbs-margins',
			'type'           => 'spacing',
			'required' => array('oi_breadcrumbs_style','equals',true),
			'compiler'         => array('.breadcrumbs'),
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Breadcrumbs Holder Margins', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'margin-top'     => '0px',
				'margin-right'   => '0px', 
				'margin-bottom'  => '30px', 
				'margin-left'    => '0px',
				'units'          => 'px', 
			)
		),
		$fields = array( 
			'id'       => 'oi_breadcrumbs-border-standard',
			'type'     => 'border',
			'required' => array('oi_breadcrumbs_style','equals',true),
			'all' => false,
			'title'    => __('Breadcrumbs HolderBorder', 'qoon-creative-wordpress-portfolio-theme'),
			'compiler'         => array('.breadcrumbs'),
			'default'  => array(
				'border-color'  => '#ffffff', 
				'border-style'  => 'none', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
			
			
			
			
			
			
			array(
					'id'=>'oi_custom_css',
					'type' => 'ace_editor',
					'mode' => 'css',
					'compiler' => true,
					'theme' => 'monokai',
					'title' => __('Custom CSS', "qoon-creative-wordpress-portfolio-theme"), 
					'subtitle' => __('Quickly add some CSS to your theme by adding it to this block.', "qoon-creative-wordpress-portfolio-theme"),
					'desc' => __('This field is even CSS validated!', "qoon-creative-wordpress-portfolio-theme"),
					'validate' => "css",
					'default' => "",
				),
				
				
		
				
			),	
			);