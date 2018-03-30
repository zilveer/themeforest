<?php
add_action( 'admin_init', 'force_delete_register_meta_boxes' );
function force_delete_register_meta_boxes()
{
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;
	$prefix = '';
	$meta_box = array(
		'title'  =>esc_html__( 'Test Meta Box', 'ievent' ),
		'fields' => array(
			// FILE UPLOAD
			array(
				'name' =>  esc_html__( 'File Upload', 'ievent' ),
				'id'   => "{$prefix}file",
				'type' => 'file',
				'force_delete' => true,
			),
			// IMAGE UPLOAD
			array(
				'name' =>  esc_html__( 'Image Upload', 'ievent' ),
				'id'   => "{$prefix}image",
				'type' => 'image',
			),
			// THICKBOX IMAGE UPLOAD (WP 3.3+)
			array(
				'name' => esc_html__( 'Thickbox Image Upload', 'ievent' ),
				'id'   => "{$prefix}thickbox",
				'type' => 'thickbox_image',
				'force_delete' => true,
			),
			// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
			array(
				'name'             => esc_html__( 'Plupload Image Upload', 'ievent' ),
				'id'               => "{$prefix}plupload",
				'type'             => 'plupload_image',
				'max_file_uploads' => 4,
				'force_delete' => true,
			),
		),
	);
	new RW_Meta_Box( $meta_box );
}
