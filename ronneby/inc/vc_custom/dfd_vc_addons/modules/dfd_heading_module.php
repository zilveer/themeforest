<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Heading
*/

if ( ! class_exists( 'Dfd_Heading' ) ) {

	class Dfd_Heading {
		
		var $admin_src = 'inc/vc_custom/dfd_vc_addons/admin/img/heading/';
		var $front_template = 'inc/vc_custom/dfd_vc_addons/templates/heading/';

		function __construct() {
			add_action( 'init', array( &$this, 'dfd_heading_init' ) );
			add_shortcode( 'dfd_heading', array( &$this, 'dfd_heading_shortcode' ) );
		}
		
		function dfd_heading_init() {

			if ( function_exists( 'vc_map' ) ) {
				$tooltips = array(
					'style_01' =>	esc_attr__('Standard title top','dfd'),
					'style_02' =>	esc_attr__('Standard title bottom','dfd'),
					'style_03' =>	esc_attr__('Reversed title bottom','dfd'),
					'style_04' =>	esc_attr__('Reversed title top','dfd'),
					'style_05' =>	esc_attr__('Classic title top','dfd'),
					'style_06' =>	esc_attr__('Classic title bottom','dfd'),
					'style_07' =>	esc_attr__('Left title top','dfd'),
					'style_08' =>	esc_attr__('Left title bottom','dfd'),
					'style_09' =>	esc_attr__('Right title top','dfd'),
					'style_10' =>	esc_attr__('Right title bottom','dfd'),
					'style_11' =>	esc_attr__('Middle title top','dfd'),
					'style_12' =>	esc_attr__('Middle title bottom','dfd'),
					'style_13' =>	esc_attr__('Bottom front title','dfd'),
					'style_14' =>	esc_attr__('Top front title','dfd'),
				);
				
				vc_map(
					array(
						'name'        => esc_html__( 'Heading', 'dfd' ),
						'base'        => 'dfd_heading',
						'icon'        => 'vc_ultimate_heading',
						'class'       => 'vc_ultimate_heading',
						'category'    => esc_html__( 'Ronneby 2.0', 'dfd' ),
						'description' => esc_html__( 'Heading module', 'dfd' ),
						'params'      => array(
							array(
								'heading'     => esc_html__( 'Style', 'dfd' ),
								'description' => '',
								'type'        => 'radio_image_select',
								'param_name'  => 'style',
								'simple_mode' => false,
								'options'     => dfd_build_shortcode_style_param($this->admin_src, $this->front_template, false, $tooltips),
							),
							array(
								'type'        => 'dropdown',
								'class'       => '',
								'heading'     => esc_html__( 'Animation', 'dfd' ),
								'param_name'  => 'module_animation',
								'value'       => dfd_module_animation_styles(),
							),
							array(
								'type'        => 'textfield',
								'heading'     => __( 'Extra class name', 'js_composer' ),
								'param_name'  => 'el_class',
								'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
							),
							array(
								'type'        => 'textarea_html',
								'heading'     => esc_html__( 'Title', 'dfd' ),
								'param_name'  => 'content',
								'admin_label' => true,
								'group'       => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ultimate_margins',
								'heading' => esc_html__('Title Margins', 'dfd'),
								'param_name' => 'heading_margin',
								'positions' => array(
									esc_html__('Top','dfd') => 'top',
									esc_html__('Bottom','dfd') => 'bottom'
								),
								//'dependency' => Array('element' => 'title', 'not_empty' => true),
								'group'      => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Subtitle', 'dfd' ),
								'param_name' => 'subtitle',
								'admin_label' => true,
								'group'      => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'ultimate_margins',
								'heading' => esc_html__('Subtitle Margins', 'dfd'),
								'param_name' => 'subheading_margin',
								'positions' => array(
									esc_html__('Top','dfd') => 'top',
									esc_html__('Bottom','dfd') => 'bottom'
								),
								'dependency' => Array('element' => 'subtitle', 'not_empty' => true),
								'group'      => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Content alignment','dfd'),
								'param_name' => 'content_alignment',
								'value' => array(
									esc_html__('Center','dfd') => 'text-center',
									esc_html__('Left','dfd') => 'text-left',
									esc_html__('Right','dfd') => 'text-right'
								),
								'group'      => esc_html__( 'Content', 'dfd' ),
							),
							array(
								'type'        => 'ult_switch',
								'heading'     => esc_html__( 'Enable delimiter', 'dfd' ),
								'param_name'  => 'enable_delimiter',
								'value' => 'yes',
								'options' => array(
									'yes' => array(
											'label' => esc_html__('Yes, please','dfd'),
											'on' => 'Yes',
											'off' => 'No',
										),
									),
								/*
								'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								*/
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__('Delimiter style','dfd'),
								'param_name' => 'delimiter_style',
								'value' => array(
										esc_attr__('Line', 'dfd') => 'line',
										esc_attr__('Icon', 'dfd') => 'icon',
										esc_attr__('Image', 'dfd') => 'image',
									),
								'dependency' => Array('element' => 'enable_delimiter','value' => 'yes'),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'dfd_delimiter',
								'heading' => __('Delimiter settings','dfd'),
								'param_name' => 'delimiter_settings',
								'edit_field_class' => 'dfd_vc_heading_delimiter vc_col-xs-12 vc_column',
								'unit'     => 'px',
								'positions' => array(
									esc_attr__('Height','dfd')     => 'border-bottom-width',
									esc_attr__('Width','dfd')     => 'width',
								),
								'enable_radius' => false,
								'label_color'   => esc_html__('Delimiter Color','dfd'),
								'label_width'  => esc_html__('Delimiter height/width','dfd'),
								'label_border'  => esc_html__('Delimiter style','dfd'),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
								'dependency' => Array('element' => 'delimiter_style','value' => 'line'),
								'value'       => 'border-bottom-style:solid;|border-bottom-width:1px;|width:100px;|border-bottom-color:#dddddd;',
							),
							/* icon delimiter */
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Icon to display:', 'dfd'),
								'param_name' => 'icon_type',
								'value' => array(
									esc_attr__('Font Icon Manager', 'dfd') => 'selector',
									esc_attr__('Custom Image Icon','dfd') => 'custom',
								),
								'dependency' => Array('element' => 'delimiter_style', 'value' => array('icon')),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'icon_manager',
								'class' => '',
								'heading' => esc_html__('Select Icon ','dfd'),
								'param_name' => 'icon',
								'value' => '',
								'dependency' => Array('element' => 'icon_type','value' => array('selector')),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Icon size', 'dfd'),
								'param_name' => 'icon_size',
								'value' => 32,
								'min' => 12,
								'max' => 72,
								'suffix' => 'px',
								'dependency' => Array('element' => 'icon_type','value' => array('selector')),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => esc_html__('Color', 'dfd'),
								'param_name' => 'icon_color',
								'value' => '',
								'dependency' => Array('element' => 'icon_type','value' => array('selector')),						
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Icon Style', 'dfd'),
								'param_name' => 'icon_style',
								'value' => array(
									esc_attr__('Simple','dfd') => 'none',
									esc_attr__('Circle Background','dfd') => 'circle',
									esc_attr__('Square Background','dfd') => 'square',
									esc_attr__('Design your own','dfd') => 'advanced',
								),
								'description' => esc_html__('We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.', 'dfd'),
								'dependency' => Array('element' => 'icon_type','value' => array('selector')),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => esc_html__('Background Color', 'dfd'),
								'param_name' => 'icon_color_bg',
								'value' => '',
								'dependency' => Array('element' => 'icon_style', 'value' => array('circle','square','advanced')),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => esc_html__('Icon Border Style', 'dfd'),
								'param_name' => 'icon_border_style',
								'value' => array(
									esc_attr__('None','dfd') => '',
									esc_attr__('Solid','dfd') => 'solid',
									esc_attr__('Dashed','dfd') => 'dashed',
									esc_attr__('Dotted','dfd') => 'dotted',
									esc_attr__('Double','dfd') => 'double',
									esc_attr__('Inset','dfd') => 'inset',
									esc_attr__('Outset','dfd') => 'outset',
								),
								'dependency' => Array('element' => 'icon_style', 'value' => array('advanced')),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => esc_html__('Border Color', 'dfd'),
								'param_name' => 'icon_color_border',
								'value' => '',
								'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Border Width', 'dfd'),
								'param_name' => 'icon_border_size',
								'value' => 1,
								'min' => 1,
								'max' => 10,
								'suffix' => 'px',
								'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Border Radius', 'dfd'),
								'param_name' => 'icon_border_radius',
								'value' => '',
								'min' => 1,
								'max' => 500,
								'suffix' => 'px',
								'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Background Size', 'dfd'),
								'param_name' => 'icon_border_spacing',
								'value' => 50,
								'min' => 30,
								'max' => 500,
								'suffix' => 'px',
								'dependency' => Array('element' => 'icon_style', 'value' => array('advanced')),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'attach_image',
								'class' => '',
								'heading' => esc_html__('Upload Image Icon:', 'dfd'),
								'param_name' => 'icon_img',
								'value' => '',
								'dependency' => Array('element' => 'icon_type','value' => array('custom')),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'number',
								'class' => '',
								'heading' => esc_html__('Image Width', 'dfd'),
								'param_name' => 'img_width',
								'value' => 48,
								'min' => 16,
								'max' => 512,
								'suffix' => 'px',
								'dependency' => Array('element' => 'icon_type','value' => array('custom')),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							/* image delimiter */
							array(
								'type' => 'attach_image',
								'class' => '',
								'heading' => __('Delimiter Image','dfd'),
								'param_name' => 'delimiter_image',
								'value' => '',
								'dependency' => Array('element' => 'delimiter_style', 'value' => array('image')),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type' => 'ultimate_margins',
								'heading' => esc_html__('Delimiter Margins', 'dfd'),
								'param_name' => 'delimiter_margin',
								'positions' => array(
									esc_html__('Top','dfd') => 'top',
									esc_html__('Bottom','dfd') => 'bottom'
								),
								'value'       => 'margin-top:10px;margin-bottom:10px;',
								'dependency' => Array('element' => 'enable_delimiter','value' => 'yes'),
								'group'      => esc_html__( 'Delimiter', 'dfd' ),
							),
							array(
								'type'             => 'ult_param_heading',
								'text'             => esc_html__( 'Title', 'dfd' ) . ' ' . esc_attr__( 'Typography', 'dfd' ),
								'param_name'       => 'title_t_heading',
								'group'            => esc_attr__( 'Typography', 'dfd' ),
								'class'            => 'ult-param-heading',
							),
							array(
								'type'       => 'crumina_font_container',
								'heading'    => '',
								'param_name' => 'title_font_options',
								'settings'   => array(
									'fields' => array(
										'tag' => 'h5',
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
								'param_name'  => 'title_google_fonts',
								'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								'description' => esc_html__( 'Use font family from google.', 'dfd' ),
								'group'       => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'title_custom_fonts',
								'value'      => '',
								'group'      => esc_attr__( 'Typography', 'dfd' ),
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
										'tag' => 'h3',
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
								'type'        => 'checkbox',
								'heading'     => esc_html__( 'Use custom font family?', 'dfd' ),
								'param_name'  => 'subtitle_google_fonts',
								'value'       => array( esc_html__( 'Yes', 'dfd' ) => 'yes' ),
								'description' => esc_html__( 'Use font family from google.', 'dfd' ),
								'group'       => esc_attr__( 'Typography', 'dfd' ),
							),
							array(
								'type'       => 'google_fonts',
								'param_name' => 'subtitle_custom_fonts',
								'value'      => '',
								'group'      => esc_attr__( 'Typography', 'dfd' ),
								'settings'   => array(
									'fields' => array(
										'font_family_description' => esc_html__( 'Select font family.', 'dfd' ),
										'font_style_description'  => esc_html__( 'Select font styling.', 'dfd' ),
									),
								),
								'dependency' => array(
									'element' => 'subtitle_google_fonts',
									'value'   => 'yes',
								),
							),
						)
					)
				);
			}
		}

		function dfd_heading_shortcode( $atts, $content = null ) {
			$output = $title_html = $subtitle_html = $delimiter_html = $module_css = '';
			$style = $subtitle = $enable_delimiter = $delimiter_settings = $title_font_options = $title_google_fonts = $title_custom_fonts = $subtitle_font_options = '';
			$subtitle_google_fonts = $subtitle_custom_fonts = $module_animation = $el_class = $content_alignment = $heading_margin = $subheading_margin = '';
			$delimiter_margin = $delimiter_style = $responsive_class = '';

			$atts = vc_map_get_attributes( 'dfd_heading', $atts );
			extract( $atts );
			
			$animation_data = '';

			$el_class .= ' '.$content_alignment . ' ' . $style;
			
			if ( ! ($module_animation == '')){
				$el_class .= ' cr-animate-gen';
				$animation_data = 'data-animate-type = "'.esc_attr($module_animation).'" ';
			}
			
			$uniqid = uniqid('dfd-heading-');
			
			global $dfd_ronneby;
			
			if(isset($dfd_ronneby['disable_typography_responsive']) && $dfd_ronneby['disable_typography_responsive']) {
				$responsive_class = 'dfd-disable-resposive-headings';
			} else {
				$responsive_class = 'dfd-enable-resposive-headings';
			}
			
			// Title HTML.
			if ( ! empty( $content ) ) {
				$title_options = _crum_parse_text_shortcode_params( $title_font_options, 'block-title', $title_google_fonts, $title_custom_fonts );
				$title_html .= '<'.$title_options['tag'].' class="widget-title ' . $title_options['class'] . '" ' . $title_options['style'] . '>' . wpb_js_remove_wpautop($content) . '</'.$title_options['tag'].'>';
			}

			// Subtitle HTML.
			if ( ! empty( $subtitle ) ) {
				$subtitle_options = _crum_parse_text_shortcode_params( $subtitle_font_options, 'subtitle', $subtitle_google_fonts, $subtitle_custom_fonts );
				$subtitle_html .= '<'.$subtitle_options['tag'].' class="widget-sub-title ' . $subtitle_options['class'] . '" ' . $subtitle_options['style'] . '>' . esc_html( $subtitle ) . '</'.$subtitle_options['tag'].'>';
			}
			
			// Delimiter HTML.
			if($enable_delimiter == 'yes') {
				$delimiter_html .= '<div class="dfd-heading-delimiter">';
				if($delimiter_style == 'icon') {
					$delimiter_html .= do_shortcode('[just_icon icon_align="'.$content_alignment.'" icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_animation=""]');
				} elseif($delimiter_style == 'image') {
					$delimiter_img_src = wp_get_attachment_image_src($delimiter_image,'full');
					$delimiter_img_meta = wp_get_attachment_metadata($delimiter_image);

					if(isset($delimiter_img_meta['image_meta']['caption']) && $delimiter_img_meta['image_meta']['caption'] != '') {
						$caption = $delimiter_img_meta['image_meta']['caption'];
					} else if(isset($delimiter_img_meta['image_meta']['title']) && $delimiter_img_meta['image_meta']['title'] != '') {
						$caption = $delimiter_img_meta['image_meta']['title'];
					} else {
						$caption = __('delimiter image','dfd');
					}
					if(isset($delimiter_img_src[0]))
						$delimiter_html .= '<img src="'.esc_url($delimiter_img_src[0]).'" alt="'.esc_attr($caption).'" />';
				} elseif($delimiter_settings != '') {
					$delimiter_settings = str_replace('|', '', $delimiter_settings);
					$module_css .= '#'.esc_js($uniqid).' .dfd-heading-delimiter {'.esc_js($delimiter_settings).'}';
				}
				$delimiter_html .= '</div>';
			}
			if($heading_margin != '') {
				$module_css .= '#'.esc_js($uniqid).' .widget-title {'.esc_js($heading_margin).'}';
			}
			if($subheading_margin != '') {
				$module_css .= '#'.esc_js($uniqid).' .widget-sub-title {'.esc_js($subheading_margin).'}';
			}
			if($delimiter_margin != '') {
				$module_css .= '#'.esc_js($uniqid).' .dfd-heading-delimiter {'.esc_js($delimiter_margin).'}';
			}
			
			$style_template = locate_template($this->front_template).$style.'.php';
			
			$output .= '<div class="dfd-heading-shortcode">';
				$output .= '<div class="dfd-heading-module-wrap '.esc_attr($el_class).' '.esc_attr($responsive_class).'" id="'.esc_attr($uniqid).'" '.$animation_data.'>';
					$output .= '<div class="inline-block">';
						$output .= '<div class="dfd-heading-module">';
							if(file_exists($style_template))
								include($style_template);
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
				if(!empty($module_css)) {
					$output .= '<script type="text/javascript">
									(function($) {
										$("head").append("<style>'.$module_css.'</style>");
									})(jQuery);
								</script>';
				}
			$output .= '</div>';
			
			return $output;
		}
	}
}

if ( class_exists( 'Dfd_Heading' ) ) {
	$Dfd_Heading = new Dfd_Heading;
}