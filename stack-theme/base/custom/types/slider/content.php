<?php

$config = array(
	'title' 	=> __('Slider Options', 'theme_admin'),
	'group_id' 	=> 'info',
	'context'	=> 'normal',
	'priority' 	=> 'high',
	'types' 	=> array( 'slider' )
);

$slide_list_template[] = array(
	'id' => 'slide_stack',
	'type' => 'stack_template',
	'title' => __('Slide', 'theme_admin'),
	'description' => __('', 'theme_admin'),
	'options' => array(
		array(
			'type' 			=> 'text',
			'id' 			=> 'stack_title',
			'title' 		=> __('Title', 'theme_admin'),
			'description' 	=> __('', 'theme_admin'),
			'default' 		=> ''
		),
		array(
			'type' 			=> 'image',
			'id' 			=> 'image',
			'title' 		=> __('Image', 'theme_admin'),
			'description' 	=> __('minimum width 940px (boxed)<br />minimum width 1200px (fullwidth)<br /><br />minimum height = slider\'s height + 150px (for parallax effect)<br /><br />* use 2x size to support retina display', 'theme_admin'),
			'default' 		=> ''
		),
		array(
			'type' 			=> 'radio',
			'id' 			=> 'desc_box_position',
			'title' 		=> __('Description Box Position', 'theme_admin'),
			'description' 	=> '',
			'default' 		=> 'left',
			'options' 		=> array(
				'left' 	=> 'Left',
				'right'	=> 'Right',
				'center'	=> 'Center'
			)
		),
		array(
			'type' 			=> 'textarea',
			'id' 			=> 'short_desc_text',
			'row'			=> 4,
			'title' 		=> __('Short Description', 'theme_admin'),
			'description' 	=> __('', 'theme_admin'),
			'default' 		=> ''
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'button_text',
			'title' 		=> __('Button Text', 'theme_admin'),
			'description' 	=> 'eg. Learn More',
		),
		array(
			'type' 			=> 'text',
			'id'			=> 'button_url',
			'title' 		=> __('Button Link', 'theme_admin'),
			'description' 	=> 'eg. http://facebook.com/wegrass/',
		),
	)
);

$options = array(
	
	array(
		'type' => 'on_off',
		'id' => 'full_width',
		'title' => __('Fullwidth', 'theme_admin'),
		'description' => __('toggle between boxed & full-width layout', 'theme_admin'),
		'default' => 'off'
	),
	array(
		'type' 			=> 'range',
		'id'			=> 'height',
		'title' 		=> __('Height', 'theme_admin'),
		'description' 	=> __('slider\'s height', 'theme_admin'),
		'default' 		=> '300',
		'min' 			=> '200',
		'max' 			=> '1000',
		'step' 			=> '10',
		'unit'			=> 'px',
	),
	
	array(
		'type' => 'radio',
		'id' => 'transition',
		'title' => __('Transition', 'theme_admin'),
		'description' => '',
		'default' => 'fade',
		'options' => array(
			'fade' => 'Fade',
			'slide'	=> 'Slide'
		)
	),
	array(
		'type' 			=> 'range',
		'id'			=> 'transition_duration',
		'title' 		=> __('Transition Duration', 'theme_admin'),
		'description' 	=> __('', 'theme_admin'),
		'default' 		=> '500',
		'min' 			=> '100',
		'max' 			=> '1000',
		'step' 			=> '100',
		'unit'			=> 'ms',
	),
	
	array(
		'type' => 'on_off',
		'id' => 'autoplay',
		'toggle' => 'toggle-autoplay',
		'title' => __('Autoplay', 'theme_admin'),
		'description' => __('playing the slideshow on load', 'theme_admin'),
		'default' => 'off'
	),
	array(
		'type' 			=> 'range',
		'id'			=> 'interval',
		'toggle_group'	=> 'toggle-autoplay toggle-autoplay-on',
		'title' 		=> __('Interval', 'theme_admin'),
		'description' 	=> __('time spent on each slide', 'theme_admin'),
		'default' 		=> '5000',
		'min' 			=> '1000',
		'max' 			=> '10000',
		'step' 			=> '500',
		'unit'			=> 'ms',
	),

	
	
	array(
		'type' 			=> 'stack',
		'id' 			=> 'slide_list',
		'title' 		=> __('Slide', 'theme_admin'),
		'description' 	=> __('slide item', 'theme_admin'),
		'templates'		=> $slide_list_template,
		'stack_button'	=> __('Add', 'theme_admin')
	),
);
new metaboxes_tool($config, $options);

?>