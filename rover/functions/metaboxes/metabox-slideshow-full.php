<?php 
/**
 * Metaboxes for Slideshow
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Full Width Image Options', 'TR'),
	'id' => $prefix . 'slideshow_full_meta_box',
	'pages' => array('slideshow'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
		'name' => __('Caption', 'TR'),
		'desc' => __('Write your title of the slideshow in this field.', 'TR'),
		'id' => $prefix . 'slideshow_caption_full',
		'rows' => '3',
		'std' => '',
		'type' => 'textarea'
	),
	array(
		'name' => __('Description', 'TR'),
		'desc' => __('Write your description of the slideshow in this field.', 'TR'),
		'id' => $prefix . 'slideshow_desc_full',
		'rows' => '3',
		'std' => '',
		'type' => 'textarea'
	),
	array(
		'name' => __('Enable Caption','HK'),
		'desc' => __('Enable the caption in the slidershow.', 'TR'),
		'id' => $prefix. 'enable_slideshow_caption_full',
		'std' => 'yes',
		'options' => array(
			'yes' => __('Yes', 'TR'),
			'no' => __('No', 'TR')
		),
		'type' => 'radio'
	),
	array(
		'name' => __('Enable Description','HK'),
		'desc' => __('Enable the description in the slidershow.', 'TR'),
		'id' => $prefix. 'enable_slideshow_desc_full',
		'std' => 'yes',
		'options' => array(
			'yes' => __('Yes', 'TR'),
			'no' => __('No', 'TR')
		),
		'type' => 'radio'
	),
	array(
		'name' => __('Image', 'TR'),
		'desc' => __('The image for your slideshow item. The max size is: 940px.', 'TR'),
		'id' => $prefix . 'slideshow_image_full',
		'std' => '',
		'size' => '60',
		'type' => 'upload'
	),
	array(
		'name' => __('External Link', 'TR'),
		'desc' => __('Enter a url for you custom link, Ex: http://google.com. If you do not want to use this, just leave it blank.', 'TR'),
		'id' => $prefix . 'slideshow_external_link_full',
		'std' => '',
		'rows' => '3',
		'class' => 'noborder',
		'type' => 'textarea'
	)
);

new meta_boxes_generator($config,$options);
?>