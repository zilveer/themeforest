<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_hide_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_hide_theme_setup' );
	function morning_records_sc_hide_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_hide_reg_shortcodes');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_hide selector="unique_id"]
*/

if (!function_exists('morning_records_sc_hide')) {	
	function morning_records_sc_hide($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"selector" => "",
			"hide" => "on",
			"delay" => 0
		), $atts)));
		$selector = trim(chop($selector));
		$output = $selector == '' ? '' : 
			'<script type="text/javascript">
				jQuery(document).ready(function() {
					'.($delay>0 ? 'setTimeout(function() {' : '').'
					jQuery("'.esc_attr($selector).'").' . ($hide=='on' ? 'hide' : 'show') . '();
					'.($delay>0 ? '},'.($delay).');' : '').'
				});
			</script>';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_hide', $atts, $content);
	}
	morning_records_require_shortcode('trx_hide', 'morning_records_sc_hide');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_hide_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_hide_reg_shortcodes');
	function morning_records_sc_hide_reg_shortcodes() {
	
		morning_records_sc_map("trx_hide", array(
			"title" => esc_html__("Hide/Show any block", 'morning-records'),
			"desc" => wp_kses_data( __("Hide or Show any block with desired CSS-selector", 'morning-records') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"selector" => array(
					"title" => esc_html__("Selector", 'morning-records'),
					"desc" => wp_kses_data( __("Any block's CSS-selector", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"hide" => array(
					"title" => esc_html__("Hide or Show", 'morning-records'),
					"desc" => wp_kses_data( __("New state for the block: hide or show", 'morning-records') ),
					"value" => "yes",
					"size" => "small",
					"options" => morning_records_get_sc_param('yes_no'),
					"type" => "switch"
				)
			)
		));
	}
}
?>