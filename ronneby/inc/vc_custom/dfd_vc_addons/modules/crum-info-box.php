<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Info box
*/

if ( ! class_exists( 'Dfd_Info_Box' ) ) {

	class Dfd_Info_Box {

		function __construct() {
			add_action( 'init', array( &$this, 'info_box_init' ) );
			add_shortcode( 'dfd_info_box', array( &$this, 'info_box_form' ) );
		}

		function info_box_init() {

			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/info_box/';

				$delim_options_base = _crum_vc_delim_settings();

				/*
				$delim_options_position = array(
					'0' => array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Delimiter position:', 'dfd' ),
						'param_name' => 'line_position',
						'value'      => array(
							esc_html__( 'Default', 'dfd' )        => '',
							esc_html__( 'Before Title', 'dfd' )   => 'top',
							esc_html__( 'After Title', 'dfd' )    => 'medium',
							esc_html__( 'After Subtitle', 'dfd' ) => 'bottom',
						),
						'group'      => esc_html__( 'Style', 'dfd' ),
					)
				);
				*/

				$delim_options_style = array(
					//'0' => array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Delimiter style:', 'dfd' ),
						'param_name' => 'delimiter_style',
						'value'      => array(
							esc_html__( 'Theme default', 'dfd' )  => '',
							esc_html__( 'Solid', 'dfd' )  => 'solid',
							esc_html__( 'Dotted', 'dfd' ) => 'dotted',
							esc_html__( 'Dashed', 'dfd' ) => 'dashed',
						),
						'group'      => esc_html__( 'Style', 'dfd' ),
					//)
				);
				
				//$delim_options = array_replace( $delim_options_base, $delim_options_position, $delim_options_style );
				$delim_options = $delim_options_base; //$delim_options_position, $delim_options_style
				$delim_options[0] = $delim_options_style;

				vc_map(
					array(
						'name'        => esc_html__( 'Info box', 'dfd' ),
						'base'        => 'dfd_info_box',
						"icon"        => 'vc_info_box',
						"class"       => 'info_box',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Box with information', 'dfd' ),
						'params'      => array_merge(
							array(
								array(
									'heading'     => esc_html__( 'Style', 'dfd' ),
									'description' => '',
									'type'        => 'radio_image_select',
									'param_name'  => 'style',
									'simple_mode' => false,
									'options'     => array(
										'style-01'	=> array(
											'tooltip'	=> esc_attr__('Simple','dfd'),
											'src'		=> $module_images . 'style-01.png'
										),
										'style-02'	=> array(
											'tooltip'	=> esc_attr__('Solid','dfd'),
											'src'		=> $module_images . 'style-02.png'
										),
										'style-03'	=> array(
											'tooltip'	=> esc_attr__('Bordered','dfd'),
											'src'		=> $module_images . 'style-03.png'
										),
										'style-04'	=> array(
											'tooltip'	=> esc_attr__('Framed','dfd'),
											'src'		=> $module_images . 'style-04.png'
										),
										'style-05'	=> array(
											'tooltip'	=> esc_attr__('Image bg','dfd'),
											'src'		=> $module_images . 'style-05.png'
										),
										'style-06'	=> array(
											'tooltip'	=> esc_attr__('Overlay','dfd'),
											'src'		=> $module_images . 'style-06.png'
										),
									),
								),
								array(
									'heading'     => esc_html__( 'Select Layout', 'dfd' ),
									'description' => '',
									'type'        => 'radio_image_select',
									'param_name'  => 'layout',
									'simple_mode' => false,
									'options'     => array(
										'layout-01'	=> array(
											'tooltip'	=> esc_attr__('Top','dfd'),
											'src'		=> $module_images . 'layout-01.png'
										),
										'layout-02'	=> array(
											'tooltip'	=> esc_attr__('Bottom','dfd'),
											'src'		=> $module_images . 'layout-02.png'
										),
										'layout-03'	=> array(
											'tooltip'	=> esc_attr__('Middle','dfd'),
											'src'		=> $module_images . 'layout-03.png'
										),
										'layout-04'	=> array(
											'tooltip'	=> esc_attr__('Left','dfd'),
											'src'		=> $module_images . 'layout-04.png'
										),
										'layout-05'	=> array(
											'tooltip'	=> esc_attr__('Right','dfd'),
											'src'		=> $module_images . 'layout-05.png'
										),
										'layout-06'	=> array(
											'tooltip'	=> esc_attr__('Top left','dfd'),
											'src'		=> $module_images . 'layout-06.png'
										),
										'layout-07'	=> array(
											'tooltip'	=> esc_attr__('Top right','dfd'),
											'src'		=> $module_images . 'layout-07.png'
										),
									),
									'dependency'  => array(
										'element'            => 'style',
										'value_not_equal_to' => array( 'style-06' ),
									),
								),
								/*
								array(
									'type'       => 'checkbox',
									'heading'    => esc_html__( 'Box', 'dfd' ) . ' ' . esc_html__( 'Background', 'dfd' ),
									'value'      => array( esc_html__( 'Yes, please', 'dfd' ) => 'yes' ),
									'param_name' => 'box_bg',
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__( 'Background', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'box_bg_color',
									'dependency' => array(
										'element' => 'box_bg',
										'value'   => 'yes',
									),
								),
								array(
									'type'       => 'checkbox',
									'heading'    => esc_html__( 'Show', 'dfd' ) . ' ' . esc_html__( 'Shadow', 'dfd' ),
									'value'      => array( esc_html__( 'Yes, please', 'dfd' ) => 'yes' ),
									'param_name' => 'box_shadow',
									'dependency' => array(
										'element' => 'box_bg',
										'value'   => 'yes',
									),
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__( 'Select style of item shadow', 'dfd' ),
									'param_name' => 'shadow_style',
									'value'      => array(
										esc_html__( 'Permanent', 'dfd' )     => 'permanent',
										esc_html__( 'Show on hover', 'dfd' ) => 'hover',
									),
									'dependency' => array(
										'element' => 'box_shadow',
										'value'   => array( 'yes' )
									),
								),
								*/
								array(
									'type'       => 'dropdown',
									'class'      => '',
									'heading'    => esc_html__( 'Hover', 'dfd' ).' '.esc_html__( 'Animation', 'dfd' ),
									'param_name' => 'hover_animation',
									'value' => array(
										__('No Effect', 'dfd') => '',
										__('Icon Bounce Up', 'dfd') => 'hover-up-icon',
										__('All box bounce up', 'dfd') => 'hover-up-box',
									),
								),
								array(
									'type'       => 'dropdown',
									'class'      => '',
									'heading'    => esc_html__( 'Animation', 'dfd' ),
									'param_name' => 'module_animation',
									'value'      => dfd_module_animation_styles(),
								),
								array(
									'type'        => 'textfield',
									'heading'     => __( 'Extra class name', 'js_composer' ),
									'param_name'  => 'el_class',
									'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
								),
								array(
									'type'        => 'textfield',
									'heading'     => esc_html__( 'Title', 'dfd' ),
									'param_name'  => 'title',
									'admin_label' => true,
									'group'       => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__( 'Subtitle', 'dfd' ),
									'param_name' => 'subtitle',
									'group'      => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'textarea',
									'heading'    => esc_html__( 'Content', 'dfd' ),
									'param_name' => 'content',
									'group'      => esc_html__( 'Content', 'dfd' ),
								),

								array(
									'type' => 'dropdown',
									'heading' => esc_html__('Apply link to:', 'dfd'),
									'param_name' => 'read_more',
									'value' => array(
										esc_html__('No Link', 'dfd') => '',
										esc_html__('Complete Box', 'dfd') => 'box',
										esc_html__('Box Title', 'dfd') => 'title',
										esc_html__('Read More', 'dfd') => 'more',
									),
									'group'      => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'vc_link',
									'heading'    => esc_html__( 'Add link', 'dfd' ),
									'param_name' => 'link',
									'description' => esc_html__( 'Add a custom link or select existing page. You can remove existing link as well.', 'dfd' ),
									'group'      => esc_html__( 'Content', 'dfd' ),
									'dependency' => Array('element' => 'read_more', 'value' => array('box','title','more')),
								),
								array(
									'type'       => 'checkbox',
									'heading'    => esc_html__( 'Show read more button', 'dfd' ),
									'value'      => array( esc_html__( 'Yes, please', 'dfd' ) => 'yes' ),
									'param_name' => 'readmore_show',
									'group'      => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'dropdown',
									'heading'    => esc_html__( 'Show button', 'dfd' ),
									'param_name' => 'more_show',
									'value'      => array(
										esc_html__( 'Permanent', 'dfd' )     => 'permanent',
										esc_html__( 'Show on hover', 'dfd' ) => 'hover',
									),
									'dependency' => array(
										'element' => 'readmore_show',
										'value'   => array( 'yes' )
									),
									'group'      => esc_html__( 'Content', 'dfd' ),
								),

								array(
									'heading'     => esc_html__( 'Read more style', 'dfd' ),
									'description' => '',
									'type'        => 'dropdown',
									'param_name'  => 'readmore_style',
									'value'       => array(

										esc_html__( 'Text link', 'dfd' )    => 'read-more-01',
										esc_html__( 'Lines', 'dfd' )        => 'read-more-02',
										esc_html__( 'Dots', 'dfd' )         => 'read-more-03',
										esc_html__( 'Slashes', 'dfd' )      => 'read-more-04',
										esc_html__( 'Text + Arrow', 'dfd' ) => 'read-more-05',
										esc_html__( 'Arrow', 'dfd' )        => 'read-more-06',
										esc_html__( 'Circle', 'dfd' )       => 'read-more-07',
										esc_html__( 'Button', 'dfd' )       => 'read-more-08',

									),
									'dependency'  => array(
										'element' => 'readmore_show',
										'value'   => 'yes',
									),
									'group'       => esc_html__( 'Content', 'dfd' ),
								),
								array(
									'type'       => 'textfield',
									'heading'    => esc_html__( 'Read more', 'dfd' ) . ' ' . esc_html__( 'Text', 'dfd' ),
									'param_name' => 'readmore_text',
									'value'      => esc_html__( 'Read more', 'dfd' ),
									'dependency' => array(
										'element' => 'readmore_style',
										'value'   => array( 'read-more-01', 'read-more-05', 'read-more-08' ),
									),
									'group'      => esc_html__( 'Content', 'dfd' ),
								),
							),
							array(
								array(
									'type'       => 'checkbox',
									'heading'    => esc_html__( 'Show number at icon', 'dfd' ),
									'param_name' => 'icon_number',
									'value'      => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
										'dependency' => array(
										'element' => 'style',
											'value_not_equal_to' => array( 'style-06' ),
									),
									'group'      => esc_attr__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'textfield',
									'heading'    => __( 'Number at icon', 'js_composer' ),
									'param_name' => 'icon_number_text',
									'group'      => esc_html__( 'Icon', 'dfd' ),
									'dependency' => array( 'element' => 'icon_number', 'value' => 'yes' ),
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__( 'Background', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'number_bg_color',
									'group'      => esc_html__( 'Icon', 'dfd' ),
									'dependency' => array( 'element' => 'icon_number', 'value' => 'yes' ),
								),
								array(
									'type'       => 'dropdown',
									'class'      => '',
									'heading'    => esc_html__( 'Icon to display:', 'dfd' ),
									'param_name' => 'icon_type',
									'value'      => array(
										esc_html__( 'Font Icon Manager', 'dfd' ) => 'selector',
										esc_html__( 'Custom Image Icon', 'dfd' ) => 'custom',
									),
									'group'      => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'             => 'number',
									'heading'          => esc_html__( 'Opacity', 'dfd' ) .' (0-100) %',
									'param_name'       => 'opacity',
									'min'              => '0',
									'max'              => '100',
									'value'            => '100',
									'edit_field_class' => 'vc_col-sm-6 vc_column crum_vc',
									'group'            => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'number',
									'heading'    => esc_html__( 'Size of Icon', 'dfd' ),
									'param_name' => 'icon_size',
									'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
									'min'        => 12,
									'group'      => esc_html__( 'Icon', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'class'      => 'crum_vc',
									'heading'    => esc_html__( 'Color', 'dfd' ),
									'param_name' => 'icon_color',
									'group'      => esc_html__( 'Icon', 'dfd' ),
									'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector' ) ),
								),
								array(
									'type'       => 'colorpicker',
									'class'      => 'crum_vc',
									'heading'    => esc_html__( 'Hover Color', 'dfd' ),
									'param_name' => 'icon_hover',
									'group'      => esc_html__( 'Icon', 'dfd' ),
									'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector' ) ),
								),

								array(
									'type'       => 'icon_manager',
									'class'      => '',
									'heading'    => esc_html__( 'Select Icon ', 'dfd' ),
									'param_name' => 'icon',
									'value'      => '',
									'group'      => esc_html__( 'Icon', 'dfd' ),
									'dependency' => array( 'element' => 'icon_type', 'value' => array( 'selector' ) ),
								),
								array(
									'type'        => 'attach_image',
									'class'       => '',
									'heading'     => esc_html__( 'Upload Image:', 'dfd' ),
									'param_name'  => 'icon_image_id',
									'admin_label' => true,
									'value'       => '',
									'group'       => esc_html__( 'Icon', 'dfd' ),
									'description' => esc_html__( 'Upload the custom image icon.', 'dfd' ),
									'dependency'  => Array( 'element' => 'icon_type', 'value' => array( 'custom' ) ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Will work if background available', 'dfd' ),
									'param_name'       => 'title_ibg',
									'group'         => esc_html__( 'Icon BG.', 'dfd' ),
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								),
								array(
									'type'       => 'number',
									'heading'    => esc_html__( 'Icon background size', 'dfd' ),
									'param_name' => 'icon_bg_size',
									'min'        => 0,
									'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'number',
									'heading'    => esc_html__( 'Border radius', 'dfd' ),
									'param_name' => 'border_radius',
									'min'        => 0,
									'edit_field_class' => 'vc_column vc_col-sm-6 crum-number-wrap crum_vc',
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__( 'Border', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'border_color',
									'dependency' => array(
										'element' => 'style',
										'value'   => array( 'style-03', 'style-04', 'style-05' ),
									),
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__( 'Hover', 'dfd' ) .' '.esc_html__( 'Border', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'hover_icon_border',
									'dependency' => array(
										'element' => 'style',
										'value'   => array( 'style-03', 'style-04', 'style-05' ),
									),
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'number',
									'heading'    => esc_html__( 'Border width', 'dfd' ),
									'param_name' => 'border_width',
									'min'        => 0,
									'suffix'     => 'px',
									'dependency' => array(
										'element' => 'style',
										'value'   => array( 'style-03', 'style-05' ),
									),
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__( 'Start', 'dfd' ) .' '. esc_html__( 'Background', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'fill_color_start',
									'edit_field_class' => 'vc_column vc_col-sm-6',
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__( 'End', 'dfd' ) .' '. esc_html__( 'Background', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'fill_color_end',
									'edit_field_class' => 'vc_column vc_col-sm-6',
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'       => 'colorpicker',
									'heading'    => esc_html__( 'Hover', 'dfd' ) .' '. esc_html__( 'Background', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
									'param_name' => 'hover_icon_bg',
									'edit_field_class' => 'vc_column vc_col-sm-12',
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
									'dependency' => array(
										'element' => 'style',
										'value_not_equal_to' => array( 'style-01', 'style-06' ),
									),
								),

								array(
									'type'       => 'attach_image',
									'class'      => '',
									'heading'    => esc_html__( 'Background', 'dfd' ) . ' ' . esc_html__( 'Image', 'crum' ),
									'param_name' => 'icon_bg_img',
									'dependency' => array(
										'element' => 'style',
										'value'   => array( 'style-05' ),
									),
									'group'      => esc_html__( 'Icon BG.', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Title', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
									'param_name'       => 'title_t_heading',
									'group'            => esc_attr__( 'Typography', 'dfd' ),
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								),
								array(
									'type'       => 'crumina_font_container',
									'heading'    => '',
									'param_name' => 'title_font_options',
									'settings'   => array(
										'fields' => array(
											'tag' => 'div',
											'letter_spacing',
											'font_size',
											'line_height',
											'color',
											'font_style'
										),
									),
									'group'      => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'        => 'checkbox',
									'heading'     => esc_html__( 'Use custom font family?', 'dfd' ),
									'param_name'  => 'use_google_fonts',
									'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
									'description' => esc_html__( 'Use font family from google.', 'dfd' ),
									'group'       => esc_attr__( 'Typography', 'dfd' ),
								),
								array(
									'type'       => 'google_fonts',
									'param_name' => 'custom_fonts',
									'value'      => '',
									'group'      => esc_attr__( 'Typography', 'dfd' ),
									'settings'   => array(
										'fields' => array(
											'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
											'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
										),
									),
									'dependency' => array(
										'element' => 'use_google_fonts',
										'value'   => 'yes',
									),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Subtitle', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
									'param_name'       => 'subtitle_t_heading',
									'group'            => esc_html__( 'Typography', 'dfd' ),
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								),
								array(
									'type'       => 'crumina_font_container',
									'heading'    => '',
									'param_name' => 'subtitle_font_options',
									'settings'   => array(
										'fields' => array(
											'tag' => 'div',
											'letter_spacing',
											'font_size',
											'line_height',
											'color',
											'font_style'
										),
									),
									'group'      => esc_html__( 'Typography', 'dfd' ),
								),
								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Content', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
									'param_name'       => 'content_t_heading',
									'group'            => esc_attr__( 'Typography', 'dfd' ),
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								),
								array(
									'type'       => 'crumina_font_container',
									'heading'    => '',
									'param_name' => 'font_options',
									'settings'   => array(
										'fields' => array(
											'tag' => 'div',
											'letter_spacing',
											'font_size',
											'line_height',
											'color',
											'font_style'
										),
									),
									'group'      => esc_attr__( 'Typography', 'dfd' ),
								),

								array(
									'type'             => 'ult_param_heading',
									'text'             => esc_html__( 'Delimiter options', 'dfd' ),
									'param_name'       => 'title_d_heading',
									'group'            => esc_attr__( 'Style', 'dfd' ),
									'class'            => 'ult-param-heading',
									'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
								),
							),
							$delim_options
						)
					)
				);
			}
		}

		function info_box_form( $atts, $content = null ) {

			$style = $layout = $title = $subtitle = $output = $hover_icon_bg = $hover_icon_border = $icon_hover = $bg_hover_style = $delimiter_styles = '';
			$more_show = $readmore_style = $readmore_text = $read_more = $link = $hover_animation = $el_class = $data_atts = '';
			$icon_number = $number_bg_color = $icon_number_text = $delimiter_style = $line_width = $line_border = $line_color = $line_hide = '';
			$title_font_options = $border_width = $subtitle_font_options = $font_options = $use_google_fonts = $custom_fonts = '';
			$icon_style = $border_radius = $border_color = $icon_bg_size = $fill_color_start = $fill_color_end = $icon_bg_img = $module_animation = '';
			$delimiter_style = $number_style = $delimiter_html = $read_more_html = $title_html = $subtitle_html = $content_html = $css = '';
			$link_atts_url = $link_atts_title = $link_atts_target = '';
			
			$atts = vc_map_get_attributes( 'dfd_info_box', $atts );
			extract( $atts );
			
			
			
//			extract( shortcode_atts( array(
//				'style'                 => 'style-01',
//				'layout'                => 'layout-01',
//				'title'                 => '',
//				'subtitle'              => '',
//
//				'link'                  => '',
//				'read_more'             => '',
//				'readmore_show'         => '',
//				'more_show'             => '',
//				'readmore_style'        => 'read-more-01',
//				'readmore_text'         => esc_html__( 'Read more', 'dfd' ),
//
//				'icon_number'           => '',
//				'icon_number_text'      => '',
//				'number_bg_color'       => '',
//				'icon_color'    => '',
//				'icon_hover'    => '',
//
//				'icon_bg_size'          => '',
//				'border_color'          => '',
//				'border_width'          => '',
//				'border_radius'         => '',
//				'hover_icon_border'     => '',
//
//				'fill_color_start'      => '',
//				'fill_color_end'        => '',
//				'hover_icon_bg'         => '',
//				'icon_bg_img'           => '',
//
//				'delimiter_style'       => '',
//				'line_width'            => '',
//				'line_border'           => '',
//				'line_color'            => '',
//				'line_hide'             => '',
//
//				'title_font_options'    => '',
//				'subtitle_font_options' => '',
//				'font_options'          => '',
//				'use_google_fonts'      => '',
//				'custom_fonts'          => '',
//
//				'hover_animation'      => '',
//				'module_animation'      => '',
//				'el_class'              => '',
//			), $atts ) );

			/**************************
			 * Appear Animation
			 *************************/

			$animation_data = '';
			$id = "idinfobox".uniqid();

			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr( $module_animation ) . '" ';
			}

			/**************************
			 * Hover styles.
			 *************************/
			if ( 'hover' === $more_show ) {
				$el_class .= ' more-hover';
			}
			if ( $hover_animation ) {
				$el_class .= ' ' . $hover_animation;
			}
			if ( $icon_hover ) {
				$el_class .= ' icon-color-change';
			}
			if ( $hover_icon_bg ) {
				$el_class .= ' icon-bg-change';
				$bg_hover_style .= 'style="';
				$bg_hover_style .= 'background:'.$hover_icon_bg.';';

				if ( $border_radius ) {
					if ( ( ( 'style-05' === $style ) && $border_width ) || ( ( 'style-03' === $style ) && $border_width ) ) {
						$bg_hover_style .= 'border-radius:' . ( $border_radius ) . 'px;';
					} elseif ( ( 'style-05' === $style ) || ( 'style-03' === $style ) ) {
						$bg_hover_style .= 'border-radius:' . ( $border_radius ) . 'px;';
					} elseif ( ( 'style-04' === $style )){
						$bg_hover_style .= 'border-radius:' . ( $border_radius-4 ) . 'px;';
					} else {
						$bg_hover_style .= 'border-radius:' . ($border_radius) . 'px;';
					}
				}
				$bg_hover_style .= '"';
			}
			if ( $hover_icon_border ) {
				$el_class .= ' icon-border-change';
				$data_atts .= ' data-hover-border="'.$hover_icon_border.'"';
			}

			/*********************
			 *   ICON HTML.
			 ********************/

			if ( $border_radius || $border_color || $border_width || $icon_bg_size || $fill_color_start || $fill_color_end || $icon_bg_img ) {

				$icon_style .= 'style="';
				if ( $border_radius ) {
					$icon_style .= 'border-radius:' . $border_radius . 'px;';
				}
				if ( $border_color ) {
					$icon_style .= 'color:' . $border_color . ';';
				}
				if ( ( ( 'style-05' === $style ) && $border_width ) || ( ( 'style-03' === $style ) && $border_width ) ) {
					$icon_style .= 'border-width: ' . $border_width . 'px;';
					$css .= '#'.$id.' .module-icon:before{border-width: ' . $border_width . 'px !important;}';
				}

				if ( $icon_bg_size ) {
					$icon_style .= 'font-size:' . $icon_bg_size . 'px;';
				}
				if ( ( 'style-05' === $style ) && $icon_bg_img ) {
					$icon_bg_img = wp_get_attachment_image_src( $icon_bg_img, 'full' );
					$icon_style .= 'background-image:url(' . $icon_bg_img[0] . ');';
				}
				if ( $fill_color_end && $fill_color_start ) {
					$icon_style .= 'background: linear-gradient(to right, ' . $fill_color_start . ' 0%,' . $fill_color_end . ' 100%); ';
				} elseif ( $fill_color_start ) {
					$icon_style .= 'background-color:' . $fill_color_start . '; ';
				} elseif ( $fill_color_end ) {
					$icon_style .= 'background-color:' . $fill_color_end . '; ';
				}
				$icon_style .= '"';
			}
			
			$link = vc_build_link( $link );
			if(isset($link['url']) && !empty($link['url'])) {
				$link_atts_url = 'href="'.esc_url($link['url']).'"';
			}
			if(isset($link['title']) && !empty($link['title'])) {
				$link_atts_title = 'title="'.esc_attr($link['title']).'"';
			}
			if(isset($link['target']) && !empty($link['target'])) {
				$link_atts_target = 'target="'.esc_attr($link['target']).'"';
			}
			
			$icon_html = '<div class="icon-wrapper">';
			$icon_html .= '<div class="module-icon" ' . $icon_style . ' ' . $data_atts . '>';
			$icon_html .= '<div class="hover-layer" '.$bg_hover_style.'></div>';

			$icon_html .= crumina_icon_render( $atts );

			//number at icon
			if ( 'yes' === $icon_number && ! empty( $icon_number_text ) ) {
				if ( $number_bg_color ) {
					$number_style = 'style="background-color:' . $number_bg_color . '"';
				}
				$icon_html .= '<div class="info-box-icon-text" ' . $number_style . '>' . $icon_number_text . '</div>';
			}
			$icon_html .= '</div>';

			$icon_html .= '</div>';

			/**************************
			 * Title / Subtitle HTML.
			 *************************/
			if ( ! empty( $title ) ) {
				// Title name HTML.
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts  );
				if ( $link && 'title' === $read_more ) {
//					$link = vc_build_link( $link );
					$title_html .= '<'.$title_options['tag'].' class="info-box-title ' . $title_options['class'] . '" ' . $title_options['style'] . '><a '.$link_atts_url.' '.$link_atts_title.' '.$link_atts_target.'>' . esc_html( $title ) . '</a></'.$title_options['tag'].'>';
				} else {
					$title_html .= '<'.$title_options['tag'].' class="info-box-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . esc_html( $title ) . '</'.$title_options['tag'].'>';
				}

			}

			// Subtitle HTML.
			if ( ! empty( $subtitle ) ) {
				$subtitle_options = _crum_parse_text_shortcode_params( $subtitle_font_options, 'subtitle' );
				$subtitle_html .= '<'.$subtitle_options['tag'].' class="info-box-subtitle ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html( $subtitle ) . '</'.$subtitle_options['tag'].'>';
			}

			/**************************
			 * Delimiter HTML.
			 *************************/

			if ( $line_width || $line_border || $line_color || $delimiter_style ) {
				$delimiter_styles = 'style="';
				if ( $line_width ) {
					$delimiter_styles .= 'width:' . $line_width . 'px;';
				}
				if ( $line_border ) {
					$delimiter_styles .= 'border-width:' . $line_border . 'px;';
				}
				if ( $line_color ) {
					$delimiter_styles .= 'border-color:' . $line_color.';';
				}
				if ( ! empty( $delimiter_style ) ) {
					$delimiter_styles .= 'border-bottom-style:' . $delimiter_style;
				}
				$delimiter_styles .= '"';
			}
			if ( 'yes' !== $line_hide ) {
				$delimiter_html .= '<div class="wrap-delimiter"><div class="delimiter" ' . $delimiter_styles . '></div></div>';
			}

			/**************************
			 * Content HTML.
			 *************************/
			$content_font_options = _crum_parse_text_shortcode_params( $font_options, '');
			$content_style        = $content_font_options['style'];
			$content_html .= '<div class="description" ' . $content_style . '>' . $content . '</div>';


			/**************************
			 * Read More button.
			 *************************/
			if ( isset( $readmore_show ) && 'yes' === $readmore_show ) {
				if ( $link && 'more' === $read_more ) {
//					$link = vc_build_link( $link );
					$more_open = '<div><div class="dfd-module-readmore"><a '.$link_atts_url.' '.$link_atts_title.' '.$link_atts_target.' class="' . $readmore_style . '">';
					$more_close = '</a></div></div>';
				} else {
					$more_open = '<div><div class="dfd-module-readmore"><span class="' . $readmore_style . '">';
					$more_close = '</span></div></div>';
				}
				if ( 'read-more-01' === $readmore_style ) {
					$read_more_html .= $more_open . $readmore_text . $more_close;
				} elseif ( 'read-more-02' === $readmore_style || 'read-more-03' === $readmore_style || 'read-more-04' === $readmore_style ) {
					$read_more_html .= $more_open . '<span></span><span></span><span></span>' . $more_close;
				} elseif ( 'read-more-05' === $readmore_style ) {
					$read_more_html .= $more_open . '<i class="dfd-icon-down_right"></i><span>' . $readmore_text . '</span><i class="dfd-icon-down_right"></i>' . $more_close;
				} elseif ( 'read-more-06' === $readmore_style ) {
					$read_more_html .= $more_open . '<i class="dfd-icon-down_right"></i>' . $more_close;
				} elseif ( 'read-more-07' === $readmore_style ) {
					$read_more_html .= $more_open . '<i class="dfd-added-font-icon-right-open"></i>' . $more_close;
				} else {
					$read_more_html .= $more_open . $readmore_text . $more_close;
				}

			}

			/**************************
			 * Module output.
			 *************************/

			if ( 'style-06' === $style ) {
				$layout = 'layout-01';
			}

			$output .= '<div id="'.$id.'" class="dfd-info-box ' . $style . ' ' . $layout . ' ' . $el_class . '" '.$animation_data.'>';

			switch ( $layout ) {
				case 'layout-01':
					$output .= $icon_html;
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					$output .= $content_html;
					$output .= $read_more_html;
					break;

				case 'layout-02':
					$output .= $content_html;
					$output .= $delimiter_html;
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $icon_html;
					$output .= $read_more_html;
					break;

				case 'layout-03':
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					$output .= $icon_html;
					$output .= $content_html;
					$output .= $read_more_html;
					break;

				case 'layout-04':
				case 'layout-05':

					$output .= $icon_html;
					$output .= '<div class="content-wrap ovh">';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					$output .= $content_html;
					$output .= $read_more_html;
					$output .= '</div>';
					break;

				case 'layout-06':
				case 'layout-07':

					$output .= $icon_html;
					$output .= '<div class="content-wrap ovh">';
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					$output .= '</div>';
					$output .= '<div class="clear ovh">';
					$output .= $content_html;
					$output .= $read_more_html;
					$output .= '</div>';
					break;

				default:

					$output .= $icon_html;
					$output .= $title_html;
					$output .= $subtitle_html;
					$output .= $delimiter_html;
					$output .= $content_html;
					$output .= $read_more_html;
			}

			if ( $link && 'box' === $read_more ) {
//				$link = vc_build_link( $link );
				$output .= '<a '.$link_atts_url.' '.$link_atts_title.' '.$link_atts_target.' class="full-box-link"></a>';
			}
			ob_start();
			?>
				<script>
					(function($){
						$(".dfd-icon-bar_graph_growth").each(function(){
							var self = $(this);
							var  $hover = $(this).data("hover");
							$(this).hover(function(){
								self.css("color",$hover);
							});
						});
						$('head').append('<style type="text/css"> <?php echo esc_js($css); ?></style>');
					})(jQuery)
				</script>
			<?php
			$output .= ob_get_clean();

			$output .= '</div>';
			return $output;
		}
	}
}

if ( class_exists( 'Dfd_Info_Box' ) ) {
	$Dfd_Info_Box = new Dfd_Info_Box;
}
