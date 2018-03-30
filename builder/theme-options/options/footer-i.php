<?php
/**************************/
//Footer - I
/**************************/
$sections[] = array(
	'title'  => __( 'I Footer line', 'orangeidea' ),
	'icon'   => 'el-icon-zoom-in',
	'subsection' => true,
	'fields' => array(
	
		
		$fields =array(
			'id'       => 'oi_footer_wide',
			'type'     => 'select',
			'compiler' => true,
			'title'    => __('I Footer Layout', 'redux-framework-demo'), 
			'desc'     => __('', 'redux-framework-demo'),
			'options'  => array(
				'oi_footer_wide' => 'Wide',
				'oi_footer_standard' => 'Standard',
				'oi_footer_wide_no_space' => 'Wide w/o space',
			),
			'default'  => 'oi_footer_standard',
		),
		
		
		$fields =array(
			'id'       => 'oi_footer_widget_count',
			'type'     => 'select',
			'compiler' => true,
			'title'    => __('I Footer  Widgets per row', 'redux-framework-demo'), 
			'desc'     => __('', 'redux-framework-demo'),
			'options'  => array(
				'col-md-12 col-sm-12' => '1',
				'col-md-6 col-sm-6' => '2',
				'col-md-4 col-sm-4' => '3',
				'col-md-3 col-sm-6' => '4',
			),
			'default'  => 'col-md-6 col-sm-6',
		),

		
		
		$fields = array(
			'id'             => 'oi_footer-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer_holder'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('I Footer Padding', 'redux-framework-demo'),
			'default'            => array(
				'padding-top'     => '40px', 
				'padding-right'   => '0px', 
				'padding-bottom'  => '40px', 
				'padding-left'    => '0px',
				'units'          => 'px', 
			)
		),
		$fields = array(
			'id'             => 'oi_footer-margin',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('I Footer Margin', 'redux-framework-demo'),
			'default'            => array(
				'margin-top'     => '0px', 
				'margin-right'   => '0px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '0px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'       => 'oi_footeri-link-color-i',
			'type'     => 'link_color',
			'compiler'      => array('.oi_footer a', '.oi_footer ul li a', '.oi_tweet a:not(.twitter_times)'),
			'title'    => __('Links Color Option', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#fff', 
				'hover'    => '#aec71e',
				'active'   => '#aec71e',
				'visited'  => '#aec71e'
			)
		),
		
		
		$fields = array( 
			'id'       => 'oi_footer-border',
			'type'     => 'border',
			'all' => false,
			'title'    => __('I Footer Border Option', 'redux-framework-demo'),
			'compiler'         => array('.oi_footer_holder'),
			'default'  => array(
				'border-color'  => '#444444', 
				'border-style'  => 'solid', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '1px', 
				'border-left'   => '0px'
			)
		),
			
		
		
		array(
			'id'       => 'oi-footer-background',
			'type'     => 'background',
			'compiler'         => array('.oi_footer_holder'),
			'title'    => __('I Footer Background', 'redux-framework-demo'),
			'default'  => array(
				'background-color' => '#3a3a3a',
			)
		),
		


		$fields = array(
			'id'             => 'oi_footer-sidebar-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer_holder .oi_footer_widget'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('I Footer WIDGET Padding', 'redux-framework-demo'),
			'default'            => array(
				'padding-top'     => '20px', 
				'padding-right'   => '20px', 
				'padding-bottom'  => '20px', 
				'padding-left'    => '20px',
				'units'          => 'px', 
			)
		),
		$fields = array(
			'id'             => 'oi_footer-sidebar-margin',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer_holder .oi_footer_widget'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('I Footer WIDGET Margin', 'redux-framework-demo'),
			'default'            => array(
				'margin-top'     => '0px', 
				'margin-right'   => '0px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '0px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'          => 'oi_footer-sidebar-typography',
			'type'        => 'typography', 
			'title'       => __('I Footer WIDGET Typography', 'redux-framework-demo'),
			'google'      => true,
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			'compiler'      => array('.oi_footer_holder .oi_footer_widget'),
			'units'       =>'px',
			'subtitle'    => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#333', 
				'font-weight'  => '300', 
				'font-style' =>'normal', 
				'font-family' => 'Arial', 
				'google'      => true,
				'font-size'   => '11px',
				'letter-spacing'   => '0px',  
				'line-height' => '16px',
				'text-transform'=> 'none'
			),
		),
		
		
		$fields = array( 
			'id'       => 'oi_footer-sidebar-border',
			'type'     => 'border',
			'all' => false,
			'title'    => __('I Footer WIDGET Border Option', 'redux-framework-demo'),
			'compiler'         => array('.oi_footer_holder .oi_footer_widget'),
			'default'  => array(
				'border-color'  => '#f9f9f9', 
				'border-style'  => 'solid', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
			
		
		
		array(
			'id'       => 'oi-footer-sidebar-background',
			'type'     => 'background',
			'compiler'         => array('.oi_footer_holder .oi_footer_widget'),
			'title'    => __('I Footer WIDGET Background', 'redux-framework-demo'),
			'default'  => array(
				'background-color' => '#303030',
			)
		),
		
		$fields = array(
			'id'   =>'divider_footer_widget-9',
			'type' => 'divide',
		),
		$fields = array(
			'id'   =>'divider_footer_widget-10',
			'type' => 'divide',
		),
		
		

		
		$fields = array( 
			'id'       => 'oi_format_footer-widget-title-border',
			'type'     => 'border',
			'all'=>false,
			'compiler' =>true,
			'title'    => __('I Footer Widget Title Border Option', 'redux-framework-demo'),
			'compiler'         => array('.oi_footer_widget .io_footer_widget_title'),
			'default'  => array(
				'border-color'  => '#3a3a3a', 
				'border-style'  => 'solid', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '1px', 
				'border-left'   => '0px'
			)
		),
		
		
		
		$fields = array(
			'id'          => 'oi_format_footer-widget-title-typography',
			'type'        => 'typography', 
			'title'       => __('I Footer Widget Title Typography', 'redux-framework-demo'),
			'google'      => true,
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			'compiler'         => array('.oi_footer_widget .io_footer_widget_title'),
			'units'       =>'px',
			'subtitle'    => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#ffffff', 
				'font-weight'  => '300', 
				'font-style' => '300', 
				'font-family' => 'Arial', 
				'google'      => true,
				'font-size'   => '14px', 
				'line-height' => '16px',
				'letter-spacing'=>'0px',
				'text-transform'=>'uppercase',
				'text-align'=> 'left'
			),
		),
		
		
		
		$fields = array(
				'id'             => 'oi_format_footer-widget-title-padding',
				'type'           => 'spacing',
				'compiler'         => array('.oi_footer_widget .io_footer_widget_title'),
				'mode'           => 'padding',
				'units'          => 'px',
					'units_extended' => 'false',
				'title'          => __('I Footer Widget Title Paddings', 'redux-framework-demo'),
				'default'            => array(
					'padding-top'     => '0px', 
					'padding-bottom'  => '10px',
					'padding-left'     => '0px', 
					'padding-right'  => '0px', 
					'units'          => 'px', 
				)
			),
		$fields = array(
			'id'             => 'oi_format_footer-widget-title-margin',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer_widget .io_footer_widget_title'),
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('I Footer Widget Title Margins', 'redux-framework-demo'),
			'default'            => array(
				'margin-top'     => '0px', 
				'margin-bottom'  => '15px',
				'margin-left'     => '0px', 
				'margin-right'  => '0px', 
				'units'          => 'px', 
			)
		),
		
	)
);














//###==###

//###==###
?>