<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_newsletter_shortcode_menu {

	public $title = 'Newsletter Shortcode';
	public $icon = 'fa-envelope-o';

	public function crazyblog_menu() {

		$return = array(
			array(
				'type' => 'builder',
				'repeating' => true,
				'sortable' => true,
				'label' => esc_html__( 'Newsletter Social Icons', 'crazyblog' ),
				'name' => 'newsletter_social_icons',
				'description' => esc_html__( 'Add social icons to show in newsletter shortcode', 'crazyblog' ),
				'fields' => array(
					array(
						'type' => 'textbox',
						'name' => 'title',
						'label' => esc_html__( 'Title', 'crazyblog' ),
						'default' => '',
					),
					array(
						'type' => 'icon',
						'name' => 'icon',
						'label' => esc_html__( 'Icon', 'crazyblog' ),
						'default' => '',
					),
					array(
						'type' => 'color',
						'name' => 'icon_color',
						'label' => esc_html__( 'Icon Color', 'crazyblog' ),
						'description' => esc_html__( 'Choose the color for social icon', 'crazyblog' ),
						'default' => '',
					),
					array(
						'type' => 'textbox',
						'name' => 'link',
						'label' => esc_html__( 'Link', 'crazyblog' ),
						'default' => '',
					),
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_newletter_shortcodes_', $return );
	}

}
