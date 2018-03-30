<?php

/********** Shortcode: Abbreviation *************************************************************/

$tcvpb_elements['abbr_dd'] = array(
	'name' => esc_html__('Abbreviation', 'ABdev_aeron' ),
	'type' => 'inline',
	'attributes' => array(
		'fullword' => array(
			'info' => esc_html__('e.g. Abbreviation', 'ABdev_aeron'),
			'description' => esc_html__('Full Word', 'ABdev_aeron'),
		),
		'abbr' => array(
			'info' => esc_html__('e.g. abbr', 'ABdev_aeron'),
			'description' => esc_html__('Abbreviation', 'ABdev_aeron'),
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
	)
);
function tcvpb_abbr_tc_shortcode ( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('abbr_dd'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	return '<abbr '.esc_attr($id_out).' class="tcvpb-abbr tcvpb_tooltip '.esc_attr($class).'" data-gravity="s" title="' . esc_attr( $fullword ) . '">' . $abbr . '</abbr>';
}
