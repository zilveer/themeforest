<?php
if( !defined('ABSPATH') ) exit;
if( !function_exists( 'mars_map_videotube_upload' ) ){
	function mars_map_videotube_upload(){
		if( !function_exists( 'vc_map' ) )
			return;
		$args = array(
			'name'	=>	__('Upload Form','mars'),
			'base'	=>	'videotube_upload',
			'category'	=>	__('VideoTube','mars'),
			'class'	=>	'videotube',
			'icon'	=>	'videotube',
			'admin_enqueue_css' => array(get_template_directory_uri().'/assets/css/vc.css'),
			'description'	=>	__('Video Upload Form.','mars'),
			'params'	=>	array(	
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Title','mars'),
					'param_name'	=>	'title',
					'description'	=>	__('This title is not displayed at Frontend.','mars')
				),
				array(
					'type'	=>	'checkbox',
					'holder'	=>	'div',
					'class'	=>	'',
					'param_name'	=>	'vcategory',
					'value'	=>	array( __('Hide Category field','mars') => 'off' )
				),
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Category Exclude','mars'),
					'param_name'	=>	'cat_exclude',
					'dependency'	=>	array(
						'element'	=>	'vcategory',
						'is_empty'	=>	true
					),						
					'description'	=>	__('A string of category ids to exclude, comma-separated ids.','mars')
				),
				array(
					'type'	=>	'textfield',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Category Include','mars'),
					'param_name'	=>	'cat_include',
					'dependency'	=>	array(
						'element'	=>	'vcategory',
						'is_empty'	=>	true
					),
					'description'	=>	__('A string of category ids to include, comma-separated ids.','mars')
				),
				array(
					'type'	=>	'dropdown',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Category Order by','mars'),
					'param_name'	=>	'cat_orderby',
					'dependency'	=>	array(
						'element'	=>	'vcategory',
						'is_empty'	=>	true
					),			
					'value'	=>	array(
						__('ID','mars') 	=>	'id',
						__('Count','mars') => 'count',
						__('Name','mars') => 'name',
						__('Slug','mars') => 'slug'
					)
				),	
				array(
					'type'	=>	'dropdown',
					'holder'	=>	'div',
					'class'	=>	'',
					'heading'	=>	__('Category Order','mars'),
					'param_name'	=>	'cat_order',
					'dependency'	=>	array(
						'element'	=>	'vcategory',
						'is_empty'	=>	true
					),						
					'value'	=>	array(
						__('ASC','mars') 	=>	'ASC',
						__('DESC','mars') => 'DESC'
					)
				),
				array(
					'type'	=>	'checkbox',
					'holder'	=>	'div',
					'class'	=>	'',
					'param_name'	=>	'vtag',
					'value'	=>	array( __('Hide Tag field','mars') => 'off' )
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Extra class name', 'mars' ),
					'param_name' => 'el_class',
					'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'mars' )
				)
			)
		);
		vc_map( $args );
	}	
	add_action( 'init' , 'mars_map_videotube_upload');
}
