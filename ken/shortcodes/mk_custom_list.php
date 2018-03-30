<?php
global $mk_settings;
extract( shortcode_atts( array(
			'el_class' => '',
			'style' => 'f00c',
			'icon_color'=> $mk_settings['accent-color'],
			'animation' => '',
			'margin_bottom' => 30,
		), $atts ) );

$id = Mk_Static_Files::shortcode_id();
$output = $animation_css = '';
if ( $animation != '' ) {
	$animation_css = ' mk-animate-element ' . $animation . ' ';
}

if(substr( $style, 0, 2 ) == 'e6' ) {
	$font_family = 'Pe-icon-line';
} else if(substr( $style, 0, 2 ) == 'e0' ) {
	$font_family = 'Flaticon';
} else if ( substr( $style, 0, 1 ) == 'e' ) {
	$font_family = 'ArtbeesWPTokens';
}  else {
	$font_family = 'FontAwesome';
}

global $mk_accent_color, $mk_settings;

$icon_color = ($icon_color == $mk_settings['accent-color']) ? $mk_accent_color : $icon_color;

$output .= '<div id="list-style-'.$id.'" class="mk-list-styles '.$animation_css.$el_class.'" style="margin-bottom:'.$margin_bottom.'px">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';



Mk_Static_Files::addCSS('
	#list-style-'.$id.' ul li:before {
	    font-family:"'.$font_family.'";
	    content: "\\'.$style.'";
	    color:'.$icon_color.'
	}
', $id);

echo $output;


