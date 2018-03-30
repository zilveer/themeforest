<?php
/**
 * Custom excerpt functions
 * 
 * http://codex.wordpress.org/Function_Reference/wp_trim_words
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.3
 */

/**
 * Get or generate excerpts
 *
 * @since 1.0.0
 */
function wpex_excerpt( $args ) {
	echo wpex_get_excerpt( $args );
}

/**
 * Get or generate excerpts
 *
 * @since 2.0.0
 */
function wpex_get_excerpt( $args = array() ) {

	// Fallback for old method
	if ( ! is_array( $args ) ) {
		$args = array(
			'length' => $args,
		);
	}

	// Setup default arguments
	$defaults = array(
		'output'        => '',
		'length'        => '30',
		'readmore'      => false,
		'readmore_link' => '',
		'more'          => '&hellip;',
	);

	// Parse arguments
	$args = wp_parse_args( $args, $defaults );

	// Filter args
	$args = apply_filters( 'wpex_excerpt_args', $args );

	// Extract args
	extract( $args );

	// Sanitize data
	$excerpt = intval( $length );

	// If length is empty or zero return
	if ( empty( $length ) || '0' == $length || false == $length ) {
		return;
	}

	// Get global post
	$post = get_post();

	// Display password protected notice
	if ( $post->post_password ) :

		$output = esc_html__( 'This is a password protected post.', 'total' );
		$output = apply_filters( 'wpex_password_protected_excerpt', $output );
		$output = '<p>'. $output .'</p>';
		return $output;

	endif;

	// Get post data
	$post_id      = $post->ID;
	$post_content = $post->post_content;
	$post_excerpt = $post->post_excerpt;

	// Custom Excerpts
	if ( $post_excerpt ) :
		
		$output = do_shortcode( $post_excerpt );

	// Create Excerpt
	else :

		// Return the content including more tag
		if ( '9999' == $length ) {
			return apply_filters( 'the_content', get_the_content( '', '&hellip;' ) );
		}

		// Return the content excluding more tag
		if ( '-1' == $length ) {
			return apply_filters( 'the_content', $post_content );
		}

		// Check for text shortcode in post
		if ( strpos( $post_content, '[vc_column_text]' ) ) {
			$pattern = '{\[vc_column_text.*?\](.*?)\[/vc_column_text\]}is';
			preg_match( $pattern, $post_content, $match );
			if ( isset( $match[1] ) ) {
				$excerpt = strip_shortcodes( $match[1] );
				$excerpt = wp_trim_words( $excerpt, $length, $more );
			} else {
				$content = strip_shortcodes( $post_content );
				$excerpt = wp_trim_words( $content, $length, $more );
			}
		}

		// No text shortcode so lets strip out shortcodes and return the content
		else {
			$content = strip_shortcodes( $post_content );
			$excerpt = wp_trim_words( $content, $length, $more );
		}

		// Add excerpt to output
		if ( $excerpt ) {
			$output .= '<p>'. $excerpt .'</p>'; // Already sanitized via wp_trim_words
		}

	endif;

	// Add readmore link to output if enabled
	if ( $readmore ) :

		$read_more_text = isset( $args['read_more_text'] ) ? $args['read_more_text'] : esc_html__( 'Read more', 'total' );
		$output .= '<a href="'. get_permalink( $post_id ) .'" title="'. esc_attr( $read_more_text ) .'" rel="bookmark" class="wpex-readmore theme-button">'. esc_html( $read_more_text ) .' <span class="wpex-readmore-rarr">&rarr;</span></a>';

	endif;

	// Apply filters for easier customization
	$custom_output = apply_filters( 'wpex_excerpt_output', null );

	// Sanitize custom output and set to default output
	if ( $custom_output ) {
		$output = wp_kses_post( $custom_output );
	}
	
	// Echo output
	return $output;

}

/**
 * Custom excerpt length for posts
 *
 * @since 1.0.0
 */
function wpex_excerpt_length() {

	// Theme panel length setting
	$length = wpex_get_mod( 'blog_excerpt_length', '40' );

	// Taxonomy setting
	if ( is_category() ) {
		
		// Get taxonomy meta
		$term       = get_query_var( 'cat' );
		$term_data  = get_option( "category_$term" );
		if ( ! empty( $term_data['wpex_term_excerpt_length'] ) ) {
			$length = $term_data['wpex_term_excerpt_length'];
		}
	}

	// Return length and add filter for child theme mods
	return intval( apply_filters( 'wpex_excerpt_length', $length ) );

}

/**
 * Change default read more style
 *
 * @since 1.0.0
 */
function wpex_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'wpex_excerpt_more', 10 );

/**
 * Change default excerpt length
 *
 * @since 1.0.0
 */
function wpex_custom_excerpt_length( $length ) {
	return '40';
}
add_filter( 'excerpt_length', 'wpex_custom_excerpt_length', 999 );

/**
 * Prevent Page Scroll When Clicking the More Link
 * http://codex.wordpress.org/Customizing_the_Read_More
 *
 * @since 1.0.0
 */
function wpex_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'wpex_remove_more_link_scroll' );