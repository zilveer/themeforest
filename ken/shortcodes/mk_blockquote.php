<?php

extract( shortcode_atts( array(
			'el_class' => '',
			"style" => 'classic',
			"align" => 'left',
			'animation' => '',
		), $atts ) );
$output = '';
$animation_css = ($animation != '') ? (' mk-animate-element ' . $animation . ' ') : '';
$output .= '<div class="mk-blockquote '.$style.'-style align-'.$align.' '.$animation_css.$el_class.'"><div class="mk-blockquote-content"><i class="mk-icon-quote-left mk-quote-left"></i>' .wpb_js_remove_wpautop($content). '<i class="mk-icon-quote-right mk-quote-right"></i></div></div>';

echo $output;
