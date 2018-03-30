<?php

$sections[] = array(
	'title' => __('Single Post', "qoon-creative-wordpress-portfolio-theme"),
	'header' => '',
	'desc' => '',
	'icon_class' => 'icon-small',
	'subsection' => true,

		
		
		
		'fields' => array(
		
		
		array(
			'id'       => 'single_heading-image',
			'type'     => 'select',
			'compiler' => true,
			'title'    => __('Ho to show Featured image?', 'qoon-creative-wordpress-portfolio-theme'), 
			'options'  => array(
				'style_i' => 'Always show slider from blog page',
				'style_ii' => "Show featured image instead slider",
			),
			'default'  => 'style_i',
		),
		
			
		array(
			'id'       => 'single_title-position',
			'type'     => 'select',
			'compiler' => true,
			'title'    => __('Headig Position', 'qoon-creative-wordpress-portfolio-theme'), 
			'options'  => array(
				'left' => 'left',
				'center' => 'center',
				'right' => 'right'
			),
			'default'  => 'center',
		),
		
		$fields = array(
			'id'          => 'single_title-date-typography',
			'type'        => 'typography', 
			'title'       => __('Date Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			'color'=> true,
			'compiler'         => array('.oi_blog_meta_date span'),
			'units'       =>'px',
			'subtitle'    => __('Typography option for menu links', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'font-weight' => '400',
				'font-family' => 'Lato', 
				'google'      => true,
				'font-size'   => '12px', 
				'line-height' => '12px',
				'letter-spacing'=> '0px',
				'color'=> '#000',
				'text-transform'=>'uppercase',
			),
		),
		
		
		$fields = array(
			'id'             => 'single_title-date-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_blog_meta_date span'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Date Padding', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'padding-top'     => '7px', 
				'padding-right'   => '7px', 
				'padding-bottom'  => '7px', 
				'padding-left'    => '7px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'             => 'single_title-date-margins',
			'type'           => 'spacing',
			'compiler'         => array('.oi_blog_meta_date span'),
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Date Margins', 'qoon-creative-wordpress-portfolio-theme'),
			'default'            => array(
				'margin-top'     => '0px',
				'margin-right'   => '0px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '0px',
				'units'          => 'px', 
			)
		),
				
		$fields = array(
			'id'       => 'single_title-date-bg',
			'type'     => 'link_color',
			'compiler'    => true,
			'hover' => false,
			'active' =>false,
			'title'    => __('Date background', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => array(
				'regular'  => '#ffde00',
			)
		),
		
		
		
		array(
			'id'               => 'single_title-margins',
			'type'             => 'text',
			'compiler'         => true,
			'title'            => __('Space between Title and borderline', 'qoon-creative-wordpress-portfolio-theme'), 
			'default'          => '30px',
		),
		array(
			'id'               => 'oi_single_title-width',
			'type'             => 'text',
			'compiler'         => true,
			'title'            => __('Title borderline width', 'qoon-creative-wordpress-portfolio-theme'), 
			'default'          => '40px',
		),
		array(
			'id'       => 'single_title-color',
			'type'     => 'color',
			'compiler'         => true,
			'title'    => __('Title borderline color', 'qoon-creative-wordpress-portfolio-theme'), 
			'subtitle' => __('default: #ccc', 'qoon-creative-wordpress-portfolio-theme'),
			'default'  => '#000',
			'validate' => 'color',
		)

		
		
		
				
	),	
);