<?php
global $mk_options;
extract( shortcode_atts( array(
	'title'          => '',
	'color'          => $mk_options['skin_color'],
    'txt_color'      => '',
    'bar_color'      => 'rgba(0,0,0,0.12)',
    'percent_color'  => 'rgba(0,0,0,0.5)',
	'percent'        => 50,
    'line_height'    => 22,
	'el_class'       => '',
), $atts ) );
Mk_Static_Files::addAssets('mk_skill_meter');