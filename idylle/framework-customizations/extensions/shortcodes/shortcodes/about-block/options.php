<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

	'text' => array(
		'type'   => 'wp-editor',
		'reinit' => true,
		'label'  => esc_html__( 'Content', 'idylle' ),
		'desc'   => esc_html__( 'Enter some content for this texblock', 'idylle' )
	),
	'rsvp_txt'         => array(
		'label' => esc_html__( 'RSVP Text', 'idylle' ),
		'type'  => 'text',
		'desc'  => __('Description', 'idylle'),
	),
	'rsvp_link'         => array(
		'label' => esc_html__( 'RSVP Link', 'idylle' ),
		'type'  => 'text',
	),
	'left_block' => array(
		'label'         => esc_html__( 'Left Block', 'idylle' ),
		'type'          => 'popup',
		'popup-options' => array(
			'first_title'         => array(
				'label' => esc_html__( 'Name', 'idylle' ),
				'type'  => 'text',
			),
			'second_title'         => array(
				'label' => esc_html__( 'Second Name', 'idylle' ),
				'type'  => 'text',
			),
			'image' => array(
				'label' => esc_html__( 'Image', 'idylle' ),
				'type'  => 'upload'
			),
			'signature' => array(
				'label' => esc_html__( 'Signature', 'idylle' ),
				'type'  => 'upload'
			),
			'slider_type' => array(
				'label' => esc_html__( 'Slider Switch', 'idylle' ),
				'type'  => 'switch'
			),
			'slider' => array(
				'label'         => esc_html__( 'Slider', 'idylle' ),
				'type'          => 'addable-popup',
				'template' => 'Image',
				'popup-options' => array(
					'image' => array(
						'label' => esc_html__( 'Image', 'idylle' ),
						'type'  => 'upload'
					)
				)
			)
		)
	),
	'right_block' => array(
		'label'         => esc_html__( 'Right Block', 'idylle' ),
		'type'          => 'popup',
		'popup-options' => array(
			'first_title'         => array(
				'label' => esc_html__( 'Name', 'idylle' ),
				'type'  => 'text',
			),
			'second_title'         => array(
				'label' => esc_html__( 'Second Name', 'idylle' ),
				'type'  => 'text',
			),
			'image' => array(
				'label' => esc_html__( 'Image', 'idylle' ),
				'type'  => 'upload'
			),
			'signature' => array(
				'label' => esc_html__( 'Signature', 'idylle' ),
				'type'  => 'upload'
			),
			'slider_type' => array(
				'label' => esc_html__( 'Slider Switch', 'idylle' ),
				'type'  => 'switch'
			),
			'slider' => array(
				'label'         => esc_html__( 'Slider', 'idylle' ),
				'type'          => 'addable-popup',
				'template' => 'Image',
				'popup-options' => array(
					'image' => array(
						'label' => esc_html__( 'Image', 'idylle' ),
						'type'  => 'upload'
					)
				)
			)
		)
	)
	
	
);
