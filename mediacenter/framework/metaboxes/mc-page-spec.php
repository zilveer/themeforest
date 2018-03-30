<?php

$mc_page_metabox = new WPAlchemy_MetaBox(
	array(
		'id' => '_mc_page_metabox',
		'title' => 'Media Center Page Attributes',
		'types' => array('page'),
		'context' => 'normal', // same as above, defaults to "normal"
		'priority' => 'high', // same as above, defaults to "high"
		'template' => get_template_directory() . '/framework/metaboxes/mc-page-meta.php'
	)
);

/* eof */