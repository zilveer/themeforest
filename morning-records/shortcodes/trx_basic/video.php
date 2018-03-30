<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_video_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_video_theme_setup' );
	function morning_records_sc_video_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_video_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_video_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

//[trx_video id="unique_id" url="http://player.vimeo.com/video/20245032?title=0&amp;byline=0&amp;portrait=0" width="" height=""]

if (!function_exists('morning_records_sc_video')) {	
	function morning_records_sc_video($atts, $content = null) {
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"url" => '',
			"src" => '',
			"image" => '',
			"ratio" => '16:9',
			"autoplay" => 'off',
			"align" => '',
			"bg_image" => '',
			"bg_top" => '',
			"bg_bottom" => '',
			"bg_left" => '',
			"bg_right" => '',
			"frame" => "on",
			// Common params
			"id" => "",
			"class" => "",
			"animation" => "",
			"css" => "",
			"width" => '',
			"height" => '',
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
	
		if (empty($autoplay)) $autoplay = 'off';
		
		$ratio = empty($ratio) ? "16:9" : str_replace(array('/','\\','-'), ':', $ratio);
		$ratio_parts = explode(':', $ratio);
		if (empty($height) && empty($width)) {
			$width='100%';
			if (morning_records_param_is_off(morning_records_get_custom_option('substitute_video'))) $height="400";
		}
		$ed = morning_records_substr($width, -1);
		if (empty($height) && !empty($width) && $ed!='%') {
			$height = round($width / $ratio_parts[0] * $ratio_parts[1]);
		}
		if (!empty($height) && empty($width)) {
			$width = round($height * $ratio_parts[0] / $ratio_parts[1]);
		}
		$class .= ($class ? ' ' : '') . morning_records_get_css_position_as_classes($top, $right, $bottom, $left);
		$css_dim = morning_records_get_css_dimensions_from_values($width, $height);
		$css_bg = morning_records_get_css_paddings_from_values($bg_top, $bg_right, $bg_bottom, $bg_left);
	
		if ($src=='' && $url=='' && isset($atts[0])) {
			$src = $atts[0];
		}
		$url = $src!='' ? $src : $url;
		if ($image!='' && morning_records_param_is_off($image))
			$image = '';
		else {
			if (morning_records_param_is_on($autoplay) && is_singular() && !morning_records_storage_get('blog_streampage'))
				$image = '';
			else {
				if ($image > 0) {
					$attach = wp_get_attachment_image_src( $image, 'full' );
					if (isset($attach[0]) && $attach[0]!='')
						$image = $attach[0];
				}
				if ($bg_image) {
					$thumb_sizes = morning_records_get_thumb_sizes(array(
						'layout' => 'grid_3'
					));
					if (!is_single() || !empty($image)) $image = morning_records_get_resized_image_url(empty($image) ? get_the_ID() : $image, $thumb_sizes['w'], $thumb_sizes['h'], null, false, false, false);
				} else
					if (!is_single() || !empty($image)) $image = morning_records_get_resized_image_url(empty($image) ? get_the_ID() : $image, $ed!='%' ? $width : null, $height);
				if (empty($image) && (!is_singular() || morning_records_storage_get('blog_streampage')))	// || morning_records_param_is_off($autoplay)))
					$image = morning_records_get_video_cover_image($url);
			}
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
	
		$url = morning_records_get_video_player_url($src!='' ? $src : $url);
		
		$video = '<video' . ($id ? ' id="' . esc_attr($id) . '"' : '') 
			. ' class="sc_video"'
			. ' src="' . esc_url($url) . '"'
			. ' width="' . esc_attr($width) . '" height="' . esc_attr($height) . '"' 
			. ' data-width="' . esc_attr($width) . '" data-height="' . esc_attr($height) . '"' 
			. ' data-ratio="'.esc_attr($ratio).'"'
			. ($image ? ' poster="'.esc_attr($image).'" data-image="'.esc_attr($image).'"' : '') 
			. (!morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '')
			. ($align && $align!='none' ? ' data-align="'.esc_attr($align).'"' : '')
			. ($class ? ' data-class="'.esc_attr($class).'"' : '')
			. ($bg_image ? ' data-bg-image="'.esc_attr($bg_image).'"' : '') 
			. ($css_bg!='' ? ' data-style="'.esc_attr($css_bg).'"' : '') 
			. ($css!='' ? ' style="'.esc_attr($css).'"' : '') 
			. (($image && morning_records_param_is_on(morning_records_get_custom_option('substitute_video'))) || (morning_records_param_is_on($autoplay) && is_singular() && !morning_records_storage_get('blog_streampage')) ? ' autoplay="autoplay"' : '') 
			. ' controls="controls" loop="loop"'
			. '>'
			. '</video>';
		if (morning_records_param_is_off(morning_records_get_custom_option('substitute_video'))) {
			if (morning_records_param_is_on($frame)) $video = morning_records_get_video_frame($video, $image, $css, $css_bg);
		} else {
			if ((isset($_GET['vc_editable']) && $_GET['vc_editable']=='true') && (isset($_POST['action']) && $_POST['action']=='vc_load_shortcode')) {
				$video = morning_records_substitute_video($video, $width, $height, false);
			}
		}
		if (morning_records_get_theme_option('use_mediaelement')=='yes')
			morning_records_enqueue_script('wp-mediaelement');
		return apply_filters('morning_records_shortcode_output', $video, 'trx_video', $atts, $content);
	}
	morning_records_require_shortcode("trx_video", "morning_records_sc_video");
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_video_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_video_reg_shortcodes');
	function morning_records_sc_video_reg_shortcodes() {
	
		morning_records_sc_map("trx_video", array(
			"title" => esc_html__("Video", 'morning-records'),
			"desc" => wp_kses_data( __("Insert video player", 'morning-records') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"url" => array(
					"title" => esc_html__("URL for video file", 'morning-records'),
					"desc" => wp_kses_data( __("Select video from media library or paste URL for video file from other site", 'morning-records') ),
					"readonly" => false,
					"value" => "",
					"type" => "media",
					"before" => array(
						'title' => esc_html__('Choose video', 'morning-records'),
						'action' => 'media_upload',
						'type' => 'video',
						'multiple' => false,
						'linked_field' => '',
						'captions' => array( 	
							'choose' => esc_html__('Choose video file', 'morning-records'),
							'update' => esc_html__('Select video file', 'morning-records')
						)
					),
					"after" => array(
						'icon' => 'icon-cancel',
						'action' => 'media_reset'
					)
				),
				"ratio" => array(
					"title" => esc_html__("Ratio", 'morning-records'),
					"desc" => wp_kses_data( __("Ratio of the video", 'morning-records') ),
					"value" => "16:9",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => array(
						"16:9" => esc_html__("16:9", 'morning-records'),
						"4:3" => esc_html__("4:3", 'morning-records')
					)
				),
				"autoplay" => array(
					"title" => esc_html__("Autoplay video", 'morning-records'),
					"desc" => wp_kses_data( __("Autoplay video on page load", 'morning-records') ),
					"value" => "off",
					"type" => "switch",
					"options" => morning_records_get_sc_param('on_off')
				),
				"align" => array(
					"title" => esc_html__("Align", 'morning-records'),
					"desc" => wp_kses_data( __("Select block alignment", 'morning-records') ),
					"value" => "none",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => morning_records_get_sc_param('align')
				),
				"image" => array(
					"title" => esc_html__("Cover image", 'morning-records'),
					"desc" => wp_kses_data( __("Select or upload image or write URL from other site for video preview", 'morning-records') ),
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				"bg_image" => array(
					"title" => esc_html__("Background image", 'morning-records'),
					"desc" => wp_kses_data( __("Select or upload image or write URL from other site for video background. Attention! If you use background image - specify paddings below from background margins to video block in percents!", 'morning-records') ),
					"divider" => true,
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				"bg_top" => array(
					"title" => esc_html__("Top offset", 'morning-records'),
					"desc" => wp_kses_data( __("Top offset (padding) inside background image to video block (in percent). For example: 3%", 'morning-records') ),
					"dependency" => array(
						'bg_image' => array('not_empty')
					),
					"value" => "",
					"type" => "text"
				),
				"bg_bottom" => array(
					"title" => esc_html__("Bottom offset", 'morning-records'),
					"desc" => wp_kses_data( __("Bottom offset (padding) inside background image to video block (in percent). For example: 3%", 'morning-records') ),
					"dependency" => array(
						'bg_image' => array('not_empty')
					),
					"value" => "",
					"type" => "text"
				),
				"bg_left" => array(
					"title" => esc_html__("Left offset", 'morning-records'),
					"desc" => wp_kses_data( __("Left offset (padding) inside background image to video block (in percent). For example: 20%", 'morning-records') ),
					"dependency" => array(
						'bg_image' => array('not_empty')
					),
					"value" => "",
					"type" => "text"
				),
				"bg_right" => array(
					"title" => esc_html__("Right offset", 'morning-records'),
					"desc" => wp_kses_data( __("Right offset (padding) inside background image to video block (in percent). For example: 12%", 'morning-records') ),
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
if ( !function_exists( 'morning_records_sc_video_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_video_reg_shortcodes_vc');
	function morning_records_sc_video_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_video",
			"name" => esc_html__("Video", 'morning-records'),
			"description" => wp_kses_data( __("Insert video player", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_video',
			"class" => "trx_sc_single trx_sc_video",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "url",
					"heading" => esc_html__("URL for video file", 'morning-records'),
					"description" => wp_kses_data( __("Paste URL for video file", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "ratio",
					"heading" => esc_html__("Ratio", 'morning-records'),
					"description" => wp_kses_data( __("Select ratio for display video", 'morning-records') ),
					"class" => "",
					"value" => array(
						esc_html__('16:9', 'morning-records') => "16:9",
						esc_html__('4:3', 'morning-records') => "4:3"
					),
					"type" => "dropdown"
				),
				array(
					"param_name" => "autoplay",
					"heading" => esc_html__("Autoplay video", 'morning-records'),
					"description" => wp_kses_data( __("Autoplay video on page load", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => array("Autoplay" => "on" ),
					"type" => "checkbox"
				),
				array(
					"param_name" => "align",
					"heading" => esc_html__("Alignment", 'morning-records'),
					"description" => wp_kses_data( __("Select block alignment", 'morning-records') ),
					"class" => "",
					"value" => array_flip(morning_records_get_sc_param('align')),
					"type" => "dropdown"
				),
				array(
					"param_name" => "image",
					"heading" => esc_html__("Cover image", 'morning-records'),
					"description" => wp_kses_data( __("Select or upload image or write URL from other site for video preview", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				array(
					"param_name" => "bg_image",
					"heading" => esc_html__("Background image", 'morning-records'),
					"description" => wp_kses_data( __("Select or upload image or write URL from other site for video background. Attention! If you use background image - specify paddings below from background margins to video block in percents!", 'morning-records') ),
					"group" => esc_html__('Background', 'morning-records'),
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				array(
					"param_name" => "bg_top",
					"heading" => esc_html__("Top offset", 'morning-records'),
					"description" => wp_kses_data( __("Top offset (padding) from background image to video block (in percent). For example: 3%", 'morning-records') ),
					"group" => esc_html__('Background', 'morning-records'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "bg_bottom",
					"heading" => esc_html__("Bottom offset", 'morning-records'),
					"description" => wp_kses_data( __("Bottom offset (padding) from background image to video block (in percent). For example: 3%", 'morning-records') ),
					"group" => esc_html__('Background', 'morning-records'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "bg_left",
					"heading" => esc_html__("Left offset", 'morning-records'),
					"description" => wp_kses_data( __("Left offset (padding) from background image to video block (in percent). For example: 20%", 'morning-records') ),
					"group" => esc_html__('Background', 'morning-records'),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "bg_right",
					"heading" => esc_html__("Right offset", 'morning-records'),
					"description" => wp_kses_data( __("Right offset (padding) from background image to video block (in percent). For example: 12%", 'morning-records') ),
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
		
		class WPBakeryShortCode_Trx_Video extends MORNING_RECORDS_VC_ShortCodeSingle {}
	}
}
?>