<?php

if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );	
}

extract( shortcode_atts( array(
	'el_width' => '',
	'style' => '',
	'color' => '',
	'accent_color' => '',
	'el_class' => '',
	'alignment' => '',
	'width' => '',
	'margin_top' => '',
	'margin_bottom' => '',
	'color' => '',
), $atts ) );

$style = '';

if ( $width ) {
	$width = ( is_numeric( $width ) ) ? $width . 'px' : $width;
	$style .="width:$width;";
}

if ( 'left' == $alignment ) {
	$style .= 'margin-left:0;';
}

if ( 'right' == $alignment ) {
	$style .= 'margin-right:0;';
}

if ( $margin_top ) {
	$margin_top = ( is_numeric( $margin_top ) ) ? $margin_top . 'px' : $margin_top;
	$style .="margin-top:$margin_top;";
}

if ( $margin_bottom ) {
	$margin_bottom = ( is_numeric( $margin_bottom ) ) ? $margin_bottom . 'px' : $margin_bottom;
	$style .="margin-bottom:$margin_bottom;";
}

if ( $color ) {
	$style .= "background-color:$color;";
}

$inline_style = ( $style ) ? "style='$style'" : '';
echo "<hr $inline_style>";