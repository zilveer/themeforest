<?php

$args = array(
    'columns'     		=> 'four_columns',
	'lines_between'		=> '',
	'line_color'		=> ''
);

$html 					= '';
$styles 				= array();
$circle_holder_class 	= array();

extract(shortcode_atts($args, $atts));

$circle_holder_class[] = $columns;

if(isset($lines_between) && $lines_between == 'yes') {
	$circle_holder_class[] = 'with_lines';
}

if(isset($line_color) && $line_color != '') {
	$styles[] = 'border-color: '.$line_color;
}

$html = '<div class="q_circles_shortcode">';
$html .= '<ul class="q_circles_holder '.implode(' ', $circle_holder_class).'" style="'.implode(' ', $styles).'">';

$html .= do_shortcode($content);

$html .= '</ul>';

$html .= '</div>'; //close div.q_circles_shortcode

print $html;