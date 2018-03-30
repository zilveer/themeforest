<?php

add_action('add_meta_boxes', 'stag_metabox_layout');

function stag_metabox_layout(){
	$meta_box = array(
		'id'          => 'stag-metabox-layout',
		'title'       => __( 'Layout Settings', 'stag' ),
		'description' => __( 'Configure page layout.', 'stag' ),
		'page'        => 'page',
		'context'     => 'side',
		'priority'    => 'high',
		'fields'      => array(
			array(
				'name'    => __( 'Page Layout', 'stag' ),
				'desc'    => __( 'Select the desired page layout.', 'stag' ),
				'id'      => '_stag_page_layout',
				'type'    => 'select',
				'std'     => 'default',
				'options' => array(
					'default'       => __( 'Default - Set in Crux > Sidebar', 'stag' ),
					'no-sidebar'    => __( 'No Sidebar', 'stag' ),
					'left-sidebar'  => __( 'Left Sidebar', 'stag' ),
					'right-sidebar' => __( 'Right Sidebar', 'stag' ),
				)
			),
			array(
				'name'    => __( 'Sidebar Setting', 'stag' ),
				'desc'    => __( 'Choose which sidebar to display.', 'stag' ),
				'id'      => '_stag_page_sidebar',
				'type'    => 'select',
				'std'     => 'default',
				'options' => stag_registered_sidebars( array('' => __( 'Default Sidebar', 'stag' ) ) )
			)
		)
	);

	stag_add_meta_box($meta_box);

	$meta_box['page'] = 'post';
	stag_add_meta_box($meta_box);
}
