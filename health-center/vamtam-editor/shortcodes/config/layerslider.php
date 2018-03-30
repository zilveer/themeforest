<?php
return array(
	'name' => __('LayerSlider', 'health-center') ,
	'desc' => __('Please note that the theme uses LayerSlider and its option panel is found in the WordPress navigation menu on the left. This element insert already created slider into the page/post body.
	If you need to activate the slider in the Header, then you will need the option - "Page Slider" found below the editor. ' , 'health-center'),
	'icon' => array(
		'char' => WPV_Editor::get_icon('images'),
		'size' => '30px',
		'lheight' => '45px',
		'family' => 'vamtam-editor-icomoon',

	),
	'value' => 'layerslider',
	'controls' => 'size name clone edit delete',
	'options' => array(
		array(
			'name' => __('Slider', 'health-center') ,
			'id' => 'id',
			'default' => '',
			'options' => WpvTemplates::get_layer_sliders(''),
			'type' => 'select',
		) ,
	) ,
);