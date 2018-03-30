<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Shop_tag_setting_menu {

	public $title = 'Shop Tag Settings';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {

		$return = array(
			array(
				'type' => 'section',
				'title' => esc_html__( 'Shop Tag Settings', 'crazyblog' ),
				'name' => 'shop_tag_settings',
				'fields' => array(
					array(
						'type' => 'toggle',
						'name' => 'shop_tag_title_section',
						'label' => esc_html__( 'Show Title Section', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show shop tag title section', 'crazyblog' ),
					),
					array(
						'type' => 'textbox',
						'name' => 'shop_tag_title',
						'label' => esc_html__( 'Shop Tag Title', 'crazyblog' ),
						'description' => esc_html__( 'Enter the title for shop tag', 'crazyblog' ),
						'dependency' => array(
							'field' => 'shop_tag_title_section',
							'function' => 'vp_dep_boolean',
						),
						'default' => ''
					),
					array(
						'type' => 'upload',
						'name' => 'shop_tag_title_section_bg',
						'label' => esc_html__( 'Title Section Background', 'crazyblog' ),
						'description' => esc_html__( 'Upload background image for shop title section', 'crazyblog' ),
						
						'dependency' => array(
							'field' => 'shop_tag_title_section',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'radioimage',
						'name' => 'shop_tag_sidebar_layout',
						'label' => esc_html__( 'Shop Tag Layout', 'crazyblog' ),
						'description' => esc_html__( 'Choose the layout for shop tag', 'crazyblog' ),
						'items' => array(
							array(
								'value' => 'left',
								'label' => esc_html__( 'Left Sidebar', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/2cl.png',
							),
							array(
								'value' => 'right',
								'label' => esc_html__( 'Right Sidebar', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/2cr.png',
							),
							array(
								'value' => 'full',
								'label' => esc_html__( 'Full Width', 'crazyblog' ),
								'img' => crazyblog_URI . 'core/duffers_panel/panel/public/img/1col.png',
							),
						),
					),
					array(
						'type' => 'select',
						'name' => 'shop_tag_sidebar',
						'label' => esc_html__( 'Sidebar', 'crazyblog' ),
						'description' => esc_html__( 'Select sidebar to show at shop tag', 'crazyblog' ),
						'items' => crazyblog_get_sidebars( true ),
						'dependency' => array(
							'field' => 'shop_tag_sidebar_layout',
							'function' => 'vp_dep_sidebar_boolean',
						),
					),
					array(
						'type' => 'select',
						'name' => 'shop_tag_col',
						'label' => esc_html__( 'Shop Tag Product Column', 'crazyblog' ),
						'description' => esc_html__( 'Select shop tag products column', 'crazyblog' ),
						'items' => array(
							array( 'label' => esc_html__( '2 Column', 'crazyblog' ), 'value' => 'col-md-6' ),
							array( 'label' => esc_html__( '3 Column', 'crazyblog' ), 'value' => 'col-md-4' ),
							array( 'label' => esc_html__( '4 Column', 'crazyblog' ), 'value' => 'col-md-3' ),
						),
					),
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_shop_tag_', $return );
	}

}
