<?php
add_action( 'admin_init', 'test_register_meta_boxes' );
function test_register_meta_boxes()
{
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;
	$meta_box = array(
		'title'  => esc_html__( 'Google Map', 'ievent' ),
		'fields' => array(
			array(
				'id'            => 'address',
				'name'          => esc_html__( 'Address', 'ievent' ),
				'type'          => 'text',
				'std'           => esc_html__( 'Hanoi, Vietnam', 'ievent' ),
			),
			array(
				'id'            => 'loc',
				'name'          => esc_html__( 'Location', 'ievent' ),
				'type'          => 'map',
				'std'           => '-6.233406,-35.049906,15',     // 'latitude,longitude[,zoom]' (zoom is optional)
				'style'         => 'width: 500px; height: 500px',
				'address_field' => 'address',                     // Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)
			),
		),
	);
	new RW_Meta_Box( $meta_box );
}
