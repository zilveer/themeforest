<?php
/**
 * Custom metaboxes
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call


if( is_admin() ) {
	// Load Wpalchemy Class
	require_once( 'class-wpalchemy-metabox.php' );

	// Load Assets
	add_action( 'init', 'mental_metabox_scripts' );
}

function mental_metabox_scripts()
{
	wp_register_style( 'metaboxes', get_template_directory_uri() . '/includes/metaboxes/assets/metaboxes.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'metaboxes' ); // Enqueue it!

	wp_register_script( 'mousewheel', get_template_directory_uri() . '/includes/metaboxes/assets/metaboxes.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'mousewheel' ); // Enqueue it!

}

if( class_exists('WPAlchemy_MetaBox') ) {

	/* ========================================================================= *\
	   Template specific metaboxes
	\* ========================================================================= */

	new WPAlchemy_MetaBox( array
	(
		'id'       => 'onepage_top_slider',
		'title'    => __( 'Onepage Top slider', 'mental' ),
		'types'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'template' => get_template_directory() . '/includes/metaboxes/templates/onepage-top-slider.php'
	) );

	new WPAlchemy_MetaBox( array
	(
		'id'       => 'onepage',
		'title'    => __( 'Onepage Settings', 'mental' ),
		'types'    => array( 'page' ),
		'context'  => 'normal',
		'priority' => 'high',
		'template' => get_template_directory() . '/includes/metaboxes/templates/onepage.php'
	) );

	/* ========================================================================= *\
	   Post format specific metaboxes
	\* ========================================================================= */

	new WPAlchemy_MetaBox( array
	(
		'id'       => 'quote_format',
		'title'    => __( 'Quote Format Details', 'mental' ),
		'types'    => array( 'post' ),
		'context'  => 'normal',
		'priority' => 'high',
		'template' => get_template_directory() . '/includes/metaboxes/templates/quote-format.php'
	) );


	/* ========================================================================= *\
	   Post format specific metaboxes
	\* ========================================================================= */

	new WPAlchemy_MetaBox( array
	(
		'id'       => 'gallery_item',
		'title'    => __( 'Gallery Item Details', 'mental' ),
		'types'    => array( 'gallery' ),
		'context'  => 'normal',
		'priority' => 'high',
		'template' => get_template_directory() . '/includes/metaboxes/templates/gallery-item.php'
	) );

}

if (class_exists('MultiPostThumbnails')) {

	new MultiPostThumbnails(array(
			'label' => 'Additional Thumbnail',
			'id' => 'additional_thumbnail',
			'post_type' => 'gallery'
	) );

	new MultiPostThumbnails(array(
			'label' => 'Additional Thumbnail',
			'id' => 'additional_thumbnail',
			'post_type' => 'product'
	) );

}