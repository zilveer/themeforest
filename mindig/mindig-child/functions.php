<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

add_action( 'wp_enqueue_scripts', 'yit_enqueue_parent_theme_style' );

if ( ! function_exists( 'yit_enqueue_parent_theme_style' ) ) {
	/**
	 * enqueue the parent css file
	 *
	 *
	 * @return void
	 * @since  1.0.0
	 * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
	 */
	function yit_enqueue_parent_theme_style() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' , array( 'bootstrap-twitter' ));
		if ( function_exists( 'yit_set_wc_template_path' ) ) {
			wp_enqueue_style( 'woocommerce-parent-style', get_template_directory_uri() . '/' . yit_set_wc_template_path( 'woocommerce' ) . '/style.css' );
		}
	}
}



add_action( 'after_setup_theme', 'yit_child_theme_setup' );

if ( ! function_exists( 'yit_child_theme_setup' ) ) {
	/**
	 * load child language files
	 *
	 *
	 * @return void
	 * @since  1.0.0
	 * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
	 */
	function yit_child_theme_setup() {
		load_child_theme_textdomain( 'yit', get_stylesheet_directory() . '/languages' );
	}
}