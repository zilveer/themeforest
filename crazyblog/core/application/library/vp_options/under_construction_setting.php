<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Under_Construction_setting_menu {

	public $title = 'Under Construction Settings';
	public $icon = 'fa-spinner';

	public function crazyblog_menu() {

		$return = array(
			array(
				'type' => 'section',
				'title' => esc_html__( 'Under Construction Settings', 'crazyblog' ),
				'name' => 'under_construction_settings',
				'description' => esc_html__( 'Under construction page settins', 'crazyblog' ),
				'fields' => array(
					array(
						'name' => 'under_construction_status',
						'label' => esc_html__( 'Enable Under Construction Mode', 'crazyblog' ),
						'type' => 'toggle',
						'default' => 0,
					),
					array(
						'type' => 'date',
						'name' => 'launch_date',
						'label' => esc_html__( 'Date', 'crazyblog' ),
						'description' => esc_html__( 'Choose the Launching Date.', 'crazyblog' ),
						'format' => 'yy/mm/dd',
						'dependency' => array(
							'field' => 'under_construction_status',
							'function' => 'vp_dep_boolean',
						),
						'default' => '',
					),
					array(
						'type' => 'select',
						'name' => 'time_zone',
						'label' => esc_html__( 'Select Your Time Zone', 'crazyblog' ),
						'items' => array(
							'data' => array(
								array(
									'source' => 'function',
									'value' => 'crazyblog_time_zone',
								),
							),
						),
						'dependency' => array(
							'field' => 'under_construction_status',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'upload',
						'name' => 'const_background_image',
						'label' => esc_html__( 'Background Image', 'crazyblog' ),
						'description' => esc_html__( 'Insert the background image for coming soon page', 'crazyblog' ),
						'default' => '',
						'dependency' => array(
							'field' => 'under_construction_status',
							'function' => 'vp_dep_boolean',
						),
					),
				)
			),
			array(
				'type' => 'textbox',
				'name' => 'under_social_icons_section_title',
				'label' => esc_html__( 'Social Icons Section Title', 'crazyblog' ),
				'description' => esc_html__( 'Enter the title for social icons section on coming soon page.', 'crazyblog' ),
				'default' => 'Lets Keep in Touch',
			),
			array(
				'type' => 'builder',
				'repeating' => true,
				'sortable' => true,
				'label' => esc_html__( 'Under Construction Social Icons', 'crazyblog' ),
				'name' => 'under_construction_social_icons',
				'description' => esc_html__( 'Add social icons to show in coming soon page', 'crazyblog' ),
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
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_under_construction_', $return );
	}

}
