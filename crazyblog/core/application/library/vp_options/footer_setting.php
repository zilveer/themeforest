<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Footer_setting_menu {

	public $title = 'Footer Settings';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {
		$return = array(
			array(
				'type' => 'section',
				'title' => esc_html__( 'Footer Settings', 'crazyblog' ),
				'name' => 'footer_settings',
				'description' => esc_html__( 'Footer Settings', 'crazyblog' ),
				'fields' => array(
					array(
						'name' => 'footer_section_1',
						'label' => esc_html__( 'Enable to show Footer Upper Section', 'crazyblog' ),
						'type' => 'toggle',
						'default' => '1',
					),
					array(
						'name' => 'footer_section_3',
						'label' => esc_html__( 'Enable to show Copyright Section', 'crazyblog' ),
						'type' => 'toggle',
						'default' => '1',
					),
					array(
						'type' => 'textarea',
						'name' => 'copyright_text',
						'label' => esc_html__( 'Copyright Text', 'crazyblog' ),
						'description' => esc_html__( 'Please enter copyright text here.', 'crazyblog' ),
						'default' => esc_html__( '&copy; 2015 webinane.com', 'crazyblog' ),
						'dependency' => array(
							'field' => 'footer_section_3',
							'function' => 'vp_dep_boolean',
						),
						'default' => '',
					),
				)
			), // Footer Options
			array(
				'type' => 'section',
				'name' => 'upper_foooter_settings',
				'label' => esc_html__( 'Upper Footer Setting', 'crazyblog' ),
				'fields' => array(
					array(
						'type' => 'upload',
						'name' => 'footer_upper_bg',
						'label' => esc_html__( 'Footer Upper Section Background Image', 'crazyblog' ),
						'description' => esc_html__( 'Choose the image for footer upper section background', 'crazyblog' ),
					),
					array(
						'type' => 'select',
						'name' => 'footer_style',
						'label' => esc_html__( 'Style', 'crazyblog' ),
						'description' => esc_html__( 'Select footer style', 'crazyblog' ),
						'items' => array(
							array( 'label' => esc_html__( 'Style 1', 'crazyblog' ), 'value' => '' ),
							array( 'label' => esc_html__( 'Style 2', 'crazyblog' ), 'value' => 'style2' ),
							array( 'label' => esc_html__( 'Style 3', 'crazyblog' ), 'value' => 'style3' )
						)
					),
					array(
						'type' => 'builder',
						'repeating' => true,
						'sortable' => true,
						'label' =>esc_html__( 'Footer Dynamic Sidebar', 'crazyblog' ),
						'name' => 'footer_dynamic_sidebar',
						'description' =>esc_html__( 'This section is used for sidebars builder', 'crazyblog' ),
						'fields' => array(
							array(
								'type' => 'textbox',
								'name' => 'footer_sidebar_name',
								'label' =>esc_html__( 'Sidebar Name', 'crazyblog' ),
								'description' =>esc_html__( 'Enter the sidebar name.', 'crazyblog' ),
								'default' =>esc_html__( 'Dynamic Sidebar', 'crazyblog' ),
							),
							array(
								'type' => 'select',
								'label' =>esc_html__( 'Footer Sidebar Grid', 'crazyblog' ),
								'name' => 'footer_sidebar_grid',
								'description' =>esc_html__( 'Select the blog list style', 'crazyblog' ),
								'items' => array( array( 'value' => '12', 'label' => '1/1 Grid' ), array( 'value' => '10', 'label' => '5/6 Grid' ), array( 'value' => '9', 'label' => '3/4 Grid' ), array( 'value' => '8', 'label' => '2/3 Grid' ), array( 'value' => '7', 'label' => '12/7 Grid' ), array( 'value' => '6', 'label' => '1/2 Grid' ), array( 'value' => '5', 'label' => '12/5 Grid' ), array( 'value' => '4', 'label' => '1/3 Grid' ), array( 'value' => '3', 'label' => '1/4 Grid' ), array( 'value' => '2', 'label' => '1/6' ) ),
								'description' =>esc_html__( 'Select footer sidebar grid to show its widget', 'crazyblog' ),
							),
						),
					),
				),
				'dependency' => array(
					'field' => 'footer_section_1',
					'function' => 'vp_dep_boolean',
				),
			), // Upper Footer Settings
		);
		return apply_filters( 'crazyblog_vp_opt_footer_', $return );
	}

}
