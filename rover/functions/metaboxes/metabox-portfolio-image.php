<?php 
/**
 * Metaboxes for Images
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Image Options', 'TR'),
	'id' => $prefix . 'portfolio_image_meta_box',
	'pages' => array('portfolio'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
			'desc' => __('Upload images to be used for this portfolio (images should be at least 940px wide).', 'TR'),
			'id' => 'TR_upload_images',
			'button' => __('Add Images', 'TR'),
			'class' => 'noborder',
			'type' => 'upload_images'
	),
);

new meta_boxes_generator($config,$options);
?>