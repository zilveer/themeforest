<?php

/**
 * Ebor Framework
 * Custom Framework Filters & Fixes
 * @since version 1.0
 * @author TommusRhodus
 */

/**
 * Filters the_content for iFrames & iFrame video
 * Fixes an IE display issue with iframe embeds
 * Wraps iframe in .video-container for responsive iframe video
 */
add_filter( 'the_content' , 'mh_youtube_wmode' , 15 );
function mh_youtube_wmode( $content ) {
	$mh_youtube_regex = "/\<iframe .*\.com.*><\/iframe>/";
	preg_match_all( $mh_youtube_regex , $content, $mh_matches );
	if ( $mh_matches ) {;
    	for ( $mh_count = 0; $mh_count < count( $mh_matches[0] ); $mh_count++ ){
            $mh_old = $mh_matches[0][$mh_count];
            $mh_new = str_replace( "?feature=oembed" , '?wmode=transparent' , $mh_old );
            $mh_new = preg_replace( '/\><\/iframe>$/' , ' wmode="Opaque"></iframe></div>' , $mh_new );
            $mh_new = str_replace( "<iframe" , "<div class='video-container'><iframe" , $mh_new );
            $content = str_replace( $mh_old, $mh_new , $content );
        }
    }
	return $content;
}

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function ebor_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'ebor_starter' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'ebor_wp_title', 10, 2 );

/**
 * Filters the excerpt for the more section, the end of the excerpt.
 */
function ebor_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'ebor_excerpt_more');

/**
 * Filters the excerpt to control the excerpt length
 */
function ebor_custom_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'ebor_custom_excerpt_length', 999 );

/**
 * Filters the text widget output to allow shortcodes
 */
add_filter('widget_text', 'do_shortcode');