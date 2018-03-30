<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Category_setting_menu {

	public $title = 'Category Settings';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {

		$return = array(
			array(
				'type' => 'section',
				'title' => esc_html__( 'Category Page Settings', 'crazyblog' ),
				'name' => 'cat_page_settings',
				'fields' => array(
					array(
						'type' => 'toggle',
						'name' => 'cat_page_title_section',
						'label' => esc_html__( 'Show Title Section', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show Category page title section', 'crazyblog' ),
					),
//					array(
//						'type' => 'textbox',
//						'name' => 'cat_page_title',
//						'label' => esc_html__( 'Page Title', 'crazyblog' ),
//						'description' => esc_html__( 'Enter the title for category page', 'crazyblog' ),
//						'dependency' => array(
//							'field' => 'cat_page_title_section',
//							'function' => 'vp_dep_boolean',
//						),
//						'default' => ''
//					),
					array(
						'type' => 'upload',
						'name' => 'cat_title_section_bg',
						'label' => esc_html__( 'Title Section Background', 'crazyblog' ),
						'description' => esc_html__( 'Upload background image for page title section', 'crazyblog' ),
						'dependency' => array(
							'field' => 'cat_page_title_section',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'radioimage',
						'name' => 'cat_sidebar_layout',
						'label' => esc_html__( 'Category Page Layout', 'crazyblog' ),
						'description' => esc_html__( 'Choose the layout for category pages', 'crazyblog' ),
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
						'name' => 'cat_page_sidebar',
						'label' => esc_html__( 'Sidebar', 'crazyblog' ),
						'description' => esc_html__( 'Select sidebar to show at category page', 'crazyblog' ),
						'items' => crazyblog_get_sidebars( true ),
						'dependency' => array(
							'field' => 'cat_sidebar_layout',
							'function' => 'vp_dep_sidebar_boolean',
						),
					),
					array(
						'type' => 'select',
						'name' => 'cat_post_column',
						'label' => esc_html__( 'Column', 'crazyblog' ),
						'description' => esc_html__( 'Choose the number of column to show posts for category page (Note: This option will not work with "Gallery" Post Format', 'crazyblog' ),
						'items' => array(
							array(
								'value' => 'col-md-12',
								'label' => esc_html__( 'One Column', 'crazyblog' ),
							),
							array(
								'value' => 'col-md-6',
								'label' => esc_html__( 'Two Column', 'crazyblog' ),
							),
							array(
								'value' => 'col-md-4',
								'label' => esc_html__( 'Three Column', 'crazyblog' ),
							),
							array(
								'value' => 'col-md-3',
								'label' => esc_html__( 'Four Column', 'crazyblog' ),
							),
						),
						'default' => array( 'col-md-12' ),
					),
					array(
						'type' => 'select',
						'name' => 'cat_post_comments',
						'label' => esc_html__( 'Show Comments Count', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show comments count on post', 'crazyblog' ),
						'items' => array(
							array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
							array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
						),
						'default' => array( '{{first}}' )
					),
					array(
						'type' => 'select',
						'name' => 'cat_post_author',
						'label' => esc_html__( 'Show Author', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show author on post', 'crazyblog' ),
						'items' => array(
							array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
							array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
						),
						'default' => array( '{{first}}' )
					),
					array(
						'type' => 'select',
						'name' => 'cat_post_date',
						'label' => esc_html__( 'Show Post Date', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show post date on post', 'crazyblog' ),
						'items' => array(
							array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
							array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
						),
						'default' => array( '{{first}}' )
					),
					array(
						'type' => 'select',
						'name' => 'cat_post_view',
						'label' => esc_html__( 'Show Post View', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show post views', 'crazyblog' ),
						'items' => array(
							array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
							array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
						),
						'default' => array( '{{first}}' )
					),
					array(
						'type' => 'select',
						'name' => 'cat_post_category',
						'label' => esc_html__( 'Show Post Category', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show post categories', 'crazyblog' ),
						'items' => array(
							array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
							array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
						),
						'default' => array( '{{first}}' )
					),
					array(
						'type' => 'select',
						'name' => 'cat_post_social_share',
						'label' => esc_html__( 'Show Post Sharing', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show post social sharing icons', 'crazyblog' ),
						'items' => array(
							array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
							array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
						),
						'default' => array( '{{first}}' )
					),
					array(
						'type' => 'textbox',
						'name' => 'cat_character_limit',
						'label' => esc_html__( 'Character Limit', 'crazyblog' ),
						'description' => esc_html__( 'Enter the character limit for the content of post', 'crazyblog' ),
						'default' => '300'
					),
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_category_', $return );
	}

}
