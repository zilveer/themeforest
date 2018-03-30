<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_page_Meta {

	static public $options = array();
	static public $title = 'Page Options';
	static public $type = array( 'page', 'product' );
	static public $priority = 'high';

	static public function init() {

		self::$options = array(
			array(
				'type' => 'toggle',
				'name' => 'page_upper_section',
				'label' => esc_html__( 'Show Header Upper Section', 'crazyblog' ),
			),
			array(
				'type' => 'toggle',
				'name' => 'page_title_section',
				'label' => esc_html__( 'Show Page Title Section', 'crazyblog' ),
				'description' => esc_html__( 'Enable to show page title section', 'crazyblog' ),
			),
			array(
				'type' => 'upload',
				'name' => 'title_section_bg',
				'label' => esc_html__( 'Title Section Background', 'crazyblog' ),
				'description' => esc_html__( 'Upload background image for page title section', 'crazyblog' ),
				'dependency' => array(
					'field' => 'page_title_section',
					'function' => 'vp_dep_boolean',
				),
			),
			array(
				'type' => 'radioimage',
				'name' => 'layout',
				'label' => esc_html__( 'Page Layout', 'crazyblog' ),
				'description' => esc_html__( 'Choose the layout for this page', 'crazyblog' ),
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
				'name' => 'sidebar',
				'label' => esc_html__( 'Sidebar', 'crazyblog' ),
				'description' => esc_html__( 'Select sidebar to show at this page', 'crazyblog' ),
				'items' => crazyblog_get_sidebars( true ),
				'dependency' => array(
					'field' => 'layout',
					'function' => 'vp_dep_sidebar_boolean',
				),
			),
		);



		return apply_filters( 'crazyblog_extend_page_meta_', self::$options );
	}

}

// Post Meta Filter



/*add_filter('crazyblog_extend_post_meta_', 'sh_test');

 function sh_test( $meta )

 {

  $clone = crazyblog_set( crazyblog_set( $meta, '0' ), 'fields' );

  $ext = array(

      array(

       'type' => 'toggle',

       'name' => 'fixed_sidebarsssss',

       'label' => esc_html__('fixed_sidebarssssssssss', 'crazyblog'),

       'default' => '',

       'dependency' => array(

        'field' => 'sidebar',

        'function' => 'vp_dep_boolean',

       ),

      )

     );

  $new_val = array_merge_recursive( $clone, $ext );

  $test  = array( '0' => array( 'fields' => $new_val ) );

  

  $a = array_replace_recursive( $meta, $test );

  return $a;

 }*/