<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_gap_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_gap_theme_setup' );
	function morning_records_sc_gap_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_gap_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_gap_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

//[trx_gap]Fullwidth content[/trx_gap]

if (!function_exists('morning_records_sc_gap')) {	
	function morning_records_sc_gap($atts, $content = null) {
		if (morning_records_in_shortcode_blogger()) return '';
		$output = morning_records_gap_start() . do_shortcode($content) . morning_records_gap_end();
		return apply_filters('morning_records_shortcode_output', $output, 'trx_gap', $atts, $content);
	}
	morning_records_require_shortcode("trx_gap", "morning_records_sc_gap");
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_gap_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_gap_reg_shortcodes');
	function morning_records_sc_gap_reg_shortcodes() {
	
		morning_records_sc_map("trx_gap", array(
			"title" => esc_html__("Gap", 'morning-records'),
			"desc" => wp_kses_data( __("Insert gap (fullwidth area) in the post content. Attention! Use the gap only in the posts (pages) without left or right sidebar", 'morning-records') ),
			"decorate" => true,
			"container" => true,
			"params" => array(
				"_content_" => array(
					"title" => esc_html__("Gap content", 'morning-records'),
					"desc" => wp_kses_data( __("Gap inner content", 'morning-records') ),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				)
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_gap_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_gap_reg_shortcodes_vc');
	function morning_records_sc_gap_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_gap",
			"name" => esc_html__("Gap", 'morning-records'),
			"description" => wp_kses_data( __("Insert gap (fullwidth area) in the post content", 'morning-records') ),
			"category" => esc_html__('Structure', 'morning-records'),
			'icon' => 'icon_trx_gap',
			"class" => "trx_sc_collection trx_sc_gap",
			"content_element" => true,
			"is_container" => true,
			"show_settings_on_create" => false,
			"params" => array(
				/*
				array(
					"param_name" => "content",
					"heading" => esc_html__("Gap content", 'morning-records'),
					"description" => wp_kses_data( __("Gap inner content", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textarea_html"
				)
				*/
			)
		) );
		
		class WPBakeryShortCode_Trx_Gap extends MORNING_RECORDS_VC_ShortCodeCollection {}
	}
}
?>