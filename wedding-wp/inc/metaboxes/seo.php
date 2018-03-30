<?php
$page_seo_meta = new WPAlchemy_MetaBox(array
(
	'id' => '_page_seo',
	'title' => 'SEO Options',
	'types' => array('page','post','portfolio'),
	
	'template' => get_template_directory() . '/inc/metaboxes/seo_page.php',
		
));

