<?php

/*-----------------------------------------------------------------------------------*/
/*	Pie Chart VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map( array(
				"name" => __( "Pie chart", "vivaco" ),
				"base" => "vc_pie",
				"weight" => 15,
				"class" => "",
				"icon" => "icon-wpb-vc_pie",
				"category" => __( "Content", "vivaco" ),
				"description" => __( "Animated pie chart", "vivaco" ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __( "Title", "vivaco" ),
						"param_name" => "title",
						"description" => __( "Enter text which will be used as title e.g.: \"Design\",\"CSS\", \"PHP\" etc.", "vivaco" ),
						"admin_label" => true
					),
					array(
						"type" => "textfield",
						"heading" => __( "Pie number", "vivaco" ),
						"param_name" => "label_value",
						"description" => __( "Input integer any value for title.", "vivaco" ),
						"value" => ""
					),
					array(
						"type" => "textfield",
						"heading" => __( "Measurement units", "vivaco" ),
						"param_name" => "units",
						"description" => __( "Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.", "vivaco" )
					),
					array(
						"type" => "textfield",
						"heading" => __( "Pie chart fill %", "vivaco" ),
						"param_name" => "value",
						"description" => __( "Graph fill value here, choose range between 0 - 100.", "vivaco" ),
						"value" => "50"
					),
					array(
						"type" => "textfield",
						"heading" => __( "Pie size (width)", "vivaco" ),
						"param_name" => "radius",
						"description" => __( "Enter custom radius in pixels.", "vivaco" )
					),

					array(
						"type" => "dropdown",
						"heading" => __( "Title position", "vivaco" ),
						"param_name" => "title_position",
						"dependency" => array(
							"element" => "inside_content",
							"value" => array("icon", "number")
						),
						"value" => array(
							__( "Bottom", "vivaco" ) => "bottom",
							__( "Inside", "vivaco" ) => "inside"
						)
					),
					array(
						"type" => "dropdown",
						"heading" => __( "Inside content", "vivaco" ),
						"param_name" => "inside_content",
						"value" => array(
							__( "Number", "vivaco" ) => "number",
							__( "Icon", "vivaco" ) => "icon",
							__( "Title", "vivaco" ) => "title"
						)
					),
					array(
						"type" => "textfield",
						"heading" => __( "Thickness", "vivaco" ),
						"param_name" => "thickness",
						"description" => __( "Enter pie chart line thickness in pixels.", "vivaco" ),
						"value" => 6
					),
					array(
						"type" => "checkbox",
						"heading" => __( "Options", "vivaco" ),
						"param_name" => "animation",
						"value" => array(
							__( "Remove animation?", "vivaco" ) => "no"
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
							'element' => 'inside_content',
							'value' => 'icon'
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
						"heading" => __( "Extra class name", "vivaco" ),
						"param_name" => "el_class",
						"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Bar color", "vivaco" ),
						"param_name" => "bar_color",
						"description" => __( "Select pie chart color.", "vivaco" ),
						"group" => __("Change color", "vivaco"),
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Title color", "vivaco" ),
						"param_name" => "title_color",
						"description" => __( "Select title color.", "vivaco" ),
						"group" => __("Change color", "vivaco"),
						"dependency" => array(
							"element" => "title",
							"not_empty" => true
						)
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Icon color", "vivaco" ),
						"param_name" => "icon_color",
						"description" => __( "Select icon color.", "vivaco" ),
						"group" => __("Change color", "vivaco"),
						"dependency" => array(
							"element" => "inside_content",
							"value" => 'icon'
						)
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Value color", "vivaco" ),
						"param_name" => "value_color",
						"description" => __( "Select value color.", "vivaco" ),
						"group" => __("Change color", "vivaco"),
						"dependency" => array(
							"element" => "inside_content",
							"value" => 'number'
						)
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Units color", "vivaco" ),
						"param_name" => "units_color",
						"description" => __( "Select units color.", "vivaco" ),
						"group" => __("Change color", "vivaco"),
						"dependency" => array(
							"element" => "inside_content",
							"value" => 'number'
						)
					)
				)
			) );





/*-----------------------------------------------------------------------------------*/
/*	Pie Chart VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_pie_chart($atts, $content = null) {
	$title = $el_class = $el_attrs = $value = $label_value= $units = $t_style = $i_style = $v_style = '';
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
		'value' => '50',
		'label_value' => '',
		'units' => '',
		'inside_content' => 'number',
		'title_position' => 'bottom',
		'icon' => '',
		'thickness' => '6',
		'radius' => '',
		'animation' => '',
		'el_class' => '',
		'bar_color' => '',
		'title_color' => '',
		'icon_color' => '',
		'value_color' => '',
		'units_color' => ''
	), $atts));

	wp_enqueue_script('vsc-custom-pie', array( 'jquery', 'waypoints', 'progressCircle' ), true);

	if ( !empty($bar_color) ) {
		preg_match( '/#([a-f]|[A-F]|[0-9]){3}(([a-f]|[A-F]|[0-9]){3})?\b/', $bar_color, $matches);

		if( !empty($matches) ) $bar_color = 'rgba(' . hex2rgb($bar_color) . ',1)';
	}

	$css_class = ' class= "vsc_pie_chart heading-font wpb_content_element ' . $el_class;
	if ( $animation == 'no' ) $css_class .= ' no-animation';
	$css_class .= '"';

	$el_attrs .= ' data-pie-value="'. intval($value) .'"';
	$el_attrs .= ' data-pie-label-value="'. intval($label_value) .'"';
	$el_attrs .= ' data-pie-units="'. $units .'"';
	$el_attrs .= ' data-pie-units-color="'. $units_color .'"';
	$el_attrs .= ' data-pie-color="' . $bar_color . '"';
	$el_attrs .= ' data-thickness="' . intval($thickness) . '"';

	if ( !empty($title_color) ) $t_style = ' style="color: ' . $title_color . ';"';
	if ( !empty($icon_color) ) $i_style = ' style="color: ' . $icon_color . ';"';
	if ( !empty($value_color) ) $v_style = ' style="color: ' . $value_color . ';"';

	$bg_styles = ' style="border-width: '. intval($thickness) . 'px; ' . ( ( !empty($bar_color) ) ? 'border-color: ' . $bar_color . ';' : '') . '"';

	$output = "\n\t".'<div' . $css_class . $el_attrs .'>';
	$output .= "\n\t\t" . '<div class="wpb_wrapper">';
	$output .= "\n\t\t\t" . '<div class="vsc_pie_wrapper" data-radius="' . intval($radius) . '">';
	$output .= "\n\t\t\t" . '<span class="vsc_pie_chart_back base_clr_brd"' . $bg_styles . '></span>';

	if (!empty($type)) {

		if (!empty(${"icon_" . $type})) {
			$icon = esc_attr( ${"icon_" . $type} );
		}

		if ( strpos($icon, ' icon') === false ) {
			$icon = 'icon '.$icon;
		}

		vc_icon_element_fonts_enqueue( $type );

	} else {
		$icon = 'fa icon '.$icon;
	}


	if ( $title_position == 'inside' && $title != '' && $inside_content != 'title' ) $output .= "\n\t\t\t" . '<div class="vsc_pie_chart_inside">';
	if ( $inside_content == 'number' ) $output .= "\n\t\t\t" . '<span class="vsc_pie_chart_value"' . $v_style . '></span>';
	elseif ( $inside_content == 'icon' ) $output .= "\n\t\t\t" . '<span class="vsc_pie_chart_icon"><i class="' . $icon . '"' . $i_style . '></i></span>';
	if ( $title_position == 'inside' && $title != '' || $inside_content == 'title' ) $output .= "\n\t\t\t" . '<h4 class="wpb_heading wpb_pie_chart_heading"' . $t_style . '>' . $title . '</h4>';
	if ( $title_position == 'inside' && $title != '' && $inside_content != 'title' ) $output .= "\n\t\t\t" . '</div>';

	$output .= "\n\t\t\t" . '<canvas width="101" height="101"></canvas>';
	$output .= "\n\t\t\t" . '</div>';

	if ( $title_position == 'bottom' && $title != '' && $inside_content != 'title' ) $output .= '<h4 class="wpb_heading wpb_pie_chart_heading"' . $t_style . '>' . $title . '</h4>';

	$output .= "\n\t\t".'</div>';
	$output .= "\n\t".'</div>';

	return $output;
}

add_shortcode('vc_pie', 'vsc_pie_chart');
