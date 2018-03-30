<?php
$output = '';
extract(shortcode_atts(array(
	'title'				=>'',
	'fx'				=>'scroll',	
	'visible'			=>'1',
	'scroll_item'		=>'1',
	'scroll_speed'		=>'',
	'easing'			=>'',
	'no_padding'		=>'',
	'auto_play'			=>'',
	'hide_pagination'	=>'',
	'hide_control'		=>'',
	'visibility'		=>'',
	'el_class'			=>'',
), $atts));
global $dh_carousel_visible;
$dh_carousel_visible = $visible;
$el_class  = !empty($el_class) ? ' '.esc_attr( $el_class ) : '';
$el_class .= dh_visibility_class($visibility);
/**
 * script
 * {{
 */
wp_enqueue_script('vendor-carouFredSel');
$output .='<div class="caroufredsel'.(!empty($no_padding) ? ' caroufredsel-item-no-padding':'').$el_class.'" data-scroll-fx="'.$fx.'" data-speed="'.$scroll_speed.'" data-easing="'.$easing.'" data-scroll-item="'.$scroll_item.'" data-visible-min="1" data-visible-max="'.$visible.'" data-responsive="1" data-infinite="1" data-autoplay="'.(!empty($auto_play)?'1':'0').'">';
$output .= !empty($title) ? '<h3 class="el-heading">'.$title.'</h3>':'';
$output .='<div class="caroufredsel-wrap">';
$output .='<ul class="caroufredsel-items row">';
$output .= wpb_js_remove_wpautop( $content );
$output .='</ul>';
if(empty($hide_control)){
	$output .='<a href="#" class="caroufredsel-prev"></a>';
	$output .='<a href="#" class="caroufredsel-next"></a>';
}
$output .='</div>';
if(empty($hide_pagination)){
	$output .='<div class="caroufredsel-pagination">';
	$output .='</div>';
}
$output .='</div>';
echo $output;
