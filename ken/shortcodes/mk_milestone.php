<?php

extract( shortcode_atts( array(
			"style" => 'classic',
			"icon" => '',
			"color" => '#919191',
			"type" => 'icon',
			'text_size' => 12,
			'icon_size' => 16,
			'number_size' => 46,
			"start" => 0,
			"stop" => 100,
			"speed" => 2000,
			"text" => '',
			'text_icon_color' => '',
			'text_suffix' => '',
			'border_bottom' => '#eee',
			'number_suffix_text_size' => 12,
			'el_class' => '',
		), $atts ) );

$output = $output_icon = '';

switch ($icon_size) {
	case 16:
		$line_height = 32;
		break;
	case 32:
		$line_height = 64;
		break;	
	case 48:
		$line_height = 86;
		break;	
	case 64:
		$line_height = 106;
		break;			
	case 128:
		$line_height = 170;
		break;		
	default:
		$line_height = 32;
		break;
}

$text_icon_color = !empty($text_icon_color) ? ('color:'.$text_icon_color.';') : '';

if ( $type == 'icon' ) {
	if(!empty( $icon )) {
    $icon = (strpos($icon, 'mk-') !== FALSE) ? ( $icon ) : ( 'mk-'.$icon);
	} else {
	    $icon = '';
	}
	if( $style == 'classic'){
		$output_icon .= '<i style="font-size:'.$icon_size.'px;line-height:'.$line_height.'px;'.$text_icon_color.'" class="'.$icon.'"></i>';
	}else{
		$output_icon .= '<i style="font-size:'.$icon_size.'px;line-height:'.$line_height.'px;'.$text_icon_color.'" class="'.$icon.'"></i>';
	}
} else if ( $type == 'text' ){
	$output_icon .= '<div style="font-size:'.$text_size.'px;'.$text_icon_color.'" class="milestone-text">'.$text.'</div>';
}

$output .= '<div class="mk-milestone '.$style.'-style '.$el_class.'" >';


if($style == 'classic'){
	$output .= '<div style="color:'.$color.';font-size:'.$number_size.'px; line-height:'.$number_size.'px;border-bottom: 2px solid '.$border_bottom.';" class="milestone-number content-'.$type.'" data-speed="'.$speed.'" data-stop="'.$stop.'">'.$start.'</div><div class="clearboth"></div>';
	$output .= $output_icon;
}else{
	$output .= $output_icon;
	$output .= '<div style="color:'.$color.';font-size:'.$number_size.'px; line-height:'.$number_size.'px" class="milestone-number content-'.$type.'" data-speed="'.$speed.'" data-stop="'.$stop.'">'.$start.'</div><div class="clearboth"></div>';
	$output .= '<span style="font-size:'.$number_suffix_text_size.'px;'.$text_icon_color.'">'.$text_suffix.'</span>';

}

$output .= '</div>';

echo $output;
