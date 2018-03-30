<?php

$sections[] = array(
	'title' => __('Typography', "qoon-creative-wordpress-portfolio-theme"),
	'header' => '',
	'desc' => '',
	'icon_class' => 'icon-large',
    'icon' => 'el el-text-width',
    // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
	'fields' => array(
	
	
		
		
		
		
		$fields = array(
			'id'          => 'oi_body-typography',
			'type'        => 'typography', 
			'title'       => __('Body Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true, 
			'compiler'    => array('body'),
			'letter-spacing'=> true,
			'text-transform'=> true,
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for body text.', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'color'       => '#444444', 
				'font-style'  => '400', 
				'font-family' => 'Lato', 
				'google'      => true,
				'font-size'   => '13px', 
				'line-height' => '22px',
				'letter-spacing'=> '0px'
			),
		),
		
		
		$fields = array(
			'id'          => 'oi_legend-typography',
			'type'        => 'typography', 
			'title'       => __('.oi_legend Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true,
'text-transform'=> true, 
			'compiler'    => array('.oi_legend'),
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for oi_legend class.', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'color'       => '#666666', 
				'font-style'  => '300', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '20px', 
				'line-height' => '32px'
			),
		),
		
		
		
		
		$fields = array(
			'id'          => 'oi_page_title-typography',
			'type'        => 'typography', 
			'title'       => __('Page Title', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true,
'text-transform'=> true, 
			'compiler'    => array('.oi_page_title'),
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for Page Title', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'color'       => '#666666', 
				'font-style'  => '300', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '20px', 
				'line-height' => '32px'
			),
		),
		
		
		$fields = array(
			'id'          => 'oi_tagline-one-typography',
			'type'        => 'typography', 
			'title'       => __('First Tag Line', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true,
'text-transform'=> true, 
			'compiler'    => array('.oi_tag_line_first'),
			'font-backup' => true,
			'units'       =>'px',
			'default'     => array(
				'color'       => '#000', 
				'font-style'  => '300', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '20px', 
				'line-height' => '32px'
			),
		),
		
		$fields = array(
			'id'          => 'oi_tagline-second-typography',
			'type'        => 'typography', 
			'title'       => __('Second Tag Line', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true,
'text-transform'=> true, 
			'compiler'    => array('.oi_tag_line_second'),
			'font-backup' => true,
			'units'       =>'px',
			'default'     => array(
				'color'       => '#000', 
				'font-style'  => '300', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '20px', 
				'line-height' => '32px'
			),
		),
		
		
		
		
		$fields = array(
			'id'          => 'oi_sub_legend-typography',
			'type'        => 'typography', 
			'title'       => __('.oi_sub_legend Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true, 
			'compiler'    => array('.oi_sub_legend'),
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for oi_sub_legend class.', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '300', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '20px', 
				'line-height' => '26px'
			),
		),
		
		$fields = array(
			'id'          => 'oi_cat_heading-typography',
			'type'        => 'typography', 
			'title'       => __('.cat_heading Typography (For Category titles and Featured Posts heading)', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true,
			'text-transform'=> true, 
			'compiler'    => array('.cat_heading'), 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for oi_legend class.', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '500', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '18px', 
				'line-height' => '90px',
				'letter-spacing'=> '3px'
			),
		),
		
		
		
		$fields = array(
			'id'          => 'oi_h1-typography',
			'type'        => 'typography', 
			'title'       => __('H1 Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true,
			'text-transform'=> true, 
			'compiler'    => array('h1'), 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for H1 Header.', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '400', 
				'font-family' => 'Roboto', 
				'google'      => true,
				'font-size'   => '40px', 
				'line-height' => '56px'
			),
		),
		
		
		
		$fields = array(
			'id'          => 'oi_h2-typography',
			'type'        => 'typography', 
			'title'       => __('H2 Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true,
'text-transform'=> true, 
			'compiler'    => array('h2'), 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for H2 Header.', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '300', 
				'font-family' => 'Roboto', 
				'google'      => true,
				'font-size'   => '34px', 
				'line-height' => '52px'
			),
		),
		
		$fields = array(
			'id'          => 'oi_h3-typography',
			'type'        => 'typography', 
			'title'       => __('H3 Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true, 
			'letter-spacing'=> true,
			'text-transform'=> true,
			'compiler'    => array('h3'), 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for H3 Header.', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '800', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '24px', 
				'line-height' => '32px'
			),
		),
		
		$fields = array(
			'id'          => 'oi_h4-typography',
			'type'        => 'typography', 
			'title'       => __('H4 Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true,
			'text-transform'=> true, 
			'compiler'    => array('h4'), 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for H4 Header.', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '400', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '22px', 
				'line-height' => '36px',
				'letter-spacing'=>'2px'
			),
		),
		
		
		$fields = array(
			'id'          => 'oi_h5-typography',
			'type'        => 'typography', 
			'title'       => __('H5 Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true, 
			'letter-spacing'=> true,
'text-transform'=> true,
			'compiler'    => array('h5'), 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for H5 Header.', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'color'       => '#222', 
				'font-style'  => '400', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '14px', 
				'line-height' => '22px'
			),
		),
		
		
		$fields = array(
			'id'          => 'oi_h6-typography',
			'type'        => 'typography', 
			'title'       => __('H6 Typography', 'qoon-creative-wordpress-portfolio-theme'),
			'google'      => true,
			'letter-spacing'=> true,
			'text-transform'=> true, 
			'compiler'    => array('h6'), 
			'font-backup' => true,
			'units'       =>'px',
			'subtitle'    => __('Typography option for H6 Header.', 'qoon-creative-wordpress-portfolio-theme'),
			'default'     => array(
				'color'       => '#848484', 
				'font-style'  => '400', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '14px', 
				'line-height' => '22px'
			),
		),
	
		),
	);

