<?php
/**
 * Helper functions for working with the WordPress sidebar system.  Currently, the framework creates a 
 * simple function for registering HTML5-ready sidebars instead of the default WordPress unordered lists.
 *
 * @package    ThemesDepotCore
 * @subpackage Functions
 * @author    Alessandro Tesoro
 * @copyright Copyright (c) 2014, Alessandro Tesoro
 * @link      https://themesdepot.org
 */


/**
 * Wrapper function for WordPress' register_sidebar() function.  This function exists so that theme authors 
 * can more quickly register sidebars with an HTML5 structure instead of having to write the same code 
 * over and over.  Theme authors are also expected to pass in the ID, name, and description of the sidebar. 
 * This function can handle the rest at that point.
 *
 * @since  2.0.0
 * @access public
 * @param  array   $args
 * @return string  Sidebar ID.
 */
function tdp_register_sidebar( $args ) {

	/* Set up some default sidebar arguments. */
	$defaults = array(
		'id'            => '',
		'name'          => '',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>'
	);

	/* Allow developers to filter the default sidebar arguments. */
	$defaults = apply_filters( 'tdp_sidebar_defaults', $defaults );

	/* Parse the arguments. */
	$args = wp_parse_args( $args, $defaults );

	/* Allow developers to filter the sidebar arguments. */
	$args = apply_filters( 'tdp_sidebar_args', $args );

	/* Remove action. */
	remove_action( 'widgets_init', '__return_false', 95 );

	/* Register the sidebar. */
	return register_sidebar( $args );
}

/* Compatibility for when a theme doesn't register any sidebars. */
add_action( 'widgets_init', '__return_false', 95 );
