<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: Header
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'header-custom-logo',
		'title'	=> 'Custom Logo'
	),
	array(
		'id'	=> 'header-tagline',
		'title'	=> 'Tagline',
	),
	array(
		'id'	=> 'header-blog-subheader',
		'title'	=> 'Blog Subheader'
	),
	array(
		'id'	=> 'header-archive-heading',
		'title'	=> 'Archive Heading'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Custom Logo
/*-------------------------------------------------------*/

// Custom Logo URL
$fields[] = array(
	'id'		=> 'custom-logo',
	'label'		=> 'Logo URL',
	'section'	=> 'header-custom-logo',
	'type'		=> 'image'
);

/* Tagline
/*-------------------------------------------------------*/

// Disable Tagline
$fields[] = array(
	'id'		=> 'disable-tagline',
	'label'		=> 'Disable',
	'section'	=> 'header-tagline',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'disable-tagline' => 'Disable tagline (site description)'
	)
);

/* Subheader
/*-------------------------------------------------------*/

// Disable blog subheader
$fields[] = array(
	'id'		=> 'disable-subheader',
	'label'		=> 'Disable',
	'section'	=> 'header-blog-subheader',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'disable-subheader' => 'Disable subheader (for blog, single, archive, search, error 404)'
	)
);


/* Archive Heading
/*-------------------------------------------------------*/

// Disable archive heading
$fields[] = array(
	'id'		=> 'disable-archive-heading',
	'label'		=> 'Disable',
	'section'	=> 'header-archive-heading',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'disable-archive-heading' => 'Disable archive heading'
	)
);
