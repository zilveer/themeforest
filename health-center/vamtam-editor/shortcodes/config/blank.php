<?php
return array(
	'name' => __('Blank Space', 'health-center') ,
	'desc' => __('You can increase or decrease the space between elements using this shortcode.' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('page-break'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',
	),
	'value' => 'blank',
	'controls' => 'name clone edit delete',
	'class' => 'slim',
	'options' => array(
		array(
			'name' => __('Height (px)', 'health-center') ,
			'desc' => __('You can increase or decrease the space between elements using this option. Please note that using negative number - decreasing space will not work for all elements and situations ', 'health-center'),
			'id' => 'h',
			'default' => 30,
			'min' => -500,
			'max' => 500,
			'type' => 'range',
		) ,
	) ,
);