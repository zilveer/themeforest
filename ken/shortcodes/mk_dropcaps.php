<?php
global $mk_settings;

extract(shortcode_atts(array(
	'style' => 'square-default',
	'fill_color' => $mk_settings['accent-color'],
	'char' => '',
	'el_class' => '',
), $atts));

$fill_color_css = '';
if ($style == 'square-custom' || $style == 'circle-custom') {
	global $mk_accent_color, $mk_settings;
	$fill_color = ($fill_color == $mk_settings['accent-color']) ? $mk_accent_color : $fill_color;
	$fill_color_css = 'style="background-color:' . $fill_color . ';" ';
}

$output = '<div class="mk-dropcaps-wrapper ' . $el_class . '"><p>';
$output .= '<span ' . $fill_color_css . 'class="mk-dropcaps mk-shortcode ' . $style . '">' . $char . '</span>';
$output .= wpb_js_remove_wpautop($content);
$output .= '</p></div>';

echo $output;