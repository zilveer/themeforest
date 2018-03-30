<?php

/*********** Shortcode: Icon ************************************************************/

$tcvpb_elements['icon_tc'] = array(
	'name' => esc_html__('Icon', 'ABdev_aeron' ),
	'type' => 'inline',
	'attributes' => array(
		'name' => array(
			'type' => 'icon',
			'description' => esc_html__('Icon', 'ABdev_aeron'),
		),
		'size' => array(
			'default' => '16px',
			'description' => esc_html__('Icon Size', 'ABdev_aeron'),
		),
		'color' => array(
			'type' => 'color',
			'description' => esc_html__('Icon Color', 'ABdev_aeron'),
		),
		'rotate' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Rotate Icon', 'ABdev_aeron'),
		),
		'box' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Icon Box', 'ABdev_aeron'),
		),
		'padding' => array(
			'default' => '5px',
			'description' => esc_html__('Icon Box Padding', 'ABdev_aeron'),
		),
		'background' => array(
			'type' => 'coloralpha',
			'description' => esc_html__('Icon Box Background Color', 'ABdev_aeron'),
		),
		'id' => array(
			'description' => esc_html__('ID', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom ID', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),	
		'class' => array(
			'description' => esc_html__('Class', 'ABdev_aeron'),
			'info' => esc_html__('Additional custom classes for custom styling', 'ABdev_aeron'),
			'tab' => esc_html__('Advanced', 'ABdev_aeron'),
		),
	),
);
function tcvpb_icon_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('icon_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	
	$rotate_output = ($rotate==1) ? ' ABdev_icon_spin' : '';
	
	$icon_style_output='';
	if($color!='' || $size!=''){
		$color_output = ($color!='') ? "color:$color;" : '';
		$size_output = ($size!='') ? "line-height:$size;font-size:$size;" : '';
		$icon_style_output=' style="'.esc_attr($color_output).esc_attr($size_output).'"';
	}
	$box_style_output = $box_style_output_before = $box_style_output_after = '';
	if(($padding!='' || $background!='') && $box=='1'){
		$padding_output = ($padding!='') ? "padding:$padding;" : '';
		$background_output = ($background!='') ? "background:$background;" : '';
		$box_style_output_before='<span style="'.esc_attr($padding_output).esc_attr($background_output).' display:inline-block;" class="'.esc_attr($class).'">';
		$box_style_output_after='</span>';
	}
	return $box_style_output_before.'<i '.esc_attr($id_out).' class="'.esc_attr($name).esc_attr($rotate_output).'"'.$icon_style_output.'></i>'.$box_style_output_after;
}

