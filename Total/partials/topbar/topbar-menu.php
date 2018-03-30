<?php
/**
 * Topbar menu displays inside the topbar "content" area
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Display menu
wp_nav_menu( array(
	'theme_location' => 'topbar_menu',
	'fallback_cb'    => false,
	'link_before'    => '<span class="link-inner">',
	'link_after'     => '</span>',
	'container'      => false,
	'menu_class'     => 'top-bar-menu',
) ); ?>