<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_socials_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_socials_theme_setup' );
	function morning_records_sc_socials_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_socials_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_socials_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_socials id="unique_id" size="small"]
	[trx_social_item name="facebook" url="profile url" icon="path for the icon"]
	[trx_social_item name="twitter" url="profile url"]
[/trx_socials]
*/

if (!function_exists('morning_records_sc_socials')) {	
	function morning_records_sc_socials($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"size" => "small",		// tiny | small | medium | large
			"shape" => "square",	// round | square
			"type" => morning_records_get_theme_setting('socials_type'),	// icons | images
			"socials" => "",
			"custom" => "no",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . morning_records_get_css_position_as_classes($top, $right, $bottom, $left);
		morning_records_storage_set('sc_social_data', array(
			'icons' => false,
            'type' => $type
            )
        );
		if (!empty($socials)) {
			$allowed = explode('|', $socials);
			$list = array();
			for ($i=0; $i<count($allowed); $i++) {
				$s = explode('=', $allowed[$i]);
				if (!empty($s[1])) {
					$list[] = array(
						'icon'	=> $type=='images' ? morning_records_get_socials_url($s[0]) : 'icon-'.trim($s[0]),
						'url'	=> $s[1]
						);
				}
			}
			if (count($list) > 0) morning_records_storage_set_array('sc_social_data', 'icons', $list);
		} else if (morning_records_param_is_off($custom))
			$content = do_shortcode($content);
		if (morning_records_storage_get_array('sc_social_data', 'icons')===false) morning_records_storage_set_array('sc_social_data', 'icons', morning_records_get_custom_option('social_icons'));
		$output = morning_records_prepare_socials(morning_records_storage_get_array('sc_social_data', 'icons'));
		$output = $output
			? '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
				. ' class="sc_socials sc_socials_type_' . esc_attr($type) . ' sc_socials_shape_' . esc_attr($shape) . ' sc_socials_size_' . esc_attr($size) . (!empty($class) ? ' '.esc_attr($class) : '') . '"' 
				. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
				. (!morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '')
				. '>' 
				. ($output)
				. '</div>'
			: '';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_socials', $atts, $content);
	}
	morning_records_require_shortcode('trx_socials', 'morning_records_sc_socials');
}


