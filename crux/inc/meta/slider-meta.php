<?php

add_action('add_meta_boxes', 'stag_metabox_slider');

function stag_metabox_slider(){
	$meta_box = array(
		'id'          => 'stag-metabox-slider',
		'title'       => __( 'Slider Settings', 'stag' ),
		'description' => __( 'Customize slider settings.', 'stag' ),
		'page'        => 'slides',
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'name' => __( 'Slider Title', 'stag' ),
				'desc' => __( 'Enter the slider title of this slide.', 'stag' ),
				'id'   => '_stag_slider_title',
				'type' => 'text',
				'std'  => ''
			),
			array(
				'name' => __( 'Upload Slider Image', 'stag' ),
				'desc' => __( 'Choose image for this slider.', 'stag' ),
				'id'   => '_stag_slider_image',
				'type' => 'file',
				'std'  => ''
			),
			array(
				'name' => __( 'Slider Description', 'stag' ),
				'desc' => __( 'Enter the slider description of this slide.', 'stag' ),
				'id'   => '_stag_slider_description',
				'type' => 'textarea',
				'std'  => ''
			),
			array(
				'name' => __( 'Slider Button Text', 'stag' ),
				'desc' => __( 'Enter the slider button text of this slide&rsquo;s button.', 'stag' ),
				'id'   => '_stag_slider_button_text',
				'type' => 'text',
				'std'  => ''
			),
			array(
				'name' => __( 'Slider Button URL', 'stag' ),
				'desc' => __( 'Enter the slider button URL of this slide&rsquo;s button.', 'stag' ),
				'id'   => '_stag_slider_button_url',
				'type' => 'text',
				'std'  => ''
			),
		)
	);

	stag_add_meta_box($meta_box);
}
