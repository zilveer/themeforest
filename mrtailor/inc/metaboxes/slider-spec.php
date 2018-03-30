<?php

$slider_metabox = new WPAlchemy_MetaBox(array
(
	'id' => '_slider_metabox',
	'title' => 'Homepage Slider',
	'template' => get_template_directory() . '/inc/metaboxes/slider-meta.php',
	'include_template' => array('page-with-slider.php','page-with-slider-full-width.php'),
	'priority' => 'high',
	'context' => 'normal'
));

/* eof */