<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_title_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_title_theme_setup' );
	function morning_records_sc_title_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_title_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_title_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_title id="unique_id" style='regular|iconed' icon='' image='' background="on|off" type="1-6"]Et adipiscing integer, scelerisque pid, augue mus vel tincidunt porta[/trx_title]
*/

if (!function_exists('morning_records_sc_title')) {	
	function morning_records_sc_title($atts, $content=null){	
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"type" => "1",
			"style" => "regular",
			"align" => "",
			"font_weight" => "",
			"font_size" => "",
			"color" => "",
			"icon" => "",
			"image" => "",
			"picture" => "",
			"image_size" => "small",
			"position" => "left",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"width" => "",
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		$class .= ($class ? ' ' : '') . morning_records_get_css_position_as_classes($top, $right, $bottom, $left);
		$css .= morning_records_get_css_dimensions_from_values($width)
			.($align && $align!='none' && !morning_records_param_is_inherit($align) ? 'text-align:' . esc_attr($align) .';' : '')
			.($color ? 'color:' . esc_attr($color) .';' : '')
			.($font_weight && !morning_records_param_is_inherit($font_weight) ? 'font-weight:' . esc_attr($font_weight) .';' : '')
			.($font_size   ? 'font-size:' . esc_attr($font_size) .';' : '')
			;
		$type = min(6, max(1, $type));
		if ($picture > 0) {
			$attach = wp_get_attachment_image_src( $picture, 'full' );
			if (isset($attach[0]) && $attach[0]!='')
				$picture = $attach[0];
		}
		$pic = $style!='iconed' 
			? '' 
			: '<span class="sc_title_icon sc_title_icon_'.esc_attr($position).'  sc_title_icon_'.esc_attr($image_size).($icon!='' && $icon!='none' ? ' '.esc_attr($icon) : '').'"'.'>'
				.($picture ? '<img src="'.esc_url($picture).'" alt="" />' : '')
				.(empty($picture) && $image && $image!='none' ? '<img src="'.esc_url(morning_records_strpos($image, 'http:')!==false ? $image : morning_records_get_file_url('images/icons/'.($image).'.png')).'" alt="" />' : '')
				.'</span>';
		$output = '<h' . esc_attr($type) . ($id ? ' id="'.esc_attr($id).'"' : '')
				. ' class="sc_title sc_title_'.esc_attr($style)
					.($align && $align!='none' && !morning_records_param_is_inherit($align) ? ' sc_align_' . esc_attr($align) : '')
					.(!empty($class) ? ' '.esc_attr($class) : '')
					.'"'
				. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
				. (!morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '')
				. '>'
					. ($pic)
					. ($style=='divider' ? '<span class="sc_title_divider_before"'.($color ? ' style="background-color: '.esc_attr($color).'"' : '').'></span>' : '')
					. do_shortcode($content) 
					. ($style=='divider' ? '<span class="sc_title_divider_after"'.($color ? ' style="background-color: '.esc_attr($color).'"' : '').'></span>' : '')
				. '</h' . esc_attr($type) . '>';
		return apply_filters('morning_records_shortcode_output', $output, 'trx_title', $atts, $content);
	}
	morning_records_require_shortcode('trx_title', 'morning_records_sc_title');
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_title_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_title_reg_shortcodes');
	function morning_records_sc_title_reg_shortcodes() {
	
		morning_records_sc_map("trx_title", array(
			"title" => esc_html__("Title", 'morning-records'),
			"desc" => wp_kses_data( __("Create header tag (1-6 level) with many styles", 'morning-records') ),
			"decorate" => false,
			"container" => true,
			"params" => array(
				"_content_" => array(
					"title" => esc_html__("Title content", 'morning-records'),
					"desc" => wp_kses_data( __("Title content", 'morning-records') ),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				"type" => array(
					"title" => esc_html__("Title type", 'morning-records'),
					"desc" => wp_kses_data( __("Title type (header level)", 'morning-records') ),
					"divider" => true,
					"value" => "1",
					"type" => "select",
					"options" => array(
						'1' => esc_html__('Header 1', 'morning-records'),
						'2' => esc_html__('Header 2', 'morning-records'),
						'3' => esc_html__('Header 3', 'morning-records'),
						'4' => esc_html__('Header 4', 'morning-records'),
						'5' => esc_html__('Header 5', 'morning-records'),
						'6' => esc_html__('Header 6', 'morning-records'),
					)
				),
				"style" => array(
					"title" => esc_html__("Title style", 'morning-records'),
					"desc" => wp_kses_data( __("Title style", 'morning-records') ),
					"value" => "regular",
					"type" => "select",
					"options" => array(
						'regular' => esc_html__('Regular', 'morning-records'),
						'underline' => esc_html__('Underline', 'morning-records'),
						'divider' => esc_html__('Divider', 'morning-records'),
						'iconed' => esc_html__('With icon (image)', 'morning-records')
					)
				),
				"align" => array(
					"title" => esc_html__("Alignment", 'morning-records'),
					"desc" => wp_kses_data( __("Title text alignment", 'morning-records') ),
					"value" => "",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => morning_records_get_sc_param('align')
				), 
				"font_size" => array(
					"title" => esc_html__("Font_size", 'morning-records'),
					"desc" => wp_kses_data( __("Custom font size. If empty - use theme default", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"font_weight" => array(
					"title" => esc_html__("Font weight", 'morning-records'),
					"desc" => wp_kses_data( __("Custom font weight. If empty or inherit - use theme default", 'morning-records') ),
					"value" => "",
					"type" => "select",
					"size" => "medium",
					"options" => array(
						'inherit' => esc_html__('Default', 'morning-records'),
						'100' => esc_html__('Thin (100)', 'morning-records'),
						'300' => esc_html__('Light (300)', 'morning-records'),
						'400' => esc_html__('Normal (400)', 'morning-records'),
						'600' => esc_html__('Semibold (600)', 'morning-records'),
						'700' => esc_html__('Bold (700)', 'morning-records'),
						'900' => esc_html__('Black (900)', 'morning-records')
					)
				),
				"color" => array(
					"title" => esc_html__("Title color", 'morning-records'),
					"desc" => wp_kses_data( __("Select color for the title", 'morning-records') ),
					"value" => "",
					"type" => "color"
				),
				"icon" => array(
					"title" => esc_html__('Title font icon',  'morning-records'),
					"desc" => wp_kses_data( __("Select font icon for the title from Fontello icons set (if style=iconed)",  'morning-records') ),
					"dependency" => array(
						'style' => array('iconed')
					),
					"value" => "",
					"type" => "icons",
					"options" => morning_records_get_sc_param('icons')
				),
				"image" => array(
					"title" => esc_html__('or image icon',  'morning-records'),
					"desc" => wp_kses_data( __("Select image icon for the title instead icon above (if style=iconed)",  'morning-records') ),
					"dependency" => array(
						'style' => array('iconed')
					),
					"value" => "",
					"type" => "images",
					"size" => "small",
					"options" => morning_records_get_sc_param('images')
				),
				"picture" => array(
					"title" => esc_html__('or URL for image file', 'morning-records'),
					"desc" => wp_kses_data( __("Select or upload image or write URL from other site (if style=iconed)", 'morning-records') ),
					"dependency" => array(
						'style' => array('iconed')
					),
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				"image_size" => array(
					"title" => esc_html__('Image (picture) size', 'morning-records'),
					"desc" => wp_kses_data( __("Select image (picture) size (if style='iconed')", 'morning-records') ),
					"dependency" => array(
						'style' => array('iconed')
					),
					"value" => "small",
					"type" => "checklist",
					"options" => array(
						'small' => esc_html__('Small', 'morning-records'),
						'medium' => esc_html__('Medium', 'morning-records'),
						'large' => esc_html__('Large', 'morning-records')
					)
				),
				"position" => array(
					"title" => esc_html__('Icon (image) position', 'morning-records'),
					"desc" => wp_kses_data( __("Select icon (image) position (if style=iconed)", 'morning-records') ),
					"dependency" => array(
						'style' => array('iconed')
					),
					"value" => "left",
					"type" => "checklist",
					"options" => array(
						'top' => esc_html__('Top', 'morning-records'),
						'left' => esc_html__('Left', 'morning-records')
					)
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
if ( !function_exists( 'morning_records_sc_title_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_title_reg_shortcodes_vc');
	function morning_records_sc_title_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_title",
			"name" => esc_html__("Title", 'morning-records'),
			"description" => wp_kses_data( __("Create header tag (1-6 level) with many styles", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_title',
			"class" => "trx_sc_single trx_sc_title",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "content",
					"heading" => esc_html__("Title content", 'morning-records'),
					"description" => wp_kses_data( __("Title content", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textarea_html"
				),
				array(
					"param_name" => "type",
					"heading" => esc_html__("Title type", 'morning-records'),
					"description" => wp_kses_data( __("Title type (header level)", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => array(
						esc_html__('Header 1', 'morning-records') => '1',
						esc_html__('Header 2', 'morning-records') => '2',
						esc_html__('Header 3', 'morning-records') => '3',
						esc_html__('Header 4', 'morning-records') => '4',
						esc_html__('Header 5', 'morning-records') => '5',
						esc_html__('Header 6', 'morning-records') => '6'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "style",
					"heading" => esc_html__("Title style", 'morning-records'),
					"description" => wp_kses_data( __("Title style: only text (regular) or with icon/image (iconed)", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => array(
						esc_html__('Regular', 'morning-records') => 'regular',
						esc_html__('Underline', 'morning-records') => 'underline',
						esc_html__('Divider', 'morning-records') => 'divider',
						esc_html__('With icon (image)', 'morning-records') => 'iconed'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "align",
					"heading" => esc_html__("Alignment", 'morning-records'),
					"description" => wp_kses_data( __("Title text alignment", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => array_flip(morning_records_get_sc_param('align')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "font_size",
					"heading" => esc_html__("Font size", 'morning-records'),
					"description" => wp_kses_data( __("Custom font size. If empty - use theme default", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "font_weight",
					"heading" => esc_html__("Font weight", 'morning-records'),
					"description" => wp_kses_data( __("Custom font weight. If empty or inherit - use theme default", 'morning-records') ),
					"class" => "",
					"value" => array(
						esc_html__('Default', 'morning-records') => 'inherit',
						esc_html__('Thin (100)', 'morning-records') => '100',
						esc_html__('Light (300)', 'morning-records') => '300',
						esc_html__('Normal (400)', 'morning-records') => '400',
						esc_html__('Semibold (600)', 'morning-records') => '600',
						esc_html__('Bold (700)', 'morning-records') => '700',
						esc_html__('Black (900)', 'morning-records') => '900'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "color",
					"heading" => esc_html__("Title color", 'morning-records'),
					"description" => wp_kses_data( __("Select color for the title", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "colorpicker"
				),
				array(
					"param_name" => "icon",
					"heading" => esc_html__("Title font icon", 'morning-records'),
					"description" => wp_kses_data( __("Select font icon for the title from Fontello icons set (if style=iconed)", 'morning-records') ),
					"class" => "",
					"group" => esc_html__('Icon &amp; Image', 'morning-records'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('iconed')
					),
					"value" => morning_records_get_sc_param('icons'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "image",
					"heading" => esc_html__("or image icon", 'morning-records'),
					"description" => wp_kses_data( __("Select image icon for the title instead icon above (if style=iconed)", 'morning-records') ),
					"class" => "",
					"group" => esc_html__('Icon &amp; Image', 'morning-records'),
					'dependency' => array(
						'element' => 'style',
						'value' => array('iconed')
					),
					"value" => morning_records_get_sc_param('images'),
					"type" => "dropdown"
				),
				array(
					"param_name" => "picture",
					"heading" => esc_html__("or select uploaded image", 'morning-records'),
					"description" => wp_kses_data( __("Select or upload image or write URL from other site (if style=iconed)", 'morning-records') ),
					"group" => esc_html__('Icon &amp; Image', 'morning-records'),
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				array(
					"param_name" => "image_size",
					"heading" => esc_html__("Image (picture) size", 'morning-records'),
					"description" => wp_kses_data( __("Select image (picture) size (if style=iconed)", 'morning-records') ),
					"group" => esc_html__('Icon &amp; Image', 'morning-records'),
					"class" => "",
					"value" => array(
						esc_html__('Small', 'morning-records') => 'small',
						esc_html__('Medium', 'morning-records') => 'medium',
						esc_html__('Large', 'morning-records') => 'large'
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "position",
					"heading" => esc_html__("Icon (image) position", 'morning-records'),
					"description" => wp_kses_data( __("Select icon (image) position (if style=iconed)", 'morning-records') ),
					"group" => esc_html__('Icon &amp; Image', 'morning-records'),
					"class" => "",
					"std" => "left",
					"value" => array(
						esc_html__('Top', 'morning-records') => 'top',
						esc_html__('Left', 'morning-records') => 'left'
					),
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
			'js_view' => 'VcTrxTextView'
		) );
		
		class WPBakeryShortCode_Trx_Title extends MORNING_RECORDS_VC_ShortCodeSingle {}
	}
}
?>