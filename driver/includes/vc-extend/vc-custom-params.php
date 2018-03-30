<?php

if(function_exists('add_shortcode_param')) {

	function vc_setting_field_post_multiselect($settings, $value) {
	
		$settings["type"] = "dropdown";
		$dependency = vc_generate_dependencies_attributes($settings);
		
		$value_exploded = array();
	    if(!empty($value)) {
		    
		    $value_exploded = explode(",", $value);
	    }
	    
		$all_items = get_posts(array(
			  'post_type' => (!empty($settings["post_type"]) ? $settings["post_type"] : 'page')
			, 'posts_per_page' => -1
			, 'no_found_rows'  => true
			, 'suppress_filters' => false
		));
		
		$dropdown = '<div class="post_multiselect_block">';
		$dropdown .= '<select name="'.$settings['param_name'].'_select" class="wpb_vc_param_value wpb-input wpb-select" multiple="multiple">';
				
		foreach($all_items as $item) {
				
			$dropdown .= '<option value="'.$item->ID.'"'.(is_array($value_exploded) && in_array($item->ID, $value_exploded) ? ' selected="selected"' : '').'">'.esc_attr($item->post_title).'</option>';
				
		}
				
		$dropdown .= '</select>';
		$dropdown .= '<input name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'_field" type="hidden" value="'.$value.'" '.$dependency.' />';		
		$dropdown .= '</div>';	
		
         	

		return $dropdown;
		
	}
	add_shortcode_param('post_multiselect', 'vc_setting_field_post_multiselect', IRON_PARENT_URL.'/includes/vc-extend/assets/settings/post_multiselect.js');
	

	
	function vc_setting_field_post_select($settings, $value) {
	
		$settings["type"] = "dropdown";
		$dependency = vc_generate_dependencies_attributes($settings);
	    
		$all_items = get_posts(array(
			  'post_type' => (!empty($settings["post_type"]) ? $settings["post_type"] : 'page') 
			, 'posts_per_page' => -1
			, 'no_found_rows'  => true
			, 'suppress_filters' => false
		));
		
		$dropdown = '<div class="post_multiselect_block">';
		$dropdown .= '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select" '.$dependency.'>';
			
		$dropdown .= '<option></option>';		
		foreach($all_items as $item) {
				
			$dropdown .= '<option value="'.$item->ID.'"'.(($item->ID == $value) ? ' selected="selected"' : '').'">'.esc_attr($item->post_title).'</option>';
				
		}
				
		$dropdown .= '</select>';
		$dropdown .= '</div>';	

		return $dropdown;
		
	}
	add_shortcode_param('post_select', 'vc_setting_field_post_select', IRON_PARENT_URL.'/includes/vc-extend/assets/settings/post_multiselect.js');



	function vc_setting_field_taxonomy_multiselect($settings, $value) {
	
		$settings["type"] = "dropdown";
		$dependency = vc_generate_dependencies_attributes($settings);
		
		$value_exploded = array();
	    if(!empty($value)) {
		    
		    $value_exploded = explode(",", $value);
	    }
	    

		$taxonomy = (!empty($settings["taxonomy"]) ? $settings["taxonomy"] : 'category');
		$all_items = get_terms($taxonomy);
		
		$dropdown = '<div class="taxonomy_multiselect_block">';
		$dropdown .= '<select name="'.$settings['param_name'].'_select" class="wpb_vc_param_value wpb-input wpb-select" multiple="multiple">';
				
		foreach($all_items as $item) {
				
			$dropdown .= '<option value="'.$item->term_id.'"'.(is_array($value_exploded) && in_array($item->term_id, $value_exploded) ? ' selected="selected"' : '').'">'.esc_attr($item->name).'</option>';
				
		}
				
		$dropdown .= '</select>';
		$dropdown .= '<input name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'_field" type="hidden" value="'.$value.'" '.$dependency.' />';		
		$dropdown .= '</div>';	
		
         	

		return $dropdown;
		
	}
	add_shortcode_param('taxonomy_multiselect', 'vc_setting_field_taxonomy_multiselect', IRON_PARENT_URL.'/includes/vc-extend/assets/settings/post_multiselect.js');



	function vc_setting_field_font_select($settings, $value) {
		$setting['type'] = 'dropdown';
		$dependency = vc_generate_dependencies_attributes($settings);

		$all_fonts = iron_get_fonts();
		$safe_fonts = $all_fonts["safefont"];
		$google_fonts = $all_fonts["google"];
		
		$dropdown = '<div class="font_select_block">';
		$dropdown .= '<select name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-input wpb-select" '.$dependency.'>';
		$dropdown .= 	'<option data-type="" value="none">Select Font</option>';
		
		foreach($safe_fonts as $key => $name) {
			
			$selected = "";
			if($key == $value) {
				$selected = "selected";
			}
			$dropdown .= '<option '.$selected.' data-type="safefont" value="'.$key.'">Safe Font - '.esc_attr($name).'</option>';
		}

		foreach($google_fonts as $key => $name) {

			$key = 'google|'.$key;
			
			$selected = "";
			if($key == $value) {
				$selected = "selected";
			}
			
			$dropdown .= '<option '.$selected.' data-type="google" value="'.$key.'">Google Font - '.esc_attr($name).'</option>';
		}
		
		$dropdown .= '</select>';		
		$dropdown .= '</div>';
		

		return $dropdown;
	}
	add_shortcode_param('font_select', 'vc_setting_field_font_select');

}	