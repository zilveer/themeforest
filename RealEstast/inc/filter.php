<?php

class PGL_Filter {
	static function init() {
		add_filter( 'widget_text', 'do_shortcode' );
		add_filter( 'excerpt_more', array( 'PGL_Filter', 'new_excerpt_more' ) );

		//remove_filter( 'the_content', 'wpautop' );
		//add_filter( 'the_content', array( 'PGL_Filter', 'my_wpautop' ) );
		// add_filter( 'the_content', 'wpautop', 98 );
		// add_filter( 'the_content', 'shortcode_unautop', 100 );
		add_filter( 'redirect_canonical', array( 'PGL_Filter', 'pif_disable_redirect_canonical' ) );
	}

	static function new_excerpt_more( $more ) {
		return '</p><a class="readmore" href="' . get_permalink() . '">' . __( 'Read the full article', PGL ) . '</a><p>';
	}

	/**
	 * @param $content
	 *
	 * @return string
	 */
	static function my_wpautop( $content ) {
		return wpautop( $content, FALSE );
	}


	static function pif_disable_redirect_canonical( $redirect_url ) {
		if ( is_singular() && get_post_type() == 'estate_agent' ) {
			$redirect_url = FALSE;
		}
		return $redirect_url;
	}
}





