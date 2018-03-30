<?php
/*
 * Video metabox
 */

$config = array(
	'id'       => 'ch_video',
	'title'    => __('Video', 'ch'),
	'pages'    => array('ch_cause'),
	'context'  => 'normal',
	'priority' => 'high',
);

$options = array(array(
	'name' => __('Video code', 'ch'),
	'id'   => '_video_code',
	'type' => 'video',
	'only' => 'ch_cause',
));

require_once(CH_METABOXES . '/add_metaboxes.php');
new create_meta_boxes($config, $options);