<?php
/**************************/
//TopLine Settings
/**************************/
$sections[] = array(
	'title'  => __( 'Logo & Menu', 'orangeidea' ),
	'icon'   => 'el el-adjust-alt',
	'subsection' => false,
	'fields' => array(
	
		array(
			'id'       => 'oi_logo-menu_wide',
			'type'     => 'select',
			'title'    => __('Logo & Menu Wide', 'redux-framework-demo'), 
			'subtitle' => __('', 'redux-framework-demo'),
			'compiler' => true,
			'desc'     => __('', 'redux-framework-demo'),
			'options'  => array(
				'boxed' => 'Boxed',
				'fullwidth' => 'Full Width',
			),
			'default'  => 'boxed',
		),
		
		array(
			'id'=>'oi_logo_upload',
			'type' => 'media', 
			'url'=> true,
			'title' => __('Logo Upload', "orangeidea"),
			'desc'=> __('Upload your logo or paste the url', "orangeidea"),
			'subtitle' => __('Upload image using the native media uploader, or define the URL directly', "orangeidea"),
			'default'=>array('url'=> $theme_path_images . 'logo.png' ),
		),
		
		
		$fields = array(
			'id'             => 'oi_logo-menu-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_logo_holder'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Logo & Menu Padding', 'redux-framework-demo'),
			'default'            => array(
				'padding-top'     => '0px', 
				'padding-right'   => '0px', 
				'padding-bottom'  => '0px', 
				'padding-left'    => '0px',
				'units'          => 'px', 
			)
		),
		
		
		
		
		$fields = array( 
			'id'       => 'oi_logo-menu-border',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Border Option', 'redux-framework-demo'),
			'compiler'         => array('.oi_logo_holder'),
			'default'  => array(
				'border-color'  => '#eaeaea', 
				'border-style'  => 'solid', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '1px', 
				'border-left'   => '0px'
			)
		),
		
		array(
			'id'       => 'oi-logo-menu-background',
			'type'     => 'background',
			'compiler'         => array('.oi_logo_holder'),
			'title'    => __('Background', 'redux-framework-demo'),
			'default'  => array(
				'background-color' => '#f9f9f9',
			)
		),
		
		$fields = array(
			'id'          => 'oi_menu-typography',
			'type'        => 'typography', 
			'title'       => __('Menu Typography', 'redux-framework-demo'),
			'google'      => true,
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			'color'=> false,
			'compiler'         => array('ul.oi_header_menu_fixed > li > a'),
			'units'       =>'px',
			'subtitle'    => __('Typography option for menu links', 'redux-framework-demo'),
			'default'     => array(
				'font-weight'  => 'Normal 600', 
				'font-style' => '600',
				'font-family' => 'Open Sans', 
				'google'      => true,
				'font-size'   => '12px', 
				'line-height' => '20px',
				'letter-spacing'=> '0px',
				'text-transform'=>'Uppercase',
			),
		),
		
		
		$fields = array(
			'id'             => 'oi_logo-menu-menu-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_header_menu_fixed > li > a'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Menu Items Padding', 'redux-framework-demo'),
			'default'            => array(
				'padding-top'     => '25px', 
				'padding-right'   => '20px', 
				'padding-bottom'  => '25px', 
				'padding-left'    => '20px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'             => 'oi_logo-menu-menu-margins',
			'type'           => 'spacing',
			'compiler'         => array('.oi_header_menu_fixed > li > a'),
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Menu Items Margins', 'redux-framework-demo'),
			'default'            => array(
				'margin-top'     => '0px', 
				'margin-right'   => '0px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '0px',
				'units'          => 'px', 
			)
		),
		$fields = array(
			'id'       => 'oi_logo-menu-menu-border-radius',
			'type'     => 'spinner',
			'compiler' =>true,
			'title'    => __('Border radius', 'redux-framework-demo'),
			'default'  => '0',
			'min'      => '0',
			'step'     => '1',
			'max'      => '100',
		),
				
		
		$fields = array(
			'id'       => 'oi_logo-menu-menu',
			'type'     => 'link_color',
			'compiler'         => array('.oi_header_menu_fixed > li > a'),
			'title'    => __('Menu Items color', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#666666',
				'hover'    => '#fff',
				'active'   => '#fff',
			)
		),
		
		$fields = array(
			'id'       => 'oi_logo-menu-menu-li-a-bg',
			'type'     => 'link_color',
			'compiler'         => true,
			'title'    => __('Menu Items background', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#f9f9f9',
				'hover'    => '#444444',
				'active'   => '#aec71e',
			)
		),
		
		$fields = array( 
			'id'       => 'oi_logo-menu-border-standard',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Menu Item Border', 'redux-framework-demo'),
			'compiler'         => array('.oi_header_menu_fixed > li > a'),
			'default'  => array(
				'border-color'  => '#fff', 
				'border-style'  => 'solid', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
		
		
		$fields = array( 
			'id'       => 'oi_logo-menu-border-hover',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Border On Hover', 'redux-framework-demo'),
			'compiler'         => true,
			'default'  => array(
				'border-color'  => '#000', 
				'border-style'  => 'solid', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
		
		$fields = array( 
			'id'       => 'oi_logo-menu-border-active',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Border Active Element', 'redux-framework-demo'),
			'compiler'         => true,
			'default'  => array(
				'border-color'  => '#000', 
				'border-style'  => 'solid', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
		
		$fields = array(
			'id'             => 'oi_logo-menu-sub_menu-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_header_menu_fixed > li > ul > li > a','.oi_header_menu_fixed >li:not(.megamenu) > ul > li> ul > li > a', '.oi_header_menu_fixed > li.megamenu > ul > li > ul > li > a'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Sub Menu Items Padding', 'redux-framework-demo'),
			'default'            => array(
				'padding-top'     => '7px', 
				'padding-right'   => '20px', 
				'padding-bottom'  => '7px', 
				'padding-left'    => '20px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'       => 'oi_logo-menu-sub_menu',
			'type'     => 'link_color',
			'compiler'         => array('.oi_header_menu_fixed > li > ul > li > a','.oi_header_menu_fixed >li:not(.megamenu) > ul > li> ul > li > a', '.oi_header_menu_fixed > li.megamenu > ul > li > ul > li > a', '.oi_header_menu_fixed > li.megamenu > ul >  a', '.oi_header_menu_fixed > li > ul.sub-menu > li >  a'),
			'title'    => __('Sub Menu Items color', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#888',
				'hover'    => '#fff',
				'active'   => '#fff',
			)
		),
		
		$fields = array(
			'id'       => 'oi_logo-menu-sub_menu-li-a-bg',
			'type'     => 'link_color',
			'compiler'         => true,
			'title'    => __('Sub Menu Items background', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#444444',
				'hover'    => '#aec71e',
				'active'   => '#aec71e',
			)
		),
		
		
		
		$fields = array(
			'id'        => 'oi_megamenu-title-color',
			'type'      => 'color_rgba',
			'title'     => 'Megamenu Title Color',
			'subtitle'  => 'Set color and alpha channel',
			'compiler' => true,
		 
			'default'   => array(
				'color'     => '#fff',
				'alpha'     => 1
			),
		 
			'options'       => array(
				'show_input'                => true,
				'show_initial'              => true,
				'show_alpha'                => true,
				'show_palette'              => true,
				'show_palette_only'         => false,
				'show_selection_palette'    => true,
				'max_palette_size'          => 10,
				'allow_empty'               => true,
				'clickout_fires_change'     => false,
				'choose_text'               => 'Choose',
				'cancel_text'               => 'Cancel',
				'show_buttons'              => true,
				'use_extended_classes'      => true,
				'palette'                   => null,  // show default
				'input_text'                => 'Select Color'
			),                        
		),
		
		$fields = array(
			'id'        => 'oi_megamenu-ul-bg',
			'type'      => 'color_rgba',
			'title'     => 'Megamenu Background',
			'subtitle'  => 'Set color and alpha channel',
			'compiler' => true,
		 
			'default'   => array(
				'color'     => '#444444',
				'alpha'     => 1
			),
		 
			'options'       => array(
				'show_input'                => true,
				'show_initial'              => true,
				'show_alpha'                => true,
				'show_palette'              => true,
				'show_palette_only'         => false,
				'show_selection_palette'    => true,
				'max_palette_size'          => 10,
				'allow_empty'               => true,
				'clickout_fires_change'     => false,
				'choose_text'               => 'Choose',
				'cancel_text'               => 'Cancel',
				'show_buttons'              => true,
				'use_extended_classes'      => true,
				'palette'                   => null,  // show default
				'input_text'                => 'Select Color'
			),                        
		),
		$fields = array(
			'id'        => 'oi_megamenu-title-bg',
			'type'      => 'color_rgba',
			'title'     => 'Megamenu Title Background',
			'subtitle'  => 'Set color and alpha channel',
			'compiler' => true,
		 
			'default'   => array(
				'color'     => '#444444',
				'alpha'     => 1
			),
		 
			'options'       => array(
				'show_input'                => true,
				'show_initial'              => true,
				'show_alpha'                => true,
				'show_palette'              => true,
				'show_palette_only'         => false,
				'show_selection_palette'    => true,
				'max_palette_size'          => 10,
				'allow_empty'               => true,
				'clickout_fires_change'     => false,
				'choose_text'               => 'Choose',
				'cancel_text'               => 'Cancel',
				'show_buttons'              => true,
				'use_extended_classes'      => true,
				'palette'                   => null,  // show default
				'input_text'                => 'Select Color'
			),                        
		),
		
		
		
		array(
			'id'       => 'oi-logo-menu-background-scroll',
			'type'     => 'background',
			'compiler'         => array('.oi_scrolled'),
			'title'    => __('Background on Scroll', 'redux-framework-demo'),
			'default'  => array(
				'background-color' => '#f9f9f9',
			)
		),
		
		$fields = array(
			'id'       => 'oi_logo-menu-menu-scroll',
			'type'     => 'link_color',
			'compiler'         => array('.oi_scrolled .oi_header_menu_fixed > li > a'),
			'title'    => __('Fixed Menu: Menu Items color', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#666666',
				'hover'    => '#fff',
				'active'   => '#fff',
			)
		),
		
		$fields = array(
			'id'       => 'oi_logo-menu-menu-li-a-bg-scroll',
			'type'     => 'link_color',
			'compiler'         => true,
			'title'    => __('Fixed Menu: Menu Items background', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#f9f9f9',
				'hover'    => '#aec71e',
				'active'   => '#aec71e',
			)
		),
		$fields = array( 
			'id'       => 'oi_logo-menu-border-standard-scroll',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Fixed Menu: Menu Item Border', 'redux-framework-demo'),
			'compiler'         => array('.oi_scrolled .oi_header_menu_fixed > li > a'),
			'default'  => array(
				'border-color'  => '#F7F9F9', 
				'border-style'  => 'solid', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
		
		
		$fields = array( 
			'id'       => 'oi_logo-menu-border-hover-scroll',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Fixed Menu: Border on hover', 'redux-framework-demo'),
			'compiler'         => true,
			'default'  => array(
				'border-color'  => '#000', 
				'border-style'  => 'solid', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
		
		$fields = array( 
			'id'       => 'oi_logo-menu-border-active-scroll',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Fixed Menu: Border Active Element', 'redux-framework-demo'),
			'compiler'         => true,
			'default'  => array(
				'border-color'  => '#000', 
				'border-style'  => 'solid', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
		
	)
);

?>