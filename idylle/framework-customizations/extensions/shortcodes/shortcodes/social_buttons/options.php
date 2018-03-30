<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'social' => array(
		'label'         => esc_html__( 'Gifts', 'idylle' ),
		'popup-title'   => esc_html__( 'Add/Edit Partner', 'idylle' ),
		'type'          => 'addable-popup',
		'template'      => '{{=name}}',
		'popup-options' => array(
			'name'   => array(
				'label' => esc_html__( 'Name', 'idylle' ),
				'type'  => 'text'
			),
			'link'   => array(
				'label' => esc_html__( 'Link', 'idylle' ),
				'type'  => 'text'
			),
			'image' => array(
				'label' => esc_html__( 'Icon', 'idylle' ),
				'type'  => 'icon'
			)
		)
	),
);