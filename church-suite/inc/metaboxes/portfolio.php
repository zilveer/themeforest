<?php 
$portfolio_meta = new WPAlchemy_MetaBox(array
(
	'id' => '_portfolio_meta',
	'title' => 'Additional Info',
	'types' => array('portfolio'),
	'context' => 'side', // same as above, defaults to "normal"
	'priority' => 'low', // same as above, defaults to "high"
	'template' => get_template_directory() . '/inc/metaboxes/portfolio-text.php',
));