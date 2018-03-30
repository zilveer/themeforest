<?php
/**************************/
//Footer - I
/**************************/
$sections[] = array(
	'title'  => __( 'Bottom line', 'orangeidea' ),
	'icon'   => 'el-icon-zoom-in',
	'subsection' => true,
	'fields' => array(
	
		$fields = array(
			'id'          => 'oi_bottom-line-typography',
			'type'        => 'typography', 
			'title'       => __('I Footer WIDGET Typography', 'redux-framework-demo'),
			'google'      => true,
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			'compiler'      => array('.oi_bottom_line_holder'),
			'units'       =>'px',
			'subtitle'    => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#fff', 
				'font-weight'  => '300', 
				'font-style' =>'normal', 
				'font-family' => 'Open Sans', 
				'google'      => true,
				'font-size'   => '11px',
				'letter-spacing'   => '0px',  
				'line-height' => '20px',
				'text-transform'=> 'none'
			),
		),
		
		
		$fields =array(
			'id'       => 'oi_bottom_line_wide',
			'type'     => 'select',
			'compiler' => true,
			'title'    => __('Bottom Line Layout', 'redux-framework-demo'), 
			'desc'     => __('', 'redux-framework-demo'),
			'options'  => array(
				'oi_bottom_line_wide' => 'Wide',
				'oi_bottom_line_standard' => 'Standard',
				'oi_bottom_line_wide_no_space' => 'Wide w/o space',
			),
			'default'  => 'oi_bottom_line_standard',
		),
		
		
		
		
		$fields = array(
			'id'             => 'oi_bottom_line-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_bottom_line_holder'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Bottom Line Padding', 'redux-framework-demo'),
			'default'            => array(
				'padding-top'     => '10px', 
				'padding-right'   => '0px', 
				'padding-bottom'  => '10px', 
				'padding-left'    => '0px',
				'units'          => 'px', 
			)
		),
		$fields = array(
			'id'             => 'oi_bottom_line-margin',
			'type'           => 'spacing',
			'compiler'         => array('.oi_bottom_line'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('Bottom Line Margin', 'redux-framework-demo'),
			'default'            => array(
				'margin-top'     => '0px', 
				'margin-right'   => '0px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '0px',
				'units'          => 'px', 
			)
		),
		
		
		$fields = array(
			'id'       => 'oi_footer-link-color',
			'type'     => 'link_color',
			'compiler'      => array('.oi_bottom_line a', '.oi_bottom_line ul li a'),
			'title'    => __('Links Color Option', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#fff', 
				'hover'    => '#fff',
				'active'   => '#fff',
				'visited'  => '#fff'
			)
		),
		
		
		$fields = array( 
			'id'       => 'oi_bottom_line-border',
			'type'     => 'border',
			'all' => false,
			'title'    => __('Bottom Line Border Option', 'redux-framework-demo'),
			'compiler'         => array('.oi_bottom_line_holder'),
			'default'  => array(
				'border-color'  => '#444444', 
				'border-style'  => 'solid', 
				'border-top'    => '1px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
			
		
		
		array(
			'id'       => 'oi-bottom_line-background',
			'type'     => 'background',
			'compiler'         => array('.oi_bottom_line_holder'),
			'title'    => __('Bottom Line Background', 'redux-framework-demo'),
			'default'  => array(
				'background-color' => '#3a3a3a',
			)
		),
		$fields = array(
			'id'               => 'oi_bottom_line_c',
			'type'             => 'editor',
			'title'            => __('Copyrights', 'redux-framework-demo'), 
			'default'          => 'Copyright © 2015. Design by <a class="collored" href="http://themeforest.net/user/orangeidea/portfolio">OrangeIdea</a>.',
			'args'   => array(
				'teeny'            => true,
				'textarea_rows'    => 10
			)
		),
		
		
	)
);

?>