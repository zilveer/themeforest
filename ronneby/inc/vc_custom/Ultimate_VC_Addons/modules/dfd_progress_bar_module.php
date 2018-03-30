<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: Facts Module
*/
if(!class_exists('Dfd_Progress_Bar')) 
{
	class Dfd_Progress_Bar{
		function __construct(){
			add_action('init',array($this,'dfd_progress_bar_init'));
			add_shortcode('dfd_progress_bar',array($this,'dfd_progress_bar_shortcode'));
		}
		function dfd_progress_bar_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
						'name' => __('Progress bar','dfd'),
						'base' => 'dfd_progress_bar',
						'class' => 'vc_info_banner_icon',
						'icon' => 'vc_icon_info_banner',
						'category' => __('Ronneby 1.0','dfd'),
						//'deprecated' => '4.6',
						'description' => __('Displays progress bar','dfd'),
						'params' => array(
							array(
								'type' => 'number',
								'class' => '',
								'heading' => __('Progress value', 'dfd'),
								'param_name' => 'progress_value',
								'value' => 100,
								'min' => 0,
								'max' => 100,
							),
					   		array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Title','dfd'),
								'param_name' => 'progress_title',
								'admin_label' => true,
								'value' => '',
								'description' => ''
							),
							array(
								'type' => 'checkbox',
								'class' => '',
								'heading' => __('Animate progress','dfd'),
								'param_name' => 'animate_progress',
								'value' => array('Yes, please' => 'yes'),
							),
							array(
								'type' => 'colorpicker',
								'class' => '',
								'heading' => __('Progress Bar Background Color:', 'dfd'),
								'param_name' => 'bar_bg_color',
								'value' => '',
								'description' => __('Select the background color for for progress bar.', 'dfd'),								
							),
							array(
								'type' => 'textfield',
								'class' => '',
								'heading' => __('Custom CSS Class', 'dfd'),
								'param_name' => 'el_class',
								'value' => '',
								'description' => __('Custom CSS class', 'dfd'),
								
							),
							array(
							   "type"        => "dropdown",
							   "class"       => "",
							   "heading"     => __( "Animation", 'dfd' ),
							   "param_name"  => "module_animation",
							   "value"       => dfd_module_animation_styles(),
							   "description" => __( "", 'dfd' ),
							   "group"       => "Animation Settings",
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_progress_bar_shortcode($atts){
			$output = $progress_value = $progress_title = $animate_progress= $module_animation = $bar_bg_color = $el_class = '';
			
			extract(shortcode_atts( array(
				'progress_value' => '100',
				'progress_title' => '',
				'animate_progress' => '',
				'bar_bg_color' => '',
				'module_animation' => '',
				'el_class'=>'',
			),$atts));
			
			$progress_class = $progress_anim_data = $progress_css = '';

			$animate = $animation_data = '';

			if ( ! ( $module_animation == '' ) ) {
				$animate        = ' cr-animate-gen';
				$animation_data = 'data-animate-type = "' . esc_attr($module_animation) . '" ';
			}
			
			if($animate_progress != '') {
				$progress_class .= ' cr-animate-gen';
				$progress_anim_data .= 'data-animate-type="transition.expand"';
			}
			
			$output .= '<div class="dfd-progress '.esc_attr($el_class).' '.esc_attr($animate).'" '.$animation_data.'>';
				
				$output .= '<div class="progress">';
					
					if($progress_value != '') {
						if($bar_bg_color != '') {
							$progress_css .= 'background: '.esc_attr($bar_bg_color).';';
						}
						$progress_css .= 'width: '.esc_attr($progress_value).'%;';
						$output .= '<div class="label-wrap">';
							if($progress_title != '') {
								$output .= '<label>'. $progress_title .'</label>';
							}
							$output .= '<span class="skill-percent">'. $progress_value .'<span>%</span></span>';
						$output .= '</div>';
						$output .= '<div class="progress-bar">';
							$output .= '<div class="meter '.esc_attr($progress_class).'" '.$progress_anim_data.' style="'. $progress_css .';">';
							$output .= '</div>';
						$output .= '</div>';
					}

				$output .= '</div>';
			$output .= '</div>';
			
			return $output;
		}
	}
}
if(class_exists('Dfd_Progress_Bar'))
{
	$Dfd_Progress_Bar = new Dfd_Progress_Bar;
}
