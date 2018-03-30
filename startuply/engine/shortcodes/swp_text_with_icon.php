<?php

/*-----------------------------------------------------------------------------------*/
/*	Text with Icon VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				"name" => __("Text with Icon", "vivaco"),
				"base" => "vsc-text-icon",
				"weight" => 11,
				"icon" => "icon-for-twi",
				"description" => "Text block with eye-catching icon",
				"class" => "twi_extended",
				"category" => __("Content", "vivaco"),
				"params" => array(
					array(
						"type" => "textfield",
						"admin_label" => true,
						"heading" => __("Title", "vivaco"),
						"param_name" => "title"
					),
					array(
						"type" => "textarea_html",
						"heading" => __("Text", "vivaco"),
						"param_name" => "content"
					),
					array(
						"type" => "dropdown",
						"heading" => __("Media Type", "vivaco"),
						"param_name" => "media_type",
						"value" => array(
							__("Font Icon", "vivaco") => "icon-type",
							__("Standard Image", "vivaco") => "img-type"
						)
					),
					array(
						"type" => "dropdown",
						"heading" => __("Icon and text align", "vivaco"),
						"param_name" => "align",
						"value" => array(
							__("Top", "vivaco") => "top",
							__("Left", "vivaco") => "left",
							__("Right", "vivaco") => "right",
							__("Bottom", "vivaco") => "bottom"
						)
					),
					array(
						"type" => "dropdown",
						"heading" => __("Icon Type", "vivaco"),
						"param_name" => "icon_type",
						"dependency" => array(
							'element' => "media_type",
							'value' => "icon-type"
						),
						"value" => array(
							__("Single Icon", "vivaco") => "single_icon",
							__("Solid Shape", "vivaco") => "solid_icon",
							__("Border Shape", "vivaco") => "border_icon"
						)
					),
					array(
						"type" => "dropdown",
						"heading" => __("Icon Shape", "vivaco"),
						"param_name" => "icon_shape",
						"dependency" => array(
							"element" => "icon_type",
							"value" => array("solid_icon", "border_icon")
						),
						"value" => array(
							__("Round", "vivaco") => "round_shape",
							__("Square", "vivaco") => "square_shape",
							__("Round corner Square", "vivaco") => "rounded_square_shape"
						)
					),
					array(
						"type" => "dropdown",
						"heading" => __("Icon Border Style", "vivaco"),
						"param_name" => "icon_border",
						"dependency" => array(
							"element" => "icon_type",
							"value" => "border_icon"
						),
						"value" => array(
							__("Solid", "vivaco") => "solid_border",
							__("Dashed", "vivaco") => "dashed_border",
							__("Dotted", "vivaco") => "dotted_border"
						)
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Icon library', 'js_composer' ),
						'value' => array(
							__( 'Startuply Line Icons', 'vivaco' ) => 'startuplyli',
							__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
							__( 'Open Iconic', 'js_composer' ) => 'openiconic',
							__( 'Typicons', 'js_composer' ) => 'typicons',
							__( 'Entypo', 'js_composer' ) => 'entypo',
							__( 'Linecons', 'js_composer' ) => 'linecons',
						),
						'dependency' => array(
							"element" => "media_type",
							"value" => "icon-type"
						),
						'admin_label' => true,
						'param_name' => 'type',
						'description' => __( 'Select icon library.', 'js_composer' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'js_composer' ),
						'param_name' => 'icon_startuplyli',
						'value' => 'icon icon-graphic-design-13', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'startuplyli',
							'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'startuplyli',
						),
						'description' => __( 'Select icon from library.', 'js_composer' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'js_composer' ),
						'param_name' => 'icon_fontawesome',
						'value' => 'fa fa-adjust', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'fontawesome',
						),
						'description' => __( 'Select icon from library.', 'js_composer' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'js_composer' ),
						'param_name' => 'icon_openiconic',
						'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'openiconic',
							'iconsPerPage' => 4000, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'openiconic',
						),
						'description' => __( 'Select icon from library.', 'js_composer' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'js_composer' ),
						'param_name' => 'icon_typicons',
						'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'typicons',
							'iconsPerPage' => 4000, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'typicons',
						),
						'description' => __( 'Select icon from library.', 'js_composer' ),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'js_composer' ),
						'param_name' => 'icon_entypo',
						'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'entypo',
							'iconsPerPage' => 4000, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'entypo',
						),
					),
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', 'js_composer' ),
						'param_name' => 'icon_linecons',
						'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
						'settings' => array(
							'emptyIcon' => false, // default true, display an "EMPTY" icon?
							'type' => 'linecons',
							'iconsPerPage' => 4000, // default 100, how many icons per/page to display
						),
						'dependency' => array(
							'element' => 'type',
							'value' => 'linecons',
						),
						'description' => __( 'Select icon from library.', 'js_composer' ),
					),

					array(
						"type" => "textfield",
						"heading" => __("Custom icon size", "vivaco"),
						"param_name" => "icon_size",
						"value" => "",
						"dependency" => array(
							"element" => "media_type",
							"value" => "icon-type"
						),
						"description" => __("Font-size of icon", "vivaco")
					),
					array(
						"type" => "attach_image",
						"heading" => __("Image", "vivaco"),
						"param_name" => "img",
						"dependency" => array(
							"element" => "media_type",
							"value" => "img-type"
						),
						"description" => __("Upload an image for the widget", "vivaco")
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Title Color", "vivaco"),
						"param_name" => "title_color",
						"group" => __("Change color", "vivaco"),
						"dependency" => array(
							"element" => "title",
							"not_empty" => true
						)
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Text Color", "vivaco"),
						"param_name" => "text_color",
						"group" => __("Change color", "vivaco"),
						"dependency" => array(
							"element" => "content",
							"not_empty" => true
						)
					),
					//content
					array(
						"type" => "colorpicker",
						"heading" => __("Icon Background Color", "vivaco"),
						"param_name" => "icon_bg_color",
						"group" => __("Change color", "vivaco"),
						"dependency" => array(
							"element" => "icon_type",
							"value" => "solid_icon"
						)
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Icon Border Color", "vivaco"),
						"param_name" => "icon_bd_color",
						"group" => __("Change color", "vivaco"),
						"dependency" => array(
							"element" => "icon_type",
							"value" => array( "solid_icon", "border_icon" )
						)
					),
					array(
						"type" => "colorpicker",
						"heading" => __("Icon Color", "vivaco"),
						"param_name" => "icon_color",
						"group" => __("Change color", "vivaco"),
						"dependency" => array(
							"element" => "media_type",
							"value" => "icon-type"
						)
					),
					array(
						"type" => "textfield",
						"heading" => __("Extra class name", "vivaco"),
						"param_name" => "el_class",
					)
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Text with Icon VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_text_with_icon($atts, $content = null) {
	$type = $icon_startuplyli = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';

	extract(shortcode_atts(array(
		'type' => 'startuplyli',
		'icon_startuplyli' => 'icon icon-graphic-design-13',
		'icon_fontawesome' => 'fa fa-adjust',
		'icon_openiconic' => 'vc-oi vc-oi-dial',
		'icon_typicons' => 'typcn typcn-adjust-brightness',
		'icon_entypoicons' => 'entypo-icon entypo-icon-note',
		'icon_linecons' => 'vc_li vc_li-heart',
		'icon_entypo' => 'entypo-icon entypo-icon-note',

		'title' => '',
		'media_type' => 'icon-type', // default value
		'align' => 'top', // default value
		'icon_type' => 'single_icon', // default value
		'icon_shape' => 'round_shape', // default value
		'icon_border' => 'solid_border', // default value
		'icon' => '',
		'icon_size' => '',
		'img' => '',
		'title_color' => '',
		'text_color' => '',
		'icon_bg_color' => '',
		'icon_bd_color' => '',
		'icon_color' => '',
		'el_class' => ''
	), $atts));

	$ialign = '';
	if ($align == 'top') {
		$ialign = 'icon-top';
	} else if ($align == 'left') {
		$ialign = 'icon-left';
	} else if ($align == 'right') {
		$ialign = 'icon-right';
	} else if ($align == 'bottom') {
		$ialign = 'icon-bottom';
	}

	$itype = '';
	if ($icon_type == 'single_icon') {
		$itype = 'icon-single';
	} else if ($icon_type == 'solid_icon') {
		$itype = 'icon-solid';
	} else if ($icon_type == 'border_icon') {
		$itype = 'icon-border';
	}

	$ishape = '';
	if ($icon_shape == 'round_shape') {
		$ishape = 'icon-round';
	} else if ($icon_shape == 'square_shape') {
		$ishape = 'icon-square';
	} else if ($icon_shape == 'rounded_square_shape') {
		$ishape = 'icon-round-square';
	}

	$iborder = '';
	if ($icon_border == 'solid_border') {
		$iborder = 'icon-border-solid';
	} else if ($icon_border == 'dashed_border') {
		$iborder = 'icon-border-dashed';
	} else if ($icon_border == 'dotted_border') {
		$iborder = 'icon-border-dotted';
	}

	$container_style = '';
	if ( $icon_size != '' ) {
		$icon_size = intval($icon_size);

		$padding = $icon_size;

		if ( $icon_type != 'single_icon' ) {
			$icon_size = $icon_size / 2;

			if ( $icon_size < 16 ) {
				$icon_size = 16;
				$padding = 32;
			}
		}

		if ($align == 'top') {
			$container_style = 'padding-top: ' . ($padding + 10) . 'px;';
		} else if ($align == 'left') {
			$container_style = 'padding-left: ' . ($padding + 15) . 'px;';
		} else if ($align == 'right') {
			$container_style = 'padding-right: ' . ($padding + 15) . 'px;';
		} else if ($align == 'bottom') {
			$container_style = 'padding-bottom: ' . ($padding) . 'px;';
		}
	}

	$istyle = '';
	if ($icon_type == 'solid_icon' && $icon_bg_color != '') {
		$istyle .= 'background-color: ' . $icon_bg_color . '; ';
	}
	if ($icon_type != 'single_icon' && $icon_bd_color != '') {
		$istyle .= 'border-color: ' . $icon_bd_color . '; ';
	}
	if ($icon_color != '') {
		$istyle .= 'color: ' . $icon_color . ';';
	}

	if ( $icon_size != '' ) {
		$istyle .= ' font-size: ' . $icon_size . 'px;';
	}

	$title_style = '';
	if ( $title_color != '' ) {
		$title_style = 'style="color: ' . $title_color . ';"';
	}

	$text_style = '';
	if ( $text_color != '' ) {
		$text_style = 'style="color: ' . $text_color . ';"';
	}

	$output = '';
	$output .= '<article style="' . $container_style . '" class="vsc-service-elem vsc-text-icon ' . $el_class . ' ' . $ialign . ' ' . $itype . ' ' . $ishape . ' ' . $iborder . '">';
	$output .= '<div class="vsc-service-icon">';

	if (!empty($type)) {

		if (!empty(${"icon_" . $type})) {
			$icon = trim(esc_attr( ${"icon_" . $type} ));
		}

		if ( strpos($icon, ' icon') === false ) {
			$icon = 'icon '.$icon;
		}

		//echo '<pre>'.print_r($type, 1).'<br/>'.print_r($icon, 1).'</pre>';
		vc_icon_element_fonts_enqueue( $type );

	} else {
		$icon = 'fa icon '.$icon;
	}

	// base_clr_bg
	if ($media_type == 'icon-type') {
		$output .= '<i class="' . $icon . ( ($icon_type == 'solid_icon') ? ' base_clr_brd base_clr_bg' : '' ) . ( ($icon_type == 'border_icon') ? ' base_clr_brd' : '' ) . '" style="' . $istyle . '"></i>';
	} else if ($media_type == 'img-type') {
		$img_val = '';
		if (function_exists('wpb_getImageBySize')) {
			$img_val = wpb_getImageBySize(array(
				'attach_id' => (int) $img,
				'thumb_size' => 'full'
			));
		}

		$output .= $img_val['thumbnail'];
	}
	$output .= '</div>';

	$output .= '<div class="vsc-service-content">';
	if ($title != '') {
		$output .= '<h6 ' . $title_style . '>' . $title . '</h6>';
	}

	if (!empty($content)) {
		$output .= '<p ' . $text_style . '>' . do_shortcode($content) . '</p>';
	}
	$output .= '</div>';

	$output .= '</article>';
	return $output;

}

add_shortcode('vsc-text-icon', 'vsc_text_with_icon');
