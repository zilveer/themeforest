<?php
extract(shortcode_atts(array(
	'type' => 'square',
	'icon' => '',
	'color' => '',
	'title' => '',
	'link' => '',
), $atts));

$is_old_icon = false;
$old_icon = '';
if(strlen($icon) && !preg_match('#^[A-Za-z-_]+$#',$icon)){
	$is_old_icon = true;
	$old_icon = $icon;
	$icon = 'oldicon';
}
if($link){
	$str = '<a href="'.esc_attr($link).'" class="dtbaker_icon dtbaker_icon_'.esc_attr($type).'">';
}else{
	$str = '<div class="dtbaker_icon dtbaker_icon_'.esc_attr($type).'">';
}
if($type == 'square'){
	$str .= '<div class="square_wrap">';
	$str .= '<span class="fa fa-'.esc_attr($icon).'" style="color:'.esc_attr($color).'">'.$old_icon.'</span>';
	$str .= '</div>';
	if($innercontent || $title) {
		$str .= '<div class="icon_text">';
		if ( $title ) {
			$str .= '<div class="icon_title" style="color:' . esc_attr( $color ) . '">' . esc_attr( $title ) . '</div>';
		}
		$str .= do_shortcode( $innercontent );
		$str .= '</div>';
	}
}else if($type == 'horizontal'){
	$str .= '<div class="icon_bg" style="background-color:'.esc_attr($color).'">';
	$str .= '<span class="fa fa-'.esc_attr($icon).'">'.$old_icon.'</span>';
	$str .= '</div>';
	$str .= '<div class="icon_text">';
	if($title) {
		$str .= '<div class="icon_title">' . esc_attr($title) . '</div>';
	}
	$str .= do_shortcode($innercontent);
	$str .= '</div>';
}else{
	$str .= '<span class="fa fa-'.esc_attr($icon).'" style="color:'.esc_attr($color).'">'.$old_icon.'</span>';
	if($title) {
		$str .= '<div class="icon_title" style="color:'.esc_attr($color).'">' . esc_attr($title) . '</div>';
	}
	$str .= '<div class="icon_text">';
	$str .= do_shortcode($innercontent);
	$str .= '</div>';
}
if($link){
	$str .= '</a>';
}else{
	$str .= '</div>';
}