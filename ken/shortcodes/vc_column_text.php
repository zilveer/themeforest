<?php
$el_class = $width = $el_position = $output = '';

extract(shortcode_atts(array(
	'el_class' => '',
	'animation' => '',
	'responsive_align' => 'center',
	'visibility' => '',
), $atts));

$animation_css = ($animation != '') ? (' mk-animate-element ' . $animation . ' ') : '';
$output .= '<div class="mk-text-block responsive-align-'.$responsive_align.' ' . $visibility . ' ' . $animation_css . $el_class . '">';
$output .= wpb_js_remove_wpautop($content, true);
$output .= '<div class="clearboth"></div></div> ';

echo $output;
