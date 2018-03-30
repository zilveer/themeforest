<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Pile
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 *
 * @since Pile 2.0
 */
function pile_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'type'           => 'scroll',
		'footer_widgets' => true,
		'container'      => 'content',
		'render'         => 'pile_infinite_scroll_render',
		'wrapper'        => false,
		'click_handle'   => false
	) );

} // end function pile_jetpack_setup
add_action( 'after_setup_theme', 'pile_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 *
 * @since Pile 2.0
 */
function pile_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
} // end function pile_infinite_scroll_render
