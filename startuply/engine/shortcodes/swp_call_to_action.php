<?php

/*-----------------------------------------------------------------------------------*/
/*	Call to Action VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				"name" => __("Call to Action", "vivaco"),
				"base" => "vsc-call-to-action",
				"weight" => 12,
				"icon" => "icon-wpb-call-to-action",
				"description" => __("Catch visitors attention with CTA block", "vivaco"),
				"category" => __("Content", "vivaco"),
				"params" => array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __("Main Title", "vivaco"),
						"param_name" => "title"
					),
					array(
						"type" => "textarea_html",
						"heading" => __("Additional text", "vivaco"),
						"param_name" => "content",
						"value" => ""
					),
					array(
						"type" => "dropdown",
						"heading" => __("Media Type", "vivaco"),
						"param_name" => "media_type",
						"value" => array(
							__("Font Icon", "vivaco") => 'icon-type',
							__("Standard Image", "vivaco") => "img-type"
						),
						"description" => __("Pick the media type you want to use for the widget. Icons from FontAwesome <a href='http://fontawesome.io/icons/'>icon list</a> and Line Icons <a href='http://www.startuplywp.com/line-icons.html'>icon list</a> can be used. Type in the icon name you want to use e.g: fa-bolt or icon-seo-icons-24. Standard Image - upload an image(jpg, png, etc.)", "vivaco")
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
						"dependency" => array(
							'element' => "media_type",
							'value' => 'icon-type'
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

					/*
					array(
						"type" => "textfield",
						"heading" => __("Icon Name", "vivaco"),
						"param_name" => "dicon",
						"value" => "fa-bolt",
						"dependency" => array(
							'element' => "media_type",
							'value' => 'icon-type'
						),
						"description" => __("Icons from FontAwesome <a href='http://fontawesome.io/icons/'>icon list</a> and Line Icons <a href='http://www.startuplywp.com/line-icons.html'>icon list</a> can be used. Type in the icon name you want to use e.g: fa-bolt or icon-seo-icons-24", "vivaco")
					),
					*/
					array(
						"type" => "attach_image",
						"heading" => __("Image", "vivaco"),
						"param_name" => "img",
						"dependency" => array(
							'element' => "media_type",
							'value' => 'img-type'
						),
						"description" => __("Upload an image for the widget", "vivaco")
					),
					array(
						"type" => "dropdown",
						"heading" => __("Style", "vivaco"),
						"param_name" => "btn_style",
						"value" => array(
							__("Solid color button", "vivaco") => 'btn-solid',
							__("White outline button", "vivaco") => "btn-outline",
							__("Color outline button", "vivaco") => "btn-outline-color",
							__("Clear, no border", "vivaco") => "btn-no-border"
						)
					),
					array(
						"type" => "textfield",
						"admin_label" => true,
						"heading" => __("Text on the button", "vivaco"),
						"param_name" => "text",
						"value" => "Button Text"
					),
					array(
						"type" => "textfield",
						"heading" => __("URL(Link)", "vivaco"),
						"param_name" => "url",
						"description" => __("Button Link.", "vivaco")
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
						'heading' => __('Text Color', 'vivaco'),
						'param_name' => 'text_color'
					),
					array(
						'type' => 'colorpicker',
						'group' => 'Change color',
						'heading' => __('Button Color', 'vivaco'),
						'param_name' => 'button_color'
					),
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Call to action VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_call_to_action($atts, $content = null) {
	extract(shortcode_atts(array(

		'type' => 'startuplyli',
		'icon_startuplyli' => 'icon icon-graphic-design-13',
		'icon_fontawesome' => 'fa fa-adjust',
		'icon_openiconic' => 'vc-oi vc-oi-dial',
		'icon_typicons' => 'typcn typcn-adjust-brightness',
		'icon_entypoicons' => 'entypo-icon entypo-icon-note',
		'icon_linecons' => 'vc_li vc_li-heart',
		'icon_entypo' => 'entypo-icon entypo-icon-note',
		'media_type' => 'icon-type', // default value

		'title' => '',
		'dicon' => '',
		'istyle' => '',
		'img' => '',
		'text' => 'Button Text',
		'url' => '',
		'title_color' => '',
		'text_color' => '',
		'button_color' => '',
		'btn_style' => 'btn-solid'
	), $atts));

	$cstyle = '';
	if ($istyle == 'bold') {
		$cstyle = 'bold-fill';
	} else if ($istyle == 'thin') {
		$cstyle = 'thin-fill';
	} else if ($istyle == 'free') {
		$cstyle = 'no-fill';
	}

	$btn_class = 'btn ';

	if ( $btn_style == 'btn-solid' ) {
		$btn_class .= 'btn-solid base_clr_bg';
	} else if ( $btn_style == 'btn-no-border' ) {
		$btn_class .= 'btn-no-border base_clr_txt';
	} else if ( $btn_style == 'btn-outline-color' ) {
		$btn_class .= 'btn-outline-color base_clr_txt base_clr_bg base_clr_brd';
	} else if ( $btn_style == 'alt' ) { // what?
		$btn_class .= 'btn-outline-color base_clr_txt base_clr_bg base_clr_brd';
	} else if ( $btn_style == '' ) {
		$btn_class .= 'btn-solid base_clr_bg';
	} else {
		$btn_class .= 'btn-outline base_clr_txt';
	}

	$i_color = '';
	$title_style = '';

	if ($title_color != '') {
		$title_style = 'style="color: ' . $title_color . ';"';
		$i_color = ' color: ' . $title_color . ';';
	}

	$text_style = '';
	if ($text_color != '') $text_style = 'style="color: ' . $text_color . ';"';

	$button_style = '';
	$block_class = '';
	if ($button_color != '') {
		$block_class = 'block_' . vsc_random_id(10);
		$button_style = '<style> .' . $block_class . ' .base_clr_brd { border-color: ' . $button_color . '; } .' . $block_class . ' .base_clr_txt { color: ' . $button_color . '; } .' . $block_class . ' .base_clr_bg { background-color: ' . $button_color . '; } </style>';
	}

	$icon_style = 'style="position: absolute; left: 20px; margin-left: 0; margin-right: 0;' . $i_color . '"';

	$icon = '';

	if ($media_type == 'icon-type') {

		//if (!empty(${"icon_" . $type})) {
			$dicon = esc_attr( ${"icon_" . $type} );
		//}

		$icon .= '<i class="pull-left ' . $dicon . '" ' . $icon_style . '></i>';

	} else if ($media_type == 'img-type') {
		$img_val = '';
		if (function_exists('wpb_getImageBySize')) {
			$img_val = wpb_getImageBySize(array(
				'attach_id' => (int) $img,
				'thumb_size' => 'full'
			));
		}

		$icon .= $img_val['thumbnail'];
	}

	$output = '';
	$output = $button_style . '
<div class="long-block light ' . $cstyle . ' ' . $block_class .'">
<div class="container">
<div class="col-md-12 col-lg-9">
' . $icon . '
<article class="pull-left" style="padding-left: 83px;">
<h2 ' . $title_style . ' >' . $title . '</h2>
<p class="thin" ' . $text_style . '>' . $content . '</p>
</article>
</div>

<div class="col-md-12 col-lg-3">
<div class="pull-left btn-wrapper" style="padding-left: 83px;">
	<a href="' . $url . '" class="' . $btn_class . '">' . $text . '</a>
</div>
</div>
</div>
</div>';

	return $output;
}

add_shortcode('vsc-call-to-action', 'vsc_call_to_action');
