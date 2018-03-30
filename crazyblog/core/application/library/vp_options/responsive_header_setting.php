<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Responsive_header_setting_menu {

	public $title = 'Responsive Header Settings';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {

		$return = array(
			array(
				'type' => 'section',
				'title' => esc_html__( 'Responsive Header Setting', 'crazyblog' ),
				'name' => 'responsive_headers_setting',
				'fields' => array(
					array(
						'type' => 'select',
						'name' => 'responsive_position',
						'label' => esc_html__( 'Positon', 'crazyblog' ),
						'description' => esc_html__( 'Select Responsive Menu Position', 'crazyblog' ),
						'items' => array(
							array( 'label' => esc_html__( 'Left', 'crazyblog' ), 'value' => 'left' ),
							array( 'label' => esc_html__( 'Right', 'crazyblog' ), 'value' => 'right' )
						),
					),
					array(
						'type' => 'toggle',
						'name' => 'responsive_show_ad',
						'label' => esc_html__( 'AD', 'crazyblog' ),
						'description' => esc_html__( 'Show/Hide google Ad in responsive header', 'crazyblog' ),
					),
					array(
						'type' => 'toggle',
						'name' => 'responsive_show_social',
						'label' => esc_html__( 'Social', 'crazyblog' ),
						'description' => esc_html__( 'Show/Hide Social Media Icon in responsive header', 'crazyblog' ),
					),
					array(
						'type' => 'textbox',
						'name' => 'responsive_number_social',
						'label' => esc_html__( 'Number of Social Icon', 'crazyblog' ),
						'description' => esc_html__( 'Enter number of social icon to show in responsive header', 'crazyblog' ),
						'dependency' => array(
							'field' => 'responsive_show_social',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'toggle',
						'name' => 'responsive_show_search',
						'label' => esc_html__( 'Search', 'crazyblog' ),
						'description' => esc_html__( 'Show/Hide Search Button in responsive header', 'crazyblog' ),
					),
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_responsive_header_', $return );
	}

}
