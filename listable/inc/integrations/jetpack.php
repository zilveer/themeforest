<?php
/**
 * Jetpack Compatibility File - load the theme's duplicate files if Jetpack is not present
 * This way we provide a smooth transition to those that decide to use Jetpack
 * See: http://jetpack.me/
 *
 * @package Listable
 */
function listable_load_jetpack_compatibility() {

	//first test if Jetpack is present and activated
	// only if it is not present load the duplicated code from the theme
	if ( ! class_exists( 'Jetpack' ) ) {
		//this is not safe -- needed to prefix the functions
		require_once get_template_directory() . '/inc/integrations/jetpack/responsive-videos.php';
	}
}
add_action( 'after_setup_theme', 'listable_load_jetpack_compatibility' );

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function listable_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'posts-container',
		'render'    => 'listable_infinite_scroll_render',
		'footer'    => 'page',
		'wrapper'   => false
	) );
	add_theme_support( 'jetpack-responsive-videos' );

} // end function listable_jetpack_setup
add_action( 'after_setup_theme', 'listable_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function listable_infinite_scroll_render() {
	while ( have_posts() ) : the_post();

		/**
		 * If this is a woocommerce archive, use the proper template card
		 */
		if ( 'product' === get_post_type() && function_exists( 'wc_get_template_part' ) ) {
			wc_get_template_part( 'content', 'product' );
			continue;
		} ?>
		<div class="grid__item  postcard">
			<?php
			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', get_post_format() ); ?>
		</div>

	<?php endwhile;
} // end function listable_infinite_scroll_render

function listable_jetpack_remove_share_from_listings() {
	if ( is_post_type_archive('job_listing') || get_query_var( 'post_type' )  == 'job_listing' ) {
		remove_filter( 'the_content', 'sharing_display', 19 );
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
		if ( class_exists( 'Jetpack_Likes' ) ) {
			remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30 );
		}
	}
}

add_action( 'loop_start', 'listable_jetpack_remove_share_from_listings' );