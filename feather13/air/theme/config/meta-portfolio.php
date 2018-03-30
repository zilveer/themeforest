<?php

/*---------------------------------------------------------------------------*/
/* Meta Settings :: Portfolio
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'		=> 'portfolio-headings',
		'title'		=> 'Headings',
		'page'		=> 'portfolio'
	),
	array(
		'id'		=> 'portfolio-template',
		'title'		=> 'Portfolio Template',
		'page'		=> 'portfolio'
	),
	array(
		'id'		=> 'portfolio-custom-link',
		'title'		=> 'Custom Link',
		'page'		=> 'portfolio'
	),
	array(
		'id'		=> 'portfolio-video',
		'title'		=> 'Video',
		'page'		=> 'portfolio'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Headings
/*-------------------------------------------------------*/

// Heading
$fields[] = array(
	'id'		=> '_heading',
	'label'		=> 'Heading',
	'section'	=> 'portfolio-headings',
	'type'		=> 'text'
);

// Subheading
$fields[] = array(
	'id'		=> '_subheading',
	'label'		=> 'Subheading',
	'section'	=> 'portfolio-headings',
	'type'		=> 'text'
);

/* Template
/*-------------------------------------------------------*/

// Template
$fields[] = array(
	'id'		=> '_portfolio_template',
	'label'		=> 'Template',
	'section'	=> 'portfolio-template',
	'type'		=> 'select',
	'choices'	=> array(
		'left'	=> 'Left',
		'right'	=> 'Right',
		'full'	=> 'Full'
	)
);

// Video Template
$fields[] = array(
	'id'		=> '_portfolio_video',
	'label'		=> 'Video Template',
	'section'	=> 'portfolio-template',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'_portfolio_video' => 'Enable Video Template'
	)
);

/* Custom Link
/*---------------------------------------------------------------------------*/

// Link
$fields[] = array(
	'id'		=> '_link',
	'label'		=> 'URL',
	'section'	=> 'portfolio-custom-link',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

/* Portfolio Single : Video
/*---------------------------------------------------------------------------*/

// Video URL
$fields[] = array(
	'id'		=> '_portfolio_video_url',
	'label'		=> 'Video URL (Recommended)',
	'section'	=> 'portfolio-video',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

// Video Embed Code
$fields[] = array(
	'id'		=> '_portfolio_video_embed_code',
	'label'		=> 'Video Embed Code',
	'section'	=> 'portfolio-video',
	'type'		=> 'textarea',
	'rows'		=> '5'
);
