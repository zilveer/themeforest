<?php
add_filter( 'rwmb_meta_boxes', 'PREFIX_register_meta_box_url' );
function PREFIX_register_meta_box_url( $meta_boxes )
{
	$meta_boxes[] = array(
		'title' => esc_html__( 'URL Demo', 'ievent' ),
		'fields' => array(
			array(
				'id'       => 'url',
				'name'     => esc_url__( 'URL(s)', 'ievent' ),
				'type'     => 'url',
				// Allow to clone? Default is false
				// 'clone' => true,
			),
		),
	);
	return $meta_boxes;
}