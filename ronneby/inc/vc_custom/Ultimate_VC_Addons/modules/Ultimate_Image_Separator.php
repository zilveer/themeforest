<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Image Separator
*/
global $dfd_ronneby;
if(isset($dfd_ronneby['enable_default_addons']) && strcmp($dfd_ronneby['enable_default_addons'], '1') === 0) {
	if(!class_exists('Ultimate_Image_Separator')) {
		class Ultimate_Image_Separator{
			function __construct(){
				add_action('init',array($this,'ultimate_img_separator_init'));
				add_shortcode('ultimate_img_separator',array($this,'ultimate_img_separator_shortcode'));
				add_action('wp_enqueue_scripts', array($this, 'register_easy_separator_assets'),1);
			}
			function register_easy_separator_assets() {
				wp_register_style('ult-easy-separator-style',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-css/image-separator.min.css',array(), null);
				wp_register_script('ult-easy-separator-script',get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/min-js/image-separator.min.js',array('jquery'), null);
			}
			function ultimate_img_separator_init(){
				if(function_exists('vc_map')) {
					vc_map(
						array(
						   'name' => __('Image Separator','dfd'),
						   'base' => 'ultimate_img_separator',
						   'class' => 'vc_img_separator_icon',
						   'icon' => 'vc_icon_img_separator',
						   'category' => 'Ultimate VC Addons',
						   'description' => __('Add image as row seperator','dfd'),
						   'params' => array(
								array(
									'type' => 'ult_img_single',
									'heading' => __('Image','dfd'),
									'param_name' => 'img_separator',
								),
								array(
									'type' => 'animator',
									'class' => '',
									'heading' => __('Animation','dfd'),
									'param_name' => 'animation',
									'value' => '',
									'group' => 'Animation'
									//'description' => __('','smile'),
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Animation Duration','dfd'),
									'param_name' => 'animation_duration',
									'value' => 3,
									'min' => 1,
									'max' => 100,
									'suffix' => 's',
									'description' => __('How long the animation effect should last. Decides the speed of effect.','dfd'),
									'group' => 'Animation',

								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Animation Delay','dfd'),
									'param_name' => 'animation_delay',
									'value' => 0,
									'min' => 1,
									'max' => 100,
									'suffix' => 's',
									'description' => __('Delays the animation effect for seconds you enter above.','dfd'),
									'group' => 'Animation'
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Animation Repeat Count','dfd'),
									'param_name' => 'animation_iteration_count',
									'value' => 1,
									'min' => 0,
									'max' => 100,
									'suffix' => '',
									'description' => __('The animation effect will repeat to the count you enter above. Enter 0 if you want to repeat it infinitely.','dfd'),
									'group' => 'Animation'
								),
								array(
									'type' => 'number',
									'class' => '',
									'heading' => __('Viewport Position', 'dfd'),
									'param_name' => 'opacity_start_effect',
									'suffix' => '%',
									//'admin_label' => true,
									'value' => '90',
									'description' => __('The area of screen from top where animation effects will start working.', 'dfd'),
									'group' => 'Animation'
								),

								array(
									'type' => 'ultimate_responsive',
									'heading' => __('Image Size (px)','dfd'),
									'unit'  => 'px',                                  // use '%' or 'px'
									'media' => array(
										'Desktop'           => '',                  // Here '28' is default value set for 'Desktop'
										'Tablet'           => '',
										'Tablet Portrait'   => '',
										'Mobile Landscape'  => '',
										'Mobile'            => '',
									),
									'param_name' => 'img_separator_width'
								),
								array(
									'type' => 'dropdown',
									'heading' => __('Image Position','dfd'),
									'param_name' => 'img_separator_position',
									'value' => array(
										__('Top','dfd') => 'ult-top-easy-separator',
										__('Bottom','dfd') => 'ult-bottom-easy-separator',
									)
								),
								array(
									'type' => 'number',
									'heading' => __('Gutter','dfd'),
									'param_name' => 'img_separator_gutter',
									'suffix' => '%',
									'description' => __('50% is default. Increase to push the image outside or decrease to pull the image inside.','dfd')
								)
							),
						)
					);
				}
			}
			// Shortcode handler function for stats banner
			function ultimate_img_separator_shortcode($atts, $content)
			{			
				$output = $wrapper_class = $custom_position = $opacity_start_effect_data = $animation_style = $animation_el_class = $animation_data = '';
				$img_separator = $animation = $img_separator_width = $img_separator_position = $img_separator_gutter = $opacity = $opacity_start_effect = $animation_duration = $animation_delay = $animation_iteration_count = '';
				$is_animation = false;
				extract(shortcode_atts( array(
					'img_separator' => '',
					'animation' => '',
					'img_separator_width' => '',
					'img_separator_position' => 'ult-top-easy-separator',
					'img_separator_gutter' => '',
					'opacity' => 'set',
					'opacity_start_effect' => '90',
					'animation_duration' => '3',
					'animation_delay' => '1',
					'animation_iteration_count' => '1'
				),$atts));

				$ultimate_custom_vc_row = get_option('ultimate_custom_vc_row');
				if($ultimate_custom_vc_row == '')
					$ultimate_custom_vc_row = 'wpb_row';

				$img = apply_filters('ult_get_img_single', $img_separator, 'url');
				$alt = get_post_meta($img_separator, '_wp_attachment_image_alt', true);

				$id = 'ult-easy-separator-'.uniqid(rand());

				$args = array(
					'target'      =>  '#'.$id,  // set targeted element e.g. unique class/id etc.
					'media_sizes' => array(
					   'width' => $img_separator_width
					), 
				);
				$data_list = get_ultimate_vc_responsive_media_css($args);

				if($img_separator_gutter != '') {
					$wrapper_class = 'ult-easy-separator-no-default';
					if($img_separator_position == 'ult-top-easy-separator') {
						$img_separator_gutter = '-'.$img_separator_gutter;
						//$custom_position = 'top:'.$img_separator_gutter.'%;';
						$custom_position .= 'transform: translate(-50%,'.esc_attr($img_separator_gutter).'%)!important;';
						$custom_position .= '-ms-transform: translate(-50%,'.esc_attr($img_separator_gutter).'%)!important;';
						$custom_position .= '-webkit-transform: translate(-50%,'.esc_attr($img_separator_gutter).'%)!important;';

					} else if($img_separator_position == 'ult-bottom-easy-separator') {
						//$custom_position = 'bottom:'.$img_separator_gutter.'%;';
						$custom_position .= 'transform: translate(-50%,'.esc_attr($img_separator_gutter).'%)!important;';
						$custom_position .= '-ms-transform: translate(-50%,'.esc_attr($img_separator_gutter).'%)!important;';
						$custom_position .= '-webkit-transform: translate(-50%,'.esc_attr($img_separator_gutter).'%)!important;';
					}
				}

				$animation_style .= 'opacity:0;';
				if( strtolower($animation) !== strtolower('No Animation')) {
					$is_animation = true;
					$inifinite_arr = array("InfiniteRotate", "InfiniteDangle","InfiniteSwing","InfinitePulse","InfiniteHorizontalShake","InfiniteBounce","InfiniteFlash","InfiniteTADA");
					if($animation_iteration_count == 0 || in_array($animation,$inifinite_arr)){
						$animation_iteration_count = 'infinite';
						$animation = 'infinite '.esc_attr($animation);
					}
					if($opacity == "set"){
						$animation_el_class .= ' ult-animation ult-animate-viewport ';
						$opacity_start_effect_data = 'data-opacity_start_effect="'.esc_attr($opacity_start_effect).'"';
					}
					$animation_data .= ' data-animate="'.esc_attr($animation).'" ';
					$animation_data .= ' data-animation-delay="'.esc_attr($animation_delay).'" ';
					$animation_data .= ' data-animation-duration="'.esc_attr($animation_duration).'" ';
					$animation_data .= ' data-animation-iteration="'.esc_attr($animation_iteration_count).'" ';
				} else {
					$animation_el_class .= 'ult-no-animation';
				}

				$output = '<div id="'.esc_attr($id).'" class="ult-easy-separator-wrapper ult-responsive '.esc_attr($img_separator_position).' '.esc_attr($wrapper_class).'" style="'.$custom_position.'" data-vc-row="'.esc_attr($ultimate_custom_vc_row).'" '.$data_list.'>';
					$output .= '<div class="ult-easy-separator-inner-wrapper">';
						$output .= '<div class="'.esc_attr($animation_el_class).'" style="'.$animation_style.'"  '.$animation_data.' '.$opacity_start_effect_data.'>';
							$output .= '<img class="ult-easy-separator-img" alt="'.esc_attr($alt).'" src="'.esc_url($img).'" />';
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';

				return $output;
			}
		}
	}
	if(class_exists('Ultimate_Image_Separator')) {
		$Ultimate_Image_Separator = new Ultimate_Image_Separator;
	}
}

?>