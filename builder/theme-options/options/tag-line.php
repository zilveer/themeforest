<?php
/**************************/
//TopLine Settings
/**************************/
$sections[] = array(
	'title'  => __( 'Tag Line', 'orangeidea' ),
	'icon'   => 'el-icon-magic',
	'subsection' => false,
	'fields' => array(
	
		
		array(
			'id'       => 'oi_tagline_wide',
			'type'     => 'select',
			'title'    => __('Tag Line Wide', 'redux-framework-demo'), 
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
			'id'             => 'oi_tagline-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_tag_line'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Tag Line Padding', 'redux-framework-demo'),
			'default'            => array(
				'padding-top'     => '20px', 
				'padding-right'   => '0px', 
				'padding-bottom'  => '20px', 
				'padding-left'    => '0px',
				'units'          => 'px', 
			)
		),
		
		
		
		$fields = array(
			'id'       => 'oi-tagline-background',
			'type'     => 'background',
			'compiler'         => array('.oi_tag_line'),
			'title'    => __('Background', 'redux-framework-demo'),
			'default'  => array(
				'background-color' => '#ffffff',
			)
		),
		
		
		$fields = array( 
			'id'       => 'oi-tagline-border',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Border Option', 'redux-framework-demo'),
			'compiler'         => array('.oi_tag_line'),
			'default'  => array(
				'border-color'  => '#f6f6f6', 
				'border-style'  => 'solid', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '1px', 
				'border-left'   => '0px'
			)
		),
		
		
		
		$fields = array(
			'id'          => 'oi_tagline-page-title-typography',
			'type'        => 'typography', 
			'title'       => __('Page Title Typography', 'redux-framework-demo'),
			'google'      => true, 
			'compiler'    => array('h4.oi_tag_line_title','.welcome h2'), 
			'font-backup' => true,
			'text-transform' =>true,
			'units'       =>'px',
			'default'     => array(
				'color'       => '#555555', 
				'font-style'  => '400', 
				'font-family' => 'Open Sans', 
				'google'      => true,
				'font-size'   => '24px', 
				'line-height' => '40px'
			),
		),
		
		$fields = array(
			'id'               => 'oi_tagline-welocme',
			'type'             => 'editor',
			'title'            => __('Home Page Tag Line', 'redux-framework-demo'), 
			'default'          => '<h2><strong class="colored">BUILDER:</strong> Super powerful <span class="colored">&amp;</span> responsive wordpress theme with hundreds options.</h2>',
			'args'   => array(
				'teeny'            => true,
				'textarea_rows'    => 10
			)
		),
		
		
		
		$fields = array(
			'id'          => 'oi_tagline-page-bc',
			'type'        => 'typography', 
			'title'       => __('Breadcrumbs Typography', 'redux-framework-demo'),
			'google'      => true, 
			'compiler'    => array('.breadcrumbs', '.woocommerce .oi_breadcrumbs  .woocommerce-breadcrumb'),
			'letter-spacing'=> true,
			'font-backup' => true,
			'units'       =>'px',
			'default'     => array(
				'color'       => '#888888', 
				'font-style'  => '400', 
				'font-family' => 'Open Sans', 
				'google'      => true,
				'font-size'   => '11px', 
				'line-height' => '18px'
			),
		),
		
		$fields = array(
			'id'       => 'oi_tagline-page-bc-links',
			'type'     => 'link_color',
			'compiler'         => array('.breadcrumbs a', '.woocommerce .oi_breadcrumbs nav.woocommerce-breadcrumb a'),
			'title'    => __('Breadcrumbs links color', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#000',
				'hover'    => '#aec71e',
				'active'   => '#aec71e',
			)
		),

	)
);

?>