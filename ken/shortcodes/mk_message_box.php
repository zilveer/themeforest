<?php

extract(shortcode_atts(array(
	'el_class' => '',
	'type' => 'love',
	'style' => 'pointed',
	'icon' => '',
	'box_color' => '',
	'border_color' => '',
	'content_color' => '',
), $atts));

$output = $bg_color = $bg_border = $generic_css = $content_color_css = $separator_css = '';

if ($type == 'generic') {

	$bg_color = $box_color ? ('background-color:' . $box_color . ';') : ';';
	$bg_border = $border_color ? ('border:1px solid ' . $border_color . ';') : '';
	$content_color_css = $content_color ? ('color:' . $content_color . ' !important;') : '';
	$separator_css = ' style="border-color:' . $content_color . '"';
	$generic_css = ' style="' . $bg_color . $bg_border . $content_color_css . '" ';

	if (!empty($icon)) {
		$icon_name = (strpos($icon, 'mk-') !== FALSE) ? ($icon) : ('mk-' . $icon);
	} else {
		$icon_name = '';
	}

} else {

	switch ($type) {
		case 'love':
			$icon_name = 'mk-icon-heart';
			break;
		case 'hint':
			$icon_name = 'mk-icon-pencil';
			break;
		case 'solution':
			$icon_name = 'mk-icon-wrench';
			break;
		case 'alert':
			$icon_name = 'mk-icon-minus-circle';
			break;
		case 'confirm':
			$icon_name = 'mk-icon-check';
			break;
		case 'warning':
			$icon_name = 'mk-icon-bolt';
			break;
		case 'star':
			$icon_name = 'mk-icon-star';
			break;
		default:
			$icon_name = 'mk-icon-check';
			break;
	}

}
$output .= '<div class="mk-message-box' . $el_class . ' ' . $style . '-style ' . $type . '-box"' . $generic_css . '> <a href="#" class="box-close-btn"><i class="mk-icon-times"></i></a>';
$output .= '<div class="mk-inner-grid"><i class="messagebox-icon ' . $icon_name . '"></i><span' . $separator_css . ' class="messagebox-content">' . wpb_js_remove_wpautop($content, true) . '</span></div>';
$output .= '<div class="clearboth"></div></div>';
echo $output;
