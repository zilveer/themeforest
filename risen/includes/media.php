<?php
/**
 * Media
 *
 * Image and video functions
 */

/**
 * Custom Image Sizes
 */

function risen_image_sizes() {

	// Slider Image
	// If change this, also change note in includes/slider.php: risen_slide_featured_image_note()
	add_image_size( 'risen-slider', 960, 350, true ); // crop for exact size

	// Page Header Image (featured image to appear at the top of pages)
	add_image_size( 'risen-header', 960, 250, true ); // crop for exact size
	
	// Post Featured Image (to appear above posts in archives - blog, multimedia, etc.)
	add_image_size( 'risen-post', 960, 350, true ); // crop for exact size
	
	// Large thumbnails
	// Used by homepage image boxes and gallery thumbnails
	// Large enough to scale wide when one thumb shown per page on mobile screen
	// If change this, also change note in includes/gallery.php: risen_gallery_featured_image_note()
	// IMPORTANT: images/thumb-placeholder.png must be a transparent PNG with these exact dimensions
	add_image_size( 'risen-big-thumb', 600, 400, true ); // crop for exact size
	
	// Full-size gallery image (large enough for lightbox)
	add_image_size( 'risen-gallery', 1280, 960, false ); // max size, no cropping - just fit within constraints
	
	// Small square thumbnail
	// Used for Staff, Gallery Categories thumbnails
	add_image_size( 'risen-square-thumb', 180, 180, true ); // crop for exact size
	
	// Tiny square thumbnail
	// Use in content widgets on homepage
	add_image_size( 'risen-tiny-thumb', 55, 55, true ); // crop for exact size

}

/**
 * Enable upscaling of images
 *
 * Normally WordPress will only generate resized/cropped images if the source is larger than the target.
 * This forces an image to be made for all sizes, even if the source is smaller than the target.
 * This makes responsive images work more consistently (automatic height via CSS, for example)
 *
 * Credit: levi (http://wordpress.stackexchange.com/users/19801/levi)
 * via Stack Exchange: http://wordpress.stackexchange.com/a/64953
 */

add_filter( 'image_resize_dimensions', 'risen_image_resize_dimensions_upscale', 10, 6 );

function risen_image_resize_dimensions_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ) {

	// if not cropping, let core function handle it
	if ( ! $crop ) {
		return null; 
	}

	$aspect_ratio = $orig_w / $orig_h;
	$size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

	$crop_w = round( $new_w / $size_ratio );
	$crop_h = round( $new_h / $size_ratio );

	$s_x = floor( ( $orig_w - $crop_w ) / 2 );
	$s_y = floor( ( $orig_h - $crop_h ) / 2 );

	return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );

}

/**
 * Prevent extra 10px width WordPress adds to .wp-caption via shortcode
 *
 * Cleaner Caption - Cleans up the WP [caption] shortcode.
 *
 * WordPress adds an inline style to its [caption] shortcode which specifically adds 10px of extra width to 
 * captions, making theme authors jump through hoops to design captioned elements to their liking.  This extra
 * width makes the assumption that all captions should have 10px of extra padding to account for a box that 
 * wraps the element.  This script changes the width to match that of the 'width' attribute passed in through
 * the shortcode, allowing themes to better handle how their captions are designed.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package CleanerCaption
 * @version 0.1.1
 * @author Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright (c) 2011, Justin Tadlock
 * @link http://justintadlock.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

function risen_cleaner_caption( $output, $attr, $content ) {

	/* We're not worried abut captions in feeds, so just return the output here. */
	if ( is_feed() )
		return $output;

	/* Set up the default arguments. */
	$defaults = array(
		'id' => '',
		'align' => 'alignnone',
		'width' => '',
		'caption' => ''
	);

	/* Allow developers to override the default arguments. */
	$defaults = apply_filters( 'cleaner_caption_defaults', $defaults );

	/* Apply filters to the arguments. */
	$attr = apply_filters( 'cleaner_caption_args', $attr );

	/* Merge the defaults with user input. */
	$attr = shortcode_atts( $defaults, $attr );

	/* If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags. */
	if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
		return $content;

	/* Set up the attributes for the caption <div>. */
	$attributes = ( ! empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="wp-caption ' . esc_attr( $attr['align'] ) . '"';
	$attributes .= ' style="width: ' . esc_attr( $attr['width'] ) . 'px"';

	/* Open the caption <div>. */
	$output = '<div' . $attributes .'>';

	/* Allow shortcodes for the content the caption was created for. */
	$output .= do_shortcode( $content );

	/* Append the caption text. */
	$output .= '<p class="wp-caption-text">' . $attr['caption'] . '</p>';

	/* Close the caption </div>. */
	$output .= '</div>';

	/* Return the formatted, clean caption. */
	return apply_filters( 'cleaner_caption', $output );

}

