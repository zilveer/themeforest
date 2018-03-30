<?php

/*---------------------------------------------------------------------------*/
/* Meta Settings :: Global, Posts, and Pages
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(

	/* 0. Global
	/*-----------------------------------------*/
	array(
		'id'	=> 'global-bg-image',
		'title'	=> 'Page Background Image',
		'page'	=> array('post','page','portfolio')
	),

	/* 1. Posts
	/*-----------------------------------------*/
	
	array(
		'id'	=> 'format-audio',
		'title'	=> 'Audio'
	),
	array(
		'id'	=> 'format-chat',
		'title'	=> 'Chat'
	),
	array(
		'id'	=> 'format-link',
		'title'	=> 'Link'
	),
	array(
		'id'	=> 'format-quote',
		'title'	=> 'Quote'
	),
	array(
		'id'	=> 'format-video',
		'title'	=> 'Video'
	),
	array(
		'id'		=> 'post-template',
		'title'		=> 'Post Template',
		'context'	=> 'side',
		'priority'	=> 'default'
	),

	/* 2. Pages
	/*-----------------------------------------*/

	array(
		'id'	=> 'page-headings',
		'title'	=> 'Headings',
		'page'	=> 'page'
	)

);


/**
	0. Global Fields
**/

/* Page Background Image
/*-------------------------------------------------------*/

// Fixed Image
$fields[] = array(
	'id'		=> '_bg-image',
	'label'		=> 'Image',
	'section'	=> 'global-bg-image',
	'type'		=> 'image'
);

// Fixed Image Settings
$fields[] = array(
	'id'			=> '_bg-image-settings',
	'label'			=> 'Image Settings',
	'section'		=> 'global-bg-image',
	'type'			=> 'select',
	'choices'		=> array(
		'default'	=> 'scale up',
		'bgwidth'	=> 'scale up and down'
	)
);


/**
	1. Post Fields
**/

/* Audio
/*-------------------------------------------------------*/

// Audio MP3 URL
$fields[] = array(
	'id'		=> '_audio_mp3_url',
	'label'		=> 'Audio URL (.mp4 or .mp3)',
	'section'	=> 'format-audio',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

// Audio OGG URL
$fields[] = array(
	'id'		=> '_audio_ogg_url',
	'label'		=> 'Audio URL (.ogg)',
	'section'	=> 'format-audio',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

/* Chat
/*-------------------------------------------------------*/

// Status
$fields[] = array(
	'id'		=> '_chat',
	'label'		=> 'Text',
	'section'	=> 'format-chat',
	'type'		=> 'textarea',
	'rows'		=> '8'
);


/* Link
/*-------------------------------------------------------*/

// Link Title
$fields[] = array(
	'id'		=> '_link_title',
	'label'		=> 'Link Title',
	'section'	=> 'format-link',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

// Link URL
$fields[] = array(
	'id'		=> '_link_url',
	'label'		=> 'Link URL',
	'section'	=> 'format-link',
	'type'		=> 'text',
	'class'		=> 'large-text'
);


/* Quote
/*-------------------------------------------------------*/

// Quote
$fields[] = array(
	'id'		=> '_quote',
	'label'		=> 'Quote',
	'section'	=> 'format-quote',
	'type'		=> 'textarea',
	'rows'		=> '4'
);

// Quote Author
$fields[] = array(
	'id'		=> '_quote_author',
	'label'		=> 'Quote Author',
	'section'	=> 'format-quote',
	'type'		=> 'text',
	'class'		=> 'large-text'
);


/* Video
/*-------------------------------------------------------*/

// Video URL
$fields[] = array(
	'id'		=> '_video_url',
	'label'		=> 'Video URL (Recommended)',
	'section'	=> 'format-video',
	'type'		=> 'text',
	'class'		=> 'large-text'
);

// Video Embed
$fields[] = array(
	'id'		=> '_video_embed_code',
	'label'		=> 'Video Embed Code',
	'section'	=> 'format-video',
	'type'		=> 'textarea',
	'rows'		=> '6'
);

/* Post Templates
/*-------------------------------------------------------*/

// Template
$fields[] = array(
	'id'		=> '_wp_post_template',
	'label'		=> 'Template',
	'section'	=> 'post-template',
	'type'		=> 'select',
	'choices'	=> air_get_post_templates()
);


/**
	2. Page Fields
**/

/* Headings
/*-------------------------------------------------------*/

// Heading
$fields[] = array(
	'id'		=> '_heading',
	'label'		=> 'Heading',
	'section'	=> 'page-headings',
	'type'		=> 'text'
);

// Subheading
$fields[] = array(
	'id'		=> '_subheading',
	'label'		=> 'Subheading',
	'section'	=> 'page-headings',
	'type'		=> 'text'
);
