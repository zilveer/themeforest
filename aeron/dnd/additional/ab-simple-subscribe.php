<?php 


/**
	ab-simple-subscribe plugin support
**/
if( in_array('ab-simple-subscribe/ab-simple-subscribe.php', get_option('active_plugins')) ){ //first check if plugin is installed
	$ABdevDND_shortcodes['ABss_subscribe_form'] = array(
		'third_party' => 1, 
		'attributes' => array(
			'inline_form' => array(
				'description' => __('Inline Form', 'dnd-shortcodes'),
				'type' => 'checkbox',
				'default' => '0'
			),
			'no_name' => array(
				'description' => __('No Name Field', 'dnd-shortcodes'),
				'type' => 'checkbox',
				'default' => '0'
			),
			'no_button' => array(
				'description' => __('No Button', 'dnd-shortcodes'),
				'type' => 'checkbox',
				'default' => '0'
			),
			'use_labels' => array(
				'description' => __('Use Labels', 'dnd-shortcodes'),
				'type' => 'checkbox',
				'default' => '0'
			),
			'name_placeholder' => array(
				'description' => __('Name Field Placeholder Text', 'dnd-shortcodes'),
				'default' => __('Your Name', 'ABss'),
			),
			'email_placeholder' => array(
				'description' => __('Email Field Placeholder Text', 'dnd-shortcodes'),
				'default' => __('Your Email', 'ABss'),
			),
			'button_text' => array(
				'description' => __('Button Text', 'dnd-shortcodes'),
				'default' => __('Subscribe', 'ABss'),
			),
			'class' => array(
				'description' => __('Class for Custom Styling', 'dnd-shortcodes'),
			),
		),
		'description' => __('AB Simple Subscribe Form', 'dnd-shortcodes'),
	);
}
