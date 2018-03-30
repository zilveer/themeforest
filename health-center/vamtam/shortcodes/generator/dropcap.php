<?php
return array(
	'name' => __('Drop Cap', 'health-center') ,
	'value' => 'dropcap',
	'options' => array(
		array(
			'name' => __('Type', 'health-center') ,
			'id' => 'type',
			'default' => '1',
			'type' => 'select',
			'options' => array(
				'1' => __('Type 1', 'health-center'),
				'2' => __('Type 2', 'health-center'),
			),
		) ,
		array(
			'name' => __('Text', 'health-center') ,
			'id' => 'text',
			'default' => '',
			'type' => 'text',
		) ,
	) ,
);
