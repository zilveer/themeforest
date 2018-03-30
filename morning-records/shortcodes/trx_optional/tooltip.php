<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_tooltip_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_tooltip_theme_setup' );
	function morning_records_sc_tooltip_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_tooltip_reg_shortcodes');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_tooltip id="unique_id" title="Tooltip text here"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/tooltip]
*/

if (!function_exists('morning_records_sc_tooltip')) {	
	function morning_records_sc_tooltip($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"title" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
		), $atts)));
		$output = '<span' . ($id ? ' id="'.esc_attr($id).'"' : '') 
					. ' class="sc_tooltip_parent'. (!empty($class) ? ' '.esc_attr($class) : '').'"'
					. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
					. '>'
						. do_shortcode($content)
						. '<span class="sc_tooltip">' . ($title) . '</span>'
					. '</span>';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_tooltip', $atts, $content);
	}
	morning_records_require_shortcode('trx_tooltip', 'morning_records_sc_tooltip');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_tooltip_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_tooltip_reg_shortcodes');
	function morning_records_sc_tooltip_reg_shortcodes() {
	
		morning_records_sc_map("trx_tooltip", array(
			"title" => esc_html__("Tooltip", 'morning-records'),
			"desc" => wp_kses_data( __("Create tooltip for selected text", 'morning-records') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"title" => array(
					"title" => esc_html__("Title", 'morning-records'),
					"desc" => wp_kses_data( __("Tooltip title (required)", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"_content_" => array(
					"title" => esc_html__("Tipped content", 'morning-records'),
					"desc" => wp_kses_data( __("Highlighted content with tooltip", 'morning-records') ),
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
?>