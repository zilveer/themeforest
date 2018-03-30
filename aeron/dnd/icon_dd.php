<?php

/*********** Shortcode: Icon ************************************************************/

$ABdevDND_shortcodes['icon_dd'] = array(
	'hide_in_dnd' => true,
	'attributes' => array(
		'name' => array(
			'default' => 'star',
			'description' => __('Icon Name', 'dnd-shortcodes'),
		),
		'size' => array(
			'default' => '16px',
			'description' => __('Icon Size', 'dnd-shortcodes'),
		),
		'color' => array(
			'type' => 'color',
			'default' => '#ddd',
			'description' => __('Icon Color', 'dnd-shortcodes'),
		),
		'rotate' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Rotate Icon', 'dnd-shortcodes'),
		),
		'box' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => __('Icon Box', 'dnd-shortcodes'),
		),
		'padding' => array(
			'default' => '5px',
			'description' => __('Icon Box Padding', 'dnd-shortcodes'),
		),
		'background' => array(
			'type' => 'color',
			'default' => '#cee6e6',
			'description' => __('Icon Box Background Color', 'dnd-shortcodes'),
		),
		'class' => array(
			'description' => __('Class', 'dnd-shortcodes'),
			'info' => __('Additional custom classes for custom styling', 'dnd-shortcodes'),
		),
	),
	'description' => __('Icon', 'dnd-shortcodes' )
);
function ABdevDND_icon_dd_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(ABdevDND_extract_attributes('icon_dd'), $attributes));
	$rotate_output = ($rotate==1) ? ' ABdev_icon_spin' : '';
	
	$icon_style_output='';
	if($color!='' || $size!=''){
		$color_output = ($color!='') ? "color:$color;" : '';
		$size_output = ($size!='') ? "line-height:$size;font-size:$size;" : '';
		$icon_style_output=' style="'.$color_output.$size_output.'"';
	}
	$box_style_output = $box_style_output_before = $box_style_output_after = '';
	if(($padding!='' || $background!='') && $box=='1'){
		$padding_output = ($padding!='') ? "padding:$padding;" : '';
		$background_output = ($background!='') ? "background:$background;" : '';
		$box_style_output_before='<span style="'.$padding_output.$background_output.' display:inline-block;" class="'.$class.'">';
		$box_style_output_after='</span>';
	}
	return $box_style_output_before.'<i class="'.$name.$rotate_output.'"'.$icon_style_output.'></i>'.$box_style_output_after;
}

