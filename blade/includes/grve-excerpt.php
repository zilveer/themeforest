<?php

/*
 *	Excerpt functions
 *
 * 	@version	1.0
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */


 /**
 * Custom excerpt
 */
function blade_grve_excerpt( $limit, $more = '0' ) {
	global $post;
	$post_id = $post->ID;

	if ( has_excerpt( $post_id ) ) {
		$excerpt = apply_filters( 'the_content', $post->post_excerpt );
		if ( '1' == $more ) {
			$excerpt .= blade_grve_read_more();
		}
	} else {
		$content = get_the_content('');
		$content = do_shortcode( $content );
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]>', $content);
		if ( '1' == $more ) {
			$excerpt = '<p>' . wp_trim_words( $content, $limit ) . '</p>';
			$excerpt .= blade_grve_read_more();
		} else{
			$excerpt = '<p>' . wp_trim_words( $content, $limit ) . '</p>';
		}
	}
	return	$excerpt;
}

 /**
 * Custom more
 */
function blade_grve_read_more() {
	$more_button = '<a class="grve-read-more grve-link-text" href="' . esc_url( get_permalink( get_the_ID() ) ) . '"><span>' . esc_html__( 'read more', 'blade' ) . '</span></a>';
    return $more_button;
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
