<?php

/*-----------------------------------------------------------------------------------*/
/*	Canvas Title VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				"name" => __("Canvas Title", "vivaco"),
				"base" => "vc_custom_heading",
				"weight" => 10,
				"icon" => "icon-for-canvas-title",
				"description" => "Custom heading with background",
				"class" => "canvas_title",
				"category" => __("Content", "vivaco"),
				"params" => array(
					array(
						"type" => "textfield",
						"admin_label" => true,
						"heading" => __("Text", "vivaco"),
						"param_name" => "text"
					),
					array(
						"type" => "textfield",
						"heading" => __("Font size", "vivaco"),
						"param_name" => "font_size",
						"description" => "Enter font size",
						"value" => "30px"
					),
					array(
						"type" => "dropdown",
						"heading" => __("Element tag", "vivaco"),
						"param_name" => "tag_name",
						"description" => "Select element tag",
						"value" => array(
							__("h1", "vivaco") => "h1",
							__("h2", "vivaco") => "h2",
							__("h3", "vivaco") => "h3",
							__("h4", "vivaco") => "h4",
							__("h5", "vivaco") => "h5",
							__("h6", "vivaco") => "h6"
						)
					),
					array(
						"type" => "dropdown",
						"heading" => __("Text align", "vivaco"),
						"param_name" => "align",
						"description" => "Select text alignment.",
						"value" => array(
							__("center", "vivaco") => "center",
							__("left", "vivaco") => "left",
							__("right", "vivaco") => "right"
						)
					),
					array(
						"type" => "textfield",
						"heading" => __("Line Height", "vivaco"),
						"param_name" => "line_height",
						"description" => "Enter line height",
						"value" => "30px"
					),
					array(
						"type" => "textfield",
						"heading" => __("Padding top", "vivaco"),
						"param_name" => "padding_top",
						"description" => "Enter padding from top."
					),
					array(
						"type" => "textfield",
						"heading" => __("Padding bottom", "vivaco"),
						"param_name" => "padding_bottom",
						"description" => "Enter padding from bottom."
					),
					array(
						"type" => "google_fonts",
						"param_name" => "google_fonts",
						"settings" => array(
							"no_font_style" => true,
							"fields" => array(
								"font_family"=>"Lato",
								"font_family_description" => __("Select font family.","js_composer"),
								"font_style_description" => __("Select font styling.","js_composer")
							)
						)
					),
					array(
						"type" => "attach_image",
						"heading" => __("Mask / background image", "vivaco"),
						"param_name" => "mask_img",
						"description" => ""
					),
					array(
						"type" => "checkbox",
						"heading" => __("Overlay", "vivaco"),
						"param_name" => "overlay",
						"value" => array(
							__("Check this box to enable background with overlay", "vivaco") => "yes"
						)
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Overlay color", "vivaco"),
						"param_name" => "overlay_color",
						"description" => "",
						"dependency" => array(
							"element" => "overlay",
							"value" => "yes"
						)
					)
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Canvas Title VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_canvas_title($atts, $content = null) {
	extract(shortcode_atts(array(
		'text' => '',
		'tag_name' => 'h1',
		'google_fonts' => '',
		'font_size' => '',
		'align' => 'center',
		'line_height' => '',
		'padding_top' => '',
		'padding_bottom' => '',
		'mask_img' => '',
		'overlay' => '',
		'overlay_color' => '',
	), $atts));

	$output = $img_val = $headline_style = '';

	//Google fonts output: font_family:Lato%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic|font_style:900%20bold%20regular%3A900%3Anormal
	preg_match('#font_family:(.*?)\|#s', $google_fonts, $matches);
	$google_fonts_family = explode(":", urldecode($matches[1])); //returns Lato

	preg_match('#font_style:(.*?)$#s', $google_fonts, $matches);
	$google_fonts_styles = explode(":", urldecode($matches[1]));

	if ( $mask_img != null && function_exists('wpb_getImageBySize')) {
		$img_array = wpb_getImageBySize(array( 'attach_id' => (int) $mask_img, 'thumb_size' => 'full' ));
		$img_val = $img_array['p_img_large'][0];
	}

	if ( $tag_name == '' ) $tag_name = 'h1';
	if ( $overlay_color != '' ) $overlay_style = ' background-color: ' . $overlay_color . ';';
	if ( $img_val != '' ) $headline_style .= '-webkit-text-fill-color: transparent; background: -webkit-linear-gradient(transparent, transparent), url(' . $img_val . ') top center no-repeat; background: -o-linear-gradient(transparent, transparent); -webkit-background-clip: text; background-size: cover;';
	if ( $padding_top != '' ) $headline_style .= ' padding-top: ' . intval($padding_top) . 'px;';
	if ( $padding_bottom != '' ) $headline_style .= ' padding-bottom: ' . intval($padding_bottom) . 'px;';
	if ( $line_height != '' ) $headline_style .= ' line-height: ' . intval($line_height) . 'px; height: ' . ( intval($padding_top) + intval($padding_bottom) + intval($line_height) ) . 'px;';
	if ( $font_size != '' ) $headline_style .= ' font-size: ' . intval($font_size) . 'px;';
	if ( $align !== '' ) $headline_style .= ' text-align: ' . $align . ';';
	if ( $google_fonts != '' ) {
		$headline_style .= ' font-family: \'' . $google_fonts_family[0] . '\';';
		$headline_style .= ' font-weight: ' . $google_fonts_styles[1] . ';';
		$headline_style .= ' font-style: ' . $google_fonts_styles[2] . ';';
	}


	if ( $overlay == 'yes' ) {
		$output .= '<div class="canvas-title-block" style="background-image: url(' . $img_val . ');"><i class="canvas-overlay" style="' . $overlay_style . '"></i>';
	}

	$output .= '<' . $tag_name . (($img_val != '') ? ' data-img=' . $img_val : '') . ' class="canvas-headline" style="' . $headline_style . '">';

	if ( $overlay == 'yes' ) {
		$output .= '<span><i class="text">' . $text . '</i></span>';
	} else {
		$output .= '<i class="text">' . $text . '</i>';
	}

	$output .= '</' . $tag_name . '>';

	if ( $overlay == 'yes' ) {
		$output .= '</div>';
	}

	wp_enqueue_script('svg-text', array('jquery'), true);
	startuply_typography_enqueue_google_font($google_fonts_family[0]);
	return $output;
}

add_shortcode('vc_custom_heading', 'vsc_canvas_title');
