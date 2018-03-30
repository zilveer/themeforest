<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_search_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_search_theme_setup' );
	function morning_records_sc_search_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_search_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_search_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_search id="unique_id" open="yes|no"]
*/

if (!function_exists('morning_records_sc_search')) {	
	function morning_records_sc_search($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"style" => "regular",
			"state" => "fixed",
			"scheme" => "original",
			"ajax" => "",
			"title" => esc_html__('Search', 'morning-records'),
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
		if (empty($ajax)) $ajax = morning_records_get_theme_option('use_ajax_search');
		// Load core messages
		morning_records_enqueue_messages();
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') . ' class="search_wrap search_style_'.esc_attr($style).' search_state_'.esc_attr($state)
						. (morning_records_param_is_on($ajax) ? ' search_ajax' : '')
						. ($class ? ' '.esc_attr($class) : '')
						. '"'
					. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
					. (!morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '')
					. '>
						<div class="search_form_wrap">
							<form role="search" method="get" class="search_form" action="' . esc_url(home_url('/')) . '">
								<button type="submit" class="search_submit icon-search-light" title="' . ($state=='closed' ? esc_attr__('Open search', 'morning-records') : esc_attr__('Start search', 'morning-records')) . '"></button>
								<input type="text" class="search_field" placeholder="' . esc_attr($title) . '" value="' . esc_attr(get_search_query()) . '" name="s" />
							</form>
						</div>
						<div class="search_results widget_area' . ($scheme && !morning_records_param_is_off($scheme) && !morning_records_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '') . '"><a class="search_results_close icon-cancel"></a><div class="search_results_content"></div></div>
				</div>';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_search', $atts, $content);
	}
	morning_records_require_shortcode('trx_search', 'morning_records_sc_search');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_search_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_search_reg_shortcodes');
	function morning_records_sc_search_reg_shortcodes() {
	
		morning_records_sc_map("trx_search", array(
			"title" => esc_html__("Search", 'morning-records'),
			"desc" => wp_kses_data( __("Show search form", 'morning-records') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"style" => array(
					"title" => esc_html__("Style", 'morning-records'),
					"desc" => wp_kses_data( __("Select style to display search field", 'morning-records') ),
					"value" => "regular",
					"options" => array(
						"regular" => esc_html__('Regular', 'morning-records'),
						"rounded" => esc_html__('Rounded', 'morning-records')
					),
					"type" => "checklist"
				),
				"state" => array(
					"title" => esc_html__("State", 'morning-records'),
					"desc" => wp_kses_data( __("Select search field initial state", 'morning-records') ),
					"value" => "fixed",
					"options" => array(
						"fixed"  => esc_html__('Fixed',  'morning-records'),
						"opened" => esc_html__('Opened', 'morning-records'),
						"closed" => esc_html__('Closed', 'morning-records')
					),
					"type" => "checklist"
				),
				"title" => array(
					"title" => esc_html__("Title", 'morning-records'),
					"desc" => wp_kses_data( __("Title (placeholder) for the search field", 'morning-records') ),
					"value" => esc_html__("Search &hellip;", 'morning-records'),
					"type" => "text"
				),
				"ajax" => array(
					"title" => esc_html__("AJAX", 'morning-records'),
					"desc" => wp_kses_data( __("Search via AJAX or reload page", 'morning-records') ),
					"value" => "yes",
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
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_search_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_search_reg_shortcodes_vc');
	function morning_records_sc_search_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_search",
			"name" => esc_html__("Search form", 'morning-records'),
			"description" => wp_kses_data( __("Insert search form", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_search',
			"class" => "trx_sc_single trx_sc_search",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "style",
					"heading" => esc_html__("Style", 'morning-records'),
					"description" => wp_kses_data( __("Select style to display search field", 'morning-records') ),
					"class" => "",
					"value" => array(
						esc_html__('Regular', 'morning-records') => "regular",
						esc_html__('Flat', 'morning-records') => "flat"
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "state",
					"heading" => esc_html__("State", 'morning-records'),
					"description" => wp_kses_data( __("Select search field initial state", 'morning-records') ),
					"class" => "",
					"value" => array(
						esc_html__('Fixed', 'morning-records')  => "fixed",
						esc_html__('Opened', 'morning-records') => "opened",
						esc_html__('Closed', 'morning-records') => "closed"
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Title", 'morning-records'),
					"description" => wp_kses_data( __("Title (placeholder) for the search field", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => esc_html__("Search &hellip;", 'morning-records'),
					"type" => "textfield"
				),
				array(
					"param_name" => "ajax",
					"heading" => esc_html__("AJAX", 'morning-records'),
					"description" => wp_kses_data( __("Search via AJAX or reload page", 'morning-records') ),
					"class" => "",
					"value" => array(esc_html__('Use AJAX search', 'morning-records') => 'yes'),
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
			)
		) );
		
		class WPBakeryShortCode_Trx_Search extends MORNING_RECORDS_VC_ShortCodeSingle {}
	}
}
?>