<?php

// Set option name
AirSettings::set_option_name('air-login');

/*-------------------------------------------------------------------------- */
/* Module Settings :: Login
/*-------------------------------------------------------------------------- */

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'login-enable',
		'title'	=> 'Custom Login Page'
	),
	array(
		'id'	=> 'login-logo',
		'title'	=> 'Logo',
	),
	array(
		'id'	=> 'login-colors',
		'title'	=> 'Colors'
	),
	array(
		'id'	=> 'login-css',
		'title'	=> 'Custom CSS'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Custom Login Page
/*-------------------------------------------------------*/

// Enable custom login page
$fields[] = array(
	'id'		=> 'login-custom-enable',
	'label'		=> 'Enable',
	'section'	=> 'login-enable',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'login-custom-enable' => 'Enable custom login page'
	)
);

/* Logo
/*-------------------------------------------------------*/

// Logo
$fields[]=array(
	'id'		=> 'login-logo',
	'label'		=> 'Logo Image',
	'section'	=> 'login-logo',
	'type'		=> 'image'
);

// Logo URL
$fields[]=array(
	'id'		=> 'login-logo-url',
	'label'		=> 'Logo URL',
	'section'	=> 'login-logo',
	'type'		=> 'url',
	'class'		=> 'regular-text'
);

/* Colors
/*-------------------------------------------------------*/

// Background Color
$fields[] = array(
	'id'		=> 'login-bg-color',
	'label'		=> 'Background Color',
	'section'	=> 'login-colors',
	'type'		=> 'colorpicker'
);

// Link Color
$fields[] = array(
	'id'		=> 'login-link-color',
	'label'		=> 'Link Color',
	'section'	=> 'login-colors',
	'type'		=> 'colorpicker'
);

// Link Color Hover
$fields[] = array(
	'id'		=> 'login-link-hover-color',
	'label'		=> 'Link Color Hover',
	'section'	=> 'login-colors',
	'type'		=> 'colorpicker'
);

/* CSS
/*-------------------------------------------------------*/

// Custom CSS
$fields[] = array(
	'id'		=> 'login-css',
	'label'		=> 'Custom CSS',
	'section'	=> 'login-css',
	'type'		=> 'textarea',
	'rows'		=> '12'
);
