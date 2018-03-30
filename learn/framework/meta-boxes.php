<?php

/**
 * Register meta boxes
 *
 * @since 1.0
 *
 * @param array $meta_boxes
 *
 * @return array
 */

function learn_register_meta_boxes( $meta_boxes ) {



	$prefix = '_cmb_';

	// Post format

	$meta_boxes[] = array(

		'id'       => 'format_detail',

		'title'    => esc_html__( 'Format Details', 'learn' ),

		'pages'    => array( 'post' ),

		'context'  => 'normal',

		'priority' => 'high',

		'autosave' => true,

		'fields'   => array(

			array(

				'name'             => esc_html__( 'Image', 'learn' ),

				'id'               => $prefix . 'image',

				'type'             => 'image_advanced',

				'class'            => 'image',

				'max_file_uploads' => 1,

			),

			array(

				'name'  => esc_html__( 'Gallery', 'learn' ),

				'id'    => $prefix . 'images',

				'type'  => 'image_advanced',

				'class' => 'gallery',

			),

			array(

				'name'  => esc_html__( 'Quote', 'learn' ),

				'id'    => $prefix . 'quote',

				'type'  => 'textarea',

				'cols'  => 20,

				'rows'  => 2,

				'class' => 'quote',

			),

			array(

				'name'  => esc_html__( 'Author', 'learn' ),

				'id'    => $prefix . 'quote_author',

				'type'  => 'text',

				'class' => 'quote',

			),

			array(

				'name'  => esc_html__( 'Audio', 'learn' ),

				'id'    => $prefix . 'link_audio',

				'type'  => 'textarea',

				'cols'  => 20,

				'rows'  => 2,

				'class' => 'audio',

				'desc' => 'Ex: https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/139083759',

			),

			array(

				'name'  => esc_html__( 'Video', 'learn' ),

				'id'    => $prefix . 'link_video',

				'type'  => 'textarea',

				'cols'  => 20,

				'rows'  => 2,

				'class' => 'video',

				'desc' => 'Example: <b>http://www.youtube.com/embed/0ecv0bT9DEo</b> or <b>http://player.vimeo.com/video/47355798</b>',

			),			

		),

	);


	$meta_boxes[] = array(

		'id'       => 'page_dt',

		'title'    => esc_html__( 'Page Details', 'learn' ),

		'pages'    => array( 'page' ),

		'context'  => 'normal',

		'priority' => 'high',

		'autosave' => true,

		'fields'   => array(				

			array(

				'name'  => esc_html__( 'Page Subtitle', 'learn' ),

				'id'    => $prefix . 'page_sub',

				'type'  => 'textarea',

			),
			array(

				'name'  => esc_html__( 'Page Description', 'learn' ),

				'id'    => $prefix . 'page_des',

				'type'  => 'textarea',

			),
			array(

				'name'             => esc_html__( 'Background Header', 'learn' ),

				'id'               => $prefix . 'bg_header',

				'type'             => 'image_advanced',

				'max_file_uploads' => 1,

			),		

		),

	);

	$meta_boxes[] = array(

		'id'       => 'course_dt',

		'title'    => esc_html__( 'Course Extra', 'learn' ),

		'pages'    => array( 'course' ),

		'context'  => 'normal',

		'priority' => 'high',

		'fields'   => array(				

			array(

				'name'  => esc_html__( 'Start Date Course', 'learn' ),

				'id'    => $prefix . 'sd_course',

				'type'  => 'date',

			),
			
		),

	);

	$meta_boxes[] = array(

		'id'       => 'lesson_dt',

		'title'    => esc_html__( 'Lesson Extra', 'learn' ),

		'pages'    => array( 'lesson' ),

		'context'  => 'normal',

		'priority' => 'high',

		'fields'   => array(				

			array(

				'name'  => esc_html__( 'File Download', 'learn' ),

				'id'    => $prefix . 'down_file',

				'type'  => 'file',

			),
			
		),

	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'learn_register_meta_boxes' );

/**
 * Enqueue scripts for admin
 *
 * @since  1.0
 */
function learn_admin_enqueue_scripts( $hook ) {
	// Detect to load un-minify scripts when WP_DEBUG is enable
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_script( 'learn-backend-js', get_template_directory_uri()."/js/admin.js", array( 'jquery' ), '1.0.0', true );
	}
}
add_action( 'admin_enqueue_scripts', 'learn_admin_enqueue_scripts' );

