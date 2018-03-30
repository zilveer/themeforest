<?php
/**************************/
//TopLine Settings
/**************************/
$sections[] = array(
	'title'  => __( 'Menu', 'qoon-creative-wordpress-portfolio-theme' ),
	'icon'   => 'el el-adjust-alt',
	'subsection' => false,
	'fields' => array(
	
		array(
				'id'       => 'logo-menu_onepage',
				'type'     => 'switch', 
				'title'    => __('Menu Type', 'qoon-creative-wordpress-portfolio-theme'),
				'on'     => 'Standard', 
				'off'     => 'One Page', 
				'default'  => true,
			),
		
		$fields = array(
			'id'             => 'oi_logo-menu-area-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_logo_holder'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Header Paddings', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'padding-top'     => '40px', 
				'padding-right'   => '0px', 
				'padding-bottom'  => '40px', 
				'padding-left'    => '0px',
				'units'          => 'px', 
			)
		),
		$fields = array(
			'id'             => 'oi_logo-menu-area-padding-scrolled',
			'type'           => 'spacing',
			'compiler'         => array('.oi_logo_holder.oi_scrolled'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Header Paddings on scroll', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'padding-top'     => '20px', 
				'padding-right'   => '0px', 
				'padding-bottom'  => '20px', 
				'padding-left'    => '0px',
				'units'          => 'px', 
			)
		),
		$fields[] = array(         
				'id'       => 'logo-menu-holder-background',
				'type'     => 'background',
				'compiler'    => array('.oi_logo_holder'),
				'title'    => __('Logo & Menu Background', 'qoon-creative-wordpress-portfolio-theme'),
				'subtitle' => __('Background with image, color, etc.', 'qoon-creative-wordpress-portfolio-theme'),
				'default'  => array(
					'background-color' => '#fff',
				)
			),
		
		$fields[] = array(         
				'id'       => 'logo-menu-holder-background-scrolled',
				'type'     => 'background',
				'compiler'    => array('.oi_logo_holder.oi_scrolled'),
				'title'    => __('Logo & Menu Background On Scroll', 'qoon-creative-wordpress-portfolio-theme'),
				'subtitle' => __('Background with image, color, etc.', 'qoon-creative-wordpress-portfolio-theme'),
				'default'  => array(
					'background-color' => '#fff',
				)
			),
		$fields[] = array(         
				'id'       => 'logo-menu-holder-background-xs-menu',
				'type'     => 'background',
				'compiler'    => array('.oi_layout_standard .oi_xs_menu'),
				'title'    => __('Logo & Menu Background On Mobile', 'qoon-creative-wordpress-portfolio-theme'),
				'subtitle' => __('Background with image, color, etc.', 'qoon-creative-wordpress-portfolio-theme'),
				'default'  => array(
					'background-color' => '#f9f9f9',
				)
			),
			
			
		
		array(
				'id'       => 'logo-menu_burger',
				'type'     => 'switch', 
				'title'    => __('Menu Style', 'qoon-creative-wordpress-portfolio-theme'),
				'on'     => 'Normal', 
				'off'     => 'Burger', 
				'default'  => true,
			),
		
		
		
		$fields = array(
			'id'          => 'oi_menu-typography',
			'type'        => 'typography', 
			'title'       => __('Menu Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			'color'=> false,
			'compiler'         => array('ul.oi_main_menu  li > a'),
			'units'       =>'px',
			'subtitle'    => __('Typography option for menu links', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'font-weight' => '700',
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '24px', 
				'line-height' => '24px',
				'letter-spacing'=> '1px',
				'text-transform'=>'uppercase',
			),
		),
		
		
		$fields = array(
			'id'             => 'oi_logo-menu-menu-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_main_menu  li > a'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Menu Items Padding', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'padding-top'     => '15px', 
				'padding-right'   => '15px', 
				'padding-bottom'  => '15px', 
				'padding-left'    => '15px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'             => 'oi_logo-menu-menu-margins',
			'type'           => 'spacing',
			'compiler'         => array('.oi_main_menu li > a'),
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Menu Items Margins', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'margin-top'     => '0px',
				'margin-right'   => '0px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '0px',
				'units'          => 'px', 
			)
		),
				
		
		$fields = array(
			'id'       => 'oi_logo-menu-menu',
			'type'     => 'link_color',
			'compiler'         => array('.oi_main_menu li > a'),
			'title'    => __('Menu Items color', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => array(
				'regular'  => '#000',
				'hover'    => '#000',
				'active'   => '#000',
			)
		),
		
		$fields = array(
			'id'       => 'oi_logo-menu-menu-li-a-bg',
			'type'     => 'link_color',
			'compiler'         => true,
			'title'    => __('Menu Items background', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => array(
				'regular'  => '#f5f5f5',
				'hover'    => '#ffde00',
				'active'   => '#ffde00',
			)
		),
		
		$fields = array( 
			'id'       => 'oi_logo-menu-border-standard',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Menu Item Border', 'qoon-creative-wordpress-portfolio-theme'),
			'compiler'         => array('.oi_main_menu li > a'),
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
			'id'       => 'oi_logo-menu-border-hover',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Border On Hover', 'qoon-creative-wordpress-portfolio-theme'),
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
			'id'       => 'oi_logo-menu-border-active',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Border Active Element', 'qoon-creative-wordpress-portfolio-theme'),
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
			'id'          => 'oi_sub_menu-typography',
			'type'        => 'typography', 
			'title'       => __('Sub Menu Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			
			'color'=> false,
			'compiler'         => array('ul.oi_main_menu ul> li > a'),
			'units'       =>'px',
			'subtitle'    => __('Typography option for menu links', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'font-weight' => '700',
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '24px', 
				'line-height' => '24px',
				'letter-spacing'=> '1px',
				'text-transform'=>'uppercase',
			),
		),
		
		$fields = array(
			'id'             => 'oi_sub_holder_logo-menu-menu-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_main_menu ul > li > ul'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Sub Menu HOLDER Padding', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'padding-top'     => '0px', 
				'padding-right'   => '0px', 
				'padding-bottom'  => '0px', 
				'padding-left'    => '0px',
				'units'          => 'px', 
			)
		),
		
		$fields = array( 
			'id'       => 'oi_sub_holder_logo-menu-border-standard',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Sub Menu HOLDER Border', 'qoon-creative-wordpress-portfolio-theme'),
			'compiler'         => array('.oi_main_menu ul > li > ul'),
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
			'id'             => 'oi_sub_logo-menu-menu-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_main_menu ul > li > a'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Sub Menu Items Padding', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'padding-top'     => '15px', 
				'padding-right'   => '15px', 
				'padding-bottom'  => '15px', 
				'padding-left'    => '15px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'             => 'oi_sub_logo-menu-menu-margins',
			'type'           => 'spacing',
			'compiler'         => array('.oi_main_menu ul > li > a'),
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Sub Menu Items Margins', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'margin-top'     => '0px',
				'margin-right'   => '0px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '0px',
				'units'          => 'px', 
			)
		),
				
		
		$fields = array(
			'id'       => 'oi_sub_logo-menu-menu',
			'type'     => 'link_color',
			'compiler'         => array('.oi_main_menu ul > li > a'),
			'title'    => __('Sub Menu Items color', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => array(
				'regular'  => '#000',
				'hover'    => '#000',
				'active'   => '#000',
			)
		),
		
		$fields = array(
			'id'       => 'oi_sub_logo-menu-menu-li-a-bg',
			'type'     => 'link_color',
			'compiler'         => true,
			'title'    => __('Sub Menu Items background', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => array(
				'regular'  => '#f5f5f5',
				'hover'    => '#ffde00',
				'active'   => '#ffde00',
			)
		),
		
		$fields = array( 
			'id'       => 'oi_sub_logo-menu-border-standard',
			'type'     => 'border',
			'required' => array('site-layout','equals','standard'),
			'all' => false,
			'title'    => __('Sub Menu Item Border', 'qoon-creative-wordpress-portfolio-theme'),
			'compiler'         => array('.oi_main_menu ul > li > a'),
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
			'id'       => 'oi_sub_logo-menu-border-hover',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Sub Menu Border On Hover', 'qoon-creative-wordpress-portfolio-theme'),
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
			'id'       => 'oi_sub_logo-menu-border-active',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Sub Menu Border Active Element', 'qoon-creative-wordpress-portfolio-theme'),
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
		
		
		
		
		
		
		
		
	)
);

?>