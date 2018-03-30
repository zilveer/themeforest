<?php

function met_su_ROW_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_row'] = array(
		'name' => __( 'Row', 'su' ),
		'type' => 'wrap',
		'group' => 'box',
		'atts' => array(
			'class' => array(
				'default' => '',
				'name' => __( 'Class', 'su' ),
				'desc' => __( 'Extra CSS class', 'su' )
			)
		),
		'content' => __( "[%prefix_met_column size=\"4\"]Content[/%prefix_met_column]\n[%prefix_met_column size=\"4\"]Content[/%prefix_met_column]\n[%prefix_met_column size=\"4\"]Content[/%prefix_met_column]", 'su' ),
		'desc' => __( 'Row for flexible columns', 'su' ),
		'icon' => 'columns',
		'function' => 'met_su_row_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_ROW_shortcode_data' );


function met_su_row_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array( 'class' => '' ), $atts );
	return '<div class="row-fluid' . su_ecssc( $atts ) . '">' . su_do_shortcode( $content, 'r' ) . '</div>';
}