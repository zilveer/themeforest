<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!class_exists('Dfd_VC_Row_Background')) {
	class Dfd_VC_Row_Background {
		
		private $base_dir = 'inc/vc_custom/dfd_vc_background/';
				
		function get_template_names() {
			$dir = locate_template($this->base_dir . 'admin_templates');
			if(!$dir) return;

			if(is_dir($dir)) {
				$options_array = array(
					esc_attr__('None','dfd') => ''
				);
				$dir_content = scandir($dir);
				if(!empty($dir_content) && is_array($dir_content)) {
					foreach($dir_content as $item) {
						if(substr_count($item, '.php') == 1) {
							$val = substr($item, 0, -4);
							$options_array[$val] = $val;
						}
					}
				}
				return $options_array;
			}
			return;
		}

		function get_template_files() {
			$dir = locate_template($this->base_dir . 'admin_templates');
			
			if(!$dir) return false;
			
			if(is_dir($dir)) {
				foreach(glob($dir.'/*.php') as $file) {
					require_once($file);
				}
				if(isset($row_params) && is_array($row_params)) return $row_params;
			}
			return false;
		}
		
		public function build_backend_options() {
			$bg_variants = $this->get_template_names();
			
			$patterns_list = glob(locate_template($this->base_dir.'patterns').'/*.*');
			$patterns = array();
			
			foreach($patterns_list as $pattern)
				$patterns[basename($pattern)] = get_template_directory_uri().'/'.$this->base_dir.'patterns/'.basename($pattern);

			if(!$bg_variants) return false;

			$row_params = array();
			$row_params[] = array(
				'type' => 'ult_param_heading',
				'text' => esc_html__('Background settings', 'dfd'),
				'param_name' => 'bg_main',
				'class' => '',
				'edit_field_class' => 'ult-param-heading-wrapper no-top-margin vc_column vc_col-sm-12',
				'group' => esc_attr__('Background options', 'dfd')
			);
			$row_params[] = array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => esc_html__('Select Row Background Style', 'dfd'),
				'param_name' => 'bg_check',
				'value' => array(
					esc_attr__('Light background', 'dfd') => '',
					esc_attr__('Dark background', 'dfd') => 'row-background-dark'
				),
				'group' => esc_attr__('Background options', 'dfd')
			);
			$row_params[] = array(
				'type' => 'dropdown',
				'class' => '',
				'heading' => esc_attr__('Background style', 'dfd'),
				'param_name' => 'dfd_bg_style',
				'value' => $bg_variants,
				'group' => esc_attr__('Background options', 'dfd')
			);
			$include_params = $this->get_template_files();
			if($include_params && is_array($include_params)) {
				foreach($include_params as $param) {
					$row_params[] = $param;
				}
			}
			/*
			$row_params[] = array(
				"type" => "ult_switch",
				"class" => "",
				"heading" => __("Fade Effect on Scroll", 'dfd'),
				"param_name" => "dfd_fadeout_row",
				//"admin_label" => true,
				"value" => "",
				"options" => array(
						"fadeout_row_value" => array(
							"label" => "",
							"on" => "Yes",
							"off" => "No",
						)
					),
				'group' => esc_attr__('Background options', 'dfd'),
				"description" => __("If enabled, the the content inside row will fade out slowly as user scrolls down.", 'dfd')
			);
			$row_params[] = array(
				"type" => "number",
				"class" => "",
				"heading" => __("Viewport Position", 'dfd'),
				"param_name" => "dfd_fadeout_start_effect",
				"suffix" => "%",
				//"admin_label" => true,
				"value" => "30",
				'group' => esc_attr__('Background options', 'dfd'),
				"description" => __("The area of screen from top where fade out effect will take effect once the row is completely inside that area.", 'dfd'),
				"dependency" => Array("element" => "fadeout_row", "value" => array("fadeout_row_value"))
			);
			*/
			$row_params[] = array(
				'type' => 'ult_param_heading',
				'text' => __('Overlay settings', 'dfd'),
				'param_name' => 'bg_overlay',
				'class' => '',
				'edit_field_class' => 'ult-param-heading-wrapper vc_column vc_col-sm-12',
				'group' => esc_attr__('Background options', 'dfd')
			);
			$row_params[] = array(
				'type' => 'ult_switch',
				'heading' => __('Enable Overlay', 'dfd'),
				'param_name' => 'dfd_enable_overlay',
				//'value' => array(esc_attr__('Yes, please','dfd') => 'yes'),
				'value' => 'yes',
				'options' => array(
					'yes' => array(
							'label' => esc_html__('Yes, please','dfd'),
							'on' => 'Yes',
							'off' => 'No',
						),
					),
				'group' => esc_attr__('Background options', 'dfd'),
			);
			$row_params[] = array(
				'type' => 'colorpicker',
				'heading' => __('Color', 'dfd'),
				'param_name' => 'dfd_overlay_color',
				'value' => '',
				'group' => esc_attr__('Background options', 'dfd'),
				'dependency' => Array('element' => 'dfd_enable_overlay', 'value' => array('yes')),
				'description' => __('Select RGBA values or opacity will be set to 20% by default.','dfd')
			);
			$row_params[] = array(
				'type' => 'radio_image_box',
				'heading' => __('Pattern','dfd'),
				'param_name' => 'dfd_overlay_pattern',
				'value' => '',
				'options' => $patterns,
				//'options' => array(
				//	'image-1' => get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/images/patterns/01.png',
				//	'image-2' => get_template_directory_uri().'/inc/vc_custom/Ultimate_VC_Addons/assets/images/patterns/12.png',
				//),
				'css' => array(
					'width' => '40px',
					'height' => '35px',
					'background-repeat' => 'repeat',
					'background-size' => 'cover' 
				),
				'group' => esc_attr__('Background options', 'dfd'),
				'dependency' => Array('element' => 'dfd_enable_overlay', 'value' => array('yes'))
			);
			$row_params[] = array(
				'type' => 'number',
				'heading' => __('Pattern Opacity','dfd'),
				'param_name' => 'dfd_overlay_pattern_opacity',
				'value' => '80',
				'min' => '0',
				'max' => '100',
				'suffix' => '%',
				'group' => esc_attr__('Background options', 'dfd'),
				'dependency' => Array('element' => 'dfd_enable_overlay', 'value' => array('yes')),
				'description' => __('Enter value between 0 to 100 (0 is maximum transparency, while 100 is minimum)','dfd')
			);
			$row_params[] = array(
				'type' => 'number',
				'heading' => __('Pattern Size','dfd'),
				'param_name' => 'dfd_overlay_pattern_size',
				'value' => '',
				'suffix' => 'px',
				'group' => esc_attr__('Background options', 'dfd'),
				'dependency' => Array('element' => 'dfd_enable_overlay', 'value' => array('yes')),
				'description' => __('This is optional; sets the size of the pattern image manually.', 'dfd')
			);

			vc_add_params('vc_row',$row_params);
		}
	}
	
	$Dfd_VC_Row_Background = new Dfd_VC_Row_Background;
}