<?php

function met_su_BUTTON_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_button'] = array(
		'name' => __( 'Button', 'su' ),
		'type' => 'wrap',
		'group' => 'met',
		'atts' => array(
			'type' => array(
				'type' => 'select',
				'values' => array('primary'=>'Primary','info'=>'Info','success'=>'Success','warning'=>'Warning','danger'=>'Error'),
				'default' => 'primary',
				'name' => __( 'Type', 'su' ),
			),
			'size' => array(
				'type' => 'select',
				'values' => array('normal' => 'Normal','large' => 'Large', 'small' => 'Small', 'mini' => 'Mini'),
				'default' => 'normal',
				'name' => __( 'Size', 'su' ),
			),
			'url' => array(
				'name' => 'URL',
				'default' => '#'
			)
		),
		'content' => 'Button Text',
		'desc' => '',
		'icon' => 'star',
		'function' => 'met_su_button_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_BUTTON_shortcode_data' );


function met_su_button_shortcode( $atts, $content = null ) {
	extract($atts);

	$output = '<a href="'.$url.'" class="btn btn-'.$size.' btn-'.$type.'">'.$content.'</a>';

	return $output;
}