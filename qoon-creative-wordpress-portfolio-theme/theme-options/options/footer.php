<?php

$sections[] = array(
	'title' => __('Footer', "qoon-creative-wordpress-portfolio-theme"),
	'header' => '',
	'desc' => '',
	'icon_class' => 'icon-small',
    'icon' => 'el el-website',

		'fields' => array(
			
			
			array(
				'id'       => 'oi_footer_fixed',
				'type'     => 'switch', 
				'title'    => __('Fixed Footer?', 'qoon-creative-wordpress-portfolio-theme'),
				'on'     => 'Fixed', 
				'off'     => 'Normal',
				'compiler'  => true, 
				'default'  => true,
			),
			
			$fields = array(
					'id'             => 'oi_footer_widgets_area_holder',
					'type'           => 'spacing',
					'compiler'         => array('.footer_real_widgets'),
					'mode'           => 'padding',
					'units'          => 'px',
					'units_extended' => 'false',
					'title'          => __('Widgets Area Padding', 'qoon-creative-wordpress-portfolio-theme'),
					'default'            => array(
						'padding-top'     => '0px', 
						'padding-right'   => '0px', 
						'padding-bottom'  => '0px', 
						'padding-left'    => '0px',
						'units'          => 'px', 
					)
				),
			
			
			
			array(         
				'id'       => 'oi_footer_widgets_area_holder_bg',
				'type'     => 'background',
				'compiler'    => array('.footer_real_widgets'),
				'title'    => __('Widgets Area Background', 'qoon-creative-wordpress-portfolio-theme'),
				'default'  => array(
					'background-color' => '#f1f1f1',
				)
			),
			array( 
				'id'       => 'oi_footer_widgets_area_holder-border',
				'type'     => 'border',
				'all' => false,
				'title'    => __('Widgets Area Border', 'qoon-creative-wordpress-portfolio-theme'),
				'compiler'         => array('.footer_real_widgets'),
				'default'  => array(
					'border-color'  => '#ffffff', 
					'border-style'  => 'none', 
					'border-top'    => '0px', 
					'border-right'  => '0px', 
					'border-bottom' => '0px', 
					'border-left'   => '0px'
				)
			),
			
			
			$fields = array(
				'id'          => 'oi_footer_widgets_area-typography',
				'type'        => 'typography', 
				'title'       => __('Widgets Area Typography', 'qoon-creative-wordpress-portfolio-theme'),
				'google'      => true, 
				'compiler'    => array('.footer_real_widgets'),
				'letter-spacing'=> true,
				'text-transform'=> true,
				'font-backup' => true,
				'units'       =>'px',
				'default'     => array(
					'color'       => '#444444', 
					'font-style'  => '400', 
					'font-family' => 'Inconsolata', 
					'google'      => true,
					'font-size'   => '14px', 
					'line-height' => '22px',
					'letter-spacing'=> '0px'
				),
			),
			
			$fields = array(
				'id'          => 'oi_footer_widgets_area-title-typography',
				'type'        => 'typography', 
				'title'       => __('Widgets Area Title Typography', 'qoon-creative-wordpress-portfolio-theme'),
				'google'      => true, 
				'compiler'    => array('.footer_real_widgets .oi_footer_widget_title'),
				'letter-spacing'=> true,
				'text-transform'=> true,
				'font-backup' => true,
				'units'       =>'px',
				'default'     => array(
					'color'       => '#444444', 
					'font-style'  => '400', 
					'font-family' => 'Inconsolata', 
					'google'      => true,
					'font-size'   => '14px', 
					'line-height' => '22px',
					'letter-spacing'=> '0px'
				),
			),
			
			
			
			$fields = array(
					'id'             => 'oi_footer_holder',
					'type'           => 'spacing',
					'compiler'         => array('.oi_footer_widgets_holder'),
					'mode'           => 'padding',
					'units'          => 'px',
					'units_extended' => 'false',
					'title'          => __('Bottom Line Padding', 'qoon-creative-wordpress-portfolio-theme'),
					'default'            => array(
						'padding-top'     => '40px', 
						'padding-right'   => '0px', 
						'padding-bottom'  => '40px', 
						'padding-left'    => '0px',
						'units'          => 'px', 
					)
				),
			
			array(         
				'id'       => 'oi_footer_holder_bg',
				'type'     => 'background',
				'compiler'    => array('.fixed_footer'),
				'title'    => __('Bottom Line Background', 'qoon-creative-wordpress-portfolio-theme'),
				'default'  => array(
					'background-color' => '#f1f1f1',
				)
			),
			
			$fields = array(
				'id'          => 'oi_Footer-typography',
				'type'        => 'typography', 
				'title'       => __('Bottom Line Typography', 'qoon-creative-wordpress-portfolio-theme'),
				'google'      => true, 
				'compiler'    => array('.oi_footer_widgets_holder'),
				'letter-spacing'=> true,
				'text-transform'=> true,
				'font-backup' => true,
				'units'       =>'px',
				'default'     => array(
					'color'       => '#444444', 
					'font-style'  => '400', 
					'font-family' => 'Inconsolata', 
					'google'      => true,
					'font-size'   => '14px', 
					'line-height' => '22px',
					'letter-spacing'=> '0px'
				),
			),
			
			
			 array( 
				'id'       => 'oi_footer_holder-border',
				'type'     => 'border',
				'all' => false,
				'title'    => __('Bottom Line CONTAINER Border', 'qoon-creative-wordpress-portfolio-theme'),
				'compiler'         => array('.oi_footer_widgets_holder'),
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
				'id'               => 'oi_bottom_copyy',
				'type'             => 'editor',
				'title'            => __('HTML Area bottom line copyright', 'qoon-creative-wordpress-portfolio-theme'), 
				'default'          => 'Copyrights QOON. All Rights Reserved.',
				'args'   => array(
					'teeny'            => true,
					'textarea_rows'    => 10
				)
			),
			
				$fields = array(
			'id'          => 'oi_footer_menu-typography',
			'type'        => 'typography', 
			'title'       => __('Bottom Line Menu Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			'color'=> false,
			'compiler'         => array('ul.oi_footer_menu  li > a'),
			'units'       =>'px',
			'subtitle'    => __('Typography option for menu links', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'font-weight' => '700',
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '14px', 
				'line-height' => '24px',
				'letter-spacing'=> '1px',
				'text-transform'=>'uppercase',
			),
		),
		
		
		$fields = array(
			'id'             => 'oi_footer_logo-menu-menu-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer_menu  li > a'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Bottom Line Menu Items Padding', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'padding-top'     => '10px', 
				'padding-right'   => '10px', 
				'padding-bottom'  => '10px', 
				'padding-left'    => '10px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'             => 'oi_footer_logo-menu-menu-margins',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer_menu li > a'),
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Bottom Line Menu Items Margins', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'margin-top'     => '0px',
				'margin-right'   => '0px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '0px',
				'units'          => 'px', 
			)
		),
				
		
		$fields = array(
			'id'       => 'oi_footer_logo-menu-menu',
			'type'     => 'link_color',
			'compiler'         => array('.oi_footer_menu li > a'),
			'title'    => __('Bottom Line Menu Items color', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => array(
				'regular'  => '#000',
				'hover'    => '#000',
				'active'   => '#000',
			)
		),
		
		$fields = array(
			'id'       => 'oi_footer_logo-menu-menu-li-a-bg',
			'type'     => 'link_color',
			'compiler'         => true,
			'title'    => __('Bottom Line Menu Items background', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => array(
				'regular'  => '#ffffff',
				'hover'    => '#ffde00',
				'active'   => '#ffde00',
			)
		),
		
		$fields = array( 
			'id'       => 'oi_footer_logo-menu-border-standard',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Bottom Line Menu Item Border', 'qoon-creative-wordpress-portfolio-theme'),
			'compiler'         => array('.oi_footer_menu li > a'),
			'default'  => array(
				'border-color'  => '#ffffff', 
				'border-style'  => 'none', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
		
		
		$fields = array( 
			'id'       => 'oi_footer_logo-menu-border-hover',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Bottom Line Menu Border On Hover', 'qoon-creative-wordpress-portfolio-theme'),
			'compiler'         => true,
			'default'  => array(
				'border-color'  => '#ffffff', 
				'border-style'  => 'none', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
		
		$fields = array( 
			'id'       => 'oi_footer_logo-menu-border-active',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Bottom Line Menu Border Active Element', 'qoon-creative-wordpress-portfolio-theme'),
			'compiler'         => true,
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
			'id'               => 'oi_footer_border_radius',
			'type'             => 'text',
			'compiler'         => true,
			'title'            => __('Bottom Line menu Border Rdius', 'qoon-creative-wordpress-portfolio-theme'), 
			'default'          => '100px',
		),
	

		
		
		
				
	),	
);