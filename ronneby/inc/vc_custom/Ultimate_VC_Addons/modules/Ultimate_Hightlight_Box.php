<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Highlight Box.
*/
global $dfd_ronneby;
if(isset($dfd_ronneby['enable_default_addons']) && strcmp($dfd_ronneby['enable_default_addons'], '1') === 0) {
	if(!class_exists('Ultimate_Highlight_Box')) {
		class Ultimate_Highlight_Box{
			function __construct(){
				add_action('init',array($this,'ctaction_init'));
				add_shortcode('ultimate_ctation',array($this,'call_to_action_shortcode'));
				add_action('wp_enqueue_scripts', array($this, 'register_cta_assets'),1);
			}
			function register_cta_assets() {
				wp_register_style('utl-ctaction-style',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/highlight-box.min.css',array(), null);
				wp_register_script('utl-ctaction-script',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/highlight-box.min.js',array('jquery'), null);
			}
			function ctaction_init(){
				if(function_exists('vc_map')) {
					vc_map(
						array(
						   'name' => __('Hightlight Box','dfd'),
						   'base' => 'ultimate_ctation',
						   'class' => 'vc_ctaction_icon',
						   'icon' => 'vc_icon_ctaction',
						   'category' => 'Ultimate VC Addons',
						   //'description' => __('Displays the banner image with Information','smile'),
						   'params' => array(
								array(
									'type' => 'textarea_html',
									'class' => '',
									'heading' => __('Text ','dfd'),
									'param_name' => 'content',
									'admin_label' => true,
									'value' => '',
									'edit_field_class' => 'ult_hide_editor_fullscreen vc_col-xs-12 vc_column wpb_el_type_textarea_html vc_wrapper-param-type-textarea_html vc_shortcode-param',
									//'description' => __('Give a title to this banner','smile')
								),
								array(
									'type' => 'dropdown',
									'heading' => __('Alignment', 'dfd'),
									'param_name' => 'content_alignment',
									'value' => array(
										__('Center', 'dfd') => 'ctaction-text-center',
										__('Left', 'dfd') => 'ctaction-text-left',
										__('Right', 'dfd') => 'ctaction-text-right'
									)
								),
								array(
									'type' => 'colorpicker',
									'heading' => __('Background','dfd'),
									'param_name' => 'ctaction_background',
									'value' => '#e74c3c',
									'group' => 'Background'
								),
								array(
									'type' => 'colorpicker',
									'heading' => __('Background Hover','dfd'),
									'param_name' => 'ctaction_background_hover',
									'value' => '#c0392b',
									'group' => 'Background'
								),
								array(
									'type' => 'vc_link',
									'param_name' => 'ctaction_link',
									'heading' => __('Link','dfd')
								),
								array(
									'type' => 'ult_switch',
									'heading' => __('Enable Icon','dfd'),
									'param_name' => 'enable_icon',
									'value' => '',
									'options' => array(
										'enable_icon_value' => array(
											'label' => '',
											'on' => __('Yes','dfd'),
											'off' => __('No','dfd')
										)
									),
									'group' => 'Icon'
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Effect', 'dfd'),
									'param_name' => 'effect',
									'value' => array(
										__('Slide Left','dfd') => 'right-push',
										__('Slide Right','dfd') => 'left-push',
										__('Slide Top','dfd') => 'bottom-push',
										__('Slide Bottom','dfd') => 'top-push',
									),
									'description' => __('Use an existing font icon or upload a custom image.', 'dfd'),
									'dependency' => Array('element' => 'enable_icon', 'value' => array('enable_icon_value')),
									'group' => 'Icon'
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon to display:', 'dfd'),
									'param_name' => 'icon_type',
									'value' => array(
										__('Font Icon Manager','dfd') => 'selector',
										__('Custom Image Icon','dfd') => 'custom',
									),
									'description' => __('Use an existing font icon or upload a custom image.', 'dfd'),
									'dependency' => Array('element' => 'enable_icon', 'value' => array('enable_icon_value')),
									'group' => 'Icon'
								),
								array(
									'type' => 'icon_manager',
									'class' => '',
									'heading' => __('Select Icon ','dfd'),
									'param_name' => 'icon',
									'value' => '',
									'description' => __('Click and select icon of your choice. If you can\'t find the one that suits for your purpose','dfd').', '.__('you can','dfd').' <a href="admin.php?page=font-icon-Manager" target="_blank">'.__('add new here','dfd').'</a>.',
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
									'group' => 'Icon'
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Size of Icon', 'dfd'),
									'param_name' => 'icon_size',
									'value' => 32,
									'min' => 12,
									'max' => 72,
									'suffix' => 'px',
									'description' => __('How big would you like it?', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
									'group' => 'Icon'
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Color', 'dfd'),
									'param_name' => 'icon_color',
									'value' => '',
									'description' => __('Give it a nice paint!', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
									'group' => 'Icon'				
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon Style', 'dfd'),
									'param_name' => 'icon_style',
									'value' => array(
										__('Simple','dfd') => 'none',
										__('Circle Background','dfd') => 'circle',
										__('Square Background','dfd') => 'square',
										__('Design your own','dfd') => 'advanced',
									),
									'description' => __('We have given three quick preset if you are in a hurry. Otherwise, create your own with various options.', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
									'group' => 'Icon'
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Background Color', 'dfd'),
									'param_name' => 'icon_color_bg',
									'value' => '',
									'description' => __('Select background color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'icon_style', 'value' => array('circle','square','advanced')),
									'group' => 'Icon'
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon Border Style', 'dfd'),
									'param_name' => 'icon_border_style',
									'value' => array(
										__('None','dfd') => '',
										__('Solid','dfd') => 'solid',
										__('Dashed','dfd') => 'dashed',
										__('Dotted','dfd') => 'dotted',
										__('Double','dfd') => 'double',
										__('Inset','dfd') => 'inset',
										__('Outset','dfd') => 'outset',
									),
									'description' => __('Select the border style for icon.','dfd'),
									'dependency' => Array('element' => 'icon_style', 'value' => array('advanced')),
									'group' => 'Icon'
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Border Color', 'dfd'),
									'param_name' => 'icon_color_border',
									'value' => '#333333',
									'description' => __('Select border color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => 'Icon'
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Border Width', 'dfd'),
									'param_name' => 'icon_border_size',
									'value' => 1,
									'min' => 1,
									'max' => 10,
									'suffix' => 'px',
									'description' => __('Thickness of the border.', 'dfd'),
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => 'Icon'
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Border Radius', 'dfd'),
									'param_name' => 'icon_border_radius',
									'value' => 500,
									'min' => 1,
									'max' => 500,
									'suffix' => 'px',
									'description' => __('0 pixel value will create a square border. As you increase the value, the shape convert in circle slowly. (e.g 500 pixels).', 'dfd'),
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
									'group' => 'Icon'
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Background Size', 'dfd'),
									'param_name' => 'icon_border_spacing',
									'value' => 50,
									'min' => 30,
									'max' => 500,
									'suffix' => 'px',
									'description' => __('Spacing from center of the icon till the boundary of border / background', 'dfd'),
									'dependency' => Array('element' => 'icon_style', 'value' => array('advanced')),
									'group' => 'Icon'
								),
								array(
									'type' => 'attach_image',
									'class' => '',
									'heading' => __('Upload Image Icon:', 'smile'),
									'param_name' => 'icon_img',
									'value' => '',
									'description' => __('Upload the custom image icon.', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('custom')),
									'group' => 'Icon'
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Image Width', 'dfd'),
									'param_name' => 'img_width',
									'value' => 48,
									'min' => 16,
									'max' => 512,
									'suffix' => 'px',
									'description' => __('Provide image width', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('custom')),
									'group' => 'Icon'
								),


								array(
									'type' => 'ultimate_google_fonts',
									'heading' => __('Font Family', 'dfd'),
									'param_name' => 'text_font_family',
									'description' => __('Select the font of your choice.','dfd').' '.__('You can','dfd').' <a target="_blank" href="'.admin_url('admin.php?page=ultimate-font-manager').'">'.__('add new in the collection here','dfd').'</a>.',
									'group' => 'Typography'
								),
								array(
									'type' => 'ultimate_google_fonts_style',
									'heading' 		=>	__('Font Style', 'dfd'),
									'param_name'	=>	'text_font_style',
									'group' => 'Typography'
								),
								array(
									'type' => 'number',
									'class' => 'font-size',
									'heading' => __('Font Size', 'dfd'),
									'param_name' => 'text_font_size',
									'value' => 32,
									'min' => 10,
									'suffix' => 'px',
									'group' => 'Typography'
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Font Color', 'dfd'),
									'param_name' => 'text_color',
									'value' => '#ffffff',
									'group' => 'Typography'
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Line Height', 'dfd'),
									'param_name' => 'text_line_height',
									'value' => '',
									'suffix' => 'px',
									'group' => 'Typography'
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Width Override', 'dfd'),
									'param_name' => 'ctaction_override',
									'value' =>array(
										__('Default Width','dfd') =>'0',
										__('Apply 1st parent element\'s width','dfd')=>'1',
										__('Apply 2nd parent element\'s width','dfd')=>'2',
										__('Apply 3rd parent element\'s width','dfd')=>'3',
										__('Apply 4th parent element\'s width','dfd')=>'4',
										__('Apply 5th parent element\'s width','dfd')=>'5',
										__('Apply 6th parent element\'s width','dfd')=>'6',
										__('Apply 7th parent element\'s width','dfd')=>'7',
										__('Apply 8th parent element\'s width','dfd')=>'8',
										__('Apply 9th parent element\'s width','dfd')=>'9',
										__('Full Width','dfd')=>'full',
										__('Maximum Full Width','dfd')=>'ex-full',
									),
									'description' => __('By default, the map will be given to the Visual Composer row. However, in some cases depending on your theme\'s CSS - it may not fit well to the container you are wishing it would. In that case you will have to select the appropriate value here that gets you desired output..', 'dfd'),
								),
								array(
									'type' => 'number',
									'heading' => __('Top Padding', 'dfd'),
									'param_name' => 'ctaction_padding_top',
									'edit_field_class' => 'vc_column vc_col-sm-3',
									'value' => '20',
									'suffix' => 'px',
									'group' => 'Background'
								),
								array(
									'type' => 'number',
									'heading' => __('Bottom Padding', 'dfd'),
									'param_name' => 'ctaction_padding_bottom',
									'edit_field_class' => 'vc_column vc_col-sm-3',
									'value' => '20',
									'suffix' => 'px',
									'group' => 'Background'
								),
								array(
									'type' => 'number',
									'heading' => __('Left Padding', 'dfd'),
									'param_name' => 'ctaction_padding_left',
									'edit_field_class' => 'vc_column vc_col-sm-3',
									'value' => '',
									'suffix' => 'px',
									'group' => 'Background'
								),
								array(
									'type' => 'number',
									'heading' => __('Right Padding', 'dfd'),
									'param_name' => 'ctaction_padding_right',
									'edit_field_class' => 'vc_column vc_col-sm-3',
									'value' => '',
									'suffix' => 'px',
									'group' => 'Background'
								),
								array(
									"type" => "textfield",
									"heading" => __("Extra class name", "ultimate_vc"),
									"param_name" => "el_class",
									"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "ultimate_vc")
								)
							),
						)
					);
				}
			}
			// Shortcode handler function for stats banner
			function call_to_action_shortcode($atts, $content)
			{
				//wp_enqueue_script('utl-ctaction-script');
				$output = $el_class = $style = $data = $text_style_inline = $ctaction_link_html = $icon_inline = $effect = '';

				extract(shortcode_atts( array(
					'content_alignment' 		=> 'ctaction-text-center',
					'ctaction_background' 		=> '#e74c3c',
					'ctaction_background_hover' => '#c0392b',
					'text_font_family' 			=> '',
					'text_font_style' 			=> '',
					'text_font_size' 			=> '32',
					'text_color' 				=> '#ffffff',
					'text_line_height' 			=> '',
					'ctaction_link' 			=> '',
					'ctaction_override' 		=> '0',
					'ctaction_padding_top' 		=> '20',
					'ctaction_padding_bottom' 	=> '20',
					'ctaction_padding_left' 	=> '',
					'ctaction_padding_right' 	=> '',
					'enable_icon' 				=> '',
					"icon_type"					=> "selector",
					"icon"						=> "",
					"icon_color"				=> "",
					"icon_style"				=> "none",
					"icon_color_bg"				=> "",
					"icon_border_style"			=> "",
					"icon_color_border"			=> "#333333",
					"icon_border_size"			=> "1",
					"icon_border_radius"		=> "500",
					"icon_border_spacing"		=> "50",
					"icon_img"					=> "",
					"img_width"					=> "48",
					"icon_size"					=> "32",
					'effect' 					=> 'right-push',
					'el_class' 					=> '',
				),$atts));

				$el_class .= ' '.$content_alignment;

				/* typography */

				if($text_font_family != '') {
					$temp = get_ultimate_font_family($text_font_family);
					$text_style_inline .= 'font-family:'.esc_attr($temp).';';
				}

				$text_style_inline .= get_ultimate_font_style($text_font_style);

				if($text_font_size != '') {
					$text_style_inline .= 'font-size:'.esc_attr($text_font_size).'px;';
				}

				if($text_color != ''){
					$text_style_inline .= 'color:'.esc_attr($text_color).';';
				}
				if($text_line_height != ''){
					$text_style_inline .= 'line-height:'.esc_attr($text_line_height).'px;';
				}
				/*$args = array(
					$text_font_family
				);
				enquque_ultimate_google_fonts($args);*/
				/*end typography */

				if($ctaction_background != '') {
					$data .= ' data-background="'.esc_attr($ctaction_background).'" ';
					$text_style_inline .= 'background:'.esc_attr($ctaction_background).';';
				}
				if($ctaction_background_hover != '') {
					$data .= ' data-background-hover="'.esc_attr($ctaction_background_hover).'" ';
				}
				$data .= ' data-override="'.$ctaction_override.'" ';

				if($ctaction_padding_top != '') {
					$text_style_inline .= 'padding-top:'.esc_attr($ctaction_padding_top).'px;';
				}
				if($ctaction_padding_bottom != '') {
					$text_style_inline .= 'padding-bottom:'.esc_attr($ctaction_padding_bottom).'px;';
				}
				if($ctaction_padding_left != '') {
					$text_style_inline .= 'padding-left:'.esc_attr($ctaction_padding_left).'px;';
				}
				if($ctaction_padding_right != ''){
					$text_style_inline .= 'padding-right:'.esc_attr($ctaction_padding_right).'px;';			
				}
				if($ctaction_link != '') {
					$ctaction_link = vc_build_link($ctaction_link);
					$url = $ctaction_link['url'];
					$title = $ctaction_link['title'];
					$target = $ctaction_link['target'];
					if($url != '') {
						if($target != '')
							$target = 'target="'.esc_attr($target).'"';
						$ctaction_link_html = '<a href="'.esc_url($url).'" class="ulimate-call-to-action-link" '.$target.'></a>';
					}
				}

				if($enable_icon == 'enable_icon_value') {
					$icon_inline = do_shortcode('[just_icon icon_align="center" icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'"]');
				} else {
					$effect = 'no-effect';
				}

				$output .= '<div class="ultimate-call-to-action '.esc_attr($el_class).'" style="'.$text_style_inline.'" '.$data.'>';
					if($icon_inline != '') {
						$output .= '<span class="ultimate-ctaction-icon ctaction-icon-'.esc_attr($effect).'">'.$icon_inline.'</span>';
					}
					$output .= '<span class="uvc-ctaction-data uvc-ctaction-data-'.esc_attr($effect).'">'.$content.'</span>';
				$output .= $ctaction_link_html.'</div>';

				return $output;
			}
		}
	}
	if(class_exists('Ultimate_Highlight_Box')) {
		$Ultimate_Highlight_Box = new Ultimate_Highlight_Box;
	}

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_ultimate_ctation extends WPBakeryShortCode {
		}
	}
}