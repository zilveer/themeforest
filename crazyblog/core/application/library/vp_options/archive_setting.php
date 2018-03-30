<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Archive_setting_menu {

	public $title = 'Archive Settings';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {

		$return = array(
			array(
				'type' => 'section',
				'title' => esc_html__( 'Archive Page Settings', 'crazyblog' ),
				'name' => 'archive_page_settings',
				'fields' => array(
					array(
						'type' => 'toggle',
						'name' => 'archive_page_title_section',
						'label' => esc_html__( 'Show Title Section', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show Archive page title section', 'crazyblog' ),
					),
					array(
						'type' => 'textbox',
						'name' => 'archive_page_title',
						'label' => esc_html__( 'Page Title', 'crazyblog' ),
						'description' => esc_html__( 'Enter the title for archive page', 'crazyblog' ),
						'dependency' => array(
							'field' => 'archive_page_title_section',
							'function' => 'vp_dep_boolean',
						),
						'default' => ''
					),
					array(
						'type' => 'upload',
						'name' => 'archive_title_section_bg',
						'label' => esc_html__( 'Title Section Background', 'crazyblog' ),
						'description' => esc_html__( 'Upload background image for page title section', 'crazyblog' ),
						
						'dependency' => array(
							'field' => 'archive_page_title_section',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'radioimage',
						'name' => 'archive_sidebar_layout',
						'label' => esc_html__( 'Archive Page Layout', 'crazyblog' ),
						'description' => esc_html__( 'Choose the layout for archive pages', 'crazyblog' ),
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
						'name' => 'archive_page_sidebar',
						'label' => esc_html__( 'Sidebar', 'crazyblog' ),
						'description' => esc_html__( 'Select sidebar to show at archive page', 'crazyblog' ),
						'items' => crazyblog_get_sidebars( true ),
						'dependency' => array(
							'field' => 'archive_sidebar_layout',
							'function' => 'vp_dep_sidebar_boolean',
						),
					),
					array(
						'type' => 'select',
						'name' => 'archive_post_column',
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
						'name' => 'archive_post_comments',
						'label' => esc_html__( 'Show Comments Count', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show comments count on posts listing', 'crazyblog' ),
						'items' => array(
							array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
							array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
						),
						'default' => array( '{{first}}' )
					),
					array(
						'type' => 'select',
						'name' => 'archive_post_author',
						'label' => esc_html__( 'Show Author', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show author on posts listing', 'crazyblog' ),
						'items' => array(
							array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
							array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
						),
						'default' => array( '{{first}}' )
					),
					array(
						'type' => 'select',
						'name' => 'archive_post_date',
						'label' => esc_html__( 'Show Post Date', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show post datea on posts listing', 'crazyblog' ),
						'items' => array(
							array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
							array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
						),
						'default' => array( '{{first}}' )
					),
					array(
						'type' => 'select',
						'name' => 'archive_post_view',
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
						'name' => 'archive_post_category',
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
						'name' => 'archive_post_social_share',
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
						'name' => 'archive_character_limit',
						'label' => esc_html__( 'Character Limit', 'crazyblog' ),
						'description' => esc_html__( 'Enter the character limit for the content of post listing', 'crazyblog' ),
						'default' => '300'
					),
				),
			),
		);

		return apply_filters( 'crazyblog_vp_opt_archive_', $return );
	}

}
