<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_button_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_button_theme_setup' );
	function morning_records_sc_button_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_button_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_button_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_button id="unique_id" type="square|round" fullsize="0|1" style="global|light|dark" size="mini|medium|big|huge|banner" icon="icon-name" link='#' target='']Button caption[/trx_button]
*/

if (!function_exists('morning_records_sc_button')) {	
	function morning_records_sc_button($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"type" => "square",
			"style" => "filled",
			"size" => "small",
			"icon" => "",
			"color" => "",
			"bg_color" => "",
			"link" => "",
			"target" => "",
			"align" => "",
			"rel" => "",
			"popup" => "no",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
			"animation" => "",
			"width" => "",
			"height" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . morning_records_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= morning_records_get_css_dimensions_from_values($width, $height)
			. ($color !== '' ? 'color:' . esc_attr($color) .';' : '')
			. ($bg_color !== '' ? 'background-color:' . esc_attr($bg_color) . '; border-color:'. esc_attr($bg_color) .';' : '');
		if (morning_records_param_is_on($popup)) morning_records_enqueue_popup('magnific');
		$output = '<a href="' . (empty($link) ? '#' : $link) . '"'
			. (!empty($target) ? ' target="'.esc_attr($target).'"' : '')
			. (!empty($rel) ? ' rel="'.esc_attr($rel).'"' : '')
			. (!morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '')
			. ' class="sc_button sc_button_' . esc_attr($type) 
					. ' sc_button_style_' . esc_attr($style) 
					. ' sc_button_size_' . esc_attr($size)
					. ($align && $align!='none' ? ' align'.esc_attr($align) : '') 
					. (!empty($class) ? ' '.esc_attr($class) : '')
					. ($icon!='' ? '  sc_button_iconed '. esc_attr($icon) : '') 
					. (morning_records_param_is_on($popup) ? ' sc_popup_link' : '') 
					. '"'
			. ($id ? ' id="'.esc_attr($id).'"' : '') 
			. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
			. '>'
			. do_shortcode($content)
			. '</a>';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_button', $atts, $content);
	}
	morning_records_require_shortcode('trx_button', 'morning_records_sc_button');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_button_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_button_reg_shortcodes');
	function morning_records_sc_button_reg_shortcodes() {
	
		morning_records_sc_map("trx_button", array(
			"title" => esc_html__("Button", 'morning-records'),
			"desc" => wp_kses_data( __("Button with link", 'morning-records') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"_content_" => array(
					"title" => esc_html__("Caption", 'morning-records'),
					"desc" => wp_kses_data( __("Button caption", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"type" => array(
					"title" => esc_html__("Button's shape", 'morning-records'),
					"desc" => wp_kses_data( __("Select button's shape", 'morning-records') ),
					"value" => "square",
					"size" => "medium",
					"options" => array(
						'square' => esc_html__('Square', 'morning-records'),
						'round' => esc_html__('Round', 'morning-records')
					),
					"type" => "switch"
				), 
				"style" => array(
					"title" => esc_html__("Button's style", 'morning-records'),
					"desc" => wp_kses_data( __("Select button's style", 'morning-records') ),
					"value" => "default",
					"dir" => "horizontal",
					"options" => array(
						'filled' => esc_html__('Filled', 'morning-records'),
						'filled_2' => esc_html__('Filled 2', 'morning-records'),
						'border' => esc_html__('Border', 'morning-records'),
						'anchor' => esc_html__('Anchor', 'morning-records')
					),
					"type" => "checklist"
				), 
				"size" => array(
					"title" => esc_html__("Button's size", 'morning-records'),
					"desc" => wp_kses_data( __("Select button's size", 'morning-records') ),
					"value" => "small",
					"dir" => "horizontal",
					"options" => array(
						'small' => esc_html__('Small', 'morning-records'),
						'medium' => esc_html__('Medium', 'morning-records'),
						'large' => esc_html__('Large', 'morning-records')
					),
					"type" => "checklist"
				), 
				"icon" => array(
					"title" => esc_html__("Button's icon",  'morning-records'),
					"desc" => wp_kses_data( __('Select icon for the title from Fontello icons set',  'morning-records') ),
					"value" => "",
					"type" => "icons",
					"options" => morning_records_get_sc_param('icons')
				),
				"color" => array(
					"title" => esc_html__("Button's text color", 'morning-records'),
					"desc" => wp_kses_data( __("Any color for button's caption", 'morning-records') ),
					"std" => "",
					"value" => "",
					"type" => "color"
				),
				"bg_color" => array(
					"title" => esc_html__("Button's backcolor", 'morning-records'),
					"desc" => wp_kses_data( __("Any color for button's background", 'morning-records') ),
					"value" => "",
					"type" => "color"
				),
				"align" => array(
					"title" => esc_html__("Button's alignment", 'morning-records'),
					"desc" => wp_kses_data( __("Align button to left, center or right", 'morning-records') ),
					"value" => "none",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => morning_records_get_sc_param('align')
				), 
				"link" => array(
					"title" => esc_html__("Link URL", 'morning-records'),
					"desc" => wp_kses_data( __("URL for link on button click", 'morning-records') ),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
				"target" => array(
					"title" => esc_html__("Link target", 'morning-records'),
					"desc" => wp_kses_data( __("Target for link on button click", 'morning-records') ),
					"dependency" => array(
						'link' => array('not_empty')
					),
					"value" => "",
					"type" => "text"
				),
				"popup" => array(
					"title" => esc_html__("Open link in popup", 'morning-records'),
					"desc" => wp_kses_data( __("Open link target in popup window", 'morning-records') ),
					"dependency" => array(
						'link' => array('not_empty')
					),
					"value" => "no",
					"type" => "switch",
					"options" => morning_records_get_sc_param('yes_no')
				), 
				"rel" => array(
					"title" => esc_html__("Rel attribute", 'morning-records'),
					"desc" => wp_kses_data( __("Rel attribute for button's link (if need)", 'morning-records') ),
					"dependency" => array(
						'link' => array('not_empty')
					),
					"value" => "",
					"type" => "text"
				),
				"width" => morning_records_shortcodes_width(),
				"height" => morning_records_shortcodes_height(),
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
if ( !function_exists( 'morning_records_sc_button_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_button_reg_shortcodes_vc');
	function morning_records_sc_button_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_button",
			"name" => esc_html__("Button", 'morning-records'),
			"description" => wp_kses_data( __("Button with link", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_button',
			"class" => "trx_sc_single trx_sc_button",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "content",
					"heading" => esc_html__("Caption", 'morning-records'),
					"description" => wp_kses_data( __("Button caption", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "type",
					"heading" => esc_html__("Button's shape", 'morning-records'),
					"description" => wp_kses_data( __("Select button's shape", 'morning-records') ),
					"class" => "",
					"value" => array(
						esc_html__('Square', 'morning-records') => 'square',
						esc_html__('Round', 'morning-records') => 'round'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "style",
					"heading" => esc_html__("Button's style", 'morning-records'),
					"description" => wp_kses_data( __("Select button's style", 'morning-records') ),
					"class" => "",
					"value" => array(
						esc_html__('Filled', 'morning-records') => 'filled',
						esc_html__('Filled 2', 'morning-records') => 'filled_2',
						esc_html__('Border', 'morning-records') => 'border',
						esc_html__('Anchor', 'morning-records') => 'anchor'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "size",
					"heading" => esc_html__("Button's size", 'morning-records'),
					"description" => wp_kses_data( __("Select button's size", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => array(
						esc_html__('Small', 'morning-records') => 'small',
						esc_html__('Medium', 'morning-records') => 'medium',
						esc_html__('Large', 'morning-records') => 'large'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "icon",
					"heading" => esc_html__("Button's icon", 'morning-records'),
					"description" => wp_kses_data( __("Select icon for the title from Fontello icons set", 'morning-records') ),
					"class" => "",
					"value" => morning_records_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "color",
					"heading" => esc_html__("Button's text color", 'morning-records'),
					"description" => wp_kses_data( __("Any color for button's caption", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "bg_color",
					"heading" => esc_html__("Button's backcolor", 'morning-records'),
					"description" => wp_kses_data( __("Any color for button's background", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "align",
					"heading" => esc_html__("Button's alignment", 'morning-records'),
					"description" => wp_kses_data( __("Align button to left, center or right", 'morning-records') ),
					"class" => "",
					"value" => array_flip(morning_records_get_sc_param('align')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "link",
					"heading" => esc_html__("Link URL", 'morning-records'),
					"description" => wp_kses_data( __("URL for the link on button click", 'morning-records') ),
					"class" => "",
					"group" => esc_html__('Link', 'morning-records'),
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "target",
					"heading" => esc_html__("Link target", 'morning-records'),
					"description" => wp_kses_data( __("Target for the link on button click", 'morning-records') ),
					"class" => "",
					"group" => esc_html__('Link', 'morning-records'),
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "popup",
					"heading" => esc_html__("Open link in popup", 'morning-records'),
					"description" => wp_kses_data( __("Open link target in popup window", 'morning-records') ),
					"class" => "",
					"group" => esc_html__('Link', 'morning-records'),
					"value" => array(esc_html__('Open in popup', 'morning-records') => 'yes'),
					"type" => "checkbox"
				),
				array(
					"param_name" => "rel",
					"heading" => esc_html__("Rel attribute", 'morning-records'),
					"description" => wp_kses_data( __("Rel attribute for the button's link (if need", 'morning-records') ),
					"class" => "",
					"group" => esc_html__('Link', 'morning-records'),
					"value" => "",
					"type" => "textfield"
				),
				morning_records_get_vc_param('id'),
				morning_records_get_vc_param('class'),
				morning_records_get_vc_param('animation'),
				morning_records_get_vc_param('css'),
				morning_records_vc_width(),
				morning_records_vc_height(),
				morning_records_get_vc_param('margin_top'),
				morning_records_get_vc_param('margin_bottom'),
				morning_records_get_vc_param('margin_left'),
				morning_records_get_vc_param('margin_right')
			),
			'js_view' => 'VcTrxTextView'
		) );
		
		class WPBakeryShortCode_Trx_Button extends MORNING_RECORDS_VC_ShortCodeSingle {}
	}
}
?>