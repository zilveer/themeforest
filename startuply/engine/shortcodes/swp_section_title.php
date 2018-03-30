<?php

/*-----------------------------------------------------------------------------------*/
/*	Section Title VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				"name" => __("Section title", "vivaco"),
				"icon" => "icon-section-title",
				"weight" => 50,
				"base" => "vsc-section-title",
				"class" => "title_extended",
				"description" => "Set a title and subtitle with style",
				"category" => __("Content", "vivaco"),
				"params" => array(

					array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __("Title", "vivaco"),
						"param_name" => "title"
					),
					array(
						"type" => "textarea_html",
						"holder" => "div",
						"heading" => __("Subtitle", "vivaco"),
						"param_name" => "content",
						"description" => "*optional"
					),
					array(
						"type" => "dropdown",
						"heading" => __("Text alignment", "vivaco"),
						"param_name" => "align",
						"value" => array(
							__("Auto", "vivaco") => "inherit",
							__("Left", "vivaco") => 'left',
							__("Center", "vivaco") => "center",
							__("Right", "vivaco") => "right"
						)
					),
					array(
						"type" => "dropdown",
						"heading" => __("Section type", "vivaco"),
						"param_name" => "size",
						"value" => array(
							__("Medium", "vivaco") => "normal",
							__("Big", "vivaco") => "big",
							__("Small", "vivaco") => "small"
						),
						"description" => __("Default for section titles, Big for main website title and Small for paragraph titles", "vivaco")
					),
					array(
						"type" => "checkbox",
						"group" => "Custom fonts",
						"heading" => __("Use custom Google font?", "vivaco"),
						"param_name" => "use_google_font",
						"value" => array(
							__("Yes, please", "vivaco") => "yes"
						)
					),
					array(
						"type" => "google_fonts",
						"group" => "Custom fonts",
						"heading" => __("Title font", "vivaco"),
						"param_name" => "title_google_fonts",
						"settings" => array(
							"no_font_style" => true,
							"fields" => array(
								"font_family"=>"Lato",
								"font_family_description" => __("Select font family.","js_composer"),
								"font_style_description" => __("Select font styling.","js_composer")
							)
						),
						"dependency" => array(
							"element" => "use_google_font",
							"value" => "yes"
						)
					),
					array(
						"type" => "textfield",
						"heading" => __("Custom title size", "vivaco"),
						"param_name" => "title_font_size",
						"description" => "*optional"
					),
					array(
						"type" => "google_fonts",
						"group" => "Custom fonts",
						"heading" => __("Subtitle font", "vivaco"),
						"param_name" => "subtitle_google_fonts",
						"settings" => array(
							"no_font_style" => true,
							"fields" => array(
								"font_family"=>"Lato",
								"font_family_description" => __("Select font family.","js_composer"),
								"font_style_description" => __("Select font styling.","js_composer")
							)
						),
						"dependency" => array(
							"element" => "use_google_font",
							"value" => "yes"
						)
					),
					array(
						"type" => "textfield",
						"heading" => __("Custom subtitle size", "vivaco"),
						"param_name" => "subtitle_font_size",
						"description" => "*optional"
					),
					array(
						"type" => "textfield",
						"heading" => __("Extra class name", "vivaco"),
						"param_name" => "el_class",
						"description" => __("Additional class that you can add custom styles to", "vivaco")
					),
					array(
						'type' => 'colorpicker',
						'group' => 'Change color',
						'heading' => __('Title Color', 'vivaco'),
						'param_name' => 'title_color'
					),
					array(
						'type' => 'colorpicker',
						'group' => 'Change color',
						'heading' => __('Subtitle Color', 'vivaco'),
						'param_name' => 'subtitle_color'
					)
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Section Title VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_title_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' => '',
		'align' => '',
		'size' => 'normal',
		'use_google_font' => '',
		'title_google_fonts' => '',
		'title_font_size' => '',
		'subtitle_google_fonts' => '',
		'subtitle_font_size' => '',
		'title_color' => '',
		'subtitle_color' => '',
		'el_class' => ''
	), $atts));

	$output = $content_class = $custom_title_style = $custom_subtitle_style = $t_font_size = $s_font_size = $t_color = $s_color = '';

	if ($title_color != '') $t_color = ' color: ' . $title_color . ';';
	if ($subtitle_color != '') $s_color = ' color: ' . $subtitle_color . ';';

	if ( $title_font_size !== '' ) $t_font_size = 'font-size: ' . intval($title_font_size) . 'px;';
	if ( $subtitle_font_size !== '' ) $s_font_size = 'font-size: ' . intval($subtitle_font_size) . 'px;';


	$custom_title_style_font = '';
	$custom_subtitle_style_font = '';
	if (!empty($use_google_font) && $use_google_font == 'yes') {
		if (!empty($title_google_fonts)) {
			/*echo '<pre>'.print_r($title_google_fonts, 1).'</pre>';*/
			//Google fonts output: font_family:Lato%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic|font_style:900%20bold%20regular%3A900%3Anormal
			preg_match('#font_family:(.*?)\|#s', $title_google_fonts, $matches);
			$google_fonts_family = explode(":", urldecode($matches[1])); //returns Lato

			preg_match('#font_style:(.*?)$#s', $title_google_fonts, $matches);
			$google_fonts_styles = explode(":", urldecode($matches[1]));

			$custom_title_style_font .= ' font-family: \'' . $google_fonts_family[0] . '\';';
			$custom_title_style_font .= ' font-weight: ' . $google_fonts_styles[1] . ';';
			$custom_title_style_font .= ' font-style: ' . $google_fonts_styles[2] . ';';

			startuply_typography_enqueue_google_font($google_fonts_family[0]);
		}

		if (!empty($subtitle_google_fonts)) {
			preg_match('#font_family:(.*?)\|#s', $subtitle_google_fonts, $matches);
			$google_fonts_family = explode(":", urldecode($matches[1])); //returns Lato

			preg_match('#font_style:(.*?)$#s', $subtitle_google_fonts, $matches);
			$google_fonts_styles = explode(":", urldecode($matches[1]));

			$custom_subtitle_style_font .= ' font-family: \'' . $google_fonts_family[0] . '\';';
			$custom_subtitle_style_font .= ' font-weight: ' . $google_fonts_styles[1] . ';';
			$custom_subtitle_style_font .= ' font-style: ' . $google_fonts_styles[2] . ';';

			startuply_typography_enqueue_google_font($google_fonts_family[0]);
		}
	}

	$custom_title_style = ' style="' . $t_font_size . $t_color . $custom_title_style_font . '"';
	$custom_subtitle_style = ' style="' . $s_font_size . $s_color . $custom_subtitle_style_font . '"';

	$output .= '<div class="section-wrap '. $el_class .'">';

	if ($size == 'big') {
		$output .= '<h1' . $custom_title_style . ' class="section-title text-' . $align . '">' . $title . '</h1>';
		$content_class = ' class="sub-hero-header heading-font"';
	} else if ($size == 'normal') {
		$output .= '<h2' . $custom_title_style . ' class="section-title text-' . $align . '">' . $title . '</h2>';
		$content_class = ' class="sub-header"';
	} else if ($size == 'small') {
		$output .= '<h3' . $custom_title_style . ' class="section-title text-' . $align . '">' . $title . '</h3>';
		$content_class = ' class="sub-title"';
	} else {
		$output .= '<h3' . $custom_title_style . '  class="section-title text-' . $align . '">' . $title . '</h3>';
	}

	if ($content != '') {
		$output .= '<div class="sub-title text-' . $align . '"><p' . $content_class . $custom_subtitle_style . '>' . do_shortcode($content) . '</p></div>';
	}

	$output .= '</div>';

	return $output;
}

add_shortcode('vsc-section-title', 'vsc_title_shortcode');
