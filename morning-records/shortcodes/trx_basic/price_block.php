<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_price_block_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_price_block_theme_setup' );
	function morning_records_sc_price_block_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_price_block_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_price_block_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

if (!function_exists('morning_records_sc_price_block')) {	
	function morning_records_sc_price_block($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"style" => 1,
			"title" => "",
			"link" => "",
			"link_text" => "",
			"icon" => "",
			"money" => "",
			"currency" => "$",
			"period" => "",
			"align" => "",
			"scheme" => "",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"width" => "",
			"height" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$output = '';
		$class .= ($class ? ' ' : '') . morning_records_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= morning_records_get_css_dimensions_from_values($width, $height);
		if ($money) $money = do_shortcode('[trx_price money="'.esc_attr($money).'" period="'.esc_attr($period).'"'.($currency ? ' currency="'.esc_attr($currency).'"' : '').']');
		$content = do_shortcode(morning_records_sc_clear_around($content));
		$output = '<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
					. ' class="sc_price_block sc_price_block_style_'.max(1, min(3, $style))
						. (!empty($class) ? ' '.esc_attr($class) : '')
						. ($scheme && !morning_records_param_is_off($scheme) && !morning_records_param_is_inherit($scheme) ? ' scheme_'.esc_attr($scheme) : '') 
						. ($align && $align!='none' ? ' align'.esc_attr($align) : '') 
						. '"'
					. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
					. (!morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '')
					. '>'
				. (!empty($title) ? '<div class="sc_price_block_title"><h3>'.($title).'</h3></div>' : '')
				. '<div class="sc_price_block_inner">'
                    . '<div class="sc_price_block_money">'
                        . (!empty($icon) ? '<div class="sc_price_block_icon '.esc_attr($icon).'"></div>' : '')
                        . ($money)
                    . '</div>'
                    . (!empty($content) ? '<div class="sc_price_block_description">'.($content).'</div>' : '')
                    . (!empty($link_text) ? '<div class="sc_price_block_link">'.do_shortcode('[trx_button link="'.($link ? esc_url($link) : '#').'"]'.($link_text).'[/trx_button]').'</div>' : '')
                . '</div>'
			. '</div>';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_price_block', $atts, $content);
	}
	morning_records_require_shortcode('trx_price_block', 'morning_records_sc_price_block');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_price_block_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_price_block_reg_shortcodes');
	function morning_records_sc_price_block_reg_shortcodes() {
	
		morning_records_sc_map("trx_price_block", array(
			"title" => esc_html__("Price block", 'morning-records'),
			"desc" => wp_kses_data( __("Insert price block with title, price and description", 'morning-records') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"style" => array(
					"title" => esc_html__("Block style", 'morning-records'),
					"desc" => wp_kses_data( __("Select style for this price block", 'morning-records') ),
					"value" => 1,
					"options" => morning_records_get_list_styles(1, 3),
					"type" => "checklist"
				),
				"title" => array(
					"title" => esc_html__("Title", 'morning-records'),
					"desc" => wp_kses_data( __("Block title", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"link" => array(
					"title" => esc_html__("Link URL", 'morning-records'),
					"desc" => wp_kses_data( __("URL for link from button (at bottom of the block)", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"link_text" => array(
					"title" => esc_html__("Link text", 'morning-records'),
					"desc" => wp_kses_data( __("Text (caption) for the link button (at bottom of the block). If empty - button not showed", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"icon" => array(
					"title" => esc_html__("Icon",  'morning-records'),
					"desc" => wp_kses_data( __('Select icon from Fontello icons set (placed before/instead price)',  'morning-records') ),
					"value" => "",
					"type" => "icons",
					"options" => morning_records_get_sc_param('icons')
				),
				"money" => array(
					"title" => esc_html__("Money", 'morning-records'),
					"desc" => wp_kses_data( __("Money value (dot or comma separated)", 'morning-records') ),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
				"currency" => array(
					"title" => esc_html__("Currency", 'morning-records'),
					"desc" => wp_kses_data( __("Currency character", 'morning-records') ),
					"value" => "$",
					"type" => "text"
				),
				"period" => array(
					"title" => esc_html__("Period", 'morning-records'),
					"desc" => wp_kses_data( __("Period text (if need). For example: monthly, daily, etc.", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"scheme" => array(
					"title" => esc_html__("Color scheme", 'morning-records'),
					"desc" => wp_kses_data( __("Select color scheme for this block", 'morning-records') ),
					"value" => "",
					"type" => "checklist",
					"options" => morning_records_get_sc_param('schemes')
				),
				"align" => array(
					"title" => esc_html__("Alignment", 'morning-records'),
					"desc" => wp_kses_data( __("Align price to left or right side", 'morning-records') ),
					"divider" => true,
					"value" => "",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => morning_records_get_sc_param('float')
				), 
				"_content_" => array(
					"title" => esc_html__("Description", 'morning-records'),
					"desc" => wp_kses_data( __("Description for this price block", 'morning-records') ),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
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
if ( !function_exists( 'morning_records_sc_price_block_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_price_block_reg_shortcodes_vc');
	function morning_records_sc_price_block_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_price_block",
			"name" => esc_html__("Price block", 'morning-records'),
			"description" => wp_kses_data( __("Insert price block with title, price and description", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_price_block',
			"class" => "trx_sc_single trx_sc_price_block",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "style",
					"heading" => esc_html__("Block style", 'morning-records'),
					"desc" => wp_kses_data( __("Select style of this price block", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"std" => 1,
					"value" => array_flip(morning_records_get_list_styles(1, 3)),
					"type" => "dropdown"
				),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Title", 'morning-records'),
					"description" => wp_kses_data( __("Block title", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "link",
					"heading" => esc_html__("Link URL", 'morning-records'),
					"description" => wp_kses_data( __("URL for link from button (at bottom of the block)", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "link_text",
					"heading" => esc_html__("Link text", 'morning-records'),
					"description" => wp_kses_data( __("Text (caption) for the link button (at bottom of the block). If empty - button not showed", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "icon",
					"heading" => esc_html__("Icon", 'morning-records'),
					"description" => wp_kses_data( __("Select icon from Fontello icons set (placed before/instead price)", 'morning-records') ),
					"class" => "",
					"value" => morning_records_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "money",
					"heading" => esc_html__("Money", 'morning-records'),
					"description" => wp_kses_data( __("Money value (dot or comma separated)", 'morning-records') ),
					"admin_label" => true,
					"group" => esc_html__('Money', 'morning-records'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "currency",
					"heading" => esc_html__("Currency symbol", 'morning-records'),
					"description" => wp_kses_data( __("Currency character", 'morning-records') ),
					"admin_label" => true,
					"group" => esc_html__('Money', 'morning-records'),
					"class" => "",
					"value" => "$",
					"type" => "textfield"
				),
				array(
					"param_name" => "period",
					"heading" => esc_html__("Period", 'morning-records'),
					"description" => wp_kses_data( __("Period text (if need). For example: monthly, daily, etc.", 'morning-records') ),
					"admin_label" => true,
					"group" => esc_html__('Money', 'morning-records'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "scheme",
					"heading" => esc_html__("Color scheme", 'morning-records'),
					"description" => wp_kses_data( __("Select color scheme for this block", 'morning-records') ),
					"group" => esc_html__('Colors and Images', 'morning-records'),
					"class" => "",
					"value" => array_flip(morning_records_get_sc_param('schemes')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "align",
					"heading" => esc_html__("Alignment", 'morning-records'),
					"description" => wp_kses_data( __("Align price to left or right side", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => array_flip(morning_records_get_sc_param('float')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "content",
					"heading" => esc_html__("Description", 'morning-records'),
					"description" => wp_kses_data( __("Description for this price block", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textarea_html"
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
		
		class WPBakeryShortCode_Trx_PriceBlock extends MORNING_RECORDS_VC_ShortCodeSingle {}
	}
}
?>