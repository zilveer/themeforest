<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_do_category_metaboxes' ) ) {
	/**
	 * Set theme metaboxes
	 *
	 * Allow to add specific style options for each page
	 */
	function wolf_do_category_metaboxes() {
		$category_metaboxes = array(
			array(
				'label' => __( 'Page header type', 'wolf' ),
				'id' =>'page_header_type',
				'type' => 'select',
				'options' => array(
					'' => __( 'Default (set in the options)', 'wolf' ),
					'big' => __( 'Centered page title big height', 'wolf' ),
					'medium' => __( 'Centered page title', 'wolf' ),
					'small' => __( 'Breadcrumb + page title', 'wolf' ),
					'full' => __( 'Full screen', 'wolf' ),
					'none' => __( 'No page title area', 'wolf' ),
				),
			),

			array(
				'label' => __( 'Category page layout', 'wolf' ),
				'id' => 'blog_layout',
				'type' => 'select',
				'options' => array(
					'' => __( 'Default (set in the options)', 'wolf' ),
					'large' => __( 'Large', 'wolf' ),
					'sided' => __( 'Medium Image', 'wolf' ),
					'sidebar' => __( 'Sidebar', 'wolf' ),
					'masonry' => __( 'Masonry', 'wolf' ),
					'grid' => __( 'Grid', 'wolf' ),
				),
			),

			array(
				'label' => __( 'Single post layout', 'wolf' ),
				'id' => 'single_blog_post_layout',
				'type' => 'select',
				'options' => array(
					'' => __( 'Default (set in the options)', 'wolf' ),
					'standard' => __( 'Full Width', 'wolf' ),
					'sidebar' => __( 'Sidebar', 'wolf' ),
					'split' => __( 'Splitted', 'wolf' ),
					'vc' => 'Visual Composer',
				),
				'desc' => __( 'It can be overwritten in category options and single post options', 'wolf' ),
			),

			array(
				'label'	=> __( 'Navigation', 'wolf' ),
				'id'	=> 'post_nav_type',
				'type'	=> 'select',
				'options' => array(
					'' => __( 'Default (set in the options)', 'wolf' ),
					'navigation' => __( 'Previous/Next navigation', 'wolf' ),
					'related' => __( 'Related posts', 'wolf' ),
				),
			),

			array(
				'label'	=> __( 'Background type', 'wolf' ),
				'id'	=> 'header_bg_type',
				'type'	=> 'select',
				'options' => array(
					'image' => __( 'Image', 'wolf' ),
					'video' => __( 'Video', 'wolf' ),
				),
			),

			array(
				'label'	=> __( 'Header background', 'wolf' ),
				'id'	=> 'header_bg',
				'type'	=> 'background',
				'dependency' => array( 'element' => 'header_bg_type', 'value' => array( 'image' ) ),
			),

			array(
				'label'	=> __( 'Header background effect', 'wolf' ),
				'id'	=> 'header_bg_effect',
				'type'	=> 'select',
				'options' => array(
					'parallax' => __( 'Parallax', 'wolf' ),
					'zoomin' => __( 'Zoom', 'wolf' ),
					'none' => __( 'None', 'wolf' ),
				),
				'dependency' => array( 'element' => 'header_bg_type', 'value' => array( 'image' ) ),
			),

			array(
				'label'	=> __( 'Video Background type', 'wolf' ),
				'id'	=> 'header_video_bg_type',
				'type'	=> 'select',
				'options' => array(
					'selfhosted' => __( 'Self hosted', 'wolf' ),
					'youtube' => 'Youtube',
				),
			),

			array(
				'label'	=> __( 'Youtube URL', 'wolf' ),
				'id'	=> 'header_video_bg_youtube_url',
				'type'	=> 'text',
			),

			array(
				'label'	=> __( 'Video background', 'wolf' ),
				'id'	=> 'header_video_bg',
				'type'	=> 'video',
				'dependency' => array( 'element' => 'header_bg_type', 'value' => array( 'video' ) ),
			),

			array(
				'label'	=> __( 'Overlay color', 'wolf' ),
				'id'	=> 'header_overlay_color',
				'type'	=> 'colorpicker',
			),

			array(
				'label'	=> __( 'Overlay pattern', 'wolf' ),
				'id'	=> 'header_overlay_img',
				'type'	=> 'image',
			),

			array(
				'label'	=> __( 'Overlay opacity (in percent)', 'wolf' ),
				'id'	=> 'header_overlay_opacity',
				'desc'	=> __( 'Adapt the header overlay opacity if needed', 'wolf' ),
				'type'	=> 'int',
			),
		);
		$wolf_do_category_metaboxes = new Wolf_Theme_Admin_Category_Meta( $category_metaboxes );
	}
	wolf_do_category_metaboxes();
}
