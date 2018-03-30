<?php

$full_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_slider_images',
	'title' => 'Slider',
	'types' => array('portfolio','post'), // added only for pages and to custom post type "events"
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => get_template_directory() . '/inc/metaboxes/full-meta.php'
));

/* eof */