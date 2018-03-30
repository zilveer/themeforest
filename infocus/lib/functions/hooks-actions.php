<?php
/**
 *
 */
function mysite_head() {
	do_atomic( 'head' );
}

/**
 *
 */
function mysite_before_header() {
	do_atomic( 'before_header' );
}

/**
 *
 */
function mysite_header() {
	do_atomic( 'header' );
}

/**
 *
 */
function mysite_after_header() {
	do_atomic( 'after_header' );
}

/**
 *
 */
function mysite_before_main() {
	do_atomic( 'before_main' );
}

/**
 *
 */
function mysite_primary_menu_begin() {
	do_atomic( 'primary_menu_begin' );
}

/**
 *
 */
function mysite_primary_menu_end() {
	do_atomic( 'primary_menu_end' );
}

/**
 *
 */
function mysite_intro_begin() {
	do_atomic( 'intro_begin' );
}

/**
 *
 */
function mysite_intro_end( $args = array() ) {
	do_atomic( 'intro_end', $args );
}

/**
 *
 */
function mysite_before_page_content() {
	do_atomic( 'before_page_content' );
}

/**
 *
 */
function mysite_post_image_begin() {
	do_atomic( 'post_image_begin' );
}

/**
 *
 */
function mysite_post_image_end( $args = array()  ) {
	do_atomic( 'post_image_end', $args );
}

/**
 *
 */
function mysite_portfolio_image_begin() {
	do_atomic( 'portfolio_image_begin' );
}

/**
 *
 */
function mysite_portfolio_image_end( $args = array() ) {
	do_atomic( 'portfolio_image_end', $args );
}

/**
 *
 */
function mysite_before_portfolio_image() {
	do_atomic( 'before_portfolio_image' );
}

/**
 *
 */
function mysite_after_portfolio_image() {
	do_atomic( 'after_portfolio_image' );
}

/**
 *
 */
function mysite_before_post( $args = array() ) {
	do_atomic( 'before_post', $args );
}

/**
 *
 */
function mysite_after_post() {
	do_atomic( 'after_post' );
}

/**
 *
 */
function mysite_after_comments() {
	do_atomic( 'after_comments' );
}

/**
 *
 */
function mysite_before_entry() {
	do_atomic( 'before_entry' );
}

/**
 *
 */
function mysite_after_entry() {
	do_atomic( 'after_entry' );
}

/**
 *
 */
function mysite_after_page_content() {
	do_atomic( 'after_page_content' );
}

/**
 *
 */
function mysite_sidebar_begin() {
	do_atomic( 'sidebar_begin' );
}

/**
 *
 */
function mysite_sidebar_end() {
	do_atomic( 'sidebar_end' );
}

/**
 *
 */
function mysite_after_main() {
	do_atomic( 'after_main' );
}

/**
 *
 */
function mysite_before_footer() {
	do_atomic( 'before_footer' );
}

/**
 *
 */
function mysite_footer() {
	do_atomic( 'footer' );
}

/**
 *
 */
function mysite_after_footer_inner() {
	do_atomic( 'after_footer_inner' );
}

/**
 *
 */
function mysite_after_footer() {
	do_atomic( 'after_footer' );
}

/**
 *
 */
function mysite_body_end() {
	do_atomic( 'body_end' );
}

?>