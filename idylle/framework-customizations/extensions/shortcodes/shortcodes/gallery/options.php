<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'gallery' => array(
		'label'         => esc_html__( 'Gallery', 'idylle' ),
		'type'          => 'addable-popup',
		'template' => '{{= title }}',
		'popup-options' => array(
			'title'         => array(
				'label' => esc_html__( 'Title', 'idylle' ),
				'type'  => 'text',
			),
			'image' => array(
				'label' => esc_html__( 'Image', 'idylle' ),
				'type'  => 'upload'
			),
			'video' => array(
				'label' => esc_html__( 'Video', 'idylle' ),
				'type'  => 'text'
			)
		)
	),
	
);
