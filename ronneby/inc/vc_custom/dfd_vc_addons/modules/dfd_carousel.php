<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
Module Name: Ultimate Carousel for Visual Composer
Module URI: https://www.brainstormforce.com/demos/ultimate-carousel
*/
if(!class_exists("Dfd_Carousel_Shortcode")){
	class Dfd_Carousel_Shortcode{
		
		function __construct(){
			add_action('init', array($this, 'init_carousel_addon'));
			add_shortcode('dfd_carousel', array($this, 'dfd_carousel_shortcode'));
		}
		
		function init_carousel_addon(){
			if(function_exists('vc_map')){
				new dfd_hide_unsuport_module_frontend("dfd_carousel");
				vc_map(
					array(
						'name' => __('DFD Carousel', 'dfd'),
						'base' => 'dfd_carousel',
						'icon' => 'ultimate_carousel',
						'class' => 'dfd_carousel',
						'as_parent' => array('except' => array('dfd_carousel')),
						'content_element' => true,
						'controls' => 'full',
						'show_settings_on_create' => true,
						'category' => __('Ronneby 2.0','dfd'),
						'description' => 'Apply animations everywhere.',
						'params' => array(
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Carousel style', 'dfd' ),
								'param_name'       => 'main_heading',
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'            => esc_attr__( 'General', 'dfd' ),
							),
							array(
								'type'        => 'radio_image_select',
								'heading'     => esc_html__( 'Layout type', 'dfd' ),
								'description' => '',
								'param_name'  => 'slider_type',
								'simple_mode' => false,
								'options'     => array(
									'horizontal' => array(
										'tooltip' => esc_attr__('Horizontal','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/horizontal.png'
									),
									'vertical' => array(
										'tooltip' => esc_attr__('Vertical','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/vertical.png'
									),
								),
								'group'            => esc_attr__( 'General', 'dfd' ),
							),
							/*
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Slider Type','dfd'),
								'param_name' => 'slider_type',
								'value' => array(
										esc_attr__('Horizontal','dfd') => 'horizontal',
										esc_attr__('Vertical','dfd') => 'vertical',
										esc_attr__('Horizontal Full Width','dfd') => 'full_width',
										esc_attr__('Vertical Full Screen','dfd') => 'full_screen'
									),
								'group'=> 'General',
						  	),
							*/
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => __('Infinite loop', 'dfd'),
								'param_name' => 'infinite_loop',
								// 'admin_label' => true,
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => '',
											'on' => esc_attr__('Yes','dfd'),
											'off' => esc_attr__('No','dfd'),
										),
									),
								'group'=> esc_html__('General','dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-4',
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable center mode','dfd'),
								'param_name' => 'center_mode',
								'value' => '',
								'options' => array(
									'on' => array(
											'label' => '',
											'on' => esc_attr__('Yes','dfd'),
											'off' => esc_attr__('No','dfd'),
										),
									),
								'group'=> esc_html__('General','dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-4',
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Draggable Effect', 'dfd'),
								'param_name' => 'draggable',
								// 'admin_label' => true,
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => '',
											'on' => esc_attr__('Yes','dfd'),
											'off' => esc_attr__('No','dfd'),
										),
									),
								'edit_field_class' => 'vc_column vc_col-sm-4',
								'group'=> esc_html__('General','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Touch Move', 'dfd'),
								'param_name' => 'touch_move',
								// 'admin_label' => true,
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => '',
											'on' => esc_attr__('Yes','dfd'),
											'off' => esc_attr__('No','dfd'),
										),
									),
								'edit_field_class' => 'vc_column vc_col-sm-4',
								'dependency' => Array('element' => 'draggable', 'value' => array('on')),
								'group'=> esc_html__('General','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Adaptive height', 'dfd'),
								'param_name' => 'adaptive_height',
								// 'admin_label' => true,
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => '',
											'on' => esc_attr__('Yes','dfd'),
											'off' => esc_attr__('No','dfd'),
										),
									),
								'edit_field_class' => 'vc_column vc_col-sm-4',
								'group'=> esc_html__('General','dfd'),
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => esc_html__('Extra Class','dfd'),
								'param_name' => 'el_class',
								'value' => '',
								'group'=> esc_html__('General','dfd'),
						  	),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => esc_html__( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
								'group'		  => esc_html__('General','dfd'),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Slideshow settings', 'dfd' ),
								'param_name'       => 'slides_heading',
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'            => esc_attr__( 'Slideshow', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Slides to show','dfd'),
								'param_name' => 'slides_to_show',
								'value' => '1',
								'min' => '1',
								'max' => '25',
								'step' => '1',
								//'edit_field_class' => 'vc_column vc_col-sm-4',
								'edit_field_class' => 'vc_column vc_col-sm-4',
								'group'=> esc_html__('Slideshow','dfd'),
						  	),
							/*
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Slides to scroll','dfd'),
								'param_name' => 'slides_to_scroll',
								'value' => '1',
								'min' => '1',
								'max' => '10',
								'step' => '1',
								'edit_field_class' => 'vc_column vc_col-sm-4',
								'group'=> esc_html__('Slideshow','dfd'),
						  	),
							*/
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Slideshow speed','dfd'),
								'param_name' => 'speed',
								'value' => '300',
								'min' => '100',
								'max' => '10000',
								'step' => '100',
								'suffix' => 'ms',
								'edit_field_class' => 'vc_column vc_col-sm-4',
								//'edit_field_class' => 'vc_column vc_col-sm-4',
								'group'=> esc_html__('Slideshow','dfd'),
						  	),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Items offset','dfd'),
								'param_name' => 'items_offset',
								'value' => '20',
								'min' => '0',
								'max' => '100',
								'step' => '1',
								'edit_field_class' => 'vc_column vc_col-sm-4',
								'group'=> esc_html__('Slideshow','dfd'),
						  	),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Autoslideshow settings', 'dfd' ),
								'param_name'       => 'autoslides_heading',
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								'group'            => esc_attr__( 'Slideshow', 'dfd' ),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Autoslideshow', 'dfd'),
								'param_name' => 'autoplay',
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => esc_attr__('Enable Autoplay', 'dfd'),
											'on' => esc_attr__('Yes','dfd'),
											'off' => esc_attr__('No','dfd'),
										),
									),
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'group'=> esc_html__('Slideshow','dfd'),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Autoplay Speed','dfd'),
								'param_name' => 'autoplay_speed',
								'value' => '5000',
								'min' => '100',
								'max' => '10000',
								'step' => '10',
								'suffix' => 'ms',
								'edit_field_class' => 'vc_column vc_col-sm-6',
								'dependency' => Array('element' => 'autoplay', 'value' => array('on')),
								'group'=> esc_html__('Slideshow','dfd'),
						  	),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Medium desktop', 'dfd'),
								'param_name' => 'sizing_normal',
								'class' => '',
								'group'=> esc_html__('Responsive','dfd'),
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Screen resolution', 'dfd'),
								'param_name' => 'screen_normal_resolution',
								'value' => 1024,
								'group'=> esc_html__('Responsive','dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6'
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Number of slides', 'dfd'),
								//'admin_label' => true,
								'value' => '1',
								'param_name' => 'screen_normal_slides',
								'group'=> esc_html__('Responsive','dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6'
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Tablets', 'dfd'),
								'param_name' => 'sizing_tablet',
								'class' => '',
								'group'=> esc_html__('Responsive','dfd'),
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Screen resolution', 'dfd'),
								'param_name' => 'screen_tablet_resolution',
								'value' => 800,
								'group'=> esc_html__('Responsive','dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6'
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Number of slides', 'dfd'),
								//'admin_label' => true,
								'value' => '1',
								'param_name' => 'screen_tablet_slides',
								'group'=> esc_html__('Responsive','dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6'
							),
							array(
								'type' => 'ult_param_heading',
								'text' => esc_html__('Mobile phones', 'dfd'),
								'param_name' => 'sizing_mobile',
								'class' => '',
								'group'=> esc_html__('Responsive','dfd'),
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Screen resolution', 'dfd'),
								'param_name' => 'screen_mobile_resolution',
								'value' => 480,
								'group'=> esc_html__('Responsive','dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6'
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Number of slides', 'dfd'),
								//'admin_label' => true,
								'value' => '1',
								'param_name' => 'screen_mobile_slides',
								'group'=> esc_html__('Responsive','dfd'),
								'edit_field_class' => 'vc_column vc_col-sm-6'
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Navigation arrows', 'dfd' ),
								'param_name'       => 'arrows_heading',
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								'group'=> esc_html__('Navigation','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Navigation Arrows', 'dfd'),
								'param_name' => 'arrows',
								// 'admin_label' => true,
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => '',
											'on' => esc_attr__('Yes', 'dfd'),
											'off' => esc_attr__('No', 'dfd'),
										),
									),
								'group'=> esc_html__('Navigation','dfd'),
							),
							array(
								'type'        => 'radio_image_select',
								'heading'     => esc_html__( 'Arrows position', 'dfd' ),
								'param_name'  => 'arrows_position',
								'simple_mode' => false,
								'options'     => array(
									'aside_offset' => array(
										'tooltip' => esc_attr__('Aside with offset','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/aside_offset.png'
									),
									'aside' => array(
										'tooltip' => esc_attr__('Aside','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/aside.png'
									),
									'top_left' => array(
										'tooltip' => esc_attr__('Top left','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/top_left.png'
									),
									'top_center' => array(
										'tooltip' => esc_attr__('Top center','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/top_center.png'
									),
									'top_right' => array(
										'tooltip' => esc_attr__('Top right','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/top_right.png'
									),
									'bottom_left' => array(
										'tooltip' => esc_attr__('Bottom left','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/bottom_left.png'
									),
									'bottom_center' => array(
										'tooltip' => esc_attr__('Bottom center','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/bottom_center.png'
									),
									'bottom_right' => array(
										'tooltip' => esc_attr__('Bottom right','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows_position/bottom_right.png'
									),
								),
								'dependency' => Array('element' => 'arrows', 'value' => array('on')),
								'group'=> esc_html__('Navigation','dfd'),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Arrow Style','dfd'),
								'param_name' => 'arrow_style',
								'value' => array(
									esc_attr__('Pre-built','dfd') => 'default',
									esc_attr__('Upload','dfd') => 'upload',
								),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-12',
								'dependency' => Array('element' => 'arrows', 'value' => array('on')),
								'group'=> esc_html__('Navigation','dfd'),
						  	),
							array(
								'type'        => 'radio_image_select',
								'heading'     => esc_html__( 'Arrows style', 'dfd' ),
								'description' => '',
								'param_name'  => 'arrows_style',
								'simple_mode' => false,
								'options'     => array(
									'style_1' => array(
										'tooltip' => esc_attr__('Aside','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows/style_1.png'
									),
									'style_2' => array(
										'tooltip' => esc_attr__('Aside','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows/style_2.png'
									),
									'style_3' => array(
										'tooltip' => esc_attr__('Aside','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows/style_3.png'
									),
									'style_4' => array(
										'tooltip' => esc_attr__('Aside','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows/style_4.png'
									),
									'style_5' => array(
										'tooltip' => esc_attr__('Aside','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/arrows/style_5.png'
									),
								),
								'dependency' => Array('element' => 'arrow_style', 'value' => array('default')),
								'group'=> esc_html__('Navigation','dfd'),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => esc_html__('Arrows background','dfd'),
								'param_name' => 'arrows_bg',
								'value' => '',
								'dependency' => Array('element' => 'arrows_style', 'value' => array('style_3','style_4','style_5')),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-6',
								'group'=> esc_html__('Navigation','dfd'),
						  	),
							array(
								'type' => 'attach_image',
								'class' => '',
								'heading' => esc_html__('Left navigation arrow','dfd'),
								'param_name' => 'left_arrow',
								'value' => '',
								'dependency' => Array('element' => 'arrow_style', 'value' => array('upload')),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-6',
								'group'=> esc_html__('Navigation','dfd'),
							),
							array(
								'type' => 'attach_image',
								'class' => '',
								'heading' => esc_html__('Right navigation arrow','dfd'),
								'param_name' => 'right_arrow',
								'value' => '',
								'dependency' => Array('element' => 'arrow_style', 'value' => array('upload')),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-6',
								'group'=> esc_html__('Navigation','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Enable slides counter','dfd'),
								'param_name' => 'enable_counter',
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => '',
											'on' => esc_attr__('Yes', 'dfd'),
											'off' => esc_attr__('No', 'dfd'),
										),
									),
								'dependency' => Array('element' => 'arrows', 'value' => array('on')),
								'group'=> esc_html__('Navigation','dfd'),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-6',
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Always show arrows','dfd'),
								'param_name' => 'arrows_always_show',
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => '',
											'on' => esc_attr__('Yes', 'dfd'),
											'off' => esc_attr__('No', 'dfd'),
										),
									),
								'dependency' => Array('element' => 'arrows', 'value' => array('on')),
								'group'=> esc_html__('Navigation','dfd'),
								'edit_field_class' => 'no-top-padding vc_column vc_col-sm-6',
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Navigation dots', 'dfd' ),
								'param_name'       => 'dots_heading',
								'class'            => '',
								'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								'group'=> esc_html__('Navigation','dfd'),
							),
							array(
								'type' => 'ult_switch',
								'class' => '',
								'heading' => esc_html__('Dots Pagination', 'dfd'),
								'param_name' => 'dots',
								// 'admin_label' => true,
								'value' => 'on',
								'options' => array(
									'on' => array(
											'label' => '',
											'on' => esc_attr__('Yes','dfd'),
											'off' => esc_attr__('No','dfd'),
										),
									),
								'dependency' => Array('element' => 'arrows_position', 'value' => array('aside','aside_offset','top_left','top_center','top_right','bottom_left','bottom_right')),
								'group'=> esc_html__('Navigation','dfd'),
							),
							array(
								'type'        => 'radio_image_select',
								'heading'     => esc_html__( 'Pagination style', 'dfd' ),
								'description' => '',
								'param_name'  => 'dots_style',
								'simple_mode' => false,
								'options'     => array(
									'dfdrounded' => array(
										'tooltip' => esc_attr__('Rounded','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_1.png'
									),
									'dfdfillrounded' => array(
										'tooltip' => esc_attr__('Filled rounded','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_2.png'
									),
									'dfdemptyrounded' => array(
										'tooltip' => esc_attr__('Transparent rounded','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_3.png'
									),
									'dfdfillsquare' => array(
										'tooltip' => esc_attr__('Filled square','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_6.png'
									),
									'dfdsquare' => array(
										'tooltip' => esc_attr__('Square','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_7.png'
									),
									'dfdemptysquare' => array(
										'tooltip' => esc_attr__('Transparent square','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_8.png'
									),
									'dfdline' => array(
										'tooltip' => esc_attr__('Line','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_4.png'
									),
									'dfdadvancesquare' => array(
										'tooltip' => esc_attr__('Advanced square','dfd'),
										'src' => get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/carousel/dots/style_5.png'
									),
								),
								'dependency' => Array('element' => 'dots', 'value' => array('on')),
								'group'=> esc_html__('Navigation','dfd'),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => esc_html__('Active dot color','dfd'),
								'param_name' => 'dots_color',
								'value' => '',
								'dependency' => Array('element' => 'dots', 'value' => array('on')),
								'group'=> esc_html__('Navigation','dfd'),
						  	),
						),
						'js_view' => 'VcColumnView'
					)
				); // vc_map
				if(is_rtl() && function_exists('vc_add_parap')) {
					vc_add_param(array(
						'type' => 'ult_switch',
						'class' => '',
						'heading' => esc_html__('RTL Mode', 'dfd'),
						'param_name' => 'rtl',
						// 'admin_label' => true,
						'value' => '',
						'options' => array(
							'on' => array(
									'label' => '',
									'on' => esc_attr__('Yes','dfd'),
									'off' => esc_attr__('No','dfd'),
								),
							),
						'dependency' => Array('element' => 'slider_type', 'value' => array('horizontal')),
						'edit_field_class' => 'vc_column vc_col-sm-4',
						'group'=> esc_html__('General','dfd'),
					));
				}
			}
		}
		
		function dfd_carousel_shortcode($atts, $content) {
			if(dfd_show_unsuport_nested_module_frontend("DFD Carousel")) return false;

			$disabled_tags = array( 'vc_tab', 'vc_accordion_tab', 'info_list_item', 'ult_hotspot_items', 'info_circle_item', 'ultimate_icon_list_item', 'ult_ihover_item', 'dfd_service_item' );
			
			/* General options */
			$slider_type = $el_class = $module_animation = $arrows_style = $dots_style = $animation_data = '';
			$infinite_loop = $center_mode = $draggable = $touch_move = $rtl = $slides_to_show = $slides_to_scroll = $speed = $autoplay = $autoplay_speed = '';
			/* Responsive options */
			$screen_normal_resolution = $screen_normal_slides = $screen_tablet_resolution = $screen_tablet_slides = $screen_mobile_resolution = $screen_mobile_slides = '';
			/* Navigation vars */
			$arrows = $arrows_position = $arrow_style = $dots_color = $enable_counter = $arrows_always_show = $dots = '';
			
			$atts = vc_map_get_attributes( 'dfd_carousel', $atts );
			extract( $atts );
			
			$uniqid = uniqid('dfd-carousel-');
			
			$settings = $left_arrow_html = $right_arrow_html = $counter_html = $css_rules = '';
			
			$settings .= 'arrows: false,';
			$settings .= 'dotsClass: \'dfd-slick-dots\',';
			$settings .= 'slidesToScroll: 1,';
			
			if($autoplay == 'on') {
				$settings .= 'autoplay: true,';
				if($autoplay != '')
					$settings .= 'autoplaySpeed: '.esc_js($autoplay_speed).',';
			}
			
			if($slider_type != '')
				$el_class .= ' dfd-carousel-' . $slider_type;
			
			if($arrows_position != '') {
				$el_class .= ' dfd-arrows_' . $arrows_position;
				
			}
			
			if($arrows_always_show == 'on')
				$el_class .= ' dfd-keep-arrows';
			
			if($dots_style != '')
				$el_class .= ' ' . $dots_style;
			
			if($arrow_style == 'default') {
				$el_class .= ' dfd-arrows-' . $arrows_style . ' dfd-arrows-enabled';
				$left_arrow_html .= '<i class="dfd-added-font-icon-left-open2"></i>';
				$right_arrow_html .= '<i class="dfd-added-font-icon-right-open2"></i>';
			} elseif($arrow_style == 'upload' && isset($left_arrow) && !empty($left_arrow) && isset($right_arrow) && !empty($right_arrow)) {
				$left_arrow_src = wp_get_attachment_image_src($left_arrow, 'full');
				$right_arrow_src = wp_get_attachment_image_src($right_arrow, 'full');
				if(isset($left_arrow_src[0]) && !empty($left_arrow_src[0]))
					$left_arrow_html .= '<img src="'.esc_url($left_arrow_src[0]).'" alt="'.esc_attr__('Left arrow','dfd').'" />';
				if(isset($right_arrow_src[0]) && !empty($right_arrow_src[0]))
					$right_arrow_html .= '<img src="'.esc_url($right_arrow_src[0]).'" alt="'.esc_attr__('Right arrow','dfd').'" />';
				$el_class .= ' dfd-arrows-enabled dfd-arrows-uploaded';
			}
			
			if($module_animation != '') {
				$el_class .= ' cr-animate-gen';
				$animation_data .= 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			if($slider_type == 'vertical')
				$settings .= 'vertical: true,';
			
			if($dots == 'on' && $arrows_position != 'bottom_center') {
                $settings .= 'dots: true,';
                $settings .=	'customPaging: function(slider, i) {
									return \'<span data-role="none" role="button" aria-required="false" tabindex="0"></span>\';
								},';
				$el_class .= ' dfd-dots-enabled';
			}else
                $settings .= 'dots: false,';
			
			if($infinite_loop == 'on')
                $settings .= 'infinite: true,';
			else
                $settings .= 'infinite: false,';
			
			if($center_mode == 'on')
                $settings .= 'centerMode: true,';
			
			if($slides_to_show != '')
                $settings .= 'slidesToShow: '.esc_js($slides_to_show).',';
			
			if($speed != '')
                $settings .= 'speed: '.esc_js($speed).',';
			
			if($draggable == 'on'){
				$settings .= 'swipe: true,';
				$settings .= 'draggable: true,';
			} else {
				$settings .= 'swipe: false,';
				$settings .= 'draggable: false,';

				if($touch_move == 'on')
					$settings .= 'touchMove: true,';
			}

			if($adaptive_height == 'on')
				$settings .= 'adaptiveHeight: true,';

			if($rtl == 'on')
				$settings .= 'rtl: true,';
			
			if($screen_normal_resolution == '')
				$screen_normal_resolution == 1024;
			
			if($screen_tablet_resolution == '')
				$screen_tablet_resolution == 800;
			
			if($screen_mobile_resolution == '')
				$screen_mobile_resolution == 480;
			
			if($screen_normal_slides != '' || $screen_tablet_slides != '' || $screen_mobile_slides != '') {
				$settings .= 'responsive: [';
				if($screen_normal_slides != '') {
					$settings .= '
							{
								breakpoint: '.esc_js($screen_normal_resolution).',
								settings: {
									slidesToShow: '.esc_js($screen_normal_slides).',
									slidesToScroll: 1,
								}
							},';
				}
				if($screen_tablet_slides != '') {
					$settings .= '
							{
								breakpoint: '.esc_js($screen_tablet_resolution).',
								settings: {
									slidesToShow: '.esc_js($screen_tablet_slides).',
									slidesToScroll: 1,
								}
							},';
				}
				if($screen_mobile_slides != '') {
					$settings .= '
							{
								breakpoint: '.esc_js($screen_mobile_resolution).',
								settings: {
									slidesToShow: '.esc_js($screen_mobile_slides).',
									slidesToScroll: 1,
								}
							},';
				}
				$settings .= ']';
			}
			
			if($enable_counter == 'on')
				$counter_html .= '<span class="count"></span>';
			
			if($arrows_bg != '')
				$css_rules .= '#'.esc_js($uniqid).' .dfd-arrows-style_3 .dfd-slider-control:after, #'.esc_js($uniqid).' .dfd-arrows-style_4 .dfd-slider-control:after, #'.esc_js($uniqid).' .dfd-arrows-style_5 .dfd-slider-control {background: '.esc_js($arrows_bg).'}';
			
			if($dots_color != '') {
				$css_rules .=	'#'.esc_js($uniqid).' .dfdrounded ul.dfd-slick-dots li.slick-active span:before, #'.esc_js($uniqid).' .dfdsquare ul.dfd-slick-dots li.slick-active span:before {background: '.esc_js($dots_color).'}'
								.'#'.esc_js($uniqid).' .dfdfillrounded ul.dfd-slick-dots li.slick-active span, #'.esc_js($uniqid).' .dfdfillsquare ul.dfd-slick-dots li.slick-active span {background: '.esc_js($dots_color).';border-color: '.esc_js($dots_color).';}'
								.'#'.esc_js($uniqid).' .dfdemptyrounded ul.dfd-slick-dots li.slick-active span, #'.esc_js($uniqid).' .dfdemptysquare ul.dfd-slick-dots li.slick-active span {border-color: '.esc_js($dots_color).';}'
								.'#'.esc_js($uniqid).' .dfdline ul.dfd-slick-dots li.slick-active span:before {border-color: '.esc_js($dots_color).';}'
								.'#'.esc_js($uniqid).' .dfdadvancesquare ul.dfd-slick-dots li.slick-active span {background: '.esc_js($dots_color).';}'
								.'#'.esc_js($uniqid).' .dfdadvancesquare ul.dfd-slick-dots li.slick-active span:before {border-bottom-color: '.esc_js($dots_color).';}';
			}
			
			if($items_offset != '')
				$css_rules .= '#'.esc_js($uniqid).' > .dfd-carousel-module-wrapper > .dfd-carousel > .slick-list > .slick-track > .dfd-item-wrap > .cover {padding: '.esc_js($items_offset/2).'px;} #'.esc_js($uniqid).' {margin: -'.esc_attr($items_offset/2).'px;}';
			
			ob_start();
			
			echo '<div id="'.esc_attr($uniqid).'" class="dfd-carousel-wrapper">';
				echo '<div class="dfd-carousel-module-wrapper '.esc_attr($el_class).'" '.$animation_data.'>';
					echo '<div class="dfd-carousel">';
						if(method_exists('Dfd_Wrap_Shortcode','dfd_override_shortcodes'))
							Dfd_Wrap_Shortcode::dfd_override_shortcodes($disabled_tags);
						echo do_shortcode($content);
						if(method_exists('Dfd_Wrap_Shortcode','dfd_restore_shortcodes'))
							Dfd_Wrap_Shortcode::dfd_restore_shortcodes();
					echo '</div>';
					if($arrows == 'on') {
						echo '<a href="#" class="dfd-slider-control prev" title="'.esc_attr__('Previous slide','dfd').'">'.$counter_html.$left_arrow_html.'</a>';
						echo '<a href="#" class="dfd-slider-control next" title="'.esc_attr__('Next slide','dfd').'">'.$counter_html.$right_arrow_html.'</a>';
					}
				echo '</div>';
				?>
				<script type="text/javascript">
					(function($) {
						"use strict";
						var $carousel = $('#<?php echo esc_js($uniqid); ?>').find('.dfd-carousel');
						$(document).ready(function() {
							<?php if($arrows == 'on') {
								if($enable_counter == 'on') :  ?>
									var total_slides;
									$carousel.on('init reInit afterChange', function (event, slick, currentSlide) {
										var prev_slide_index, next_slide_index, current;
										var $prev_counter = $carousel.siblings('.dfd-slider-control.prev').find('.count');
										var $next_counter = $carousel.siblings('.dfd-slider-control.next').find('.count');
										total_slides = slick.slideCount;
										current = (currentSlide ? currentSlide : 0) + 1;
										prev_slide_index = (current - 1 < 1) ? total_slides : current - 1;
										next_slide_index = (current + 1 > total_slides) ? 1 : current + 1;
										$prev_counter.text(prev_slide_index + '/' + total_slides);
										$next_counter.text(next_slide_index + '/'+ total_slides);
									});
								<?php endif;
							} ?>
							$carousel.siblings('.dfd-slider-control.prev').click(function(e) {
								e.preventDefault();
								$carousel.slickPrev();
							});
							$carousel.siblings('.dfd-slider-control.next').click(function(e) {
								e.preventDefault();
								$carousel.slickNext();
							});
							$carousel.slick({<?php echo $settings; ?>});
							<?php if($css_rules != '')
								echo '$("head").append("<style>' . $css_rules . '</style>")';
							?>
						});
					})(jQuery);
				</script>
            <?php
			echo '</div>';
			return ob_get_clean();
		}
	}
	new Dfd_Carousel_Shortcode;
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		class WPBakeryShortCode_dfd_carousel extends WPBakeryShortCodesContainer {
		}
	}
}