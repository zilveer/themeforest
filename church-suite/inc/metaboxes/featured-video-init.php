<?php
$featured_video = new WPAlchemy_MetaBox(array
(
	'id' => '_featured_video',
	'title' => 'Video or Audio',
	'types' => array('post', 'events'),
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => get_template_directory() . '/inc/metaboxes/featured-video.php',
));

