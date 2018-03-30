<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_404_setting_menu {

	public $title = '404 Page Settings';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {

		$return = array(
			array(
				'type' => 'section',
				'title' => esc_html__( '404 Page Settings', 'crazyblog' ),
				'name' => '404_page_settings',
				'fields' => array(
					array(
						'type' => 'upload',
						'name' => '404_page_title_bg',
						'label' => esc_html__( 'Title Background Image', 'crazyblog' ),
						'description' => esc_html__( 'Insert the background image for 404 page title section', 'crazyblog' ),
						'default' => ''
					),
					array(
						'type' => 'textbox',
						'name' => '404_page_title',
						'label' => esc_html__( 'Page Title', 'crazyblog' ),
						'description' => esc_html__( 'Enter the title for 404 page', 'crazyblog' ),
						'default' => ''
					),
					array(
						'type' => 'textarea',
						'name' => '404_page_description',
						'label' => esc_html__( '404 Page Description', 'crazyblog' ),
						'description' => esc_html__( 'Enter the description for 404 page', 'crazyblog' ),
						'default' => ''
					),
					array(
						'type' => 'toggle',
						'name' => '404_contact_button',
						'label' => esc_html__( 'Show Contact Us', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show contact us button on 404 page', 'crazyblog' ),
					),
					array(
						'type' => 'textbox',
						'name' => '404_contact_button_label',
						'label' => esc_html__( 'Contact Button Label', 'crazyblog' ),
						'description' => esc_html__( 'Enter the label contact button on 404 page', 'crazyblog' ),
						'default' => esc_html__( 'Send Message', 'crazyblog' ),
						'dependency' => array(
							'field' => '404_contact_button',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'select',
						'name' => '404_contact_page',
						'label' => esc_html__( 'Contact Page', 'crazyblog' ),
						'description' => esc_html__( 'Select the page for contact us button to redirect the user', 'crazyblog' ),
						'default' => '',
						'items' => crazyblog_posts_array( 'page', true ),
						'dependency' => array(
							'field' => '404_contact_button',
							'function' => 'vp_dep_boolean',
						),
					),
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_blog_', $return );
	}

}
