<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: Sidebar
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'sidebar-posts',
		'title'	=> 'Sidebar (Posts)'
	),
	array(
		'id'	=> 'sidebar-mobile',
		'title'	=> 'Mobile Sidebar',
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Sidebar (Posts)
/*-------------------------------------------------------*/

// Enable Sidebar (Posts)
$fields[] = array(
	'id'		=> 'sidebar-enable',
	'label'		=> 'Enable',
	'section'	=> 'sidebar-posts',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'sidebar-enable' => 'Enable sidebars (for blog, single, archive, search, error 404)'
	)
);

/* Mobile Sidebar
/*-------------------------------------------------------*/

// Disable Mobile Sidebar
$fields[] = array(
	'id'		=> 'sidebar-mobile-disable',
	'label'		=> 'Disable',
	'section'	=> 'sidebar-mobile',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'sidebar-mobile-disable' => 'Hide sidebar content on mobile layouts'
	)
);
