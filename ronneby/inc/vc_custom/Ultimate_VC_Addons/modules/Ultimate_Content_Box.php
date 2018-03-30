<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
if(isset($dfd_ronneby['enable_default_addons']) && strcmp($dfd_ronneby['enable_default_addons'], '1') === 0) {
	if(!class_exists('Ult_Content_Box')) {
		class Ult_Content_Box {
			function __construct() {
				add_shortcode("ult_content_box",array($this,"ult_content_box_callback"));
				add_action( 'init', array( $this, 'ult_content_box_init' ) );
				add_action( 'wp_enqueue_scripts', array( $this, 'ult_content_box_scripts' ), 1 );
			}
			function ult_content_box_callback($atts, $content = null){
			  extract( shortcode_atts( array(
						'bg_type' => 'bg_color',
						'bg_image' => '',
						'bg_color' => '',
						'bg_repeat' => 'repeat',
						'bg_size' => 'cover',
						'bg_position' => 'center center',
						'border' => '',
						'box_shadow' => '',
						'box_shadow_color' => '',
						'padding' => '',
						'margin' => '',
						'link' => '',
						'hover_bg_color' => '',
						'hover_border_color' => '',
						'hover_box_shadow' => '',
						'box_hover_shadow_color' => '',
						'min_height' => '',
						'el_class' => '',
						'trans_property' => 'all',
						'trans_duration' => '700',
						'trans_function' => 'ease',
						'responsive_margin' => '',
						/*'img_overlay_hover_effect'	=> '',*/
				  ), $atts ) );

				/* 	init var's 	*/
				$style = $url = $link_title = $target = $responsive_margins = $normal_margins = $hover = $shadow = '';

				if($bg_type!='') {
					switch ($bg_type) {
						case 'bg_color':	/* 	background color 	*/
											if($bg_color!='') {
												$style .= 'background-color:'.esc_attr($bg_color).';';
											}
											if($hover_bg_color!='') {
												$hover .= ' data-hover_bg_color="'.esc_attr($hover_bg_color).'" ';
											}
							break;
						case 'bg_image': 	if($bg_image != '') {
												$img = wp_get_attachment_image_src( $bg_image, 'large');
												$style .= "background-image:url('".esc_url($img[0])."');";
												$style .= 'background-size: '.esc_attr($bg_size).';';
												$style .= 'background-repeat: '.esc_attr($bg_repeat).';';
												$style .= 'background-position: '.esc_attr($bg_position).';';
												$style .= 'background-color: rgba(0, 0, 0, 0);';
											}
						break;
					}
				}


				/* 	box shadow 	*/
				if($box_shadow!='' ) {
					$style .= apply_filters('Ultimate_GetBoxShadow', $box_shadow, 'css');
				}

				/* 	box shadow - {HOVER} 	*/
				if($hover_box_shadow!='' ) {

					$data = apply_filters('Ultimate_GetBoxShadow', $hover_box_shadow, 'data');

					if ( strpos($data,'none') !== false ) {
						$data = 'none';
					}
					//	Apply default box shadow
					if ( strpos($data,'inherit') !== false ) {
						if($box_shadow!='') {
							$data = apply_filters('Ultimate_GetBoxShadow', $box_shadow, 'data');
						}
					}

					$hover .= ' data-hover_box_shadow="'.esc_attr($data).'" ';
				}


				/* 	border 	*/
				if($border!=''){
					$temp_border = str_replace( '|', '', $border );
					$style .= $temp_border;
				}

				/* 	link 	*/
				if($link!='') {
				  $href 		= 	vc_build_link($link);
				  $url 			= 	$href['url'];
				  $link_title	=	$href['title'];
				  $target		=	trim($href['target']);
				}


				/* 	padding  	*/
				if($padding!=''){ 	$style .= $padding; 	}

				/* 	margin 		*/
				if($margin!=''){ 	$style .= $margin; 		}

				// HOVER
				if($hover_border_color!='') { 	$hover .= ' data-hover_border_color="'.esc_attr($hover_border_color).'" '; }
				if($min_height!='') { $style .= 'min-height:'.esc_attr($min_height).'px;'; }

				// Transition Effect
				if($trans_property!='' && $trans_duration!='' && $trans_function!='') {
					$style .= '-webkit-transition: '.esc_attr($trans_property).' '.esc_attr($trans_duration).'ms '.esc_attr($trans_function).';';
					$style .= '-moz-transition: '.esc_attr($trans_property).' '.esc_attr($trans_duration).'ms '.esc_attr($trans_function).';';
					$style .= '-ms-transition: '.esc_attr($trans_property).' '.esc_attr($trans_duration).'ms '.esc_attr($trans_function).';';
					$style .= '-o-transition: '.esc_attr($trans_property).' '.esc_attr($trans_duration).'ms '.esc_attr($trans_function).';';
					$style .= 'transition: '.esc_attr($trans_property).' '.esc_attr($trans_duration).'ms '.esc_attr($trans_function).';';
				}

				/* 	Margins - Responsive 	*/
				if($responsive_margin!='') {
					$responsive_margins .= ' data-responsive_margins="'.$responsive_margin.'" ';
				}
				/* 	Margins - Normal  */
				if($margin!='') {
					$normal_margins .= ' data-normal_margins="'.esc_attr($margin).'" ';
				}

				$output  = '<div class="ult-content-box-container '.esc_attr($el_class).'" >';
				if($link!='') {
					$output .= '	<a class="ult-content-box-anchor" href="'.esc_url($url).'" title="'.esc_attr($link_title).'" target="'.esc_attr($target).'" >';
				}
				$output .= '		<div class="ult-content-box" style="'.$style.'" '.$hover.' '.$responsive_margins.' '.$normal_margins.'>';
				$output .=				do_shortcode( $content );
				$output .= '		</div>';
				if($link!='') {
					$output .= '	</a>';
				}
				$output .= '</div>';

			  return $output;
			}

			function ult_content_box_init() {
				  if(function_exists('vc_map')){
					  vc_map( array(
						  'name' => __('Content Box', 'dfd'),
						  'base' => 'ult_content_box',
						  'icon' => 'content_box',
						  'class' => 'content_box',
						  'as_parent' => array('except' => 'ult_content_box'),
						  //'as_parent' => '',
						  ///'content_element' => true,
						  'controls' => 'full',
						  'show_settings_on_create' => true,
						  //'is_container'    => true,
						  'category' => 'Ultimate VC Addons',
						  'description' => __('Content Box.','dfd'),
						  'js_view' => 'VcColumnView',
						  'params' => array(
								array(
									'type' => 'dropdown',
									'heading' => __('Background Type','dfd'),
									'param_name' => 'bg_type',
									'value' => array(
										__('Background Color','dfd') => 'bg_color',
										__('Background Image','dfd') => 'bg_image',
									),
								),		  		
								/*array(
									'type' => 'dropdown',
									'class' => '',
									'heading' => __('Transition Property','dfd'),
									'param_name' => 'trans_property',
									'value' => array(
										__('All', 'dfd') => 'all',
										__('Background', 'dfd') => 'background',
										__('Color', 'dfd') => 'color',
										__('Height', 'dfd') => 'height',
										__('Width', 'dfd') => 'width',
										__('Outline', 'dfd') => 'outline',
									),
									'group'=> 'Effect',
								),*/
								array(
									'type' => 'colorpicker',
									'heading' => __('Background Color','dfd'),
									'param_name' => 'bg_color',
									'dependency' => Array('element' => 'bg_type', 'value' => 'bg_color' ),
								),
								array(
									'type' => 'attach_image',
									'heading' => __('Background Image', 'dfd'),
									'param_name' => 'bg_image',
									'description' => __('Set background image for content box.', 'dfd'),
									'dependency' => Array('element' => 'bg_type', 'value' => 'bg_image' ),
								),
								array(
									'type' => 'ultimate_border',
									'heading' => __('Border','dfd'),
									'param_name' => 'border',
									'unit'     => 'px',                        						//  [required] px,em,%,all     Default all
									'positions' => array(
										__('Top','dfd')     => '',
										__('Right','dfd')   => '',
										__('Bottom','dfd')  => '',
										__('Left','dfd')    => ''
									),
									//'enable_radius' => false,                   					//  Enable border-radius. default true
									'radius' => array(                          
										__('Top Left','dfd')     => '',                	// use 'Top Left'
										__('Top Right','dfd')    => '',                	// use 'Top Right'
										__('Bottom Right','dfd') => '',                	// use 'Bottom Right'
										__('Bottom Left','dfd')  => ''                 	// use 'Bottom Left'
									),
									//'label_color'   => __('Border Color','dfd'),     	//  label for 'border color'   default 'Border Color'
									//'label_radius'  => __('Border Radius','dfd'), 	//  label for 'radius'  default 'Border Redius'
									//'label_border'  => 'Border Style',       						//  label for 'style'   default 'Border Style'
								),
								array(
									'type' => 'ultimate_boxshadow',
									'heading' => __('Box Shadow', 'dfd'),
									'param_name' => 'box_shadow',
									'unit' => 'px',                        //  [required] px,em,%,all     Default all
									'positions' => array(
										__('Horizontal','dfd')     => '',
										__('Vertical','dfd')   => '',
										__('Blur','dfd')  => '',
										__('Spread','dfd')    => ''
									),
									//'enable_color' => false,
									//'label_style'	=> __('Style','dfd'),
									//'label_color'   => __('Shadow Color','dfd'),
								),
								/*array(
									'type' => 'colorpicker',
									'edit_field_class' => 'vc_col-sm-12 vc_column box_shadow_ultimate_box_shadow_color', 	// color dependency
									'heading' => __('Shadow Color','dfd'),
									'param_name' => 'box_shadow_color',
								),*/

								//	Spacing
								array(
									'type' => 'ult_param_heading',
									'param_name' => 'content_spacing',
									'text' => __('Spacing','dfd'),
									'value' => '',
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
								),
								array(
									'type' => 'ultimate_spacing',
									'heading' => __('Padding', 'dfd'),
									'param_name' => 'padding',
									'mode'  => 'padding',                   	//  margin/padding
									'unit'  => 'px',                       		//  [required] px,em,%,all     Default all
									'positions' => array(                  		//  Also set 'defaults'
									  __('Top','dfd')     => '',
									  __('Right','dfd')   => '',
									  __('Bottom','dfd')  => '',
									  __('Left','dfd')    => ''
									),
								),
								array(
									'type' => 'ultimate_spacing',
									'heading' => __('Margin', 'dfd'),
									'param_name' => 'margin',
									'mode'  => 'margin',                   	//  margin/padding
									'unit'  => 'px',                       		//  [required] px,em,%,all     Default all
									'positions' => array(                  		//  Also set 'defaults'
									  __('Top','dfd')     => '',
									  __('Right','dfd')   => '',
									  __('Bottom','dfd')  => '',
									  __('Left','dfd')    => ''
									),
								),
								array(
									'type' => 'vc_link',
									'heading' => __('Content Box Link','dfd'),
									'param_name' => 'link',
									//'description' => __('', 'dfd'),
									//'dependency' => array('element' => 'img_link_type', 'value' => 'custom'),
								),
								array(
									'type' => 'number',
									'heading' => __('Min Height', 'dfd'),
									'param_name' => 'min_height',
									'suffix'=>'px',
									'min'=>'0',
								),
								array(
									'type' => 'textfield',
									'heading' => __('Extra class name', 'dfd'),
									'param_name' => 'el_class',
									'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dfd')
								),

								//	Background
								array(
									'type' => 'dropdown',
									'heading' => __('Background Image Repeat','dfd'),
									'param_name' => 'bg_repeat',
									'value' => array(
										__('Repeat', 'dfd') => 'repeat',
										__('Repeat X', 'dfd') => 'repeat-x',
										__('Repeat Y', 'dfd') => 'repeat-y',
										__('No Repeat', 'dfd') => 'no-repeat',
									),
									'group' => 'Background',
									'dependency' => Array('element' => 'bg_type', 'value' => 'bg_image' ),
								),
								array(
									'type' => 'dropdown',
									'heading' => __('Background Image Size','dfd'),
									'param_name' => 'bg_size',
									'value' => array(
										__('Cover - Image to be as large as possible', 'dfd') => 'cover',
										__('Contain - Image will try to fit inside the container area', 'dfd') => 'contain',
										__('Initial', 'dfd') => 'initial',
									),
									'group' => 'Background',
									'dependency' => Array('element' => 'bg_type', 'value' => 'bg_image' ),
								),
								array(
									'type' => 'textfield',
									'heading' => __('Background Image Posiiton', 'dfd'),
									'param_name' => 'bg_position',
									'description' => __('You can use any number with px, em, %, etc. Example- 100px 100px.', 'dfd'),
									'group' => 'Background',
									'dependency' => Array('element' => 'bg_type', 'value' => 'bg_image' ),
								),

								//	Hover
								array(
									'type' => 'colorpicker',
									//'class' => '',
									'heading' => __('Background Color','dfd'),
									'param_name' => 'hover_bg_color',
									'dependency' => Array('element' => 'bg_type', 'value' => 'bg_color' ),
									'group' => 'Hover',
								),
								array(
									'type' => 'colorpicker',
									'heading' => __('Border Color','dfd'),
									'param_name' => 'hover_border_color',
									'edit_field_class' => 'vc_col-sm-12 vc_column border_ultimate_border', 	// Custom dependency
									'group' => 'Hover',
								),
								array(
									'type' => 'ultimate_boxshadow',
									'heading' => __('Box Shadow', 'dfd'),
									'param_name' => 'hover_box_shadow',
									'unit'     => 'px',                        //  [required] px,em,%,all     Default all
									'positions' => array(
										__('Horizontal','dfd')     => '',
										__('Vertical','dfd')   => '',
										__('Blur','dfd')  => '',
										__('Spread','dfd')    => ''
									),
									'label_color'   => __('Shadow Color','dfd'),
									//'enable_color' => false,
									//'label_style'	=> __('Style','dfd'),
									//'dependency' => Array('element' => 'img_box_shadow_type', 'value' => 'on' ),
									'group' => 'Hover',
								),
								/*array(
									'type' => 'colorpicker',
									'edit_field_class' => 'vc_col-sm-12 vc_column hover_box_shadow_ultimate_box_shadow_color', 	// color dependency
									'heading' => __('Shadow Color','dfd'),
									'param_name' => 'box_hover_shadow_color',
									'group' => 'Hover',
								),*/

								//	Effect
								array(
									'type' => 'ult_param_heading',
									'param_name' => 'content_transition',
									'text' => __('Transition Options','dfd'),
									'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
									'group' => 'Hover',
								),
								array(
									'type' => 'dropdown',
									//'class' => '',
									'heading' => __('Transition Property','dfd'),
									'param_name' => 'trans_property',
									'value' => array(
										__('All', 'dfd') => 'all',
										__('Background', 'dfd') => 'background',
										__('Color', 'dfd') => 'color',
										__('Height', 'dfd') => 'height',
										__('Width', 'dfd') => 'width',
										__('Outline', 'dfd') => 'outline',
									),
									'group'=> 'Hover',
								),
								array(
									'type' => 'number',
									//'class' => '',
									'heading' => __('Duration', 'dfd'),
									'param_name' => 'trans_duration',
									'suffix'=>'ms',
									'min'=>'0',
									'value' => '',
									'group'=> 'Hover',
								),
								array(
									'type' => 'dropdown',
									//'class' => '',
									'heading' => __('Transition Effect','dfd'),
									'param_name' => 'trans_function',
									'value' => array(
										__('Ease', 'dfd') => 'ease',
										__('Linear', 'dfd') => 'linear',
										__('Ease-In', 'dfd') => 'ease-in',
										__('Ease-Out', 'dfd') => 'ease-out',
										__('Ease-In-Out', 'dfd') => 'ease-in-out',
									),
									'group'=> 'Hover',
								),

								// Responsive
								array(
									'type' => 'ultimate_spacing',
									'heading' => __('Margin', 'dfd'),
									'param_name' => 'responsive_margin',
									'mode'  => 'margin',                   		//  margin/padding
									'unit'  => 'px',                       		//  [required] px,em,%,all     Default all
									'positions' => array(                  		//  Also set 'defaults'
									  __('Top','dfd')     => '',
									  __('Right','dfd')   => '',
									  __('Bottom','dfd')  => '',
									  __('Left','dfd')    => ''
									),
									'group' => __( 'Responsive', 'dfd' ),
									'description' => __( 'This margin will apply below screen 768px.', 'dfd' )
								),
							),
					  ) );
				  }
			}
			function ult_content_box_scripts() {
				wp_register_style( 'ult_content_box_css', get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/content-box.min.css' );
				wp_register_script('ult_content_box_js', get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/content-box.min.js', array('jquery'), null, true);
			}
		}
		// Finally initialize code
		new Ult_Content_Box;
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			class WPBakeryShortCode_ult_content_box extends WPBakeryShortCodesContainer {
			}
		}
	}
}
