<?php

$sections[] = array(
	'title' => __('Portfolio', "qoon-creative-wordpress-portfolio-theme"),
	'header' => '',
	'desc' => '',
	'icon_class' => 'icon-small',
    'icon' => 'el el-website',
	'fields' => array(
		
		$fields = array(
				'id'       => 'portfolio-hover',
				'type'     => 'image_select',
				'title'    => __('Hover Effects', 'qoon-creative-wordpress-portfolio-theme'), 
				'options'  => array(
					'left-menu'      => array(
						'alt'   => 'Left Menu', 
						'img'   => $redux_path_images.'overlay.jpg'
					),
					'standard'      => array(
						'alt'   => 'Standard', 
						'img'   => $redux_path_images.'standard.jpg'
					),
					'3'      => array(
						'alt'   => '2 Column Right', 
						'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
					),
					'4'      => array(
						'alt'   => '3 Column Middle', 
						'img'   => ReduxFramework::$_url.'assets/img/3cm.png'
					),
					'5'      => array(
						'alt'   => '3 Column Left', 
						'img'   => ReduxFramework::$_url.'assets/img/3cl.png'
					),
					'6'      => array(
						'alt'  => '3 Column Right', 
						'img'  => ReduxFramework::$_url.'assets/img/3cr.png'
					)
				),
				'default' => 'left-menu'
			),
		
		array(
			'id'       => 'oi_filters',
			'type'     => 'switch', 
			'title'    => __('Portfolio Filters', 'qoon-creative-wordpress-portfolio-theme'),
			'on'     => 'Standard', 
			'off'     => 'Hamburger', 
			'default'  => true,
		),
		
		$fields = array(
			'id'          => 'oi_filters-typography',
			'type'        => 'typography', 
			'title'       => __('Filters Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true, 
			'compiler'    => array('.oi_port_filter .oi_list_cats  li > a'),
			'letter-spacing'=> true,
			'text-transform'=> true,
			'font-backup' => true,
			'units'       =>'px',
			'default'     => array(
				'color'       => '#000', 
				'font-style'  => '400', 
				'font-family' => 'Lato', 
				'google'      => true,
				'font-size'   => '12px', 
				'line-height' => '22px',
				'letter-spacing'=> '1px'
			),
		),
		
		
		
		$fields = array(
			'id'             => 'oi_filter-menu-menu-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_port_filter .oi_list_cats  li > a'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Filters Items Padding', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'padding-top'     => '5px', 
				'padding-right'   => '10px', 
				'padding-bottom'  => '5px', 
				'padding-left'    => '10px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'             => 'oi_filter-menu-menu-margins',
			'type'           => 'spacing',
			'compiler'         => array('.oi_port_filter .oi_list_cats li > a'),
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Filters Items Margins', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'margin-top'     => '0px',
				'margin-right'   => '10px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '10px',
				'units'          => 'px', 
			)
		),
				
		
		$fields = array(
			'id'       => 'oi_filter-menu-menu',
			'type'     => 'link_color',
			'compiler'         => array('.oi_port_filter .oi_list_cats li > a'),
			'title'    => __('Filters Items color', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => array(
				'regular'  => '#000',
				'hover'    => '#000',
				'active'   => '#000',
			)
		),
		
		$fields = array(
			'id'       => 'oi_filter-menu-menu-li-a-bg',
			'type'     => 'link_color',
			'compiler'         => true,
			'title'    => __('Filters Items background', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => array(
				'regular'  => '#fff',
				'hover'    => '#F1F1F1',
				'active'   => '#ffde00',
			)
		),
		
		$fields = array( 
			'id'       => 'oi_filter-menu-border-standard',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Filters Item Border', 'qoon-creative-wordpress-portfolio-theme'),
			'compiler'         => array('.oi_port_filter .oi_list_cats li > a'),
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
			'id'       => 'oi_filter-menu-border-hover',
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
			'id'       => 'oi_filter-menu-border-active',
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
		
		
		
		array(
			'id'       => 'filters-position',
			'type'     => 'select',
			'compiler' => true,
			'title'    => __('Portfolio Filters Position', 'qoon-creative-wordpress-portfolio-theme'), 
			'options'  => array(
				'left' => 'left',
				'center' => 'center',
				'right' => 'right'
			),
			'default'  => 'center',
		),
		
		array(
			'id'               => 'oi_filters-marginss',
			'type'             => 'text',
			'compiler'         => true,
			'title'            => __('Space between Filters and borderline', 'qoon-creative-wordpress-portfolio-theme'), 
			'default'          => '30px',
		),
		array(
			'id'               => 'oi_filters-width',
			'type'             => 'text',
			'compiler'         => true,
			'title'            => __('Filters borderline width', 'qoon-creative-wordpress-portfolio-theme'), 
			'default'          => '60%',
		),
		array(
			'id'       => 'oi_filters-color',
			'type'     => 'color',
			'compiler'         => true,
			'title'    => __('Filters borderline color', 'qoon-creative-wordpress-portfolio-theme'), 
			'subtitle' => __('default: #ccc', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => '#ccc',
			'validate' => 'color',
		)
		
		
		
		
		
				
	),	
);