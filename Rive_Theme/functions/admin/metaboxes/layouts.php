<?php
/*
 * Layout options
 */

$config = array(
	'id'       => 'ch_layouts',
	'title'    => __('Layouts', 'ch'),
	'pages'    => array('page', 'post', 'ch_cause', 'ch_staff'),
	'context'  => 'normal',
	'priority' => 'high',
);

$options = array(array(
	'name'    => __('Layout type', 'ch'),
	'id'      => 'layouts',
	'type'    => 'layouts',
	'only'    => 'page,post,ch_cause,ch_staff',
	'default' => get_option('default-layout'),
));

require_once(CH_METABOXES . '/add_metaboxes.php');
new create_meta_boxes($config, $options);