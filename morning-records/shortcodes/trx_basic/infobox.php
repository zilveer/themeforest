<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_infobox_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_infobox_theme_setup' );
	function morning_records_sc_infobox_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_infobox_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_infobox_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_infobox id="unique_id" style="regular|info|success|error|result" static="0|1"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/trx_infobox]
*/

if (!function_exists('morning_records_sc_infobox')) {	
	function morning_records_sc_infobox($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"style" => "regular",
			"closeable" => "no",
			"icon" => "",
			"color" => "",
			"bg_color" => "",
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
		$css .= ($color !== '' ? 'color:' . esc_attr($color) .';' : '')
			. ($bg_color !== '' ? 'background-color:' . esc_attr($bg_color) .';' : '');
		if (empty($icon)) {
			if ($icon=='none')
				$icon = '';
			else if ($style=='regular')
				$icon = 'icon-cog';
			else if ($style=='success')
				$icon = 'icon-check';
			else if ($style=='error')
				$icon = 'icon-attention';
			else if ($style=='info')
				$icon = 'icon-info';
		}
		$content = do_shortcode($content);
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
				. ' class="sc_infobox sc_infobox_style_' . esc_attr($style) 
					. (morning_records_param_is_on($closeable) ? ' sc_infobox_closeable' : '') 
					. (!empty($class) ? ' '.esc_attr($class) : '') 
					. ($icon!='' && !morning_records_param_is_inherit($icon) ? ' sc_infobox_iconed '. esc_attr($icon) : '') 
					. '"'
				. (!morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '')
				. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
				. '>'
				. trim($content)
				. '</div>';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_infobox', $atts, $content);
	}
	morning_records_require_shortcode('trx_infobox', 'morning_records_sc_infobox');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_infobox_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_infobox_reg_shortcodes');
	function morning_records_sc_infobox_reg_shortcodes() {
	
		morning_records_sc_map("trx_infobox", array(
			"title" => esc_html__("Infobox", 'morning-records'),
			"desc" => wp_kses_data( __("Insert infobox into your post (page)", 'morning-records') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"style" => array(
					"title" => esc_html__("Style", 'morning-records'),
					"desc" => wp_kses_data( __("Infobox style", 'morning-records') ),
					"value" => "regular",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => array(
						'regular' => esc_html__('Regular', 'morning-records'),
						'info' => esc_html__('Info', 'morning-records'),
						'success' => esc_html__('Success', 'morning-records'),
						'error' => esc_html__('Error', 'morning-records')
					)
				),
				"closeable" => array(
					"title" => esc_html__("Closeable box", 'morning-records'),
					"desc" => wp_kses_data( __("Create closeable box (with close button)", 'morning-records') ),
					"value" => "no",
					"type" => "switch",
					"options" => morning_records_get_sc_param('yes_no')
				),
				"icon" => array(
					"title" => esc_html__("Custom icon",  'morning-records'),
					"desc" => wp_kses_data( __('Select icon for the infobox from Fontello icons set. If empty - use default icon',  'morning-records') ),
					"value" => "",
					"type" => "icons",
					"options" => morning_records_get_sc_param('icons')
				),
				"color" => array(
					"title" => esc_html__("Text color", 'morning-records'),
					"desc" => wp_kses_data( __("Any color for text and headers", 'morning-records') ),
					"value" => "",
					"type" => "color"
				),
				"bg_color" => array(
					"title" => esc_html__("Background color", 'morning-records'),
					"desc" => wp_kses_data( __("Any background color for this infobox", 'morning-records') ),
					"value" => "",
					"type" => "color"
				),
				"_content_" => array(
					"title" => esc_html__("Infobox content", 'morning-records'),
					"desc" => wp_kses_data( __("Content for infobox", 'morning-records') ),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				"top" => morning_records_get_sc_param('top'),
				"bottom" => morning_records_get_sc_param('bottom'),
				"left" => morning_records_get_sc_param('left'),
				"right" => morning_records_get_sc_param('right'),
				"id" => morning_records_get_sc_param('id'),
				"class" => morning_records_get_sc_param('class'),
				"animation" => morning_records_get_sc_param('animation'),
				"css" => morning_records_get_sc_param('css')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_infobox_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_infobox_reg_shortcodes_vc');
	function morning_records_sc_infobox_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_infobox",
			"name" => esc_html__("Infobox", 'morning-records'),
			"description" => wp_kses_data( __("Box with info or error message", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_infobox',
			"class" => "trx_sc_container trx_sc_infobox",
			"content_element" => true,
			"is_container" => true,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "style",
					"heading" => esc_html__("Style", 'morning-records'),
					"description" => wp_kses_data( __("Infobox style", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => array(
							esc_html__('Regular', 'morning-records') => 'regular',
							esc_html__('Info', 'morning-records') => 'info',
							esc_html__('Success', 'morning-records') => 'success',
							esc_html__('Error', 'morning-records') => 'error',
							esc_html__('Result', 'morning-records') => 'result'
						),
					"type" => "dropdown"
				),
				array(
					"param_name" => "closeable",
					"heading" => esc_html__("Closeable", 'morning-records'),
					"description" => wp_kses_data( __("Create closeable box (with close button)", 'morning-records') ),
					"class" => "",
					"value" => array(esc_html__('Close button', 'morning-records') => 'yes'),
					"type" => "checkbox"
				),
				array(
					"param_name" => "icon",
					"heading" => esc_html__("Custom icon", 'morning-records'),
					"description" => wp_kses_data( __("Select icon for the infobox from Fontello icons set. If empty - use default icon", 'morning-records') ),
					"class" => "",
					"value" => morning_records_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "color",
					"heading" => esc_html__("Text color", 'morning-records'),
					"description" => wp_kses_data( __("Any color for the text and headers", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "bg_color",
					"heading" => esc_html__("Background color", 'morning-records'),
					"description" => wp_kses_data( __("Any background color for this infobox", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				/*
				array(
					"param_name" => "content",
					"heading" => esc_html__("Message text", 'morning-records'),
					"description" => wp_kses_data( __("Message for the infobox", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textarea_html"
				),
				*/
				morning_records_get_vc_param('id'),
				morning_records_get_vc_param('class'),
				morning_records_get_vc_param('animation'),
				morning_records_get_vc_param('css'),
				morning_records_get_vc_param('margin_top'),
				morning_records_get_vc_param('margin_bottom'),
				morning_records_get_vc_param('margin_left'),
				morning_records_get_vc_param('margin_right')
			),
			'js_view' => 'VcTrxTextContainerView'
		) );
		
		class WPBakeryShortCode_Trx_Infobox extends MORNING_RECORDS_VC_ShortCodeContainer {}
	}
}
?>