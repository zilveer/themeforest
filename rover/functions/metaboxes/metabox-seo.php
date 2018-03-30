<?php 
/**
 * Metaboxes for SEO
 * @package by Theme Record
 * @auther: MattMao
 */
$prefix = 'TR_';

$config = array(
	'title' => __('SEO Settings', 'TR'),
	'id' => $prefix . 'seo_meta_box',
	'pages' => array('page', 'post', 'portfolio', 'product', 'gallery'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);

$options = array(
	array(
			'name' => __('SEO - Title Tags', 'TR'),
			'desc' => esc_html__('Enter in the title as you would like to be displayed. Ex:<title>Your title ends up here</title>', 'TR'),
			'id' => $prefix . 'seo_title',
			'std' => '',
			'rows' => '2',
			'type' => 'textarea'
	),
	array(
			'name' => __('SEO - Keywords', 'TR'),
			'desc' => esc_html__('Enter a comma-separated list of keywords you would like to associate with this page. Ex:<meta name="keywords" content="keyword1, keyword2, keyword3" />', 'TR'),
			'id' => $prefix . 'seo_keywords',
			'std' => '',
			'rows' => '2',
			'type' => 'textarea'
	),
	array(
			'name' => __('SEO - Description', 'TR'),
			'desc' => esc_html__('Enter a comma-separated list of description you would like to associate with this page. Ex:<meta name="description" content="This is your seo description of your site." />', 'TR'),
			'id' => $prefix . 'seo_description',
			'std' => '',
			'rows' => '2',
			'class' => 'noborder',
			'type' => 'textarea'
	),
);

new meta_boxes_generator($config,$options);
?>