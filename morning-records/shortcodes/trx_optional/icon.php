<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_icon_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_icon_theme_setup' );
	function morning_records_sc_icon_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_icon_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_icon_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_icon id="unique_id" style='round|square' icon='' color="" bg_color="" size="" weight=""]
*/

if (!function_exists('morning_records_sc_icon')) {	
	function morning_records_sc_icon($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"icon" => "",
			"color" => "",
			"bg_color" => "",
			"bg_shape" => "",
			"font_size" => "",
			"font_weight" => "",
			"align" => "",
			"link" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . morning_records_get_css_position_as_classes($top, $right, $bottom, $left);
		$css2 = ($font_weight != '' && !morning_records_is_inherit_option($font_weight) ? 'font-weight:'. esc_attr($font_weight).';' : '')
			. ($font_size != '' ? 'font-size:' . esc_attr(morning_records_prepare_css_value($font_size)) . '; line-height: ' . (!$bg_shape || morning_records_param_is_inherit($bg_shape) ? '1' : '1.2') . 'em;' : '')
			. ($color != '' ? 'color:'.esc_attr($color).';' : '')
			. ($bg_color != '' ? 'background-color:'.esc_attr($bg_color).';border-color:'.esc_attr($bg_color).';' : '')
		;
		$output = $icon!='' 
			? ($link ? '<a href="'.esc_url($link).'"' : '<span') . ($id ? ' id="'.esc_attr($id).'"' : '')
				. ' class="sc_icon '.esc_attr($icon)
					. ($bg_shape && !morning_records_param_is_inherit($bg_shape) ? ' sc_icon_shape_'.esc_attr($bg_shape) : '')
					. ($align && $align!='none' ? ' align'.esc_attr($align) : '') 
					. (!empty($class) ? ' '.esc_attr($class) : '')
				.'"'
				.($css || $css2 ? ' style="'.($class ? 'display:block;' : '') . ($css) . ($css2) . '"' : '')
				.'>'
				.($link ? '</a>' : '</span>')
			: '';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_icon', $atts, $content);
	}
	morning_records_require_shortcode('trx_icon', 'morning_records_sc_icon');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_icon_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_icon_reg_shortcodes');
	function morning_records_sc_icon_reg_shortcodes() {
	
		morning_records_sc_map("trx_icon", array(
			"title" => esc_html__("Icon", 'morning-records'),
			"desc" => wp_kses_data( __("Insert icon", 'morning-records') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"icon" => array(
					"title" => esc_html__('Icon',  'morning-records'),
					"desc" => wp_kses_data( __('Select font icon from the Fontello icons set',  'morning-records') ),
					"value" => "",
					"type" => "icons",
					"options" => morning_records_get_sc_param('icons')
				),
				"color" => array(
					"title" => esc_html__("Icon's color", 'morning-records'),
					"desc" => wp_kses_data( __("Icon's color", 'morning-records') ),
					"dependency" => array(
						'icon' => array('not_empty')
					),
					"value" => "",
					"type" => "color"
				),
				"bg_shape" => array(
					"title" => esc_html__("Background shape", 'morning-records'),
					"desc" => wp_kses_data( __("Shape of the icon background", 'morning-records') ),
					"dependency" => array(
						'icon' => array('not_empty')
					),
					"value" => "none",
					"type" => "radio",
					"options" => array(
						'none' => esc_html__('None', 'morning-records'),
						'round' => esc_html__('Round', 'morning-records'),
						'square' => esc_html__('Square', 'morning-records')
					)
				),
				"bg_color" => array(
					"title" => esc_html__("Icon's background color", 'morning-records'),
					"desc" => wp_kses_data( __("Icon's background color", 'morning-records') ),
					"dependency" => array(
						'icon' => array('not_empty'),
						'background' => array('round','square')
					),
					"value" => "",
					"type" => "color"
				),
				"font_size" => array(
					"title" => esc_html__("Font size", 'morning-records'),
					"desc" => wp_kses_data( __("Icon's font size", 'morning-records') ),
					"dependency" => array(
						'icon' => array('not_empty')
					),
					"value" => "",
					"type" => "spinner",
					"min" => 8,
					"max" => 240
				),
				"font_weight" => array(
					"title" => esc_html__("Font weight", 'morning-records'),
					"desc" => wp_kses_data( __("Icon font weight", 'morning-records') ),
					"dependency" => array(
						'icon' => array('not_empty')
					),
					"value" => "",
					"type" => "select",
					"size" => "medium",
					"options" => array(
						'100' => esc_html__('Thin (100)', 'morning-records'),
						'300' => esc_html__('Light (300)', 'morning-records'),
						'400' => esc_html__('Normal (400)', 'morning-records'),
						'700' => esc_html__('Bold (700)', 'morning-records')
					)
				),
				"align" => array(
					"title" => esc_html__("Alignment", 'morning-records'),
					"desc" => wp_kses_data( __("Icon text alignment", 'morning-records') ),
					"dependency" => array(
						'icon' => array('not_empty')
					),
					"value" => "",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => morning_records_get_sc_param('align')
				), 
				"link" => array(
					"title" => esc_html__("Link URL", 'morning-records'),
					"desc" => wp_kses_data( __("Link URL from this icon (if not empty)", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"top" => morning_records_get_sc_param('top'),
				"bottom" => morning_records_get_sc_param('bottom'),
				"left" => morning_records_get_sc_param('left'),
				"right" => morning_records_get_sc_param('right'),
				"id" => morning_records_get_sc_param('id'),
				"class" => morning_records_get_sc_param('class'),
				"css" => morning_records_get_sc_param('css')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_icon_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_icon_reg_shortcodes_vc');
	function morning_records_sc_icon_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_icon",
			"name" => esc_html__("Icon", 'morning-records'),
			"description" => wp_kses_data( __("Insert the icon", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_icon',
			"class" => "trx_sc_single trx_sc_icon",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "icon",
					"heading" => esc_html__("Icon", 'morning-records'),
					"description" => wp_kses_data( __("Select icon class from Fontello icons set", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => morning_records_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "color",
					"heading" => esc_html__("Text color", 'morning-records'),
					"description" => wp_kses_data( __("Icon's color", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "bg_color",
					"heading" => esc_html__("Background color", 'morning-records'),
					"description" => wp_kses_data( __("Background color for the icon", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "bg_shape",
					"heading" => esc_html__("Background shape", 'morning-records'),
					"description" => wp_kses_data( __("Shape of the icon background", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => array(
						esc_html__('None', 'morning-records') => 'none',
						esc_html__('Round', 'morning-records') => 'round',
						esc_html__('Square', 'morning-records') => 'square'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "font_size",
					"heading" => esc_html__("Font size", 'morning-records'),
					"description" => wp_kses_data( __("Icon's font size", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "font_weight",
					"heading" => esc_html__("Font weight", 'morning-records'),
					"description" => wp_kses_data( __("Icon's font weight", 'morning-records') ),
					"class" => "",
					"value" => array(
						esc_html__('Default', 'morning-records') => 'inherit',
						esc_html__('Thin (100)', 'morning-records') => '100',
						esc_html__('Light (300)', 'morning-records') => '300',
						esc_html__('Normal (400)', 'morning-records') => '400',
						esc_html__('Bold (700)', 'morning-records') => '700'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "align",
					"heading" => esc_html__("Icon's alignment", 'morning-records'),
					"description" => wp_kses_data( __("Align icon to left, center or right", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => array_flip(morning_records_get_sc_param('align')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "link",
					"heading" => esc_html__("Link URL", 'morning-records'),
					"description" => wp_kses_data( __("Link URL from this icon (if not empty)", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				morning_records_get_vc_param('id'),
				morning_records_get_vc_param('class'),
				morning_records_get_vc_param('css'),
				morning_records_get_vc_param('margin_top'),
				morning_records_get_vc_param('margin_bottom'),
				morning_records_get_vc_param('margin_left'),
				morning_records_get_vc_param('margin_right')
			),
		) );
		
		class WPBakeryShortCode_Trx_Icon extends MORNING_RECORDS_VC_ShortCodeSingle {}
	}
}
?>