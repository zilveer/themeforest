<?php

$employee_meta = new WPAlchemy_MetaBox(array
(
	'id' => '_employee_meta',
	'title' => 'Employee',
	'types' => array('employee'), // added only for pages and to custom post type "events"
	'context' => 'normal', // same as above, defaults to "normal"
	'priority' => 'high', // same as above, defaults to "high"
	'template' => get_template_directory() . '/inc/cpt/metaboxes/employee.php'
));
