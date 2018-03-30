<?php

$post_gallery = new WPAlchemy_MetaBox(array
(
    'id' => '_custom_meta',
    'title' => 'Image Gallery',
	'types' => array('post','portfolio'),
	'priority' => 'low',
    'template' => get_stylesheet_directory() . '/functions/media-uploader/custom-meta.php',
));

$custom_bg = new WPAlchemy_MetaBox(array
(
    'id' => '_background_meta',
    'title' => 'Custom Background',
	'types' => array('post','portfolio','page'),
	'priority' => 'low',
	'context' => 'side',
    'template' => get_stylesheet_directory() . '/functions/media-uploader/background-meta.php',
));

/* eof */