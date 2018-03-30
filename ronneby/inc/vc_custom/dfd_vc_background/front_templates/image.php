<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$class = $data_atts = $css_rules = '';

$uniqid = uniqid('dfd-image-bg-');

$simple_styles = array(
	'dfd_simple_image',
	'dfd_animated_bg',
	'dfd_horizontal_parallax',
	'dfd_vertical_parallax'
);

$parallax_styles = array(
	'dfd_animated_bg',
	'dfd_vertical_parallax',
	'dfd_horizontal_parallax',
	'dfd_mousemove_parallax',
	'dfd_multi_parallax'
);

if(!isset($dfd_parallax_style) || empty($dfd_parallax_style)) return;

$class .= $dfd_parallax_style;

if($dfd_parallax_style == 'dfd_vertical_parallax') {
	$data_atts .= ' data-parallax_offset="'.esc_attr($dfd_parallax_offset).'"';
}

if($dfd_image_bg_color != '') {
	$css_rules .= 'background-color: '.esc_attr($dfd_image_bg_color).';';
}

if($dfd_parallax_style == 'dfd_simple_image') {
	$css_rules .= 'background-position: '.esc_attr($dfd_bg_image_position).';';
}

if($dfd_parallax_style == 'dfd_animated_bg') {
	$dfd_animation_direction = (isset($dfd_animation_direction) && !empty($dfd_animation_direction)) ? $dfd_animation_direction : 'left';
	$class .= ' dfd-'.esc_attr($dfd_animation_direction).'-animation';
	$data_atts .= ' data-direction="'.esc_attr($dfd_animation_direction).'"';
}

if(in_array($dfd_parallax_style, $simple_styles)) {
	if(isset($dfd_bg_image_new) && !empty($dfd_bg_image_new)) {
		$bg_image_src = wp_get_attachment_image_src($dfd_bg_image_new, 'full');
		$bg_image = $bg_image_src[0];
		$css_rules .= 'background-image: url('.esc_url($bg_image).');';
	}

	if(isset($dfd_bg_image_repeat) && !empty($dfd_bg_image_repeat) && $dfd_parallax_style != 'dfd_animated_bg')
		$css_rules .= 'background-repeat: '.esc_attr($dfd_bg_image_repeat).';';

	if(isset($dfd_bg_image_size) && !empty($dfd_bg_image_size))
		$css_rules .= 'background-size: '.esc_attr($dfd_bg_image_size).';';

	if(isset($dfd_bg_img_attach) && !empty($dfd_bg_img_attach))
		$css_rules .= 'background-attachment: '.esc_attr($dfd_bg_img_attach).';';
}

if(!empty($css_rules))
	$css_rules = '#'.esc_attr($uniqid).' {'.$css_rules.'}';

if(in_array($dfd_parallax_style, $parallax_styles)) {
	if(isset($dfd_parallax_sense) && !empty($dfd_parallax_sense))
		$data_atts .= ' data-parallax_sense="'.esc_attr($dfd_parallax_sense).'"';
	else 
		$data_atts .= ' data-parallax_sense="30"';
}

if(isset($dfd_mobile_enable) && $dfd_mobile_enable == 'yes') {
	$data_atts .= ' data-mobile_enable="1"';
} else {
	$data_atts .= ' data-mobile_enable="0"';
}

$output .= '<div class="dfd-row-bg-wrap dfd-row-bg-image '.esc_attr($class).'" id="'.esc_attr($uniqid).'" '.$data_atts.'>';

if(($dfd_parallax_style == 'dfd_mousemove_parallax' || $dfd_parallax_style == 'dfd_multi_parallax') && isset($dfd_layer_image) && !empty($dfd_layer_image)) {
	$image_ids = explode(',', $dfd_layer_image);
	$i = 0;
	
	foreach($image_ids as $id) {
		$i++;
		$image_src = wp_get_attachment_image_src($id, 'full');
		
		if(isset($image_src[0]) && !empty($image_src[0])) {
			if($dfd_parallax_style == 'dfd_mousemove_parallax') {
				wp_enqueue_script('dfd-jparallax');
				$output .= '<img src="'.esc_url($image_src[0]).'" alt="'.esc_attr__('Interactive parallax image','dfd').'" class="dfd-interactive-parallax-item" />';
			} else {
				$data_atts .= (isset($dfd_multi_parallax_direction) && !empty($dfd_multi_parallax_direction)) ? ' data-direction-multi="'.$dfd_multi_parallax_direction.'"' : ' data-direction-multi="vertical"';
				$css_rules .= '#'.esc_attr($uniqid).' .dfd-multi-parallax-layer-'.esc_attr($i).' {background-image: url('.esc_url($image_src[0]).');background-size: initial;background-repeat:no-repeat;}';
				$output .= '<div class="dfd-multi-parallax-layer dfd-multi-parallax-layer-'.esc_attr($i).'" '.$data_atts.'></div>';
			}
		}
	}
}

$output .= '</div>';

if(!empty($css_rules)) {
	$output .= '<script type="text/javascript">
					(function($) {
						$("head").append("<style>'.esc_js($css_rules).'</style>");
					})(jQuery);
				</script>';
}