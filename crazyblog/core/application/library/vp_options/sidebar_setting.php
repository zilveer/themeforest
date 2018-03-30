<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_sidebar_setting_menu {

	public $title = 'Sidebars Settings';
	public $icon = 'fa-list-ol';

	public function crazyblog_menu() {

		$return = array(
			array(
				'type' => 'builder',
				'repeating' => true,
				'sortable' => true,
				'label' => esc_html__( 'Dynamic Sidebar', 'crazyblog' ),
				'name' => 'dynamic_sidebar',
				'description' => esc_html__( 'This section is used for theme color settings', 'crazyblog' ),
				'fields' => array(
					array(
						'type' => 'textbox',
						'name' => 'sidebar_name',
						'label' => esc_html__( 'Sidebar Name', 'crazyblog' ),
						'description' => esc_html__( 'Choose the default color scheme for the theme.', 'crazyblog' ),
						'default' => esc_html__( 'Dynamic Sidebar', 'crazyblog' ),
					),
				),
			),
		);



		return apply_filters( 'crazyblog_vp_opt_sidebar_', $return );
	}

}
