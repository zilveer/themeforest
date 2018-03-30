<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_social_icons_menu {

	public $title = 'Social Icons';
	public $icon = 'fa-share-alt';

	public function crazyblog_menu() {

		$return = array(
			array(
				'type' => 'builder',
				'repeating' => true,
				'sortable' => true,
				'label' => esc_html__( 'Social Icons', 'crazyblog' ),
				'name' => 'crazyblog_social_icons',
				'description' => esc_html__( 'Add social icons to show', 'crazyblog' ),
				'fields' => array(
					array(
						'type' => 'fontawesome',
						'name' => 'icon',
						'label' => esc_html__( 'Icon', 'crazyblog' ),
						'default' => '',
					),
					array(
						'type' => 'textbox',
						'name' => 'link',
						'label' => esc_html__( 'Link', 'crazyblog' ),
						'default' => '',
					),
					array(
						'type' => 'color',
						'name' => 'icon_color',
						'label' => esc_html__( 'Color', 'crazyblog' ),
						'default' => '',
					),
					array(
						'type' => 'textbox',
						'name' => 'icon_title',
						'label' => esc_html__( 'Title', 'crazyblog' ),
						'default' => '',
					),
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_social_icons_', $return );
	}

}
