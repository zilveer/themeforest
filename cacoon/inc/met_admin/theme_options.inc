<?php

$theme_options = array (
	'background' => array(
		$shortname.'_bg_image_type' => array(
			'name'		=> 'Background Type',
			'id'		=> $shortname.'_bg_image_type',
			'type'		=> 'radio',
			'value'		=> array('None','Image','Pattern','Custom Pattern'),
			'selected'	=> isset($met_options['background'][$shortname.'_bg_image_type']) ? $met_options['background'][$shortname.'_bg_image_type'] : '',
			'desc'		=> 'Please choose what do you want to use.'
		),
		$shortname.'_bg_file' => array(
			'name'		=> 'Upload Background Image',
			'id'		=> $shortname.'_bg_file',
			'type'		=> 'imagelibrary',
			'value'		=> 'Click to Choose Your Image',
			'selected'	=> isset($met_options['background'][$shortname.'_bg_file']) ? $met_options['background'][$shortname.'_bg_file'] : '',
			'desc'		=> 'Use your own image to show on the background.'
		),
		$shortname.'_bg_patterns' => array(
			'name'		=> 'Background Pattern List',
			'id'		=> $shortname.'_bg_patterns',
			'type'		=> 'radio',
			'value'		=> $bgPatterns,
			'selected'	=> isset($met_options['background'][$shortname.'_bg_patterns']) ? $met_options['background'][$shortname.'_bg_patterns'] : '',
			'desc'		=> 'Choose a background pattern for your site.',
			'subtype'	=> 'image-list'
		),
		$shortname.'_bg_pattern_file' => array(
			'name'		=> 'Custom Background Pattern',
			'id'		=> $shortname.'_bg_pattern_file',
			'type'		=> 'imagelibrary',
			'value'		=> 'Choose Pattern',
			'selected'	=> isset($met_options['background'][$shortname.'_bg_pattern_file']) ? $met_options['background'][$shortname.'_bg_pattern_file'] : '',
			'desc'		=> 'Upload and use your own pattern.'
		)
	),
	'sidebar' => array(
		$shortname.'_sidebars' => array(
			'name'		=> 'Sidebars',
			'id'		=> $shortname.'_sidebars',
			'type'		=> 'listitems',
			'value'		=> array('Enter Sidebar Name'),
			'selected'	=> isset($met_options['sidebar'][$shortname.'_sidebars']) ? $met_options['sidebar'][$shortname.'_sidebars'] : '',
			'desc'		=> 'Use right form to enter new sidebars.',
			'keys'		=> array('name'),
			'types'		=> array('text')
		)
	)
);