/**
 * Video
 * Return YouTube or Vimeo data, ID and HTML player code based on URL
 */

if ( ! function_exists( 'risen_video' ) ) {

	function risen_video( $video_url, $width = false, $height = false, $options = array() ) {

		$video = array();
		
		$video_url = isset( $video_url ) ? trim( $video_url ) : '';
		
		if ( ! empty( $video_url ) ) {
	
			// Default options
			$options['autoplay'] = ! empty( $options['autoplay'] ) ? '1' : '0';
				
			// YouTube
			if ( preg_match( '/youtu/i', $video_url ) ) {
			
				// source
				$video['source'] = 'youtube';
				
				// default size
				$width = ! empty( $width ) ? $width : 560;
				$height = ! empty( $height ) ? $height : 350;
				
				// video ID and embed code
				$video['video_id'] = '';
				$video['embed_code'] = '';
				preg_match( '/.*(?:youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/', $video_url, $match );
				if ( ! empty( $match[1] ) && strlen( $match[1] ) == 11 ) {
					$video['video_id'] = $match[1];
					$video['embed_code'] = '<iframe src="' . risen_current_protocol() . '://www.youtube.com/embed/' . $video['video_id'] . '?wmode=transparent&amp;autoplay=' . $options['autoplay'] . '&amp;rel=0&amp;showinfo=0&amp;color=white&amp;modestbranding=1" width="' . $width . '" height="' . $height . '" frameborder="0" allowfullscreen></iframe>';
				}				
				
			}
			
			// Vimeo
			else if ( preg_match( '/vimeo/i', $video_url ) ) {
			
				// source
				$video['source'] = 'vimeo';
				
				// default size
				$width = ! empty( $width ) ? $width : 500;
				$height = ! empty( $height ) ? $height : 281;
				
				// video ID and embed code
				$video['video_id'] = '';
				$video['embed_code'] = '';
				preg_match( '/\d+/', $video_url, $match );
				if ( ! empty( $match[0] ) ) {
					$video['video_id'] = $match[0];
					$video['embed_code'] = '<iframe src="' . risen_current_protocol() . '://player.vimeo.com/video/' . $video['video_id'] . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=' . $options['autoplay'] . '" width="' . $width . '" height="' . $height . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
				}
				
			}
			
			// Video Container
			if ( ! empty( $video['embed_code'] ) ) {
				$video['embed_code'] = '<div class="video-container ' . $video['source'] . '-video">' . $video['embed_code'] . '</div>';
			}
		
		}
		
		return $video;		
	
	}
	
}

/**
 * Responsive Video Embeds
 * Add container to WordPRess video embeds so it can be styled responsive
 * See embed_oembed_html filter
 * See WordPress embeds: http://codex.wordpress.org/Embeds
 */

if ( ! function_exists( 'risen_responsive_embeds' ) ) {

	function risen_responsive_embeds( $html, $url, $attr, $post_ID ) {
	
		if ( preg_match( '/^<(iframe|embed|object)/', $html ) ) { // no img
			$html = '<div class="responsive-embed">' . $html . '</div>';
		}
	
		return $html;
	
	}
	
}

