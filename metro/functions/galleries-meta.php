<?php

/*************************************************************************************
 *	Add MetaBox to Galleries edit page
 *************************************************************************************/

$om_galleries_meta_box=array (

	'imageblock' => array (
		'id' => 'om-galleries-meta-box-images',
		'name' =>  __('Gallery Images', 'om_theme'),
		'callback' => 'om_galleries_meta_box_images',
		'fields' => array (
			array ( "name" => __('Gallery','om_theme'),
					"desc" => '',
					"id" => OM_THEME_SHORT_PREFIX."gallery",
					"type" => "gallery",
					"std" => '',
			),
		),
	),


);
 
function om_add_galleries_meta_box() {
	global $om_galleries_meta_box;
	
	foreach($om_galleries_meta_box as $metabox) {
		add_meta_box(
			$metabox['id'],
			$metabox['name'],
			$metabox['callback'],
			'galleries',
			'normal',
			'high'
		);
	}
 
}
add_action('add_meta_boxes', 'om_add_galleries_meta_box');

/*************************************************************************************
 *	MetaBox Callbacks Functions
 *************************************************************************************/


function om_galleries_meta_box_images() {
	global $om_galleries_meta_box;

	echo om_generate_meta_box($om_galleries_meta_box['imageblock']['fields']);
}

/*************************************************************************************
 *	Save MetaBox data
 *************************************************************************************/

function om_save_galleries_metabox($post_id) {
	global $om_galleries_meta_box;
 
	om_save_metabox($post_id, $om_galleries_meta_box);

}
add_action('save_post', 'om_save_galleries_metabox');

