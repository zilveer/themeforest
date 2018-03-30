<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
 * Add-on Name: Share Module
 */
if (!class_exists('Dfd_New_Share_Module')) {

	class Dfd_New_Share_Module {

		function __construct() {
			add_action('init', array($this, 'dfd_new_share_module_init'));
			add_shortcode('dfd_new_share_module', array($this, 'dfd_new_share_module_shortcode'));
		}

		function dfd_new_share_module_init() {
			if (function_exists('vc_map')) {
				$module_images = get_template_directory_uri() . '/inc/vc_custom/dfd_vc_addons/admin/img/share_module/';
				vc_map(
						array(
							'name' => esc_html__('New Share Module', 'dfd'),
							'base' => 'dfd_new_share_module',
							'class' => 'vc_info_banner_icon',
							'icon' => 'vc_icon_info_banner',
							'category' => esc_html__('Ronneby 2.0', 'dfd'),
							'description' => esc_html__('Displays social share', 'dfd'),
							'params' => array(
								array(
									'heading' => esc_html__('Select Style', 'dfd'),
									'description' => '',
									'type' => 'radio_image_select',
									'param_name' => 'main_style',
									'simple_mode'		=> false,
									'options' => array(
										'style-1'	=> array(
											'tooltip'	=> esc_attr__('Standard','dfd'),
											'src'		=> $module_images . 'style-1.png'
										),
										'style-2'	=> array(
											'tooltip'	=> esc_attr__('Standard colored','dfd'),
											'src'		=> $module_images . 'style-2.png'
										),
										'style-3'	=> array(
											'tooltip'	=> esc_attr__('Separated','dfd'),
											'src'		=> $module_images . 'style-3.png'
										),
										'style-4'	=> array(
											'tooltip'	=> esc_attr__('Separated coloded','dfd'),
											'src'		=> $module_images . 'style-4.png'
										),
										'style-5'	=> array(
											'tooltip'	=> esc_attr__('Text','dfd'),
											'src'		=> $module_images . 'style-5.png'
										),
										'style-6'	=> array(
											'tooltip'	=> esc_attr__('Circle','dfd'),
											'src'		=> $module_images . 'style-6.png'
										),
										'style-7'	=> array(
											'tooltip'	=> esc_attr__('Circle colored','dfd'),
											'src'		=> $module_images . 'style-7.png'
										),
										'style-8'	=> array(
											'tooltip'	=> esc_attr__('Background change','dfd'),
											'src'		=> $module_images . 'style-8.png'
										),
									),
								),
								array(
									'type' => 'checkbox',
									'class' => '',
									'heading' => esc_html__('Enable Facebook share option', 'dfd'),
									'param_name' => 'enable_facebook_share',
									'value' => array(esc_html__('Yes, please', 'dfd') => 'yes'),
									'group' => esc_html__('Social Networks', 'dfd'),
								),
								array(
									'type' => 'checkbox',
									'class' => '',
									'heading' => esc_html__('Enable Twitter share option', 'dfd'),
									'param_name' => 'enable_twitter_share',
									'value' => array(esc_html__('Yes, please', 'dfd') => 'yes'),
									'group' => esc_html__('Social Networks', 'dfd'),
								),
								array(
									'type' => 'checkbox',
									'class' => '',
									'heading' => esc_html__('Enable Google Plus share option', 'dfd'),
									'param_name' => 'enable_googleplus_share',
									'value' => array(esc_html__('Yes, please', 'dfd') => 'yes'),
									'group' => esc_html__('Social Networks', 'dfd'),
								),
								array(
									'type' => 'checkbox',
									'class' => '',
									'heading' => esc_html__('Enable Linked-IN share option', 'dfd'),
									'param_name' => 'enable_linkedin_share',
									'value' => array(esc_html__('Yes, please', 'dfd') => 'yes'),
									'group' => esc_html__('Social Networks', 'dfd'),
								),
								array(
									'type' => 'checkbox',
									'class' => '',
									'heading' => esc_html__('Enable Pinterest share option', 'dfd'),
									'param_name' => 'enable_pinterest_share',
									'value' => array(esc_html__('Yes, please', 'dfd') => 'yes'),
									'group' => esc_html__('Social Networks', 'dfd'),
								),
//								array(
//									'type' => 'checkbox',
//									'class' => '',
//									'heading' => esc_html__('Enable Digg share option', 'dfd'),
//									'param_name' => 'enable_digg_share',
//									'value' => array(esc_html__('Yes, please', 'dfd') => 'yes'),
//									'group' => esc_html__('Social Networks', 'dfd'),
//								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => esc_html__('Single Share Height', 'dfd'),
									'param_name' => 'single_share_height',
									'value' => '',
									'min' => 20,
									'max' => 500,
									'edit_field_class' => 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4')),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => esc_html__('General Border Style', 'dfd'),
									'param_name' => 'general_border_style',
									'value' => array(
										esc_html__('None', 'dfd') => '',
										esc_html__('Solid', 'dfd') => 'solid',
										esc_html__('Dashed', 'dfd') => 'dashed',
										esc_html__('Dotted', 'dfd') => 'dotted',
										esc_html__('Double', 'dfd') => 'double',
										esc_html__('Inset', 'dfd') => 'inset',
										esc_html__('Outset', 'dfd') => 'outset',
									),
									'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'main_style', 'value' => array('style-1')),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => esc_html__('General Border Width', 'dfd'),
									'param_name' => 'general_border_width',
									'value' => '1',
									'min' => 0,
									'max' => 10,
									'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding crum-number-wrap crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'general_border_style', 'not_empty' => true),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => esc_html__('General Border Color', 'dfd'),
									'param_name' => 'general_border_color',
									'value' => '#cdcdcd',
									'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'general_border_style', 'not_empty' => true),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => esc_html__('Single Share Border Radius', 'dfd'),
									'param_name' => 'single_border_radius',
									'value' => '',
									'min' => 0,
									'max' => 100,
									'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding crum-number-wrap crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'main_style', 'value' => array('style-3', 'style-4', 'style-6', 'style-7')),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => esc_html__('Single Share Font Size', 'dfd'),
									'param_name' => 'single_font_size',
									'value' => '',
									'min' => 5,
									'max' => 70,
									'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding crum-number-wrap crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'main_style', 'value' => array('style-5', 'style-6', 'style-7', 'style-8')),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => esc_html__('Position of the elements', 'dfd'),
									'param_name' => 'position_elements',
									'value' => array(
										esc_html__('Horizontal', 'dfd')	=> 'horizontal',
										esc_html__('Vertical', 'dfd') => 'vertical',
									),
									'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'main_style', 'value' => array('style-8')),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => esc_html__('Top and bottom spacer', 'dfd'),
									'param_name' => 'top_bottom_spacer',
									'value' => '',
									'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding crum-number-wrap crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'main_style', 'value' => array('style-8')),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => esc_html__('Left and right spacer', 'dfd'),
									'param_name' => 'left_right_spacer',
									'value' => '',
									'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding crum-number-wrap crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'position_elements', 'value' => array('vertical')),
								),
								array(
									'type' => 'checkbox',
									'class' => '',
									'heading' => esc_html__('Share text uppercase', 'dfd'),
									'param_name' => 'share_uppercouse',
									'value' => array(esc_html__('Yes', 'dfd') => 'yes'),
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'main_style', 'value' => array('style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-8')),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => esc_html__('Single Share Diameter', 'dfd'),
									'param_name' => 'single_diameter',
									'value' => '',
									'min' => 10,
									'max' => 500,
									'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding crum-number-wrap crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'main_style', 'value' => array('style-6', 'style-7')),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => esc_html__('Single Border Style', 'dfd'),
									'param_name' => 'single_border_style',
									'value' => array(
										esc_html__('None', 'dfd') => '',
										esc_html__('Solid', 'dfd') => 'solid',
										esc_html__('Dashed', 'dfd') => 'dashed',
										esc_html__('Dotted', 'dfd') => 'dotted',
										esc_html__('Double', 'dfd') => 'double',
										esc_html__('Inset', 'dfd') => 'inset',
										esc_html__('Outset', 'dfd') => 'outset',
									),
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'main_style', 'value' => array('style-6')),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => esc_html__('Single Border Width', 'dfd'),
									'param_name' => 'single_border_width',
									'value' => '1',
									'min' => 0,
									'max' => 10,
									'edit_field_class' => 'vc_column vc_col-sm-4 crum-number-wrap crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'single_border_style', 'not_empty' => true),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => esc_html__('Single Border Color', 'dfd'),
									'param_name' => 'single_border_color',
									'value' => '#cdcdcd',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'single_border_style', 'not_empty' => true),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => esc_html__('Single Background Color', 'dfd'),
									'param_name' => 'single_background_color',
									'value' => 'transparent',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'main_style', 'value' => array('style-6')),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => esc_html__('Single Color', 'dfd'),
									'param_name' => 'single_color',
									'value' => '',
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'main_style', 'value' => array('style-6')),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => esc_html__('Element alignment', 'dfd'),
									'param_name' => 'element_alignment',
									'value' => array(
										esc_html__('Center', 'dfd') => 'text-center',
										esc_html__('Left', 'dfd')	=> 'text-left',
										esc_html__('Right', 'dfd')	=> 'text-right',
									),
									'edit_field_class' => 'vc_column vc_col-sm-4 crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'main_style', 'value' => array('style-5', 'style-6', 'style-7')),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => esc_html__('Element alignment', 'dfd'),
									'param_name' => 'element_vertical_alignment',
									'value' => array(
										esc_html__('Center', 'dfd') => 'text-center',
										esc_html__('Left', 'dfd')	=> 'text-left',
										esc_html__('Right', 'dfd')	=> 'text-right',
									),
									'edit_field_class' => 'vc_column vc_col-sm-4 no-top-padding crum_vc',
									'group' => esc_html__('Style decoration', 'dfd'),
									'dependency' => array('element' => 'position_elements', 'value' => array('vertical')),
								),
								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => esc_html__('Custom CSS Class', 'dfd'),
									'param_name' => 'el_class',
									'value' => '',
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => esc_html__('Animation', 'dfd'),
									'param_name' => 'module_animation',
									'value' => dfd_module_animation_styles(),
									'group' => esc_html__('Animation Settings', 'dfd'),
								),
							),
						)
				);
			}
		}

		// Shortcode handler function
		function dfd_new_share_module_shortcode($atts) {
			$output = $enable_facebook_share = $enable_twitter_share = $enable_google_plus_share = $enable_linkedin_share = $enable_pinterest_share = $link_text = '';
			$el_class = $share_html = $module_animation = $animate = $animation_data = $main_style = $general_border_style = $general_border_width = $link_css = '';
			$general_border_color = $single_border_radius = $single_border_style = $single_border_width = $single_border_color = $single_background_color = $style_six = '';
			$single_style = $single_font_size = $single_diameter = $icon_style = $single_share_height = $hover_class = $hover_attr = $single_color = $enable_digg_share = '';
			$share_uppercouse = $style_class = $line_height_style = $line_height = $content_alignment = $element_alignment = $general_class = $top_bottom_spacer = '';
			$element_vertical_alignment = $left_right_spacer = '';

			$data_link = get_site_url();
			$data_title = $blog_title = get_bloginfo('name');

			$unique_id = uniqid('dfd_share_');

			$atts = vc_map_get_attributes( 'dfd_new_share_module', $atts );
			extract( $atts );

			$share_data = array(
				'facebook' => esc_html__('Facebook', 'dfd'),
				'twitter' => esc_html__('Twitter', 'dfd'),
				'googleplus' => esc_html__('Google plus', 'dfd'),
				'linkedin' => esc_html__('LinkedIN', 'dfd'),
				'pinterest' => esc_html__('Pinterest', 'dfd'),
				
//				'digg' => esc_html__('Digg', 'dfd'),
				//'delicious' => esc_html__('Delicious', 'dfd'),
				//'stumbleupon' => esc_html__('Stumbleupon', 'dfd'),
			);
						
			$shared_image = get_the_post_thumbnail_url();
			
			if(!$shared_image) {
				$shared_image = get_template_directory_uri() . '/assets/images/no_image_resized_480-360.jpg';
			}
			
			$share_urls = array(
				'facebook' => 'https://www.facebook.com/sharer/sharer.php?u='. esc_attr($data_link),
				'twitter' => 'https://twitter.com/intent/tweet?text='. esc_attr($data_link),
				'googleplus' => 'https://plus.google.com/share?url='. esc_attr($data_link),
				'linkedin' => 'http://www.linkedin.com/shareArticle?mini=true&amp;url='. esc_attr($data_link),
				'pinterest' => 'http://pinterest.com/pin/create/button/?url='. esc_attr($data_link).'&image_url='.esc_url($shared_image),
			);

			if (!($module_animation == '')) {
				$animate .= ' cr-animate-gen';
				$animation_data .= 'data-animate-item = ".module-entry-share-links-list > li" data-animate-type = "' . $module_animation . '" ';
			}

			if (isset($main_style) && strcmp($main_style, 'style-1') === 0) {
				if (isset($general_border_style) && !empty($general_border_style)) {
                    $style_class = 'general-border';
					$line_height = 62 - $general_border_width * 2;
					$line_height_style = 'line-height: '.$line_height.'px;';
					$general_border_style = esc_attr($general_border_style);
					if (isset($general_border_width) && !empty($general_border_width)) {
						$general_border_width = esc_attr($general_border_width);
					}
					if (isset($general_border_color) && !empty($general_border_color)) {
						$general_border_color = esc_attr($general_border_color);
					}
				}
				if($general_border_style) {
					$link_css .= '.dfd-new-share-module.style-1 #'.esc_attr($unique_id).' ul li a {border-top-style: '.$general_border_style.'; border-top-width: '.$general_border_width.'px; border-top-color: '.$general_border_color.'; border-bottom-style: '.$general_border_style.'; border-bottom-width: '.$general_border_width.'px; border-bottom-color: '.$general_border_color.'; '.esc_attr($line_height_style).';}';
					$link_css .= '.dfd-new-share-module.style-1 #'.esc_attr($unique_id).' ul li:first-child a {border-left-style: '.$general_border_style.'; border-left-width: '.$general_border_width.'px; border-left-color: '.$general_border_color.';}';
					$link_css .= '.dfd-new-share-module.style-1 #'.esc_attr($unique_id).' ul li:last-child a {border-right-style: '.$general_border_style.'; border-right-width: '.$general_border_width.'px; border-right-color: '.$general_border_color.';}';
					$link_css .= '@media only screen and (max-width: 799px) {.dfd-new-share-module.style-1 #'.esc_attr($unique_id).' ul li a {border-left-width: '.$general_border_width.'px; border-right-width: '.$general_border_width.'px; border-bottom-width: 0; border-bottom-color: inherit; border-left-color: '.$general_border_color.'; border-right-color: '.$general_border_color.'; border-top-width: 0; border-left-style: '.$general_border_style.'; border-right-style: '.$general_border_style.'; border-bottom-style: solid;}}';
					$link_css .= '@media only screen and (max-width: 799px) {.dfd-new-share-module.style-1 #'.esc_attr($unique_id).' ul li:first-child a {border-top-width: '.$general_border_width.'px;}}';
					$link_css .= '@media only screen and (max-width: 799px) {.dfd-new-share-module.style-1 #'.esc_attr($unique_id).' ul li:last-child a {border-bottom-width: '.$general_border_width.'px; border-bottom-color: '.$general_border_color.'; border-bottom-style: '.$general_border_style.';}}';
				}
			}
			
			$single_style .= 'style="';
			if (isset($main_style) && strcmp($main_style, 'style-3') === 0 || strcmp($main_style, 'style-4') === 0 || strcmp($main_style, 'style-6') === 0 || strcmp($main_style, 'style-7') === 0) {
				if (isset($single_border_radius) && !empty($single_border_radius)) {
					$single_style .= 'border-radius: ' . esc_attr($single_border_radius) . 'px; ';
				}
			}
			if (isset($main_style) && strcmp($main_style, 'style-5') === 0 || strcmp($main_style, 'style-6') === 0 || strcmp($main_style, 'style-7') === 0) {
				if (isset($single_font_size) && !empty($single_font_size)) {
					$single_style .= 'font-size: ' . esc_attr($single_font_size) . 'px; ';
				}
			}
			if (isset($main_style) && strcmp($main_style, 'style-1') === 0 || strcmp($main_style, 'style-2') === 0 || strcmp($main_style, 'style-3') === 0 || strcmp($main_style, 'style-4') === 0) {
				if (isset($single_share_height) && !empty($single_share_height)) {
					$single_style .= 'height: ' . esc_attr($single_share_height) . 'px; line-height: ' . esc_attr($single_share_height) . 'px; ';
				}
			}
			//if (isset($main_style) && strcmp($main_style, 'style-1') === 0 || strcmp($main_style, 'style-2') === 0 || strcmp($main_style, 'style-3') === 0 || strcmp($main_style, 'style-4') === 0 || strcmp($main_style, 'style-5') === 0 || strcmp($main_style, 'style-8') === 0) {
				if ($share_uppercouse === 'yes') {
					$single_style .= 'text-transform: uppercase;';
				}
			//}
			$single_style .= '"';
			
			if (isset($main_style) && strcmp($main_style, 'style-6') === 0) {
				if(isset($single_border_style) && !empty($single_border_style)) {
					$style_six .= 'border-style: '.esc_attr($single_border_style).';';
					if (isset($single_border_width) && !empty($single_border_width)) {
						$style_six .= 'border-width: '.esc_attr($single_border_width).'px;';
					}
					if (isset($single_border_color) && !empty($single_border_color)) {
						$style_six .= 'border-color: '.esc_attr($single_border_color).';';
					}
				}
				if (isset($single_background_color) && !empty($single_background_color)) {
					$single_background_color = 'background: '.esc_attr($single_background_color).';';
				}
				if (isset($single_color) && !empty($single_color)) {
					$single_color = 'color: '.esc_attr($single_color).';';
				}
				if($single_border_style || $single_background_color || $single_color) {
					$link_css .= '.dfd-new-share-module.style-6 #'.esc_attr($unique_id).' ul li a {'. $style_six . $single_background_color . $single_color .'}';
				}
			}

			$icon_style .= 'style="';
			if (isset($main_style) && strcmp($main_style, 'style-6') === 0 || strcmp($main_style, 'style-7') === 0) {
				if (isset($single_diameter) && !empty($single_diameter)) {
					$icon_style .= 'width: ' . esc_attr($single_diameter) . 'px; height: ' . esc_attr($single_diameter) . 'px; line-height: ' . esc_attr($single_diameter) . 'px;';
				}
			}
			$icon_style .= '"';
			
			if (isset($main_style) && strcmp($main_style, 'style-5') === 0) {
				$hover_class = 'chaffle';
				$hover_attr = 'data-lang="en"';
			}
			if(isset($top_bottom_spacer) && !empty($top_bottom_spacer)) {
				$link_css .= '.dfd-new-share-module.style-8.vertical #'.esc_attr($unique_id).' ul li:first-child a .front-share {padding-top: '.esc_attr($top_bottom_spacer).'px;}';
				$link_css .= '.dfd-new-share-module.style-8.vertical #'.esc_attr($unique_id).' ul li:last-child a .front-share {padding-bottom: '.esc_attr($top_bottom_spacer).'px;}';
				$link_css .= '@media only screen and (min-width: 799px) {.dfd-new-share-module.style-8.horizontal #'.esc_attr($unique_id).' ul li a .front-share {padding: '.esc_attr($top_bottom_spacer).'px 0;}}';
				$link_css .= '@media only screen and (max-width: 799px) {.dfd-new-share-module.style-8.horizontal #'.esc_attr($unique_id).' ul li:first-child a .front-share {padding-top: '.esc_attr($top_bottom_spacer).'px;}}';
				$link_css .= '@media only screen and (max-width: 799px) {.dfd-new-share-module.style-8.horizontal #'.esc_attr($unique_id).' ul li:last-child a .front-share {padding-bottom: '.esc_attr($top_bottom_spacer).'px;}}';
			}
			if(isset($left_right_spacer) && !empty($left_right_spacer)) {
				$link_css .= '.dfd-new-share-module.style-8.vertical #'.esc_attr($unique_id).' ul li a .front-share {padding-left: '.esc_attr($left_right_spacer).'px; padding-right: '.esc_attr($left_right_spacer).'px;}';
			}
			if (isset($main_style) && strcmp($main_style, 'style-5') === 0 || strcmp($main_style, 'style-6') === 0 || strcmp($main_style, 'style-7') === 0) {
				$general_class .= ' '.esc_attr($element_alignment).' ';
			} elseif (isset($main_style) && strcmp($main_style, 'style-8') === 0 && strcmp($position_elements, 'vertical') === 0) {
				$general_class .= ' '.esc_attr($element_vertical_alignment).' ';
			} else {
				$general_class .= 'text-center ';
			}
			$general_class .= esc_attr($main_style).' '.esc_attr($position_elements).' '.esc_attr($style_class).' '.esc_attr($el_class).' '. $animate;
			
			ob_start();
			echo '<div class="dfd-shar-module-cover">';
			echo '<div class="dfd-new-share-module ' . $general_class .'" ' . $animation_data . '>';
			echo '<div class="module module-entry-share" id="' . esc_attr($unique_id) . '">';
			echo '<ul class="module-entry-share-links-list rrssb-buttons" data-directory="' . get_template_directory_uri() . '">';
			foreach ($share_data as $key => $value) {
				$social_network = 'enable_' . $key . '_share';
				if (strcmp($main_style, 'style-6') === 0 || strcmp($main_style, 'style-7') === 0) {
					$link_text = '<span class="dfd-share-icon" ' . $icon_style . '></span>';
				} else {
					$link_text = '<span class="back-share">' . $value . '</span><span class="front-share '.esc_attr($hover_class).'" '.$hover_attr.'>' . $value . '</span>';
				}
				if ($$social_network) {
					echo '<li class="rrssb-'.esc_attr($key).'">';
						echo '<a class="module-entry-share-link-' . esc_attr($key) . ' feature-title" data-title="' . esc_attr($data_title) . '" data-url="' . esc_url($data_link) . '" data-media="" href="'.esc_url($share_urls[$key]).'"  ' . $single_style . '>' . $link_text . '</a>';
					echo '</li>';
				}
			}
			echo '</ul>';
			echo '</div>';
			echo '</div>';
			/*
			*/
			?>
			<script type="text/javascript">
				(function ($) {
					"use strict";
					$(document).ready(function () {
						var $share_container = $('#<?php echo esc_js($unique_id); ?> .module-entry-share-links-list li');
						var parent = $share_container.parent().parent().parent();

						if ($share_container.length > 0) {
							/*$('.module-entry-share-link-facebook', $share_container).sharrre({
								share: {
									facebook: true
								},
								template: '<a href="#"><i class="soc_icon-facebook"></i></a>',
								enableHover: false,
								enableCounter: false,
								urlCurl: $share_container.data('directory') + '/inc' + '/sharrre.php',
								click: function (api, options) {
									api.simulateClick();
									api.openPopup('facebook');
								}
							});


							$('.module-entry-share-link-twitter', $share_container).sharrre({
								share: {
									twitter: true
								},
								template: '<a href="#" class="twitter"><i class="soc_icon-twitter-3"></i></a>',
								enableHover: false,
								enableCounter: false,
								urlCurl: $share_container.data('directory') + '/inc' + '/sharrre.php',
								click: function (api, options) {
									api.simulateClick();
									api.openPopup('twitter');
								}
							});



							$('.module-entry-share-link-googleplus', $share_container).sharrre({
								share: {
									googlePlus: true
								},
								template: '<a href="#"><i class="soc_icon-google__x2B_"></i></a>',
								enableHover: false,
								enableCounter: false,
								urlCurl: $share_container.data('directory') + '/inc' + '/sharrre.php',
								click: function (api, options) {
									api.simulateClick();
									api.openPopup('googlePlus');
								}
							});

							$('.module-entry-share-link-linkedin', $share_container).sharrre({
								share: {
									linkedin: true
								},
								template: '<a href="#"><i class="soc_icon-linkedin"></i></a>',
								enableHover: false,
								enableCounter: false,
								urlCurl: $share_container.data('directory') + '/inc' + '/sharrre.php',
								click: function (api, options) {
									api.simulateClick();
									api.openPopup('linkedin');
								}
							});

							$('.module-entry-share-link-pinterest', $share_container).sharrre({
								share: {
									pinterest: true
								},
								template: '<a href="#"><i class="soc_icon-pinterest"></i></a>',
								enableHover: false,
								enableCounter: false,
								urlCurl: $share_container.data('directory') + '/inc' + '/sharrre.php',
								click: function (api, options) {
									api.simulateClick();
									api.openPopup('pinterest');
								}
							});
							
							$('.module-entry-share-link-digg', $share_container).sharrre({
								share: {
									digg: true
								},
								template: '<a href="#"><i class="soc_icon-digg"></i></a>',
								enableHover: false,
								enableCounter: false,
								urlCurl: $share_container.data('directory') + '/inc' + '/sharrre.php',
								click: function (api, options) {
									api.simulateClick();
									api.openPopup('digg');
								}
							});*/
							var scrollbarWidth;
							var div = document.createElement('div');

							div.style.overflowY = 'scroll';
							div.style.width =  '50px';
							div.style.height = '50px';

							div.style.visibility = 'hidden';

							document.body.appendChild(div);
							scrollbarWidth = div.offsetWidth - div.clientWidth;
							document.body.removeChild(div);

							var setShareWidth = function () {
								if (($(window).width() + scrollbarWidth) > 800) {
									if (parent.hasClass("style-6") || parent.hasClass("style-7") || parent.hasClass("vertical")) {
										$share_container.width('auto');
									} else {
										$share_container.pricingTableEqColumns();
									}
								} else {
									if (parent.hasClass("style-6") || parent.hasClass("style-7") || parent.hasClass("vertical")) {
										$share_container.width('auto');
									} else {
										$share_container.width('100%');
									}
								}
							};
							setShareWidth();
							$(window).resize(setShareWidth);
						}
					});
					$('head').append('<style type="text/css"><?php echo esc_js($link_css); ?></style>');
				})(jQuery);
			</script>
			
			<?php
			echo '</div>';
			$output .= ob_get_clean();

			return $output;
		}

	}

}
if (class_exists('Dfd_New_Share_Module')) {
	$Dfd_New_Share_Module = new Dfd_New_Share_Module;
}