<?php
/**
 * Filter the output of image_downsize() to return dynamically generated images for intermediate or inline sizes.
 *
 * <p>Because Wordpress generates all image sizes on first upload, if you change
 * theme or size settings after the upload, there won't be a matching file for
 * the requested size.<br/>
 * This filter addresses the problem of the default downsize process laoding
 * a large file and scaling it down in the browser if it doesn't find the right
 * size image. This can cause large files to be loaded unnecessarily and will
 * only scale it to a max width or height using the proportions of the next best
 * image, it won't crop to the exact dimensions.</p>
 * <p>Other solutions involve either patching Wordpress, using custom functions or
 * using plugins that regenerate images manually. They work with some success but
 * don't satisfy all the following ideal (imo) criteria:</p>
 * <ul>
 * 	<li>Regenerate images automatically when required by the current theme</li>
 * 	<li>Don't require a plugin to manage media and extra images sizes</li>
 * 	<li>Don't use depreciated or custom image processing functions</li>
 * 	<li>Let wordpress handle creation, paths, error checking, library detection</li>
 * 	<li>Allow other filters to still apply (don't bypass filtered functions)</li>
 * 	<li>Keep generated sizes in meta to avoid orphan files in uploads folder</li>
 * 	<li>Can be disabled/removed without errors or changing anything else</li>
 * </ul>
 * <p>This does all that! :D</p>
 * <p>The issue was well defined in 2010 by Victor Teixeira and subsiquent
 * contributor repos, more recently by Eric Lewis. See links.</p>
 * <p>Example usage with theme specific size:
 * <br/>In theme functions.php: `add_image_size( 'Feature Image', 565, 337, true );`
 * <br/>In template file: `the_post_thumbnail( 'Feature Image' );`</p>
 * <p>Example usage with on-the-fly dimensions:<br/>
 * <br/>In template file: `the_post_thumbnail( array( 565, 337 ) );`
 * <br/>Will create a new named size called '565x337'</p>
 * <p>Returning a truthy value to the filter will effectively short-circuit
 * down-sizing the image, returning that value as output instead.</p>
 *
 * @author Tim Kinnane <tim@nestedcode.com>
 * @link   http://nestedcode.com
 * @link https://core.trac.wordpress.org/ticket/15311
 * @link https://gist.github.com/seedprod/1367237
 * @link https://core.trac.wordpress.org/attachment/ticket/15311/15311.7.diff*
 * @todo This approach would be improved by using a cron job to delete images
 *       for any currently undefined sizes, to save space after changing theme.
 *       that would also require removing the matching size meta on the attachment.
 * @param bool         $downsize Whether to short-circuit the image downsize. Default passed in true. (ignored in filter)
 * @param int          $id       Attachment ID for image.
 * @param array|string $size     Size of image, either array or string. Default passed in 'medium'.
 * @return array|bool            [ Image URL, width, height, bool ($is_intermediate) ] OR false if not resizing
 */
function dynamic_image_downsize( $downsize=true, $id, $size, $crop=true ) {
	$meta = wp_get_attachment_metadata( $id );
	$sizes = get_image_sizes();

	// use specific w/h dimensions requested
	if ( is_array( $size ) && sizeof( $size ) == 2 ) {
		list( $width, $height ) = $size;

		// make a size name from requested dimensions as a fallback for saving to meta
		$size = $width.'x'.$height;

		// if dimensions match a named size, use that instead
		foreach ( $sizes as $size_name => $size_atts ) {
			if ( $width == $size_atts['width'] && $height == $size_atts['height'] )
				$size = $size_name;
		}

	/* If $size is not a custom array, exit to handle as normal. This breaks the dynamic resizing for named image sizes
	   (i.e. Regenerate Thumbnail functionality) but greatly improves performance for custom image sizes. */
	} else {
		return false;
	}

	// exit if there's already a generated image with the right dimensions
	// the default downsize function would use it anyway (even if it had a different name)
	if ( isset( $meta['sizes'] ) && array_key_exists( $size, $meta['sizes'] ) && ( $width == $meta['sizes'][$size]['width'] || $height == $meta['sizes'][$size]['height'] ) )
		return false;

	// nothing matching size exists, generate and save new image from original
	$intermediate = image_make_intermediate_size( get_attached_file( $id ), $width, $height, $crop );

	// exit if failed creating image
	if ( !is_array( $intermediate ) )
		return false;

	// save the new size parameters in meta (to find it next time)
	$meta['sizes'][$size] = $intermediate;
	wp_update_attachment_metadata( $id, $meta );

	// this step is from the default image_downsize function in media.php
	// "might need to further constrain it if content_width is narrower"
	list( $width, $height ) = image_constrain_size_for_editor( $intermediate['width'], $intermediate['height'], $size );

	// use path of original file with new filename
	$original_url = wp_get_attachment_url( $id );
	$original_basename = wp_basename( $original_url );
	$img_url = str_replace($original_basename, $intermediate['file'], $original_url);

	// 'Tis done, and here's the image
	return array( $img_url, $width, $height, true );
}

add_filter( 'image_downsize', 'dynamic_image_downsize', 10, 3 );

// Useful helper function from codex example: http://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
function get_image_sizes( $size = '' ) {
	global $_wp_additional_image_sizes;
	$sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach( $get_intermediate_image_sizes as $_size ) {
		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
			$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
			$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
			$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width' => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
			);
		}
	}

	// Get only 1 size if found
	if ( $size ) {
		if( isset( $sizes[ $size ] ) )
			return $sizes[ $size ];
		else
			return false;
	}

	return $sizes;
}

?>