<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_Button_Module')) {
	class Dfd_Button_Module {
		function __construct() {
			add_action( 'init', array( &$this, 'dfd_button_init' ) );
			add_shortcode( 'dfd_button', array( &$this, 'dfd_button_shortcode' ) );
		}
		
		function dfd_button_init() {
			if ( function_exists( 'vc_map' ) ) {

				vc_map( array(
					'name' => esc_html__('Button module', 'dfd'),
					'base' => 'dfd_button',
					'class' => 'ult_buttons',
					'controls' => 'full',
					'show_settings_on_create' => true,
					'icon' => 'ult_buttons',
					'description' => esc_html__('Shows customizable button', 'dfd'),
					'category' => esc_html__('Ronneby 2.0', 'dfd'),
					'params'      => array(
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Hover style', 'dfd' ),
							'param_name'       => 'hover_style_heading',
							'class'            => '',
							'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
						),
						array(
							'type'       => 'radio_image_select',
							'heading'    => esc_html__( 'Hover style', 'dfd' ),
							'param_name' => 'style',
							'simple_mode'		=> false,
							'options'      => array(
								'style_1' => array(
									'tooltip' => esc_attr__('Fade','dfd'),
									'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/button/style_1.png'
								),
								'style_2' => array(
									'tooltip' => esc_attr__('Slide','dfd'),
									'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/button/style_2.png'
								),
								'style_3' => array(
									'tooltip' => esc_attr__('Scale out','dfd'),
									'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/button/style_3.png'
								),
								'style_4' => array(
									'tooltip' => esc_attr__('Scale in','dfd'),
									'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/button/style_4.png'
								),
								'style_5' => array(
									'tooltip' => esc_attr__('Zoom in','dfd'),
									'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/button/style_5.png'
								),
								'style_6' => array(
									'tooltip' => esc_attr__('3D rotate','dfd'),
									'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/button/style_6.png'
								),
							),
						),
						/*
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Hover style', 'dfd' ),
							'param_name' => 'style',
							'admin_label' => true,
							'value'      => array(
								esc_attr__('Fade','dfd') => 'style_1',
								esc_attr__('Slide','dfd') => 'style_2',
								esc_attr__('Scale out','dfd') => 'style_3',
								esc_attr__('Scale in','dfd') => 'style_4',
								esc_attr__('Zoom in','dfd') => 'style_5',
								esc_attr__('3D rotate','dfd') => 'style_6',
							),
						),
						*/
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Button size', 'dfd' ),
							'param_name' => 'button_size',
							//'admin_label' => true,
							'value'      => array(
								esc_attr__('Normal','dfd') => '',
								esc_attr__('Full width','dfd') => 'dfd-button-full-width',
							),
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Animation direction', 'dfd' ),
							'param_name' => 'direction_slide',
							//'admin_label' => true,
							'value'      => array(
								esc_attr__('Top to bottom','dfd') => 'dfd-top-to-bottom',
								esc_attr__('Bottom to top','dfd') => 'dfd-bottom-to-top',
								esc_attr__('Left to right','dfd') => 'dfd-left-to-right',
								esc_attr__('Right to left','dfd') => 'dfd-right-to-left',
							),
							'dependency' => array(
								'element' => 'style',
								'value'   => array('style_2'),
							),
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Animation direction', 'dfd' ),
							'param_name' => 'direction',
							//'admin_label' => true,
							'value'      => array(
								esc_attr__('Horizontal','dfd') => 'dfd-horizontal',
								esc_attr__('Vertical','dfd') => 'dfd-vertical',
								esc_attr__('Diagonal','dfd') => 'dfd-diagonal',
							),
							'dependency' => array(
								'element' => 'style',
								'value'   => array('style_3','style_4'),
							),
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Main button settings', 'dfd' ),
							'param_name'       => 'main_heading',
							'class'            => '',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__('Button text','dfd'),
							'param_name' => 'button_text',
							'admin_label' => true,
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'value' => '',
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__('Tooltip text','dfd'),
							'param_name' => 'tooltip_text',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'value' => '',
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Button alignment', 'dfd' ),
							'param_name' => 'alignment',
							//'admin_label' => true,
							'value'      => array(
								esc_attr__('Center','dfd') => 'text-center',
								esc_attr__('Left','dfd') => 'text-left',
								esc_attr__('Right','dfd') => 'text-right',
							),
							'edit_field_class' => 'vc_column vc_col-sm-6',
						),
						array(
							'type'       => 'dropdown',
							'heading'    => esc_html__( 'Tooltip alignment', 'dfd' ),
							'param_name' => 'tooltip_alignment',
							//'admin_label' => true,
							'value'      => array(
								esc_attr__('Left','dfd') => 'dfd-button-tooltip-left',
								esc_attr__('Right','dfd') => 'dfd-button-tooltip-right',
								esc_attr__('Top','dfd') => 'dfd-button-tooltip-top',
								esc_attr__('Bottom','dfd') => 'dfd-button-tooltip-bottom',
								esc_attr__('Top Left','dfd') => 'dfd-button-tooltip-top-left',
								esc_attr__('Top Right','dfd') => 'dfd-button-tooltip-top-right',
								esc_attr__('Bottom Left','dfd') => 'dfd-button-tooltip-bottom-left',
								esc_attr__('Bottom Right','dfd') => 'dfd-button-tooltip-bottom-right',
							),
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'dependency' => array(
								'element' => 'tooltip_text',
								'not_empty'   => true,
							),
						),
						array(
							'type' => 'vc_link',
							'class' => '',
							'heading' => esc_html__('Button link url', 'dfd'),
							'value' => '',
							'param_name' => 'buttom_link_src',
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Extra settings', 'dfd' ),
							'param_name'       => 'extra_heading',
							'class'            => '',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'heading' => esc_html__('Extra Class','dfd'),
							'param_name' => 'el_class',
							'value' => '',
							//'group'=> esc_html__('General','dfd'),
						),
						array(
							'type'        => 'dropdown',
							'class'       => '',
							'heading'     => esc_html__( 'Animation', 'dfd' ),
							'param_name'  => 'module_animation',
							'value'       => dfd_module_animation_styles(),
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Icon settings', 'dfd' ),
							'param_name'       => 'background_heading',
							'class'            => '',
							'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							'group'      => esc_html__( 'Icon', 'dfd' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Icon library', 'js_composer' ),
							'value' => array(
								esc_attr__( 'None', 'js_composer' ) => '',
								//esc_attr__( 'Theme default', 'js_composer' ) => 'dfd_icons',
								esc_attr__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
								esc_attr__( 'Open Iconic', 'js_composer' ) => 'openiconic',
								esc_attr__( 'Typicons', 'js_composer' ) => 'typicons',
								esc_attr__( 'Entypo', 'js_composer' ) => 'entypo',
								esc_attr__( 'Linecons', 'js_composer' ) => 'linecons',
							),
							'param_name' => 'icon_font',
							'description' => __( 'Select icon library.', 'js_composer' ),
							'group'      => esc_html__( 'Icon', 'dfd' ),
						),
						/*
						array(
							'type'       => 'iconpicker',
							'class'      => '',
							'heading'    => esc_html__( 'Select Icon ', 'dfd' ),
							'param_name' => 'icon_dfd_icons',
							'value' => '', // default value to backend editor admin_label
							'settings' => array(
								'emptyIcon' => true,
								// default true, display an "EMPTY" icon?
								'type' => 'dfd_icons',
								'iconsPerPage' => 4000,
								// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
							),
							'dependency' => array(
								'element' => 'icon_font',
								'value' => 'dfd_icons',
							),
							'group'      => esc_html__( 'Icon', 'dfd' ),
						),
						*/
						array(
							'type'       => 'iconpicker',
							'class'      => '',
							'heading'    => esc_html__( 'Select Icon ', 'dfd' ),
							'param_name' => 'icon_fontawesome',
							'value' => '', // default value to backend editor admin_label
							'settings' => array(
								'emptyIcon' => true,
								// default true, display an "EMPTY" icon?
								'iconsPerPage' => 4000,
								// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
							),
							'dependency' => array(
								'element' => 'icon_font',
								'value' => 'fontawesome',
							),
							'group'      => esc_html__( 'Icon', 'dfd' ),
						),
						array(
							'type' => 'iconpicker',
							'heading' => __( 'Icon', 'js_composer' ),
							'param_name' => 'icon_openiconic',
							'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
							'settings' => array(
								'emptyIcon' => true, // default true, display an "EMPTY" icon?
								'type' => 'openiconic',
								'iconsPerPage' => 4000, // default 100, how many icons per/page to display
							),
							'dependency' => array(
								'element' => 'icon_font',
								'value' => 'openiconic',
							),
							'description' => __( 'Select icon from library.', 'js_composer' ),
							'group'      => esc_html__( 'Icon', 'dfd' ),
						),
						array(
							'type' => 'iconpicker',
							'heading' => __( 'Icon', 'js_composer' ),
							'param_name' => 'icon_typicons',
							'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
							'settings' => array(
								'emptyIcon' => true, // default true, display an "EMPTY" icon?
								'type' => 'typicons',
								'iconsPerPage' => 4000, // default 100, how many icons per/page to display
							),
							'dependency' => array(
								'element' => 'icon_font',
								'value' => 'typicons',
							),
							'description' => __( 'Select icon from library.', 'js_composer' ),
							'group'      => esc_html__( 'Icon', 'dfd' ),
						),
						array(
							'type' => 'iconpicker',
							'heading' => __( 'Icon', 'js_composer' ),
							'param_name' => 'icon_entypo',
							'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
							'settings' => array(
								'emptyIcon' => true, // default true, display an "EMPTY" icon?
								'type' => 'entypo',
								'iconsPerPage' => 4000, // default 100, how many icons per/page to display
							),
							'dependency' => array(
								'element' => 'icon_font',
								'value' => 'entypo',
							),
							'group'      => esc_html__( 'Icon', 'dfd' ),
						),
						array(
							'type' => 'iconpicker',
							'heading' => __( 'Icon', 'js_composer' ),
							'param_name' => 'icon_linecons',
							'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
							'settings' => array(
								'emptyIcon' => true, // default true, display an "EMPTY" icon?
								'type' => 'linecons',
								'iconsPerPage' => 4000, // default 100, how many icons per/page to display
							),
							'dependency' => array(
								'element' => 'icon_font',
								'value' => 'linecons',
							),
							'description' => __( 'Select icon from library.', 'js_composer' ),
							'group'      => esc_html__( 'Icon', 'dfd' ),
						),
						array(
							'type'        => 'number',
							'heading'     => esc_html__( 'Icon size', 'dfd' ),
							'param_name'  => 'icon_size',
							'suffix'	  => 'px',
							//'edit_field_class' => 'vc_column vc_col-sm-6',
							'dependency' => array(
								'element' => 'icon_font',
								'not_empty' => true,
							),
							'group'      => esc_html__( 'Icon', 'dfd' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Icon alignment', 'js_composer' ),
							'value' => array(
								esc_attr__( 'Left', 'dfd' ) => 'dfd-button-icon-left',
								esc_attr__( 'Right', 'dfd' ) => 'dfd-button-icon-right',
								//esc_attr__( 'Top', 'dfd' ) => 'dfd-button-icon-top',
								//esc_attr__( 'Bottom', 'dfd' ) => 'dfd-button-icon-bottom',
							),
							'param_name' => 'icon_align',
							'dependency' => array(
								'element' => 'icon_font',
								'not_empty' => true,
							),
							'group'      => esc_html__( 'Icon', 'dfd' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Icon hover action', 'dfd' ),
							'value' => array(
								esc_attr__( 'None', 'dfd' ) => 'dfd-button-icon-hover-simple',
								esc_attr__( 'Show on hover', 'dfd' ) => 'dfd-button-icon-hover-show',
								esc_attr__( 'Hide on hover', 'dfd' ) => 'dfd-button-icon-hover-hide',
								//esc_attr__( 'Animate', 'dfd' ) => 'dfd-button-icon-hover-animate',
							),
							'param_name' => 'icon_hover_action',
							'dependency' => array(
								'element' => 'icon_font',
								'not_empty' => true,
							),
							'group'      => esc_html__( 'Icon', 'dfd' ),
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Button paddings', 'dfd' ),
							'param_name'       => 'background_heading',
							'class'            => '',
							'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type'        => 'number',
							'heading'     => esc_html__( 'Left padding', 'dfd' ),
							'param_name'  => 'padding_left',
							'suffix'	  => 'px',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type'        => 'number',
							'heading'     => esc_html__( 'Right padding', 'dfd' ),
							'param_name'  => 'padding_right',
							'suffix'	  => 'px',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Color settings', 'dfd' ),
							'param_name'       => 'background_heading',
							'class'            => '',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type' => 'colorpicker',
							'param_name' => 'text_color',
							'class' => '',
							'heading' => esc_html__('Text color', 'dfd'),
							'value' => '#ffffff',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'group' => esc_html__('Style','dfd'),
						),
						array(
							'type' => 'colorpicker',
							'param_name' => 'hover_text_color',
							'class' => '',
							'heading' => esc_html__('Hover text color', 'dfd'),
							'value' => '#ffffff',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'group' => esc_html__('Style','dfd'),
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Background settings', 'dfd' ),
							'param_name'       => 'background_heading',
							'class'            => '',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type' => 'colorpicker',
							'param_name' => 'background',
							'class' => '',
							'heading' => esc_html__('Background color', 'dfd'),
							'value' => '#1b1b1b',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'group' => esc_html__('Style'),
						),
						array(
							'type' => 'colorpicker',
							'param_name' => 'hover_background',
							'class' => '',
							'heading' => esc_html__('Hover Background', 'dfd'),
							'value' => '#c39f76',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'group' => esc_html__('Style'),
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Tooltip settings', 'dfd' ),
							'param_name'       => 'tooltip_heading',
							'class'            => '',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type' => 'colorpicker',
							'param_name' => 'tooltip_color',
							'class' => '',
							'heading' => esc_html__('Tooltip color', 'dfd'),
							'value' => '',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'group' => esc_html__('Style'),
						),
						array(
							'type' => 'colorpicker',
							'param_name' => 'tooltip_background',
							'class' => '',
							'heading' => esc_html__('Tooltip Background', 'dfd'),
							'value' => '',
							'edit_field_class' => 'vc_column vc_col-sm-6',
							'group' => esc_html__('Style'),
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Border settings', 'dfd' ),
							'param_name'       => 'border_heading',
							'class'            => '',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type' => 'ultimate_border',
							'heading' => esc_html__('Border','dfd'),
							'param_name' => 'border',
							'unit'     => 'px',
							'positions' => array(
								esc_attr__('Top','dfd')     => '',
								esc_attr__('Right','dfd')   => '',
								esc_attr__('Bottom','dfd')  => '',
								esc_attr__('Left','dfd')    => ''
							),
							'enable_radius' => true,
							'radius' => array(
								esc_attr__('Top Left','dfd')     => '',
								esc_attr__('Top Right','dfd')    => '',
								esc_attr__('Bottom Right','dfd') => '',
								esc_attr__('Bottom Left','dfd')  => ''
							),
							'value' => 'border-style:solid;|border-width:1px;border-radius:2px;|border-color:#1b1b1b;',
							'label_color'   => esc_html__('Border Color','dfd'),
							'label_radius'  => esc_html__('Border Radius','dfd'),
							'label_border'  => esc_html__('Border Style','dfd'),
							'group'      => esc_html__( 'Style', 'dfd' ),
							'edit_field_class' => 'dfd-vc-border-parap-styles vc_column vc_col-sm-12',
						),
						array(
							'type' => 'ultimate_border',
							'heading' => esc_html__('Border on hover','dfd'),
							'param_name' => 'hover_border',
							'unit'     => 'px',
							'positions' => array(
								esc_attr__('Top','dfd')     => '',
								esc_attr__('Right','dfd')   => '',
								esc_attr__('Bottom','dfd')  => '',
								esc_attr__('Left','dfd')    => ''
							),
							'enable_radius' => true,
							'radius' => array(
								esc_attr__('Top Left','dfd')     => '',
								esc_attr__('Top Right','dfd')    => '',
								esc_attr__('Bottom Right','dfd') => '',
								esc_attr__('Bottom Left','dfd')  => ''
							),
							'label_color'   => esc_html__('Border Color','dfd'),
							'label_radius'  => esc_html__('Border Radius','dfd'),
							'label_border'  => esc_html__('Border Style','dfd'),
							'group'      => esc_html__( 'Style', 'dfd' ),
							'value' => 'border-style:solid;|border-width:1px;border-radius:2px;|border-color:#c39f76;',
							'edit_field_class' => 'dfd-vc-border-parap-styles vc_column vc_col-sm-12',
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Box shadow settings', 'dfd' ),
							'param_name'       => 'border_heading',
							'class'            => '',
							'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type' => 'ultimate_boxshadow',
							'heading' => __('Box Shadow', 'dfd'),
							'param_name' => 'box_shadow',
							'unit' => 'px',                        //  [required] px,em,%,all     Default all
							'styles' => array(
								esc_attr__('Enable','dfd') => 'none',
								esc_attr__('Disable','dfd') => 'outset',
							),
							'positions' => array(
								esc_attr__('Horizontal','dfd')     => '0',
								esc_attr__('Vertical','dfd')   => '0',
								esc_attr__('Blur','dfd')  => '0',
								esc_attr__('Spread','dfd')    => '0'
							),
							'dependency' => array(
								'element' => 'style',
								'value'   => array('style_1','style_2','style_3','style_4','style_5'),
							),
							'enable_color' => true,
							'label_style'	=> esc_attr__('Style','dfd'),
							'label_color'   => esc_attr__('Shadow Color','dfd'),
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type' => 'ultimate_boxshadow',
							'heading' => __('Box Shadow on Hover', 'dfd'),
							'param_name' => 'hover_box_shadow',
							'unit' => 'px',                        //  [required] px,em,%,all     Default all
							'styles' => array(
								esc_attr__('Enable','dfd') => 'none',
								esc_attr__('Disable','dfd') => 'outset',
							),
							'positions' => array(
								esc_attr__('Horizontal','dfd')     => '0',
								esc_attr__('Vertical','dfd')   => '0',
								esc_attr__('Blur','dfd')  => '0',
								esc_attr__('Spread','dfd')    => '0'
							),
							'dependency' => array(
								'element' => 'style',
								'value'   => array('style_1','style_2','style_3','style_4','style_5'),
							),
							'enable_color' => true,
							'label_style'	=> esc_attr__('Style','dfd'),
							'label_color'   => esc_attr__('Shadow Color','dfd'),
							'group'      => esc_html__( 'Style', 'dfd' ),
						),
						array(
							'type'             => 'ult_param_heading',
							'text'             => esc_html__( 'Typography settings', 'dfd' ),
							'param_name'       => 'typography_heading',
							'group'            => esc_html__( 'Typography', 'dfd' ),
							'class'            => '',
							'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
						),
						array(
							'type'       => 'crumina_font_container',
							'heading'    => '',
							'param_name' => 'title_font_options',
							'settings'   => array(
								'fields' => array(
									//'tag' => 'div',
									'letter_spacing',
									'font_size',
									'line_height',
									//'color',
									'font_style'
								),
							),
							'group'      => esc_html__( 'Typography', 'dfd' ),
						),
						array(
							'type'        => 'checkbox',
							'heading'     => esc_html__( 'Use custom font family?', 'dfd' ),
							'param_name'  => 'title_google_fonts',
							'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
							'description' => esc_html__( 'Use font family from google.', 'dfd' ),
							'group'       => esc_html__( 'Typography', 'dfd' ),
						),
						array(
							'type'       => 'google_fonts',
							'param_name' => 'title_custom_fonts',
							'value'      => '',
							'settings'   => array(
								'fields' => array(
									'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
									'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
								),
							),
							'dependency' => array(
								'element' => 'title_google_fonts',
								'value'   => 'yes',
							),
							'group'      => esc_html__( 'Typography', 'dfd' ),
						),
					)
				));
			}
		}

		function dfd_button_shortcode( $atts, $content = null ) {
			
			$style = $button_size = $direction = $direction_slide = $button_text = $tooltip_text = $alignment = $tooltip_alignment = $buttom_link_src = $el_class = $module_animation = '';
			$text_color = $hover_text_color = $background = $hover_background = $tooltip_color = $tooltip_background = $border = $hover_border = $box_shadow = $hover_box_shadow = '';
			$title_font_options = $title_google_fonts = $title_custom_fonts = '';
			$padding_left = $padding_right = '';
			$icon_dfd_icons = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';
			$icon_fonts = array(
				'dfd_icons', 'fontawesome', 'openiconic', 'typicons', 'entypo', 'linecons'
				
			);
			
			$atts = vc_map_get_attributes( 'dfd_button', $atts );
			extract( $atts );
			
			$html = $icon_html = $css_rules = $js_rules = $js_atts = $data_atts = '';
			$link_url = $link_alt = $link_target = '';
			$background_css = $background_hover_css = $text_css = $border_css = $border_hover_css = $tooltip_css = '';
			
			$uniqid = uniqid('dfd-button-');
			
			if(!empty($module_animation)) {
				$el_class .= ' cr-animate-gen';
				$data_atts .= ' data-animate-type="'.esc_attr($module_animation).'" ';
			}
			
			if($style != '')
				$el_class .= ' '.$style;
			
			if($button_size != '')
				$el_class .= ' '.$button_size;
			
			if($alignment != '')
				$el_class .= ' '.$alignment;
			
			if($direction != '')
				$el_class .= ' '.$direction;
			
			if($direction_slide != '')
				$el_class .= ' '.$direction_slide;
			
			if($icon_align != '')
				$el_class .= ' '.$icon_align;
			
			if($icon_hover_action != '')
				$el_class .= ' '.$icon_hover_action;
			
			$title_font_options = _crum_parse_text_shortcode_params( $title_font_options, '', $title_google_fonts, $title_custom_fonts );
			$title_font_options = str_replace('style=','',$title_font_options['style']);
			$title_font_options = substr($title_font_options, 1, -1);
			
			if($icon_font != '') {
				$icon = 'icon_'.$icon_font;
				if(isset($$icon) || $$icon != '') {
					if($icon_font != 'dfd_icons')
						vc_icon_element_fonts_enqueue( $icon_font );
					
					$icon_html = '<i class="'.esc_attr($$icon).'"></i>';
				}
			}
			
			if($icon_size != '')
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover span i {font-size: '.esc_attr($icon_size).'px;}';
			
			if($padding_left != '')
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover .dfd-button-text-main, '
							. '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover .dfd-button-text-hover {padding-left: '.esc_attr($padding_left).'px;}';
			
			if($padding_right != '')
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover .dfd-button-text-main, '
							. '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover .dfd-button-text-hover {padding-right: '.esc_attr($padding_right).'px;}';
			
			if($title_font_options != '') {
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover .dfd-button-text-main, '
							. '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover .dfd-button-text-hover {'.esc_js($title_font_options).'}';
			}
			
			if($text_color != '')
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover .dfd-button-text-main {color: ' . $text_color . '}';
			
			if($background != '')
				$background_css .= 'background: '.esc_js($background).';';
			
			if($border != '') {
				$border_css .= str_replace('|','',$border);
				$border_radius = substr($border,stripos($border,'border-radius:'));
				$border_radius = substr($border_radius,0,strpos($border_radius,'|'));
				if($border_radius != '')
					$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover {' . $border_radius . '}';
			}
			
			if($background != '' || $border_css != '')
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module:not(.style_4) .dfd-button-link .dfd-button-inner-cover:before, #' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module.style_4 .dfd-button-link .dfd-button-inner-cover:after, #' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module.style_6 .dfd-button-link .dfd-button-inner-cover .dfd-button-text-main {' . $background_css . $border_css . '}';
			
			if($hover_text_color != '')
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module:not(.style_6) .dfd-button-link:hover .dfd-button-inner-cover .dfd-button-text-main, #' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover .dfd-button-text-hover {color: '.esc_js($hover_text_color).';}';
			
			if($hover_background != '')
				$background_hover_css .= 'background: '.esc_js($hover_background).';';
			
			if($hover_border != '') {
				$border_hover_css .= str_replace('|','',$hover_border);
				$hover_border_radius = substr($hover_border,stripos($hover_border,'border-radius:'));
				$hover_border_radius = substr($hover_border_radius,0,strpos($hover_border_radius,'|'));
				if($hover_border_radius != '')
					$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link:hover .dfd-button-inner-cover {' . $hover_border_radius . '}';
			}
			
			if($hover_background != '' || $border_hover_css != '') {//'#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover .dfd-button-text-hover
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module:not(.style_4) .dfd-button-link .dfd-button-inner-cover:after, #' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module.style_4 .dfd-button-link .dfd-button-inner-cover:before,'
							. '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover .dfd-button-text-hover {' . $background_hover_css . $border_hover_css . '}'; 
			}
			
			if(substr_count($box_shadow, 'none') == 0) {
				$box_shadow = apply_filters('Ultimate_GetBoxShadow', $box_shadow, 'css');
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-inner-cover {'.esc_attr($box_shadow).'}';
			}
			
			if(substr_count($box_shadow, 'none') == 0) {
				$hover_box_shadow = apply_filters('Ultimate_GetBoxShadow', $hover_box_shadow, 'css');
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link:hover .dfd-button-inner-cover {'.esc_attr($hover_box_shadow).'}';
			}
			
			if($tooltip_background != '')
				$tooltip_css .= 'background: '.esc_js($tooltip_background).';';
			
			if($tooltip_color != '')
				$tooltip_css .= 'color: '.esc_js($tooltip_color).';';
			
			if($tooltip_css != '')
				$css_rules .= '#' . esc_js($uniqid) . '.dfd-button-module-wrap .dfd-button-module .dfd-button-link .dfd-button-tooltip {' . $tooltip_css . '}';
				
			
			if($buttom_link_src != '') {
				$buttom_link_src = vc_build_link($buttom_link_src);
				
				if(isset($buttom_link_src['url']) && $buttom_link_src['url'] != '')
					$link_url = $buttom_link_src['url'];
				
				if(isset($buttom_link_src['title']) && $buttom_link_src['title'] != '')
					$link_alt = $buttom_link_src['title'];
				
				if(isset($buttom_link_src['target']) && $buttom_link_src['target'] != '')
					$link_target = str_replace(' ','',$buttom_link_src['target']);
			}
			
			$html .= '<div id="'.esc_attr($uniqid).'" class="dfd-button-module-wrap">';
			
				$html .= '<div class="dfd-button-module '.esc_attr($el_class).'" '.$data_atts.'>';
				
					$html .= '<a href="'.esc_url($link_url).'" title="'.esc_attr($link_alt).'" target="'.esc_attr($link_target).'" class="dfd-button-link">';
					
						$html .= '<span class="dfd-button-inner-cover">';
						
							if($button_text != '') {
								if($icon_html != '') {
									if($icon_align == 'dfd-button-icon-right' || $icon_align == 'dfd-button-icon-bottom')
										$button_text = $button_text . $icon_html;
									else
										$button_text = $icon_html . $button_text;
								}
								
								$html .= '<span class="dfd-button-text-main">' . $button_text.'</span>';

								if($style == 'style_6')
									$html .= '<span class="dfd-button-text-hover">' . $button_text . '</span>';
							}
						
						$html .= '</span>';
						
						if($tooltip_text != '')
							$html .= '<span class="dfd-button-tooltip '.esc_attr($tooltip_alignment).'">'.esc_html($tooltip_text).'</span>';
					
					$html .= '</a>';
			
				$html .= '</div>';
				
				if($css_rules != '' || $js_rules != '') {
					$html .=	'<script type="text/javascript">
									(function($) {';

						if($js_rules != '') {
							$html .= '$(document).ready(function() {'.$js_rules.'});';
						}

						if($css_rules != '') {
							$html .= '$("head").append("<style>'.$css_rules.'</style>")';
						}

					$html .=	'
									})(jQuery);
								</script>';
				}
			
			$html .= '</div>';
			
			return $html;

		}
	}
	
	$Dfd_Button_Module = new Dfd_Button_Module;
}