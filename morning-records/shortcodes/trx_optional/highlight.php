<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_highlight_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_highlight_theme_setup' );
	function morning_records_sc_highlight_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_highlight_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_highlight_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_highlight id="unique_id" color="fore_color's_name_or_#rrggbb" backcolor="back_color's_name_or_#rrggbb" style="custom_style"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/trx_highlight]
*/

if (!function_exists('morning_records_sc_highlight')) {	
	function morning_records_sc_highlight($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"color" => "",
			"bg_color" => "",
			"font_size" => "",
			"type" => "1",
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
		), $atts)));
		$css .= ($color != '' ? 'color:' . esc_attr($color) . ';' : '')
			.($bg_color != '' ? 'background-color:' . esc_attr($bg_color) . ';' : '')
			.($font_size != '' ? 'font-size:' . esc_attr(morning_records_prepare_css_value($font_size)) . '; line-height: 1em;' : '');
		$output = '<span' . ($id ? ' id="'.esc_attr($id).'"' : '') 
				. ' class="sc_highlight'.($type>0 ? ' sc_highlight_style_'.esc_attr($type) : ''). (!empty($class) ? ' '.esc_attr($class) : '').'"'
				. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
				. '>' 
				. do_shortcode($content) 
				. '</span>';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_highlight', $atts, $content);
	}
	morning_records_require_shortcode('trx_highlight', 'morning_records_sc_highlight');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_highlight_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_highlight_reg_shortcodes');
	function morning_records_sc_highlight_reg_shortcodes() {
	
		morning_records_sc_map("trx_highlight", array(
			"title" => esc_html__("Highlight text", 'morning-records'),
			"desc" => wp_kses_data( __("Highlight text with selected color, background color and other styles", 'morning-records') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"type" => array(
					"title" => esc_html__("Type", 'morning-records'),
					"desc" => wp_kses_data( __("Highlight type", 'morning-records') ),
					"value" => "1",
					"type" => "checklist",
					"options" => array(
						0 => esc_html__('Custom', 'morning-records'),
						1 => esc_html__('Type 1', 'morning-records'),
						2 => esc_html__('Type 2', 'morning-records'),
						3 => esc_html__('Type 3', 'morning-records')
					)
				),
				"color" => array(
					"title" => esc_html__("Color", 'morning-records'),
					"desc" => wp_kses_data( __("Color for the highlighted text", 'morning-records') ),
					"divider" => true,
					"value" => "",
					"type" => "color"
				),
				"bg_color" => array(
					"title" => esc_html__("Background color", 'morning-records'),
					"desc" => wp_kses_data( __("Background color for the highlighted text", 'morning-records') ),
					"value" => "",
					"type" => "color"
				),
				"font_size" => array(
					"title" => esc_html__("Font size", 'morning-records'),
					"desc" => wp_kses_data( __("Font size of the highlighted text (default - in pixels, allows any CSS units of measure)", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"_content_" => array(
					"title" => esc_html__("Highlighting content", 'morning-records'),
					"desc" => wp_kses_data( __("Content for highlight", 'morning-records') ),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				"id" => morning_records_get_sc_param('id'),
				"class" => morning_records_get_sc_param('class'),
				"css" => morning_records_get_sc_param('css')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_highlight_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_highlight_reg_shortcodes_vc');
	function morning_records_sc_highlight_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_highlight",
			"name" => esc_html__("Highlight text", 'morning-records'),
			"description" => wp_kses_data( __("Highlight text with selected color, background color and other styles", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_highlight',
			"class" => "trx_sc_single trx_sc_highlight",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "type",
					"heading" => esc_html__("Type", 'morning-records'),
					"description" => wp_kses_data( __("Highlight type", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => array(
							esc_html__('Custom', 'morning-records') => 0,
							esc_html__('Type 1', 'morning-records') => 1,
							esc_html__('Type 2', 'morning-records') => 2,
							esc_html__('Type 3', 'morning-records') => 3
						),
					"type" => "dropdown"
				),
				array(
					"param_name" => "color",
					"heading" => esc_html__("Text color", 'morning-records'),
					"description" => wp_kses_data( __("Color for the highlighted text", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "bg_color",
					"heading" => esc_html__("Background color", 'morning-records'),
					"description" => wp_kses_data( __("Background color for the highlighted text", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "font_size",
					"heading" => esc_html__("Font size", 'morning-records'),
					"description" => wp_kses_data( __("Font size for the highlighted text (default - in pixels, allows any CSS units of measure)", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "content",
					"heading" => esc_html__("Highlight text", 'morning-records'),
					"description" => wp_kses_data( __("Content for highlight", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textarea_html"
				),
				morning_records_get_vc_param('id'),
				morning_records_get_vc_param('class'),
				morning_records_get_vc_param('css')
			),
			'js_view' => 'VcTrxTextView'
		) );
		
		class WPBakeryShortCode_Trx_Highlight extends MORNING_RECORDS_VC_ShortCodeSingle {}
	}
}
?>