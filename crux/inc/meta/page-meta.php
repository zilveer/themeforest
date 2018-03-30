<?php

add_action('add_meta_boxes', 'stag_metabox_page_background');

function stag_metabox_page_background(){
	$meta_box = array(
		'id'          => 'stag-metabox-page-background',
		'title'       => __( 'Background Settings', 'stag' ),
		'description' => __( 'Change background for this page.', 'stag' ),
		'page'        => 'page',
		'context'     => 'normal',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'name' => __( 'Upload background Image', 'stag' ),
				'desc' => __( 'Choose background image for this page.', 'stag' ),
				'id'   => '_stag_background_image',
				'type' => 'file',
				'std'  => ''
			),
		)
	);

	stag_add_meta_box($meta_box);
}
