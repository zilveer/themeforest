<?php
/**************************/
//TopLine Settings
/**************************/
$sections[] = array(
	'title'  => __( 'Top Line', 'orangeidea' ),
	'icon'   => 'el el-edit',
	'subsection' => false,
	'fields' => array(
	
		$fields = array(
			'id'       => 'oi_top_line_layout',
			'type'     => 'image_select',
			'compiler' => true,
			'title'    => __('Top Line Style', 'redux-framework-demo'), 
			'options'  => array(
				'disabled'      => array(
					'alt'   => 'Disabled', 
					'img'   => $theme_path_images.'tl-disabled.jpg'
				),
				'one'      => array(
					'alt'   => 'one', 
					'img'   => $theme_path_images.'tl-one.jpg'
				),
			   'two'      => array(
					'alt'   => 'two', 
					'img'   => $theme_path_images.'tl-two.jpg'
				),
				'three'      => array(
					'alt'   => 'three', 
					'img'   => $theme_path_images.'tl-three.jpg'
				),
				'four'      => array(
					'alt'   => 'four', 
					'img'   => $theme_path_images.'tl-four.jpg'
				),
			),
			'default' => 'one'
		),
		

		array(
			'id'       => 'oi_top_line_wide',
			'type'     => 'select',
			'title'    => __('TopLine Wide', 'redux-framework-demo'), 
			'subtitle' => __('', 'redux-framework-demo'),
			'compiler' => true,
			'desc'     => __('', 'redux-framework-demo'),
			'options'  => array(
				'boxed' => 'Boxed',
				'fullwidth' => 'Full Width',
			),
			'default'  => 'boxed',
		),
		
		
		$fields = array(
			'id'               => 'oi_topline-text',
			'type'             => 'editor',
			'required' => array('oi_top_line_layout','contains',array('one','three','four')),
			'title'            => __('Top Line Content', 'redux-framework-demo'), 
			'default'          => '<span class="oi_phone"><i class="fa fa-phone"></i> +1 (132) 123-456-7890</span>',
			'args'   => array(
				'teeny'            => true,
				'textarea_rows'    => 10
			)
		),
		
		$fields = array(
			'id'       => 'top_line_mail',
			'type'     => 'switch', 
			'title'    => __('Show mail icon?', 'redux-framework-demo'),
			'default'  => true,
		),
		
		$fields = array(
			'id'        => 'top_line_mail-border',
			'type'      => 'color_rgba',
			'title'     => 'Mail Icon Border',
			'required' => array('top_line_mail','equals','1'),
			'subtitle'  => 'Set color and alpha channel',
			'compiler' => true,
		 
			'default'   => array(
				'color'     => '#000',
				'alpha'     => 0.1
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
			'id'               => 'oi_topline-modal',
			'type'             => 'editor',
			'required' => array('top_line_mail','equals','1'),
			'title'            => __('Modal Content', 'redux-framework-demo'), 
			'default'          => '<h1>Contact Us Now</h1><p>[contact-form-7 id="1125" title="Contact form 1"]</p>',
			'args'   => array(
				'teeny'            => true,
				'textarea_rows'    => 10
			)
		),
		
		$fields = array(
			'id'             => 'oi_topline-menu-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_topline_menu > li > a'),
			'required' => array('oi_top_line_layout','contains',array('two','three','four')),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Menu Items Padding', 'redux-framework-demo'),
			'default'            => array(
				'padding-top'     => '0px', 
				'padding-right'   => '5px', 
				'padding-bottom'  => '0px', 
				'padding-left'    => '5px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'             => 'oi_topline-menu-margins',
			'type'           => 'spacing',
			'compiler'         => array('.oi_topline_menu > li > a'),
			'required' => array('oi_top_line_layout','contains',array('two','three','four')),
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
			'id'       => 'oi_topline-menu-border-radius',
			'type'     => 'spinner',
			'compiler' =>true,
			'required' => array('oi_top_line_layout','contains',array('two','three','four')),
			'title'    => __('Border radius', 'redux-framework-demo'),
			'default'  => '0',
			'min'      => '0',
			'step'     => '1',
			'max'      => '100',
		),
				
		
		$fields = array(
			'id'       => 'oi_topline-menu',
			'type'     => 'link_color',
			'required' => array('oi_top_line_layout','contains',array('two','three','four')),
			'compiler'         => array('ul.oi_topline_menu > li > a'),
			'title'    => __('Menu Items color', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#999',
				'hover'    => '#000',
				'active'   => '#000',
			)
		),
		
		$fields = array(
			'id'       => 'oi_topline-menu-li-a-bg',
			'type'     => 'link_color',
			'required' => array('oi_top_line_layout','contains',array('two','three','four')),
			'compiler'         => true,
			'title'    => __('Menu Items background', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '',
				'hover'    => '',
				'active'   => '',
			)
		),
		
		
		$fields = array(
			'id'       => 'oi_topline-menu_sub',
			'type'     => 'link_color',
			'required' => array('oi_top_line_layout','contains',array('two','three','four')),
			'compiler'         => array('ul.oi_topline_menu > li > ul > li > a'),
			'title'    => __('Sub Menu Items color', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#999',
				'hover'    => '#000',
				'active'   => '#000',
			)
		),
		
		$fields = array(
			'id'       => 'oi_topline-menu-li-a-bg_sub',
			'type'     => 'link_color',
			'required' => array('oi_top_line_layout','contains',array('two','three','four')),
			'compiler'         => true,
			'title'    => __('Sub Menu Items background', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#F7F9F9',
				'hover'    => '#F7F9F9',
				'active'   => '#F7F9F9',
			)
		),
		
		
		

		$fields = array(
			'id'             => 'oi_topline-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_top_line_holder'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('TopLine Padding', 'redux-framework-demo'),
			'default'            => array(
				'padding-top'     => '10px', 
				'padding-right'   => '0px', 
				'padding-bottom'  => '10px', 
				'padding-left'    => '0px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'          => 'oi_topline-typography',
			'type'        => 'typography', 
			'title'       => __('Typography', 'redux-framework-demo'),
			'google'      => true,
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			'compiler'      => array('.oi_top_line, ul.oi_topline_menu li'),
			'units'       =>'px',
			'subtitle'    => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#999', 
				'font-weight'  => '400', 
				'font-style' =>'normal', 
				'font-family' => 'Lato', 
				'google'      => true,
				'font-size'   => '11px',
				'letter-spacing'   => '0px',  
				'line-height' => '28px',
				'text-transform'=> 'none'
			),
		),
		
		
		$fields = array( 
			'id'       => 'oi_topline-border',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Border Option', 'redux-framework-demo'),
			'compiler'         => array('.oi_top_line_holder'),
			'default'  => array(
				'border-color'  => '#aec71e', 
				'border-style'  => 'solid', 
				'border-top'    => '5px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
			
		
		
		array(
			'id'       => 'oi-topline-background',
			'type'     => 'background',
			'compiler'         => array('.oi_top_line_holder, .oi_soc_icons.oi_active_top_soc, .oi_topline_menu.oi_active_top_menu'),
			'title'    => __('Background', 'redux-framework-demo'),
			'default'  => array(
				'background-color' => '#FCFCFC',
			)
		),
		
		
		
		
		
		
		$fields = array(
			'id'       => 'oi_social-links',
			'type'     => 'link_color',
			'required' => array('oi_top_line_layout','contains',array('one','two')),
			'compiler'         => array('.oi_top_line .oi_soc_icons a'),
			'title'    => __('Social icons colors', 'redux-framework-demo'),
			'active' =>false,
			'default'  => array(
				'regular'  => '#999',
				'hover'    => '#000',
				'active'   => '#000',
				'visited'  => '#000' 
			)
		),
		array(
			'id'       => 'topline_social_tw',
			'type'     => 'text',
			'required' => array('oi_top_line_layout','contains',array('one','two')),
			'title'    => __('Twitter url', 'orangeidea'),
			'default'  => '#'
		),
		array(
			'id'       => 'topline_social_fb',
			'type'     => 'text',
			'required' => array('oi_top_line_layout','contains',array('one','two')),
			'title'    => __('Facebook url', 'orangeidea'),
			'default'  => '#'
		),
		array(
			'id'       => 'topline_social_go',
			'type'     => 'text',
			'required' => array('oi_top_line_layout','contains',array('one','two')),
			'title'    => __('Google + url', 'orangeidea'),
			'default'  => '#'
		),
		array(
			'id'       => 'topline_social_pi',
			'type'     => 'text',
			'required' => array('oi_top_line_layout','contains',array('one','two')),
			'title'    => __('Pinterest URL', 'orangeidea'),
			'default'  => '#'
		),
		array(
			'id'       => 'topline_social_li',
			'type'     => 'text',
			'required' => array('oi_top_line_layout','contains',array('one','two')),
			'title'    => __('LinkedIN url', 'orangeidea'),
			'default'  => '#'
		),
		array(
			'id'       => 'topline_social_dr',
			'type'     => 'text',
			'required' => array('oi_top_line_layout','contains',array('one','two')),
			'title'    => __('Dribbble url', 'orangeidea'),
			'default'  => '#'
		),
		array(
			'id'       => 'topline_social_yt',
			'type'     => 'text',
			'required' => array('oi_top_line_layout','contains',array('one','two')),
			'title'    => __('YouTube url', 'orangeidea'),
			'default'  => '#'
		),
		
		$fields = array(
			'id'       => 'oi_topline-links',
			'type'     => 'link_color',
			'compiler'         => array('.oi_top_line a', '.oi_top_line .oi_mail a'),
			'title'    => __('Links Color Option', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#999',
				'hover'    => '#000',
				'active'   => '#000',
				'visited'  => '#000' 
			)
		),
		
		
		
		
	)
);

?>