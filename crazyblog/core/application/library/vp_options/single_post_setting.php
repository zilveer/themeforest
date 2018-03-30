<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_Single_Post_setting_menu {

	public $title = 'Single Post Settings';
	public $icon = 'fa-th-large';

	public function crazyblog_menu() {
		$return = array(
			array(
				'type' => 'toggle',
				'name' => 'single_title_section',
				'label' => esc_html__( 'Show Title Section', 'crazyblog' ),
				'description' => esc_html__( 'Enable to show single post title section', 'crazyblog' ),
			),
			array(
				'type' => 'upload',
				'name' => 'single_title_section_bg',
				'label' => esc_html__( 'Title Section Background', 'crazyblog' ),
				'description' => esc_html__( 'Upload background image for single post title section', 'crazyblog' ),
				
				'dependency' => array(
					'field' => 'single_title_section',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'type' => 'radioimage',
				'name' => 'single_sidebar_layout',
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
				'name' => 'single_page_sidebar',
				'label' => esc_html__( 'Sidebar', 'crazyblog' ),
				'description' => esc_html__( 'Select sidebar to show at category page', 'crazyblog' ),
				'items' => crazyblog_get_sidebars( true ),
				'dependency' => array(
					'field' => 'single_sidebar_layout',
					'function' => 'vp_dep_sidebar_boolean',
				),
			),
			array(
				'type' => 'select',
				'name' => 'single_post_author',
				'label' => esc_html__( 'Show Author', 'crazyblog' ),
				'description' => esc_html__( 'Enable to show author on post detail page', 'crazyblog' ),
				'items' => array(
					array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
					array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
				),
				'default' => array( '{{first}}' )
			),
			array(
				'type' => 'select',
				'name' => 'single_post_date',
				'label' => esc_html__( 'Show Date', 'crazyblog' ),
				'description' => esc_html__( 'Enable to show post date on post detail page', 'crazyblog' ),
				'items' => array(
					array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
					array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
				),
				'default' => array( '{{first}}' )
			),
			array(
				'type' => 'select',
				'name' => 'single_post_comment_counter',
				'label' => esc_html__( 'Show Comments Count', 'crazyblog' ),
				'description' => esc_html__( 'Enable to show comments count on post detail page', 'crazyblog' ),
				'items' => array(
					array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
					array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
				),
				'default' => array( '{{first}}' )
			),
			array(
				'type' => 'select',
				'name' => 'single_post_category',
				'label' => esc_html__( 'Show Categories', 'crazyblog' ),
				'description' => esc_html__( 'Enable to show categories on post detail page', 'crazyblog' ),
				'items' => array(
					array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
					array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
				),
				'default' => array( '{{first}}' )
			),
			array(
				'type' => 'select',
				'name' => 'single_post_tags',
				'label' => esc_html__( 'Show Tags', 'crazyblog' ),
				'description' => esc_html__( 'Enable to show tags on post detail page', 'crazyblog' ),
				'items' => array(
					array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
					array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
				),
				'default' => array( '{{first}}' )
			),
			array(
				'type' => 'select',
				'name' => 'single_post_navigation',
				'label' => esc_html__( 'Show Post Naviation', 'crazyblog' ),
				'description' => esc_html__( 'Enable to show Navigation for next/previous post', 'crazyblog' ),
				'items' => array(
					array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
					array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
				),
				'default' => array( '{{first}}' )
			),
			array(
				'type' => 'select',
				'name' => 'single_post_related',
				'label' => esc_html__( 'Show Related Posts', 'crazyblog' ),
				'description' => esc_html__( 'Hide/Show Related Posts post detail page', 'crazyblog' ),
				'items' => array(
					array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
					array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
				),
				'default' => array( '{{first}}' )
			),
			array(
				'type' => 'select',
				'name' => 'single_post_related_type',
				'label' => esc_html__( 'Show Related Posts Type', 'crazyblog' ),
				'description' => esc_html__( 'select the type of related post', 'crazyblog' ),
				'items' => array(
					array( 'value' => 'cat', 'label' => esc_html__( 'Category', 'crazyblog' ) ),
					array( 'value' => 'tag', 'label' => esc_html__( 'Tag', 'crazyblog' ) ),
				),
				'default' => array( '{{first}}' ),
				'dependency' => array(
					'field' => 'single_post_related',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'type' => 'select',
				'name' => 'single_post_authorbox',
				'label' => esc_html__( 'Show Author Box', 'crazyblog' ),
				'description' => esc_html__( 'Hide/Show Author Box in post detail page', 'crazyblog' ),
				'items' => array(
					array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
					array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
				),
				'default' => array( '{{first}}' )
			),
			array(
				'type' => 'select',
				'name' => 'single_post_comments_listing',
				'label' => esc_html__( 'Show Comments Listing', 'crazyblog' ),
				'description' => esc_html__( 'Enable to show comments listing on post detail page', 'crazyblog' ),
				'items' => array(
					array( 'value' => 'show', 'label' => esc_html__( 'Show', 'crazyblog' ) ),
					array( 'value' => 'hide', 'label' => esc_html__( 'Hide', 'crazyblog' ) ),
				),
				'default' => array( '{{first}}' )
			),
		);
		return apply_filters( 'crazyblog_vp_opt_single_post_', $return );
	}

}
