<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_accordion_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_accordion_theme_setup' );
	function morning_records_sc_accordion_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_accordion_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_accordion_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_accordion counter="off" initial="1"]
	[trx_accordion_item title="Accordion Title 1"]Lorem ipsum dolor sit amet, consectetur adipisicing elit[/trx_accordion_item]
	[trx_accordion_item title="Accordion Title 2"]Proin dignissim commodo magna at luctus. Nam molestie justo augue, nec eleifend urna laoreet non.[/trx_accordion_item]
	[trx_accordion_item title="Accordion Title 3 with custom icons" icon_closed="icon-check" icon_opened="icon-delete"]Curabitur tristique tempus arcu a placerat.[/trx_accordion_item]
[/trx_accordion]
*/
if (!function_exists('morning_records_sc_accordion')) {	
	function morning_records_sc_accordion($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"initial" => "1",
			"counter" => "off",
            "icon_before" => "icon-calendar-light",
            "icon_closed" => "icon-plus",
			"icon_opened" => "icon-minus",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
			"animation" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . morning_records_get_css_position_as_classes($top, $right, $bottom, $left);
		$initial = max(0, (int) $initial);
		morning_records_storage_set('sc_accordion_data', array(
			'counter' => 0,
            'show_counter' => morning_records_param_is_on($counter),
            'icon_before' => empty($icon_before) || morning_records_param_is_inherit($icon_before) ? "icon-calendar-light" : $icon_before,
            'icon_closed' => empty($icon_closed) || morning_records_param_is_inherit($icon_closed) ? "icon-plus" : $icon_closed,
            'icon_opened' => empty($icon_opened) || morning_records_param_is_inherit($icon_opened) ? "icon-minus" : $icon_opened
            )
        );
		morning_records_enqueue_script('jquery-ui-accordion', false, array('jquery','jquery-ui-core'), null, true);
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
				. ' class="sc_accordion'
					. (!empty($class) ? ' '.esc_attr($class) : '')
					. (morning_records_param_is_on($counter) ? ' sc_show_counter' : '') 
				. '"'
				. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
				. ' data-active="' . ($initial-1) . '"'
				. (!morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '')
				. '>'
				. do_shortcode($content)
				. '</div>';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_accordion', $atts, $content);
	}
	morning_records_require_shortcode('trx_accordion', 'morning_records_sc_accordion');
}


