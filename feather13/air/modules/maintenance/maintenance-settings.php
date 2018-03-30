<?php

// Set option name
AirSettings::set_option_name('air-maintenance');

/*-------------------------------------------------------------------------- */
/* Module Settings :: Maintenance
/*-------------------------------------------------------------------------- */

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'maintenance-mode',
		'title'	=> 'Maintenance Mode'
	),
	array(
		'id'	=> 'maintenance-custom',
		'title'	=> 'Custom'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Maintenance Mode
/*-------------------------------------------------------*/

// Enable maintenance mode
$fields[] = array(
	'id'		=> 'maintenance-mode',
	'label'		=> 'Enable',
	'section'	=> 'maintenance-mode',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'maintenance-mode' => 'Enable maintenance mode'
	)
);

// Access Role
$fields[] = array(
	'id'		=> 'maintenance-role',
	'label'		=> 'Access Role',
	'section'	=> 'maintenance-mode',
	'type'		=> 'select',
	'choices'	=> array(
		'administrator' => 'Administrator',
		'editor'		=> 'Editor',
		'author'		=> 'Author',
		'contributor'	=> 'Contributor'
	)
);

/* Custom
/*-------------------------------------------------------*/

// HTML
$fields[] = array(
	'id'		=> 'maintenance-html',
	'label'		=> 'HTML',
	'section'	=> 'maintenance-custom',
	'type'		=> 'textarea'
);

// HTML
$fields[] = array(
	'id'		=> 'maintenance-css',
	'label'		=> 'CSS',
	'section'	=> 'maintenance-custom',
	'type'		=> 'textarea'
);

