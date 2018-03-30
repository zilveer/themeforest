<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_blog_rules_menu {

	public $title = 'Blog Rules';
	public $icon = ' fa-pencil-square';

	public function crazyblog_menu() {

		$return = array(
			array(
				'type' => 'builder',
				'repeating' => true,
				'sortable' => true,
				'label' => esc_html__( 'Blog Rules', 'crazyblog' ),
				'name' => 'crazyblog_blog_rules',
				'description' => esc_html__( 'Add a new rule that is applicable on your blog.', 'crazyblog' ),
				'fields' => array(
					array(
						'type' => 'textbox',
						'name' => 'title',
						'label' => esc_html__( 'Title', 'crazyblog' ),
						'default' => '',
					),
					array(
						'type' => 'textarea',
						'name' => 'desc',
						'label' => esc_html__( 'Description', 'crazyblog' ),
						'default' => '',
					),
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_blog_rules_', $return );
	}

}
