<?php

/**
 * Handles menu extensions
 * @author alex
 */
class ctMenuHandler {
	
}

new ctMenuHandler();


if ( ! function_exists( 'ct_wp_nav_menu' ) ) {

	/**
	 * Render menu + optionally allow for custom one
	 *
	 * @param array $args
	 */

	function ct_wp_nav_menu( $args ) {
		if ( $menu = apply_filters( 'ct_menu.render_custom', '', $args ) ) {
			//no escape required - we want to render our menu
            echo $menu;
		} else {
			wp_nav_menu( $args );
		}
	}
}