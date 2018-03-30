<?php 
/**
 * Metaboxes for Product
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('Product Options', 'TR'),
	'id' => $prefix . 'product_meta_box',
	'pages' => array('product'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
		'name' => __('Price', 'TR'),
		'desc' => __('Set the price for the product.', 'TR'),
		'id' => $prefix . 'product_price',
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => __('Weight', 'TR'),
		'desc' => __('Set the weight for the product.', 'TR'),
		'id' => $prefix . 'product_weight',
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => __('Dimensions', 'TR'),
		'desc' => __('Set the dimensions for the product.', 'TR'),
		'id' => $prefix . 'product_dimensions',
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => __('Colour', 'TR'),
		'desc' => __('Set the colour for the product.', 'TR'),
		'id' => $prefix . 'product_colour',
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
		'name' => __('Size', 'TR'),
		'desc' => __('Set the size for the product.', 'TR'),
		'id' => $prefix . 'product_size',
		'std' => '',
		'size' => '60',
		'type' => 'text'
	),
	array(
			'name' => esc_html__('Exclude Featured Image ',  'TR'),
			'desc' => esc_html__('Exclude the featured image from gallery.',  'TR'),
			'id' => $prefix . 'exclude_featured_image',
			'std' => 0,
			'type' => 'checkbox',
	),
	array(
			'desc' => __('Upload images to be used for this product (images should be at least 650px wide).', 'TR'),
			'id' => 'TR_upload_images',
			'button' => __('Add Images', 'TR'),
			'class' => 'noborder',
			'type' => 'upload_images'
	),
);

new meta_boxes_generator($config,$options);
?>