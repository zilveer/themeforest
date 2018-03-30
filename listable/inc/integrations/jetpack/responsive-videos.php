<?php
/**
 * This file has been "borrowed" from the awesome Jetpack plugin to provide a smooth transition in case one decides to use the plugin
 * See: http://jetpack.me/
 */

/*
 * ------- License Header --------
 * Plugin Name: Jetpack by WordPress.com
 * Plugin URI: http://wordpress.org/extend/plugins/jetpack/
 * Description: Bring the power of the WordPress.com cloud to your self-hosted WordPress. Jetpack enables you to connect your blog to a WordPress.com account to use the powerful features normally only available to WordPress.com users.
 * Author: Automattic
 * Version: 3.8.0
 * Author URI: http://jetpack.me
 * License: GPL2+
 */

/**
 * Load the Responsive videos plugin
 */
function listable_jetpack_responsive_videos_init() {

	/* If the theme doesn't support 'jetpack-responsive-videos' or if Jetpack is already present, don't continue */
	if ( ! current_theme_supports( 'jetpack-responsive-videos' ) && function_exists( 'jetpack_responsive_videos_embed_html' )  ) {
		return;
	}

	/* If the theme does support 'jetpack-responsive-videos', wrap the videos */
	add_filter( 'wp_video_shortcode', 'listable_jetpack_responsive_videos_embed_html' );
	add_filter( 'video_embed_html',   'listable_jetpack_responsive_videos_embed_html' );

	/* Only wrap oEmbeds if video */
	add_filter( 'embed_oembed_html',  'listable_jetpack_responsive_videos_maybe_wrap_oembed', 10, 2 );
	add_filter( 'embed_handler_html', 'listable_jetpack_responsive_videos_maybe_wrap_oembed', 10, 2 );

	/* Wrap videos in Buddypress */
	add_filter( 'bp_embed_oembed_html', 'listable_jetpack_responsive_videos_embed_html' );
}
add_action( 'after_setup_theme', 'listable_jetpack_responsive_videos_init', 99 );

/**
 * Adds a wrapper to videos and enqueue script
 *
 * @return string
 */
function listable_jetpack_responsive_videos_embed_html( $html ) {
	if ( empty( $html ) || ! is_string( $html ) ) {
		return $html;
	}

	if ( defined( 'SCRIPT_DEBUG' ) && true == SCRIPT_DEBUG ) {
		wp_enqueue_script( 'jetpack-responsive-videos-script', get_template_directory_uri() . '/inc/integrations/jetpack/responsive-videos/responsive-videos.js', array( 'jquery' ), '1.1', true );
	} else {
		wp_enqueue_script( 'jetpack-responsive-videos-min-script', get_template_directory_uri() . '/inc/integrations/jetpack/responsive-videos/responsive-videos.min.js', array( 'jquery' ), '1.1', true );
	}

	// Enqueue CSS to ensure compatibility with all themes
	wp_register_style( 'jetpack-responsive-videos-style', get_template_directory_uri() . '/inc/integrations/jetpack/responsive-videos/responsive-videos.css' );
	wp_enqueue_style( 'jetpack-responsive-videos-style' );

	return '<div class="jetpack-video-wrapper">' . $html . '</div>';
}

/**
 * Check if oEmbed is YouTube or Vimeo before wrapping.
 *
 * @return string
 */
function listable_jetpack_responsive_videos_maybe_wrap_oembed( $html, $url ) {
	if ( empty( $html ) || ! is_string( $html ) || ! $url ) {
		return $html;
	}

	$jetpack_video_wrapper = '<div class="jetpack-video-wrapper">';

	$already_wrapped = strpos( $html, $jetpack_video_wrapper );

	// If the oEmbed has already been wrapped, return the html.
	if ( false !== $already_wrapped ) {
		return $html;
	}

	/**
	 * oEmbed Video Providers.
	 *
	 * A whitelist of oEmbed video provider Regex patterns to check against before wrapping the output.
	 *
	 * @module theme-tools
	 *
	 * @since 3.8.0
	 *
	 * @param array $video_patterns oEmbed video provider Regex patterns.
	 */
	$video_patterns = apply_filters( 'jetpack_responsive_videos_oembed_videos', array(
		'https?://((m|www)\.)?youtube\.com/watch',
		'https?://((m|www)\.)?youtube\.com/playlist',
		'https?://youtu\.be/',
		'https?://(.+\.)?vimeo\.com/',
		'https?://(www\.)?dailymotion\.com/',
		'https?://dai.ly/',
		'https?://(www\.)?hulu\.com/watch/',
		'https?://wordpress.tv/',
		'https?://(www\.)?funnyordie\.com/videos/',
		'https?://vine.co/v/',
		'https?://(www\.)?collegehumor\.com/video/',
		'https?://(www\.|embed\.)?ted\.com/talks/'
	) );

	// Merge patterns to run in a single preg_match call.
	$video_patterns = '(' . implode( '|', $video_patterns ) . ')';

	$is_video = preg_match( $video_patterns, $url );

	// If the oEmbed is a video, wrap it in the responsive wrapper.
	if ( false === $already_wrapped && 1 === $is_video ) {
		return listable_jetpack_responsive_videos_embed_html( $html );
	}

	return $html;
}
