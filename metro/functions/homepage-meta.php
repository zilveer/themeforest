<?php

/*************************************************************************************
 *	Add MetaBox to Homepage edit page
 *************************************************************************************/

$om_homepage_meta_box=array (
	'type' => array (
		'id' => 'om-homepage-meta-box-size',
		'name' =>  __('Box Size', 'om_theme'),
		'callback' => 'om_homepage_meta_box_size',
		'context' => 'side',
		'priority' => 'default',
		'fields' => array (
			array ( "name" => __('Box&nbsp;size','om_theme'),
					"desc" => __('Choose&nbsp;the&nbsp;size of the block','om_theme'),
					"id" => OM_THEME_SHORT_PREFIX."homepage_size",
					"type" => "select",
					"std" => '9',
					'options' => array(
						'9' => __('9x (full width)', 'om_theme'),
						'8' => __('8x', 'om_theme'),
						'7' => __('7x', 'om_theme'),
						'6' => __('6x', 'om_theme'),
						'5' => __('5x', 'om_theme'),
						'4' => __('4x', 'om_theme'),
						'3' => __('3x', 'om_theme'),
						'2' => __('2x', 'om_theme'),
						'1' => __('1x', 'om_theme'),
					)
			),
			array ( "name" => __('Inner&nbsp;box paddings','om_theme'),
					"desc" => '',
					"id" => OM_THEME_SHORT_PREFIX."homepage_paddings",
					"type" => "select",
					"std" => '',
					'options' => array(
						'' => __('Standard', 'om_theme'),
						'no' => __('No paddings', 'om_theme'),
					)
			),
		),
	),
);
 
function om_add_homepage_meta_box() {
	global $om_homepage_meta_box;
	
	foreach($om_homepage_meta_box as $metabox) {
		add_meta_box(
			$metabox['id'],
			$metabox['name'],
			$metabox['callback'],
			'homepage',
			@$metabox['context']?$metabox['context']:'advanced',
			@$metabox['priority']?$metabox['priority']:'default'
		);
	}
}
add_action('add_meta_boxes', 'om_add_homepage_meta_box');

/*************************************************************************************
 *	MetaBox Callbacks Functions
 *************************************************************************************/

function om_homepage_meta_box_size() {
	global $om_homepage_meta_box;

	echo om_generate_meta_box($om_homepage_meta_box['type']['fields']);
}

/*************************************************************************************
 *	Save MetaBox data
 *************************************************************************************/

function om_save_homepage_metabox($post_id) {
	global $om_homepage_meta_box;
 
	om_save_metabox($post_id, $om_homepage_meta_box);

}
add_action('save_post', 'om_save_homepage_metabox');