if (!function_exists('morning_records_sc_social_item')) {	
	function morning_records_sc_social_item($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"name" => "",
			"url" => "",
			"icon" => ""
		), $atts)));
		if (!empty($name) && empty($icon)) {
			$type = morning_records_storage_get_array('sc_social_data', 'type');
			if ($type=='images') {
				if (file_exists(morning_records_get_socials_dir($name.'.png')))
					$icon = morning_records_get_socials_url($name.'.png');
			} else
				$icon = 'icon-'.esc_attr($name);
		}
		if (!empty($icon) && !empty($url)) {
			if (morning_records_storage_get_array('sc_social_data', 'icons')===false) morning_records_storage_set_array('sc_social_data', 'icons', array());
			morning_records_storage_set_array2('sc_social_data', 'icons', '', array(
				'icon' => $icon,
				'url' => $url
				)
			);
		}
		return '';
	}
	morning_records_require_shortcode('trx_social_item', 'morning_records_sc_social_item');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_socials_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_socials_reg_shortcodes');
	function morning_records_sc_socials_reg_shortcodes() {
	
		morning_records_sc_map("trx_socials", array(
			"title" => esc_html__("Social icons", 'morning-records'),
			"desc" => wp_kses_data( __("List of social icons (with hovers)", 'morning-records') ),
			"decorate" => true,
			"container" => false,
			"params" => array(
				"type" => array(
					"title" => esc_html__("Icon's type", 'morning-records'),
					"desc" => wp_kses_data( __("Type of the icons - images or font icons", 'morning-records') ),
					"value" => morning_records_get_theme_setting('socials_type'),
					"options" => array(
						'icons' => esc_html__('Icons', 'morning-records'),
						'images' => esc_html__('Images', 'morning-records')
					),
					"type" => "checklist"
				), 
				"size" => array(
					"title" => esc_html__("Icon's size", 'morning-records'),
					"desc" => wp_kses_data( __("Size of the icons", 'morning-records') ),
					"value" => "small",
					"options" => morning_records_get_sc_param('sizes'),
					"type" => "checklist"
				), 
				"shape" => array(
					"title" => esc_html__("Icon's shape", 'morning-records'),
					"desc" => wp_kses_data( __("Shape of the icons", 'morning-records') ),
					"value" => "square",
					"options" => morning_records_get_sc_param('shapes'),
					"type" => "checklist"
				), 
				"socials" => array(
					"title" => esc_html__("Manual socials list", 'morning-records'),
					"desc" => wp_kses_data( __("Custom list of social networks. For example: twitter=http://twitter.com/my_profile|facebook=http://facebook.com/my_profile. If empty - use socials from Theme options.", 'morning-records') ),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
				"custom" => array(
					"title" => esc_html__("Custom socials", 'morning-records'),
					"desc" => wp_kses_data( __("Make custom icons from inner shortcodes (prepare it on tabs)", 'morning-records') ),
					"divider" => true,
					"value" => "no",
					"options" => morning_records_get_sc_param('yes_no'),
					"type" => "switch"
				),
				"top" => morning_records_get_sc_param('top'),
				"bottom" => morning_records_get_sc_param('bottom'),
				"left" => morning_records_get_sc_param('left'),
				"right" => morning_records_get_sc_param('right'),
				"id" => morning_records_get_sc_param('id'),
				"class" => morning_records_get_sc_param('class'),
				"animation" => morning_records_get_sc_param('animation'),
				"css" => morning_records_get_sc_param('css')
			),
			"children" => array(
				"name" => "trx_social_item",
				"title" => esc_html__("Custom social item", 'morning-records'),
				"desc" => wp_kses_data( __("Custom social item: name, profile url and icon url", 'morning-records') ),
				"decorate" => false,
				"container" => false,
				"params" => array(
					"name" => array(
						"title" => esc_html__("Social name", 'morning-records'),
						"desc" => wp_kses_data( __("Name (slug) of the social network (twitter, facebook, linkedin, etc.)", 'morning-records') ),
						"value" => "",
						"type" => "text"
					),
					"url" => array(
						"title" => esc_html__("Your profile URL", 'morning-records'),
						"desc" => wp_kses_data( __("URL of your profile in specified social network", 'morning-records') ),
						"value" => "",
						"type" => "text"
					),
					"icon" => array(
						"title" => esc_html__("URL (source) for icon file", 'morning-records'),
						"desc" => wp_kses_data( __("Select or upload image or write URL from other site for the current social icon", 'morning-records') ),
						"readonly" => false,
						"value" => "",
						"type" => "media"
					)
				)
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_socials_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_socials_reg_shortcodes_vc');
	function morning_records_sc_socials_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_socials",
			"name" => esc_html__("Social icons", 'morning-records'),
			"description" => wp_kses_data( __("Custom social icons", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_socials',
			"class" => "trx_sc_collection trx_sc_socials",
			"content_element" => true,
			"is_container" => true,
			"show_settings_on_create" => true,
			"as_parent" => array('only' => 'trx_social_item'),
			"params" => array_merge(array(
				array(
					"param_name" => "type",
					"heading" => esc_html__("Icon's type", 'morning-records'),
					"description" => wp_kses_data( __("Type of the icons - images or font icons", 'morning-records') ),
					"class" => "",
					"std" => morning_records_get_theme_setting('socials_type'),
					"value" => array(
						esc_html__('Icons', 'morning-records') => 'icons',
						esc_html__('Images', 'morning-records') => 'images'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "size",
					"heading" => esc_html__("Icon's size", 'morning-records'),
					"description" => wp_kses_data( __("Size of the icons", 'morning-records') ),
					"class" => "",
					"std" => "small",
					"value" => array_flip(morning_records_get_sc_param('sizes')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "shape",
					"heading" => esc_html__("Icon's shape", 'morning-records'),
					"description" => wp_kses_data( __("Shape of the icons", 'morning-records') ),
					"class" => "",
					"std" => "square",
					"value" => array_flip(morning_records_get_sc_param('shapes')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "socials",
					"heading" => esc_html__("Manual socials list", 'morning-records'),
					"description" => wp_kses_data( __("Custom list of social networks. For example: twitter=http://twitter.com/my_profile|facebook=http://facebook.com/my_profile. If empty - use socials from Theme options.", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "custom",
					"heading" => esc_html__("Custom socials", 'morning-records'),
					"description" => wp_kses_data( __("Make custom icons from inner shortcodes (prepare it on tabs)", 'morning-records') ),
					"class" => "",
					"value" => array(esc_html__('Custom socials', 'morning-records') => 'yes'),
					"type" => "checkbox"
				),
				morning_records_get_vc_param('id'),
				morning_records_get_vc_param('class'),
				morning_records_get_vc_param('animation'),
				morning_records_get_vc_param('css'),
				morning_records_get_vc_param('margin_top'),
				morning_records_get_vc_param('margin_bottom'),
				morning_records_get_vc_param('margin_left'),
				morning_records_get_vc_param('margin_right')
			))
		) );
		
		
		vc_map( array(
			"base" => "trx_social_item",
			"name" => esc_html__("Custom social item", 'morning-records'),
			"description" => wp_kses_data( __("Custom social item: name, profile url and icon url", 'morning-records') ),
			"show_settings_on_create" => true,
			"content_element" => true,
			"is_container" => false,
			'icon' => 'icon_trx_social_item',
			"class" => "trx_sc_single trx_sc_social_item",
			"as_child" => array('only' => 'trx_socials'),
			"as_parent" => array('except' => 'trx_socials'),
			"params" => array(
				array(
					"param_name" => "name",
					"heading" => esc_html__("Social name", 'morning-records'),
					"description" => wp_kses_data( __("Name (slug) of the social network (twitter, facebook, linkedin, etc.)", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "url",
					"heading" => esc_html__("Your profile URL", 'morning-records'),
					"description" => wp_kses_data( __("URL of your profile in specified social network", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "icon",
					"heading" => esc_html__("URL (source) for icon file", 'morning-records'),
					"description" => wp_kses_data( __("Select or upload image or write URL from other site for the current social icon", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				)
			)
		) );
		
		class WPBakeryShortCode_Trx_Socials extends MORNING_RECORDS_VC_ShortCodeCollection {}
		class WPBakeryShortCode_Trx_Social_Item extends MORNING_RECORDS_VC_ShortCodeSingle {}
	}
}
?>