if (!function_exists('morning_records_sc_accordion_item')) {	
	function morning_records_sc_accordion_item($atts, $content=null) {
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts( array(
			// Individual params
            "icon_before" => "",
            "icon_closed" => "",
			"icon_opened" => "",
			"title" => "",
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
		), $atts)));
		morning_records_storage_inc_array('sc_accordion_data', 'counter');
        if (empty($icon_before) || morning_records_param_is_inherit($icon_before)) $icon_before = morning_records_storage_get_array('sc_accordion_data', 'icon_before', '', "icon-calendar-light");
        if (empty($icon_closed) || morning_records_param_is_inherit($icon_closed)) $icon_closed = morning_records_storage_get_array('sc_accordion_data', 'icon_closed', '', "icon-plus");
		if (empty($icon_opened) || morning_records_param_is_inherit($icon_opened)) $icon_opened = morning_records_storage_get_array('sc_accordion_data', 'icon_opened', '', "icon-minus");
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
				. ' class="sc_accordion_item' 
				. (!empty($class) ? ' '.esc_attr($class) : '')
				. (morning_records_storage_get_array('sc_accordion_data', 'counter') % 2 == 1 ? ' odd' : ' even') 
				. (morning_records_storage_get_array('sc_accordion_data', 'counter') == 1 ? ' first' : '') 
				. '">'
				. '<h5 class="sc_accordion_title">'
                . (!morning_records_param_is_off($icon_before) ? '<span class="sc_accordion_icon_before '.esc_attr($icon_before).'"></span>' : '')
                . (!morning_records_param_is_off($icon_closed) ? '<span class="sc_accordion_icon sc_accordion_icon_closed '.esc_attr($icon_closed).'"></span>' : '')
				. (!morning_records_param_is_off($icon_opened) ? '<span class="sc_accordion_icon sc_accordion_icon_opened '.esc_attr($icon_opened).'"></span>' : '')
				. (morning_records_storage_get_array('sc_accordion_data', 'show_counter') ? '<span class="sc_items_counter">'.(morning_records_storage_get_array('sc_accordion_data', 'counter')).'</span>' : '')
				. ($title)
				. '</h5>'
				. '<div class="sc_accordion_content"'
					. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
					. '>'
					. do_shortcode($content) 
				. '</div>'
				. '</div>';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_accordion_item', $atts, $content);
	}
	morning_records_require_shortcode('trx_accordion_item', 'morning_records_sc_accordion_item');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_accordion_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_accordion_reg_shortcodes');
	function morning_records_sc_accordion_reg_shortcodes() {
	
		morning_records_sc_map("trx_accordion", array(
			"title" => esc_html__("Accordion", 'morning-records'),
			"desc" => wp_kses_data( __("Accordion items", 'morning-records') ),
			"decorate" => true,
			"container" => false,
			"params" => array(
				"counter" => array(
					"title" => esc_html__("Counter", 'morning-records'),
					"desc" => wp_kses_data( __("Display counter before each accordion title", 'morning-records') ),
					"value" => "off",
					"type" => "switch",
					"options" => morning_records_get_sc_param('on_off')
				),
				"initial" => array(
					"title" => esc_html__("Initially opened item", 'morning-records'),
					"desc" => wp_kses_data( __("Number of initially opened item", 'morning-records') ),
					"value" => 1,
					"min" => 0,
					"type" => "spinner"
				),
                "icon_before" => array(
                    "title" => esc_html__("Icon before title",  'morning-records'),
                    "desc" => wp_kses_data( __('Select icon before title accordion item from Fontello icons set',  'morning-records') ),
                    "value" => "",
                    "type" => "icons",
                    "options" => morning_records_get_sc_param('icons')
                ),
                "icon_closed" => array(
					"title" => esc_html__("Icon while closed",  'morning-records'),
					"desc" => wp_kses_data( __('Select icon for the closed accordion item from Fontello icons set',  'morning-records') ),
					"value" => "",
					"type" => "icons",
					"options" => morning_records_get_sc_param('icons')
				),
				"icon_opened" => array(
					"title" => esc_html__("Icon while opened",  'morning-records'),
					"desc" => wp_kses_data( __('Select icon for the opened accordion item from Fontello icons set',  'morning-records') ),
					"value" => "",
					"type" => "icons",
					"options" => morning_records_get_sc_param('icons')
				),
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
				"name" => "trx_accordion_item",
				"title" => esc_html__("Item", 'morning-records'),
				"desc" => wp_kses_data( __("Accordion item", 'morning-records') ),
				"container" => true,
				"params" => array(
					"title" => array(
						"title" => esc_html__("Accordion item title", 'morning-records'),
						"desc" => wp_kses_data( __("Title for current accordion item", 'morning-records') ),
						"value" => "",
						"type" => "text"
					),
                    "icon_before" => array(
                        "title" => esc_html__("Icon before title",  'morning-records'),
                        "desc" => wp_kses_data( __('Select icon before title accordion item from Fontello icons set',  'morning-records') ),
                        "value" => "",
                        "type" => "icons",
                        "options" => morning_records_get_sc_param('icons')
                    ),
                    "icon_closed" => array(
						"title" => esc_html__("Icon while closed",  'morning-records'),
						"desc" => wp_kses_data( __('Select icon for the closed accordion item from Fontello icons set',  'morning-records') ),
						"value" => "",
						"type" => "icons",
						"options" => morning_records_get_sc_param('icons')
					),
					"icon_opened" => array(
						"title" => esc_html__("Icon while opened",  'morning-records'),
						"desc" => wp_kses_data( __('Select icon for the opened accordion item from Fontello icons set',  'morning-records') ),
						"value" => "",
						"type" => "icons",
						"options" => morning_records_get_sc_param('icons')
					),
					"_content_" => array(
						"title" => esc_html__("Accordion item content", 'morning-records'),
						"desc" => wp_kses_data( __("Current accordion item content", 'morning-records') ),
						"rows" => 4,
						"value" => "",
						"type" => "textarea"
					),
					"id" => morning_records_get_sc_param('id'),
					"class" => morning_records_get_sc_param('class'),
					"css" => morning_records_get_sc_param('css')
				)
			)
		));
	}
}


