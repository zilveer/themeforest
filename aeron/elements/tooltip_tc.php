<?php

/*********** Shortcode: Tooltip ************************************************************/

$tcvpb_elements['tooltip_tc'] = array(
	'name' => esc_html__('Tooltip', 'ABdev_aeron' ),
	'type' => 'inline',
	'attributes' => array(
		'text' => array(
			'description' => esc_html__('Text', 'ABdev_aeron'),
		),
		'link' => array(
			'description' => esc_html__('Link', 'ABdev_aeron'),
		),
		'target' => array(
			'description' => esc_html__('Target', 'ABdev_aeron'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__('Self', 'ABdev_aeron'),
				'_blank' => esc_html__('Blank', 'ABdev_aeron'),
			),
		),
		'gravity' => array(
			'description' => esc_html__('Tooltip Gravity', 'ABdev_aeron'),
			'default' => 's',
			'type' => 'select',
			'values' => array(
				's' =>  esc_html__('South', 'ABdev_aeron'),
				'n' => esc_html__('North', 'ABdev_aeron'),
				'e' => esc_html__('East', 'ABdev_aeron'),
				'w' => esc_html__('West', 'ABdev_aeron'),
				'nw' =>  esc_html__('Northwest', 'ABdev_aeron'),
				'ne' => esc_html__('Northeast', 'ABdev_aeron'),
				'sw' => esc_html__('Southwest', 'ABdev_aeron'),
				'se' => esc_html__('Southeast', 'ABdev_aeron'),
			),
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
	'content' => array(
		'description' => esc_html__('Tooltip Content', 'ABdev_aeron'),
	)
);
function tcvpb_tooltip_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('tooltip_tc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	
	$link_output=($link!='')?' href="'.esc_url($link).'"':'';
	$target_output=($target!='')?' target="'.esc_attr($target).'"':'';

	return '<a'.$link_output.' '.esc_attr($id_out).' class="tcvpb_tooltip '.esc_attr($class).'" data-gravity="'.esc_attr($gravity).'" title="'.esc_attr($text).'"'.$target_output.'><p>'.do_shortcode($content).'</p></a>';
}
