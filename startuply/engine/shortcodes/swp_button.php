<?php

/*-----------------------------------------------------------------------------------*/
/*	Button VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map(array(
				"name" => __("Button", "vivaco"),
				"base" => "vsc-button",
				"weight" => 10,
				"icon" => "icon-buttons",
				"description" => "Eye catching button",
				"class" => "buttons_extended",
				"category" => __("Content", "vivaco"),
				"params" => array(
					array(
						"type" => "textfield",
						"admin_label" => true,
						"heading" => __("Text on the button", "vivaco"),
						"param_name" => "text",
						"value" => "Click me"
					),
					array(
						"type" => "textfield",
						"heading" => __("URL(Link)", "vivaco"),
						"param_name" => "url"
					),
					array(
						"type" => "dropdown",
						"heading" => __("Target", "vivaco"),
						"param_name" => "target",
						"value" => array(
							__("Opens the link in the same window", "vivaco") => '',
							__("Opens the link in a new window", "vivaco") => "yes",
							__("Opens a modal box", "vivaco") => "modal"
						),
						"description" => __("Set the target of the link", "vivaco")
					),
					array(
						"type" => "textfield",
						"heading" => __("Display modal box by ID", "vivaco"),
						"param_name" => "modal_box_id",
						'dependency' => array(
							'element' => 'target',
							'value' => 'modal',
						),
					),

					array(
						"type" => "dropdown",
						"heading" => __("Button style", "vivaco"),
						"param_name" => "style",
						"value" => array(
							__("Solid color button", "vivaco") => 'btn-solid',
							__("White outline button", "vivaco") => "btn-outline",
							__("Color outline button", "vivaco") => "btn-outline-color",
							__("Clear, no border", "vivaco") => "btn-no-border"
						)
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Button alignment', 'js_composer' ),
						'param_name' => 'align',
						'description' => __( 'Select button alignment.', 'js_comopser' ),
						// compatible with btn2, default left to be compatible with btn1
						'value' => array(
							__( 'Inline', 'js_composer' ) => 'inline',
							// default as well
							__( 'Left', 'js_composer' ) => 'left',
							// default as well
							__( 'Right', 'js_composer' ) => 'right',
							__( 'Center', 'js_composer' ) => 'center'
						),
					),
					array(
						'type' => 'checkbox',
						'heading' => __( 'Add icon?', 'js_composer' ),
						'param_name' => 'add_icon',
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
							'element' => 'add_icon',
							'value' => 'true',
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
						'type' => 'dropdown',
						'heading' => __( 'Icon Alignment', 'js_composer' ),
						'description' => __( 'Select icon alignment.', 'js_composer' ),
						'param_name' => 'i_align',
						'value' => array(
							__( 'Left', 'js_composer' ) => 'pull-left',
							// default as well
							__( 'Right', 'js_composer' ) => 'pull-right',
						),
						'dependency' => array(
							'element' => 'add_icon',
							'value' => 'true',
						),
					),
					array(
						"type" => "dropdown",
						"heading" => __("Button size", "vivaco"),
						"param_name" => "size",
						"value" => array(
							__("Medium", "vivaco") => "",
							__("Small", "vivaco") => "btn-sm",
							__("Big", "vivaco") => "btn-lg"
						)
					),
					array(
						"type" => "textfield",
						"heading" => __("Text size", "vivaco"),
						"description" => __("Button text size in px", "vivaco"),
						"param_name" => "text_size",
						"value" => ''
					),
					array(
						"type" => "textfield",
						"heading" => __("Icon size", "vivaco"),
						"description" => __("Icon text size in px", "vivaco"),
						'dependency' => array(
							'element' => 'add_icon',
							'value' => 'true',
						),
						"param_name" => "i_size",
						"value" => ''
					),
					array(
						'type' => 'textfield',
						'heading' => __('Extra class name', 'vivaco'),
						'param_name' => 'el_class',
						'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'vivaco')
					),
					array(
						'type' => 'css_editor',
						'heading' => __( 'Css', 'js_composer' ),
						'param_name' => 'css',
						'group' => __( 'Padding & Margins', 'js_composer' )
					),
					array(
						'type' => 'colorpicker',
						'group' => 'Change color',
						'heading' => __('Main button color', 'vivaco'),
						'param_name' => 'color',
						'dependency' => array(
							'element' => 'style',
							'value' => array('btn-solid', 'btn-outline-color'),
						)
					),
					array(
						'type' => 'colorpicker',
						'group' => 'Change color',
						'heading' => __('Text color', 'vivaco'),
						'param_name' => 'text_color'
					),
					array(
						'type' => 'colorpicker',
						'group' => 'Change color',
						'heading' => __('Icon color', 'vivaco'),
						'param_name' => 'i_color',
						'dependency' => array(
							'element' => 'add_icon',
							'value' => 'true',
						)
					),
				)
			));





/*-----------------------------------------------------------------------------------*/
/*	Button VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_button_shortcode($atts, $content = null) {
	$css = $type = $icon_startuplyli = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypoicons = $icon_linecons = $color = $style = $text = $size = $url = $icon = $target = $icon_right = '';
	$btn_style = $custom_class = $custom_styles = $b_custom_styles = $button_style = $icon_i = $icon_p = $b_target = $align = $modal_box_id = $whframe = '';
	extract(shortcode_atts(array(
		'css' => '',
		'type' => 'startuplyli',
		'icon_startuplyli' => 'icon icon-graphic-design-13',
		'icon_fontawesome' => 'fa fa-adjust',
		'icon_openiconic' => 'vc-oi vc-oi-dial',
		'icon_typicons' => 'typcn typcn-adjust-brightness',
		'icon_entypoicons' => 'entypo-icon entypo-icon-note',
		'icon_linecons' => 'vc_li vc_li-heart',
		'icon_entypo' => 'entypo-icon entypo-icon-note',
		'color' => '',
		'style' => 'btn-solid',
		'text' => '',
		'size' => '',
		'text_size' => '',
		'text_color' => '',
		'url' => '',
		'target' => '',
		'icon_right' => '',
		'add_icon' => '',
		'align' => 'inline',
		'i_size' => '',
		'i_color' => '',
		'i_align' => '',
		'el_class' => '',
		'modal_box_id' => '',
		'whframe' =>'',
	), $atts));

	$btn_style = '';

	vc_icon_element_fonts_enqueue( $type );

	if ( $style == 'btn-solid' ) {
		$btn_style = 'btn-solid base_clr_bg';
	} else if ( $style == 'btn-no-border' ) {
		$btn_style = 'btn-no-border base_clr_txt';
	} else if ( $style == 'btn-outline-color' ) {
		$btn_style = 'btn-outline-color base_clr_txt base_clr_bg base_clr_brd';
	} else if ( $style == 'alt' ) { // what?
		$btn_style = 'btn-outline-color base_clr_txt base_clr_bg base_clr_brd';
	} else if ( $style == '' ) {
		$btn_style = 'btn-solid base_clr_bg';
	} else {
		$btn_style = 'btn-outline base_clr_txt';
	}

	if ( $color != '' ) {
		$custom_class = 'btn_' . vsc_random_id(10);
		$button_style = ' <style> .' . $custom_class . '.base_clr_brd { border-color: ' . $color . '; } .' . $custom_class . '.base_clr_txt { color: ' . $color . '; } .' . $custom_class . '.base_clr_bg { background-color: ' . $color . '; } </style>';
	}

	if ($text_size != '') {$b_custom_styles .= 'font-size:' . esc_attr( $text_size ) .'px; line-height: '. esc_attr( $text_size ) .'px;';};
	if ($text_color != '') {$b_custom_styles .= 'color:' . esc_attr( $text_color ) .';';};
	if ($i_color != '') {$custom_styles = 'color:' . esc_attr( $i_color ) .';';};
	if ($i_size != '') {$custom_styles .= 'font-size:' . esc_attr( $i_size ) .'px; line-height: '. esc_attr( $text_size ) .'px;';};

	$align_before = '';
	$align_after= '';
	if ($align != '' && $align != 'inline') {

		if ($align == 'center' || $align == 'left' || $align == 'right')
			$align_before .= '<div class="align-wrap" style="text-align: '. esc_attr( $align ) .';">';
			$align_after .= '</div>';

	};

	$i_align = ($i_align != '') ? $i_align : 'pull-left';

	if ( 'true' === $add_icon ) {
		$icon_i = ($type != '') ? '<span class="vc_icon_element-icon base_clr_txt '. $i_align .' '.esc_attr( ${"icon_" . $type} ).'"' . ' style="' . $custom_styles .'"></span>' : '';
	} else {
		$icon_i = '';
	}

	if ( !empty($el_class) ) { $vsc_class = $el_class;} else { $vsc_class = vc_shortcode_custom_css_class( $css, ' ' ); }

	$b_target = ($target != '') ? 'target="_blank"' : '';
	$class = ($el_class != '') ? $el_class : '';
	
	if( $target == 'modal') {
		$data_modal =  'data-modal-link="vivaco-'.$modal_box_id.'"';
	} else {
		$data_modal = '';
	}

	if ($url) {
		return $align_before . '<a ' . $b_target . 'class="btn '.$vsc_class.' '.$custom_class.' '.$size.' '.$btn_style . ' ' . $icon_p . '" href="' . $url . '" '.$data_modal.' style="' . $b_custom_styles .'">' . $icon_i . '' . $text . $content . '</a>' . $button_style . $align_after;
	} else {
		return $align_before . '<a class="btn ' . $custom_class . ' ' . $size . ' ' . $btn_style . ' ' . $icon_p . '" href="" '.$data_modal.'>' . $icon_i . '' . $text . $content . '</a>' . $button_style . $align_after;
	}
}

add_shortcode('vsc-button', 'vsc_button_shortcode');
