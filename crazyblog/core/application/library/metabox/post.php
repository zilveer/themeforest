<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_post_Meta {

	static public $options = array();
	static public $title = 'Post Options';
	static public $type = array( 'post' );
	static public $priority = 'high';

	static public function init() {

		self::$options = array(
			array(
				'type' => 'group',
				'repeating' => false,
				'length' => 1,
				'name' => 'crazyblog_post_options',
				'title' => esc_html__( 'General Post Settings', 'crazyblog' ),
				'fields' =>
				array(
					array(
						'type' => 'toggle',
						'name' => 'post_title_section',
						'label' => esc_html__( 'Show Post Title Section', 'crazyblog' ),
						'description' => esc_html__( 'Enable to show post title banner section', 'crazyblog' ),
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
						'label' => esc_html__( 'Post Layout', 'crazyblog' ),
						'description' => esc_html__( 'Choose the layout for post detail page', 'crazyblog' ),
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
						'description' => esc_html__( 'Select sidebar to show at post detail page', 'crazyblog' ),
						'items' => crazyblog_get_sidebars( true ),
						'dependency' => array(
							'field' => 'layout',
							'function' => 'vp_dep_sidebar_boolean',
						),
					),
				),
			),
			array(
				'type' => 'group',
				'repeating' => false,
				'length' => 1,
				'name' => 'crazyblog_post_format_options',
				'title' => esc_html__( 'Post Format Settings', 'crazyblog' ),
				'fields' => array(
					array(
						'type' => 'toggle',
						'name' => 'crazyblog_post_toggle_audio_own',
						'label' => esc_html__( 'Own Audio', 'crazyblog' ),
						'description' => esc_html__( 'Select the given methods for audio post.', 'crazyblog' ),
					),
					array(
						'type' => 'upload',
						'name' => 'crazyblog_post_audio_own',
						'label' => esc_html__( 'Upload', 'crazyblog' ),
						'description' => esc_html__( 'Upload your own audio file, must be MP3 Format only.', 'crazyblog' ),
						'dependency' => array(
							'field' => 'crazyblog_post_toggle_audio_own',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'toggle',
						'name' => 'crazyblog_post_toggle_audio_link',
						'label' => esc_html__( 'SoundCloud', 'crazyblog' ),
						'description' => esc_html__( 'Select the given methods for audio post.', 'crazyblog' ),
					),
					array(
						'type' => 'textbox',
						'name' => 'crazyblog_post_audio_link',
						'label' => esc_html__( 'Audio ID', 'crazyblog' ),
						'description' => esc_html__( 'paste audio id from soundcloud', 'crazyblog' ),
						'dependency' => array(
							'field' => 'crazyblog_post_toggle_audio_link',
							'function' => 'vp_dep_boolean',
						),
					),
					array(
						'type' => 'textbox',
						'name' => 'crazyblog_post_video_link',
						'label' => esc_html__( 'Video', 'crazyblog' ),
						'description' => esc_html__( 'paste video embed link from youtube, vimeo, dailymotion', 'crazyblog' ),
					),
					array(
						'type' => 'textbox',
						'name' => 'crazyblog_link_post',
						'label' => esc_html__( 'Link', 'crazyblog' ),
						'description' => esc_html__( 'paste any link here for link post', 'crazyblog' ),
					),
					array(
						'type' => 'textarea',
						'name' => 'crazyblog_quote_post',
						'label' => esc_html__( 'Quote', 'crazyblog' ),
						'description' => esc_html__( 'paste any quote here for quote post', 'crazyblog' ),
					),
					array(
						'type' => 'gallery',
						'name' => 'crazyblog_post_gallery',
						'label' => esc_html__( 'Gallery', 'crazyblog' ),
						'description' => esc_html__( 'Upload images for gallery', 'crazyblog' ),
					),
				),
			),
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

