<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'block' => array(
		'label'         => esc_html__( 'Blocks', 'idylle' ),
		'type'          => 'addable-popup',
		'template' => '{{= subtitle }}',
		'popup-options' => array(
			'first_title'         => array(
				'label' => esc_html__( 'First Title', 'idylle' ),
				'type'  => 'text',
			),
			'second_title'         => array(
				'label' => esc_html__( 'Second Title', 'idylle' ),
				'type'  => 'text',
			),
			'subtitle'         => array(
				'label' => esc_html__( 'Subtitle', 'idylle' ),
				'type'  => 'text',
			),
			'image' => array(
				'label' => esc_html__( 'Image', 'idylle' ),
				'type'  => 'upload'
			)
		)
	)
	
);
