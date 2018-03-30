<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(!class_exists('Dfd_Delimiter')) {
	class Dfd_Delimiter {
		function __construct() {
			
			add_action('admin_enqueue_scripts', array($this, 'dfd_delimiter_param_scripts'));

			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('dfd_delimiter', array($this, 'dfd_delimiter_param'), get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/admin/vc_extend/js/dfd_delimiter.js');
			}
		}

		function dfd_delimiter_param($settings, $value) {
			$positions = $settings['positions'];
			$label = isset($settings['label_border']) ? $settings['label_border'] : __('Delimiter Style','dfd');
			$unit = isset($settings['unit']) ? $settings['unit'] : 'px';

			$html  = '<div class="dfd-delimiter">';

			$html .= '<div class="label">'.esc_html($label).'</div>';
			$html .= '<div class="dfd-delimiter-style-section">';
			$html .= '    <div class="dfd-select-wrap">';
			$html .= '        <select class="dfd-select dfd-border-bottom-style">';
			$html .= '            <option value="none">'.__('None', 'ultimate_vc').'</option>';
			$html .= '            <option value="solid">'.__('Solid', 'ultimate_vc').'</option>';
			$html .= '            <option value="dotted">'.__('Dotted', 'ultimate_vc').'</option>';
			$html .= '            <option value="dashed">'.__('Dashed', 'ultimate_vc').'</option>';
			$html .= '            <option value="hidden">'.__('Hidden', 'ultimate_vc').'</option>';
			$html .= '            <option value="double">'.__('Double', 'ultimate_vc').'</option>';
			$html .= '            <option value="groove">'.__('Groove', 'ultimate_vc').'</option>';
			$html .= '            <option value="ridge">'.__('Ridge', 'ultimate_vc').'</option>';
			//$html .= '            <option value="inset">'.__('Inset', 'ultimate_vc').'</option>';
			//$html .= '            <option value="outset">'.__('Outset', 'ultimate_vc').'</option>';
			$html .= '            <option value="initial">'.__('Initial', 'ultimate_vc').'</option>';
			$html .= '            <option value="inherit">'.__('Inherit', 'ultimate_vc').'</option>';
			$html .= '        </select>';
			$html .= '    </div>';
			$html .= '</div>';

			$label = (isset($settings['label_width']) && $settings['label_width']!='' ) ? $label = $settings['label_width'] : __('Border Width','dfd');
			$html .= '<div class="dfd-delim-settings-fields" >';
			$html .= '    <div class="label">';
			$html .=        esc_html($label);
			$html .= '    </div>';
			
				foreach($positions as $key => $class) {
					$html .= $this->dfd_delimiter_param_item($unit, $class, $key, strtolower($key));
				}

				//  set units - px, em, %
				$html .= '<div class="dfd-select-wrap dfd-units-wrap">';
				$html .= '  <select class="dfd-select dfd-units">';
				switch($unit) {
				  case "px":  $html .= '  <option value="px" selected>px</option>';
							  $html .= '  <option value="em">em</option>';
					  break;
				  case "em":  $html .= '  <option value="em" selected>em</option>';
							  $html .= '  <option value="px">px</option>';
					  break;
				}
				$html .= '  </select>';
				$html .= '</div>';
			$html .= '</div>';

			//  add color picker
			$label = esc_html__('Delimiter Color', 'dfd');
			if(isset($settings['label_color']) && $settings['label_color']!='' ) { $label = $settings['label_color']; }
			$html .= '  <div class="dfd-colorpicker-section">';
			$html .= '		<div class="label">';
			$html .=			esc_html($label);
			$html .= '		</div>';
			$html .= '		<div class="vc_font_container_form_field-color-container wp-picker-container">';
			$html .= '			<input name="" class="dfd-border-bottom-color cs-wp-color-picker" type="text" value="" />';
			$html .= '		</div>';
			$html .= '  </div>';

			$html .= '  <input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value dfd-delimiter-value '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value.'" />';
			$html .= '</div>';
			return $html;
		}
		function dfd_delimiter_param_item($unit, $class, $key, $id) {
			$html  = '  <div class="dfd-delimiter-option-value">';
			$html .= '		<input type="text" class="dfd-delimiter-input dfd-'.esc_attr(strtolower($class)).'" placeholder="'.esc_attr($key).'" />';
			$html .= '  </div>';
			return $html;
		}

		function dfd_delimiter_param_scripts($hook) {
			wp_register_style('dfd-delimiter-style',get_template_directory_uri().'/inc/vc_custom/dfd_vc_addons/admin/vc_extend/css/dfd-delimiter.css');

			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'dfd-delimiter-style' );

			wp_enqueue_script('ultimate-chosen-script');
		}
	}
}
if(class_exists('Dfd_Delimiter')) {
	$Dfd_Delimiter = new Dfd_Delimiter();
}