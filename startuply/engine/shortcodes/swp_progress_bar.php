<?php

/*-----------------------------------------------------------------------------------*/
/*	Progress Bar VC Mapping (Backend)
/*-----------------------------------------------------------------------------------*/
			vc_map( array(
				"name" => __( "Progress Bar", "vivaco" ),
				"base" => "vc_progress_bar",
				"icon" => "icon-wpb-graph",
				"weight" => 15,
				"category" => __( "Content", "vivaco" ),
				"description" => __( "Animated progress bar", "vivaco" ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __( "Progress bar title", "vivaco" ),
						"param_name" => "title",
						"description" => __( "Enter title of progress bar.", "vivaco" )
					),
					array(
						"type" => "textfield",
						"heading" => __( "Value %", "vivaco" ),
						"param_name" => "value",
						"description" => __( "Value in percents", "vivaco" )
					),
					array(
						"type" => "textfield",
						"heading" => __( "Displayed value", "vivaco" ),
						"param_name" => "dvalue",
						"description" => __( "Displayed value", "vivaco" )
					),
					array(
						"type" => "textfield",
						"heading" => __( "Measurement units", "vivaco" ),
						"param_name" => "units",
						"dependency" => array(
							"element" => "dvalue",
							"not_empty" => true
						),
						"description" => __( "Enter measurement units (if needed) Eg. %, px, points, etc. Value and unit will be appended to the progress bar count.", "vivaco" )
					),
					array(
						"type" => "dropdown",
						"heading" => __("Content position", "vivaco"),
						"param_name" => "position",
						"description" => "Select content position in bar.",
						"value" => array(
							__("Default", "vivaco") => "",
							__("Value inside", "vivaco") => "value_inside",
							__("All inside", "vivaco") => "all_inside"
						)
					),
					array(
						"type" => "textfield",
						"heading" => __( "Bar height", "vivaco" ),
						"param_name" => "height",
						"description" => __( "Enter bar height in px.", "vivaco" ),
						"value" => 20
					),
					array(
						"type" => "textfield",
						"heading" => __( "Round corners", "vivaco" ),
						"param_name" => "round",
						"description" => __( "Enter round value in px for bar.", "vivaco" ),
						"value" => 0
					),
					array(
						"type" => "textfield",
						"heading" => __('Margin Bottom', "vivaco"),
						"param_name" => "margin_bottom"
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Bar custom color", "vivaco" ),
						"param_name" => "bgcolor",
						"description" => __( "Select custom background color for bars.", "vivaco" ),
						"group" => __("Change color", "vivaco")
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Title custom color", "vivaco" ),
						"param_name" => "title_color",
						"description" => __( "Select custom title color.", "vivaco" ),
						"dependency" => array(
							"element" => "title",
							"not_empty" => true
						),
						"group" => __("Change color", "vivaco")
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Value custom color", "vivaco" ),
						"param_name" => "value_color",
						"description" => __( "Select custom value color.", "vivaco" ),
						"group" => __("Change color", "vivaco")
					),
					array(
						"type" => "checkbox",
						"heading" => __( "Options", "vivaco" ),
						"param_name" => "options",
						"value" => array(
							__( "Add Stripes?", "vivaco" ) => "striped",
							__( "Add Gradient?", "vivaco" ) => "gradient",
							__( "Disable Bar Animation?", "vivaco" ) => "no_animation",
							__( "Add animation for stripes", "vivaco" ) => "stripes_animation"
						)
					),
					array(
						"type" => "textfield",
						"heading" => __( "Extra class name", "vivaco" ),
						"param_name" => "el_class",
						"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "vivaco" )
					)
				)
			) );





