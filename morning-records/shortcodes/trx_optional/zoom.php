<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_zoom_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_zoom_theme_setup' );
	function morning_records_sc_zoom_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_zoom_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_zoom_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_zoom id="unique_id" border="none|light|dark"]
*/

if (!function_exists('morning_records_sc_zoom')) {	
	function morning_records_sc_zoom($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"effect" => "zoom",
			"src" => "",
			"url" => "",
			"over" => "",
			"align" => "",
			"bg_image" => "",
			"bg_top" => '',
			"bg_bottom" => '',
			"bg_left" => '',
			"bg_right" => '',
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
	
		morning_records_enqueue_script( 'morning_records-elevate-zoom-script', morning_records_get_file_url('js/jquery.elevateZoom-3.0.4.js'), array(), null, true );
	
		$class .= ($class ? ' ' : '') . morning_records_get_css_position_as_classes($top, $right, $bottom, $left);
		$css_dim = morning_records_get_css_dimensions_from_values($width, $height);
		$css_bg = morning_records_get_css_paddings_from_values($bg_top, $bg_right, $bg_bottom, $bg_left);
		$width  = morning_records_prepare_css_value($width);
		$height = morning_records_prepare_css_value($height);
		if (empty($id)) $id = 'sc_zoom_'.str_replace('.', '', mt_rand());
		$src = $src!='' ? $src : $url;
		if ($src > 0) {
			$attach = wp_get_attachment_image_src( $src, 'full' );
			if (isset($attach[0]) && $attach[0]!='')
				$src = $attach[0];
		}
		if ($over > 0) {
			$attach = wp_get_attachment_image_src( $over, 'full' );
			if (isset($attach[0]) && $attach[0]!='')
				$over = $attach[0];
		}
		if ($effect=='lens' && ((int) $width > 0 && morning_records_substr($width, -2, 2)=='px') || ((int) $height > 0 && morning_records_substr($height, -2, 2)=='px')) {
			if ($src)
				$src = morning_records_get_resized_image_url($src, (int) $width > 0 && morning_records_substr($width, -2, 2)=='px' ? (int) $width : null, (int) $height > 0 && morning_records_substr($height, -2, 2)=='px' ? (int) $height : null);
			if ($over)
				$over = morning_records_get_resized_image_url($over, (int) $width > 0 && morning_records_substr($width, -2, 2)=='px' ? (int) $width : null, (int) $height > 0 && morning_records_substr($height, -2, 2)=='px' ? (int) $height : null);
		}
		if ($bg_image > 0) {
			$attach = wp_get_attachment_image_src( $bg_image, 'full' );
			if (isset($attach[0]) && $attach[0]!='')
				$bg_image = $attach[0];
		}
		if ($bg_image) {
			$css_bg .= $css . 'background-image: url('.esc_url($bg_image).');';
			$css = $css_dim;
		} else {
			$css .= $css_dim;
		}
		$output = empty($src) 
				? '' 
				: (
					(!empty($bg_image) 
						? '<div class="sc_zoom_wrap'
								. (!empty($class) ? ' '.esc_attr($class) : '')
								. ($align && $align!='none' ? ' align'.esc_attr($align) : '') 
								. '"'
							. (!morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '')
							. ($css_bg!='' ? ' style="'.esc_attr($css_bg).'"' : '') 
							. '>' 
						: '')
					.'<div' . ($id ? ' id="'.esc_attr($id).'"' : '') 
						. ' class="sc_zoom' 
								. (empty($bg_image) && !empty($class) ? ' '.esc_attr($class) : '') 
								. (empty($bg_image) && $align && $align!='none' ? ' align'.esc_attr($align) : '')
								. '"'
							. (empty($bg_image) && !morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '')
							. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
							. '>'
							. '<img src="'.esc_url($src).'"' . ($css_dim!='' ? ' style="'.esc_attr($css_dim).'"' : '') . ' data-zoom-image="'.esc_url($over).'" alt="" />'
					. '</div>'
					. (!empty($bg_image) 
						? '</div>' 
						: '')
				);
		return apply_filters('morning_records_shortcode_output', $output, 'trx_zoom', $atts, $content);
	}
	morning_records_require_shortcode('trx_zoom', 'morning_records_sc_zoom');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_zoom_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_zoom_reg_shortcodes');
	function morning_records_sc_zoom_reg_shortcodes() {
	
		morning_records_sc_map("trx_zoom", array(
			"title" => esc_html__("Zoom", 'morning-records'),
			"desc" => wp_kses_data( __("Insert the image with zoom/lens effect", 'morning-records') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"effect" => array(
					"title" => esc_html__("Effect", 'morning-records'),
					"desc" => wp_kses_data( __("Select effect to display overlapping image", 'morning-records') ),
					"value" => "lens",
					"size" => "medium",
					"type" => "switch",
					"options" => array(
						"lens" => esc_html__('Lens', 'morning-records'),
						"zoom" => esc_html__('Zoom', 'morning-records')
					)
				),
				"url" => array(
					"title" => esc_html__("Main image", 'morning-records'),
					"desc" => wp_kses_data( __("Select or upload main image", 'morning-records') ),
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				"over" => array(
					"title" => esc_html__("Overlaping image", 'morning-records'),
					"desc" => wp_kses_data( __("Select or upload overlaping image", 'morning-records') ),
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				"align" => array(
					"title" => esc_html__("Float zoom", 'morning-records'),
					"desc" => wp_kses_data( __("Float zoom to left or right side", 'morning-records') ),
					"value" => "",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => morning_records_get_sc_param('float')
				), 
				"bg_image" => array(
					"title" => esc_html__("Background image", 'morning-records'),
					"desc" => wp_kses_data( __("Select or upload image or write URL from other site for zoom block background. Attention! If you use background image - specify paddings below from background margins to zoom block in percents!", 'morning-records') ),
					"divider" => true,
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				"bg_top" => array(
					"title" => esc_html__("Top offset", 'morning-records'),
					"desc" => wp_kses_data( __("Top offset (padding) inside background image to zoom block (in percent). For example: 3%", 'morning-records') ),
					"dependency" => array(
						'bg_image' => array('not_empty')
					),
					"value" => "",
					"type" => "text"
				),
				"bg_bottom" => array(
					"title" => esc_html__("Bottom offset", 'morning-records'),
					"desc" => wp_kses_data( __("Bottom offset (padding) inside background image to zoom block (in percent). For example: 3%", 'morning-records') ),
					"dependency" => array(
						'bg_image' => array('not_empty')
					),
					"value" => "",
					"type" => "text"
				),
				"bg_left" => array(
					"title" => esc_html__("Left offset", 'morning-records'),
					"desc" => wp_kses_data( __("Left offset (padding) inside background image to zoom block (in percent). For example: 20%", 'morning-records') ),
					"dependency" => array(
						'bg_image' => array('not_empty')
					),
					"value" => "",
					"type" => "text"
				),
				"bg_right" => array(
					"title" => esc_html__("Right offset", 'morning-records'),
					"desc" => wp_kses_data( __("Right offset (padding) inside background image to zoom block (in percent). For example: 12%", 'morning-records') ),
					"dependency" => array(
						'bg_image' => array('not_empty')
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
if ( !function_exists( 'morning_records_sc_zoom_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_zoom_reg_shortcodes_vc');
	function morning_records_sc_zoom_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_zoom",
			"name" => esc_html__("Zoom", 'morning-records'),
			"description" => wp_kses_data( __("Insert the image with zoom/lens effect", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_zoom',
			"class" => "trx_sc_single trx_sc_zoom",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "effect",
					"heading" => esc_html__("Effect", 'morning-records'),
					"description" => wp_kses_data( __("Select effect to display overlapping image", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"std" => "zoom",
					"value" => array(
						esc_html__('Lens', 'morning-records') => 'lens',
						esc_html__('Zoom', 'morning-records') => 'zoom'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "url",
					"heading" => esc_html__("Main image", 'morning-records'),
					"description" => wp_kses_data( __("Select or upload main image", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				array(
					"param_name" => "over",
					"heading" => esc_html__("Overlaping image", 'morning-records'),
					"description" => wp_kses_data( __("Select or upload overlaping image", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				array(
					"param_name" => "align",
					"heading" => esc_html__("Alignment", 'morning-records'),
					"description" => wp_kses_data( __("Float zoom to left or right side", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => array_flip(morning_records_get_sc_param('float')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "bg_image",
					"heading" => esc_html__("Background image", 'morning-records'),
					"description" => wp_kses_data( __("Select or upload image or write URL from other site for zoom background. Attention! If you use background image - specify paddings below from background margins to video block in percents!", 'morning-records') ),
					"group" => esc_html__('Background', 'morning-records'),
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				array(
					"param_name" => "bg_top",
					"heading" => esc_html__("Top offset", 'morning-records'),
					"description" => wp_kses_data( __("Top offset (padding) from background image to zoom block (in percent). For example: 3%", 'morning-records') ),
					"group" => esc_html__('Background', 'morning-records'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "bg_bottom",
					"heading" => esc_html__("Bottom offset", 'morning-records'),
					"description" => wp_kses_data( __("Bottom offset (padding) from background image to zoom block (in percent). For example: 3%", 'morning-records') ),
					"group" => esc_html__('Background', 'morning-records'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "bg_left",
					"heading" => esc_html__("Left offset", 'morning-records'),
					"description" => wp_kses_data( __("Left offset (padding) from background image to zoom block (in percent). For example: 20%", 'morning-records') ),
					"group" => esc_html__('Background', 'morning-records'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "bg_right",
					"heading" => esc_html__("Right offset", 'morning-records'),
					"description" => wp_kses_data( __("Right offset (padding) from background image to zoom block (in percent). For example: 12%", 'morning-records') ),
					"group" => esc_html__('Background', 'morning-records'),
					"class" => "",
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
			)
		) );
		
		class WPBakeryShortCode_Trx_Zoom extends MORNING_RECORDS_VC_ShortCodeSingle {}
	}
}
?>