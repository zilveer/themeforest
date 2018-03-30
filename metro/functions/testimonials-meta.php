<?php

/*************************************************************************************
 *	Add MetaBox to Testimonials edit page
 *************************************************************************************/

$om_testimonials_meta_box=array (
	'details' => array (
		'id' => 'om-testimonials-meta-box-size',
		'name' =>  __('Testimonial Details', 'om_theme'),
		'callback' => 'om_testimonials_meta_box_details',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array (
			array ( "name" => __('Author description (post, company)','om_theme'),
					"desc" => '',
					"id" => OM_THEME_SHORT_PREFIX."testimonial_author_desc",
					"type" => "text",
					"std" => '',
			),
		),
	),
	
	'sidebar' => array (
		'id' => 'om-post-meta-box-sidebar',
		'name' => __('Sidebar', 'om_theme'),
		'callback' => 'om_post_meta_box_sidebar',
		'fields' => array (
			array (
				'name' => __('Choose the sidebar','om_theme'),
				'desc' => '',
				'id' => OM_THEME_SHORT_PREFIX.'sidebar',
				'type' => 'sidebar',
				'std' => ''
			),
			
			array ( "name" => __('Page Individual Sidebar Position','om_theme'),
					"desc" => __('Normally sidebar position for all pages can be specified under "Appearance > Theme Options > Sidebars", but you can set sidebar position for current page manually.','om_theme'),
					"id" => OM_THEME_SHORT_PREFIX."sidebar_custom_pos",
					"type" => "select",
					"std" => '',
					'options' => array(
						'' => __('Default (As in "Theme Options")', 'om_theme'),
						'left' => __('Left Side', 'om_theme'),
						'right' => __('Right Side', 'om_theme'),
					)
			),
		),
	),
	
);
 
function om_add_testimonials_meta_box() {
	global $om_testimonials_meta_box;
	
	foreach($om_testimonials_meta_box as $metabox) {
		add_meta_box(
			$metabox['id'],
			$metabox['name'],
			$metabox['callback'],
			'testimonials',
			@$metabox['context']?$metabox['context']:'advanced',
			@$metabox['priority']?$metabox['priority']:'default'
		);
	}
}
add_action('add_meta_boxes', 'om_add_testimonials_meta_box');

/*************************************************************************************
 *	MetaBox Callbacks Functions
 *************************************************************************************/

function om_testimonials_meta_box_details() {
	global $om_testimonials_meta_box;

	echo om_generate_meta_box($om_testimonials_meta_box['details']['fields']);
}

/*************************************************************************************
 *	Save MetaBox data
 *************************************************************************************/

function om_save_testimonials_metabox($post_id) {
	global $om_testimonials_meta_box;
 
	om_save_metabox($post_id, $om_testimonials_meta_box);

}
add_action('save_post', 'om_save_testimonials_metabox');
