<?php

global $mk_settings;

extract( shortcode_atts( array(
			'desc' 			=> '',
			'desc_color' 	=> '',
			'percent' 		=> 50,
			'bar_color' 	=> $mk_settings['accent-color'],
			'track_color' 	=> '#fafafa',
			'line_width' 	=> 15,
			'bar_size' 		=> 170,
			'content' 		=> '',
			'content_type' 	=> 'percent',
			'icon' 			=> '',
			'icon_size' 	=> '16px',
			'font_size' 	=> '18',
			'font_weight' 	=> 'inherit',
			'custom_text' 	=> '',
			'el_class' 		=> '',
			'animation' 	=> '',
		), $atts ) );

$output = $desc_color_style = '';

if(!empty( $icon )) {
    $icon = (strpos($icon, 'mk-') !== FALSE) ? ( $icon ) : ( 'mk-'.$icon );    
} else {
    $icon = '';
}

///////////////////////////////////////////////////////////
//
// Prepare conditional output
//
//////////////////////////////////////////////////////////
if(!empty($desc_color)){
	$desc_color_style .= 'color:'.$desc_color.'';
}

$animation_css = ($animation != '') ? (' mk-animate-element ' . $animation . ' ') : '';
$output .= '<div class="'.$animation_css.'">';
$output .= '<div class="mk-chart" style="width:'.$bar_size.'px;height:'.$bar_size.'px;line-height:'.$bar_size.'px" data-percent="'.$percent.'" data-barColor="'.$bar_color.'" data-trackColor="'.$track_color.'" data-lineWidth="'.$line_width.'" data-barSize="'.$bar_size.'">';
if ( $content_type == 'icon' ) {
	$output .= '<i style="line-height:'.$bar_size.'px;color:'.$bar_color.'; font-size: '.$icon_size.';" class="'.$icon.'"></i>';
} elseif ( $content_type == 'custom_text' ) {
	$output .= '<span class="chart-custom-text" style="font-size:'.$font_size.'px; color:'.$bar_color.'; font-weight:'.$font_weight.';">'.$custom_text.'</span>';
} else {
	$output .= '<div class="chart-percent" style="font-size:'.$font_size.'px; color:'.$bar_color.'; font-weight:'.$font_weight.';"><span>'.$percent.'</span>%</div>';
}
$output .= '</div>';
$output .= '<div class="mk-chart-desc" style="'.$desc_color_style.'">'.$desc.'</div>';
$output .= '</div>';
echo $output;
