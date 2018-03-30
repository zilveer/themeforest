<?php 
$sermon_meta = new WPAlchemy_MetaBox(array
(
	'id' => '_sermon_meta',
	'title' => 'Sermon Options',
	'types' => array('sermon'),
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => get_template_directory() . '/inc/metaboxes/sermon_template.php',
));