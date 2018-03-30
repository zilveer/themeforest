<?php
$is_page_mega = new WPAlchemy_MetaBox(array
(
	'id' => '_is_mega_menu',
	'title' => 'Is mega menu?',
	'types' => array('page'),
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => get_template_directory() . '/inc/metaboxes/is_mega.php',
));

