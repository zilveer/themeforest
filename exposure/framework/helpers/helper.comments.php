<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Comments helpers.
 *
 * This file contains utility functions concerning post comments.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Display the post entry comments.
 *
 * @param array $form_args The form arguments.
 * @return void
 */
if( !function_exists('thb_comments') ) {
	function thb_comments( $form_args=array() ) {
		comments_template('', true);

		$form_args += array(
			'title_reply' => __('Reply', 'thb_text_domain')
		);

		if( comments_open() ) {
			comment_form($form_args);
		}
	}
}

/**
 * Display the comments count for the current entry.
 *
 * @return void
 */
if( !function_exists('thb_comments_number') ) {
	function thb_comments_number( $numeric=false ) {
		global $post;

		if( $numeric ) {
			comments_number( '0', '1', '%' );
		}
		else {
			comments_number( __('No comments', 'thb_text_domain'), __('1 comment', 'thb_text_domain'), '% ' . __('comments', 'thb_text_domain') );
		}
	}
}

/**
 * Display the comments count for the current entry.
 *
 * @return void
 */
if( !function_exists('thb_comments_navigation') ) {
	function thb_comments_navigation() {
		global $post;

		if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
			previous_comments_link( __('Older comments', 'thb_text_domain') );
			next_comments_link( __('Newer comments', 'thb_text_domain') );
		}
	}
}

/**
 * Loads the custom comment template.
 *
 * @param Object $comment The comment object.
 * @param array $args The comment arguments.
 * @param int $depth The comments depth.
 * @return void
 */
if( !function_exists('thb_comment') ) {
	function thb_comment( $comment, $args, $depth ) {
		$comment_template = new THB_Template(get_template_directory() . '/comment', array(
			'comment' => $comment,
			'args' => $args,
			'depth' => $depth
		));
		$comment_template->render();
	}
}

/**
 * Check if the comments block must be displayed or not.
 *
 * @param string $post_type The (optional) post type.
 * @return boolean
 */
if( !function_exists('thb_show_comments') ) {
	function thb_show_comments( $post_type=null ) {
		global $post;
		$comments_enabled = true;
		// $custom_post_types = get_post_types( array('public' => true, '_builtin' => false) );

		// if( !$post_type ) {
		// 	$post_type = $post->post_type;
		// }

		// if( in_array($post_type, $custom_post_types) ) {
		// 	$comments_enabled = thb_get_option($post_type . '_comments') == '1';
		// }

		return $comments_enabled && ( have_comments() || comments_open() );
	}
}