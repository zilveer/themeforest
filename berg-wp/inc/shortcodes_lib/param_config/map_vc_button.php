<?php
/**
 * vc_cta_button shortcode params config
 * add, remove or change some params
 */

$settings = array(
	'deprecated' => null,
	'name' => __( 'Button', 'BERG' ),
);

vc_map_update('vc_button', $settings);

vc_remove_param("vc_button", "color");
vc_add_param("vc_button", array(
	'type' => 'dropdown',
	'heading' => __( 'Color', 'BERG'),
	'param_name' => 'color',
	'value' => array('Dark outline'=>'btn-dark-o', 'Light outline'=>'btn-light-o', 'Highlight outline'=>'btn-color-o', 'Dark background'=>'btn-dark', 'Light background'=>'btn-light', 'Highlight background'=>'btn-color'),
	'description' => __( 'Button color.', 'BERG'),
	'param_holder_class' => 'vc_colored-dropdown',
));

vc_remove_param("vc_button", "size");
vc_add_param("vc_button", array(
	'type' => 'dropdown',
	'heading' => __( 'Size', 'BERG'),
	'param_name' => 'size',
	'value' => array('Regular size'=>'btn-md', 'Large'=>'btn-lg', 'Small'=>'btn-sm', 'Mini'=>'btn-xs'),
	'description' => __( 'Button size.', 'BERG')
));
vc_remove_param("vc_button", "icon");


?>