/*-----------------------------------------------------------------------------------*/
/*	Progress Bar VC Render (Front-end)
/*-----------------------------------------------------------------------------------*/
function vsc_progress_bar($atts, $content = null) {
	extract( shortcode_atts( array(
		'title' => '',
		'value' => '50',
		'dvalue' => '',
		'units' => '',
		'position' => '',
		'height' => '',
		'round' => '',
		'bgcolor' => '',
		'title_color' => '',
		'value_color' => '',
		'options' => '',
		'el_class' => '',
		'margin_bottom' => ''
	), $atts ) );
	wp_enqueue_script( 'waypoints' );

	// Name, Percents???, Height, Edges(on/off)???, Fill(Default/Gradient), Striped(on/off) Content Position(Default/Numbers Inside/All Inside),
	// Margin Bottom, Color, Font-size???, Gradient Settings???, Animate Stripes???, Units, Bar color???, Stripes Settings???

	$no_animation = ''; //replace with valid option

	$output = $bar_options = $css_class = $percentage_value = '';
	$el_style = $bar_style = $title_style = $value_style = $bar_class = '';

	// $bgcolor = $title_color = $value_color = '';

	$options = explode( ',', $options );
	if ( in_array( 'striped', $options ) ) $bar_options .= ' striped';
	if ( in_array( 'gradient', $options ) ) $bar_options .= ' gradient';
	if ( in_array( 'no_animation', $options ) ) $bar_options .= ' no-animation';
	if ( in_array( 'stripes_animation', $options ) ) $bar_options .= ' stripes-animation';

	if ( $units == '' ) $units = '%';
	if ( intval($round) >= intval($height)/2 ) $round = intval($height)/2;

	$el_style = 'style="';
	if ( $margin_bottom != '' ) $el_style .= ' margin-bottom: ' . intval($margin_bottom) . 'px;';
	if ( $round != 0 && $round != '' ) $el_style .= ' border-radius: ' . intval($round) . 'px;';
	$el_style .= '"';

	if ( $value != '' ) $percentage_value = intval($value);
	elseif ( $value > 100.00 ) $percentage_value = 100;
	else $percentage_value = 0;

	if ( $dvalue != '' ) $displayed_value = $dvalue . $units;
	else $displayed_value = $percentage_value . '%';

	$css_class = ' class="vsc_progress_bar wpb_content_element heading-font ' . $el_class;
	if ( $no_animation == 'yes' ) $css_class .= ' no-animation';
	if ( $position == 'value_inside' ) $css_class .= ' value_inside"';
	elseif ( $position == 'all_inside' ) $css_class .= ' all_inside"';
	else $css_class .= '"';

	$bar_class = ' class="vsc_bar base_clr_bg' . $bar_options . '"';

	$bar_style = ' style="';
	if ( $height != '' ) $bar_style .= ' height: ' . intval($height) . 'px;';
	if ( $height != '' && $position != '' ) $bar_style .= ' line-height: ' . intval($height) . 'px;';
	if ( $round != 0 && $round != '' ) $bar_style .= ' border-radius: ' . intval($round) . 'px;';
	if ( $bgcolor != '' ) $bar_style .= ' background: ' . $bgcolor . ';';

	if ( $title_color != '' ) $title_style = ' style="color: ' . $title_color . ';"';
	if ( $value_color != '' ) $value_style = ' style="color: ' . $value_color . ';"';

	if ( in_array( 'gradient', $options ) ) {
		$gradient_color = adjustBrightness($bgcolor, 35);
		$bar_style .= ' background: -webkit-gradient(linear, left top, right top, color-stop(0%,' . $bgcolor . '), color-stop(100%,' . $gradient_color . '));';
		$bar_style .= ' background: -webkit-linear-gradient(left, ' . $bgcolor . ' 0%,' . $gradient_color . ' 100%);';
		$bar_style .= ' background: -moz-linear-gradient(left, ' . $bgcolor . ' 0%, ' . $gradient_color . ' 100%);';
		$bar_style .= ' background: -ms-linear-gradient(left, ' . $bgcolor . ' 0%,' . $gradient_color . ' 100%);';
		$bar_style .= ' background: -o-linear-gradient(left, ' . $bgcolor . ' 0%,' . $gradient_color . ' 100%);';
		$bar_style .= ' background: linear-gradient(to right, ' . $bgcolor . ' 0%,' . $gradient_color . ' 100%);';
		$bar_style .= ' filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $bgcolor . '\', endColorstr=\'' . $gradient_color . '\',GradientType=1 );';
	}

	$bar_style .= '"';

	$output = "\n\t".'<div' . $css_class . ' ' . $el_style . '>';
	$output .= "\n\t\t".'<span' . $bar_class . $bar_style . ' data-percentage-value="' . $percentage_value . '" data-value="' . intval($value) . '">';
	$output .= "\n\t\t\t".'<small class="vsc_label"' . $title_style . '>' . $title . '</small>';
	$output .= "\n\t\t\t".'<small class="vsc-bar-value"' . $value_style . '>' . $displayed_value . '</small>';
	$output .= "\n\t\t".'</span>';
	$output .= "\n\t".'</div>';

	return $output;
}

add_shortcode('vc_progress_bar', 'vsc_progress_bar');
