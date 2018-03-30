<?php 
$blogpost_meta = new WPAlchemy_MetaBox(array
(
	'id' => '_blogpost_meta',
	'title' => 'Post Style',
	'types' => array('post'),
	'context' => 'side', // same as above, defaults to "normal"
	'priority' => 'low', // same as above, defaults to "high"
	'template' => get_template_directory() . '/inc/metaboxes/blogpost_template.php',
));