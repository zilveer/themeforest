<?php
if( !class_exists( 'SATURN_metaboxes' ) ){
	class SATURN_metaboxes {
		function __construct() {
			add_action( 'init' , array( $this ,'load_cmb_Meta_Box' ), 9999);
			add_filter( 'cmb_meta_boxes', array( $this ,'metaboxes' ) );
		}
		function load_cmb_Meta_Box(){
			if ( ! class_exists( 'cmb_Meta_Box' ) )
				require_once ( get_template_directory() . '/includes/metaboxes/init.php');		
		}
		function metaboxes( array $meta_boxes ){
			$prefix = 'saturn_';
			$fields = array();
			$fields[]	=	array(
				'name'    => __( 'Cover Screen', 'saturn' ),
				'desc'    => __( 'Setup the Cover Screen', 'saturn' ),
				'id'      => $prefix . 'cover_screen',
				'type'    => 'select',
				'options' => array(
					'' => __( 'No, leave blank for default settings', 'saturn' ),
					'image'   => __( 'Image', 'saturn' ),
					'video'     => __( 'Video', 'saturn' ),
				)
			);
			$fields[] = array(
				'name' => __( 'Image', 'saturn' ),
				'desc' => __( 'Upload an image or enter a URL.', 'saturn' ),
				'id'      => $prefix . 'cover_screen_imageurl',
				'type' => 'file'
			);
			$fields[] = array(
				'name' => __( 'Youtube Video URL', 'saturn' ),
				'desc' => __('Youtube only, <i>This player doesn’t work as background for devices due to the restriction policy adopted by all on managing multimedia files via javascript. It fallsback to the default Youtube player if used as player</i>','saturn'),
				'id'      => $prefix . 'cover_screen_videourl',
				'type' => 'text'
			);
			$fields[] = array(
				'name' => __( 'Heading', 'saturn' ),
				'desc' => __( 'Replace the heading default by this text.', 'saturn' ),
				'id'      => $prefix . 'cover_screen_heading',
				'type' => 'text'
			);
			$fields[] = array(
				'name' => __( 'Sub-Heading', 'saturn' ),
				'desc' => __( 'Replace the sub heading default by this text.', 'saturn' ),
				'id'      => $prefix . 'cover_screen_subheading',
				'type' => 'text'
			);
								
			$meta_boxes['saturn']	=	array(
				'id'         => $prefix . 'saturn',
				'title'      => __( 'Advanced Options', 'saturn' ),
				'pages'      => array( 'post', 'page', 'product' ), // Post type
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				// 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
				'fields'     => $fields
			);		
			
			return $meta_boxes;
		}
	}
	new SATURN_metaboxes();
}