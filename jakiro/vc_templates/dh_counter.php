<?php
$output = '';
extract(shortcode_atts(array(
	'speed'				=>2000,
	'number'			=>'',
	'format'			=>'',
	'thousand_sep'		=>'',
	'decimal_sep'		=>'',
	'num_decimals'		=>'',
	'units'				=>'',
	'units_color'		=>'',
	'units_font_size'	=>'',
	'number_color'		=>'',
	'number_font_size'	=>'',
	'icon'				=>'',
	'icon_color'		=>'',
	'icon_font_size'	=>'',
	'icon_position'		=>'',
	'text'				=>'',
	'text_color'		=>'',	
	'text_font_size'	=>'',
	'visibility'		=>'',
	'el_class'			=>'',
), $atts));

/**
 * script
 * {{
 */
wp_enqueue_script('vendor-countTo');

$el_class  = !empty($el_class) ? ' '.esc_attr( $el_class ) : '';
$el_class .= dh_visibility_class($visibility);
$number_color = dh_format_color($number_color);
$text_color = dh_format_color($text_color);
$units_color = dh_format_color($units_color);
$number = dh_get_number($number);
$number_format = $number;
$data_format = '';
if(!empty($format)){
	$thousand_sep = wp_specialchars_decode( stripslashes($thousand_sep),ENT_QUOTES);
	$decimal_sep = wp_specialchars_decode( stripslashes($decimal_sep),ENT_QUOTES);
	$num_decimals = absint($num_decimals);
	$data_format = ' data-thousand-sep="'.esc_attr($thousand_sep).'" data-decimal-sep="'.esc_attr($decimal_sep).'" data-num-decimals="'.$num_decimals.'"';
	$number_format = number_format($number,absint($num_decimals),$decimal_sep,$thousand_sep);
}
$output .='<div class="counter counter-icon-'.$icon_position.'">';
$icon_html = '';
if(!empty($icon)){
	$icon_color = dh_format_color($icon_color);
	$icon_html .='<span class="el-appear counter-icon"  style="font-size:'.$icon_font_size.'px;'.(!empty($icon_color)?'color:'.$icon_color:'').'"><i class="'.$icon.'"></i></span>';
}
if($icon_position == 'top'){
$output .= $icon_html;
}
$output .='<div class="counter-count">'.($icon_position != 'top' ? $icon_html :'').'<span class="counter-number"'.$data_format.' data-to="'.$number.'" data-speed="'.$speed.'" style="font-size:'.$number_font_size.'px;'.(!empty($number_color)?'color:'.$number_color.'':'') .'">'.$number_format.'</span>'.(!empty($units)?'<span class="counter-unit" style="font-size:'.$units_font_size.'px;'.(!empty($units_color)?'color:'.$units_color.'':'') .'">'.esc_html($units).'</span>':'').'</div>';
$output .='<div class="counter-text" style="font-size:'.$text_font_size.'px;'.(!empty($text_color)?'color:'.$text_color.'':'') .'">'.esc_html($text).'</div>';
$output .='</div>';
echo $output;