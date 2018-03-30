<?php 
/**
 * Metaboxes for Page
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'mm_';
$config_img = array(
	'title' => __('Gallery Options', 'homeshop'),
	'id' => $prefix . 'blog_image_meta_box',
	'pages' => array('post'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);
$options_img = array(
	array(
			'desc' => __('<strong>NOTE: Click the "Add images" button to upload the images to this post.<br/>You can drag-and-drop images to re-order them.</strong><br />', 'homeshop'),
			'id' => $prefix . 'slider_image_gallery',
			'button' => __('Add Images', 'homeshop'),
			'class' => 'noborder',
			'type' => 'upload_images'
	),
);
new meta_boxes_generator($config_img,$options_img);




$config_img1 = array(
	'title' => __('Custom Tab Options', 'homeshop'),
	'id' => $prefix . 'product_custom_meta_box',
	'pages' => array('product'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);
$options_img1 = array(
	array(
		'name' => '',
		'id' => $prefix . 'custom_title_product_meta_box',
		'desc' => __('Title Custom Tab',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'custom_cont_product_meta_box',
		'desc' => __('Content Custom Tab',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'textarea_w'
	),
	
	
	array(
		'name' => '',
		'id' => $prefix . 'custom_title2_product_meta_box',
		'desc' => __('Title Custom Tab2',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'custom_cont2_product_meta_box',
		'desc' => __('Content Custom Tab2',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'textarea_w'
	),
	
	array(
		'name' => '',
		'id' => $prefix . 'custom_title3_product_meta_box',
		'desc' => __('Title Custom Tab3',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'custom_cont3_product_meta_box',
		'desc' => __('Content Custom Tab3',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'textarea_w'
	),
	
	
	array(
		'name' => '',
		'id' => $prefix . 'custom_title4_product_meta_box',
		'desc' => __('Title Custom Tab4',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'custom_cont4_product_meta_box',
		'desc' => __('Content Custom Tab4',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'textarea_w'
	),
	
	
	
	array(
		'name' => '',
		'id' => $prefix . 'custom_title5_product_meta_box',
		'desc' => __('Title Custom Tab5',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'custom_cont5_product_meta_box',
		'desc' => __('Content Custom Tab5',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'textarea_w'
	),
	
	
	array(
		'name' => '',
		'id' => $prefix . 'custom_title6_product_meta_box',
		'desc' => __('Title Custom Tab6',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'custom_cont6_product_meta_box',
		'desc' => __('Content Custom Tab6',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'textarea_w'
	)
	
	
);
new meta_boxes_generator($config_img1,$options_img1);



$config_img2 = array(
	'title' => __('Custom Options', 'homeshop'),
	'id' => $prefix . 'portfolio_photo_custom_meta_box',
	'pages' => array('banners'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high'
);
$options_img2 = array(
	array(
		'name' => '',
		'id' => $prefix . 'link_portfolio_photo_meta_box',
		'desc' => __('Url',  'homeshop'),
		'std' => '',
		'size' => '30',
		'class' => 'noborder',
		'type' => 'text'
	),
	array(
		'name' => '',
		'id' => $prefix . 'target_portfolio_photo_meta_box',
		'desc' => __('New Tab/Window',  'homeshop'),
		'std' => '',
		'class' => 'noborder',
		'type' => 'checkbox'
	)
);
new meta_boxes_generator($config_img2,$options_img2);





?>