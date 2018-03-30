<?php
function theme_oembed_videos() {

    global $post;

    if ( $post && $post->post_content ) {

        global $shortcode_tags;
        // Make a copy of global shortcode tags - we'll temporarily overwrite it.
        $theme_shortcode_tags = $shortcode_tags;

        // The shortcodes we're interested in.
        $shortcode_tags = array(
            'video' => $theme_shortcode_tags['video'],
            'embed' => $theme_shortcode_tags['embed']
        );
        // Get the absurd shortcode regexp.
        $video_regex = '#' . get_shortcode_regex() . '#i';

        // Restore global shortcode tags.
        $shortcode_tags = $theme_shortcode_tags;

        $pattern_array = array( $video_regex );

        // Get the patterns from the embed object.
        if ( ! function_exists( '_wp_oembed_get_object' ) ) {
            include ABSPATH . WPINC . '/class-oembed.php';
        }
        $oembed = _wp_oembed_get_object();
        $pattern_array = array_merge( $pattern_array, array_keys( $oembed->providers ) );

        // Or all the patterns together.
        $pattern = '#(' . array_reduce( $pattern_array, function ( $carry, $item ) {
            if ( strpos( $item, '#' ) === 0 ) {
                // Assuming '#...#i' regexps.
                $item = substr( $item, 1, -2 );
            } else {
                // Assuming glob patterns.
                $item = str_replace( '*', '(.+)', $item );
            }
            return $carry ? $carry . ')|('  . $item : $item;
        } ) . ')#is';

        // Simplistic parse of content line by line.
        $lines = explode( "\n", $post->post_content );
        foreach ( $lines as $line ) {
            $line = trim( $line );
            if ( preg_match( $pattern, $line, $matches ) ) {
                if ( strpos( $matches[0], '[' ) === 0 ) {
                    $ret = do_shortcode( $matches[0] );
                } else {
                    $ret = wp_oembed_get( $matches[0] );
                }
                return $ret;
            }
        }
    }
}
