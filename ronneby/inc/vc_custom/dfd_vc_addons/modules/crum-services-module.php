<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( ! class_exists( 'Dfd_Serveces_New' ) ) {
	class Dfd_Serveces_New {
		
		var $vertical_content_offset;
		
		function __construct() {
			
			$this->vertical_content_offset = '';
			
			add_action( 'init', array( &$this, 'dfd_new_service_init' ) );
			add_shortcode( 'dfd_service_new', array( &$this, 'dfd_service_new_form' ) );
			add_shortcode( 'dfd_service_item_2', array( &$this, 'dfd_service_new_item_form' ) );
		}

		function dfd_new_service_init() {
			if ( function_exists( 'vc_map' ) ) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/service_item/';
				//Dfd_service_new
				vc_map(
					array(
						'name'                    => esc_html__( 'Services', 'dfd' ). ' 2',
						'base'                    => 'dfd_service_new',
						'class'                   => 'vc_info_list',
						'icon'                    => 'vc_icon_list',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'as_parent'               => array( 'only' => 'dfd_service_item_2' ),
						'description'             => esc_html__( 'Text blocks connected together in one list.', 'dfd' ),
						'content_element'         => true,
						'show_settings_on_create' => true,
						'params'                  => array(
							array(
								'type'        => 'dropdown',
								'heading'     => esc_html__( 'Columns width', 'dfd' ),
								'param_name'  => 'columns_width',
								'value'       => array(
									esc_html__( 'Inherit from container', 'dfd' ) => 'full-width-elements',
									esc_html__( 'Half size', 'dfd' )              => 'half-size-elements',
									esc_html__( '1/3 of container width', 'dfd' ) => 'one-third-width-elements',
									esc_html__( '1/4 of container width', 'dfd' ) => 'quarter-width-elements',
									esc_html__( '1/5 of container width', 'dfd' ) => 'fifth-width-elements',
									esc_html__( '1/6 of container width', 'dfd' ) => 'sixth-width-elements',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'description' => esc_html__( 'Please select width of the elements', 'dfd' ),
							),
							array(
								'type' => 'number',
								'heading' => esc_html__('Vertical content offset', 'dfd'),
								'param_name' => 'vertical_content_offset',
								'value' => '',
								//'min' => 0,
								//'max' => 700,
								'edit_field_class' => 'vc_column no-top-padding vc_col-sm-4 crum-number-wrap crum_vc',
								'description' => esc_html__('Enter value in pixels.', 'dfd')
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => esc_html__( 'Border Style', 'dfd' ),
								'param_name'  => 'connector_style',
								'value'       => array(
									esc_html__( 'None', 'dfd' )   => 'none',
									esc_html__( 'Solid', 'dfd' )  => 'solid',
									esc_html__( 'Dashed', 'dfd' ) => 'dashed',
									esc_html__( 'Dotted', 'dfd' ) => 'dotted',
									esc_html__( 'Double', 'dfd' ) => 'double',
									esc_html__( 'Inset', 'dfd' )  => 'inset',
									esc_html__( 'Outset', 'dfd' ) => 'outset',
								),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'description' => esc_html__( 'Select the border style for icon.', 'dfd' ),
							),
							array(
								'type'        => 'colorpicker',
								'class'       => '',
								'heading'     => esc_html__( 'Border Color', 'dfd' ),
								'param_name'  => 'connector_color',
								'value'       => '',
								'description' => esc_html__( 'Select the color for connector line.', 'dfd' ),
								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
								'dependency' => array('element' => 'connector_style', 'value' => array('solid', 'dashed', 'dotted', 'double', 'inset', 'outset'))
							),
//							array(
//								'type'        => 'dropdown',
//								'class'       => '',
//								'heading'     => esc_html__( 'Content aligment', 'dfd' ),
//								'param_name'  => 'content_aligment',
//								'value'       => array(
//									esc_html__( 'Left', 'dfd' )  => 'text-left',
//									esc_html__( 'Center', 'dfd' )   => 'text-center',
//									esc_html__( 'Right', 'dfd' ) => 'text-right',
//								),
//								'edit_field_class' => 'vc_column vc_col-sm-6 crum_vc',
//							),
							// Customize everything
							array(
								'type'        => 'textfield',
								'class'       => '',
								'heading'     => esc_html__( 'Extra Class', 'dfd' ),
								'param_name'  => 'el_class',
								'value'       => '',
								'description' => esc_html__( 'Add extra class name that will be applied to the info list, and you can use this class for your customizations.', 'dfd' ),
							),
						),
						'js_view'                 => 'VcColumnView'
					) );
				//dfd_service_item_2
				vc_map( array(
					'name'        => esc_html__( 'Service item', 'dfd' ).' 2',
					'base'        => 'dfd_service_item_2',
					'class'       => 'vc_info_list',
					'icon'        => 'vc_info_list',
					"as_child"        => array( 'only' => 'dfd_service_new' ),
					'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
					'description' => esc_html__( 'Info Box with appear text', 'dfd' ),
					'params'      => array_merge(
						array(
							array(
								'heading'     => esc_html__( 'Style', 'dfd' ),
								'description' => '',
								'type'        => 'radio_image_select',
								'param_name'  => 'style',
								'simple_mode'		=> false,
								'options'     => array(
									'style-01'	=> array(
										'tooltip'	=> esc_attr__('Simple','dfd'),
										'src'		=> $module_images . 'style-01.png'
									),
									'style-02'	=> array(
										'tooltip'	=> esc_attr__('Backround','dfd'),
										'src'		=> $module_images . 'style-02.png'
									),
									'style-03'	=> array(
										'tooltip'	=> esc_attr__('Bordered','dfd'),
										'src'		=> $module_images . 'style-03.png'
									),
									'style-04'	=> array(
										'tooltip'	=> esc_attr__('Overlay','dfd'),
										'src'		=> $module_images . 'style-04.png'
									),
								),
							),
							array(
								'heading'     => esc_html__( 'Hover', 'dfd' ).' '.esc_html__( 'Style', 'dfd' ),
								'description' => '',
								'type'        => 'radio_image_select',
								'param_name'  => 'hover',
								'simple_mode'		=> false,
								'options'     => array(
									'hover-01'	=> array(
										'tooltip'	=> esc_attr__('Slide left','dfd'),
										'src'		=> $module_images . 'hover-01.png'
									),
									'hover-02'	=> array(
										'tooltip'	=> esc_attr__('Slide top','dfd'),
										'src'		=> $module_images . 'hover-02.png'
									),
									'hover-03'	=> array(
										'tooltip'	=> esc_attr__('Slide bottom','dfd'),
										'src'		=> $module_images . 'hover-03.png'
									),
									'hover-04'	=> array(
										'tooltip'	=> esc_attr__('Slide right','dfd'),
										'src'		=> $module_images . 'hover-04.png'
									),
									'hover-05'	=> array(
										'tooltip'	=> esc_attr__('Slide in','dfd'),
										'src'		=> $module_images . 'hover-05.png'
									),
								),
							),
							array(
								'type' => 'number',
								'heading' => esc_html__('Block min height', 'dfd'),
								'param_name' => 'block_min_height',
								'value' => '',
								'min' => 0,
								'max' => 700,
								'edit_field_class' => 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
								'description' => esc_html__('Enter value in pixels.', 'dfd')
							),
							array(
								'type'				=> 'ult_switch',
								'heading'			=> esc_html__( 'Apply link', 'dfd' ),
								'param_name'		=> 'dfd_service_link_apply',
								'value'				=> '',
								'edit_field_class'	=> 'vc_column vc_col-sm-4',
								'options'			=> array(
									'apply_link'		=> array(
										'on'				=> esc_html__( 'Yes', 'dfd' ),
										'off'				=> esc_html__( 'No', 'dfd' ),
									),
								),
							),
							array(
								'type' => 'vc_link',
								'heading' => esc_html__('Link', 'dfd'),
								'param_name' => 'dfd_service_link',
								'edit_field_class'	=> 'vc_column vc_col-sm-4',
								'dependency' => array('element' => 'dfd_service_link_apply', 'value' => array('apply_link'))
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
								'heading'     => esc_html__( 'Extra class name', 'js_composer' ),
								'param_name'  => 'el_class',
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
							),
							array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Title', 'dfd' ),
								'param_name'  => 'title',
								'admin_label' => true,
								'group'       => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'        => 'textfield',
								'heading'     => esc_html__( 'Subtitle', 'dfd' ),
								'param_name'  => 'subtitle',
								'admin_label' => true,
								'group'       => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'textarea_html',
								'class' => '',
								'heading' => esc_html__('Description','dfd'),
								'param_name' => 'content',
								'group'       => esc_html__( 'Content', 'dfd' ),
							),
						),
						_crum_vc_icon_settings(),
						array(
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
								'heading'    => esc_html__( 'Border', 'dfd' ) . ' ' . esc_html__( 'Color', 'dfd' ),
								'param_name' => 'border_color',
								'dependency' => array(
									'element' => 'style',
									'value'   => array( 'style-03'),
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
									'value'   => array( 'style-03' ),
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
								'type' => 'colorpicker',
								'param_name' => 'desc_background',
								'heading' => esc_attr__('Description background', 'dfd'),
								'group'      => esc_attr__( 'Typography', 'dfd' ),
							),
						)
					),
				) );
			}//endif
		}

		function dfd_service_new_form($atts, $content = null){
			$columns_width = $connector_color = $connector_style = $el_class = $output = $service_block_style = $content_aligment = $vertical_content_offset = '';
			
			$atts = vc_map_get_attributes( 'dfd_service_new', $atts );
			extract( $atts );

			$this->vertical_content_offset = $vertical_content_offset;

			$output .= '<div class="dfd-service-module-wrap ' . esc_attr( $el_class ) . '">';
			$output .= '<ul class="dfd-service-list dfd-mobile-keep-height clearfix ' . esc_attr( $columns_width ) . '">';

			preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches );
			
			if(isset($connector_style) && strcmp($connector_style, 'none') !== 0) {
				$service_block_style .= 'style="';
				$service_block_style .= 'border-style: '.esc_attr($connector_style).'; ';
				if (isset($connector_color) && !empty($connector_color)) {
					$service_block_style .= 'border-color: '.esc_attr($connector_color).'; ';
				}
				$service_block_style .= '"';
			}

			if ( isset($matches[0]) && is_array($matches[0]) ) {
				foreach ( $matches[0] as $single_shortcode ) {
					$output .= '<li class="dfd-service-item '.  esc_attr($content_aligment).'" '.$service_block_style.'>';
					$output .= do_shortcode( $single_shortcode );
					$output .= '</li>';
				}
			}

			$output .= '</ul>';
			
			$output .= '<script type="text/javascript">
							(function($) {
								$(document).ready(function() {
									$(".dfd-service-module-wrap").each(function(){
										$(this).find(".dfd-equalize-height").equalHeights();
									});
								});
							})(jQuery);
						</script>';

			$output .= '</div>';

			return $output;
		}

		function dfd_service_new_item_form($atts, $content = null){

			$style = $hover = $title = $subtitle = $border_color = $border_width = $icon_bg_size = $border_radius = $fill_color_start = $block_min_height = $fill_color_end = '';
			$desc_background = $output = $el_class = $module_animation = $front_css = $dfd_service_link_apply = $dfd_service_link = $content_html = $link_html = '';
			$title_html = $title_font_options = $subtitle_html = $subtitle_font_options = $icon_style = $font_options = $use_google_fonts = $custom_fonts = $icon_html = '';
			$vertical_content_offset = $link_css = $desc_background_css = '';

			$atts = vc_map_get_attributes( 'dfd_service_item_2', $atts );
			extract( $atts );
			
			if(empty($vertical_content_offset)) {
				$vertical_content_offset = $this->vertical_content_offset;
			}

			/**************************
			 * Appear Animation
			 *************************/

			$animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$el_class       .= ' cr-animate-gen ';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}

			/**************************
			 * Custom link
			 *************************/

			if (isset($dfd_service_link_apply) &&  strcmp($dfd_service_link_apply, 'apply_link') === 0) {
				$link = vc_build_link($dfd_service_link);
				$link_title = !empty($link['title']) ? 'title="'.esc_attr($link['title']).'"' : '';
				$link_target = !empty($link['target']) ? 'target="'.esc_attr(preg_replace('/\s+/', '', $link['target'])).'"' : '';
				$link_html = '<a href="' . $link['url'] . '" class="abs-link" ' . $link_title . ' ' . $link_target . '></a>';
			} else {
				$link = array('url'=>'');
				$link_title = $link_target = '';
			}

			/**************************
			 * Title / Subtitle HTML.
			 *************************/
			if ( ! empty( $title ) ) {
				$title = esc_html( $title );
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'feature-title', $use_google_fonts, $custom_fonts );
				$title_html .= '<' . $title_options['tag'] . ' class="info-banner-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . $title . '</' . $title_options['tag'] . '>';
			}

			// Subtitle HTML.
			if ( ! empty( $subtitle ) ) {
				$subtitle_options = _crum_parse_text_shortcode_params( $subtitle_font_options, 'subtitle' );
				$subtitle_html .= '<' . $subtitle_options['tag'] . ' class="info-banner-subtitle ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html( $subtitle ) . '</' . $subtitle_options['tag'] . '>';
			}

			/*********************
			 *   ICON HTML.
			 ********************/

			if ( $border_radius || $border_color || $border_width || $icon_bg_size || $fill_color_start || $fill_color_end ) {

				$icon_style .= 'style="';
				if ( $border_radius ) {
					$icon_style .= 'border-radius:' . $border_radius . 'px;';
				}
				if ( $border_color ) {
					$icon_style .= 'border-color:' . $border_color . ';';
				}
				if ( ( ( 'style-05' === $style ) && $border_width ) || ( ( 'style-03' === $style ) && $border_width ) ) {
					$icon_style .= 'border-width:' . $border_width . 'px;';
				}

				if ( $icon_bg_size ) {
					$icon_style .= 'font-size:' . $icon_bg_size . 'px;';
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

			$icon_html .= '<div class="module-icon"' . $icon_style . '>';
			$icon_html .= crumina_icon_render( $atts );
			$icon_html .= $link_html;
			$icon_html .= '</div>';

			/**************************
			 * Content HTML.
			 *************************/
			$content_font_options = _crum_parse_text_shortcode_params( $font_options );
			$content_style        = $content_font_options['style'];
			$content_html .= '<div class="description" ' . $content_style . '>' . wpb_js_remove_wpautop($content, true) . '</div>';

			/**************************
			 * Module Generation.
			 *************************/
			$desc_background_css .= 'style="';
			$front_css .= 'style="';
			if (!empty( $desc_background)) {
				$desc_background_css .= 'background:'.esc_attr($desc_background).'; ';
			}
			if($block_min_height != '') {
				$front_css .= 'min-height: '.esc_attr($block_min_height).'px; ';
			}
			
			if($vertical_content_offset) {
				$desc_background_css .= 'padding: '.esc_attr($vertical_content_offset).'px 50px; ';
				$front_css .= 'padding: '.esc_attr($vertical_content_offset).'px 50px; ';
			}
			$front_css .= '"';
			$desc_background_css .= '"';

			$output .= '<div class="dfd-service-item ' . $style . '  ' . $hover . ' ' . $el_class . '" ' . $animation_data . '>';
			$output .= '<div class="dfd-service-front dfd-equalize-height" '.$front_css.'>';
			$output .= $icon_html;
			$output .= '<div class="content-wrapper">';
			$output .= $title_html;
			$output .= $subtitle_html;
			$output .= '</div>';
			$output .= '</div>';
			$output .= '<div class="dfd-service-description dfd-service-back dfd-equalize-height" '.$desc_background_css.'>';
			$output .= $content_html;
			$output .= '</div>';
			$output .= $link_html;
			$output .= '</div>';
			
			return $output;
		}
	}
}
global $Dfd_Services_Module;
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

	class WPBakeryShortCode_Dfd_Service_New extends WPBakeryShortCodesContainer {
	}

	class WPBakeryShortCode_Dfd_Service_Item_2 extends WPBakeryShortCode {
	}

}
if ( class_exists( 'Dfd_Serveces_New' ) ) {
	$Dfd_Serveces_New = new Dfd_Serveces_New;
}