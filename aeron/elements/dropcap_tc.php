<?php

/*********** Shortcode: Dropcap Letter ************************************************************/

$tcvpb_elements['dropcap_tc'] = array(
	'name' => esc_html__('Dropcap Letter', 'ABdev_aeron' ),
	'type' => 'inline',
	'attributes' => array(
		'letter' => array(
			'description' => esc_html__('Dropcap letter', 'ABdev_aeron'),
		),
		'color' => array(
			'description' => esc_html__('Letter Color', 'ABdev_aeron'),
			'type' => 'color',
		),
		'background' => array(
			'description' => esc_html__('Background Color', 'ABdev_aeron'),
			'type' => 'coloralpha',
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
function tcvpb_dropcap_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('dropcap_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$color = ($color!='') ? 'color: '.$color.';' : '';
	$background = ($background!='') ? 'background:'.$background.';' : '';

	return '<span '.esc_attr($id_out).' class="tcvpb_dropcap '.esc_attr($class).'" style="'.esc_attr($color.$background).'">'.esc_attr($letter).'</span>';
}
