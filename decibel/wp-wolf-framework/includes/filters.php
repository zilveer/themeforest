<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'wolf_wp_title' ) ) {
	/**
	 * Configure WP Title
	 *
	 * @param string $title
	 * @return string
	 */
	function wolf_wp_title( $title ) {

		if ( is_front_page() )
			return get_bloginfo( 'name' ) .' | '. get_bloginfo( 'description' );
		else
			return trim( $title ) .' | '. get_bloginfo( 'name' ) .' | '. get_bloginfo( 'description' );
	}
	add_filter( 'wp_title', 'wolf_wp_title' );
}

if ( ! function_exists( 'wolf_page_menu_args' ) ) {
	/**
	 * Menu fallback function
	 * (display the list of pages as menu if no menu is created)
	 *
	 * @param array $args
	 * @return array $args
	 */
	function wolf_page_menu_args( $args ) {
		$args['sort_column'] = 'post_date';
		return $args;
	}
	add_filter( 'wp_page_menu_args', 'wolf_page_menu_args' );
}

if ( ! function_exists( 'wolf_change_comment_form_defaults' ) ) {
	/**
	 * Hook to set the email input of the comment form as email type
	 * (usefull for tablet and mobile)
	 *
	 * @param array $default
	 * @return array $default
	 */
	function wolf_change_comment_form_defaults( $default ) {
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$default[ 'fields' ][ 'email' ] = '<p class="comment-form-email">
		<label for="email">' . __( 'Email', 'wolf' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label><input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
		return $default;
	}
	add_filter( 'comment_form_defaults', 'wolf_change_comment_form_defaults' );
}

if ( ! function_exists( 'wolf_add_menuclass' ) ) {
	/**
	 * Add a menu class to the fallback menu
	 * In case if the user didn't set any menu in the WP menu  admin panel
	 *
	 * @param string $page_markup
	 * @return string $new_markup
	 */
	function wolf_add_menuclass( $page_markup ) {
		preg_match( '/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches );
		$divclass   = $matches[1];
		$to_replace = array( '<div class="' . $divclass . '">', '</div>' );
		$new_markup = str_replace( $to_replace, '', $page_markup );
		$new_markup = preg_replace( '/^<ul>/i', '<ul class="nav-menu">', $new_markup );
		return $new_markup;
	}
	add_filter( 'wp_page_menu', 'wolf_add_menuclass' );
}