<?php 
/**
 * Metaboxes for Slideshow
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Text And Image Options', 'TR'),
	'id' => $prefix . 'slideshow_text_meta_box',
	'pages' => array('slideshow'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
		'name' => __('Caption', 'TR'),
		'desc' => __('Write your title of the slideshow in this field.', 'TR'),
		'id' => $prefix . 'slideshow_caption_text',
		'rows' => '3',
		'std' => '',
		'type' => 'textarea'
	),
	array(
		'name' => __('Description', 'TR'),
		'desc' => __('Write your description of the slideshow in this field.', 'TR'),
		'id' => $prefix . 'slideshow_desc_text',
		'rows' => '3',
		'std' => '',
		'type' => 'textarea'
	),
	array(
		'name' => __('Enable Caption','HK'),
		'desc' => __('Enable the caption in the slidershow.', 'TR'),
		'id' => $prefix. 'enable_slideshow_caption_text',
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
		'id' => $prefix. 'enable_slideshow_desc_text',
		'std' => 'yes',
		'options' => array(
			'yes' => __('Yes', 'TR'),
			'no' => __('No', 'TR')
		),
		'type' => 'radio'
	),
	array(
		'name' => __('Image', 'TR'),
		'desc' => __('The image for your slideshow item.', 'TR'),
		'id' => $prefix . 'slideshow_image_text',
		'std' => '',
		'size' => '60',
		'type' => 'upload'
	),
	array(
		'name' => __('Image Align','HK'),
		'desc' => __('Set the image align for the slidershow.', 'TR'),
		'id' => $prefix. 'slideshow_image_align',
		'std' => 'left',
		'options' => array(
			'left' => __('Left', 'TR'),
			'right' => __('Right', 'TR')
		),
		'type' => 'radio'
	),
	array(
		'name' => __('Link Text', 'TR'),
		'desc' => __('Write your link text of the slideshow in this field.', 'TR'),
		'id' => $prefix . 'slideshow_link_text',
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => __('External Link', 'TR'),
		'desc' => __('Enter a url for you custom link, Ex: http://google.com. If you do not want to use this, just leave it blank.', 'TR'),
		'id' => $prefix . 'slideshow_external_link_text',
		'std' => '',
		'rows' => '3',
		'class' => 'noborder',
		'type' => 'textarea'
	)
);

new meta_boxes_generator($config,$options);
?>