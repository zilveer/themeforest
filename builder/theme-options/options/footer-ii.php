<?php
/**************************/
//Footer - II 
/**************************/
$sections[] = array(
	'title'  => __( 'II Footer line', 'orangeidea' ),
	'icon'   => 'el-icon-zoom-in',
	'subsection' => true,
	'fields' => array(
	
		
		$fields =array(
			'id'       => 'oi_footer-ii_wide',
			'type'     => 'select',
			'compiler' => true,
			'title'    => __('II Footer Layout', 'redux-framework-demo'), 
			'desc'     => __('', 'redux-framework-demo'),
			'options'  => array(
				'oi_footer-ii_wide' => 'Wide',
				'container' => 'Boxed',
				'oi_footer-ii_container' => 'Wide In Container',
			),
			'default'  => 'oi_footer-ii_container',
		),
		
		
		$fields =array(
			'id'       => 'oi_footer-ii_widget_count',
			'type'     => 'select',
			'compiler' => true,
			'title'    => __('II Footer  Widgets per row', 'redux-framework-demo'), 
			'desc'     => __('', 'redux-framework-demo'),
			'options'  => array(
				'col-md-12' => '1',
				'col-md-6' => '2',
				'col-md-4' => '3',
				'col-md-3' => '4',
			),
			'default'  => 'col-md-3',
		),

		
		
		$fields = array(
			'id'             => 'oi_footer-ii-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer-ii_holder'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('II Footer Padding', 'redux-framework-demo'),
			'default'            => array(
				'padding-top'     => '0px', 
				'padding-right'   => '0px', 
				'padding-bottom'  => '0px', 
				'padding-left'    => '0px',
				'units'          => 'px', 
			)
		),
		$fields = array(
			'id'             => 'oi_footer-ii-margin',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer-ii'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('II Footer Margin', 'redux-framework-demo'),
			'default'            => array(
				'margin-top'     => '0px', 
				'margin-right'   => '0px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '0px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'          => 'oi_footer-ii-typography',
			'type'        => 'typography', 
			'title'       => __('II Footer Typography', 'redux-framework-demo'),
			'google'      => true,
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			'compiler'      => array('.oi_footer-ii, ul.oi_footer-ii_menu li'),
			'units'       =>'px',
			'subtitle'    => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#333', 
				'font-weight'  => '300', 
				'font-style' =>'normal', 
				'font-family' => 'Open Sans', 
				'google'      => true,
				'font-size'   => '11px',
				'letter-spacing'   => '0px',  
				'line-height' => '12px',
				'text-transform'=> 'uppercase'
			),
		),
		
		$fields = array(
			'id'       => 'oi_footer-ii-link-color',
			'type'     => 'link_color',
			'compiler'      => array('.oi_footer-ii a','.oi_footer-ii ul li a'),
			'title'    => __('Links Color Option', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '#dbdbdb', 
				'hover'    => '#fff',
				'active'   => '#fff',
				'visited'  => '#fff'
			)
		),
		
		
		$fields = array( 
			'id'       => 'oi_footer-ii-border',
			'type'     => 'border',
			'all' => false,
			'title'    => __('II Footer Border Option', 'redux-framework-demo'),
			'compiler'         => array('.oi_footer-ii_holder'),
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
			'id'       => 'oi-footer-ii-background',
			'type'     => 'background',
			'compiler'         => array('.oi_footer-ii_holder'),
			'title'    => __('II Footer Background', 'redux-framework-demo'),
			'default'  => array(
				'background-color' => '#303030',
			)
		),
		
		$field = array(
			'id'       => 'oi-footer-ii-fullwidth-checkbox',
			'type'     => 'checkbox',
			'compiler' => true,
			'title'    => __('Stick II Footer to the edges?', 'redux-framework-demo'), 
			'default'  => '0'
		),


		$fields = array(
			'id'             => 'oi_footer-ii-sidebar-padding',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer-ii_holder .oi_footer-ii_widget'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('II Footer WIDGET Padding', 'redux-framework-demo'),
			'default'            => array(
				'padding-top'     => '40px', 
				'padding-right'   => '0px', 
				'padding-bottom'  => '30px', 
				'padding-left'    => '0px',
				'units'          => 'px', 
			)
		),
		$fields = array(
			'id'             => 'oi_footer-ii-sidebar-margin',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer-ii_holder .oi_footer-ii_widget'),
			'mode'           => 'padding',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('II Footer WIDGET Margin', 'redux-framework-demo'),
			'default'            => array(
				'margin-top'     => '0px', 
				'margin-right'   => '0px', 
				'margin-bottom'  => '0px', 
				'margin-left'    => '0px',
				'units'          => 'px', 
			)
		),
		
		$fields = array(
			'id'          => 'oi_footer-ii-sidebar-typography',
			'type'        => 'typography', 
			'title'       => __('II Footer WIDGET Typography', 'redux-framework-demo'),
			'google'      => true,
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			'compiler'      => array('.oi_footer-ii_holder .oi_footer-ii_widget'),
			'units'       =>'px',
			'subtitle'    => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#333', 
				'font-weight'  => '300', 
				'font-style' =>'normal', 
				'font-family' => 'Arial', 
				'google'      => true,
				'font-size'   => '12px',
				'letter-spacing'   => '0px',  
				'line-height' => '15px',
				'text-align'=> 'Left',
				'text-transform'=> 'none'
			),
		),
		
		
		$fields = array( 
			'id'       => 'oi_footer-ii-sidebar-border',
			'type'     => 'border',
			'all' => false,
			'title'    => __('II Footer WIDGET Border Option', 'redux-framework-demo'),
			'compiler'         => array('.oi_footer-ii_holder .oi_footer-ii_widget'),
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
			'id'       => 'oi-footer-ii-sidebar-background',
			'type'     => 'background',
			'compiler'         => array('.oi_footer-ii_holder .oi_footer-ii_widget'),
			'title'    => __('II Footer WIDGET Background', 'redux-framework-demo'),
			'default'  => array(
				'background-color' => 'transparent',
			)
		),
		
		$fields = array(
			'id'   =>'divider_footer_ii_widget-9',
			'type' => 'divide',
		),
		$fields = array(
			'id'   =>'divider_footer_ii_widget-10',
			'type' => 'divide',
		),
		
		$fields[] = array(
			'id'       => 'oi_format_footer-ii-widget-title-holder-bg',
			'type'     => 'background',
			'compiler'         => array('.oi_footer-ii_widget .io_footer-ii_widget_title'),
			'title'    => __('II Footer Widget Title HOLDER Background', 'redux-framework-demo'),
			'default'  => array(
				'background-color' => '',
			)
		),
		
		$fields = array(
				'title'          => __('II Footer Widget Title HOLDER Paddings', 'redux-framework-demo'),
				'id'             => 'oi_format_footer-ii-widget-title-holder-padding',
				'type'           => 'spacing',
				'compiler'         => array('.oi_footer-ii_widget .io_footer-ii_widget_title'),
				'mode'           => 'padding',
				'units'          => 'px',
					'units_extended' => 'false',
				'default'            => array(
					'padding-top'     => '0px', 
					'padding-bottom'  => '10px',
					'padding-left'     => '0px', 
					'padding-right'  => '0px', 
					'units'          => 'px', 
				)
			),
		$fields = array(
			'id'             => 'oi_format_footer-ii-widget-title-holder-margin',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer-ii_widget .io_footer-ii_widget_title'),
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('II Footer Widget Title HOLDER Margins', 'redux-framework-demo'),
			'default'            => array(
				'margin-top'     => '0px', 
				'margin-bottom'  => '10px',
				'margin-left'     => '0px', 
				'margin-right'  => '0px', 
				'units'          => 'px', 
			)
		),
		
		$fields = array( 
			'id'       => 'oi_format_footer-ii-widget-title-holder-borderr',
			'type'     => 'border',
			'all'=>false,
			'compiler' =>true,
			'compiler'         => array('.oi_footer-ii_widget .io_footer-ii_widget_title'),
			'title'    => __('II Footer Widget Title HOLDER Border', 'redux-framework-demo'),
			'default'  => array(
				'border-color'  => '#444444', 
				'border-style'  => 'none', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '1px', 
				'border-left'   => '0px'
			)
		),
		
		
		
		$fields = array(
			'id'   =>'divider_footer_ii_widget-11',
			'type' => 'divide',
		),
		
		
		$fields = array(
			'id'       => 'oi_format_footer-ii-widget-title-bg',
			'type'     => 'link_color',
			'compiler' =>true,
			'hover' =>false,
			'active' =>false,
			'title'    => __('II Footer Widget Title Background Options', 'redux-framework-demo'),
			'default'  => array(
				'regular'  => '',
			)
		),
		
		$fields = array( 
			'id'       => 'oi_format_footer-ii-widget-title-border',
			'type'     => 'border',
			'all'=>false,
			'compiler' =>true,
			'title'    => __('II Footer Widget Title Border Option', 'redux-framework-demo'),
			'compiler'         => array('.oi_footer-ii_widget .io_footer-ii_widget_title span'),
			'default'  => array(
				'border-color'  => '#fff', 
				'border-style'  => 'solid', 
				'border-top'    => '0px', 
				'border-right'  => '0px', 
				'border-bottom' => '0px', 
				'border-left'   => '0px'
			)
		),
		
		
		
		$fields = array(
			'id'          => 'oi_format_footer-ii-widget-title-typography',
			'type'        => 'typography', 
			'title'       => __('II Footer Widget Title Typography', 'redux-framework-demo'),
			'google'      => true,
			'letter-spacing'=> true, 
			'font-backup' => true,
			'letter-spacing'=> true,
			'text-transform'=> true,
			'compiler'         => array('.oi_footer-ii_widget .io_footer-ii_widget_title'),
			'units'       =>'px',
			'subtitle'    => __('Typography option with each property can be called individually.', 'redux-framework-demo'),
			'default'     => array(
				'color'       => '#fff', 
				'font-weight'  => '300', 
				'font-style' => '300', 
				'font-family' => 'Open Sans', 
				'google'      => true,
				'font-size'   => '12px', 
				'line-height' => '20px',
				'letter-spacing'=>'0px',
				'text-transform'=>'uppercase',
				'text-align'=> 'center'
			),
		),
		
		
		
		$fields = array(
				'id'             => 'oi_format_footer-ii-widget-title-padding',
				'type'           => 'spacing',
				'compiler'         => array('.oi_footer-ii_widget .io_footer-ii_widget_title span'),
				'mode'           => 'padding',
				'units'          => 'px',
					'units_extended' => 'false',
				'title'          => __('II Footer Widget Title Paddings', 'redux-framework-demo'),
				'default'            => array(
					'padding-top'     => '0px', 
					'padding-bottom'  => '10px',
					'padding-left'     => '0px', 
					'padding-right'  => '0px', 
					'units'          => 'px', 
				)
			),
		$fields = array(
			'id'             => 'oi_format_footer-ii-widget-title-margin',
			'type'           => 'spacing',
			'compiler'         => array('.oi_footer-ii_widget .io_footer-ii_widget_title span'),
			'mode'           => 'margin',
			'units'          => 'px',
			'units_extended' => 'false',
			'title'          => __('II Footer Widget Title Margins', 'redux-framework-demo'),
			'default'            => array(
				'margin-top'     => '0px', 
				'margin-bottom'  => '0px',
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