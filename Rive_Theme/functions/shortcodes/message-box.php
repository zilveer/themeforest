<?php
/**
* Display message boxes with some content
**/

// Normal message boxes
function ch_message_box($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'close' => 'false'
	), $atts));

	$output = '<div class="alert ' . $code . '">';

	if ( $close == 'true' ) {
		$output .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
	}

	$output .= '<div class="alert_box_content">' . do_shortcode($content) . '</div>
		    </div>';

	return $output;
}

add_shortcode('alert-message','ch_message_box');
add_shortcode('alert-success','ch_message_box');
add_shortcode('alert-error','ch_message_box');
add_shortcode('alert-info','ch_message_box');

// Custom message box
function ch_custom_message_box($atts, $content = null, $code) {

	// Vars
	$style       = '';
	$inner_style = '';
	extract(shortcode_atts(array(
		'width'   => '',
		'height'  => '',
		'bgcolor' => '',
		'border'  => '',
		'color'   => '',
		'align'   => 'left',
		'close' => 'false'
	), $atts));

	$width   = $width ? ' width:' . $width . ';' : '';
	$height  = $height ? ' height:' . $height . ';' : '';
	$bgcolor = $bgcolor ? ' background-color:' . $bgcolor . ';' : '';
	$color   = $color ? ' color:' . $color . ';' : '';
	$border  = $border ? ' border-color:' . $border . ';': '';
	if ($align == 'center') {
		$align = 'margin-right: auto !important; margin-left: auto !important;';
	} elseif ($align == 'right') {
		$align = 'margin-left: auto !important; margin-right: 0 !important;';
	} else {
		$align = '';
	}

	if(!empty($align) || !empty($border) || !empty($width) || !empty($bgcolor))
		$style = ' style="' . $align . $border . $width . $bgcolor . '"';

	if(!empty($height) || !empty($color))
		$inner_style = ' style="' . $height . $color . '"';
	$output = '<div class="alert ' . $code . '"' . $style . '>';


	if ( $close == 'true' ) {
		$output .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
	}

	$output .= '<div class="alert_box_content"' . $inner_style . '>' . do_shortcode($content) . '</div>
			</div>';

	return $output;
}
add_shortcode('custom_message', 'ch_custom_message_box');