<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Swatch Book for Visual Composer
* Add-on URI: http://.brainstormforce.com/demos/ultimate/swatch-book
*/
global $dfd_ronneby;
if(isset($dfd_ronneby['enable_default_addons']) && strcmp($dfd_ronneby['enable_default_addons'], '1') === 0){
	if(!class_exists('Ultimate_Swatch_Book')){
		class Ultimate_Swatch_Book{
			var $swatch_trans_bg_img;
			var $swatch_width;
			var $swatch_height;
			function __construct(){
				add_action( 'init', array($this, 'swatch_book_init'));
				add_action("wp_enqueue_scripts", array($this, "register_swatch_assets"),1);
				if(function_exists('vc_is_inline')){
					if(!vc_is_inline()){
						add_shortcode( 'swatch_container', array($this, 'swatch_container' ) );
						add_shortcode( 'swatch_item', array($this, 'swatch_item' ) );
					}
				} else {
					add_shortcode( 'swatch_container', array($this, 'swatch_container' ) );
					add_shortcode( 'swatch_item', array($this, 'swatch_item' ) );
				}
			}
			function register_swatch_assets() {
				wp_register_script("swatchbook-js",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/swatchbook.min.js',array('jquery'),null);
				wp_register_style("swatchbook-css",get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/swatchbook.min.css',array(),null);
			}
			function swatch_book_init() {
				if(function_exists('vc_map')) {
					vc_map(
						array(
							'name' => __('Swatch Book','dfd'),
							'base' => 'swatch_container',
							'class' => 'vc_swatch_container',
							'icon' => 'vc_swatch_container',
							'category' => 'Ultimate VC Addons',
							'as_parent' => array('only' => 'swatch_item'),
							'description' => __('Interactive swatch strips.','dfd'),
							'content_element' => true,
							'show_settings_on_create' => true,
							'js_view' => 'VcColumnView',
							//'is_container'    => true,
							'params' => array(
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Swatch Book Style', 'dfd'),
									'param_name' => 'swatch_style',
									'value' => array(
										__('Style 1','dfd') => 'style-1',
										__('Style 2','dfd') => 'style-2',
										__('Style 3','dfd') => 'style-3',
										__('Style 4','dfd') => 'style-4',
										__('Style 5','dfd') => 'style-5',
										__('Custom Style','dfd') => 'custom',
									),
									//'description' => __('','smile'),
									'group' => 'Initial Settings',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Index of Center Strip', 'dfd'),
									'param_name' => 'swatch_index_center',
									'value' => 1,
									'min' => 1,
									'max' => 100,
									'suffix' => '',
									'description' => __('The index of the “centered” item, the one that will have an angle of 0 degrees when the swatch book is opened', 'dfd'),
									'dependency' => Array('element' => 'swatch_style', 'value' => 'custom'),
									'group' => 'Initial Settings',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Space Between Two Swatches', 'dfd'),
									'param_name' => 'swatch_space_degree',
									'value' => 1,
									'min' => 1,
									'max' => 1000,
									'suffix' => '',
									'description' => __('The space between the items (in degrees)', 'dfd'),
									'dependency' => Array('element' => 'swatch_style', 'value' => 'custom'),
									'group' => 'Initial Settings',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Transition Speed', 'dfd'),
									'param_name' => 'swatch_trans_speed',
									'value' => 500,
									'min' => 1,
									'max' => 10000,
									'suffix' => 'ms',
									'description' => __('The speed and transition timing functions', 'dfd'),
									'dependency' => Array('element' => 'swatch_style', 'value' => 'custom'),
									'group' => 'Initial Settings',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Distance From Open Item To Its Next Sibling', 'dfd'),
									'param_name' => 'swatch_distance_sibling',
									'value' => 1,
									'min' => 1,
									'max' => 10000,
									'suffix' => '',
									'description' => __('Distance From Opened item’s next siblings (neighbor : 4)', 'dfd'),
									'dependency' => Array('element' => 'swatch_style', 'value' => 'custom'),
									'group' => 'Initial Settings',
								),
								array(
									'type' => 'ult_switch',
									'class' => '',
									'heading' => __('Swatch book will be initially closed', 'dfd'),
									'param_name' => 'swatch_init_closed',
									'value' => '',
									'options' => array(
											'closed' => array(
												'label' => '',
												'on' => __('Yes','dfd'),
												'off' => __('No','dfd'),
											)
										),
									//'description' => '',
									'dependency' => Array('element' => 'swatch_style', 'value' => 'custom'),
									'group' => 'Initial Settings',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Index of the item that will be opened initially', 'dfd'),
									'param_name' => 'swatch_open_at',
									'value' => 1,
									'min' => 1,
									'max' => 100,
									'suffix' => '',
									//'description' => __('', 'smile'),
									'dependency' => Array('element' => 'swatch_style', 'value' => 'custom'),
									'group' => 'Initial Settings',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Width', 'dfd'),
									'param_name' => 'swatch_width',
									'value' => 130,
									'min' => 100,
									'max' => 1000,
									'suffix' => '',
									//'description' => __('', 'smile'),
									'group' => 'Initial Settings',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Height', 'dfd'),
									'param_name' => 'swatch_height',
									'value' => 400,
									'min' => 100,
									'max' => 1000,
									'suffix' => '',
									//'description' => __('', 'smile'),
									'group' => 'Initial Settings',
								),
								array(
									'type' => 'ult_img_single',
									'class' => '',
									'heading' => __('Background Transparent Pattern', 'dfd'),
									'param_name' => 'swatch_trans_bg_img',
									'value' => '',
									//'description' => '',
									'group' => 'Initial Settings',
								),
								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => __('Main Strip Title Text', 'dfd'),
									'param_name' => 'swatch_main_strip_text',
									'value' => '',
									'description' => '',
									'group' => 'Initial Settings',
								),
								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => __('Main Strip Highlight Text', 'dfd'),
									'param_name' => 'swatch_main_strip_highlight_text',
									'value' => '',
									//'description' => '',
									'group' => 'Initial Settings',
								),
								array(
									'type' => 'ultimate_google_fonts',
									'heading' => __('Font Family', 'dfd'),
									'param_name' => 'main_strip_font_family',
									'description' => __('Select the font of your choice.','dfd').' '.__('You can','dfd').' <a target="_blank" href="'.admin_url('admin.php?page=ultimate-font-manager').'">'.__('add new in the collection here','dfd').'</a>.',
									'group' => 'Advanced Settings',
								),
								array(
									'type' 		=> 'ultimate_google_fonts_style',
									'heading' 	 =>	__('Font Style', 'dfd'),
									'param_name'  =>	'main_strip_font_style',
									'group' => 'Advanced Settings',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Main Strip Title Font Size', 'dfd'),
									'param_name' => 'swatch_main_strip_font_size',
									'value' => 16,
									'min' => 1,
									'max' => 72,
									'suffix' => 'px',
									//'description' => __('', 'smile'),
									'group' => 'Advanced Settings',
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Main Strip Title Font Style', 'dfd'),
									'param_name' => 'swatch_main_strip_font_style',
									'value' => array(
										__('Normal','dfd') => 'normal',
										__('Bold','dfd') => 'bold',
										__('Italic','dfd') => 'italic',
									),
									//'description' => __('', 'smile'),
									'group' => 'Advanced Settings',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Main Strip Title Color:', 'dfd'),
									'param_name' => 'swatch_main_strip_color',
									'value' => '',
									'description' => '',
									'group' => 'Advanced Settings',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Main Strip Title Background Color:', 'dfd'),
									'param_name' => 'swatch_main_strip_bg_color',
									'value' => '',
									//'description' => '',
									'group' => 'Advanced Settings',
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Main Strip Title Highlight Font Size', 'dfd'),
									'param_name' => 'swatch_main_strip_highlight_font_size',
									'value' => 16,
									'min' => 1,
									'max' => 72,
									'suffix' => 'px',
									//'description' => __('', 'smile'),
									'group' => 'Advanced Settings',
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Main Strip Title Highlight Font Weight', 'dfd'),
									'param_name' => 'swatch_main_strip_highlight_font_weight',
									'value' => array(
										__('Normal','dfd') => 'normal',
										__('Bold','dfd') => 'bold',
										__('Italic','dfd') => 'italic',
									),
									//'description' => __('', 'smile'),
									'group' => 'Advanced Settings',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Main Strip Title Highlight Color', 'dfd'),
									'param_name' => 'swatch_main_strip_highlight_color',
									'value' => '',
									//'description' => '',
									'group' => 'Advanced Settings',
								),
							)
						)
					); // vc_map

					vc_map( 
						array(
							'name' => __('Swatch Book Item', 'dfd'),
							'base' => 'swatch_item',
							'class' => 'vc_swatch_item',
							'icon' => 'vc_swatch_item',
							'content_element' => true,
							'as_child' => array('only' => 'swatch_container'),
							'is_container' => false,
							'params' => array(
								array(
									'type' => 'textfield',
									'class' => '',
									'heading' => __('Strip Title Text', 'dfd'),
									'param_name' => 'swatch_strip_text',
									'value' => '',
									//'description' => '',
								),
															array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon to display:', 'dfd'),
									'param_name' => 'icon_type',
									'value' => array(
										'Font Icon Manager' => 'selector',
										'Custom Image Icon' => 'custom',
									),
									'description' => __('Use an existing font icon or upload a custom image.', 'dfd')
								),
								array(
									'type' => 'icon_manager',
									'class' => '',
									'heading' => __('Select Icon ','dfd'),
									'param_name' => 'icon',
									'value' => '',
									'description' => __('Click and select icon of your choice. If you can\'t find the one that suits for your purpose','dfd').', '.__('you can','dfd').' <a href="admin.php?page=font-icon-Manager" target="_blank">'.__('add new here','dfd').'</a>.',
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),
								),
								array(
									'type' => 'ult_img_single',
									'class' => '',
									'heading' => __('Upload Image Icon:', 'dfd'),
									'param_name' => 'icon_img',
									'value' => '',
									'description' => __('Upload the custom image icon.', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('custom')),
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
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Color', 'dfd'),
									'param_name' => 'icon_color',
									'value' => '#333333',
									'description' => __('Give it a nice paint!', 'dfd'),
									'dependency' => Array('element' => 'icon_type','value' => array('selector')),						
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
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Background Color', 'dfd'),
									'param_name' => 'icon_color_bg',
									'value' => '#ffffff',
									'description' => __('Select background color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'icon_style', 'value' => array('circle','square','advanced')),
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Icon Border Style', 'dfd'),
									'param_name' => 'icon_border_style',
									'value' => array(
										__('None','dfd') => '',
										__('Solid','dfd')=> 'solid',
										__('Dashed','dfd') => 'dashed',
										__('Dotted','dfd') => 'dotted',
										__('Double','dfd') => 'double',
										__('Inset','dfd') => 'inset',
										__('Outset','dfd') => 'outset',
									),
									'description' => __('Select the border style for icon.','dfd'),
									'dependency' => Array('element' => 'icon_style', 'value' => array('advanced')),
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Border Color', 'dfd'),
									'param_name' => 'icon_color_border',
									'value' => '#333333',
									'description' => __('Select border color for icon.', 'dfd'),	
									'dependency' => Array('element' => 'icon_border_style', 'not_empty' => true),
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
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Animation','dfd'),
									'param_name' => 'icon_animation',
									'value' => array(
										__('No Animation','dfd') => '',
										__('Swing','dfd') => 'swing',
										__('Pulse','dfd') => 'pulse',
										__('Fade In','dfd') => 'fadeIn',
										__('Fade In Up','dfd') => 'fadeInUp',
										__('Fade In Down','dfd') => 'fadeInDown',
										__('Fade In Left','dfd') => 'fadeInLeft',
										__('Fade In Right','dfd') => 'fadeInRight',
										__('Fade In Up Long','dfd') => 'fadeInUpBig',
										__('Fade In Down Long','dfd') => 'fadeInDownBig',
										__('Fade In Left Long','dfd') => 'fadeInLeftBig',
										__('Fade In Right Long','dfd') => 'fadeInRightBig',
										__('Slide In Down','dfd') => 'slideInDown',
										__('Slide In Left','dfd') => 'slideInLeft',
										__('Slide In Left','dfd') => 'slideInLeft',
										__('Bounce In','dfd') => 'bounceIn',
										__('Bounce In Up','dfd') => 'bounceInUp',
										__('Bounce In Down','dfd') => 'bounceInDown',
										__('Bounce In Left','dfd') => 'bounceInLeft',
										__('Bounce In Right','dfd') => 'bounceInRight',
										__('Rotate In','dfd') => 'rotateIn',
										__('Light Speed In','dfd') => 'lightSpeedIn',
										__('Roll In','dfd') => 'rollIn',
										),
									'description' => __('Like CSS3 Animations? We have several options for you!','dfd')
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Strip Title Font Size', 'dfd'),
									'param_name' => 'swatch_strip_font_size',
									'value' => 16,
									'min' => 1,
									'max' => 72,
									'suffix' => 'px',
									//'description' => __('', 'smile'),
									'group' => 'Advanced Settings',
								),
								array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Strip Title Font Weight', 'dfd'),
									'param_name' => 'swatch_strip_font_weight',
									'value' => array(
										__('Normal','dfd') => 'normal',
										__('Bold','dfd') => 'bold',
										__('Italic','dfd') => 'italic',
									),
									//'description' => __('', 'smile'),
									'group' => 'Advanced Settings',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Strip Title Color:', 'dfd'),
									'param_name' => 'swatch_strip_font_color',
									'value' => '',
									'description' => '',
									'group' => 'Advanced Settings',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Strip Title Background Color:', 'dfd'),
									'param_name' => 'swatch_strip_title_bg_color',
									'value' => '',
									//'description' => '',
									'group' => 'Advanced Settings',
								),
								array(
									'type' => 'colorpicker',
									'class' => '',
									'heading' => __('Strip Background Color:', 'dfd'),
									'param_name' => 'swatch_strip_bg_color',
									'value' => '',
									//'description' => '',
									'group' => 'Advanced Settings',
								),
							)
						)
					); // vc_map
				}
			}

			function swatch_container($atts,$content=null){
				$swatch_style = $swatch_index_center = $swatch_space_degree = $swatch_trans_speed = $swatch_distance_sibling = $swatch_init_closed = $swatch_open_at
	 = $swatch_width = $swatch_height = $swatch_trans_bg_img = $swatch_main_strip_text = $swatch_main_strip_highlight_text = $swatch_main_strip_font_size = $swatch_main_strip_font_style = $swatch_main_strip_color = $swatch_main_strip_highlight_font_size = $swatch_main_strip_highlight_font_weight = $swatch_main_strip_highlight_color = $swatch_main_strip_bg_color = $main_strip_font_family = $main_strip_font_style = '';

				extract(shortcode_atts(array(
					'swatch_style' => 'style-1',
					'swatch_index_center' => '1',
					'swatch_space_degree' => '1',
					'swatch_trans_speed' => '500',
					'swatch_distance_sibling' => '1',
					'swatch_init_closed' => 'on',
					'swatch_open_at' => '1',
					'swatch_width' => '130',
					'swatch_height' => '400',
					'swatch_trans_bg_img' => '',
					'swatch_main_strip_text' => '',
					'swatch_main_strip_highlight_text' => '',
					'swatch_main_strip_font_size' => '16',
					'swatch_main_strip_font_style' => 'normal',
					'swatch_main_strip_color' => '',
					'swatch_main_strip_highlight_font_size' => '16',
					'swatch_main_strip_highlight_font_weight' => 'normal',
					'swatch_main_strip_highlight_color' => '',
					'swatch_main_strip_bg_color' => '',
					'main_strip_font_family' => '',
					'main_strip_font_style' => '',
				),$atts));
				$output = $img = $style = $highlight_style = $main_style = '';
				$uid = uniqid();
				if($swatch_trans_bg_img !== ''){
					// $img = wp_get_attachment_image_src( $swatch_trans_bg_img, 'large');
					// $img = $img[0];
					$img = apply_filters('ult_get_img_single', $swatch_trans_bg_img, 'url');
					$this->swatch_trans_bg_img = $swatch_trans_bg_img;
					$style .= 'background-image: url('.esc_url($img).');';
				}
				if($swatch_width !== ''){
					$style .= 'width:'.esc_attr($swatch_width).'px;';
					$this->swatch_width = $swatch_width;
				}
				if($swatch_height !== ''){
					$style .= 'height:'.esc_attr($swatch_height).'px;';
					$this->swatch_height = $swatch_height;
				}

				if($swatch_main_strip_highlight_font_size !== ''){
					$highlight_style .= 'font-size:'.esc_attr($swatch_main_strip_highlight_font_size).'px;';
				}
				if($swatch_main_strip_highlight_font_weight !== ''){
					$highlight_style .= 'font-weight:'.esc_attr($swatch_main_strip_highlight_font_weight).';';
				}
				if($swatch_main_strip_highlight_color !== ''){
					$highlight_style .= 'color:'.esc_attr($swatch_main_strip_highlight_color).';';
				}

				if($main_strip_font_family != '') {
					$mhfont_family = get_ultimate_font_family($main_strip_font_family);
					$main_style .= 'font-family:\''.esc_attr($mhfont_family).'\';';
				}
				$main_style .= get_ultimate_font_style($main_strip_font_style);
				if($swatch_main_strip_font_size !== ''){
					$main_style .= 'font-size:'.esc_attr($swatch_main_strip_font_size).'px;';
				}
				if($swatch_main_strip_font_style !== ''){
					$main_style .= 'font-weight:'.esc_attr($swatch_main_strip_font_style).';';
				}
				if($swatch_main_strip_color !== ''){
					$main_style .= 'color:'.esc_attr($swatch_main_strip_color).';';
				}
				if($swatch_main_strip_bg_color !== ''){
					$main_style .= 'background:'.esc_attr($swatch_main_strip_bg_color).';';
				}

				$output .= '<div id="ulsb-container-'.esc_attr($uid).'" class="ulsb-container ulsb-'.esc_attr($swatch_style).'" style="width:'.esc_attr($swatch_width).'px; height:'.esc_attr($swatch_height).'px;">';
				$output .= do_shortcode($content);
				$output .= '<div class="ulsb-strip highlight-strip" style="'.$style.'">';
				$output .= '<h4 class="strip_main_text" style="'.$main_style.'"><span>'.$swatch_main_strip_text.'</span></h4>';
				$output .= '<h5 class="strip_highlight_text" style="'.$highlight_style.'"><span>'.$swatch_main_strip_highlight_text.'</span></h5>';
				$output .= '</div>';
				$output .= '</div>';
				$output .= '<script type="text/javascript">
							jQuery(function() {';
				if($swatch_style == 'style-1'){
						$output .= 'jQuery( "#ulsb-container-'.esc_js($uid).'" ).swatchbook();';
				}
				if($swatch_style == 'style-2'){
						$output .= 'jQuery( "#ulsb-container-'.esc_js($uid).'" ).swatchbook( {
										angleInc : -10,
										proximity : -45,
										neighbor : -4,
										closeIdx : 11
									} );';
				}
				if($swatch_style == 'style-3'){
						$output .= 'jQuery( "#ulsb-container-'.esc_js($uid).'" ).swatchbook( {
										angleInc : 15,
										neighbor : 15,
										initclosed : true,
										closeIdx : 11
									} );';
				}
				if($swatch_style == 'style-4'){
						$output .= 'jQuery( "#ulsb-container-'.esc_js($uid).'" ).swatchbook( {
										speed : 500,
										easing : "ease-out",
										center : 7,
										angleInc : 14,
										proximity : 40,
										neighbor : 2
									} );';
				}
				if($swatch_style == 'style-5'){
						$output .= 'jQuery( "#ulsb-container-'.esc_js($uid).'" ).swatchbook( {	openAt : 0	} );';
				}
				if($swatch_style == 'custom'){
					$swatch_options = '';
					if($swatch_trans_speed !== '') {
						$swatch_options .= 'speed : '.esc_js($swatch_trans_speed).',';
					}
					if($swatch_index_center !== '') {
						$swatch_options .= 'center : '.esc_js($swatch_index_center).',';
					}
					if($swatch_space_degree !== '') {
						$swatch_options .= 'angleInc : '.esc_js($swatch_space_degree).',';
					}
					if($swatch_distance_sibling !== '') {
						$swatch_options .= 'neighbor : '.esc_js($swatch_distance_sibling).',';
					}
					if($swatch_open_at !== '') {
						$swatch_options .= 'openAt : '.esc_js($swatch_open_at).',';
					}
					if($swatch_init_closed === 'on'){
						$swatch_init_closed = 'true';
					} else {
						$swatch_init_closed = 'false';
					}
						$swatch_options .= 'closeIdx : '.esc_js($swatch_init_closed).',';
						$output .= 'jQuery( "#ulsb-container-'.esc_js($uid).'" ).swatchbook( {
										'.$swatch_options.'
										easing : "ease-out",
										proximity : 40,
									} );';
				}
				$output .= '});';
				$output .= 'jQuery(document).ready(function(e) {
							var ult_strip = jQuery(".highlight-strip");
							ult_strip.each(function(index, element) {
								var strip_main_text = jQuery(this).children(".strip_main_text").outerHeight();
								var height = '.esc_js($swatch_height).'-strip_main_text;
								jQuery(this).children(".strip_highlight_text").css("height",height);
							});
						});';
				$output .= '</script>';
				return $output;
			}

			function swatch_item($atts,$content=null){
				$icon_type = $icon_img = $img_width = $icon = $icon_color = $icon_color_bg = $icon_size = $icon_style = $icon_border_style = $icon_border_radius = $icon_color_border = $icon_border_size = $icon_border_spacing = $el_class = $icon_animation = $swatch_strip_font_size = $swatch_strip_font_weight =  $swatch_strip_font_color = $swatch_strip_bg_color = $swatch_strip_title_bg_color = '';
				extract(shortcode_atts(array(
					'swatch_strip_text' => '',
					'icon_type' => '',
					'icon' => '',
					'icon_img' => '',
					'img_width' => '',
					'icon_size' => '',				
					'icon_color' => '',
					'icon_style' => '',
					'icon_color_bg' => '',
					'icon_color_border' => '',			
					'icon_border_style' => '',
					'icon_border_size' => '',
					'icon_border_radius' => '',
					'icon_border_spacing' => '',
					'icon_animation' => '',
					'swatch_strip_font_size' => '',
					'swatch_strip_font_weight' => '',
					'swatch_strip_font_color' => '',
					'swatch_strip_bg_color' => '',
					'swatch_strip_title_bg_color' => '',
					'el_class' => '',
				),$atts));
				$output = '';
				$box_icon = do_shortcode('[just_icon icon_type="'.$icon_type.'" icon="'.$icon.'" icon_img="'.$icon_img.'" img_width="'.$img_width.'" icon_size="'.$icon_size.'" icon_color="'.$icon_color.'" icon_style="'.$icon_style.'" icon_color_bg="'.$icon_color_bg.'" icon_color_border="'.$icon_color_border.'"  icon_border_style="'.$icon_border_style.'" icon_border_size="'.$icon_border_size.'" icon_border_radius="'.$icon_border_radius.'" icon_border_spacing="'.$icon_border_spacing.'" icon_animation="'.$icon_animation.'"]');
				$style = '';
				if($this->swatch_trans_bg_img !== ''){
					// $img = wp_get_attachment_image_src( $this->swatch_trans_bg_img, 'large');
					// $img = $img[0];
					$img = apply_filters('ult_get_img_single', $this->swatch_trans_bg_img, 'url');
					$style .= 'background-image: url('.esc_url($img).');';
				}
				if($swatch_strip_bg_color !== ''){
					$style .= 'background-color: '.esc_attr($swatch_strip_bg_color).';';
				}
				if($this->swatch_width !== ''){
					$style .= 'width:'.esc_attr($this->swatch_width).'px;';
				}
				if($this->swatch_height!== ''){
					$style .= 'height:'.esc_attr($this->swatch_height).'px;';
				}
				$output .= '<div class="ulsb-strip '.esc_attr($el_class).'" style="'.$style.'">';
				$output .= '<span class="ulsb-icon">'.$box_icon.'</span>';
				$output .= '<h4 style="color:'.esc_attr($swatch_strip_font_color).'; background:'.esc_attr($swatch_strip_title_bg_color).'; font-size:'.esc_attr($swatch_strip_font_size).'px; font-style: '.esc_attr($swatch_strip_font_weight).';"><span>'.$swatch_strip_text.'</span></h4>';
				$output .= '</div>';
				return $output;
			}
		}
	}


	global $Ultimate_Swatch_Book;
	$Ultimate_Swatch_Book = new Ultimate_Swatch_Book;
	if(class_exists('WPBakeryShortCodesContainer'))
	{
		class WPBakeryShortCode_swatch_container extends WPBakeryShortCodesContainer {
			function content( $atts, $content = null ) {
				global $Ultimate_Swatch_Book;
				return $Ultimate_Swatch_Book->swatch_container($atts, $content);
			}

		}
		class WPBakeryShortCode_swatch_item extends WPBakeryShortCode {
			function content( $atts, $content = null ) {
				global $Ultimate_Swatch_Book;
				return $Ultimate_Swatch_Book->swatch_item($atts, $content);
			}
		}
	}
}