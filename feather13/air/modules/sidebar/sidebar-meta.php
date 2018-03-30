<?php

/*---------------------------------------------------------------------------*/
/* Meta Settings :: Sidebar Module
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'		=> 'air-sidebar-module',
		'title'		=> 'Sidebar',
		'page'		=> array('page','post'),
		'context'	=> 'side',
		'priority'	=> 'default'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Sidebar
/*-------------------------------------------------------*/

// Heading
$fields[] = array(
	'id'		=> '_sidebar',
	'label'		=> 'Sidebar',
	'section'	=> 'air-sidebar-module',
	'type'		=> 'select',
	'choices'	=> air_sidebar::get_choices()
);