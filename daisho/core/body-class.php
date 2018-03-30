<?php
/**
 * Extends the default WordPress body classes.
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function flow_body_class( $classes ) {
	global $wp_query, $post;
	
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	if ( is_active_sidebar( 'sidebar-1' ) && ! is_attachment() && ! is_404() ) {
		$classes[] = 'sidebar-active';
	}
	
	if ( ( is_home() || is_singular() ) && 'sidebar-left' == get_post_meta( $wp_query->queried_object_id, 'flow_post_layout', true ) ) {
		$classes[] = 'sidebar-left';
	}
	
	if ( ( is_home() || is_singular() ) && 'sidebar-right' == get_post_meta( $wp_query->queried_object_id, 'flow_post_layout', true ) ) {
		$classes[] = 'sidebar-right';
	}
		
	if ( is_singular() && 'no-boundaries' == get_post_meta( $wp_query->queried_object_id, 'flow_post_layout', true ) ) {
		$classes[] = 'no-boundaries';
	}
	
	// WooCommerce with sidebar
	if ( function_exists( 'is_woocommerce' ) && is_woocommerce() && ( is_shop() || is_product_category() || is_product_tag() ) ) {
		$classes[] = 'sidebar-left';
	}
	
	// Thumbnail view
	if ( is_page_template( 'template-portfolio.php' ) or is_singular( 'portfolio' ) ) {
		$classes[] = 'daisho-portfolio';
	}
	
	// Classic Homepage
	if ( is_page_template( 'template-classic.php' ) ) {
		if ( get_post_meta( $post->ID, 'classic_slideshow', true ) != 'disable' ) {
			$classes[] = 'daisho-classic-has-slideshow';
		}
		if ( get_post_meta( $post->ID, 'page_portfolio_welcome_text', true ) ) {
			$classes[] = 'daisho-classic-has-welcome-text';
		}
	}
	
	if ( is_singular( 'post' ) || ( is_home() && get_option( 'page_for_posts' ) ) ) {
		$classes[] = 'compact-header';
	}
	
	if ( is_singular( 'portfolio' ) ) {
		$classes[] = 'daisho-portfolio-viewing-project';
	}
	
	//$classes[] = 'page-refresh';

	return $classes;
}
add_filter( 'body_class', 'flow_body_class' );
