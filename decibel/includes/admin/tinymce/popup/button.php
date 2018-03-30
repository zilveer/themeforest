<?php
$button_color_array = array(
	'accent-color'  => __( 'theme color', 'wolf' ),
	'accent-color-bnw'  => __( 'theme color black/white on hover', 'wolf' ),
	'border-button'  => __( 'black/white', 'wolf' ),
	'border-button-accent-hover'  => __( 'black/white theme color on hover', 'wolf' ),
);

$button_type_array =  array(
	'square' => __( 'Square', 'wolf' ),
	'round' => __( 'Round', 'wolf' ),
);

$button_size_array =  array(
	'medium' => __( 'Medium', 'wolf' ),
	'small' => __( 'Small', 'wolf' ),
	'large' => __( 'Large', 'wolf' ),
);

global $icons;

$title = __( 'Mailchimp signup', 'wolf' );
$params = array(

	array(
		'id' => 'text',
		'label' => __( 'Text', 'wolf' ),
		'value' => __( 'Button', 'wolf' ),
	),

	array(
		'id' => 'url',
		'label' => __( 'Link', 'wolf' ),
		'placeholder' => __( 'http://', 'wolf' ),
	),

	array(
		'id' => 'tagline',
		'label' => __( 'Tagline', 'wolf' ),
	),

	array(
		'id' => 'color',
		'label' => __( 'Color', 'wolf' ),
		'type' => 'select',
		'options' => $button_color_array,
	),

	array(
		'id' => 'size',
		'label' => __( 'Size', 'wolf' ),
		'type' => 'select',
		'options' => $button_size_array,
	),

	array(
		'id' => 'type',
		'label' => __( 'Type', 'wolf' ),
		'type' => 'select',
		'options' => $button_type_array,
	),

	array(
		'id' => 'target',
		'label' => __( 'Open link in a new tab', 'wolf' ),
		'type' => 'checkbox',
		'value' => '_blank',
	),

	array(
		'id' => 'scroll_to_anchor',
		'label' => __( 'Scroll to anchor', 'wolf' ),
		'type' => 'checkbox',
		'value' => true,
	),

	array(
		'id' => 'add_button_icon',
		'label' => __( 'Add Icon', 'wolf' ),
		'type' => 'checkbox',
		'value' => 'yes',
	),

	array(
		'id' => 'icon',
		'label' => __( 'Icon', 'wolf' ),
		'type' => 'select',
		'options' => $icons,
	),

	array(
		'id' => 'icon_position',
		'label' => __( 'Icon position', 'wolf' ),
		'type' => 'select',
		'options' => array(
			'after' => __( 'after', 'wolf' ),
			'before' => __( 'before', 'wolf' ),
		),
	),
);
echo wolf_generate_tinymce_popup( 'wolf_button', $params, $title );