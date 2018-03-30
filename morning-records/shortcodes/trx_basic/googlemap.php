<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_googlemap_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_googlemap_theme_setup' );
	function morning_records_sc_googlemap_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_googlemap_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_googlemap_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

//[trx_googlemap id="unique_id" width="width_in_pixels_or_percent" height="height_in_pixels"]
//	[trx_googlemap_marker address="your_address"]
//[/trx_googlemap]

if (!function_exists('morning_records_sc_googlemap')) {	
	function morning_records_sc_googlemap($atts, $content = null) {
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"zoom" => 16,
			"style" => 'greyscale',
			"scheme" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
			"animation" => "",
			"width" => "100%",
			"height" => "345",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . morning_records_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= morning_records_get_css_dimensions_from_values($width, $height);
		if (empty($id)) $id = 'sc_googlemap_'.str_replace('.', '', mt_rand());
		if (empty($style)) $style = morning_records_get_custom_option('googlemap_style');
        $api_key = morning_records_get_theme_option('api_google');
        morning_records_enqueue_script( 'googlemap', morning_records_get_protocol().'://maps.google.com/maps/api/js'.($api_key ? '?key='.$api_key : ''), array(), null, true );
		morning_records_enqueue_script( 'morning_records-googlemap-script', morning_records_get_file_url('js/core.googlemap.js'), array(), null, true );
		morning_records_storage_set('sc_googlemap_markers', array());
		$content = do_shortcode($content);
		$output = '';
		$markers = morning_records_storage_get('sc_googlemap_markers');
		if (count($markers) == 0) {
			$markers[] = array(
				'title' => morning_records_get_custom_option('googlemap_title'),
				'description' => morning_records_strmacros(morning_records_get_custom_option('googlemap_description')),
				'latlng' => morning_records_get_custom_option('googlemap_latlng'),
				'address' => morning_records_get_custom_option('googlemap_address'),
				'point' => morning_records_get_custom_option('googlemap_marker')
			);
		}
		$output .= 
			($content ? '<div id="'.esc_attr($id).'_wrap" class="sc_googlemap_wrap'
					. ($scheme && !morning_records_param_is_off($scheme) && !morning_records_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '') 
					. '">' : '')
			. '<div id="'.esc_attr($id).'"'
				. ' class="sc_googlemap'. (!empty($class) ? ' '.esc_attr($class) : '').'"'
				. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
				. (!morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '')
				. ' data-zoom="'.esc_attr($zoom).'"'
				. ' data-style="'.esc_attr($style).'"'
				. '>';
		$cnt = 0;
		foreach ($markers as $marker) {
			$cnt++;
			if (empty($marker['id'])) $marker['id'] = $id.'_'.intval($cnt);
			$output .= '<div id="'.esc_attr($marker['id']).'" class="sc_googlemap_marker"'
				. ' data-title="'.esc_attr($marker['title']).'"'
				. ' data-description="'.esc_attr(morning_records_strmacros($marker['description'])).'"'
				. ' data-address="'.esc_attr($marker['address']).'"'
				. ' data-latlng="'.esc_attr($marker['latlng']).'"'
				. ' data-point="'.esc_attr($marker['point']).'"'
				. '></div>';
		}
		$output .= '</div>'
			. ($content ? '<div class="sc_googlemap_content">' . trim($content) . '</div></div>' : '');
			
		return apply_filters('morning_records_shortcode_output', $output, 'trx_googlemap', $atts, $content);
	}
	morning_records_require_shortcode("trx_googlemap", "morning_records_sc_googlemap");
}


