<?php 
$cause_meta = new WPAlchemy_MetaBox(array
(
	'id' => '_cause_meta',
	'title' => 'Cause Options',
	'types' => array('cause'),
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => get_template_directory() . '/inc/metaboxes/cause_template.php',
    'mode' => WPALCHEMY_MODE_EXTRACT,	
));