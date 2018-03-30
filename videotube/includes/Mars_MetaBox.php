<?php
/**
 * VideoTube MetaBox
 * Add Video MetaBox, ACF is required.
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;
if( !class_exists('Mars_MetaBox') ){
	class Mars_MetaBox {
		function __construct() {
			add_action('admin_init', array($this,'video_metabox'));
			add_filter( 'mars_video_type' , array( $this, 'video_type' ), 20, 1);
			add_filter( 'mars_video_object' , array( $this, 'video_object' ), 20, 1 );
		}
		
		function video_type( $post_id ){
			if( !isset( $post_id ) || get_post_type( $post_id ) != 'video' )
				return;
			// first check the File field.
			$type = get_post_meta( $post_id, 'video_file', true ) ? true : false;
			if( $type == true ){
				return 'files';
			}
			return 'normal';
		}
		
		function video_object($post_id){
			if( !isset( $post_id ) || get_post_type( $post_id ) != 'video' )
				return;
			$video_object = get_post_meta( $post_id, 'video_frame', true ) ? get_post_meta( $post_id, 'video_frame', true ) : null;
			return get_post_meta( $post_id, 'video_url', true ) ? get_post_meta( $post_id, 'video_url', true ) : $video_object;
		}
		
		function video_metabox(){
			global $wp_post_types;
			$exclude_pt = array('revision','nav_menu_item','acf','attachment','deprecated_log','page');
			$post_id = isset( $_REQUEST['post'] ) ? (int)$_REQUEST['post'] : null;
			$post_type_array = array();
			foreach ( $wp_post_types as $pt ) {
				if( !empty( $pt->name ) && !in_array( $pt->name, $exclude_pt ) ){
					$post_type_array[ $pt->name ] = $pt->label;
				}
			}
			
			$fields_array	=	array (
				'id' => 'acf_video',
				'title' => 'Video',
				'fields' => array (
					array (
						'key' => 'field_531980e906752',
						'label' => __('Layout','mars'),
						'name' => 'layout',
						'type' => 'select',
						'choices' => array (
							'small' => __('Small','mars'),
							'large' => __('Large','mars'),
						),
						'default_value' => apply_filters( 'mars_video_default_layout' , 'small'),
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_53eb79f33936e',
						'label' => __('Choose the Video type','mars'),
						'name' => 'video_type',
						'type' => 'select',
						'choices' => array (
							'normal' => 'Link/iFrame Code',
							'files' => 'Files',
						),
						'default_value' => isset( $_GET['post'] ) ?  apply_filters( 'mars_video_type' , $_GET['post']) : 'normal',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_53eb7a453936f',
						'label' => __('Enter the link or embed code here','mars'),
						'name' => 'video_url',
						'type' => 'textarea',
						'instructions' => __('Here you can put multiple video object, one object/line.','mars'),
						'conditional_logic' => array (
						'status' => 1,
						'rules' => array (
							array (
								'field' => 'field_53eb79f33936e',
								'operator' => '==',
								'value' => 'normal',
							),
						),
						'allorany' => 'all',
						),
						'default_value' =>  '',
						'value'		=>	isset( $_GET['post'] ) ? apply_filters( 'mars_video_object' , $_GET['post']) : null,
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'none',
					),
					array (
						'key' => 'field_53eb7aae942ae',
						'label' => __('Upload your files here','mars'),
						'name' => 'video_file',
						'type' => 'gallery',
						'conditional_logic' => array (
						'status' => 1,
						'rules' => array (
							array (
								'field' => 'field_53eb79f33936e',
								'operator' => '==',
								'value' => 'files',
							),
						),
						'allorany' => 'all',
						),
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'video',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'acf_after_title',
					'layout' => 'default',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			);
			
			if(function_exists("register_field_group")){
				register_field_group( apply_filters( 'videotube_video_meta_fields_args' , $fields_array ) );
				register_field_group(array (
					'id' => 'acf_post-type',
					'title' => __('Post Type','mars'),
					'fields' => array (
						array (
							'key' => 'field_535765e9e7089',
							'label' => __('Post Type','mars'),
							'name' => 'videotube_post_type',
							'type' => 'select',
							'instructions' => __('This option is used in infinity rolling page. ','mars'),
							'choices' => $post_type_array,
							'default_value' => '',
							'allow_null' => 0,
							'multiple' => 0,
						),
					),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'page',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
						'position' => 'side',
						'layout' => 'default',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 10,
				));				
			}
		}
	}
	new Mars_MetaBox();
}