/* Register shortcode in the VC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_accordion_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_accordion_reg_shortcodes_vc');
	function morning_records_sc_accordion_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_accordion",
			"name" => esc_html__("Accordion", 'morning-records'),
			"description" => wp_kses_data( __("Accordion items", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_accordion',
			"class" => "trx_sc_collection trx_sc_accordion",
			"content_element" => true,
			"is_container" => true,
			"show_settings_on_create" => false,
			"as_parent" => array('only' => 'trx_accordion_item'),	// Use only|except attributes to limit child shortcodes (separate multiple values with comma)
			"params" => array(
				array(
					"param_name" => "counter",
					"heading" => esc_html__("Counter", 'morning-records'),
					"description" => wp_kses_data( __("Display counter before each accordion title", 'morning-records') ),
					"class" => "",
					"value" => array("Add item numbers before each element" => "on" ),
					"type" => "checkbox"
				),
				array(
					"param_name" => "initial",
					"heading" => esc_html__("Initially opened item", 'morning-records'),
					"description" => wp_kses_data( __("Number of initially opened item", 'morning-records') ),
					"class" => "",
					"value" => 1,
					"type" => "textfield"
				),
                array(
                    "param_name" => "icon_before",
                    "heading" => esc_html__("Icon before title", 'morning-records'),
                    "description" => wp_kses_data( __("Select icon before title accordion item from Fontello icons set", 'morning-records') ),
                    "class" => "",
                    "value" => morning_records_get_sc_param('icons'),
                    "type" => "dropdown"
                ),	
                array(
					"param_name" => "icon_closed",
					"heading" => esc_html__("Icon while closed", 'morning-records'),
					"description" => wp_kses_data( __("Select icon for the closed accordion item from Fontello icons set", 'morning-records') ),
					"class" => "",
					"value" => morning_records_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "icon_opened",
					"heading" => esc_html__("Icon while opened", 'morning-records'),
					"description" => wp_kses_data( __("Select icon for the opened accordion item from Fontello icons set", 'morning-records') ),
					"class" => "",
					"value" => morning_records_get_sc_param('icons'),
					"type" => "dropdown"
				),
				morning_records_get_vc_param('id'),
				morning_records_get_vc_param('class'),
				morning_records_get_vc_param('animation'),
				morning_records_get_vc_param('css'),
				morning_records_get_vc_param('margin_top'),
				morning_records_get_vc_param('margin_bottom'),
				morning_records_get_vc_param('margin_left'),
				morning_records_get_vc_param('margin_right')
			),
			'default_content' => '
				[trx_accordion_item title="' . esc_html__( 'Item 1 title', 'morning-records' ) . '"][/trx_accordion_item]
				[trx_accordion_item title="' . esc_html__( 'Item 2 title', 'morning-records' ) . '"][/trx_accordion_item]
			',
			"custom_markup" => '
				<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
					%content%
				</div>
				<div class="tab_controls">
					<button class="add_tab" title="'.esc_attr__("Add item", 'morning-records').'">'.esc_html__("Add item", 'morning-records').'</button>
				</div>
			',
			'js_view' => 'VcTrxAccordionView'
		) );
		
		
		vc_map( array(
			"base" => "trx_accordion_item",
			"name" => esc_html__("Accordion item", 'morning-records'),
			"description" => wp_kses_data( __("Inner accordion item", 'morning-records') ),
			"show_settings_on_create" => true,
			"content_element" => true,
			"is_container" => true,
			'icon' => 'icon_trx_accordion_item',
			"as_child" => array('only' => 'trx_accordion'), 	// Use only|except attributes to limit parent (separate multiple values with comma)
			"as_parent" => array('except' => 'trx_accordion'),
			"params" => array(
				array(
					"param_name" => "title",
					"heading" => esc_html__("Title", 'morning-records'),
					"description" => wp_kses_data( __("Title for current accordion item", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
                array(
                    "param_name" => "icon_before",
                    "heading" => esc_html__("Icon before title", 'morning-records'),
                    "description" => wp_kses_data( __("Select icon before title accordion item from Fontello icons set", 'morning-records') ),
                    "class" => "",
                    "value" => morning_records_get_sc_param('icons'),
                    "type" => "dropdown"
                ),
                array(
					"param_name" => "icon_closed",
					"heading" => esc_html__("Icon while closed", 'morning-records'),
					"description" => wp_kses_data( __("Select icon for the closed accordion item from Fontello icons set", 'morning-records') ),
					"class" => "",
					"value" => morning_records_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "icon_opened",
					"heading" => esc_html__("Icon while opened", 'morning-records'),
					"description" => wp_kses_data( __("Select icon for the opened accordion item from Fontello icons set", 'morning-records') ),
					"class" => "",
					"value" => morning_records_get_sc_param('icons'),
					"type" => "dropdown"
				),
				morning_records_get_vc_param('id'),
				morning_records_get_vc_param('class'),
				morning_records_get_vc_param('css')
			),
		  'js_view' => 'VcTrxAccordionTabView'
		) );

		class WPBakeryShortCode_Trx_Accordion extends MORNING_RECORDS_VC_ShortCodeAccordion {}
		class WPBakeryShortCode_Trx_Accordion_Item extends MORNING_RECORDS_VC_ShortCodeAccordionItem {}
	}
}
?>