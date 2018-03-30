<?php

if(!class_exists('Dfd_Radio_Post_Select')) {
	class Dfd_Radio_Post_Select {
		function __construct() {	
			if(function_exists('vc_add_shortcode_param')) {
				vc_add_shortcode_param('radio_image_post_select' , array(&$this, 'radio_image_post_select' ) );
			}
		}
	
		function radio_image_post_select($settings, $value) {
			$default_css = array(
				'width' => '25px',
				'height' => '25px',
				'background-repeat' => 'repeat',
				'background-size' => 'cover'
			);
			
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$post_type = isset($settings['post_type']) ? $settings['post_type'] : 'post';
			$options = $this->dfd_custom_taxonomy_item_select($post_type);
			$css = isset($settings['css']) ? $settings['css'] : $default_css;
			$class = isset($settings['class']) ? $settings['class'] : '';
			$useextension = (isset($settings['useextension']) && $settings['useextension'] != '' ) ? $settings['useextension'] : 'true';
			$default = isset($settings['default']) ? $settings['default'] : 'transperant';
			
			$uni = uniqid();
			
			$output = '';
			$output = '<input id="radio_image_setting_val_'.$uni.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . ' '.$value.' vc_ug_gradient" name="' . $param_name . '"  style="display:none"  value="'.$value.'" />';
			$output .= '<div class="dfd-radio-image-box" data-uniqid="'.$uni.'">';
				if($value == 'transperant')
					$checked = 'checked';
				else
					$checked = '';
				$output .= '<label>
					<input type="radio" name="radio_image_'.$uni.'" '.$checked.' class="radio_pattern_image" value="'.$default.'" />
					<span class="pattern-background no-bg" style="background:transparent;"></span>
				</label>';
				foreach($options as $key => $img_url) {
					if($value == $key)
						$checked = 'checked';
					else
						$checked = '';
					if($useextension != 'true')
					{
						$temp = pathinfo($key);
						$temp_filename = $temp['filename'];
						$key = $temp_filename;
					}
					$output .= '<label>
						<input type="radio" name="radio_image_'.$uni.'" '.$checked.' class="radio_pattern_image" value="'.$key.'" />
						<span class="pattern-background" style="background:url('.$img_url.')"></span>
					</label>';
				}
			$output .= '</div>';
			$output .= '<style>
				.dfd-radio-image-box label > input{ /* HIDE RADIO */
					display:none;
				}
				.dfd-radio-image-box label > input + img{ /* IMAGE STYLES */
					cursor:pointer;
				  	border:2px solid #ddd;
				}
				.dfd-radio-image-box .no-bg {
					border:2px solid #ccc;
				}
				.dfd-radio-image-box label > input:checked + img, .dfd-radio-image-box label > input:checked + .pattern-background{ /* (CHECKED) IMAGE STYLES */
				  	border:2px solid #f00;
				}
				.pattern-background {';
					foreach($css as $attr => $inine_style) {
						$output .= $attr.':'.$inine_style.';';
					}
					$output .= 'display: inline-block;
					border:2px solid #ddd;
				}
			</style>';
			$output .= '<script type="text/javascript">
				jQuery(".radio_pattern_image").change(function(){
					var radio_id = jQuery(this).parent().parent().data("uniqid");
					var val = jQuery(this).val();
					jQuery("#radio_image_setting_val_"+radio_id).attr("value",val);
				});
			</script>';
			return $output;
		}
		
		function dfd_custom_taxonomy_item_select($what) {
			$args = array(
				'post_status' => 'publish',
				'post_type' => $what,
				'posts_per_page' => -1,
			);
			$query = new WP_Query($args);
			$items = array();
			if(!empty($query)) {
				foreach($query->posts as $post) {
					if (has_post_thumbnail($post->ID)) {
						$thumb_id = get_post_thumbnail_id($post->ID);
						$img_url = wp_get_attachment_url($thumb_id);
						$img = dfd_aq_resize($img_url, 120, 120, true, true, true);
						if(!$img) {
							$img = $img_url;
						}
					} else {
						$img = get_template_directory_uri() . '/assets/images/no_image_resized_120-120.jpg';
					}
					$items[$post->ID] = $img;
				}
			}

			return $items;
		}
	}
	
	$Dfd_Radio_Post_Select = new Dfd_Radio_Post_Select();
}