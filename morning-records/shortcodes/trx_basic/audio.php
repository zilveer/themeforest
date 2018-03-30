<?php

/* Theme setup section
-------------------------------------------------------------------- */
if (!function_exists('morning_records_sc_audio_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_sc_audio_theme_setup' );
	function morning_records_sc_audio_theme_setup() {
		add_action('morning_records_action_shortcodes_list', 		'morning_records_sc_audio_reg_shortcodes');
		if (function_exists('morning_records_exists_visual_composer') && morning_records_exists_visual_composer())
			add_action('morning_records_action_shortcodes_list_vc','morning_records_sc_audio_reg_shortcodes_vc');
	}
}



/* Shortcode implementation
-------------------------------------------------------------------- */

/*
[trx_audio url="http://trex2.themerex.dnw/wp-content/uploads/2014/12/Dream-Music-Relax.mp3" image="http://trex2.themerex.dnw/wp-content/uploads/2014/10/post_audio.jpg" title="Insert Audio Title Here" author="Lily Hunter" controls="show" autoplay="off"]
*/

if (!function_exists('morning_records_sc_audio')) {	
	function morning_records_sc_audio($atts, $content = null) {
		if (morning_records_in_shortcode_blogger()) return '';
		extract(morning_records_html_decode(shortcode_atts(array(
			// Individual params
			"title" => "",
			"author" => "",
			"image" => "",
			"mp3" => '',
			"wav" => '',
			"src" => '',
			"url" => '',
			"align" => '',
			"controls" => "",
			"autoplay" => "",
			"frame" => "on",
			// Common params
			"id" => "",
			"class" => "",
			"css" => "",
			"animation" => "",
			"width" => '',
			"height" => '',
			"top" => "",
			"bottom" => "",
			"left" => "",
			"right" => ""
		), $atts)));
		if ($src=='' && $url=='' && isset($atts[0])) {
			$src = $atts[0];
		}
		if ($src=='') {
			if ($url) $src = $url;
			else if ($mp3) $src = $mp3;
			else if ($wav) $src = $wav;
		}
		if ($image > 0) {
			$attach = wp_get_attachment_image_src( $image, 'full' );
			if (isset($attach[0]) && $attach[0]!='')
				$image = $attach[0];
		}
		$class .= ($class ? ' ' : '') . morning_records_get_css_position_as_classes($top, $right, $bottom, $left);
		$data = ($title != ''  ? ' data-title="'.esc_attr($title).'"'   : '')
				. ($author != '' ? ' data-author="'.esc_attr($author).'"' : '')
				. ($image != ''  ? ' data-image="'.esc_url($image).'"'   : '')
				. ($align && $align!='none' ? ' data-align="'.esc_attr($align).'"' : '')
				. (!morning_records_param_is_off($animation) ? ' data-animation="'.esc_attr(morning_records_get_animation_classes($animation)).'"' : '');
		$audio = '<audio'
			. ($id ? ' id="'.esc_attr($id).'"' : '')
			. ' class="sc_audio' . (!empty($class) ? ' '.esc_attr($class) : '') . '"'
			. ' src="'.esc_url($src).'"'
			. (morning_records_param_is_on($controls) ? ' controls="controls"' : '')
			. (morning_records_param_is_on($autoplay) && is_single() ? ' autoplay="autoplay"' : '')
			. ' width="'.esc_attr($width).'" height="'.esc_attr($height).'"'
			. ($css!='' ? ' style="'.esc_attr($css).'"' : '')
			. ($data)
			. '></audio>';
		if ( morning_records_get_custom_option('substitute_audio')=='no') {
			if (morning_records_param_is_on($frame)) {
				$audio = morning_records_get_audio_frame($audio, $image, $s);
			}
		} else {
			if ((isset($_GET['vc_editable']) && $_GET['vc_editable']=='true') && (isset($_POST['action']) && $_POST['action']=='vc_load_shortcode')) {
				$audio = morning_records_substitute_audio($audio, false);
			}
		}
		if (morning_records_get_theme_option('use_mediaelement')=='yes')
			morning_records_enqueue_script('wp-mediaelement');
		return apply_filters('morning_records_shortcode_output', $audio, 'trx_audio', $atts, $content);
	}
	morning_records_require_shortcode("trx_audio", "morning_records_sc_audio");
}



