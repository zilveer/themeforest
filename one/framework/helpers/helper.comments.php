<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Comments helpers.
 *
 * This file contains utility functions concerning post comments.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if( ! function_exists( 'thb_comments' ) ) {
	/**
	 * Display the post entry comments.
	 *
	 * @param array $form_args The form arguments.
	 */
	function thb_comments( $form_args = array() ) {
		comments_template('', true);

		$form_args += array(
			'title_reply' => __('Reply', 'thb_text_domain')
		);

		if( comments_open() ) {
			comment_form( $form_args );
		}
	}
}

if( ! function_exists( 'thb_comments_number' ) ) {
	/**
	 * Display the comments count for the current entry.
	 *
	 * @param boolean $numeric
	 */
	function thb_comments_number( $numeric = false ) {
		global $post;

		if( $numeric ) {
			comments_number( '0', '1', '%' );
		}
		else {
			comments_number( __('No comments', 'thb_text_domain'), __('1 comment', 'thb_text_domain'), '% ' . __('comments', 'thb_text_domain') );
		}
	}
}

if( ! function_exists( 'thb_comments_navigation' ) ) {
	/**
	 * Display the comments count for the current entry.
	 */
	function thb_comments_navigation() {
		global $post;

		if( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
			previous_comments_link( __('Older comments', 'thb_text_domain') );
			next_comments_link( __('Newer comments', 'thb_text_domain') );
		}
	}
}

if( ! function_exists( 'thb_comment' ) ) {
	/**
	 * Loads the custom comment template.
	 *
	 * @param Object $comment The comment object.
	 * @param array $args The comment arguments.
	 * @param int $depth The comments depth.
	 */
	function thb_comment( $comment, $args, $depth ) {
		thb_get_template_part( 'comment', array(
			'comment' => $comment,
			'args'    => $args,
			'depth'   => $depth
		) );
	}
}

if( ! function_exists( 'thb_show_comments' ) ) {
	/**
	 * Check if the comments block must be displayed or not.
	 *
	 * @return boolean
	 */
	function thb_show_comments() {
		$post_id = thb_get_page_ID();
		$comment_count = get_comment_count( $post_id );

		return ( $comment_count['total_comments'] > 0 || comments_open( $post_id ) );
	}
}