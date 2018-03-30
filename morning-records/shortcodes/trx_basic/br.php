<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_br_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_br_theme_setup' );
	function morning_records_sc_br_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_br_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_br_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_br clear="left|right|both"]
*/

if (!function_exists('morning_records_sc_br')) {	
	function morning_records_sc_br($atts, $content = null) {
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			"clear" => ""
		), $atts)));
		$output = in_array($clear, array('left', 'right', 'both', 'all')) 
			? '<div class="clearfix" style="clear:' . str_replace('all', 'both', $clear) . '"></div>'
			: '<br />';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_br', $atts, $content);
	}
	morning_records_require_shortcode("trx_br", "morning_records_sc_br");
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_br_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_br_reg_shortcodes');
	function morning_records_sc_br_reg_shortcodes() {
	
		morning_records_sc_map("trx_br", array(
			"title" => esc_html__("Break", 'morning-records'),
			"desc" => wp_kses_data( __("Line break with clear floating (if need)", 'morning-records') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"clear" => 	array(
					"title" => esc_html__("Clear floating", 'morning-records'),
					"desc" => wp_kses_data( __("Clear floating (if need)", 'morning-records') ),
					"value" => "",
					"type" => "checklist",
					"options" => array(
						'none' => esc_html__('None', 'morning-records'),
						'left' => esc_html__('Left', 'morning-records'),
						'right' => esc_html__('Right', 'morning-records'),
						'both' => esc_html__('Both', 'morning-records')
					)
				)
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_br_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_br_reg_shortcodes_vc');
	function morning_records_sc_br_reg_shortcodes_vc() {
/*
		vc_map( array(
			"base" => "trx_br",
			"name" => esc_html__("Line break", 'morning-records'),
			"description" => wp_kses_data( __("Line break or Clear Floating", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_br',
			"class" => "trx_sc_single trx_sc_br",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "clear",
					"heading" => esc_html__("Clear floating", 'morning-records'),
					"description" => wp_kses_data( __("Select clear side (if need)", 'morning-records') ),
					"class" => "",
					"value" => "",
					"value" => array(
						esc_html__('None', 'morning-records') => 'none',
						esc_html__('Left', 'morning-records') => 'left',
						esc_html__('Right', 'morning-records') => 'right',
						esc_html__('Both', 'morning-records') => 'both'
					),
					"type" => "dropdown"
				)
			)
		) );
		
		class WPBakeryShortCode_Trx_Br extends MORNING_RECORDS_VC_ShortCodeSingle {}
*/
	}
}
?>