/* Register shortcode in the internal SC Builder
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_sc_audio_reg_shortcodes' ) ) {
	//add_action('morning_records_action_shortcodes_list', 'morning_records_sc_audio_reg_shortcodes');
	function morning_records_sc_audio_reg_shortcodes() {
	
		morning_records_sc_map("trx_audio", array(
			"title" => esc_html__("Audio", 'morning-records'),
			"desc" => wp_kses_data( __("Insert audio player", 'morning-records') ),
			"decorate" => false,
			"container" => false,
			"params" => array(
				"url" => array(
					"title" => esc_html__("URL for audio file", 'morning-records'),
					"desc" => wp_kses_data( __("URL for audio file", 'morning-records') ),
					"readonly" => false,
					"value" => "",
					"type" => "media",
					"before" => array(
						'title' => esc_html__('Choose audio', 'morning-records'),
						'action' => 'media_upload',
						'type' => 'audio',
						'multiple' => false,
						'linked_field' => '',
						'captions' => array( 	
							'choose' => esc_html__('Choose audio file', 'morning-records'),
							'update' => esc_html__('Select audio file', 'morning-records')
						)
					),
					"after" => array(
						'icon' => 'icon-cancel',
						'action' => 'media_reset'
					)
				),
				"image" => array(
					"title" => esc_html__("Cover image", 'morning-records'),
					"desc" => wp_kses_data( __("Select or upload image or write URL from other site for audio cover", 'morning-records') ),
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				"title" => array(
					"title" => esc_html__("Title", 'morning-records'),
					"desc" => wp_kses_data( __("Title of the audio file", 'morning-records') ),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
				"author" => array(
					"title" => esc_html__("Author", 'morning-records'),
					"desc" => wp_kses_data( __("Author of the audio file", 'morning-records') ),
					"value" => "",
					"type" => "text"
				),
				"controls" => array(
					"title" => esc_html__("Show controls", 'morning-records'),
					"desc" => wp_kses_data( __("Show controls in audio player", 'morning-records') ),
					"divider" => true,
					"size" => "medium",
					"value" => "show",
					"type" => "switch",
					"options" => morning_records_get_sc_param('show_hide')
				),
				"autoplay" => array(
					"title" => esc_html__("Autoplay audio", 'morning-records'),
					"desc" => wp_kses_data( __("Autoplay audio on page load", 'morning-records') ),
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
if ( !function_exists( 'morning_records_sc_audio_reg_shortcodes_vc' ) ) {
	//add_action('morning_records_action_shortcodes_list_vc', 'morning_records_sc_audio_reg_shortcodes_vc');
	function morning_records_sc_audio_reg_shortcodes_vc() {
	
		vc_map( array(
			"base" => "trx_audio",
			"name" => esc_html__("Audio", 'morning-records'),
			"description" => wp_kses_data( __("Insert audio player", 'morning-records') ),
			"category" => esc_html__('Content', 'morning-records'),
			'icon' => 'icon_trx_audio',
			"class" => "trx_sc_single trx_sc_audio",
			"content_element" => true,
			"is_container" => false,
			"show_settings_on_create" => true,
			"params" => array(
				array(
					"param_name" => "url",
					"heading" => esc_html__("URL for audio file", 'morning-records'),
					"description" => wp_kses_data( __("Put here URL for audio file", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "image",
					"heading" => esc_html__("Cover image", 'morning-records'),
					"description" => wp_kses_data( __("Select or upload image or write URL from other site for audio cover", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "attach_image"
				),
				array(
					"param_name" => "title",
					"heading" => esc_html__("Title", 'morning-records'),
					"description" => wp_kses_data( __("Title of the audio file", 'morning-records') ),
					"admin_label" => true,
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "author",
					"heading" => esc_html__("Author", 'morning-records'),
					"description" => wp_kses_data( __("Author of the audio file", 'morning-records') ),
					"class" => "",
					"value" => "",
					"type" => "textfield"
				),
				array(
					"param_name" => "controls",
					"heading" => esc_html__("Controls", 'morning-records'),
					"description" => wp_kses_data( __("Show/hide controls", 'morning-records') ),
					"class" => "",
					"value" => array("Hide controls" => "hide" ),
					"type" => "checkbox"
				),
				array(
					"param_name" => "autoplay",
					"heading" => esc_html__("Autoplay", 'morning-records'),
					"description" => wp_kses_data( __("Autoplay audio on page load", 'morning-records') ),
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
		) );
		
		class WPBakeryShortCode_Trx_Audio extends MORNING_RECORDS_VC_ShortCodeSingle {}
	}
}
?>