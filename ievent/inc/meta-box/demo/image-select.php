<?php
add_filter( 'rwmb_meta_boxes', 'PREFIX_register_meta_box_image_select' );
function PREFIX_register_meta_box_image_select( $meta_boxes )
{
	$meta_boxes[] = array(
		'title' => esc_html__( 'Image Select Demo', 'ievent' ),
		'fields' => array(
			array(
				'id'       => 'layout',
				'name'     => esc_html__( 'Layout', 'ievent' ),
				'type'     => 'image_select',
				// Array of 'value' => 'Image Source' pairs
				'options'  => array(
					'left'  => 'http://placehold.it/90x90&text=Left',
					'right' => 'http://placehold.it/90x90&text=Right',
					'none'  => 'http://placehold.it/90x90&text=None',
				),
				// Allow to select multiple values? Default is false
				// 'multiple' => true,
			),
		),
	);
	return $meta_boxes;
}