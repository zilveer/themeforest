<?php
return array(
	'name' => __( 'Help', 'health-center' ),
	'auto' => true,
	'config' => array(

		array(
			'name' => __( 'Help', 'health-center' ),
			'type' => 'title',
			'desc' => '',
		),

		array(
			'name' => __( 'Help', 'health-center' ),
			'type' => 'start',
			'nosave' => true,
		),
//----
		array(
			'type' => 'docs',
		),

			array(
				'type' => 'end',
			),
	),
);