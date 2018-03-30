<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'presscore_before_shortcode_loop', 'presscore_shortcodes_add_masonry_default_actions', 20 );
add_action( 'presscore_after_shortcode_loop', 'presscore_shortcodes_remove_masonry_default_actions', 20 );
add_action( 'save_post_page', 'presscore_save_shortcode_inline_css', 10, 2 );

if ( ! function_exists( 'presscore_shortcodes_add_masonry_default_actions' ) ):

	function presscore_shortcodes_add_masonry_default_actions() {
		add_filter( 'dt_paginator_args', 'presscore_shortcodes_masonry_pagination_filter', 20 );
	}

endif;

if ( ! function_exists( 'presscore_shortcodes_remove_masonry_default_actions' ) ):

	function presscore_shortcodes_remove_masonry_default_actions() {
		remove_filter( 'dt_paginator_args', 'presscore_shortcodes_masonry_pagination_filter', 20 );
	}

endif;

if ( ! function_exists( 'presscore_shortcodes_masonry_pagination_filter' ) ):

	function presscore_shortcodes_masonry_pagination_filter( $args = array() ) {
		$args['wrap'] = '<div class="%CLASS%" role="navigation"><div class="page-links">%LIST%</div></div>';
		return $args;
	}

endif;

if ( ! function_exists( 'presscore_save_shortcode_inline_css' ) ):

	function presscore_save_shortcode_inline_css( $postID, $post ) {
		if ( ! class_exists( 'lessc', false ) ) {
			include trailingslashit( PRESSCORE_EXTENSIONS_DIR ) . 'wp-less/lib/vendor/lessphp/lessc.inc.php';
		}

		$css = presscore_generate_shortcode_css( $post->post_content );

		if ( $css ) {
			update_post_meta( $postID, 'the7_shortcodes_inline_css', $css );
		} else {
			delete_post_meta( $postID, 'the7_shortcodes_inline_css' );
		}
	}

endif;

function presscore_generate_shortcode_css( $content ) {
	if ( empty( $content ) ) {
		return '';
	}

	$css = '';
	preg_match_all( '/' . get_shortcode_regex() . '/', $content, $shortcodes );
	foreach ( $shortcodes[2] as $index => $tag ) {
		$attr_array = shortcode_parse_atts( trim( $shortcodes[3][ $index ] ) );
		$css .= apply_filters( "the7_generate_sc_{$tag}_css", '', $attr_array );
		if ( ! empty( $shortcodes[5][ $index ] ) ) {
			$css .= presscore_generate_shortcode_css( $shortcodes[5][ $index ] );
		}
	}

	return $css;
}
