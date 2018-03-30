<?php
global $mk_settings;

extract( shortcode_atts( array(
			'text' => '',
			'style' => 'default',
			'fill_color' => $mk_settings['accent-color'],
			'el_class' => '',
		), $atts ) );

$fill_color_css = '';
if($style == 'custom') {
	$fill_color_css = ' style="background-color:'.$fill_color.';"';
}

echo '<span'.$fill_color_css.' class="mk-highlight '.$style.'-highlight '.$el_class.'">'.$text.'</span>';
