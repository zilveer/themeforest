<?php
/**
 * Mental Theme Ajax requests handling
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

/**
 * Load Gallery items
 */
add_action( 'wp_ajax_mental_gallery', 'ajax_mental_gallery' );
add_action( 'wp_ajax_nopriv_mental_gallery', 'ajax_mental_gallery' );
function ajax_mental_gallery()
{
	$offset = (int) $_POST['offset'];
	mental_gallery_loop( $offset, $_POST['options'] );
	die();
}

/**
 * Load Products Gallery items
 */
add_action( 'wp_ajax_mental_woo_gallery', 'ajax_mental_woo_gallery' );
add_action( 'wp_ajax_nopriv_mental_woo_gallery', 'ajax_mental_woo_gallery' );
function ajax_mental_woo_gallery()
{
	$offset = (int) $_POST['offset'];
	mental_woo_gallery_loop( $offset, $_POST['options'] );
	die();
}

/**
 * Load Blog items
 */
add_action( 'wp_ajax_mental_blog', 'ajax_mental_blog' );
add_action( 'wp_ajax_nopriv_mental_blog', 'ajax_mental_blog' );
function ajax_mental_blog()
{
	$offset = (int) $_POST['offset'];
	mental_blog_loop( $offset, $_POST['options'] );
	die();
}