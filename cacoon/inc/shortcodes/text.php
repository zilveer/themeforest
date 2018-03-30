<?php

function met_su_TEXT_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_text'] = array(
		'name' => __( 'Text', 'su' ),
		'type' => 'wrap',
		'group' => 'met',
		'atts' => array(
			'font_size' => array(
				'type' => 'slider',
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 14,
				'name' => __( 'Font Size', 'su' ),
			),
			'line_height' => array(
				'type' => 'slider',
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 21,
				'name' => __( 'Line Height', 'su' ),
			),
			'text_color' => array(
				'type' => 'color',
				'default' => '#65676F',
				'name' => __( 'Text Color', 'su' ),
			),
			'background' => array(
				'type' => 'color',
				'default' => '#F1F4F7',
				'name' => __( 'Background Color', 'su' ),
			),
			'padding' => array(
				'type' => 'slider',
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 30,
				'name' => __( 'Box Padding', 'su' ),
			),
		),
		'content' => '',
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_text_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_TEXT_shortcode_data' );


function met_su_text_shortcode( $atts, $content = null ) {
	extract($atts);

	if(!empty($padding) OR !isset($padding)){
		$padding = 30;
	}

	$output = '
	<div class="row-fluid">
		<div class="span12">
			<div class="met_text_block" style="font-size:'.$font_size.'px;line-height:'.$line_height.'px;background-color:'.$background.'!important;color:'.$text_color.'!important;padding: '.$padding.'px">'.do_shortcode(htmlspecialchars_decode($content)).' <div class="clearfix"></div></div>
		</div>
	</div>';

	return $output;
}