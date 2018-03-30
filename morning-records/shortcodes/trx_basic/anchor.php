<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_anchor_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_anchor_theme_setup' );
	function morning_records_sc_anchor_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_anchor_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_anchor_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_anchor id="unique_id" description="Anchor description" title="Short Caption" icon="icon-class"]
*/

if (!function_exists('morning_records_sc_anchor')) {	
	function morning_records_sc_anchor($atts, $content = null) {
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"title" => "",
			"description" => '',
			"icon" => '',
			"url" => "",
			"separator" => "no",
			// Common params
			"id" => ""
		), $atts)));
		$output = $id 
			? '<a id="'.esc_attr($id).'"'
				. ' class="sc_anchor"' 
				. ' title="' . ($title ? esc_attr($title) : '') . '"'
				. ' data-description="' . ($description ? esc_attr(morning_records_strmacros($description)) : ''). '"'
				. ' data-icon="' . ($icon ? $icon : '') . '"' 
				. ' data-url="' . ($url ? esc_attr($url) : '') . '"' 
				. ' data-separator="' . (morning_records_param_is_on($separator) ? 'yes' : 'no') . '"'
				. '></a>'
			: '';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_anchor', $atts, $content);
	}
	morning_records_require_shortcode("trx_anchor", "morning_records_sc_anchor");
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_anchor_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_anchor_reg_shortcodes');
	function morning_records_sc_anchor_reg_shortcodes() {
	
		morning_records_sc_map("trx_anchor", array(
			"title" => esc_html__("Anchor", 'morning-records'),
			"desc" => wp_kses_data( __("Insert anchor for the TOC (table of content)", 'morning-records') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"icon" => array(
					"title" => esc_html__("Anchor's icon",  'morning-records'),
					"desc" => wp_kses_data( __('Select icon for the anchor from Fontello icons set',  'morning-records') ),
					"value" => "",
					"type" => "icons",
					"options" => morning_records_get_sc_param('icons')
				),
				"title" => array(
					"title" => esc_html__("Short title", 'morning-records'),
					"desc" => wp_kses_data( __("Short title of the anchor (for the table of content)", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"description" => array(
					"title" => esc_html__("Long description", 'morning-records'),
					"desc" => wp_kses_data( __("Description for the popup (then hover on the icon). You can use:<br>'{{' and '}}' - to make the text italic,<br>'((' and '))' - to make the text bold,<br>'||' - to insert line break", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"url" => array(
					"title" => esc_html__("External URL", 'morning-records'),
					"desc" => wp_kses_data( __("External URL for this TOC item", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"separator" => array(
					"title" => esc_html__("Add separator", 'morning-records'),
					"desc" => wp_kses_data( __("Add separator under item in the TOC", 'morning-records') ),
					"value" => "no",
					"type" => "switch",
					"options" => morning_records_get_sc_param('yes_no')
				),
				"id" => morning_records_get_sc_param('id')
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_anchor_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_anchor_reg_shortcodes_vc');
	function morning_records_sc_anchor_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_anchor",
			"name" => esc_html__("Anchor", 'morning-records'),
			"description" => wp_kses_data( __("Insert anchor for the TOC (table of content)", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_anchor',
			"class" => "trx_sc_single trx_sc_anchor",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "icon",
					"heading" => esc_html__("Anchor's icon", 'morning-records'),
					"description" => wp_kses_data( __("Select icon for the anchor from Fontello icons set", 'morning-records') ),
					"class" => "",
					"value" => morning_records_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Short title", 'morning-records'),
					"description" => wp_kses_data( __("Short title of the anchor (for the table of content)", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "description",
					"heading" => esc_html__("Long description", 'morning-records'),
					"description" => wp_kses_data( __("Description for the popup (then hover on the icon). You can use:<br>'{{' and '}}' - to make the text italic,<br>'((' and '))' - to make the text bold,<br>'||' - to insert line break", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "url",
					"heading" => esc_html__("External URL", 'morning-records'),
					"description" => wp_kses_data( __("External URL for this TOC item", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "separator",
					"heading" => esc_html__("Add separator", 'morning-records'),
					"description" => wp_kses_data( __("Add separator under item in the TOC", 'morning-records') ),
					"class" => "",
					"value" => array("Add separator" => "yes" ),
					"type" => "checkbox"
				),
				morning_records_get_vc_param('id')
			),
		) );
		
		class WPBakeryShortCode_Trx_Anchor extends MORNING_RECORDS_VC_ShortCodeSingle {}
	}
}
?>