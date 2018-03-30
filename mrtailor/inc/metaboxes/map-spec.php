<?php

$map_metabox = new WPAlchemy_MetaBox(array
(
	'id' => '_map_metabox',
	'title' => 'Map',
	'template' => get_template_directory() . '/inc/metaboxes/map-meta.php',
	'include_template' => 'page-contact.php',
	'priority' => 'high',
	'context' => 'side'
));

/* eof */