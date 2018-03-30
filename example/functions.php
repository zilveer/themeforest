<?php

/**
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

require_once(get_template_directory() . '/mpc-wp-boilerplate/php/mpcth-functions.php');

function custom_mpc_theme_enqueue_scripts() {
	/* CSS */

	/* JS */

}

add_action('wp_enqueue_scripts', 'custom_mpc_theme_enqueue_scripts');

?>