if (!function_exists('morning_records_sc_googlemap_marker')) {	
	function morning_records_sc_googlemap_marker($atts, $content = null) {
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"title" => "",
			"address" => "",
			"latlng" => "",
			"point" => "",
			// Common params
			"id" => ""
		), $atts)));
		if (!empty($point)) {
			if ($point > 0) {
				$attach = wp_get_attachment_image_src( $point, 'full' );
				if (isset($attach[0]) && $attach[0]!='')
					$point = $attach[0];
			}
		}
		$content = do_shortcode($content);
		morning_records_storage_set_array('sc_googlemap_markers', '', array(
			'id' => $id,
			'title' => $title,
			'description' => !empty($content) ? $content : $address,
			'latlng' => $latlng,
			'address' => $address,
			'point' => $point ? $point : morning_records_get_custom_option('googlemap_marker')
			)
		);
		return '';
	}
	morning_records_require_shortcode("trx_googlemap_marker", "morning_records_sc_googlemap_marker");
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_googlemap_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_googlemap_reg_shortcodes');
	function morning_records_sc_googlemap_reg_shortcodes() {
	
		morning_records_sc_map("trx_googlemap", array(
			"title" => esc_html__("Google map", 'morning-records'),
			"desc" => wp_kses_data( __("Insert Google map with specified markers", 'morning-records') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"zoom" => array(
					"title" => esc_html__("Zoom", 'morning-records'),
					"desc" => wp_kses_data( __("Map zoom factor", 'morning-records') ),
					"divider" => true,
					"value" => 16,
					"min" => 1,
					"max" => 20,
					"type" => "spinner"
				),
				"style" => array(
					"title" => esc_html__("Map style", 'morning-records'),
					"desc" => wp_kses_data( __("Select map style", 'morning-records') ),
					"value" => "default",
					"type" => "checklist",
					"options" => morning_records_get_sc_param('googlemap_styles')
				),
				"scheme" => array(
					"title" => esc_html__("Color scheme", 'morning-records'),
					"desc" => wp_kses_data( __("Select color scheme for this block", 'morning-records') ),
					"value" => "",
					"type" => "checklist",
					"options" => morning_records_get_sc_param('schemes')
				),
				"width" => morning_records_shortcodes_width('100%'),
				"height" => morning_records_shortcodes_height(240),
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
				"name" => "trx_googlemap_marker",
				"title" => esc_html__("Google map marker", 'morning-records'),
				"desc" => wp_kses_data( __("Google map marker", 'morning-records') ),
				"decorate" => false,
				"container" => true,
				"params" => array(
					"address" => array(
						"title" => esc_html__("Address", 'morning-records'),
						"desc" => wp_kses_data( __("Address of this marker", 'morning-records') ),
						"value" => "",
						"type" => "text"
					),
					"latlng" => array(
						"title" => esc_html__("Latitude and Longitude", 'morning-records'),
						"desc" => wp_kses_data( __("Comma separated marker's coorditanes (instead Address)", 'morning-records') ),
						"value" => "",
						"type" => "text"
					),
					"point" => array(
						"title" => esc_html__("URL for marker image file", 'morning-records'),
						"desc" => wp_kses_data( __("Select or upload image or write URL from other site for this marker. If empty - use default marker", 'morning-records') ),
						"readonly" => false,
						"value" => "",
						"type" => "media"
					),
					"title" => array(
						"title" => esc_html__("Title", 'morning-records'),
						"desc" => wp_kses_data( __("Title for this marker", 'morning-records') ),
						"value" => "",
						"type" => "text"
					),
					"_content_" => array(
						"title" => esc_html__("Description", 'morning-records'),
						"desc" => wp_kses_data( __("Description for this marker", 'morning-records') ),
						"rows" => 4,
						"value" => "",
						"type" => "textarea"
					),
					"id" => morning_records_get_sc_param('id')
				)
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_googlemap_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_googlemap_reg_shortcodes_vc');
	function morning_records_sc_googlemap_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_googlemap",
			"name" => esc_html__("Google map", 'morning-records'),
			"description" => wp_kses_data( __("Insert Google map with desired address or coordinates", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_googlemap',
			"class" => "trx_sc_collection trx_sc_googlemap",
			"content_element" => true,
			"is_container" => true,
			"as_parent" => array('only' => 'trx_googlemap_marker,trx_form,trx_section,trx_block,trx_promo'),
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "zoom",
					"heading" => esc_html__("Zoom", 'morning-records'),
					"description" => wp_kses_data( __("Map zoom factor", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => "16",
					"type" => "textfield"
				),
				array(
					"param_name" => "style",
					"heading" => esc_html__("Style", 'morning-records'),
					"description" => wp_kses_data( __("Map custom style", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => array_flip(morning_records_get_sc_param('googlemap_styles')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "scheme",
					"heading" => esc_html__("Color scheme", 'morning-records'),
					"description" => wp_kses_data( __("Select color scheme for this block", 'morning-records') ),
					"class" => "",
					"value" => array_flip(morning_records_get_sc_param('schemes')),
					"type" => "dropdown"
				),
				morning_records_get_vc_param('id'),
				morning_records_get_vc_param('class'),
				morning_records_get_vc_param('animation'),
				morning_records_get_vc_param('css'),
				morning_records_vc_width('100%'),
				morning_records_vc_height(240),
				morning_records_get_vc_param('margin_top'),
				morning_records_get_vc_param('margin_bottom'),
				morning_records_get_vc_param('margin_left'),
				morning_records_get_vc_param('margin_right')
			)
		) );
		
		vc_map( array(
			"base" => "trx_googlemap_marker",
			"name" => esc_html__("Googlemap marker", 'morning-records'),
			"description" => wp_kses_data( __("Insert new marker into Google map", 'morning-records') ),
			"class" => "trx_sc_collection trx_sc_googlemap_marker",
			'icon' => 'icon_trx_googlemap_marker',
			//"allowed_container_element" => 'vc_row',
			"show_settings_on_create" => true,
			"content_element" => true,
			"is_container" => true,
			"as_child" => array('only' => 'trx_googlemap'), // Use only|except attributes to limit parent (separate multiple values with comma)
			"params" => array(
				array(
					"param_name" => "address",
					"heading" => esc_html__("Address", 'morning-records'),
					"description" => wp_kses_data( __("Address of this marker", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "latlng",
					"heading" => esc_html__("Latitude and Longitude", 'morning-records'),
					"description" => wp_kses_data( __("Comma separated marker's coorditanes (instead Address)", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Title", 'morning-records'),
					"description" => wp_kses_data( __("Title for this marker", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "point",
					"heading" => esc_html__("URL for marker image file", 'morning-records'),
					"description" => wp_kses_data( __("Select or upload image or write URL from other site for this marker. If empty - use default marker", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				morning_records_get_vc_param('id')
			)
		) );
		
		class WPBakeryShortCode_Trx_Googlemap extends MORNING_RECORDS_VC_ShortCodeCollection {}
		class WPBakeryShortCode_Trx_Googlemap_Marker extends MORNING_RECORDS_VC_ShortCodeCollection {}
	}
}
?>