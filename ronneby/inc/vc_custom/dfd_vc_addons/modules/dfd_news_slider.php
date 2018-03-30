<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/*
* Add-on Name: News slider module
*/
if(!class_exists('Dfd_News_Slider') && class_exists('News_Page_Slider')) {
	class Dfd_News_Slider{
		function __construct(){
			add_action('init',array($this,'dfd_news_slider_init'));
			add_shortcode('dfd_news_slider',array($this,'dfd_news_slider_shortcode'));
		}
		function dfd_news_slider_init(){
			if(function_exists('vc_map')) {
				vc_map(
					array(
					   'name' => __('News page slider','dfd'),
					   'base' => 'dfd_news_slider',
					   'class' => 'vc_info_banner_icon',
					   'icon' => 'vc_icon_info_banner',
					   'category' => __('Ronneby 2.0','dfd'),
					   'description' => __('','dfd'),
					   'params' => array(
							array(
								'type' => 'dropdown',
								'class' => '',
								'heading' => __('Slider','dfd'),
								'param_name' => 'slider',
								'value' => $this->dfd_get_sliders(),
							),
							array(
								'type' => 'textfield',
								'heading' => __('Extra class name', 'js_composer'),
								'param_name' => 'el_class',
								'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer')
							),
						),
					)
				);
			}
		}
		// Shortcode handler function
		function dfd_news_slider_shortcode($atts) {
			$output = $el_class = $slider = '';
			
			extract(shortcode_atts( array(
				'slider' => '',
				'el_class' => '',
			),$atts));
			
			if(!empty($slider)) {
				$slider = '[news_page_slider id="'. esc_attr($slider) .'"]';
				ob_start();
				
				echo do_shortcode($slider);

				$output .= ob_get_clean();
			}
			return $output;
		}
		function dfd_get_sliders() {
			global $wpdb;
			$table_name = $wpdb->prefix . 'news_page_slider';

			// Order
			$order = 'ASC';
			//Max sliders number
			$limit = 200;
			// Get sliders
			$sliders = $wpdb->get_results("SELECT * FROM $table_name
										ORDER BY id $order LIMIT " . (int)$limit . "", ARRAY_A);

			$slider_options = array();
			if(!empty($sliders) && is_array($sliders)) {
				$slider_options[__('Select slider','dfd')] = '';
				foreach($sliders as $key => $val) {
					$slider_options[$val['name']] = esc_attr($val['id']);
				}
				return $slider_options;
			}
			return false;
		}
	}
}
if(class_exists('Dfd_News_Slider')) {
	$Dfd_News_Slider = new Dfd_News_Slider;
}
