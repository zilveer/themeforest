<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Ultimate_DateTime_Picker_Param'))
{
	class Ultimate_DateTime_Picker_Param
	{
		function __construct() {	
			if(function_exists('vc_add_shortcode_param')) {
				//vc_add_shortcode_param('datetimepicker' , array($this, 'datetimepicker'));
				vc_add_shortcode_param('datetimepicker' , array($this, 'datetimepicker'), get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/admin/js/bootstrap-datetimepicker.min.js');
			}
		}
	
		function datetimepicker($settings, $value) {
			//$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$output = '<div class="ult-datetime"><input data-format="yyyy/MM/dd hh:mm:ss" readonly class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" style="width:258px;" value="'.$value.'" /><span class="add-on"><span class="dashicons dashicons-calendar-alt"></span></span></div>';
			return $output;
		}
		
	}
}

if(class_exists('Ultimate_DateTime_Picker_Param')) {
	$Ultimate_DateTime_Picker_Param = new Ultimate_DateTime_Picker_Param();
}
