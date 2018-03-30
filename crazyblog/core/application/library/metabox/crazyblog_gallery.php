<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_crazyblog_gallery_Meta {

	static public $options = array();
	static public $title = 'Gallery Options';
	static public $type = array( 'crazyblog_gallery' );
	static public $priority = 'high';

	static public function init() {

		self::$options = array(
			array(
				'type' => 'group',
				'repeating' => false,
				'length' => 1,
				'name' => 'galleries_setting',
				'title' => esc_html__( 'Gallery', 'crazyblog' ),
				'fields' =>
				array(
					array(
						'type' => 'gallery',
						'name' => 'gallery_opt',
						'label' => esc_html__( 'Gallery Images', 'crazyblog' ),
						'description' => esc_html__( 'Upload the images for the gallery', 'crazyblog' ),
					),
				),
			),
		);

		return apply_filters( 'crazyblog_extend_crazyblog_gallery_meta_', self::$options );
	}

}
