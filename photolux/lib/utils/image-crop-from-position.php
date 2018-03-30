<?php

/**
 * Includes modified code from the aqua resizer:
 * https://github.com/syamilmj/Aqua-Resizer
 */
function pexeto_resize_with_crop( $url, $width = null, $height = null, $align = 'c' ) {
	// Validate inputs.
	if ( ! $url || ( ! $width && ! $height ) ) return false;
	$crop = true;

	$align_options = array(
		't' => array('center', 'top'),
		'b' => array('center', 'bottom'),
		'l' => array('left', 'center'),
		'r' => array('right', 'center')
	);
	if(isset($align_options[$align])){
		$align_arr = $align_options[$align];
	}else{
		//unknown align option
		return false;
	}

	// Define upload path & dir.
	$upload_info = wp_upload_dir();
	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];
	
	$http_prefix = "http://";
	$https_prefix = "https://";
	
	/* if the $url scheme differs from $upload_url scheme, make them match 
	   if the schemes differe, images don't show up. */
	if(!strncmp($url,$https_prefix,strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
		$upload_url = str_replace($http_prefix,$https_prefix,$upload_url);
	}
	elseif(!strncmp($url,$http_prefix,strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
		$upload_url = str_replace($https_prefix,$http_prefix,$upload_url);      
	}
	

	// Check if $img_url is local.
	if ( false === strpos( $url, $upload_url ) ) return false;

	// Define path of image.
	$rel_path = str_replace( $upload_url, '', $url );
	$img_path = $upload_dir . $rel_path;

	// Check if img path exists, and is an image indeed.
	if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ) return false;

	// Get image info.
	$info = pathinfo( $img_path );
	$ext = $info['extension'];
	list( $orig_w, $orig_h ) = getimagesize( $img_path );

	// Get image size after cropping.
	$dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
	$dst_w = $dims[4];
	$dst_h = $dims[5];
	// Return the original image only if it exactly fits the needed measures.
	if ( ! $dims && ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
		$img_url = $url;
		$dst_w = $orig_w;
		$dst_h = $orig_h;
	} else {
		// Use this to check if cropped image already exists, so we can return that instead.
		$suffix = "{$align}-{$dst_w}x{$dst_h}";
		$dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
		$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

		if ( ! $dims || (( $dst_w < $width || $dst_h < $height ) ) ) {
            // Can't resize, so return false saying that the action to do could not be processed as planned.
            return false;
        }
		if ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
			$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
		}
		// Else, we resize the image and return the new resized image url.
		else {
			$editor = wp_get_image_editor( $img_path );

			if ( is_wp_error( $editor ) || is_wp_error( pexeto_crop_from_position( $editor, $width, $height, $align_arr ) ) )
				return false;

			$resized_file = $editor->save($destfilename);

			if ( ! is_wp_error( $resized_file ) ) {
				$resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
				$img_url = $upload_url . $resized_rel_path;
			} else {
				return false;
			}

		}
	}

		$image = $img_url;

	return $image;
}


/**
 * Code from the WP Thumb plugin:
 * https://github.com/humanmade/WPThumb
 */
function pexeto_crop_from_position( $editor, $width, $height, $position, $resize = true ) {
	$size = $editor->get_size();
	// resize to the largest dimension
	if ( $resize ) {
		$ratio1 = $size['width'] / $size['height'];
		$ratio2 = $width / $height;
		if ( $ratio1 < $ratio2 ) {
			$_width = $width;
			$_height = $width / $ratio1;
		} else {
			$_height = $height;
			$_width = $height * $ratio1;
		}

		$editor->resize( $_width, $_height );
	}

	$size = $editor->get_size();
	$crop = array( 'x' => 0, 'y' => 0 );
	if ( $position[0] == 'right' )
		$crop['x'] = absint( $size['width'] - $width );
	else if ( $position[0] == 'center' )
		$crop['x'] = intval( absint( $size['width'] - $width ) / 2 );
	if ( $position[1] == 'bottom' )
		$crop['y'] = absint( $size['height'] - $height );
	else if ( $position[1] == 'center' )
		$crop['y'] = intval( absint( $size['height'] - $height ) / 2 );
	return $editor->crop( $crop['x'], $crop['y'], $width, $height );
}