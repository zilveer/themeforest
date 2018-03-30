<?php

$title = $link = $size = $el_position = $width = $el_class = '';
extract( shortcode_atts( array(
			'title' => '',
			'link' => '',
			'el_class' => '',
			'animation' => '',
		), $atts ) );
$output = $animation_css ='';

if ( $link == '' ) { return null; }


$animation_css = ($animation != '') ? (' mk-animate-element ' . $animation . ' ') : '';
global $wp_embed;
$embed = $wp_embed->run_shortcode( '[embed]'.$link.'[/embed]' );

$output .= "\n\t".'<div class="mk-video-player '.$animation_css.$el_class.'">';
if ( !empty( $title ) ) {
	$output .= '<div class="mk-video-title">'.$title.'</div>';
}
$output .= '<div class="video-container" '.get_schema_markup('video').'>' . $embed . '</div>';
$output .= "\n\t".'</div>';
echo $output;
