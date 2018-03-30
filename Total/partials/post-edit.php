<?php
/**
 * Edit post link
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Return if disabled
if ( ! wpex_get_mod( 'edit_post_link_enable', true ) ) {
	return;
}

// Edit text
if ( is_page() ) {
    $edit_text = esc_html__( 'Edit This Page', 'total' );
} else {
    $edit_text = esc_html__( 'Edit This Post', 'total' );
}

// Display edit post link
edit_post_link(
    $edit_text,
    '<div class="post-edit clr">', ' <a href="#" class="hide-post-edit" title="'. esc_html__( 'Hide Post Edit Links', 'total' ) .'"  aria-hidden="true"><span class="fa fa-times"></span></a></div>'
); ?>