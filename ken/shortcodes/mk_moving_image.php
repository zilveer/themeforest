<?php

extract( shortcode_atts( array(
			'src' => '',
			'style' => '',
			'animation' => '',
			'align' => 'left',
			'title' => '',
			'el_class' => '',
		), $atts ) );

$animation_css = ($animation != '') ? (' mk-animate-element ' . $animation . ' ') : '';

$output .= '<div class="mk-moving-image align-'.$align.' '.$animation_css.$el_class.'">';
$output .= '<img class="mk-'.$style.'" alt="'.$title.'" title="'.$title.'" src="'.$src.'" />';
$output .= '</div>';

echo $output;
