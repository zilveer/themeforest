<?php

/* ==========================================================================
	Before Post Content
============================================================================= */

if( ! function_exists( 'shiroi_before_post_content' ) ):

function shiroi_before_post_content() {
	if( ! shiroi_get_sidebar() ) {
		echo '<div class="row"><div class="col-md-8 col-md-push-2">';
	}
}
endif;
add_action( 'shiroi_before_post_header_content', 'shiroi_before_post_content' );
add_action( 'shiroi_before_post_body_content', 'shiroi_before_post_content' );
add_action( 'shiroi_before_post_footer_content', 'shiroi_before_post_content' );

/* ==========================================================================
	After Post Content
============================================================================= */

if( ! function_exists( 'shiroi_after_post_content' ) ):

function shiroi_after_post_content() {
	if( ! shiroi_get_sidebar() ) {
		echo '</div>';
	}
}
endif;
add_action( 'shiroi_after_post_header_content', 'shiroi_after_post_content' );
add_action( 'shiroi_after_post_body_content', 'shiroi_after_post_content' );
add_action( 'shiroi_after_post_footer_content', 'shiroi_after_post_content' );

/* ==========================================================================
	Post Format
============================================================================= */

if( ! function_exists( 'shiroi_extract_post_format_meta' ) ):

function shiroi_extract_post_format_meta( $post = null ) {

	$post = get_post( $post );
	if( is_a( $post, 'WP_Post' ) && function_exists( 'youxi_post_format_id' ) ) {

		$post_format = get_post_format( $post->ID );
		$meta_key    = youxi_post_format_id( $post_format );
		$post_meta   = (array) $post->$meta_key;

		switch( $post_format ) {
			case 'video':
				$post_meta = wp_parse_args( $post_meta, array(
					'type' => '', 
					'embed' => '', 
					'src' => '', 
					'poster' => ''
				));
				if( ( 'embed' == $post_meta['type'] && '' !== $post_meta['embed'] ) || 
					( 'hosted' == $post_meta['type'] && '' !== $post_meta['src'] ) ) {
					return $post_meta;
				}
				break;
			case 'audio':
				$post_meta = wp_parse_args( $post_meta, array(
					'type' => '', 
					'embed' => '', 
					'src' => ''
				));
				if( ( 'embed' == $post_meta['type'] && '' !== $post_meta['embed'] ) || 
					( 'hosted' == $post_meta['type'] && '' !== $post_meta['src'] ) ) {
					return $post_meta;
				}
				break;
			case 'gallery':
				$post_meta = wp_parse_args( $post_meta, array(
					'type'                  => 'slider', 
					'images'                => array(), 
					'ftmNav'                => 'bullets', 
					'ftmFit'                => 'cover', 
					'ftmTransition'         => 'move', 
					'rsLoop'                => false, 
					'ftmTransitionDuration' => 600, 
					'jst_margin'            => 4, 
					'jst_minwidth'          => 160, 
					'jst_minheight'         => 160
				));
				if( ! empty( $post_meta['images'] ) && is_array( $post_meta['images'] ) ) {
					return $post_meta;
				}
				break;
			case 'quote':
				$post_meta = wp_parse_args( $post_meta, array(
					'text' => '', 
					'author' => '', 
					'source' => '', 
					'source_url' => ''
				));
				if( '' !== $post_meta['text'] ) {
					return $post_meta;
				}
				break;
			default:
				break;
		}

	}
}
endif;
