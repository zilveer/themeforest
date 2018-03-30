<?php

$sections[] = array(
	'title' => __('Typography', "orangeidea"),
	'header' => '',
	'desc' => '',
	'icon_class' => 'icon-large',
    'icon' => 'el-icon-website',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
	'fields' => array(
	
	
		
		
		
		
		$fields = array(
			'id'          => 'oi_body-typography',
			'type'        => 'typography', 
			'title'       => __('Body Typography', 'redux-framework-demo'),
			'google'      => true, 
			'compiler'    => array('body'),
			'letter-spacing'=> true,
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for body text.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#888888', 
				'font-style'  => '400', 
				'font-family' => 'Arial', 
				'google'      => true,
				'font-size'   => '12px', 
				'line-height' => '88px'
			),
		),
		
		
		$fields = array(
			'id'          => 'oi_legend-typography',
			'type'        => 'typography', 
			'title'       => __('.oi_legend Typography', 'redux-framework-demo'),
			'google'      => true, 
			'compiler'    => true, 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for oi_legend class.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '400', 
				'font-family' => 'Droid Serif', 
				'google'      => true,
				'font-size'   => '48px', 
				'line-height' => '64px'
			),
		),
		
		$fields = array(
			'id'          => 'oi_sub_legend-typography',
			'type'        => 'typography', 
			'title'       => __('.oi_sub_legend Typography', 'redux-framework-demo'),
			'google'      => true, 
			'compiler'    => true, 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for oi_sub_legend class.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '400', 
				'font-family' => 'Droid Serif', 
				'google'      => true,
				'font-size'   => '20px', 
				'line-height' => '36px'
			),
		),
		
		
		$fields = array(
			'id'          => 'oi_h1-typography',
			'type'        => 'typography', 
			'title'       => __('H1 Typography', 'redux-framework-demo'),
			'google'      => true, 
			'compiler'    => true, 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for H1 Header.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '700', 
				'font-family' => 'Open Sans', 
				'google'      => true,
				'font-size'   => '36px', 
				'line-height' => '40px'
			),
		),
		
		
		
		$fields = array(
			'id'          => 'oi_h2-typography',
			'type'        => 'typography', 
			'title'       => __('H2 Typography', 'redux-framework-demo'),
			'google'      => true, 
			'compiler'    => true, 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for H2 Header.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '300', 
				'font-family' => 'Open Sans', 
				'google'      => true,
				'font-size'   => '32px', 
				'line-height' => '52px'
			),
		),
		
		$fields = array(
			'id'          => 'oi_h3-typography',
			'type'        => 'typography', 
			'title'       => __('H3 Typography', 'redux-framework-demo'),
			'google'      => true, 
			'compiler'    => true, 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for H3 Header.', 'redux-framework-demo'),
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
			'id'          => 'oi_h4-typography',
			'type'        => 'typography', 
			'title'       => __('H4 Typography', 'redux-framework-demo'),
			'google'      => true, 
			'compiler'    => true, 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for H4 Header.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '400', 
				'font-family' => 'Open Sans', 
				'google'      => true,
				'font-size'   => '18px', 
				'line-height' => '20px'
			),
		),
		
		
		$fields = array(
			'id'          => 'oi_h5-typography',
			'type'        => 'typography', 
			'title'       => __('H5 Typography', 'redux-framework-demo'),
			'google'      => true, 
			'compiler'    => true, 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for H5 Header.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '400', 
				'font-family' => 'Open Sans', 
				'google'      => true,
				'font-size'   => '15px', 
				'line-height' => '20px'
			),
		),
		
		
		$fields = array(
			'id'          => 'oi_h6-typography',
			'type'        => 'typography', 
			'title'       => __('H6 Typography', 'redux-framework-demo'),
			'google'      => true, 
			'compiler'    => true, 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for H6 Header.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#848484', 
				'font-style'  => '400', 
				'font-family' => 'Open Sans', 
				'google'      => true,
				'font-size'   => '12px', 
				'line-height' => '20px'
			),
		),
	
		),
	);

