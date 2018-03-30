<?php

function met_su_COLUMN_shortcode_data( $shortcodes ) {
	// Add new shortcode
	$shortcodes['met_column'] = array(
		'name' => __( 'Column', 'su' ),
		'type' => 'wrap',
		'group' => 'box',
		'atts' => array(
			'size' => array(
				'type' => 'select',
				'values' => array(
					'1' => __( 'One', 'su' ),
					'2' => __( 'Two', 'su' ),
					'3' => __( 'Three', 'su' ),
					'4' => __( 'Four', 'su' ),
					'5' => __( 'Five', 'su' ),
					'6' => __( 'Six (HALF)', 'su' ),
					'7' => __( 'Seven', 'su' ),
					'8' => __( 'Eight', 'su' ),
					'9' => __( 'Nine', 'su' ),
					'10' => __( 'Ten', 'su' ),
					'11' => __( 'Eleven', 'su' ),
					'12' => __( 'Twelve (FULL)', 'su' )
				),
				'default' => '3',
				'name' => __( 'Size', 'su' ),
				'desc' => __( 'Select column width. This width will be calculated depend page width. Total column width will be 12 on one row', 'su' )
			),
			'center' => array(
				'type' => 'bool',
				'default' => 'no',
				'name' => __( 'Centered', 'su' ),
				'desc' => __( 'Is this column centered on the page', 'su' )
			),
			'class' => array(
				'default' => '',
				'name' => __( 'Class', 'su' ),
				'desc' => __( 'Extra CSS class', 'su' )
			)
		),
		'content' => __( 'Column content', 'su' ),
		'desc' => __( 'Flexible and responsive columns', 'su' ),
		'note' => __( 'Did you know that you need to wrap columns with [row] shortcode?', 'su' ),
		'example' => 'columns',
		'icon' => 'columns',
		'function' => 'met_su_column_shortcode'
	);
	// Return modified data
	return $shortcodes;
}add_filter( 'su/data/shortcodes', 'met_su_COLUMN_shortcode_data' );


function met_su_column_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array( 'class' => '', 'size' => '12' ), $atts );
	return '<div class="span'.$atts['size'].'' . su_ecssc( $atts ) . '">' . su_do_shortcode( $content, 'r' ) . '</div>';
}