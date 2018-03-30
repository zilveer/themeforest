<?php

/*---------------------------------------------------------------------------*/
/* Theme Settings :: Javascript
/*---------------------------------------------------------------------------*/

/* Sections
/*---------------------------------------------------------------------------*/

$sections = array(
	array(
		'id'	=> 'js-disable',
		'title'	=> 'Disable Scripts'
	),
	array(
		'id'	=> 'js-fancybox',
		'title'	=> 'Fancybox',
		'desc'	=> 'fancyBox v2 is free for non-commercial use. Commercial
					sites need to <a target="_blank" href="http://sites.fastspring.com/fancyapps/product/store">purchase a license</a> or choose fancyBox v1.'
	)
);


/* Fields
/*---------------------------------------------------------------------------*/

/* Disable jquery.jplayer.js
/*-------------------------------------------------------*/

// Disable scripts
$fields[] = array(
	'id'		=> 'js-disable',
	'label'		=> 'Disable',
	'section'	=> 'js-disable',
	'type'		=> 'checkbox',
	'choices'	=> array(
		'js-disable-jplayer' => 'jquery.jplayer.min.js'
	),
);

/* Fancybox
/*-------------------------------------------------------*/

// Select fancyBox 1 or 2
$fields[] = array(
	'id'		=> 'js-fancybox',
	'label'		=> 'Select version',
	'section'	=> 'js-fancybox',
	'type'		=> 'select',
	'choices'	=> array(
		'fancybox1' => 'fancyBox v1',
		'fancybox2'	=> 'fancyBox v2'
	),
	'default'	=> 'fancybox2'
);
