<?php

/*
* Show a button
*/

function ch_button($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'id'     => '',
		'class'  => '',
		'size'   => '',
		'type'   => 'button', // button, rounded-button
		'href'   => '',
		'target' => '',
		'color'  => ''
	), $atts));

	$id     = $id ? ' id="' . $id . '"' : '';
	$type   = ( $type == 'rounded-button' ) ? 'rounded-btn btn' : 'btn';
	$class  = $class ? $type . ' ' . $class . ' ' : $type . ' ';
	$href   = $href ? ' href="' . $href . '"' : '';
	$target = $target ? ' target="' . $target . '"' : '';
	$color  = $color ? 'color: ' . $color . '; ' : '';
	$style  = ($color != '') ? ' style="' . $color . '"' : '';

	$content = '<a' . $href . $target . $id . $style . ' class="' . $class . '' . $size . '">' . trim($content) . '</a>';
	$content = $content;

	return $content;
}
add_shortcode('button', 'ch_button');