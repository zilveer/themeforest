<?php

/*-----------------------------------------------------------------------------------*/
/*	Counter VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map( array(
				"name" => __( "Counter", "vivaco" ),
				"weight" => 14,
				"base" => "vsc-counter",
				"icon" => "icon-counter",
				"category" => __( "Content", "vivaco" ),
				"description" => __( "Animated counter with title", "vivaco" ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __( "Counter number", "vivaco" ),
						"param_name" => "value",
						"description" => __( "Input value here.", "vivaco" ),
						"value" => "0",
						"admin_label" => true
					),
					array(
						"type" => "textfield",
						"heading" => __( "Counter text", "vivaco" ),
						"param_name" => "title",
						"description" => __( "Enter text which will be used as widget title. Leave blank if no title is needed.", "vivaco" ),
						"admin_label" => true
					),
					array(
						"type" => "textfield",
						"heading" => __( "Prefix", "vivaco" ),
						"param_name" => "units",
						"description" => __( "Enter measurement units (if needed) Eg. %, px, points, etc.", "vivaco" )
					),
					array(
						"type" => "textfield",
						"heading" => __( "Number size", "vivaco" ),
						"param_name" => "val_font_size",
						"description" => __( "Enter font size of value with units 	in pixels (default - 100px).", "vivaco" )
					),
					array(
						"type" => "textfield",
						"heading" => __( "Text size", "vivaco" ),
						"param_name" => "title_font_size",
						"description" => __( "Enter title font size in pixels (default - 13px).", "vivaco" ),
						"dependency" => array(
							"element" => "title",
							"not_empty" => true
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
						"type" => "dropdown",
						"heading" => __( "Icon position", "vivaco" ),
						"param_name" => "icon_position",
						"dependency" => array(
							"element" => "type",
							"not_empty" => true
						),
						"value" => array(
							__( "Top", "vivaco" ) => "top",
							__( "Left", "vivaco" ) => "left"
						)
					),
					array(
						"type" => "checkbox",
						"heading" => __( "Options", "vivaco" ),
						"param_name" => "options",
						"value" => array(
							__( "Remove animation?", "vivaco" ) => "no_animation",
							__( "Add separator?", "vivaco" ) => "separator"
						)
					),
					array(
						"type" => "textfield",
						"heading" => __( "Extra class name", "vivaco" ),
						"param_name" => "el_class",
						"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Text color", "vivaco" ),
						"param_name" => "title_color",
						"description" => __( "Select title color.", "vivaco" ),
						"group" => __("Change color", "vivaco"),
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Number color", "vivaco" ),
						"param_name" => "value_color",
						"description" => __( "Select value color.", "vivaco" ),
						"group" => __("Change color", "vivaco"),
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Prefix color", "vivaco" ),
						"param_name" => "units_color",
						"description" => __( "Select units color.", "vivaco" ),
						"group" => __("Change color", "vivaco"),
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Icon color", "vivaco" ),
						"param_name" => "icon_color",
						"description" => __( "Select icon color.", "vivaco" ),
						"group" => __("Change color", "vivaco"),
					)
				)
			) );





/*-----------------------------------------------------------------------------------*/
/*	Counter VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_counter($atts, $content = null) {
	$title = $value = $units = $title_font_size = $val_font_size = $icon = $icon_position = $options = '';
	$animation = $separator = $el_class = $label_color = $value_color = $units_color = $title_color = $icon_color = $tstyle = '';
	$type = $icon_startuplyli = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = $add_icon ='';

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
		'value' => '0',
		'units' => '',
		'title_font_size' => '',
		'val_font_size' => '',
		'icon' => '',
		'icon_position' => 'top',
		'options' => '',
		'el_class' => '',
		'label_color' => '',
		'title_color' => '',
		'icon_color' => '',
		'value_color' => '',
		'units_color' => '',
		'add_icon' => '',
	), $atts));

	wp_enqueue_script('vsc-counter', array( 'jquery', 'waypoints' ), true);

	$options = explode( ',', $options );
	if ( in_array( 'no_animation', $options ) ) $animation .= 'no';
	if ( in_array( 'separator', $options ) ) $separator .= 'yes';

	$css_class = ' class= "vsc_counter wpb_content_element heading-font ' . $el_class;
	if ( $animation != '' ) $css_class .= ' no-animation';
	if ( $separator != '' ) $css_class .= ' separator';
	$css_class .= '"';

	$tstyle = ' style="'. ( ( $title_color != '' ) ? 'color: ' . $title_color . ';' : '' ) . ( ( $title_font_size != '' ) ? ' font-size: ' . intval($title_font_size) . 'px;' : '' ) . '"';

	$output = "\n\t" . '<div' . $css_class . ( ( $animation != 'no' ) ? ' data-counter-value="' . intval($value) . '" data-counter-units="' . $units .'"' : '' ) . '>';
	$output .= "\n\t\t" . '<span class="vsc_counter_label base_clr_txt ' . $icon_position . '"' . ( ( $label_color != '' ) ? ' style="color: ' . $label_color . ';"' : '' ) . '>';


	if ($add_icon == 'true') {
		$icon = esc_attr( ${"icon_" . $type} );
		if ( strpos($icon, ' icon') === false ) {
			$icon = 'icon '.$icon;
		}
		vc_icon_element_fonts_enqueue( $type );

	} else {
		$icon = '';
	}

	if ( $icon != '' ) $output .= "\n\t\t\t" . '<i class="fa icon ' . $icon . '"' . ( ( $icon_color != '' ) ? 'style="color: ' . $icon_color . ';"' : '' ) . '></i>';

	$output .= "\n\t\t\t" . '<em class="vsc_counter_value" style="' . ( ( $val_font_size != '' ) ? ' font-size: ' . intval($val_font_size) . 'px;' : '' ) . ( ( $value_color != '' ) ? ' color: ' . $value_color . ';' : '' ) . '"><span style="'.( ( $value_color != '' ) ? ' color: ' . $value_color . ';' : '' ).'" class="vsc_counter_value_place">';
	$output .= ( ( $animation == 'no' ) ? intval($value) : '' );
	$output .= '</span> <i class="units"' . ( ( $units_color != '' ) ? ' style="color: ' . $units_color . ';"' : '' ) . '>' . $units . '</i>' . '</em></span>';

	if ( $title != '' ) $output .= "\n\t\t" . '<h4 class="vsc_counter_title"' . $tstyle . '>' . $title . '</h4>';

	$output .= "\n\t" . '</div>';

	return $output;
}

add_shortcode('vsc-counter', 'vsc_counter');
