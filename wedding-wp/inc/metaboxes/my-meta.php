<?php
$custom_select_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_select_meta',
	'title' => 'Video Post',
	'types' => array('post', 'events'),
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => get_template_directory() . '/inc/metaboxes/my-select.php',
));

