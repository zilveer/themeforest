<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_recipe_Meta {

	static public $options = array();
	static public $title = 'Recipe Options';
	static public $type = array( 'crazyblog_recipe' );
	static public $priority = 'high';

	static public function init() {

		self::$options = array(
			array(
				'type' => 'toggle',
				'name' => 'post_title_section',
				'label' => esc_html__( 'Show Page Title Section', 'crazyblog' ),
				'description' => esc_html__( 'Enable to show page title section', 'crazyblog' ),
			),
			array(
				'type' => 'upload',
				'name' => 'title_section_bg',
				'label' => esc_html__( 'Title Section Background', 'crazyblog' ),
				'description' => esc_html__( 'Upload background image for page title section', 'crazyblog' ),
				'dependency' => array(
					'field' => 'post_title_section',
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
			// start for recipe
			array(
				'type' => 'group',
				'repeating' => false,
				'length' => 1,
				'name' => 'crazyblog_recipe_options',
				'title' => esc_html__( 'Recipe Settings', 'crazyblog' ),
				'fields' =>
				array(
					array(
						'type' => 'textbox',
						'name' => 'crazyblog_chief_name',
						'label' => esc_html__( 'Chief Name', 'crazyblog' ),
						'description' => esc_html__( 'Enter the chief name of this recipe', 'crazyblog' ),
					),
					array(
						'type' => 'upload',
						'name' => 'crazyblog_chief_avatar',
						'label' => esc_html__( 'Chief Avatar', 'crazyblog' ),
						'description' => esc_html__( 'Upload the chief avatar', 'crazyblog' ),
					),
					array(
						'type' => 'textbox',
						'name' => 'crazyblog_recipe_video',
						'label' => esc_html__( 'Recipe Video Url', 'crazyblog' ),
						'description' => esc_html__( 'Enter youtube, vimeo or dailymotion vidoe ifrmae src', 'crazyblog' ),
					),
					array(
						'type' => 'textbox',
						'name' => 'crazyblog_recipe_serve',
						'label' => esc_html__( 'Recipe Serve For', 'crazyblog' ),
						'description' => esc_html__( 'Enter the number of serve for like "4-6"', 'crazyblog' ),
					),
					array(
						'type' => 'textbox',
						'name' => 'crazyblog_recipe_prep_time',
						'label' => esc_html__( 'Preparition Time', 'crazyblog' ),
						'description' => esc_html__( 'Enter the preparition time for this recipe', 'crazyblog' ),
					),
					array(
						'type' => 'textbox',
						'name' => 'crazyblog_recipe_cook_time',
						'label' => esc_html__( 'Cook Time', 'crazyblog' ),
						'description' => esc_html__( 'Enter the cook time for this recipe', 'crazyblog' ),
					),
					array(
						'type' => 'textbox',
						'name' => 'crazyblog_recipe_total_time',
						'label' => esc_html__( 'Total Time', 'crazyblog' ),
						'description' => esc_html__( 'Enter the Total time for this recipe', 'crazyblog' ),
					),
					array(
						'type' => 'textbox',
						'name' => 'crazyblog_recipe_heat',
						'label' => esc_html__( 'Preheat', 'crazyblog' ),
						'description' => esc_html__( 'Enter preheat the oven for this recipe like "375 f"', 'crazyblog' ),
					),
					array(
						'type' => 'upload',
						'name' => 'crazyblog_recipe_info_img',
						'label' => esc_html__( 'Recipe Info Image', 'crazyblog' ),
						'description' => esc_html__( 'Upload Recipe Info image', 'crazyblog' ),
					),
					array(
						'type' => 'group',
						'repeating' => true,
						'length' => 1,
						'name' => 'crazyblog_recipe_info',
						'title' => esc_html__( 'Recipe Info', 'crazyblog' ),
						'fields' => array(
							array(
								'type' => 'upload',
								'name' => 'crazyblog_recipe_info_img',
								'label' => esc_html__( 'Image', 'crazyblog' ),
							),
							array(
								'type' => 'textbox',
								'name' => 'crazyblog_recipe_quantity',
								'label' => esc_html__( 'Recipe Ingredient', 'crazyblog' ),
							)
						)
					),
					// start instruction
					array(
						'type' => 'group',
						'repeating' => true,
						'length' => 1,
						'name' => 'crazyblog_instruction',
						'title' => esc_html__( 'Recipe Instruction', 'crazyblog' ),
						'fields' => array(
							array(
								'type' => 'textbox',
								'name' => 'crazyblog_recipe_ins',
								'label' => esc_html__( 'Instruction', 'crazyblog' ),
								'description' => esc_html__( 'Enter Instruction', 'crazyblog' ),
							),
						)
					),
				)
			),
				// end for recipe
		);



		return apply_filters( 'crazyblog_extend_post_meta_', self::$options );
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