<?php
$title = __( 'Socials', 'wolf' );
$params = array(

	array(
		'id' => 'services',
		'label' => __( 'Services', 'wolf' ),
		'desc' => __( 'Leave empty to display them all.<br>* See the social networks available in the theme options.', 'wolf' ),
		'placeholder' => 'facebook,twitter',
	),

	array(
		'id' => 'type',
		'label' => __( 'Type', 'wolf' ),
		'type' => 'select',
		'options' => array(
			'normal' => __( 'Normal', 'wolf' ),
			'circle' => __( 'Circle', 'wolf' ),
			'square' => __( 'Square', 'wolf' ),
		),
	),

	array(
		'id' => 'size',
		'label' => __( 'Size', 'wolf' ),
		'type' => 'select',
		'options' => array(
			'1x' => __( 'Small', 'wolf' ),
			'2x' => __( 'Medium', 'wolf' ),
			'3x' => __( 'Large', 'wolf' ),
			'4x' => __( 'Very Large', 'wolf' ),
		),
	),
);
echo wolf_generate_tinymce_popup( 'wolf_theme_socials', $params, $title );