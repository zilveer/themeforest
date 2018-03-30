<?php

$args = array(
	'animation_type' => '',
	'border_color' => '',
	'border_width' => '',
	'animation_time' => '2',
//	'transition_delay' => '',
	'holder_padding' => ''
);

extract(shortcode_atts($args, $atts));

$border_color = esc_attr($border_color);
$border_width = esc_attr($border_width);
$animation_time = esc_attr($animation_time);
$holder_padding = esc_attr($holder_padding);

$animated_elements_holder_style = '' ;
$border_style = '';

if ($animation_type == '') {

	$border_style = 'border: ';

	if ($border_width !== '') {
		$border_style .= $border_width. 'px';
	}

	$border_style .= ' solid ';

	if ($border_color !== '') {
		$border_style .= $border_color . ';';
	}

}

if ($holder_padding !== '') {
	$animated_elements_holder_style = "padding: " .$holder_padding. "px;";
}

$html = '';

$html = '<div class="q_animated_elements_holder" style="' .$animated_elements_holder_style. ' ' .$border_style. '" data-animation="' .$animation_type. '" data-animation-time="' .$animation_time. '" data-border-color="' .$border_color. '" data-border-width="' .$border_width. '">';
$html .= do_shortcode($content);
$html .= '</div>';

print $html;