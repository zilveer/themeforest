<?php

vc_remove_param("vc_cta_button", "icon");

vc_remove_param("vc_cta_button", "color");
vc_add_param("vc_cta_button", array(
	'type' => 'dropdown',
	'heading' => __( 'Color', 'BERG'),
	'param_name' => 'color',
	'value' => array('Outline 1'=>'btn-default', 'Outline 2'=>'btn-white', 'Highlight color'=>'btn-color', 'Background color'=>'btn-dark'),
	'description' => __( 'Button color.', 'BERG'),
	'param_holder_class' => 'vc_colored-dropdown'
));

vc_remove_param("vc_cta_button", "size");
vc_add_param("vc_cta_button", array(
	'type' => 'dropdown',
	'heading' => __( 'Size', 'BERG'),
	'param_name' => 'size',
	'value' => array('Regular size'=>'', 'Large'=>'btn-lg', 'Small'=>'btn-sm', 'Mini'=>'btn-xs'),
	'description' => __( 'Button size.', 'BERG')
));