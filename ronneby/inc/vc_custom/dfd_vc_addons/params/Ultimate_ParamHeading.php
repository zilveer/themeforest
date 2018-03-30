<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_Heading_Param')) {
	class Dfd_Heading_Param {
		function __construct() {
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('ult_param_heading' , array($this, 'dfd_heading_param_callback'));
			}
		}
	
		function dfd_heading_param_callback($settings, $value) {
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$text = isset($settings['text']) ? $settings['text'] : '';
			$output = '<h4 class="wpb_vc_param_value '.esc_attr($class).'">'.$text.'</h4>';
			//$output .= '<input type="hidden" class="wpb_vc_param_value ultimate-param-heading '.esc_attr($settings['param_name'].' '.$settings['type']).'_field" value="'.$value.'" />';
			return $output;
		}
		
	}
	
	$Dfd_Heading_Param = new Dfd_Heading_Param();
}
