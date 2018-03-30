<?php

function met_su_PROGRESS_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_progress'] = array(
		'name' => __( 'Progress Bar', 'su' ),
		'type' => 'single',
		'group' => 'met',
		'atts' => array(
			'title' => array(
				'default' => 'My Progress',
				'name' => __( 'Title (required)', 'su' ),
			),
			'percent' => array(
				'type' => 'slider',
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 25,
				'name' => __( 'Percent', 'su' ),
			),
			'type' => array(
				'type' => 'select',
				'values' => array('info'=>'Info','success'=>'Success','warning'=>'Warning','error'=>'Error'),
				'default' => 'info',
				'name' => __( 'Type', 'su' ),
			),
		),
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_progress_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_PROGRESS_shortcode_data' );


function met_su_progress_shortcode( $atts, $content = null ) {
	extract($atts);

	$output = '';
	$output .= '<div id="met_block_progress_'. uniqid() .'" class="progress-bars">';

	$output .= '
	<div class="progress progress-' . $type . '">
		<div class="bar" style="width: ' . $percent . '%">' . $title . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	</div>';

	$output .= '</div>';

	return $output;
}