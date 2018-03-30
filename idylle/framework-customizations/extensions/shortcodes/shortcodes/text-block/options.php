<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'title' => array(
		'type'   => 'text',
		'label'  => esc_html__( 'Title', 'idylle' ),
	),
	'text' => array(
		'type'   => 'wp-editor',
		'reinit' => true,
		'label'  => esc_html__( 'Content', 'idylle' ),
		'desc'   => esc_html__( 'Enter some content for this texblock', 'idylle' )
	),
	
);
